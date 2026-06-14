<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationReceiversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_receivers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->ulid('uid')->unique();
            $table->unsignedBigInteger('notification_id')->comment('notification table id');
            $table->unsignedBigInteger('receiver_id')->comment('user table id');
            $table->tinyInteger('status')->default(0)->comment('0 - Unread, 1 - Read');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('notification_id')->references('id')->on('notifications')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notification_receivers');
    }
}