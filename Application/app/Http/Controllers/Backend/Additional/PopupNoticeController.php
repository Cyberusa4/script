<?php

namespace App\Http\Controllers\Backend\Additional;

use App\Http\Controllers\Controller;
use App\Models\Additional;
use Illuminate\Http\Request;

class PopupNoticeController extends Controller
{
    public function index()
    {
        return view('backend.additional.popup-notice');
    }

    public function update(Request $request)
    {
        $request->popup_notice_status = ($request->has('popup_notice_status')) ? 1 : 0;
        $additionals = Additional::whereIn('key', ['popup_notice_status', 'popup_notice_description'])->get();
        foreach ($additionals as $additional) {
            $key = $additional->key;
            $additional->value = $request->$key;
            $additional->save();
        }
        toastr()->success(__('Updated Successfully'));
        return back();
    }
}
