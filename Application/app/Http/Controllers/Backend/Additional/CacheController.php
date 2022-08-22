<?php

namespace App\Http\Controllers\Backend\Additional;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class CacheController extends Controller
{
    public function index()
    {
        Artisan::call('optimize:clear');
        removeFile(storage_path('logs/laravel.log'));
        toastr()->success(__('Cache Cleared Successfully'));
        return back();
    }
}
