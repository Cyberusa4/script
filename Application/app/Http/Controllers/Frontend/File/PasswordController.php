<?php

namespace App\Http\Controllers\Frontend\File;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\File\DownloadController;
use App\Models\FileEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use Validator;

class PasswordController extends Controller
{
    private $sources = ['preview', 'download'];
    private $previwedTypes = ['image', 'pdf'];

    public function index(Request $request, $shared_id)
    {
        $fileEntry = FileEntry::where('shared_id', $shared_id)->notExpired()->firstOrFail();
        abort_if(!DownloadController::accessCheck($fileEntry), 404);
        if (is_null($fileEntry->password)) {
            return redirect()->route('file.download', $fileEntry->shared_id);
        }
        if (Session::has(filePasswordSession($fileEntry->shared_id))) {
            $password = decrypt(Session::get(filePasswordSession($fileEntry->shared_id)));
            if ($password == $fileEntry->password) {
                return redirect()->route('file.download', $fileEntry->shared_id);
            }
        }
        if (!$request->has('source')) {
            return redirect()->route('file.download', $fileEntry->shared_id);
        }
        abort_if(!in_array($request->source, $this->sources), 401);
        if ($request->source == $this->sources[0]) {
            abort_if(!in_array($fileEntry->type, $this->previwedTypes), 404);
        }
        return view('frontend.file.password', ['fileEntry' => $fileEntry]);
    }

    public function unlock(Request $request, $shared_id)
    {
        $validator = Validator::make($request->all(), [
            'password' => ['required'],
            '_source' => ['required'],
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                toastr()->error($error);
            }
            return back()->withInput();
        }
        if (!in_array($request->_source, $this->sources)) {
            toastr()->error(lang('Unauthorized action', 'alerts'));
            return back();
        }
        $fileEntry = FileEntry::where('shared_id', $shared_id)->where('password', '!=', null)->notExpired()->first();
        if (is_null($fileEntry) || !DownloadController::accessCheck($fileEntry)) {
            toastr()->error(lang('Unauthorized action', 'alerts'));
            return back();
        }
        if (is_null($fileEntry->password)) {
            return redirect()->route('file.download', $fileEntry->shared_id);
        }
        if ($request->_source == $this->sources[0]) {
            $callback = route('file.preview', $fileEntry->shared_id);
        } else {
            $callback = route('file.download', $fileEntry->shared_id);
        }
        if (Hash::check($request->password, $fileEntry->password)) {
            $request->session()->put(filePasswordSession($fileEntry->shared_id), encrypt($fileEntry->password));
            return redirect($callback);
        } else {
            toastr()->error(lang('Incorrect password', 'file password'));
            return back();
        }
    }
}
