<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('checkout_id')->unique();
            $table->string('transaction_id')->unique();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('plan_id')->unsigned();
            $table->bigInteger('coupon_id')->unsigned()->nullable();
            $table->longText('details_before_discount')->nullable();
            $table->longText('details_after_discount')->nullable();
            $table->float('plan_price', 10, 2);
            $table->float('tax_price', 10, 2)->default(0.00);
            $table->float('fees_price', 10, 2)->default(0.00);
            $table->float('total_price', 10, 2);
            $table->bigInteger('payment_gateway_id')->unsigned()->nullable();
            $table->string('payment_id')->nullable();
            $table->string('payer_id')->nullable();
            $table->string('payer_email')->nullable();
            $table->tinyInteger('type')->comment('1:Subscribe 2:renew 3:Upgrade');
            $table->tinyInteger('status')->default(0)->comment('1:Pending 2:Paid 3:Canceled');
            $table->text('cancellation_reason')->nullable();
            $table->boolean('admin_has_viewed')->default(false);
            $table->foreign("user_id")->references("id")->on('users')->onDelete('cascade');
            $table->foreign("plan_id")->references("id")->on('plans')->onDelete('cascade');
            $table->foreign("coupon_id")->references("id")->on('coupons')->onDelete('cascade');
            $table->foreign("payment_gateway_id")->references("id")->on('payment_gateways')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
