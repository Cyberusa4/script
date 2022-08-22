<?php

namespace App\Http\Controllers\Backend\Uploads;

use App\Http\Controllers\Controller;
use App\Models\FileEntry;
use Illuminate\Http\Request;

class GuestUploadsController extends Controller
{
    public function index(Request $request)
    {
        $unviewedFiles = FileEntry::where('admin_has_viewed', 0)->guestEntry()->notFolder()->notExpired()->get();
        if (count($unviewedFiles) > 0) {
            foreach ($unviewedFiles as $unviewedFile) {
                $unviewedFile->admin_has_viewed = 1;
                $unviewedFile->save();
            }
        }
        if ($request->has('search')) {
            $q = $request->search;
            $fileEntries = FileEntry::where(function ($query) {
                $query->guestEntry()->notFolder();
            })->where(function ($query) use ($q) {
                $query->where('shared_id', 'like', '%' . $q . '%')
                    ->OrWhere('name', 'like', '%' . $q . '%')
                    ->OrWhere('filename', 'like', '%' . $q . '%')
                    ->OrWhere('mime', 'like', '%' . $q . '%')
                    ->OrWhere('size', 'like', '%' . $q . '%')
                    ->OrWhere('extension', 'like', '%' . $q . '%');
            })->notExpired()->with('storageProvider')->orderbyDesc('id')->paginate(30);
            $fileEntries->appends(['search' => $q]);
        } else {
            $fileEntries = FileEntry::guestEntry()->notFolder()->notExpired()->with('storageProvider')->orderbyDesc('id')->paginate(30);
        }
        $totalImages = FileEntry::where('type', 'image')->guestEntry()->notExpired()->count();
        $totalFileDocuments = FileEntry::whereIn('type', ['file', 'pdf'])->guestEntry()->notExpired()->count();
        $usedSpace = FileEntry::notFolder()->guestEntry()->notExpired()->sum('size');
        return view('backend.uploads.guests.index', [
            'totalImages' => $totalImages,
            'totalFileDocuments' => $totalFileDocuments,
            'fileEntries' => $fileEntries,
            'usedSpace' => formatBytes($usedSpace),
        ]);
    }

    public function view($shared_id)
    {
        $fileEntry = FileEntry::where('shared_id', $shared_id)->guestEntry()->notFolder()->notExpired()->with('storageProvider')->firstOrFail();
        return view('backend.uploads.guests.view', ['fileEntry' => $fileEntry]);
    }

    public function downloadFile($shared_id)
    {
        $fileEntry = FileEntry::where('shared_id', $shared_id)->guestEntry()->notFolder()->notExpired()->with('storageProvider')->firstOrFail();
        try {
            $handler = $fileEntry->storageProvider->handler;
            $download = $handler::download($fileEntry);
            if ($fileEntry->storageProvider->symbol == "local") {
                return $download;
            } else {
                return redirect($download);
            }
        } catch (\Exception $e) {
            toastr()->error(__('There was a problem while trying to download the file'));
            return back();
        }
    }

    public function destroy($shared_id)
    {
        $fileEntry = FileEntry::where('shared_id', $shared_id)->guestEntry()->notFolder()->notExpired()->with('storageProvider')->first();
        if (is_null($fileEntry)) {
            toastr()->error(__('File not exists'));
            return back();
        }
        try {
            $handler = $fileEntry->storageProvider->handler;
            $delete = $handler::delete($fileEntry->path);
            if ($delete) {
                $fileEntry->forceDelete();
                toastr()->success(__('Deleted successfully'));
                return redirect()->route('admin.uploads.guests.index');
            }
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return back();
        }
    }

    public function destroySelected(Request $request)
    {
        if (empty($request->delete_ids)) {
            toastr()->error(__('You have not selected any file'));
            return back();
        }
        try {
            $fileEntriesIds = explode(',', $request->delete_ids);
            $totalDelete = 0;
            foreach ($fileEntriesIds as $fileEntryId) {
                $fileEntry = FileEntry::where('id', $fileEntryId)->guestEntry()->notFolder()->notExpired()->with('storageProvider')->first();
                if (!is_null($fileEntry)) {
                    $handler = $fileEntry->storageProvider->handler;
                    $handler::delete($fileEntry->path);
                    $fileEntry->forceDelete();
                    $totalDelete += 1;
                }
            }
            if ($totalDelete != 0) {
                $countFiles = ($totalDelete > 1) ? $totalDelete . ' ' . __('Files') : $totalDelete . ' ' . __('File');
                toastr()->success($countFiles . ' ' . __('deleted successfully'));
                return back();
            } else {
                toastr()->info(__('No files have been deleted'));
                return back();
            }
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return back();
        }
    }
}
