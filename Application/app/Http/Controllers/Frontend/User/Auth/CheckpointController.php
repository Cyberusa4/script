<?php

namespace App\Http\Controllers\Frontend\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

class CheckpointController extends Controller
{
    protected function user()
    {
        $user = User::find(userAuthInfo()->id);
        return $user;
    }

    public function show2FaVerifyForm()
    {
        if ($this->user()->google2fa_status) {
            if (Session::has('2fa')) {
                return redirect()->route('filemanager.index');
            }
        } else {
            return redirect()->route('filemanager.index');
        }
        return view('frontend.user.auth.checkpoint.2fa');
    }

    public function verify2fa(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp_code' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                toastr()->error($error);
            }
            return back();
        }
        $google2fa = app('pragmarx.google2fa');
        $valid = $google2fa->verifyKey($this->user()->google2fa_secret, $request->otp_code);
        if ($valid == false) {
            toastr()->error(lang('Invalid OTP code', 'alerts'));
            return back();
        }
        Session::put('2fa', $this->user()->id);
        return redirect()->route('filemanager.index');
    }
}
