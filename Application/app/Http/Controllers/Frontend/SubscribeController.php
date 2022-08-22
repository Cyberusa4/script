<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Transaction;
use Auth;
use Illuminate\Http\Request;
use Str;

class SubscribeController extends Controller
{
    public function subscribe(Request $request, $id, $type)
    {
        if (!Auth::user()) {
            toastr()->info(lang('Please login or create an account to choose a plan', 'alerts'));
            return redirect()->route('login');
        }
        $plan = Plan::where('id', unhashid($id))->first();
        if (is_null($plan)) {
            toastr()->error(lang('Choosed plan is not exists', 'alerts'));
            return back();
        }
        $user = userAuthInfo();
        if (!is_null($user->subscription) && !$user->subscription->status) {
            toastr()->error(lang('Your subscription has been canceled, please contact us for more information', 'alerts'));
            return back();
        }
        switch ($type) {
            case 'subscribe':
                if (!is_null($user->subscription)) {
                    toastr()->error(lang('You already subscribed but you can upgrade by clicking on the upgrade button.', 'alerts'));
                    return back();
                }
                $type = 1;
                break;
            case "renew":
                if (is_null($user->subscription)) {
                    toastr()->error(lang('You need to subscribe before you can renew the plan', 'alerts'));
                    return back();
                }
                if ($user->subscription->plan->free_plan) {
                    toastr()->error(lang('You subscribed in free plan it will renew automatically after it gets expiry', 'alerts'));
                    return back();
                }
                if ($user->subscription->plan_id != $plan->id) {
                    toastr()->error(lang('You can only renew your current plan or upgrade to new plan', 'alerts'));
                    return back();
                }
                if ($user->subscription->plan->interval == 3) {
                    toastr()->error(lang('Your plan is not renewable', 'alerts'));
                    return back();
                }
                $type = 2;
                break;
            case "upgrade":
                if (is_null($user->subscription)) {
                    toastr()->error(lang('You need to subscribe before you can upgrade the plan', 'alerts'));
                    return back();
                }
                if ($user->subscription->plan_id == $plan->id) {
                    toastr()->error(lang('You can only renew your current plan or upgrade to new plan', 'alerts'));
                    return back();
                }
                if (!is_null($plan->storage_space)) {
                    if (subscription()->storage->used->number > $plan->storage_space) {
                        toastr()->error(lang('You cannot upgrade to this plan, storage space not enough', 'alerts'));
                        return back();
                    }
                }
                $type = 3;
                break;
            default:
                return abort(404);
                break;
        }
        $checkoutId = sha1(Str::random(40));
        $tax_price = ($plan->price * countryTax($user->address->country ?? vIpInfo()->country)) / 100;
        $total_price = ($plan->price + $tax_price);
        $detailsBeforeDiscount = [
            'plan_price' => priceFormt($plan->price),
            'tax_price' => priceFormt($tax_price),
            'total_price' => priceFormt($total_price),
        ];
        $createTrabsaction = Transaction::create([
            'checkout_id' => $checkoutId,
            'transaction_id' => randomCode(16),
            'user_id' => $user->id,
            'plan_id' => $plan->id,
            'details_before_discount' => $detailsBeforeDiscount,
            'plan_price' => $plan->price,
            'tax_price' => $tax_price,
            'total_price' => $total_price,
            'type' => $type,
        ]);
        if ($createTrabsaction) {
            return redirect()->route('user.checkout.index', $checkoutId);
        }
    }
}
