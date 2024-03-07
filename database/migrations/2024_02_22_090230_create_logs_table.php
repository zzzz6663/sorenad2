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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id")->nullable();
            $table->unsignedBigInteger("site_id")->nullable();
            $table->unsignedBigInteger("advertise_id")->nullable();
            $table->unsignedBigInteger("transaction_id")->nullable();
            $table->unsignedBigInteger("answer_id")->nullable();
            $table->unsignedBigInteger("withdrawal_id")->nullable();
            $table->string("log")->nullable();
            $table->string("type")->nullable();
            $table->string("link")->nullable();
            $table->timestamp("seen")->nullable();
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
        Schema::dropIfExists('logs');
    }
};
