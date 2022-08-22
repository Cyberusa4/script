<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Plan;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::whereNull('deleted_at')->with('plan')->get();
        return view('backend.coupons.index', ['coupons' => $coupons]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plans = Plan::where('free_plan', 0)->get();
        return view('backend.coupons.create', ['plans' => $plans]);
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
            'code' => ['required', 'string', 'regex:/^[a-zA-Z0-9]*$/', 'min:3', 'max:20', 'unique:coupons'],
            'percentage' => ['required', 'integer', 'min:1', 'max:100'],
            'limit' => ['required', 'integer', 'min:1'],
            'plan' => ['required', 'integer', 'min:0'],
            'action_type' => ['required', 'integer', 'min:0', 'max:3'],
            'expiry_at' => ['required', 'required'],
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                toastr()->error($error);
            }
            return back()->withInput();
        }
        if ($request->percentage < 1 || $request->percentage > 100) {
            toastr()->error(__('Invalid discount percentage'));
            return back()->withInput();
        }
        if ($request->limit < 1) {
            toastr()->error(__('Invalid limit'));
            return back()->withInput();
        }
        if ($request->plan != 0) {
            $plan = Plan::where([['id', $request->plan], ['free_plan', 0]])->first();
            if (is_null($plan)) {
                toastr()->error(__('Invalid plan'));
                return back()->withInput();
            }
            $request->plan = $plan->id;
        } else {
            $request->plan = null;
        }
        $actionTypes = [0, 1, 2, 3];
        if (!in_array($request->action_type, $actionTypes)) {
            toastr()->error(__('Invalid action type'));
            return back()->withInput();
        }
        if (Carbon::parse($request->expiry_at) < Carbon::now()) {
            toastr()->error(__('Invalid expiry date'));
            return back()->withInput();
        } elseif (Carbon::now()->addMinutes(5) > Carbon::parse($request->expiry_at)) {
            toastr()->error(__('Expiry date must be 5 minutes minimum'));
            return back()->withInput();
        }
        $request->expiry_at = Carbon::parse($request->expiry_at);

        $create = Coupon::create([
            'code' => strtoupper($request->code),
            'percentage' => $request->percentage,
            'limit' => $request->limit,
            'plan_id' => $request->plan,
            'action_type' => $request->action_type,
            'expiry_at' => $request->expiry_at,
        ]);
        if ($create) {
            toastr()->success(__('Created successfully'));
            return redirect()->route('admin.coupons.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        abort_if(!is_null($coupon->deleted_at), 404);
        $plans = Plan::where('free_plan', 0)->get();
        return view('backend.coupons.edit', ['coupon' => $coupon, 'plans' => $plans]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        $validator = Validator::make($request->all(), [
            'limit' => ['required', 'integer', 'min:1'],
            'expiry_at' => ['required', 'required'],
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                toastr()->error($error);
            }
            return back()->withInput();
        }
        if ($request->limit < 1) {
            toastr()->error(__('Invalid limit'));
            return back()->withInput();
        }
        if (Carbon::parse($request->expiry_at) != $coupon->expiry_at) {
            if (Carbon::parse($request->expiry_at) < Carbon::now()) {
                toastr()->error(__('Invalid expiry date'));
                return back()->withInput();
            } elseif (Carbon::now()->addMinutes(5) > Carbon::parse($request->expiry_at)) {
                toastr()->error(__('Expiry date must be 5 minutes minimum'));
                return back()->withInput();
            }
            $request->expiry_at = Carbon::parse($request->expiry_at);
        } else {
            $request->expiry_at = $coupon->expiry_at;
        }

        $update = $coupon->update([
            'limit' => $request->limit,
            'expiry_at' => $request->expiry_at,
        ]);
        if ($update) {
            toastr()->success(__('Updated successfully'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        $transactions = Transaction::where('coupon_id', $coupon->id)->count();
        if ($transactions > 0) {
            $coupon->update(['deleted_at' => Carbon::now()]);
        } else {
            $coupon->delete();
        }
        toastr()->success(__('Deleted successfully'));
        return back();
    }
}
