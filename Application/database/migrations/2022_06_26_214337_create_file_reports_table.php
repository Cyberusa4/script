<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('file_entry_id')->unsigned();
            $table->string('ip');
            $table->string('name');
            $table->string('email');
            $table->integer('reason');
            $table->text('details');
            $table->boolean('admin_has_viewed')->default(false);
            $table->foreign("file_entry_id")->references("id")->on('file_entries')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('file_reports');
    }
}
