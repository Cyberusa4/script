<?php

namespace App\Http\Controllers\Frontend\Filemanager\Actions;

use App\Http\Controllers\Controller;
use App\Models\FileEntry;
use Illuminate\Http\Request;
use Validator;

class RenameController extends Controller
{
    public function rename(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'file_name' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                return response()->json(['error' => $error]);
            }
        }
        if (subscription()->is_expired) {
            return response()->json(['error' => lang('Your subscription has been expired, renew it to start uploading files', 'alerts')]);
        }
        if (subscription()->is_canceled) {
            return response()->json(['error' => lang('Your subscription has been canceled, please contact us for more information', 'alerts')]);
        }
        $fileEntry = FileEntry::where([['id', unhashid($id)], ['user_id', userAuthInfo()->id]])->notExpired()->first();
        if (is_null($fileEntry)) {
            return response()->json(['error' => lang('File not found, missing or expired please refresh the page and try again', 'file manager')]);
        }
        if ($fileEntry->type == "folder") {
            $folderExists = FileEntry::where([['id', '!=', $fileEntry->id], ['user_id', userAuthInfo()->id], ['parent_id', $fileEntry->parent_id], ['name', $request->file_name], ['type', 'folder']])->first();
            if (!is_null($folderExists)) {
                return response()->json(['error' => lang('Folder with that name already exists', 'file manager')]);
            }
            $fileEntry->update([
                'name' => $request->file_name,
                'filename' => $request->file_name,
            ]);
        } else {
            $fileEntry->update([
                'name' => $request->file_name,
            ]);
        }
        return response()->json(['success' => lang('Renamed successfully', 'file manager')]);
    }
}
