<?php

namespace App\Http\Controllers\Frontend\Filemanager;

use App\Events\FileEntryDeleted;
use App\Http\Controllers\Controller;
use App\Http\Templates\TrashTemplate;
use App\Models\FileEntry;
use Illuminate\Http\Request;

class TrashController extends Controller
{
    public function index()
    {
        return view('frontend.filemanager.trash.index', [
            'countTrashedEntries' => $this->countTrashedFiles(),
        ]);
    }

    public function loadTrashFileEntries()
    {
        $fileEntries = FileEntry::where('user_id', userAuthInfo()->id)->orderByRaw("FIELD(type, 'folder') DESC")
            ->onlyTrashed()
            ->notExpired()
            ->orderbyDesc('id')
            ->paginate(30);
        if ($fileEntries->count() > 0) {
            $fileEntriesArr = [];
            foreach ($fileEntries as $fileEntry) {
                $fileEntriesArr[] = TrashTemplate::item($fileEntry);
            }
            return response()->json(['type' => "success", "data" => $fileEntriesArr]);
        } else {
            return response()->json(['type' => "empty", "data" => TrashTemplate::emptyFolderTemplate()]);
        }
    }

    public function moveSingleFileToTrash($id)
    {
        $fileEntry = FileEntry::where([['user_id', userAuthInfo()->id], ['id', unhashid($id)]])->notExpired()->first();
        if (is_null($fileEntry)) {
            return response()->json(['error' => lang('File not found, missing or expired please refresh the page and try again', 'file manager')]);
        }
        $fileEntry->delete();
        return response()->json([
            'trash_items' => $this->countTrashedFiles(),
            'success' => lang('File moved to trash', 'file manager'),
        ]);
    }

    public function moveMultipleFileToTrash(Request $request)
    {
        if (empty($request->ids)) {
            return response()->json(['error' => lang('You have not selected any file', 'file manager')]);
        }
        $ids = explode(',', $request->ids);
        $totalDeleted = 0;
        foreach ($ids as $id) {
            $fileEntry = FileEntry::where([['user_id', userAuthInfo()->id], ['id', unhashid($id)]])->notExpired()->first();
            if (is_null($fileEntry)) {
                return response()->json(['error' => lang('Unauthorized action', 'alerts')]);
            }
            $totalDeleted += 1;
            $fileEntry->delete();
        }
        return response()->json([
            'trash_items' => $this->countTrashedFiles(),
            'success' => str_replace('{count}', $totalDeleted, lang('Files moved to trash', 'file manager')),
        ]);
    }

    public function delete($id)
    {
        $trashedEntry = FileEntry::where([['id', unhashid($id)], ['user_id', userAuthInfo()->id]])->notExpired()->onlyTrashed()->first();
        if (is_null($trashedEntry)) {
            return response()->json(['error' => lang('File not found, missing or expired please refresh the page and try again', 'file manager')]);
        }
        event(new FileEntryDeleted($trashedEntry));
        return response()->json([
            'trash_items' => $this->countTrashedFiles(),
            'success' => lang('Emptied successfully', 'file manager'),
        ]);
    }

    public function emptyTrash()
    {
        $trashedEntries = FileEntry::where('user_id', userAuthInfo()->id)->notExpired()->onlyTrashed()->get();
        if ($trashedEntries->count() < 1) {
            return response()->json(['error' => lang('Unauthorized action', 'alerts')]);
        }
        foreach ($trashedEntries as $trashedEntry) {
            event(new FileEntryDeleted($trashedEntry));
        }
        return response()->json([
            'trash_items' => $this->countTrashedFiles(),
            'success' => lang('Emptied successfully', 'file manager'),
        ]);
    }

    public function restore(Request $request, $id)
    {
        $trashedEntry = FileEntry::where([['id', unhashid($id)], ['user_id', userAuthInfo()->id]])->notExpired()->onlyTrashed()->first();
        if (is_null($trashedEntry)) {
            return response()->json(['error' => lang('File not found, missing or expired please refresh the page and try again', 'file manager')]);
        }
        if ($trashedEntry->parent_id) {
            $parentEntry = FileEntry::where([['id', $trashedEntry->parent_id], ['user_id', userAuthInfo()->id]])->first();
            if (is_null($parentEntry)) {
                return response()->json(['error' => lang('File belongs to a deleted folder it cannot be restored', 'file manager')]);
            }
        }
        $trashedEntry->restore();
        return response()->json([
            'trash_items' => $this->countTrashedFiles(),
            'success' => lang('Restored successfully', 'file manager'),
        ]);
    }

    public function restoreAll(Request $request)
    {
        $trashedEntries = FileEntry::where('user_id', userAuthInfo()->id)->notExpired()->onlyTrashed()->get();
        if ($trashedEntries->count() < 1) {
            return response()->json(['error' => lang('Unauthorized action', 'alerts')]);
        }
        foreach ($trashedEntries as $trashedEntry) {
            $trashedEntry->restore();
        }
        return response()->json([
            'trash_items' => $this->countTrashedFiles(),
            'success' => lang('Restored successfully', 'file manager'),
        ]);
    }

    private function countTrashedFiles()
    {
        $countTrashedFiles = FileEntry::where('user_id', userAuthInfo()->id)->notExpired()->onlyTrashed()->count();
        return $countTrashedFiles;
    }
}
