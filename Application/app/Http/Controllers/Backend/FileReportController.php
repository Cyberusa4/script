<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\FileReport;
use Illuminate\Http\Request;

class FileReportController extends Controller
{
    public function index()
    {
        $fileReports = FileReport::with('fileEntry')->fileEntryActive()->orderbyDesc('id')->get();
        $waitingReview = FileReport::where('admin_has_viewed', 0)->fileEntryActive()->count();
        $reviewed = FileReport::where('admin_has_viewed', 1)->fileEntryActive()->count();
        return view('backend.reports.index', [
            'fileReports' => $fileReports,
            'waitingReview' => $waitingReview,
            'reviewed' => $reviewed,
        ]);
    }

    public function view($id)
    {
        $fileReport = FileReport::where('id', $id)->with('fileEntry')->fileEntryActive()->firstOrFail();
        return view('backend.reports.view', ['fileReport' => $fileReport]);
    }

    public function markAsReviewed(Request $request, $id)
    {
        $fileReport = FileReport::where([['id', $id], ['admin_has_viewed', 0]])->with('fileEntry')->fileEntryActive()->first();
        if (is_null($fileReport)) {
            toastr()->error(__('Report not exists'));
            return back();
        }
        $fileReport->update(['admin_has_viewed' => 1]);
        toastr()->success(__('Reviewed successfully'));
        return back();
    }

    public function destroy($id)
    {
        $fileReport = FileReport::where('id', $id)->with('fileEntry')->fileEntryActive()->first();
        if (is_null($fileReport)) {
            toastr()->error(__('Report not exists'));
            return back();
        }
        $fileReport->delete();
        deleteAdminNotification(route('admin.reports.view', $fileReport->id));
        toastr()->success(__('Deleted successfully'));
        return redirect()->route('admin.reports.index');

    }
}
