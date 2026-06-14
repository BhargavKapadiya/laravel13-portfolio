<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLoginDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_login_devices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->ulid('uid')->unique();
            $table->unsignedBigInteger('user_id')->nullable()->comment('user table id');
            $table->text('fcm_token')->nullable();
            $table->string('platform')->nullable()->comment("Android, iOS");
            $table->string('device_model')->nullable();
            $table->string('device_manufacture')->nullable();
            $table->string('device_os_version')->nullable();
            $table->dateTime('login_date')->nullable();
            $table->dateTime('logout_date')->nullable();
            $table->tinyInteger('is_signout')->nullable()->default(0)->comment("0- No, 1- Yes");
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_login_devices');
    }
}