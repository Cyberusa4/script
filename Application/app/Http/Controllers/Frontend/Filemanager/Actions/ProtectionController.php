<?php

namespace App\Http\Controllers\Frontend\Filemanager\Actions;

use App\Http\Controllers\Controller;
use App\Models\FileEntry;
use Hash;
use Illuminate\Http\Request;
use Validator;

class ProtectionController extends Controller
{
    public function getProtectionForm($id)
    {
        $fileEntry = FileEntry::where([['id', unhashid($id)], ['user_id', userAuthInfo()->id]])->notExpired()->first();
        if (is_null($fileEntry)) {
            return response()->json(['error' => lang('File not found, missing or expired please refresh the page and try again', 'file manager')]);
        }
        $passwordClass = !$fileEntry->access_status ? 'd-none' : '';
        $publicOption = $fileEntry->access_status ? 'selected' : '';
        $privateOption = !$fileEntry->access_status ? 'selected' : '';
        $passwordActive = $fileEntry->password ? '<div id="filemanager-file-protection-alert" class="alert alert-success"><i class="fa fa-lock me-2"></i>' . lang('File protected by password', 'file manager') . '</div>' : '';
        $passwordInput = '';
        $topText = '';
        if (subscription()->plan->password_protection) {
            $topText = '<p id="filemanager-file-protection-modal-text" class="text-muted ' . $passwordClass . '">' . lang('Leave the password field empty to cancel or remove it.', 'file manager') . '</p>';
            $passwordInput = '<div id="filemanager-file-protection-password" class="mb-3 ' . $passwordClass . '">
            <label class="form-label">' . lang('File Password', 'file manager') . '</label>
            <div class="form-group input-password ">
                <input type="password" name="password" class="form-control form-control-lg"
                    placeholder="' . lang('Enter password', 'file manager') . '" required>
                <button type="button" class="text-muted"><i class="fa fa-eye"></i></button>
            </div>
            </div>
            ' . $passwordActive . '';
        }
        $data = '' . $topText . '<form id="filemanager-file-protection-form">
        <div id="filemanager-file-protection-access" class="mb-3">
            <label class="form-label">' . lang('File Access', 'file manager') . '</label>
            <select name="file_access" class="form-select form-control-lg">
                <option value="1" ' . $publicOption . '>' . lang('Public', 'file manager') . '</option>
                <option value="0" ' . $privateOption . '>' . lang('Private', 'file manager') . '</option>
            </select>
        </div>
        ' . $passwordInput . '
        <div class="d-flex justify-content-end mt-4">
            <button type="button" class="btn btn-gradient me-2"
                data-bs-dismiss="modal">' . lang('Cancel', 'file manager') . '</button>
            <button id="filemanager-file-protection-button" type="submit"
                class="btn btn-primary" data-link="' . route('filemanager.protection', hashid($fileEntry->id)) . '">' . lang('Submit', 'file manager') . '</button>
        </div>
        </form>';
        return response()->json(['type' => 'success', 'data' => $data]);

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'file_access' => ['required', 'integer', 'min:0', 'max:1'],
            'password' => ['nullable', 'string', 'max:255'],
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
        if ($request->file_access != 0 && $request->file_access != 1) {
            return response()->json(['error' => lang('Unauthorized action', 'alerts')]);
        }
        if ($request->file_access == 0) {
            $request->password = null;
            $request->file_access = 0;
        } else if ($request->file_access == 1) {
            $request->password = ($request->has('password') && !is_null($request->password) && subscription()->plan->password_protection) ? Hash::make($request->password) : null;
            $request->file_access = 1;
        }
        $fileEntry->update([
            'access_status' => $request->file_access,
            'password' => $request->password,
        ]);
        return response()->json(['success' => lang('Updated successfully', 'file manager')]);
    }
}
