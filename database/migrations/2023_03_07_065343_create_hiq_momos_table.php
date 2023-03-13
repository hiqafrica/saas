<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hiq_momos', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('user_email');
            $table->string('phone_number');
            $table->string('payment_geteway');
            $table->string('payment_amount');
            $table->string('payment_status');
            $table->string('payment_ref');
            $table->string('payment_archive');
            $table->string('payment_key');
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
        Schema::dropIfExists('hiq_momos');
    }
};
