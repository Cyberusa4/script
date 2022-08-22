<?php

namespace App\Http\Controllers\Frontend\Storage;

use App\Http\Controllers\Controller;
use Cache;
use Exception;
use Storage;

class AmazonController extends Controller
{
    public static function setCredentials($data)
    {
        setEnv('AWS_ACCESS_KEY_ID', $data->credentials->access_key_id);
        setEnv('AWS_SECRET_ACCESS_KEY', $data->credentials->secret_access_key);
        setEnv('AWS_DEFAULT_REGION', $data->credentials->default_region);
        setEnv('AWS_BUCKET', $data->credentials->bucket);
        setEnv('AWS_URL', $data->credentials->url);
    }

    public static function upload($file, $location)
    {
        try {
            $filename = generateFileName($file);
            $path = $location . $filename;
            $disk = Storage::disk('s3');
            $uploadToStorage = $disk->put($path, fopen($file, 'r+'));
            if ($uploadToStorage) {
                $data = [
                    "type" => "success",
                    "filename" => $filename,
                    "path" => $path,
                    "link" => $disk->url($path),
                ];
                return responseHandler($data);
            }
        } catch (Exception $e) {
            return responseHandler(["type" => "error", 'msg' => lang('Storage provider error', 'upload zone')]);
        }
    }

    public static function getFile($fileEntry)
    {
        try {
            $cachePrefex = 'secure_' . hashid($fileEntry->id);
            if (Cache::has($cachePrefex)) {
                return Cache::get($cachePrefex);
            } else {
                $file = Storage::disk('s3')->get($fileEntry->path);
                $response = \Response::make($file, 200);
                $response->header("Content-Type", $fileEntry->mime);
                Cache::put($cachePrefex, $response);
                return $response;
            }
        } catch (Exception $e) {
            return brokenFile();
        }
    }

    public static function download($fileEntry)
    {
        try {
            $disk = Storage::disk('s3');
            $filePath = $disk->path($fileEntry->path);
            if ($disk->has($filePath)) {
                return $disk->temporaryUrl($filePath, now()->addHour(), [
                    'ResponseContentDisposition' => 'attachment; filename="' . $fileEntry->name . '"',
                ]);
            } else {
                throw new Exception(lang('There was a problem while trying to download the file', 'download page'));
            }
        } catch (Exception $e) {
            throw new Exception(lang('There was a problem while trying to download the file', 'download page'));
        }
    }

    public static function delete($filePath)
    {
        $disk = Storage::disk('s3');
        if ($disk->has($filePath)) {
            $disk->delete($filePath);
        }
        return true;
    }
}
