<?php

namespace App\Http\Controllers\Backend\Others;

use App\Http\Controllers\Controller;
use App\Models\Additional;
use Illuminate\Http\Request;

class DownloadPageController extends Controller
{
    public function index()
    {
        return view('backend.others.downloadPage.index');
    }

    public function update(Request $request)
    {
        $request->download_page_center_section_status = ($request->has('download_page_center_section_status')) ? 1 : 0;
        $request->download_page_bottom_section_status = ($request->has('download_page_bottom_section_status')) ? 1 : 0;
        $additionals = Additional::whereIn('key', [
            'download_page_center_section_status',
            'download_page_center_section_title',
            'download_page_center_section_content',
            'download_page_bottom_section_status',
            'download_page_bottom_section_title',
            'download_page_bottom_section_content',
        ])->get();
        foreach ($additionals as $additional) {
            $key = $additional->key;
            $additional->value = $request->$key;
            $additional->save();
        }
        toastr()->success(__('Updated Successfully'));
        return back();
    }
}
