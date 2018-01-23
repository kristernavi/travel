<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserToCardTransaction extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('card_transcations', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('card_transcations', function (Blueprint $table) {
        });
    }
}
