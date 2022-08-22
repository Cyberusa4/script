<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\UserNotification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = UserNotification::where('user_id', userAuthInfo()->id)->orderbyDesc('id')->paginate(10);
        $unreadNotificationsCount = UserNotification::where([['user_id', userAuthInfo()->id], ['status', 0]])->get()->count();
        return view('frontend.user.notifications.index', [
            'notifications' => $notifications,
            'unreadNotificationsCount' => $unreadNotificationsCount,
        ]);
    }

    public function view($id)
    {
        $notification = UserNotification::where([['id', unhashid($id)], ['user_id', userAuthInfo()->id]])->firstOrFail();
        $updateStatus = $notification->update(['status' => 1]);
        if ($updateStatus) {
            return redirect($notification->link);
        }
    }

    public function readAll()
    {
        $notifications = UserNotification::where([['user_id', userAuthInfo()->id], ['status', 0]])->get();
        if ($notifications->count() == 0) {
            return redirect()->route('user.notifications');
        }
        foreach ($notifications as $notification) {
            $notification->update(['status' => 1]);
        }
        toastr()->success(lang('All notifications has been read successfully', 'user'));
        return back();
    }
}
