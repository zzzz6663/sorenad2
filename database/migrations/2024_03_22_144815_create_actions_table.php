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
        Schema::create('actions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("advertiser_id")->nullable();
            $table->unsignedBigInteger("site_id")->nullable();
            $table->unsignedBigInteger("advertise_id")->nullable();
            $table->string("type",20)->nullable();
            $table->string("site",250)->nullable();
            $table->string("amount",20)->nullable();
            $table->string("signature",200)->nullable();
            $table->string("active",20)->default(1)->nullable();
            $table->string("ip",50)->nullable();
            $table->string("count_type",50)->nullable();
            $table->integer("site_share")->nullable();
            $table->integer("admin_share")->nullable();
            $table->integer("adveriser_share")->nullable();
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
        Schema::dropIfExists('actions');
    }
};
