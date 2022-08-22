<?php

namespace App\Http\Controllers\Frontend\Filemanager\Actions;

use App\Http\Controllers\Controller;
use App\Models\FileEntry;

class ShareFileController extends Controller
{
    public function share($shared_id)
    {
        $fileEntry = FileEntry::where([['user_id', userAuthInfo()->id], ['shared_id', $shared_id]])->notFolder()->notExpired()->first();
        if (is_null($fileEntry)) {
            return response()->json(['error' => lang('File not found, missing or expired please refresh the page and try again', 'file manager')]);
        }
        if (!$fileEntry->access_status) {
            return response()->json(['error' => lang('Files with private access cannot be shared, make sure the file access is public before trying to share it', 'file manager')]);
        }
        $preview = '';
        if (isFileSupportPreview($fileEntry->type)) {
            $preview = '<div class="mb-3">
            <label class="form-label"><strong>' . lang('Preview link') . '</strong></label>
            <div class="input-group">
                <input id="copy-preview-link" type="text" class="form-control" value="' . route('file.preview', $fileEntry->shared_id) . '" readonly>
                <button type="button" class="btn btn-primary btn-md copy"
                    data-clipboard-target="#copy-preview-link"><i class="far fa-clone"></i></button>
            </div>
            </div>';
        }
        $data = '<h5 class="mb-4"><i class="fas fa-share-alt me-2"></i>' . lang('Share this file') . '</h5>
        <p class="mb-4 text-ellipsis"><strong>' . $fileEntry->name . '</strong></p>
        <div class="mb-3">
            <div class="share">' . shareButtons(route('file.download', $fileEntry->shared_id)) . '</div>
        </div>
        ' . $preview . '
        <div class="mb-3">
            <label class="form-label"><strong>' . lang('Download link') . '</strong></label>
            <div class="input-group">
                <input id="copy-download-link" type="text" class="form-control" value="' . route('file.download', $fileEntry->shared_id) . '" readonly>
                <button type="button" class="btn btn-primary btn-md copy"
                    data-clipboard-target="#copy-download-link"><i class="far fa-clone"></i></button>
            </div>
        </div>';
        return response()->json(['type' => "success", "data" => $data]);
    }
}
