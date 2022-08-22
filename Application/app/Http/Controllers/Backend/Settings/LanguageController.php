<?php

namespace App\Http\Controllers\Backend\Settings;

use App\Http\Controllers\Controller;
use App\Models\BlogArticle;
use App\Models\Feature;
use App\Models\Language;
use App\Models\MailTemplate;
use App\Models\Translate;
use Illuminate\Http\Request;
use Validator;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages = Language::withCount(['translates' => function ($query) {
            $query->where('value', null)->whereIn('licence_type', $this->getTranslatesByLicence());
        }])->get();
        return view('backend.settings.languages.index', ['languages' => $languages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.settings.languages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:150'],
            'native' => ['required', 'string', 'max:150'],
            'code' => ['required', 'string', 'max:10', 'min:2', 'unique:languages'],
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                toastr()->error($error);
            }
            return back()->withInput();
        }
        if (!array_key_exists($request->code, languages())) {
            toastr()->error(__('Something went wrong please try again'));
            return back();
        }
        $create = Language::create([
            'name' => $request->name,
            'native' => $request->native,
            'code' => $request->code,
        ]);
        if ($create) {
            if ($create) {
                $translates = Translate::where('lang', env('DEFAULT_LANGUAGE'))->get();
                $mailtemplates = MailTemplate::where('lang', env('DEFAULT_LANGUAGE'))->get();
                foreach ($translates as $translate) {
                    $value = ($request->code == "en") ? $translate->key : null;
                    $lang = new Translate();
                    $lang->lang = $request->code;
                    $lang->licence_type = $translate->licence_type;
                    $lang->group_name = $translate->group_name;
                    $lang->key = $translate->key;
                    $lang->value = $value;
                    $lang->save();
                }
                foreach ($mailtemplates as $mailtemplate) {
                    $value = ($request->code == "en") ? $mailtemplate->key : null;
                    $mailtemplateTrans = new MailTemplate();
                    $mailtemplateTrans->lang = $request->code;
                    $mailtemplateTrans->licence_type = $mailtemplate->licence_type;
                    $mailtemplateTrans->group_name = $mailtemplate->group_name;
                    $mailtemplateTrans->key = $mailtemplate->key;
                    $mailtemplateTrans->value = $value;
                    $mailtemplateTrans->save();
                }
                if ($request->has('is_default')) {
                    setEnv('DEFAULT_LANGUAGE', removeSpaces($create->code));
                }
                toastr()->success(__('Created Successfully'));
                return redirect()->route('language.translate', $create->code);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function show(Language $language)
    {
        return abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  $lang Language code
     * @param  $group Translate group
     * @return \Illuminate\Http\Response
     */
    public function translate(Request $request, $code, $group = null)
    {
        $language = Language::where('code', $code)->firstOrFail();
        if ($request->input('search')) {
            $q = $request->input('search');
            $groups = collect([
                (object) ["group_name" => "Search results"],
            ]);
            $translates = Translate::where(function ($query) {
                $query->whereIn('licence_type', $this->getTranslatesByLicence());
            })->where(function ($query) use ($q, $language) {
                $query->where([['lang', $language->code], ['key', 'like', '%' . $q . '%']])
                    ->OrWhere([['lang', $language->code], ['value', 'like', '%' . $q . '%']])
                    ->OrWhere([['lang', $language->code], ['group_name', 'like', '%' . $q . '%']]);
            })->orderbyDesc('id')->get();
            $active = "Search results";
        } elseif ($request->input('filter')) {
            abort_if($request->input('filter') != 'missing', 404);
            $groups = collect([
                (object) ["group_name" => "missing translations"],
            ]);
            $translates = Translate::where([['lang', $language->code], ['value', null]])->whereIn('licence_type', $this->getTranslatesByLicence())->orderby('group_name')->get();
            $active = "missing translations";
        } else {
            $groups = Translate::where('lang', $language->code)->select('group_name')->whereIn('licence_type', $this->getTranslatesByLicence())->distinct()->get();
            if ($group != null) {
                $group = str_replace('-', ' ', $group);
                $translates = Translate::where([['lang', $code], ['group_name', $group]])->whereIn('licence_type', $this->getTranslatesByLicence())->get();
                abort_if($translates->count() < 1, 404);
                $active = $group;
            } else {
                $translates = Translate::where([['lang', $language->code], ['group_name', 'general']])->whereIn('licence_type', $this->getTranslatesByLicence())->get();
                $active = "general";
            }
        }
        $translates_count = Translate::where([['lang', $language->code], ['value', null]])->whereIn('licence_type', $this->getTranslatesByLicence())->count();
        return view('backend.settings.languages.translate', [
            'active' => $active,
            'translates' => $translates,
            'groups' => $groups,
            'language' => $language,
            'translates_count' => $translates_count,
        ]);
    }

    /**
     * Update the translate.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function translateUpdate(Request $request, $id)
    {
        $language = Language::where('id', $id)->first();
        if ($language == null) {
            toastr()->error(__('Something went wrong please try again'));
            return back();
        }
        foreach ($request->values as $id => $value) {
            $translation = Translate::where('id', $id)->whereIn('licence_type', $this->getTranslatesByLicence())->first();
            if ($translation != null) {
                $translation->value = $value;
                $translation->save();
            }
        }
        toastr()->success(__('Updated Successfully'))->info(__('Clear the cache to take effect'));
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function edit(Language $language)
    {
        return view('backend.settings.languages.edit', ['language' => $language]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Language $language)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:150'],
            'native' => ['required', 'string', 'max:150'],
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                toastr()->error($error);
            }
            return back()->withInput();
        }
        if (!$request->has('is_default')) {
            if ($language->code == env('DEFAULT_LANGUAGE')) {
                toastr()->error(__($language->name . ' is default language'));
                return back();
            }
        }
        $update = Language::where('id', $language->id)->update([
            'name' => $request->name,
            'native' => $request->native,
        ]);
        if ($update) {
            if ($request->has('is_default')) {
                setEnv('DEFAULT_LANGUAGE', removeSpaces($language->code));
            }
            toastr()->success(__('Updated Successfully'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id language ID
     * @return \Illuminate\Http\Response
     */
    public function setDefault($id)
    {
        $language = Language::find(decrypt($id));
        if ($language != null) {
            if (env('DEFAULT_LANGUAGE') == $language->code) {
                toastr()->error(__('Language already marked as default'));
                return back();
            } else {
                setEnv('DEFAULT_LANGUAGE', removeSpaces($language->code));
                toastr()->success(__('Default language updated Successfully'));
                return back();
            }
        } else {
            toastr()->error(__('language not exists'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function destroy(Language $language)
    {
        if ($language->code == env('DEFAULT_LANGUAGE')) {
            toastr()->error(__('Default language cannot be deleted'));
            return back();
        }
        $articles = BlogArticle::where('lang', $language->code)->get();
        if ($articles->count() > 0) {
            foreach ($articles as $article) {
                removeFile($article->image);
            }
        }
        $features = Feature::where('lang', $language->code)->get();
        if ($features->count() > 0) {
            foreach ($features as $feature) {
                removeFile($feature->image);
            }
        }
        $language->delete();
        toastr()->success(__('Deleted Successfully'));
        return back();
    }

    private function getTranslatesByLicence()
    {
        return licenceType(2) ? [1, 2] : [1];
    }
}
