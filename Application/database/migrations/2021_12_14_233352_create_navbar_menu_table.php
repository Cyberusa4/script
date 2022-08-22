<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNavbarMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navbar_menu', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('page');
            $table->string('lang', 3);
            $table->string('name', 100);
            $table->tinyInteger('type');
            $table->text('link');
            $table->integer('sort_id');
            $table->foreign("lang")->references("code")->on('languages')->onDelete('cascade');
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
        Schema::dropIfExists('navbar_menu');
    }
}
