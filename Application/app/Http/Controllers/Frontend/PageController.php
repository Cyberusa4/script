<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Methods\ReCaptchaValidation;
use App\Models\Faq;
use App\Models\Page;
use Illuminate\Http\Request;
use Validator;

class PageController extends Controller
{
    public function pages($slug)
    {
        $page = Page::where([['slug', $slug], ['lang', getLang()]])->first();
        if ($page) {
            $page->increment('views');
            return view('frontend.page', ['page' => $page]);
        } else {
            return redirect()->route('home');
        }
    }

    public function faq()
    {
        $faqs = Faq::where('lang', getLang())->paginate(12);
        abort_if(count($faqs) < 1 || !settings('website_faq_status'), 404);
        return view('frontend.faq', ['faqs' => $faqs]);
    }

    public function contact()
    {
        abort_if(!settings('website_contact_form_status'), 404);
        return view('frontend.contact');
    }

    public function contactSend(Request $request)
    {
        if (!settings('website_contact_form_status') or !settings('mail_status')) {
            return response()->json(['error' => lang('Sending emails is not available right now', 'alerts')]);
        }
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ] + ReCaptchaValidation::validate());
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                return response()->json(['error' => $error]);
            }
        }
        try {
            $name = $request->name;
            $email = $request->email;
            $subject = $request->subject;
            $msg = allowBr($request->message);
            \Mail::send([], [], function ($message) use ($msg, $email, $subject, $name) {
                $message->to(settings('contact_email'))
                    ->from(env('MAIL_FROM_ADDRESS'), $name)
                    ->replyTo($email)
                    ->subject($subject)
                    ->setBody($msg, 'text/html');
            });
            return response()->json(['success' => lang('Your message has been sent successfully', 'alerts')]);
        } catch (\Exception $e) {
            return response()->json(['error' => lang('Error on sending', 'alerts')]);
        }
    }
}
