<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->ulid('uid')->unique();
            $table->tinyInteger('type')->nullable()->comment('1- admin message');
            $table->string('title')->nullable();
            $table->text('text')->nullable();
            $table->unsignedBigInteger('sender_id')->nullable()->comment('user table id');
            $table->bigInteger('redirect_on')->nullable()->comment('redirect table id');
            $table->text('others')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}