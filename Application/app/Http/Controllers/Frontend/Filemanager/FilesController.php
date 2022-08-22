<?php

namespace App\Http\Controllers\Frontend\Filemanager;

use App\Http\Controllers\Controller;
use App\Http\Templates\FilesTemplate;
use App\Models\FileEntry;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    public function index()
    {
        return view('frontend.filemanager.files.index');
    }

    public function loadSidebarFolders()
    {
        $folders = FileEntry::where([['user_id', userAuthInfo()->id], ['type', 'folder']])->hasNoParent()->orderByDesc('id')->paginate(30);
        if ($folders->count() > 0) {
            $foldersArr = [];
            foreach ($folders as $folder) {
                $foldersArr[] = FilesTemplate::fileManagerSidebarFolderTemplate($folder);
            }
            return response()->json(['type' => "success", "data" => $foldersArr]);
        } else {
            return response()->json(['type' => "empty", "data" => FilesTemplate::emptySidebarTemplate()]);
        }
    }

    public function loadIndexFileEntries()
    {
        $fileEntries = FileEntry::where('user_id', userAuthInfo()->id)
            ->withCount([
                'childEntries as total_folders' => function ($query) {
                    $query->where('type', 'folder');
                },
                'childEntries as total_files' => function ($query) {
                    $query->where('type', '!=', 'folder');
                }])
            ->orderByRaw("FIELD(type, 'folder') DESC")
            ->hasNoParent()
            ->notExpired()
            ->orderbyDesc('id')
            ->paginate(30);
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

    public function searchOnFiles(Request $request)
    {
        $q = $request->q;
        $fileEntries = FileEntry::where(function ($query) {
            $query->where('user_id', userAuthInfo()->id);
        })->where(function ($query) use ($q) {
            $query->where('shared_id', 'like', '%' . $q . '%')
                ->OrWhere('name', 'like', '%' . $q . '%')
                ->OrWhere('filename', 'like', '%' . $q . '%')
                ->OrWhere('mime', 'like', '%' . $q . '%')
                ->OrWhere('size', 'like', '%' . $q . '%')
                ->OrWhere('extension', 'like', '%' . $q . '%');
        })->withCount([
            'childEntries as total_folders' => function ($query) {
                $query->where('type', 'folder');
            },
            'childEntries as total_files' => function ($query) {
                $query->where('type', '!=', 'folder');
            }])
            ->orderByRaw("FIELD(type, 'folder') DESC")
            ->hasNoParent()
            ->notExpired()
            ->orderbyDesc('id')
            ->get();
        if ($fileEntries->count() > 0) {
            $fileEntriesArr = [];
            foreach ($fileEntries as $fileEntry) {
                $fileEntriesArr[] = FilesTemplate::item($fileEntry);
            }
            return response()->json(['type' => "success", "data" => $fileEntriesArr]);
        } else {
            return response()->json(['type' => "empty", "data" => FilesTemplate::noSearchResultsTemplate($q)]);
        }
    }

    public function showFolder($folder)
    {
        $folder = FileEntry::where([['id', unhashid($folder)], ['user_id', userAuthInfo()->id], ['type', 'folder']])->firstOrFail();
        $breadcrumbs = [];
        $paths = explode('/', $folder->path_ids);
        foreach ($paths as $path) {
            $breadcrumbs[] = FileEntry::where('id', unhashid($path, 'short'))->select(['id', 'name'])->first();
        }
        return view('frontend.filemanager.files.folder', [
            'folder' => $folder,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function loadFolderFileEntries($folder)
    {
        $folder = FileEntry::where([['id', unhashid($folder)], ['user_id', userAuthInfo()->id], ['type', 'folder']])->firstOrFail();
        $fileEntries = FileEntry::where([['user_id', userAuthInfo()->id], ['parent_id', $folder->id]])
            ->withCount([
                'childEntries as total_folders' => function ($query) {
                    $query->where('type', 'folder');
                },
                'childEntries as total_files' => function ($query) {
                    $query->where('type', '!=', 'folder');
                }])
            ->orderByRaw("FIELD(type, 'folder') DESC")
            ->notExpired()
            ->orderbyDesc('id')
            ->paginate(30);
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

    public function searchOnFolder(Request $request, $folder)
    {
        $folder = FileEntry::where([['id', unhashid($folder)], ['user_id', userAuthInfo()->id], ['type', 'folder']])->notExpired()->firstOrFail();
        $q = $request->q;
        $fileEntries = FileEntry::where(function ($query) use ($folder) {
            $query->where([['user_id', userAuthInfo()->id], ['parent_id', $folder->id]]);
        })->where(function ($query) use ($q) {
            $query->where('shared_id', 'like', '%' . $q . '%')
                ->OrWhere('name', 'like', '%' . $q . '%')
                ->OrWhere('filename', 'like', '%' . $q . '%')
                ->OrWhere('mime', 'like', '%' . $q . '%')
                ->OrWhere('size', 'like', '%' . $q . '%')
                ->OrWhere('extension', 'like', '%' . $q . '%');
        })->withCount([
            'childEntries as total_folders' => function ($query) {
                $query->where('type', 'folder');
            },
            'childEntries as total_files' => function ($query) {
                $query->where('type', '!=', 'folder');
            }])
            ->orderByRaw("FIELD(type, 'folder') DESC")
            ->notExpired()
            ->orderbyDesc('id')
            ->get();
        if ($fileEntries->count() > 0) {
            $fileEntriesArr = [];
            foreach ($fileEntries as $fileEntry) {
                $fileEntriesArr[] = FilesTemplate::item($fileEntry);
            }
            return response()->json(['type' => "success", "data" => $fileEntriesArr]);
        } else {
            return response()->json(['type' => "empty", "data" => FilesTemplate::noSearchResultsTemplate($q)]);
        }
    }
}
