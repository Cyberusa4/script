<?php

namespace App\Http\Controllers\Backend\Settings;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\MailTemplate;
use App\Models\Settings;
use Illuminate\Http\Request;
use Validator;

class MailTemplateController extends Controller
{
    public function redirect()
    {
        return redirect()->route('admin.settings.mailtemplates.show', env('DEFAULT_LANGUAGE'));
    }

    public function index(Request $request, $lang, $group = null)
    {
        if ($request->has('lang')) {
            return redirect()->route('admin.settings.mailtemplates.show', $request->lang);
        }
        $language = Language::where('code', $lang)->firstOrFail();
        $groups = MailTemplate::where('lang', $language->code)->whereIn('licence_type', $this->getMailTemplatesByLicence())->select('group_name')->distinct()->get();
        if ($group != null) {
            $group = str_replace('-', ' ', $group);
            $mailtemplates = MailTemplate::where([['lang', $language->code], ['group_name', $group]])->whereIn('licence_type', $this->getMailTemplatesByLicence())->get();
            abort_if($mailtemplates->count() < 1, 404);
            $activeGroup = $group;
        } else {
            $firstMailtemplate = MailTemplate::where('lang', $language->code)->whereIn('licence_type', $this->getMailTemplatesByLicence())->first();
            $mailtemplates = MailTemplate::where([['lang', $language->code], ['group_name', $firstMailtemplate->group_name]])->whereIn('licence_type', $this->getMailTemplatesByLicence())->get();
            $activeGroup = $firstMailtemplate->group_name;
        }
        return view('backend.settings.mailtemplates.index', [
            'mailtemplates' => $mailtemplates,
            'groups' => $groups,
            'activeGroup' => $activeGroup,
            'language' => $language,
            'active' => $language->name,
        ]);
    }

    public function update(Request $request, $lang, $group)
    {
        $group = str_replace('-', ' ', $group);
        $language = Language::where('code', $lang)->first();
        if (is_null($language)) {
            toastr()->error(__('Something went wrong please try again'));
            return back();
        }
        foreach ($request->values as $id => $value) {
            $mailtemplate = MailTemplate::where([['id', $id], ['lang', $language->code], ['group_name', $group]])->whereIn('licence_type', $this->getMailTemplatesByLicence())->first();
            if (!is_null($mailtemplate)) {
                $mailtemplate->value = $value;
                $mailtemplate->save();
            }
        }
        toastr()->success(__('Updated Successfully'));
        return back();
    }

    public function updateSettings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'website_mail_logo' => ['mimes:png,jpg,jpeg', 'image', 'max:2048'],
            'website_mail_primary_color' => ['required'],
            'website_mail_background_color' => ['required'],
            'website_mail_normal_text_color' => ['required'],
            'website_mail_bold_text_color' => ['required'],
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {toastr()->error($error);}
            return back();
        }
        if ($request->has('website_mail_logo')) {
            $filename = 'mail-logo';
            $mailLogo = vFileUpload($request->file('website_mail_logo'), 'images/', $filename, settings('website_mail_logo'));
            Settings::updateSettings('website_mail_logo', $mailLogo);
        }
        $settings = Settings::whereIn('key', [
            'website_mail_primary_color',
            'website_mail_background_color',
            'website_mail_normal_text_color',
            'website_mail_bold_text_color',
        ])->get();
        foreach ($settings as $setting) {
            $key = $setting->key;
            $setting->value = $request->$key;
            $setting->save();
        }
        toastr()->success(__('Updated Successfully'));
        return back();
    }

    private function getMailTemplatesByLicence()
    {
        return licenceType(2) ? [1, 2] : [1];
    }
}
