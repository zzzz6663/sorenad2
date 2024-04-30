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
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger("user_id")->nullable();
            $table->string("name")->nullable();
            $table->string("active")->default(1)->nullable();
            $table->timestamps();
        });
        Schema::create('advertise_group', function (Blueprint $table) {
            $table->unsignedBigInteger('advertise_id');
            // $table->foreign('advertise_id')->references('id')->on('curts')->onDelete('cascade');
            $table->unsignedBigInteger('group_id');
            // $table->foreign('cat_id')->references('id')->on('cats')->onDelete('cascade');
            // $table->primary(['advertise_id','cat_id']);
            // $table->string('active')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertise_group');
        Schema::dropIfExists('groups');
    }
};
