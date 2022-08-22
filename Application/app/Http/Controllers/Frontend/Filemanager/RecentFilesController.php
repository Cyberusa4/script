<?php

namespace App\Http\Controllers\Frontend\Filemanager;

use App\Http\Controllers\Controller;
use App\Http\Templates\FilesTemplate;
use App\Models\FileEntry;

class RecentFilesController extends Controller
{
    public function index()
    {
        return view('frontend.filemanager.recent.index');
    }

    public function loadRecentFiles()
    {
        $fileEntries = FileEntry::where([['user_id', userAuthInfo()->id]])->notFolder()->notExpired()->orderbyDesc('id')->limit(50)->get();
        if ($fileEntries->count() > 0) {
            $fileEntriesArr = [];
            foreach ($fileEntries as $fileEntry) {
                $fileEntriesArr[] = FilesTemplate::item($fileEntry);
            }
            return response()->json(['type' => "success", "data" => $fileEntriesArr]);
        } else {
            return response()->json(['type' => "empty", "data" => FilesTemplate::emptyFolderTemplate()]);
        }
    }
}
