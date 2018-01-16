<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddItemsToPackageDetails extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('package_details', function (Blueprint $table) {
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('package_details', function (Blueprint $table) {
            $table->string('item')->nullable();
        });
    }
}
