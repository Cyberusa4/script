<?php

namespace App\Http\Controllers\Backend\Settings;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;
use Validator;

class GeneralController extends Controller
{
    public function index()
    {
        return view('backend.settings.general.index');
    }

    public function update(Request $request)
    {
        $extraValidate = [];
        if (licenceType(2)) {
            $extraValidate = [
                'website_currency' => ['required', 'integer'],
                'expired_subscriptions_files_delete' => ['required', 'integer', 'min:1', 'max:365'],
            ];
        }
        $validator = Validator::make($request->all(), [
            'website_name' => ['required', 'string', 'max:200'],
            'website_url' => ['required', 'url'],
            'website_primary_color' => ['required'],
            'website_secondary_color' => ['required'],
            'website_third_color' => ['required'],
            'website_dark_mode_primary_color' => ['required'],
            'website_dark_mode_secondary_color' => ['required'],
            'website_file_icon_dark_color' => ['required'],
            'website_file_icon_medium_color' => ['required'],
            'website_file_icon_light_color' => ['required'],
            'website_folder_icon_color' => ['required'],
            'website_dark_logo' => ['mimes:png,jpg,jpeg,svg', 'max:2048'],
            'website_light_logo' => ['mimes:png,jpg,jpeg,svg', 'max:2048'],
            'website_favicon' => ['mimes:png,jpg,jpeg,ico', 'max:2048'],
            'website_social_image' => ['mimes:jpg,jpeg', 'image', 'max:2048'],
            'contact_email' => ['required'],
            'terms_of_service_link' => ['nullable', 'url'],
            'date_format' => ['required', 'integer'],
            'timezone' => ['required', 'string'],
            'website_chunk_size' => ['required', 'integer', 'min:1'],
            'website_download_waiting_time' => ['required', 'integer', 'min:0'],
        ] + $extraValidate);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {toastr()->error($error);}
            return back();
        }
        if ($request->has('website_dark_logo')) {
            $filename = 'dark-logo';
            $darkLogo = vFileUpload($request->file('website_dark_logo'), 'images/', $filename, settings('website_dark_logo'));
            Settings::updateSettings('website_dark_logo', $darkLogo);
        }
        if ($request->has('website_light_logo')) {
            $filename = 'light-logo';
            $lightLogo = vFileUpload($request->file('website_light_logo'), 'images/', $filename, settings('website_light_logo'));
            Settings::updateSettings('website_light_logo', $lightLogo);
        }
        if ($request->has('website_favicon')) {
            $filename = 'favicon';
            $favicon = vFileUpload($request->file('website_favicon'), 'images/', $filename, settings('website_favicon'));
            Settings::updateSettings('website_favicon', $favicon);
        }
        if ($request->has('website_social_image')) {
            $filename = 'social-image';
            $ogImage = vImageUpload($request->file('website_social_image'), 'images/', '600x315', $filename, settings('website_social_image'));
            Settings::updateSettings('website_social_image', $ogImage);
        }

        if ($request->has('website_email_verify_status') && !settings('mail_status')) {
            toastr()->error(__('SMTP is not enabled'));
            return back()->withInput();
        }

        if ($request->has('website_contact_form_status') && !settings('mail_status')) {
            toastr()->error(__('SMTP is not enabled'));
            return back()->withInput();
        }

        if ($request->has('website_contact_form_status') && !settings('contact_email')) {
            toastr()->error(__('Contact form require contact email'));
            return back()->withInput();
        }

        $request->website_email_verify_status = ($request->has('website_email_verify_status')) ? 1 : 0;
        $request->website_registration_status = ($request->has('website_registration_status')) ? 1 : 0;
        $request->website_force_ssl_status = ($request->has('website_force_ssl_status')) ? 1 : 0;
        $request->website_cookie = ($request->has('website_cookie')) ? 1 : 0;
        $request->website_blog_status = ($request->has('website_blog_status')) ? 1 : 0;
        $request->website_faq_status = ($request->has('website_faq_status')) ? 1 : 0;
        $request->website_contact_form_status = ($request->has('website_contact_form_status')) ? 1 : 0;
        $request->website_download_page_blog_posts_status = ($request->has('website_download_page_blog_posts_status')) ? 1 : 0;

        if (!array_key_exists($request->date_format, dateFormatsArray())) {
            toastr()->error(__('Invalid date format'));
            return back();
        }

        if (!array_key_exists($request->timezone, timezonesArray())) {
            toastr()->error(__('Invalid timezone'));
            return back();
        }

        if (licenceType(2)) {
            if (!array_key_exists($request->expired_subscriptions_files_delete, timesArr())) {
                toastr()->error(__('Invalid expired subscriptions files delete time'));
                return back();
            }
            if (!array_key_exists($request->website_currency, currencies())) {
                toastr()->error(__('Invalid currency'));
                return back();
            }
        } else {
            $request->expired_subscriptions_files_delete = settings('expired_subscriptions_files_delete');
            $request->website_currency = settings('website_currency');
        }

        $settings = Settings::whereIn('key', [
            'website_name',
            'website_url',
            'website_primary_color',
            'website_secondary_color',
            'website_third_color',
            'website_dark_mode_primary_color',
            'website_dark_mode_secondary_color',
            'website_file_icon_dark_color',
            'website_file_icon_medium_color',
            'website_file_icon_light_color',
            'website_folder_icon_color',
            'website_email_verify_status',
            'website_registration_status',
            'website_force_ssl_status',
            'website_blog_status',
            'website_faq_status',
            'website_contact_form_status',
            'contact_email',
            'terms_of_service_link',
            'website_cookie',
            'date_format',
            'timezone',
            'website_currency',
            'expired_subscriptions_files_delete',
            'unacceptable_file_types',
            'default_folders',
            'website_chunk_size',
            'website_download_waiting_time',
            'website_download_page_blog_posts_status',
        ])->get();
        foreach ($settings as $setting) {
            $key = $setting->key;
            $setting->value = $request->$key;
            $setting->save();
        }
        setEnv('APP_URL', $request->website_url);
        setEnv('APP_TIMEZONE', '"' . $request->timezone . '"');
        $colorsFile = 'assets/css/extra/colors.css';
        if (!file_exists($colorsFile)) {
            fopen($colorsFile, "w");
        }
        $colors = "
        :root {
            --primaryColor: " . $request->website_primary_color . ";
            --secondaryColor: " . $request->website_secondary_color . ";
            --thirdColor:" . $request->website_third_color . ";
            --fm--primaryColor: " . $request->website_dark_mode_primary_color . ";
            --fm--secondaryColor: " . $request->website_dark_mode_secondary_color . ";
            --iconColor: " . $request->website_file_icon_dark_color . ";
            --iconColorOp: " . $request->website_file_icon_medium_color . ";
            --iconColorOp2: " . $request->website_file_icon_light_color . ";
            --folderColor: " . $request->website_folder_icon_color . ";
        }
        ";
        file_put_contents($colorsFile, $colors);
        toastr()->success(__('Updated Successfully'));
        return back();
    }
}
