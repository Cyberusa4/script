<?php

namespace App\Http\Controllers\Backend\Navigation;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\NavbarMenu;
use Illuminate\Http\Request;
use Validator;

class NavbarMenuController extends Controller
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
            if (licenceType(2)) {
                $navbarMenuLinks = NavbarMenu::where('lang', $language->code)->orderBy('sort_id', 'asc')->get();
            } else {
                $navbarMenuLinks = NavbarMenu::where([['lang', $language->code], ['link', '!=', '#pricing']])->orderBy('sort_id', 'asc')->get();
            }
            $idsArray = implode(',', $navbarMenuLinks->pluck('id')->toArray());
            return view('backend.navigation.navbarMenu.index', [
                'navbarMenuLinks' => $navbarMenuLinks,
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
        return view('backend.navigation.navbarMenu.create');
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
            'page' => ['required', 'boolean'],
            'name' => ['required', 'string', 'max:100'],
            'type' => ['required', 'boolean'],
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
        if ($request->type == 1) {
            if ($request->page != 0) {
                toastr()->error(__('Targeting section can only used in home page'));
                return back();
            }
            if (licenceType(2)) {
                $arr = ['#features', '#pricing', '#blog', '#faq', '#contact'];
            } else {
                $arr = ['#features', '#blog', '#faq', '#contact'];
            }
            if (!in_array($request->link, $arr)) {
                toastr()->error(__('Trageting section error'));
                return back();
            }
        }
        $countLinks = NavbarMenu::get()->count();
        $sortId = $countLinks + 1;
        $createMenu = NavbarMenu::create([
            'lang' => $lang->code,
            'page' => $request->page,
            'name' => $request->name,
            'type' => $request->type,
            'link' => $request->link,
            'sort_id' => $sortId,
        ]);
        if ($createMenu) {
            toastr()->success(__('Created Successfully'));
            return redirect(route('admin.navbarMenu.index') . '?lang=' . $createMenu->lang);
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
        $countLinks = NavbarMenu::get()->count();
        if (!$countLinks) {
            toastr()->error(__('This menu is empty'));
            return back();
        }

        if ($request->has('ids')) {
            $arr = explode(',', $request->ids);
            foreach ($arr as $sortOrder => $id) {
                $menu = NavbarMenu::find($id);
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
     * @param  \App\Models\NavbarMenu  $navbarMenu
     * @return \Illuminate\Http\Response
     */
    public function show(NavbarMenu $navbarMenu)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NavbarMenu  $navbarMenu
     * @return \Illuminate\Http\Response
     */
    public function edit(NavbarMenu $navbarMenu)
    {
        abort_if(licenceType(1) && $navbarMenu->link == "#pricing", 404);
        return view('backend.navigation.navbarMenu.edit', ['navbarMenu' => $navbarMenu]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NavbarMenu  $navbarMenu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NavbarMenu $navbarMenu)
    {
        $validator = Validator::make($request->all(), [
            'lang' => ['required', 'string', 'max:3'],
            'page' => ['required', 'boolean'],
            'name' => ['required', 'string', 'max:100'],
            'type' => ['required', 'boolean'],
            'link' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                toastr()->error($error);
            }
            return back();
        }
        if ($request->type == 1) {
            if ($request->page != 0) {
                toastr()->error(__('Targeting section can only used in home page'));
                return back();
            }
            if (licenceType(2)) {
                $arr = ['#features', '#pricing', '#blog', '#faq', '#contact'];
            } else {
                $arr = ['#features', '#blog', '#faq', '#contact'];
            }
            if (!in_array($request->link, $arr)) {
                toastr()->error(__('Trageting section error'));
                return back();
            }
        }
        $lang = Language::where('code', $request->lang)->first();
        if ($lang == null) {
            toastr()->error(__('Language not exists'));
            return back();
        }
        $updateMenu = $navbarMenu->update([
            'lang' => $lang->code,
            'page' => $request->page,
            'name' => $request->name,
            'type' => $request->type,
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
     * @param  \App\Models\NavbarMenu  $navbarMenu
     * @return \Illuminate\Http\Response
     */
    public function destroy(NavbarMenu $navbarMenu)
    {
        $navbarMenu->delete();
        toastr()->success(__('Deleted Successfully'));
        return back();
    }
}
