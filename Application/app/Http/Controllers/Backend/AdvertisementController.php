<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    public function index()
    {
        $advertisements = Advertisement::all();
        $headAd = Advertisement::where('symbol', 'head_code')->first();
        return view('backend.advertisements.index', ['advertisements' => $advertisements, 'headAd' => $headAd]);
    }

    public function edit($id)
    {
        $advertisement = Advertisement::findOrFail($id);
        return view('backend.advertisements.edit', ['advertisement' => $advertisement]);
    }

    public function update(Request $request, $id)
    {
        if ($request->has('status') && is_null($request->code)) {
            toastr()->error(__('Advertisement code cannot be empty'));
            return back();
        }
        $request->status = ($request->has('status')) ? 1 : 0;
        $update = Advertisement::where('id', $id)->update([
            'code' => $request->code,
            'status' => $request->status,
        ]);
        if ($update) {
            toastr()->success(__('Updated Successfully'));
            return back();
        }
    }
}
