<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('email_templates', function (Blueprint $table) {
            $table->id();
            $table->ulid('uid')->unique();
            $table->string('title')->nullable();
            $table->string('subject')->nullable();
            $table->binary('body')->nullable();
            $table->tinyInteger('status')->nullable()->default(1)->comment('1-Yes,0-No');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_templates');
    }
};