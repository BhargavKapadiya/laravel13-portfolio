<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->ulid('uid')->unique();
            $table->string('name')->nullable();
            $table->string('short_code', 10)->nullable();
            $table->string('isd_code', 10)->nullable();
            $table->string('flag')->nullable();
            $table->string('currency', 50)->nullable();
            $table->string('currency_symbol', 10)->nullable();
            $table->tinyInteger('status')->nullable()->default(1)->comment('1 - Yes, 0 - No');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}