<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('plan_id')->unsigned();
            $table->boolean('status')->default(true)->comment('0:Canceled 1:Active');
            $table->timestamp('expiry_at')->nullable();
            $table->boolean('admin_has_viewed')->default(false);
            $table->foreign("user_id")->references("id")->on('users')->onDelete('cascade');
            $table->foreign("plan_id")->references("id")->on('plans')->onDelete('cascade');
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
        Schema::dropIfExists('subscriptions');
    }
}
