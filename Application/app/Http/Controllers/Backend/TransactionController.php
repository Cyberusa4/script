<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Validator;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unviewedTransactions = Transaction::where('admin_has_viewed', 0)->whereIn('status', [2, 3])->get();
        if (count($unviewedTransactions) > 0) {
            foreach ($unviewedTransactions as $unviewedTransaction) {
                $unviewedTransaction->admin_has_viewed = 1;
                $unviewedTransaction->save();
            }
        }
        $paidTransactions = Transaction::where([['status', 2], ['total_price', '!=', 0], ['coupon_id', null]])->with(['user', 'plan', 'gateway'])->get();
        $freeTransactions = Transaction::where([['status', 2], ['total_price', 0], ['coupon_id', null]])->with(['user', 'plan', 'gateway'])->get();
        $usesCouponTransactions = Transaction::where([['status', 2], ['coupon_id', '!=', null]])->with(['user', 'plan', 'gateway', 'coupon'])->get();
        $canceledTransactions = Transaction::where('status', 3)->with(['user', 'plan', 'gateway'])->get();
        $paidAmountQuery = Transaction::where([['status', 2], ['total_price', '!=', 0]]);
        $paidAmount = [
            'total' => $paidAmountQuery->sum('total_price'),
            'subscriptions' => $paidAmountQuery->sum('plan_price'),
            'taxes' => $paidAmountQuery->sum('tax_price'),
            'fees' => $paidAmountQuery->sum('fees_price'),
        ];
        $canceledAmountQuery = Transaction::where('status', 3);
        $canceledAmount = [
            'total' => $canceledAmountQuery->sum('total_price'),
            'subscriptions' => $canceledAmountQuery->sum('plan_price'),
            'taxes' => $canceledAmountQuery->sum('tax_price'),
            'fees' => $canceledAmountQuery->sum('fees_price'),
        ];
        return view('backend.transactions.index', [
            'paidTransactions' => $paidTransactions,
            'freeTransactions' => $freeTransactions,
            'usesCouponTransactions' => $usesCouponTransactions,
            'canceledTransactions' => $canceledTransactions,
            'paidAmount' => $paidAmount,
            'canceledAmount' => $canceledAmount,
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
        return abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        abort_if($transaction->status == 0 || $transaction->status == 1, 404);
        return view('backend.transactions.edit', ['transaction' => $transaction]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validator = Validator::make($request->all(), [
            'cancellation_reason' => ['required', 'string', 'max:150'],
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                toastr()->error($error);
            }
            return back()->withInput();
        }
        if ($transaction->status != 2) {
            toastr()->error(__('Transaction cannot be canceled'));
            return back();
        }
        $updateTransaction = $transaction->update([
            'status' => 3,
            'cancellation_reason' => $request->cancellation_reason,
        ]);
        if ($updateTransaction) {
            $title = str_replace('{transaction_number}', '[#' . $transaction->transaction_id . ']', lang('Transaction canceled {transaction_number}', 'notifications'));
            $image = asset('images/icons/transaction-canceled.png');
            $link = route('user.transaction', $transaction->transaction_id);
            userNotify($transaction->user_id, $title, $image, $link);
            toastr()->success(__('Transaction Canceled Successfully'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        deleteUserNotification($transaction->user_id, route('user.transaction', $transaction->transaction_id));
        toastr()->success(__('Deleted Successfully'));
        return back();
    }
}
