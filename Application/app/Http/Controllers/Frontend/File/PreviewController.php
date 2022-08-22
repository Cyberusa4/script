<?php

namespace App\Http\Controllers\Frontend\File;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\File\DownloadController;
use App\Models\FileEntry;
use Session;

class PreviewController extends Controller
{
    public function index($shared_id)
    {
        $fileEntry = FileEntry::where('shared_id', $shared_id)->notExpired()->hasPreview()->with('user')->firstOrFail();
        abort_if(!DownloadController::accessCheck($fileEntry), 404);
        if (!is_null($fileEntry->password)) {
            if (!Session::has(filePasswordSession($fileEntry->shared_id))) {
                return redirect(route('file.password', $fileEntry->shared_id) . '?source=preview');
            } else {
                $password = decrypt(Session::get(filePasswordSession($fileEntry->shared_id)));
                if ($password != $fileEntry->password) {
                    return redirect(route('file.password', $fileEntry->shared_id) . '?source=preview');
                }
            }
        }
        $fileEntry->increment('views');
        $view = ($fileEntry->type == "pdf") ? "frontend.file.preview.pdf" : "frontend.file.preview.image";
        return view($view, ['fileEntry' => $fileEntry]);
    }
}
