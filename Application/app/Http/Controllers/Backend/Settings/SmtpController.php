<?php

namespace App\Http\Controllers\Backend\Settings;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;
use Mail;
use Validator;

class SmtpController extends Controller
{
    public function index()
    {
        return view('backend.settings.smtp.index');
    }

    public function update(Request $request)
    {
        if ($request->has('mail_status')) {
            $validator = Validator::make($request->all(), [
                'mail_mailer' => ['required', 'string'],
                'mail_host' => ['required'],
                'mail_port' => ['required', 'numeric'],
                'mail_username' => ['required', 'string'],
                'mail_password' => ['required', 'string'],
                'mail_encryption' => ['required', 'string'],
                'mail_form_email' => ['required', 'string', 'email'],
                'mail_from_name' => ['required', 'string'],
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'mail_mailer' => ['nullable', 'string'],
                'mail_host' => ['nullable'],
                'mail_port' => ['nullable', 'numeric'],
                'mail_username' => ['nullable', 'string'],
                'mail_password' => ['nullable', 'string'],
                'mail_encryption' => ['nullable', 'string'],
                'mail_form_email' => ['nullable', 'string', 'email'],
                'mail_from_name' => ['nullable', 'string'],
            ]);
        }

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {toastr()->error($error);}
            return back();
        }
        $mailer = array('smtp', 'sendmail');
        if (!in_array($request->mail_mailer, $mailer)) {
            toastr()->error(__('Mailer error, please refresh page and try again'));
            return back();
        }
        $encryption = array('tls', 'ssl');
        if (!in_array($request->mail_encryption, $encryption)) {
            toastr()->error(__('Encryption error, please refresh page and try again'));
            return back();
        }

        $request->mail_status = ($request->has('mail_status')) ? 1 : 0;

        $settings = Settings::whereIn('key', [
            'mail_status',
            'mail_mailer',
            'mail_host',
            'mail_port',
            'mail_username',
            'mail_password',
            'mail_encryption',
            'mail_form_email',
            'mail_from_name',
        ])->get();
        foreach ($settings as $setting) {
            $key = $setting->key;
            $setting->value = $request->$key;
            $setting->save();
        }

        setEnv('MAIL_MAILER', $request->mail_mailer);
        setEnv('MAIL_HOST', $request->mail_host);
        setEnv('MAIL_PORT', $request->mail_port);
        setEnv('MAIL_USERNAME', $request->mail_username);
        setEnv('MAIL_PASSWORD', $request->mail_password);
        setEnv('MAIL_ENCRYPTION', $request->mail_encryption);
        setEnv('MAIL_FROM_ADDRESS', $request->mail_form_email);
        setEnv('MAIL_FROM_NAME', $request->mail_from_name);
        toastr()->success(__('Updated Successfully'));
        return back();
    }

    public function test(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {toastr()->error($error);}
            return back()->withInput();
        }
        if (!settings('mail_status')) {
            toastr()->error(__('SMTP is not enabled'));
            return back()->withInput();
        }
        try {
            $email = $request->email;
            Mail::raw('Hi, This is a test mail to ' . $email, function ($message) use ($email) {
                $message->to($email)
                    ->subject('Test mail to ' . $email);
            });
            toastr()->success(__('Sent successfully'));
            return back();
        } catch (\Exception $e) {
            toastr()->error(__('Sending failed'));
            return back();
        }
    }
}
