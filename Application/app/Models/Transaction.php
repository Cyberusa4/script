<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'checkout_id',
        'transaction_id',
        'user_id',
        'plan_id',
        'coupon_id',
        'details_before_discount',
        'details_after_discount',
        'plan_price',
        'tax_price',
        'fees_price',
        'total_price',
        'payment_gateway_id',
        'payment_id',
        'payer_id',
        'payer_email',
        'type',
        'status',
        'cancellation_reason',
        'admin_has_viewed',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'details_before_discount' => 'object',
        'details_after_discount' => 'object',
    ];

    /**
     * Relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id', 'id');
    }

    public function gateway()
    {
        return $this->belongsTo(PaymentGateway::class, 'payment_gateway_id', 'id');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'coupon_id', 'id');
    }
}
