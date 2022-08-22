<?php

namespace App\Http\Controllers\Frontend\Gateways;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\User\CheckoutController;
use Exception;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Customer;
use Stripe\Stripe;

class StripeCheckoutController extends Controller
{
    public static function process($trx)
    {
        if ($trx->status != 0) {
            $data['error'] = true;
            $data['msg'] = lang('Invalid or expired transaction', 'checkout');
            return json_encode($data);
        }
        if ($trx->plan->interval == 1) {
            $planInterval = '(Monthly)';
        } elseif ($trx->plan->interval == 2) {
            $planInterval = '(Yearly)';
        } elseif ($trx->plan->interval == 3) {
            $planInterval = '(Lifetime)';
        }
        $paymentName = "Payment for subscription " . $trx->plan->name . " Plan " . $planInterval;
        $gatewayFees = ($trx->total_price * paymentGateway('stripe_checkout')->fees) / 100;
        $totalPrice = round(($trx->total_price + $gatewayFees), 2);
        $priceIncludeFees = str_replace('.', '', ($totalPrice * 100));
        $paymentDeatails = [
            'customer_email' => $trx->user->email,
            'payment_method_types' => [
                'card',
            ],
            'line_items' => [[
                'name' => settings('website_name'),
                'description' => $paymentName,
                'amount' => $priceIncludeFees,
                'currency' => currencyCode(),
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'cancel_url' => route('user.subscription'),
            'success_url' => route('ipn.stripe_checkout') . '?session_id={CHECKOUT_SESSION_ID}',
        ];
        try {
            Stripe::setApiKey(paymentGateway('stripe_checkout')->credentials->secret_key);
            $session = Session::create($paymentDeatails);
            if ($session) {
                $trx->update(['fees_price' => $gatewayFees, 'payment_id' => $session->id]);
                $data['error'] = false;
                $data['redirectUrl'] = $session->url;
                return json_encode($data);
            }
        } catch (\Exception $e) {
            $data['error'] = true;
            $data['msg'] = $e->getMessage();
            return json_encode($data);
        }
    }

    public function ipn(Request $request)
    {
        $session_id = $request->session_id;
        try {
            Stripe::setApiKey(paymentGateway('stripe_checkout')->credentials->secret_key);
            $trx = \App\Models\Transaction::where([['user_id', userAuthInfo()->id], ['payment_id', $session_id], ['status', 1]])->first();
            if (is_null($trx)) {
                throw new Exception(lang('Invalid or expired transaction', 'checkout'));
            }
            $session = Session::retrieve($session_id);
            if ($session->payment_status == "paid" && $session->status == "complete") {
                $customer = Customer::retrieve($session->customer);
                $total = ($trx->total_price + $trx->fees_price);
                $payment_gateway_id = paymentGateway('stripe_checkout')->id;
                $payment_id = $session->id;
                $payer_id = $customer->id;
                $payer_email = $customer->email;
                $updateTrx = $trx->update([
                    'total_price' => $total,
                    'payment_gateway_id' => $payment_gateway_id,
                    'payment_id' => $payment_id,
                    'payer_id' => $payer_id,
                    'payer_email' => $payer_email,
                    'status' => 2,
                ]);
                if ($updateTrx) {
                    CheckoutController::updateSubscription($trx);
                    toastr()->success(lang('Payment made successfully', 'checkout'));
                    return redirect()->route('user.subscription');
                }
            } else {
                throw new Exception(lang('Payment failed', 'checkout'));
            }
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->route('home');
        }
    }
}
