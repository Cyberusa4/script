<?php

namespace App\Http\Controllers\Frontend\Storage;

use App\Http\Controllers\Controller;
use Cache;
use Exception;
use Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LocalController extends Controller
{
    public static function upload($file, $location)
    {
        try {
            $filename = generateFileName($file);
            $path = "app/public/" . $location;
            $upload = $file->move(storage_path($path), $filename);
            if ($upload) {
                $data = [
                    "type" => "success",
                    "filename" => $filename,
                    "path" => $location . $filename,
                    "link" => url($path . $filename),
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
                $file = Storage::disk('public')->get($fileEntry->path);
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
            $disk = Storage::disk('public');
            $fileName = $fileEntry->filename;
            $filePath = $disk->path($fileEntry->path);
            if ($disk->has($fileEntry->path)) {
                $headers = [
                    'Content-Type' => $fileEntry->mime,
                    'Content-Disposition' => 'attachment; filename="' . $fileEntry->name . '"',
                    'Content-Length' => $fileEntry->size,
                ];
                $response = new StreamedResponse(
                    function () use ($filePath, $fileName) {
                        if ($file = fopen($filePath, 'rb')) {
                            while (!feof($file) and (connection_status() == 0)) {
                                print(fread($file, 1024 * 8));
                                flush();
                            }
                            fclose($file);
                        }
                    },
                    200, $headers);
                return $response;
            } else {
                throw new Exception(lang('There was a problem while trying to download the file', 'download page'));
            }
        } catch (Exception $e) {
            throw new Exception(lang('There was a problem while trying to download the file', 'download page'));
        }
    }

    public static function delete($filePath)
    {
        $disk = Storage::disk('public');
        if ($disk->has($filePath)) {
            $disk->delete($filePath);
        }
        return true;
    }
}
