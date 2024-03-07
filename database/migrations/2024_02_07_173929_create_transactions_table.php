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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id")->nullable();
            $table->unsignedBigInteger("withdrawal_id")->nullable();
            $table->unsignedBigInteger("advertise_id")->nullable();
            $table->unsignedBigInteger("transactionId")->nullable();
            $table->bigInteger("amount")->default(0);
            $table->string("pay_type",50)->nullable();
            $table->string("track")->nullable();
            $table->string("status")->default("before_pay")->nullable();
            $table->string("type")->nullable();
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
        Schema::dropIfExists('transactions');
    }
};
