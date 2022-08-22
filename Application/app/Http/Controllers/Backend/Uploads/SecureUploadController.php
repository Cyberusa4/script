<?php

namespace App\Http\Controllers\Backend\Uploads;

use App\Http\Controllers\Controller;
use App\Models\FileEntry;

class SecureUploadController extends Controller
{
    public function index($id)
    {
        $fileEntry = FileEntry::where('id', unhashid($id))->withTrashed()->notExpired()->hasPreview()->with('storageProvider')->firstOrFail();
        $handler = $fileEntry->storageProvider->handler;
        return $handler::getFile($fileEntry);
    }
}
