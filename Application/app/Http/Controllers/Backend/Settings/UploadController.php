<?php

namespace App\Http\Controllers\Backend\Settings;

use App\Http\Controllers\Controller;
use App\Models\UploadSettings;
use Illuminate\Http\Request;
use Validator;

class UploadController extends Controller
{
    public function index()
    {
        $uploadSettings = UploadSettings::all();
        return view('backend.settings.upload.index', ['uploadSettings' => $uploadSettings]);
    }

    public function edit($id)
    {
        $uploadSetting = UploadSettings::findOrFail($id);
        return view('backend.settings.upload.edit', ['uploadSetting' => $uploadSetting]);
    }

    public function update(Request $request, $id)
    {
        $uploadSetting = UploadSettings::find($id);
        if (is_null($uploadSetting)) {
            toastr()->error(__('Upload settings not exists'));
            return back();
        }
        $validator = Validator::make($request->all(), [
            'storage_space' => ['sometimes', 'required', 'integer', 'min:1'],
            'file_size' => ['sometimes', 'required', 'integer', 'min:1'],
            'files_duration' => ['sometimes', 'required', 'integer', 'min:1', 'max:365'],
            'upload_at_once' => ['required', 'integer', 'min:1'],
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                toastr()->error($error);
            }
            return back()->withInput();
        }
        if ($uploadSetting->symbol != "users") {
            $request->status = ($request->has('status')) ? 1 : 0;
        } else {
            $request->status = 1;
        }
        $oneMega = 1048576;
        $request->storage_space = ($request->has('unlimited_storage_space')) ? null : $request->storage_space * $oneMega;
        $request->file_size = ($request->has('unlimited_file_size')) ? null : ($request->file_size * $oneMega);
        $request->files_duration = ($request->has('unlimited_files_duration')) ? null : $request->files_duration;
        $request->password_protection = ($request->has('password_protection')) ? 1 : 0;
        $request->advertisements = ($request->has('advertisements')) ? 1 : 0;
        $update = $uploadSetting->update([
            'status' => $request->status,
            'storage_space' => $request->storage_space,
            'file_size' => $request->file_size,
            'files_duration' => $request->files_duration,
            'password_protection' => $request->password_protection,
            'upload_at_once' => $request->upload_at_once,
            'advertisements' => $request->advertisements,
        ]);
        if ($update) {
            toastr()->success(__('Updated Successfully'));
            return back();
        }
    }
}
