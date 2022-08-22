<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('color', 20);
            $table->string('short_description', 150);
            $table->tinyInteger('interval')->comment('1:Monthly 2:Yearly 3:Lifetime');
            $table->float('price', 10, 2)->default(0);
            $table->string('storage_space')->nullable();
            $table->string('file_size')->nullable();
            $table->bigInteger('files_duration')->nullable();
            $table->string('upload_at_once');
            $table->boolean('password_protection')->comment('0:No 1:Yes');
            $table->boolean('advertisements')->comment('0:No 1:Yes');
            $table->longText('custom_features')->nullable();
            $table->boolean('require_login')->default(true);
            $table->boolean('free_plan')->default(false)->comment('0:No 1:Yes');;
            $table->boolean('featured_plan')->default(false)->comment('0:No 1:Yes');;
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
        Schema::dropIfExists('plans');
    }
}
