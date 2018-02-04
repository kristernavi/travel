<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserCardInUsers extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->unsignedInteger('card_id')->nullable();
            $table->foreign('card_id')->references('id')->on('cards');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
        });
    }
}
