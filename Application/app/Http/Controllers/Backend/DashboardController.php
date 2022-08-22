<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogArticle;
use App\Models\Coupon;
use App\Models\FileEntry;
use App\Models\FileReport;
use App\Models\Page;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEarnings = Transaction::where([['total_price', '!=', 0], ['status', 2]])->sum('total_price');
        $todayEarnings = Transaction::where([['total_price', '!=', 0], ['status', 2]])->whereDate('created_at', Carbon::today())->sum('total_price');
        $totalUploads = FileEntry::notFolder()->notExpired()->count();
        $transactions = Transaction::where('status', 2)->orderbyDesc('id')->limit(6)->get();
        $totalSubscriptions = Subscription::all()->count();
        $totalUsers = User::all()->count();
        $totalReportedFiles = FileReport::fileEntryActive()->count();
        $totalPages = Page::all()->count();
        $totalArticles = BlogArticle::all()->count();
        $totalTransactions = Transaction::whereIn('status', [2, 3])->count();
        $totalCoupons = Coupon::all()->count();
        $totalPlans = Plan::all()->count();
        $users = User::orderbyDesc('id')->limit(6)->get();
        $totalUsersUploads = FileEntry::userEntry()->notFolder()->notExpired()->count();
        $totalGuestsUploads = FileEntry::guestEntry()->notFolder()->notExpired()->count();
        $totalUsedSpace = FileEntry::notFolder()->notExpired()->sum('size');
        return view('backend.dashboard.index', [
            'totalEarnings' => $totalEarnings,
            'todayEarnings' => $todayEarnings,
            'totalUploads' => formatNumber($totalUploads),
            'transactions' => $transactions,
            'totalSubscriptions' => formatNumber($totalSubscriptions),
            'totalUsers' => formatNumber($totalUsers),
            'totalReportedFiles' => formatNumber($totalReportedFiles),
            'totalPages' => formatNumber($totalPages),
            'totalArticles' => formatNumber($totalArticles),
            'totalTransactions' => formatNumber($totalTransactions),
            'totalCoupons' => formatNumber($totalCoupons),
            'totalPlans' => formatNumber($totalPlans),
            'users' => $users,
            'totalUsersUploads' => formatNumber($totalUsersUploads),
            'totalGuestsUploads' => formatNumber($totalGuestsUploads),
            'totalUsedSpace' => formatBytes($totalUsedSpace),
        ]);
    }

    public function usersChartData()
    {
        $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();
        $dates = chartDates($startDate, $endDate);
        $usersRecord = User::where('created_at', '>=', Carbon::now()->startOfWeek())
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date');
        $usersRecordData = $dates->merge($usersRecord);
        $usersChartLabels = [];
        $usersChartData = [];
        foreach ($usersRecordData as $key => $value) {
            $usersChartLabels[] = Carbon::parse($key)->format('d F');
            $usersChartData[] = $value;
        }
        $suggestedMax = (max($usersChartData) > 10) ? max($usersChartData) + 2 : 10;
        return ['usersChartLabels' => $usersChartLabels, 'usersChartData' => $usersChartData, 'suggestedMax' => $suggestedMax];
    }

    public function earningsChartData()
    {
        $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();
        $dates = chartDates($startDate, $endDate);
        $getWeekEarnings = Transaction::where([['status', 2], ['created_at', '>=', Carbon::now()->startOfWeek()]])
            ->selectRaw('DATE(created_at) as date, SUM(total_price) as sum')
            ->groupBy('date')
            ->pluck('sum', 'date');
        $getEarningsData = $dates->merge($getWeekEarnings);
        $earningsChartLabels = [];
        $earningsChartData = [];
        foreach ($getEarningsData as $key => $value) {
            $earningsChartLabels[] = Carbon::parse($key)->format('d F');
            $earningsChartData[] = $value;
        }
        $suggestedMax = (max($earningsChartData) > 10) ? max($earningsChartData) + 2 : 10;
        return ['earningsChartLabels' => $earningsChartLabels, 'earningsChartData' => $earningsChartData, 'suggestedMax' => $suggestedMax];
    }

    public function uploadsChartData()
    {
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();
        $dates = chartDates($startDate, $endDate);
        $monthlyUploads = FileEntry::where([['type', '!=', 'folder'], ['created_at', '>=', Carbon::now()->startOfMonth()]])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date');
        $monthlyUploadsData = $dates->merge($monthlyUploads);
        $uploadsChartLabels = [];
        $uploadsChartData = [];
        foreach ($monthlyUploadsData as $key => $value) {
            $uploadsChartLabels[] = Carbon::parse($key)->format('d F');
            $uploadsChartData[] = $value;
        }
        $suggestedMax = (max($uploadsChartData) > 10) ? max($uploadsChartData) + 2 : 10;
        return ['uploadsChartLabels' => $uploadsChartLabels, 'uploadsChartData' => $uploadsChartData, 'suggestedMax' => $suggestedMax];
    }
}
