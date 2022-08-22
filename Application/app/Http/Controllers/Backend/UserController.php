<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\FileEntry;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $search = null)
    {
        $unviewedUsers = User::where('admin_has_viewed', 0)->get();
        if (count($unviewedUsers) > 0) {
            foreach ($unviewedUsers as $unviewedUser) {
                $unviewedUser->admin_has_viewed = 1;
                $unviewedUser->save();
            }
        }
        $activeUsersCount = User::where('status', 1)->get()->count();
        $bannedUserscount = User::where('status', 0)->get()->count();
        $subscribedUsersCount = User::whereHas('subscription')->count();
        $unSubscribedUsersCount = User::whereDoesntHave('subscription')->count();
        if ($request->input('search')) {
            $q = $request->input('search');
            $users = User::where('firstname', 'like', '%' . $q . '%')
                ->OrWhere('lastname', 'like', '%' . $q . '%')
                ->OrWhere('email', 'like', '%' . $q . '%')
                ->OrWhere('mobile', 'like', '%' . $q . '%')
                ->orderbyDesc('id')
                ->with('subscription')
                ->paginate(30);
            $users->appends(['search' => $q]);
        } elseif ($request->input('filter')) {
            $filter = $request->input('filter');
            $arr = ['active', 'banned'];
            abort_if(!in_array($filter, $arr), 404);
            $status = ($filter == 'active') ? 1 : 0;
            $users = User::where('status', $status)->orderbyDesc('id')->with('subscription')->paginate(1);
            $users->appends(['filter' => $filter]);
        } else {
            $users = User::orderbyDesc('id')->with('subscription')->paginate(30);
        }
        return view('backend.users.index', [
            'users' => $users,
            'activeUsersCount' => $activeUsersCount,
            'bannedUserscount' => $bannedUserscount,
            'subscribedUsersCount' => $subscribedUsersCount,
            'unSubscribedUsersCount' => $unSubscribedUsersCount,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $password = Str::random(16);
        return view('backend.users.create', ['password' => $password]);
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
            'firstname' => ['required', 'string', 'max:50'],
            'lastname' => ['required', 'string', 'max:50'],
            'username' => ['required', 'string', 'max:50', 'unique:users'],
            'email' => ['required', 'email', 'string', 'max:100', 'unique:users'],
            'country' => ['required'],
            'mobile' => ['required', 'numeric', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                toastr()->error($error);
            }
            return back()->withInput();
        }
        $findCountry = Country::find($request->country);
        if ($findCountry == null) {
            toastr()->error(__('Country not found'));
            return back()->withInput();
        }
        $findMobileCode = Country::find($request->mobile_code);
        if ($findMobileCode == null) {
            toastr()->error(__('Phone code error'));
            return back()->withInput();
        }
        if (!settings('mail_status')) {
            toastr()->error(__('SMTP is not enabled'));
            return back()->withInput();
        }
        if ($request->has('avatar')) {
            $avatar = vImageUpload($request->file('avatar'), 'images/avatars/users/', '110x110');
        } else {
            $avatar = "images/avatars/default.png";
        }
        $phoneNumber = $findMobileCode->phone . $request->mobile;
        $existMobile = User::where('mobile', $phoneNumber)->first();
        if ($existMobile) {
            toastr()->error(__('Phone number already exist'));
            return back()->withInput();
        }
        $address = ['address_1' => '', 'address_2' => '', 'city' => '', 'state' => '', 'zip' => '', 'country' => $findCountry->name];
        $createUser = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'username' => $request->username,
            'email' => $request->email,
            'mobile' => $phoneNumber,
            'address' => $address,
            'avatar' => $avatar,
            'password' => Hash::make($request->password),
        ]);
        if ($createUser) {
            toastr()->success(__('Created Successfully'));
            return redirect()->route('admin.users.edit', $createUser->id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $userSpend = Transaction::where([['user_id', $user->id], ['status', 2]])->sum('total_price');
        $subscription = Subscription::where('user_id', $user->id)->with('plan')->first();
        $totalUploads = FileEntry::where('user_id', $user->id)->notFolder()->notExpired()->count();
        $totalImages = FileEntry::where([['user_id', $user->id], ['type', 'image']])->userEntry()->notExpired()->count();
        $totalFileDocuments = FileEntry::where('user_id', $user->id)->whereIn('type', ['file', 'pdf'])->userEntry()->notExpired()->count();
        $usedSpace = FileEntry::where('user_id', $user->id)->notFolder()->userEntry()->notExpired()->sum('size');
        return view('backend.users.edit.index', [
            'user' => $user,
            'userSpend' => $userSpend,
            'subscription' => $subscription,
            'totalUploads' => $totalUploads,
            'totalImages' => $totalImages,
            'totalFileDocuments' => $totalFileDocuments,
            'usedSpace' => formatBytes($usedSpace),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => ['required', 'string', 'max:50'],
            'lastname' => ['required', 'string', 'max:50'],
            'username' => ['required', 'string', 'max:50', 'unique:users,username,' . $user->id],
            'email' => ['required', 'email', 'string', 'max:100', 'unique:users,email,' . $user->id],
            'mobile' => ['required', 'string', 'max:50', 'unique:users,mobile,' . $user->id],
            'address_1' => ['max:255'],
            'address_2' => ['max:255'],
            'city' => ['max:150'],
            'state' => ['max:150'],
            'zip' => ['max:100'],
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                toastr()->error($error);
            }
            return back();
        }
        $findCountry = Country::find($request->country);
        if ($findCountry == null) {
            toastr()->error(__('Country not found'));
            return back();
        }
        $datetime = Carbon::now();
        $status = ($request->has('status')) ? 1 : 0;
        $google2fa_status = ($request->has('google2fa_status')) ? 1 : 0;
        $address = [
            'address_1' => $request->address_1,
            'address_2' => $request->address_2,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'country' => $findCountry->name,
        ];
        $update = $user->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'username' => $request->username,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address' => $address,
            'google2fa_status' => $google2fa_status,
            'status' => $status,
        ]);
        if ($update) {
            $emailValue = ($request->has('email_status')) ? $datetime : null;
            $user->forceFill([
                'email_verified_at' => $emailValue,
            ])->save();
            toastr()->success(__('Updated Successfully'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $fileEntries = FileEntry::where('user_id', $user->id)->withTrashed()->notFolder()->notExpired()->count();
        if ($fileEntries > 0) {
            toastr()->error(__('User has a files uploaded, delete the files to be able to delete the user'));
            return back();
        }
        if ($user->avatar != "images/avatars/default.png") {
            removeFile($user->avatar);
        }
        $user->delete();
        deleteAdminNotification(route('admin.users.edit', $user->id));
        toastr()->success(__('Deleted Successfully'));
        return back();
    }

    /**
     * Update user avatar
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id = user id
     * @return \Illuminate\Http\Response
     */
    public function changeAvatar(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'avatar' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                return response()->json(['error' => $error]);
            }
        }
        $user = User::find($id);
        if ($user == null) {
            return response()->json(['error' => __('User not found')]);
        }
        if ($request->has('avatar')) {
            if ($user->avatar == 'images/avatars/default.png') {
                $uploadAvatar = vImageUpload($request->file('avatar'), 'images/avatars/users/', '110x110');
            } else {
                $uploadAvatar = vImageUpload($request->file('avatar'), 'images/avatars/users/', '110x110', null, $user->avatar);
            }
        } else {
            return response()->json(['error' => __('Upload error')]);
        }
        $update = $user->update([
            'avatar' => $uploadAvatar,
        ]);
        if ($update) {
            return response()->json(['success' => __('Updated Successfully')]);
        }
    }

    /**
     * delete user avatar
     *
     * @param  $id = user id
     * @return \Illuminate\Http\Response
     */
    public function deleteAvatar($id)
    {
        $user = User::findOrFail($id);
        $avatar = "images/avatars/default.png";
        if ($user->avatar != $avatar) {
            removeFile($user->avatar);
        } else {
            toastr()->error(__('Default avatar cannot be deleted'));
            return back();
        }
        $update = $user->update([
            'avatar' => $avatar,
        ]);
        if ($update) {
            toastr()->success(__('Removed Successfully'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id = User id
     * @return \Illuminate\Http\Response
     */
    public function sendMail(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'subject' => ['required', 'string'],
            'reply_to' => ['required', 'email'],
            'message' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                toastr()->error($error);
            }
            return back();
        }
        if (!settings('mail_status')) {
            toastr()->error(__('SMTP is not enabled'));
            return back()->withInput();
        }
        $user = User::find($id);
        if ($user == null) {
            toastr()->error(__('User not found'));
            return back();
        }
        try {
            $email = $user->email;
            $subject = $request->subject;
            $replyTo = $request->reply_to;
            $msg = $request->message;
            \Mail::send([], [], function ($message) use ($msg, $email, $subject, $replyTo) {
                $message->to($email)
                    ->replyTo($replyTo)
                    ->subject($subject)
                    ->setBody($msg, 'text/html');
            });
            toastr()->success(__('Sent successfully'));
            return back();
        } catch (Exception $e) {
            toastr()->error(__('Sent error'));
            return back();
        }
    }

    /**
     * View logs page
     *
     * @param  $id = User id
     * @return \Illuminate\Http\Response
     */
    public function logs($id)
    {
        $user = User::findOrFail($id);
        $subscription = Subscription::where('user_id', $user->id)->with('plan')->first();
        $logs = UserLog::where('user_id', $user->id)->select('id', 'ip', 'location')->orderbyDesc('id')->paginate(6);
        return view('backend.users.edit.logs', ['user' => $user, 'subscription' => $subscription, 'logs' => $logs]);
    }

    /**
     * Sent ajax requet to get log
     *
     * @param  $id = user id
     *  @param  $log_id = log id
     * @return \Illuminate\Http\Response as json
     */
    public function getLogs($id, $log_id)
    {
        $log = UserLog::where([['user_id', $id], ['id', $log_id]])->first();
        if ($log != null) {
            $log['ip_link'] = route('admin.users.logsbyip', $log->ip);
            return response()->json($log);
        } else {
            return response()->json(['error' => __('Log not found')]);
        }
    }

    /**
     * View logs by ip
     *
     * @param  $ip = log ip
     * @return \Illuminate\Http\Response
     */
    public function logsByIp($ip)
    {
        $logs = UserLog::where('ip', $ip)->with('user')->paginate(12);
        if ($logs->isEmpty()) {
            return abort(404);
        }
        return view('backend.users.logs', ['logs' => $logs]);
    }
}
