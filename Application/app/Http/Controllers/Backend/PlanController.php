<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\PaymentGateway;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Validator;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $monthlyPlans = Plan::where('interval', 1)->get();
        $yearlyPlans = Plan::where('interval', 2)->get();
        $lifetimePlans = Plan::where('interval', 3)->get();
        return view('backend.plans.index', ['monthlyPlans' => $monthlyPlans, 'yearlyPlans' => $yearlyPlans, 'lifetimePlans' => $lifetimePlans]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.plans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $activePaymentMethod = PaymentGateway::where('status', 1)->get();
        if (count($activePaymentMethod) < 1) {
            toastr()->error(__('No active payment method'))->info(__('Add your payment methods info before you start creating a plan'));
            return back()->withInput();
        }
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'color' => ['required', 'string', 'max:20'],
            'short_description' => ['required', 'string', 'max:150'],
            'interval' => ['required', 'integer', 'min:1', 'max:3'],
            'price' => ['sometimes', 'required', 'regex:/^\d*(\.\d{2})?$/', 'numeric', 'min:0.50'],
            'storage_space' => ['sometimes', 'required', 'integer', 'min:1'],
            'file_size' => ['sometimes', 'required', 'integer', 'min:1'],
            'files_duration' => ['sometimes', 'required', 'integer', 'min:1', 'max:365'],
            'upload_at_once' => ['required', 'integer', 'min:1'],
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                toastr()->error($error);
            }
            return back()->withInput();
        }
        if ($request->has('custom_features')) {
            foreach ($request->custom_features as $custom_feature) {
                if ($custom_feature['status'] != 0 && $custom_feature['status'] != 1) {
                    toastr()->error(__('Invalid custom feature'));
                    return back()->withInput();
                }
                if (empty($custom_feature['name'])) {
                    toastr()->error(__('Custom feature cannot be empty'));
                    return back()->withInput();
                }
            }
        }
        if ($request->has('free_plan')) {
            $plan = Plan::where('free_plan', 1)->first();
            if (!is_null($plan)) {
                toastr()->error(__('Free plan is already exists'));
                return back()->withInput();
            }
            $request->price = 0;
            $request->free_plan = 1;
            $request->require_login = ($request->has('require_login')) ? 1 : 0;
        } else {
            $request->free_plan = 0;
            $request->require_login = 1;
        }
        $oneMega = 1048576;
        $request->storage_space = ($request->has('unlimited_storage_space')) ? null : ($request->storage_space * $oneMega);
        $request->file_size = ($request->has('unlimited_file_size')) ? null : ($request->file_size * $oneMega);
        $request->files_duration = ($request->has('unlimited_files_duration')) ? null : $request->files_duration;
        $request->password_protection = ($request->has('password_protection')) ? 1 : 0;
        $request->advertisements = ($request->has('advertisements')) ? 1 : 0;
        $request->featured_plan = ($request->has('featured_plan')) ? 1 : 0;
        $createPlan = Plan::create([
            'name' => $request->name,
            'color' => $request->color,
            'short_description' => $request->short_description,
            'interval' => $request->interval,
            'price' => $request->price,
            'storage_space' => $request->storage_space,
            'file_size' => $request->file_size,
            'files_duration' => $request->files_duration,
            'password_protection' => $request->password_protection,
            'upload_at_once' => $request->upload_at_once,
            'advertisements' => $request->advertisements,
            'require_login' => $request->require_login,
            'free_plan' => $request->free_plan,
            'featured_plan' => $request->featured_plan,
            'custom_features' => $request->custom_features,
        ]);
        if ($createPlan) {
            if ($request->has('featured_plan')) {
                Plan::where([['id', '!=', $createPlan->id], ['interval', $createPlan->interval]])->update(['featured_plan' => 0]);
            }
            toastr()->success(__('Created Successfully'));
            return redirect()->route('admin.plans.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan)
    {
        return view('backend.plans.edit', ['plan' => $plan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plan $plan)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'color' => ['required', 'string', 'max:20'],
            'short_description' => ['required', 'string', 'max:150'],
            'price' => ['sometimes', 'required', 'regex:/^\d*(\.\d{2})?$/', 'numeric', 'min:0.50'],
            'storage_space' => ['sometimes', 'required', 'integer', 'min:1'],
            'file_size' => ['sometimes', 'required', 'integer', 'min:1'],
            'files_duration' => ['sometimes', 'required', 'integer', 'min:1', 'max:365'],
            'upload_at_once' => ['required', 'integer', 'min:1'],
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                toastr()->error($error);
            }
            return back()->withInput();
        }
        if ($request->has('custom_features')) {
            foreach ($request->custom_features as $custom_feature) {
                if ($custom_feature['status'] != 0 && $custom_feature['status'] != 1) {
                    toastr()->error(__('Invalid custom feature'));
                    return back()->withInput();
                }
                if (empty($custom_feature['name'])) {
                    toastr()->error(__('Custom feature cannot be empty'));
                    return back()->withInput();
                }
            }
        }
        if ($request->has('free_plan')) {
            $checkPlan = Plan::where('free_plan', 1)->first();
            if (!is_null($checkPlan) && $checkPlan->id != $plan->id) {
                toastr()->error(__('Free plan is already exists'));
                return back()->withInput();
            }
            $request->price = 0;
            $request->free_plan = 1;
            $request->require_login = ($request->has('require_login')) ? 1 : 0;
        } else {
            $request->free_plan = 0;
            $request->require_login = 1;
        }
        $oneMega = 1048576;
        if ($request->has('unlimited_storage_space')) {
            $request->storage_space = null;
        } else {
            if (is_null($plan->storage_space)) {
                toastr()->error(__('Storage space cannot be reduced'));
                return back()->withInput();
            }
            $request->storage_space = ($request->storage_space * $oneMega);
            if ($request->storage_space < $plan->storage_space) {
                toastr()->error(__('Storage space cannot be reduced'));
                return back()->withInput();
            }
        }
        $request->file_size = ($request->has('unlimited_file_size')) ? null : ($request->file_size * $oneMega);
        $request->files_duration = ($request->has('unlimited_files_duration')) ? null : $request->files_duration;
        $request->password_protection = ($request->has('password_protection')) ? 1 : 0;
        $request->advertisements = ($request->has('advertisements')) ? 1 : 0;
        $request->featured_plan = ($request->has('featured_plan')) ? 1 : 0;
        $updatePlan = $plan->update([
            'name' => $request->name,
            'color' => $request->color,
            'short_description' => $request->short_description,
            'price' => $request->price,
            'storage_space' => $request->storage_space,
            'file_size' => $request->file_size,
            'files_duration' => $request->files_duration,
            'password_protection' => $request->password_protection,
            'upload_at_once' => $request->upload_at_once,
            'advertisements' => $request->advertisements,
            'require_login' => $request->require_login,
            'free_plan' => $request->free_plan,
            'featured_plan' => $request->featured_plan,
            'custom_features' => $request->custom_features,
        ]);
        if ($updatePlan) {
            if ($request->has('featured_plan')) {
                Plan::where([['id', '!=', $plan->id], ['interval', $plan->interval]])->update(['featured_plan' => 0]);
            }
            toastr()->success(__('Updated Successfully'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        $transactions = Transaction::where('plan_id', $plan->id)->get();
        if (count($transactions) > 0) {
            toastr()->error(__('This Plan linked with transactions it can not be deleted'));
            return back();
        }
        $subscriptions = Subscription::where('plan_id', $plan->id)->get();
        if (count($subscriptions) > 0) {
            toastr()->error(__('This plan has subscriptions it can not be deleted'));
            return back();
        }
        $coupons = Coupon::where([['plan_id', $plan->id], ['deleted_at', null]])->get();
        if (count($coupons) > 0) {
            toastr()->error(__('This Plan linked with coupons it can not be deleted'));
            return back();
        }
        $plan->delete();
        toastr()->success(__('Deleted successfully'));
        return back();
    }
}
