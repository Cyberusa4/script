<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unviewedSubscriptions = Subscription::where('admin_has_viewed', 0)->get();
        if (count($unviewedSubscriptions) > 0) {
            foreach ($unviewedSubscriptions as $unviewedSubscription) {
                $unviewedSubscription->admin_has_viewed = 1;
                $unviewedSubscription->save();
            }
        }
        $users = User::where('status', 1)->with('subscription')->get();
        $plans = Plan::all();
        $activeSubscriptions = Subscription::where([['status', 1], ['expiry_at', '>', Carbon::now()]])
            ->orWhere([['status', 1], ['expiry_at', null]])
            ->with(['user', 'plan'])->get();
        $expiredSubscriptions = Subscription::where([['status', 1], ['expiry_at', '<', Carbon::now()]])->with(['user', 'plan'])->get();
        $canceledSubscriptions = Subscription::where('status', 0)->with(['user', 'plan'])->get();
        return view('backend.subscriptions.index', [
            'users' => $users,
            'plans' => $plans,
            'activeSubscriptions' => $activeSubscriptions,
            'expiredSubscriptions' => $expiredSubscriptions,
            'canceledSubscriptions' => $canceledSubscriptions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
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
            'user' => ['required', 'integer'],
            'plan' => ['required', 'integer'],
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                toastr()->error($error);
            }
            return back();
        }
        $user = User::where('id', $request->user)->with('subscription')->first();
        if (is_null($user)) {
            toastr()->error(__('User not exists'));
            return back();
        }
        if (!is_null($user->subscription)) {
            toastr()->error(__('User already subscribed'));
            return back();
        }
        $plan = Plan::find($request->plan);
        if (is_null($plan)) {
            toastr()->error(__('Plan not exists'));
            return back();
        }
        if ($plan->interval == 1) {
            $expiry_at = Carbon::now()->addMonth();
        } elseif ($plan->interval == 2) {
            $expiry_at = Carbon::now()->addYear();
        } elseif ($plan->interval == 3) {
            $expiry_at = null;
        }
        $createSubscription = Subscription::create([
            'user_id' => $user->id,
            'plan_id' => $plan->id,
            'expiry_at' => $expiry_at,
            'admin_has_viewed' => 1,
        ]);
        if ($createSubscription) {
            toastr()->success(__('Created successfully'));
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function show(Subscription $subscription)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscription $subscription)
    {
        $plans = Plan::all();
        $expiryAt = $subscription->expiry_at ? Carbon::parse($subscription->expiry_at)->format('Y-m-d\TH:i:s') : null;
        return view('backend.subscriptions.edit', ['subscription' => $subscription, 'plans' => $plans, 'expiryAt' => $expiryAt]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscription $subscription)
    {
        $validator = Validator::make($request->all(), [
            'status' => ['required', 'boolean'],
            'plan' => ['required', 'integer'],
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                toastr()->error($error);
            }
            return back();
        }
        $plan = Plan::find($request->plan);
        if (is_null($plan)) {
            toastr()->error(__('Plan not exists'));
            return back();
        }
        if ($plan->interval != 3) {
            if (!$request->has('expiry_at')) {
                toastr()->error(__('Expiry date required'));
                return back();
            }
            $expiry_at = Carbon::parse($request->expiry_at);
        } else {
            $expiry_at = null;
        }
        $updateSubscription = $subscription->update([
            'plan_id' => $plan->id,
            'expiry_at' => $expiry_at,
            'status' => $request->status,
        ]);
        if ($updateSubscription) {
            toastr()->success(__('Updated successfully'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        toastr()->success(__('Deleted successfully'));
        return back();
    }
}
