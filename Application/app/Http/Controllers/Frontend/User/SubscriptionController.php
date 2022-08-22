<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Transaction;

class SubscriptionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', userAuthInfo()->id)
            ->whereIn('status', [2, 3])
            ->with('plan')
            ->orderbyDesc('id')
            ->paginate(10);
        $plans = Plan::all()->count();
        return view('frontend.user.subscription.index', ['transactions' => $transactions, 'plans' => $plans]);
    }

    public function transaction($transaction_id)
    {
        $transaction = Transaction::where([['transaction_id', $transaction_id], ['user_id', userAuthInfo()->id]])
            ->whereIn('status', [2, 3])
            ->with(['plan', 'gateway', 'coupon'])
            ->firstOrFail();
        return view('frontend.user.subscription.transaction', ['transaction' => $transaction]);
    }
}
