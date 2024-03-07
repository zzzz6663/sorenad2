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
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger("user_id")->nullable();
            $table->unsignedInteger("cat_id")->nullable();
            $table->string("name")->nullable();
            $table->string("site")->nullable();
            $table->string("status")->nullable();
            $table->text("reason")->nullable();
            $table->string("popup_window",5)->nullable();
            $table->string("floating_ad_app",5)->nullable();
            $table->string("show_count_day",5)->nullable();
            $table->string("confirm",)->nullable();
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
        Schema::dropIfExists('sites');
    }
};
