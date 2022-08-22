<?php

namespace App\Http\Controllers\Frontend\Filemanager\Actions;

use App\Http\Controllers\Controller;
use App\Models\FileEntry;
use Illuminate\Http\Request;
use Validator;

class CreateFolderController extends Controller
{
    public function createFolder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'folder_name' => ['required', 'string', 'max:255'],
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
        if ($request->has('parent_id')) {
            $parentFolder = FileEntry::where([['user_id', userAuthInfo()->id], ['id', unhashid($request->parent_id)], ['type', 'folder']])->first();
            if (is_null($parentFolder)) {
                return response()->json(['error' => lang('The parent folder not exist', 'file manager')]);
            }
            $folderExists = FileEntry::where([['user_id', userAuthInfo()->id], ['parent_id', unhashid($request->parent_id)], ['name', $request->folder_name], ['type', 'folder']])->first();
            if (!is_null($folderExists)) {
                return response()->json(['error' => lang('Folder with that name already exists', 'file manager')]);
            }
            $request->parent_id = $parentFolder->id;
        } else {
            $folderExists = FileEntry::where([['user_id', userAuthInfo()->id], ['name', $request->folder_name], ['type', 'folder']])->hasNoParent()->first();
            if (!is_null($folderExists)) {
                return response()->json(['error' => lang('Folder with that name already exists', 'file manager')]);
            }
        }
        $createFolder = FileEntry::create([
            'ip' => vIpInfo()->ip,
            'user_id' => userAuthInfo()->id,
            'parent_id' => $request->parent_id,
            'name' => $request->folder_name,
            'filename' => $request->folder_name,
            'type' => "folder",
            'admin_has_viewed' => 1,
        ]);
        if ($createFolder) {
            $pathIds = ($request->has('parent_id')) ? $parentFolder->path_ids . '/' . hashid($createFolder->id, 'short') : hashid($createFolder->id, 'short');
            $createFolder->update(['path_ids' => $pathIds]);
            return response()->json(['success' => lang('Folder created successfully', 'file manager')]);
        }
    }
}
