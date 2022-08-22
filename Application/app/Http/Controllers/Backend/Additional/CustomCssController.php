<?php

namespace App\Http\Controllers\Backend\Additional;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomCssController extends Controller
{
    public function index()
    {
        $cssFile = @file_get_contents('assets/css/extra/custom.css');
        return view('backend.additional.custom-css', ['cssFile' => $cssFile]);
    }

    public function update(Request $request)
    {
        $cssFile = 'assets/css/extra/custom.css';
        if (!file_exists($cssFile)) {
            fopen($cssFile, "w");
        }
        file_put_contents($cssFile, $request->cssContent);
        toastr()->success(__('Updated Successfully'));
        return back();
    }
}
