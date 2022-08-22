<?php

namespace App\Http\Controllers\Frontend\File;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\File\DownloadController;
use App\Models\FileEntry;

class SecureController extends Controller
{
    public function index($id)
    {
        $fileEntry = FileEntry::where('id', unhashid($id))->notExpired()->hasPreview()->withTrashed()->with('storageProvider')->firstOrFail();
        abort_if(!DownloadController::accessCheck($fileEntry), 404);
        $handler = $fileEntry->storageProvider->handler;
        return $handler::getFile($fileEntry);
    }
}
