<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;

class SettingsController extends Controller
{
    protected function user()
    {
        $user = User::find(userAuthInfo()->id);
        $user['name'] = $user->firstname . ' ' . $user->lastname;
        return $user;
    }

    public function index()
    {
        return view('frontend.user.settings.index', ['user' => $this->user()]);
    }

    public function detailsUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => ['required', 'string', 'max:50'],
            'lastname' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users,email,' . $this->user()->id],
            'address_1' => ['required', 'string', 'max:255'],
            'address_2' => ['nullable', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:150'],
            'state' => ['required', 'string', 'max:150'],
            'zip' => ['required', 'string', 'max:100'],
            'country' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                toastr()->error($error);
            }
            return back();
        }

        $findCountry = Country::find($request->country);
        if ($findCountry == null) {
            toastr()->error(lang('Country not exists', 'alerts'));
            return back()->withInput();
        }

        $verify = (settings('website_email_verify_status') && $this->user()->email != $request->email) ? 1 : 0;

        $address = [
            'address_1' => $request->address_1,
            'address_2' => $request->address_2,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'country' => $findCountry->name,
        ];
        $user = User::find($this->user()->id);

        if ($request->has('avatar')) {
            if ($this->user()->avatar == 'images/avatars/default.png') {
                $uploadAvatar = vImageUpload($request->file('avatar'), 'images/avatars/users/', '110x110');
            } else {
                $uploadAvatar = vImageUpload($request->file('avatar'), 'images/avatars/users/', '110x110', null, $this->user()->avatar);
            }
        } else {
            $uploadAvatar = $this->user()->avatar;
        }

        $updateUser = $user->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'address' => $address,
            'avatar' => $uploadAvatar,
        ]);

        if ($updateUser) {
            if ($verify) {
                $user->forceFill([
                    'email_verified_at' => null,
                ])->save();
                $user->sendEmailVerificationNotification();
                Session::put('email_change', true);
            }
            toastr()->success(lang('Account details has been updated successfully', 'alerts'));
            return back();
        }
    }

    public function mobileUpdate(Request $request)
    {
        $findMobileCode = Country::find($request->mobile_code);
        if ($findMobileCode == null) {
            toastr()->error(lang('Phone code not exsits', 'alerts'));
            return back();
        }
        if ($findMobileCode->name != @$this->user()->address->country) {
            toastr()->error(lang('Phone number must be in the same country where you located', 'alerts'));
            return back();
        }
        $request->mobile = $findMobileCode->phone . $request->mobile;
        if ($request->mobile == $this->user()->mobile) {
            toastr()->error(lang('You must to change the phone number to make a change', 'alerts'));
            return back();
        }
        $validator = Validator::make($request->all(), [
            'mobile_code' => ['required', 'numeric'],
            'mobile' => ['required', 'numeric', 'unique:users,mobile,' . $this->user()->id],
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                toastr()->error($error);
            }
            return back();
        }
        $existMobile = User::where([['mobile', $request->mobile], ['id', '!=', $this->user()->id]])->first();
        if ($existMobile) {
            toastr()->error(lang('Phone number already exist', 'alerts'));
            return back();
        }
        $update = User::where('id', $this->user()->id)->update(['mobile' => $request->mobile]);
        if ($update) {
            toastr()->success(lang('Phone number has been changed successfully', 'alerts'));
            return back();
        }
    }

    public function password()
    {
        return view('frontend.user.settings.password', ['user' => $this->user()]);
    }

    public function passwordUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current-password' => ['required'],
            'new-password' => ['required', 'string', 'min:8', 'confirmed'],
            'new-password_confirmation' => ['required'],
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                toastr()->error($error);
            }
            return back();
        }
        if (!(Hash::check($request->get('current-password'), $this->user()->password))) {
            toastr()->error(lang('Your current password does not matches with the password you provided', 'alerts'));
            return back();
        }
        if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            toastr()->error(lang('New Password cannot be same as your current password. Please choose a different password', 'alerts'));
            return back();
        }
        $update = User::where('id', $this->user()->id)->update([
            'password' => bcrypt($request->get('new-password')),
        ]);
        if ($update) {
            toastr()->success(lang('Account password has been changed successfully', 'alerts'));
            return back();
        }
    }

    public function towFactor()
    {
        $QR_Image = null;
        if (!$this->user()->google2fa_status) {
            $google2fa = app('pragmarx.google2fa');
            $secretKey = encrypt($google2fa->generateSecretKey());
            User::where('id', $this->user()->id)->update(['google2fa_secret' => $secretKey]);
            $QR_Image = $google2fa->getQRCodeInline(settings('website_name'), $this->user()->email, $this->user()->google2fa_secret);
        }
        return view('frontend.user.settings.2fa', ['user' => $this->user(), 'QR_Image' => $QR_Image]);
    }

    public function towFactorEnable(Request $request)
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
        $update2FaStatus = User::where('id', $this->user()->id)->update(['google2fa_status' => true]);
        if ($update2FaStatus) {
            Session::put('2fa', $this->user()->id);
            toastr()->success(lang('2FA Authentication has been enabled successfully', 'alerts'));
            return back();
        }

    }

    public function towFactorDisable(Request $request)
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
        $update2FaStatus = User::where('id', $this->user()->id)->update(['google2fa_status' => false]);
        if ($update2FaStatus) {
            if ($request->session()->has('2fa')) {
                Session::forget('2fa');
            }
            toastr()->success(lang('2FA Authentication has been disabled successfully', 'alerts'));
            return back();
        }
    }
}
