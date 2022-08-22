<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Methods\FileExtensionDetector;
use App\Models\FileEntry;
use App\Models\StorageProvider;
use Auth;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Str;
use Validator;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $uploadedFile = $request->file('file');
        $uploadedFileName = $uploadedFile->getClientOriginalName();
        $validator = Validator::make($request->all(), [
            'password' => ['nullable', 'max:255'],
            'upload_auto_delete' => ['required', 'integer', 'min:0', 'max:365'],
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                return static::errorResponseHandler($error . ' (' . $uploadedFileName . ')');
            }
        }
        if (!subscription()->is_subscribed) {
            return static::errorResponseHandler(lang('Login or create account to start uploading files', 'alerts'));
        }
        if (subscription()->is_expired) {
            return static::errorResponseHandler(lang('Your subscription has been expired, renew it to start uploading files', 'alerts'));
        }
        if (subscription()->is_canceled) {
            return static::errorResponseHandler(lang('Your subscription has been canceled, please contact us for more information', 'alerts'));
        }
        if (!array_key_exists($request->upload_auto_delete, autoDeletePeriods())) {
            return static::errorResponseHandler(lang('Invalid file auto delete time', 'upload zone'));
        } else {
            if (autoDeletePeriods()[$request->upload_auto_delete]['days'] != 0) {
                $expiryAt = autoDeletePeriods()[$request->upload_auto_delete]['datetime'];
            } else {
                $expiryAt = null;
            }
        }
        if ($request->has('password') && !is_null($request->password) && $request->password != "undefined") {
            if (subscription()->plan->password_protection) {
                $request->password = Hash::make($request->password);
            } else {
                $request->password = null;
            }
        }
        $unacceptableFileTypes = explode(',', settings('unacceptable_file_types'));
        $fileExt = $uploadedFile->getclientoriginalextension();
        if (in_array($fileExt, $unacceptableFileTypes)) {
            return static::errorResponseHandler(lang('You cannot upload files of this type.', 'upload zone'));
        }
        if (!is_null(subscription()->plan->file_size)) {
            if ($request->size > subscription()->plan->file_size) {
                return static::errorResponseHandler(str_replace('{maxFileSize}', subscription()->formates->file_size, lang('File is too big, Max file size {maxFileSize}', 'upload zone')));
            }
        }
        if (!is_null(subscription()->storage->remining->number)) {
            if ($request->size > subscription()->storage->remining->number) {
                return static::errorResponseHandler(lang('insufficient storage space please ensure sufficient space', 'upload zone'));
            }
        }
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));
        try {
            if ($request->has('folder') && !is_null($request->folder)) {
                if (Auth::user()) {
                    $folder = FileEntry::where([['user_id', userAuthInfo()->id], ['id', unhashid($request->folder)], ['type', 'folder']])->first();
                    if (is_null($folder)) {
                        return static::errorResponseHandler(lang('Folder not exists', 'upload zone'));
                    }
                    $parentId = $folder->id;
                } else {
                    $parentId = null;
                }
            } else {
                $parentId = null;
            }
            $storageProvider = StorageProvider::where([['symbol', env('FILESYSTEM_DRIVER')], ['status', 1]])->first();
            if (is_null($storageProvider)) {
                return static::errorResponseHandler(lang('Unavailable storage provider', 'upload zone'));
            }
            if ($receiver->isUploaded() === false) {
                return static::errorResponseHandler(str_replace('{filename}', $uploadedFileName, lang('Failed to upload ({filename})', 'upload zone')));
            }
            $save = $receiver->receive();
            if ($save->isFinished()) {
                $file = $save->getFile();
                $fileName = $file->getClientOriginalName();
                $fileMimeType = $file->getMimeType();
                $fileExtension = $file->getClientOriginalExtension();
                if (empty($fileExtension)) {
                    $fileExtension = FileExtensionDetector::lookupExtension($fileMimeType);
                }
                $fileSize = $file->getSize();
                if ($fileSize == 0) {
                    return static::errorResponseHandler(lang('Empty files cannot be uploaded', 'upload zone'));
                }
                if (!is_null(subscription()->plan->file_size)) {
                    if ($fileSize > subscription()->plan->file_size) {
                        removeFile($file);
                        return static::errorResponseHandler(str_replace('{maxFileSize}', subscription()->formates->file_size, lang('File is too big, Max file size {maxFileSize}', 'upload zone')));
                    }
                }
                if (!is_null(subscription()->storage->remining->number)) {
                    if ($fileSize > subscription()->storage->remining->number) {
                        removeFile($file);
                        return static::errorResponseHandler(lang('insufficient storage space please ensure sufficient space', 'upload zone'));
                    }
                }
                $ip = vIpInfo()->ip;
                $sharedId = Str::random(15);
                $userId = (Auth::user()) ? Auth::user()->id : null;
                $location = (Auth::user()) ? "users/" . hashid(userAuthInfo()->id) . "/" : "anonymous/";
                $handler = $storageProvider->handler;
                $uploadResponse = $handler::upload($file, $location);
                if ($uploadResponse->type == "error") {
                    return $uploadResponse;
                }
                $createFileEntry = FileEntry::create([
                    'ip' => $ip,
                    'shared_id' => $sharedId,
                    'user_id' => $userId,
                    'parent_id' => $parentId,
                    'storage_provider_id' => $storageProvider->id,
                    'name' => $fileName,
                    'filename' => $uploadResponse->filename,
                    'mime' => $fileMimeType,
                    'size' => $fileSize,
                    'extension' => $fileExtension,
                    'type' => getFileType($fileMimeType),
                    'path' => $uploadResponse->path,
                    'link' => $uploadResponse->link,
                    'password' => $request->password,
                    'expiry_at' => $expiryAt,
                ]);
                if ($createFileEntry) {
                    $pathIds = ($request->has('folder') && !is_null($request->folder)) ? $folder->path_ids . '/' . hashid($createFileEntry->id, 'short') : hashid($createFileEntry->id, 'short');
                    $createFileEntry->update(['path_ids' => $pathIds]);
                    if ($createFileEntry->type == "image" || $createFileEntry->type == "pdf") {
                        $previewId = "preview_" . $createFileEntry->shared_id;
                        $previewLink = route('file.preview', $createFileEntry->shared_id);
                    }
                    return response()->json([
                        'type' => 'success',
                        'download_id' => "download_" . $createFileEntry->shared_id,
                        'download_link' => route('file.download', $createFileEntry->shared_id),
                        'preview_id' => $previewId ?? null,
                        'preview_link' => $previewLink ?? null,
                    ]);
                }
            }
        } catch (Exception $e) {
            return static::errorResponseHandler(str_replace('{filename}', $uploadedFileName, lang('Failed to upload ({filename})', 'upload zone')));
        }
    }

    private static function errorResponseHandler($response)
    {
        return response()->json(['type' => 'error', 'msg' => $response]);
    }
}
