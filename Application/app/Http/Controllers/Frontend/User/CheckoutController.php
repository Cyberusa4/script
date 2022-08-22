<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Coupon;
use App\Models\PaymentGateway;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Validator;

class CheckoutController extends Controller
{
    public function index($checkout_id)
    {
        $transaction = Transaction::where([['checkout_id', $checkout_id], ['user_id', userAuthInfo()->id], ['status', 0]])->with('plan')->first();
        if (is_null($transaction)) {
            toastr()->error(lang('Invalid or expired transaction', 'checkout'));
            return redirect()->route('user.subscription');
        }
        $paymentGateways = PaymentGateway::where('status', 1)->get();
        return view('frontend.user.checkout.index', [
            'user' => userAuthInfo(),
            'transaction' => $transaction,
            'paymentGateways' => $paymentGateways,
        ]);
    }

    public function applyCoupon(Request $request, $checkout_id)
    {
        $validator = Validator::make($request->all(), [
            'coupon_code' => ['required', 'string', 'max:20'],
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                toastr()->error($error);
            }
            return back()->withInput();
        }
        $transaction = Transaction::where([['checkout_id', $checkout_id], ['user_id', userAuthInfo()->id], ['status', 0], ['coupon_id', null], ['total_price', '!=', 0]])->with('plan')->first();
        if (is_null($transaction)) {
            toastr()->error(lang('Invalid or expired transaction', 'checkout'));
            return back()->withInput();
        }
        $coupon = Coupon::where([['code', $request->coupon_code], ['plan_id', $transaction->plan->id], ['expiry_at', '>', Carbon::now()], ['deleted_at', null]])
            ->orWhere([['code', $request->coupon_code], ['plan_id', null], ['expiry_at', '>', Carbon::now()], ['deleted_at', null]])
            ->first();
        if (is_null($coupon)) {
            toastr()->error(lang('Invalid or expired coupon code', 'checkout'));
            return back()->withInput();
        }
        if ($coupon->action_type != 0) {
            if ($transaction->type == 1 && $coupon->action_type != 1) {
                toastr()->error(lang('Invalid or expired coupon code', 'checkout'));
                return back()->withInput();
            } elseif ($transaction->type == 2 && $coupon->action_type != 2) {
                toastr()->error(lang('Invalid or expired coupon code', 'checkout'));
                return back()->withInput();
            } elseif ($transaction->type == 3 && $coupon->action_type != 3) {
                toastr()->error(lang('Invalid or expired coupon code', 'checkout'));
                return back()->withInput();
            }
        }
        $couponTransactionsCount = Transaction::where([['coupon_id', $coupon->id], ['user_id', userAuthInfo()->id]])->whereIn('status', [0, 2])->count();
        if ($couponTransactionsCount >= $coupon->limit) {
            toastr()->error(lang('You have exceeded the usage limit for this coupon', 'checkout'));
            return back()->withInput();
        }
        $planPriceAfterDiscount = ($transaction->plan_price - ($transaction->plan_price * $coupon->percentage) / 100);
        $taxPriceAfterDiscount = ($planPriceAfterDiscount * countryTax(userAuthInfo()->address->country ?? vIpInfo()->country)) / 100;
        $totalPriceAfterDiscount = ($planPriceAfterDiscount + $taxPriceAfterDiscount);
        $detailsAfterDiscount = [
            'plan_price' => priceFormt($planPriceAfterDiscount),
            'tax_price' => priceFormt($taxPriceAfterDiscount),
            'total_price' => priceFormt($totalPriceAfterDiscount),
        ];
        $updateTransaction = $transaction->update([
            'coupon_id' => $coupon->id,
            'details_after_discount' => $detailsAfterDiscount,
            'plan_price' => $planPriceAfterDiscount,
            'tax_price' => $taxPriceAfterDiscount,
            'total_price' => $totalPriceAfterDiscount,
        ]);
        if ($updateTransaction) {
            toastr()->success(lang('Coupon has been applied successfully', 'checkout'));
            return back();
        }
    }

    public function removeCoupon(Request $request, $checkout_id)
    {
        $transaction = Transaction::where([['checkout_id', $checkout_id], ['user_id', userAuthInfo()->id], ['status', 0], ['coupon_id', '!=', null]])->first();
        if (is_null($transaction)) {
            toastr()->error(lang('Invalid or expired transaction', 'checkout'));
            return back();
        }
        $updateTransaction = $transaction->update([
            'coupon_id' => null,
            'details_after_discount' => null,
            'plan_price' => $transaction->details_before_discount->plan_price,
            'tax_price' => $transaction->details_before_discount->tax_price,
            'total_price' => $transaction->details_before_discount->total_price,
        ]);
        if ($updateTransaction) {
            return back();
        }
    }

    public function proccess(Request $request, $checkout_id)
    {
        $validator = Validator::make($request->all(), [
            'address_1' => ['required', 'string', 'max:255'],
            'address_2' => ['nullable', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:150'],
            'state' => ['required', 'string', 'max:150'],
            'zip' => ['required', 'string', 'max:100'],
            'country' => ['required', 'integer'],
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                toastr()->error($error);
            }
            return back();
        }
        $transaction = Transaction::where([['checkout_id', $checkout_id], ['user_id', userAuthInfo()->id], ['status', 0]])->with('coupon')->first();
        if (is_null($transaction)) {
            toastr()->error(lang('Invalid or expired transaction', 'checkout'));
            return back();
        }
        if (!is_null($transaction->coupon_id)) {
            if (!is_null($transaction->coupon->deleted_at) || $transaction->coupon->expiry_at < Carbon::now()) {
                toastr()->error(lang('Invalid or expired coupon code', 'checkout'));
                return back()->withInput();
            }
        }
        if ($transaction->total_price != 0) {
            $paymentGateway = PaymentGateway::where([['id', unhashid($request->payment_method)], ['status', 1]])->first();
            if (is_null($paymentGateway) || $transaction->total_price < $paymentGateway->min) {
                toastr()->error(lang('Selected payment method is not active', 'checkout'));
                return back();
            }
        }
        $country = Country::find($request->country);
        if (is_null($country)) {
            toastr()->error(lang('Country not exists', 'alerts'));
            return back();
        }
        $address = [
            'address_1' => $request->address_1,
            'address_2' => $request->address_2,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'country' => $country->name,
        ];
        $user = Auth::user();
        $updateUserAddress = $user->update(['address' => $address]);
        if ($transaction->total_price == 0) {
            $transaction->update(['status' => 2]);
            $this->updateSubscription($transaction);
            toastr()->success(lang('Subscribed Successfully', 'alerts'));
            return redirect()->route('user.subscription');
        }
        $paymentHandler = $paymentGateway->handler;
        $paymentData = $paymentHandler::process($transaction);
        $paymentData = json_decode($paymentData);
        if ($paymentData->error == true) {
            toastr()->error($paymentData->msg);
            return back();
        }
        $updateTransaction = $transaction->update(['status' => 1]);
        if ($updateTransaction) {
            return redirect($paymentData->redirectUrl);
        }
    }

    public static function updateSubscription($trx)
    {
        if ($trx->status != 2) {
            throw new Exception(lang('Incomplete payment please contact us', 'checkout'));
        }
        if (!is_null(userAuthInfo()->subscription) && !userAuthInfo()->subscription->status) {
            throw new Exception(lang('Your subscription has been canceled, please contact us for more information', 'alerts'));
        }
        if ($trx->type == 1) {
            if ($trx->plan->interval == 1) {
                $expiry_at = Carbon::now()->addMonth();
            } elseif ($trx->plan->interval == 2) {
                $expiry_at = Carbon::now()->addYear();
            } else {
                $expiry_at = null;
            }
            $createSubscription = Subscription::create([
                'user_id' => $trx->user_id,
                'plan_id' => $trx->plan_id,
                'expiry_at' => $expiry_at,
            ]);
            if ($createSubscription) {
                $title = userAuthInfo()->name . ' has subscribed';
                $image = asset('images/icons/subscribe.png');
                $link = route('admin.users.edit', $createSubscription->user_id);
                adminNotify($title, $image, $link);
            }
        }
        if ($trx->type == 2) {
            if ($trx->plan->interval == 1) {
                if (subscription()->days->remining < 0) {
                    $expiry_at = Carbon::now()->addMonth();
                } else {
                    $expiry_at = Carbon::parse(subscription()->dates->original->expiration)->addMonth();
                }
            } elseif ($trx->plan->interval == 2) {
                if (subscription()->days->remining < 0) {
                    $expiry_at = Carbon::now()->addYear();
                } else {
                    $expiry_at = Carbon::parse(subscription()->dates->original->expiration)->addYear();
                }
            } else {
                $expiry_at = null;
            }
            $updateSubscription = Subscription::where('user_id', $trx->user_id)->update(['expiry_at' => $expiry_at]);
            if ($updateSubscription) {
                $title = userAuthInfo()->name . ' has renewed subscription';
                $image = asset('images/icons/renewal.png');
                $link = route('admin.users.edit', $trx->user_id);
                adminNotify($title, $image, $link);
            }
        }
        if ($trx->type == 3) {
            if ($trx->plan->interval == 1) {
                $expiry_at = Carbon::now()->addMonth();
            } elseif ($trx->plan->interval == 2) {
                $expiry_at = Carbon::now()->addYear();
            } else {
                $expiry_at = null;
            }
            $updateSubscription = Subscription::where('user_id', $trx->user_id)->update([
                'plan_id' => $trx->plan_id,
                'expiry_at' => $expiry_at,
            ]);
            if ($updateSubscription) {
                $title = userAuthInfo()->name . ' has upgrade subscription';
                $image = asset('images/icons/upgrade.png');
                $link = route('admin.users.edit', $trx->user_id);
                adminNotify($title, $image, $link);
            }
        }
    }

}
