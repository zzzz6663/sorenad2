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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();;
            $table->string('family')->nullable();
            $table->string('mobile')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('role')->nullable();
            $table->string('avatar',30)->nullable();
            $table->string('mellicode',30)->nullable();
            $table->string('shaba',30)->nullable();
            $table->string('cart',30)->nullable();
            $table->string('account',50)->nullable();
            $table->string('a_mellicode',50)->nullable();
            $table->string('bank',50)->nullable();
            $table->string('active',5)->default(0)->nullable();
            $table->string('deleted',5)->default(0)->nullable();
            $table->timestamp('confirm_bank_account')->nullable();
            $table->string('vip',5)->default(0)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
