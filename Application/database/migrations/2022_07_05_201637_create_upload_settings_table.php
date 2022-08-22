<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upload_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('symbol');
            $table->string('icon');
            $table->string('storage_space')->nullable();
            $table->string('file_size')->nullable();
            $table->bigInteger('files_duration')->nullable();
            $table->string('upload_at_once');
            $table->boolean('password_protection')->comment('0:No 1:Yes');
            $table->boolean('advertisements')->comment('0:No 1:Yes');
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('upload_settings');
    }
}
