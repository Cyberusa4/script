<?php

namespace App\Http\Controllers\Frontend\File;

use App\Http\Controllers\Controller;
use App\Http\Methods\ReCaptchaValidation;
use App\Models\BlogArticle;
use App\Models\FileEntry;
use App\Models\FileReport;
use Auth;
use Exception;
use Illuminate\Http\Request;
use Session;
use Validator;

class DownloadController extends Controller
{
    public function index($shared_id)
    {
        $fileEntry = FileEntry::where('shared_id', $shared_id)->notExpired()->firstOrFail();
        abort_if(!static::accessCheck($fileEntry), 404);
        if (!is_null($fileEntry->password)) {
            if (!Session::has(filePasswordSession($fileEntry->shared_id))) {
                return redirect(route('file.password', $fileEntry->shared_id) . '?source=download');
            } else {
                $password = decrypt(Session::get(filePasswordSession($fileEntry->shared_id)));
                if ($password != $fileEntry->password) {
                    return redirect(route('file.password', $fileEntry->shared_id) . '?source=download');
                }
            }
        }
        $blogArticles = BlogArticle::limit(6)->orderbyDesc('id')->get();
        $fileEntry->increment('views');
        return view('frontend.file.download', ['fileEntry' => $fileEntry, 'blogArticles' => $blogArticles]);
    }

    public function createDownloadLink(Request $request, $shared_id)
    {
        $fileEntry = FileEntry::where('shared_id', $shared_id)->notExpired()->first();
        if (is_null($fileEntry) || !static::accessCheck($fileEntry)) {
            return jsonError(lang('File not found, missing or expired', 'download page'));
        }
        if (!is_null($fileEntry->password)) {
            if (!Session::has(filePasswordSession($fileEntry->shared_id))) {
                return jsonError(lang('Unauthorized access', 'alerts'));
            } else {
                $password = decrypt(Session::get(filePasswordSession($fileEntry->shared_id)));
                if ($password != $fileEntry->password) {
                    return jsonError(lang('Unauthorized access', 'alerts'));
                }
            }
        }
        $request->session()->put(fileDownloadSession($fileEntry->shared_id), true);
        return response()->json([
            'type' => 'success',
            'download_link' => route('file.download.approval', $fileEntry->shared_id),
        ]);
    }

    public function download($shared_id)
    {
        $fileEntry = FileEntry::where('shared_id', $shared_id)->notExpired()->firstOrFail();
        abort_if(!static::accessCheck($fileEntry), 404);
        if (!is_null($fileEntry->password) && !Session::has(fileDownloadSession($fileEntry->shared_id))) {
            return redirect(route('file.password', $fileEntry->shared_id) . '?source=download');
        }
        if (!Session::has(fileDownloadSession($fileEntry->shared_id))) {
            return redirect()->route('file.download', $fileEntry->shared_id);
        }
        try {
            $handler = $fileEntry->storageProvider->handler;
            Session::forget(fileDownloadSession($fileEntry->shared_id));
            $fileEntry->increment('downloads');
            $download = $handler::download($fileEntry);
            if ($fileEntry->storageProvider->symbol == "local") {
                return $download;
            } else {
                return redirect($download);
            }
        } catch (Exception $e) {
            toastr()->error(lang('There was a problem while trying to download the file', 'download page'));
            return redirect()->route('file.download', $fileEntry->shared_id);
        }
    }

    public function reportFile(Request $request, $shared_id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'reason' => ['required', 'integer', 'min:0', 'max:4'],
            'details' => ['required', 'string', 'max:600'],
        ] + ReCaptchaValidation::validate());
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                toastr()->error($error);
            }
            return back();
        }
        $fileEntry = FileEntry::where('shared_id', $shared_id)->notExpired()->first();
        if (is_null($fileEntry) || !static::accessCheck($fileEntry)) {
            toastr()->error(lang('File not found, missing or expired', 'download page'));
            return back();
        }
        if (Auth::user()) {
            if ($fileEntry->user_id == Auth::user()->id) {
                toastr()->error(lang('File not found, missing or expired', 'download page'));
                return back();
            }
        }
        if (!array_key_exists($request->reason, reportReasons())) {
            toastr()->error(lang('Invalid report reason', 'download page'));
            return back();
        }
        $alreadyReported = FileReport::where([['file_entry_id', $fileEntry->id], ['ip', vIpInfo()->ip]])
            ->OrWhere([['file_entry_id', $fileEntry->id], ['email', $request->email]])
            ->first();
        if (!is_null($alreadyReported)) {
            toastr()->error(lang('You have already reported this file', 'download page'));
            return back();
        }
        $createFileReport = FileReport::create([
            'file_entry_id' => $fileEntry->id,
            'ip' => vIpInfo()->ip,
            'name' => $request->name,
            'email' => $request->email,
            'reason' => $request->reason,
            'details' => $request->details,
        ]);
        if ($createFileReport) {
            $title = __('New report #') . $fileEntry->shared_id;
            $image = asset('images/icons/report.png');
            $link = route('admin.reports.view', $createFileReport->id);
            adminNotify($title, $image, $link);
            toastr()->success(lang('Your report has been sent successfully, we will review and take the necessary action', 'download page'));
            return back();
        }
    }

    public static function accessCheck($fileEntry)
    {
        if ($fileEntry->access_status) {
            return true;
        } else {
            if (Auth::user() && Auth::user()->id == $fileEntry->user_id) {
                return true;
            }
        }
        return false;
    }
}
