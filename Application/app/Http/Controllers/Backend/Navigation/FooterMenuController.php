<?php

namespace App\Http\Controllers\Backend\Navigation;

use App\Http\Controllers\Controller;
use App\Models\FooterMenu;
use App\Models\Language;
use Illuminate\Http\Request;
use Validator;

class FooterMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('lang')) {
            $language = Language::where('code', $request->lang)->firstOrFail();
            $footerMenuLinks = FooterMenu::where('lang', $language->code)->orderBy('sort_id', 'asc')->get();
            $idsArray = implode(',', $footerMenuLinks->pluck('id')->toArray());
            return view('backend.navigation.footerMenu.index', [
                'footerMenuLinks' => $footerMenuLinks,
                'idsArray' => $idsArray,
                'active' => $language->name,
            ]);
        } else {
            return redirect(url()->current() . '?lang=' . env('DEFAULT_LANGUAGE'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.navigation.footerMenu.create');
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
            'lang' => ['required', 'string', 'max:3'],
            'name' => ['required', 'string', 'max:100', 'unique:footer_menu'],
            'link' => ['required', 'string'],
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
        $countLinks = FooterMenu::get()->count();
        $sortId = $countLinks + 1;
        $createMenu = FooterMenu::create([
            'lang' => $lang->code,
            'name' => $request->name,
            'link' => $request->link,
            'sort_id' => $sortId,
        ]);
        if ($createMenu) {
            toastr()->success(__('Created Successfully'));
            return redirect(route('admin.footerMenu.index') . '?lang=' . $createMenu->lang);
        }
    }

    /**
     *  Sort menu
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sort(Request $request)
    {
        $countLinks = FooterMenu::get()->count();
        if (!$countLinks) {
            toastr()->error(__('This menu is empty'));
            return back();
        }

        if ($request->has('ids')) {
            $arr = explode(',', $request->ids);
            foreach ($arr as $sortOrder => $id) {
                $menu = FooterMenu::find($id);
                $menu->sort_id = $sortOrder;
                $menu->save();
            }
            toastr()->success(__('updated Successfully'));
            return back();
        } else {
            toastr()->error(__('Sorting error'));
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FooterMenu  $footerMenu
     * @return \Illuminate\Http\Response
     */
    public function show(FooterMenu $footerMenu)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FooterMenu  $footerMenu
     * @return \Illuminate\Http\Response
     */
    public function edit(FooterMenu $footerMenu)
    {
        return view('backend.navigation.footerMenu.edit', ['footerMenu' => $footerMenu]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FooterMenu  $footerMenu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FooterMenu $footerMenu)
    {
        $validator = Validator::make($request->all(), [
            'lang' => ['required', 'string', 'max:3'],
            'name' => ['required', 'string', 'max:100', 'unique:footer_menu,name,' . $footerMenu->id],
            'link' => ['required', 'string'],
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
        $updateMenu = $footerMenu->update([
            'lang' => $lang->code,
            'name' => $request->name,
            'link' => $request->link,
        ]);
        if ($updateMenu) {
            toastr()->success(__('Updated Successfully'));
            return back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FooterMenu  $footerMenu
     * @return \Illuminate\Http\Response
     */
    public function destroy(FooterMenu $footerMenu)
    {
        $footerMenu->delete();
        toastr()->success(__('Deleted Successfully'));
        return back();
    }
}
