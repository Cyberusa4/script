<?php

namespace App\Http\Controllers\Backend\Settings;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\SeoConfiguration;
use Illuminate\Http\Request;
use Validator;

class SeoController extends Controller
{
    private $robots_index_array = ['index', 'noindex'];
    private $robots_follow_links_array = ['follow', 'nofollow'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.settings.seo.index', ['configurations' => SeoConfiguration::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $languages = Language::orderbyDesc('id')->get();
        return view('backend.settings.seo.create', ['languages' => $languages]);
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
            'lang' => ['required', 'string', 'unique:seo_configurations'],
            'title' => ['required', 'string', 'max:70'],
            'description' => ['required', 'string', 'max:150'],
            'keywords' => ['required', 'string', 'max:255'],
            'robots_index' => ['required', 'string', 'max:50'],
            'robots_follow_links' => ['required', 'string', 'max:50'],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                toastr()->error($error);
            }
            return back()->withInput();
        }

        $lang = Language::where('code', $request->lang)->first();
        if ($lang == null) {
            toastr()->error(__('Language not exists'));
            return back();
        }

        if (!in_array($request->robots_index, $this->robots_index_array)) {
            toastr()->error(__('Something went wrong please try again'));
            return back();
        }

        if (!in_array($request->robots_follow_links, $this->robots_follow_links_array)) {
            toastr()->error(__('Something went wrong please try again'));
            return back();
        }

        $create = SeoConfiguration::create([
            'lang' => $lang->code,
            'title' => $request->title,
            'description' => $request->description,
            'keywords' => $request->keywords,
            'robots_index' => $request->robots_index,
            'robots_follow_links' => $request->robots_follow_links,
        ]);

        if ($create) {
            toastr()->success(__('Created Successfully'));
            return redirect()->route('seo.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SeoConfiguration  $seoConfiguration
     * @return \Illuminate\Http\Response
     */
    public function show(SeoConfiguration $seo)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SeoConfiguration  $seoConfiguration
     * @return \Illuminate\Http\Response
     */
    public function edit(SeoConfiguration $seo)
    {
        $languages = Language::orderbyDesc('id')->get();
        return view('backend.settings.seo.edit', ['languages' => $languages, 'configuration' => $seo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SeoConfiguration  $seoConfiguration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SeoConfiguration $seo)
    {
        $validator = Validator::make($request->all(), [
            'lang' => ['required', 'string', 'unique:seo_configurations,lang,' . $seo->id],
            'title' => ['required', 'string', 'max:70'],
            'description' => ['required', 'string', 'max:150'],
            'keywords' => ['required', 'string', 'max:255'],
            'robots_index' => ['required', 'string', 'max:50'],
            'robots_follow_links' => ['required', 'string', 'max:50'],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                toastr()->error($error);
            }
            return back();
        }

        $lang = Language::where('code', $request->lang)->first();
        if ($lang == null) {
            toastr()->error(__('Language not exists'));
            return back();
        }

        if (!in_array($request->robots_index, $this->robots_index_array)) {
            toastr()->error(__('Something went wrong please try again'));
            return back();
        }

        if (!in_array($request->robots_follow_links, $this->robots_follow_links_array)) {
            toastr()->error(__('Something went wrong please try again'));
            return back();
        }

        $update = $seo->update([
            'lang' => $lang->code,
            'title' => $request->title,
            'description' => $request->description,
            'keywords' => $request->keywords,
            'robots_index' => $request->robots_index,
            'robots_follow_links' => $request->robots_follow_links,
        ]);

        if ($update) {
            toastr()->success(__('Updated Successfully'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SeoConfiguration  $seoConfiguration
     * @return \Illuminate\Http\Response
     */
    public function destroy(SeoConfiguration $seo)
    {
        $seo->delete();
        toastr()->success(__('Deleted Successfully'));
        return back();
    }
}
