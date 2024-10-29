<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCIdToAddressesTable extends Migration
{
    public function up()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->unsignedBigInteger('C_id'); // Set default to 1 for demo
            $table->foreign('C_id')->references('C_id')->on('customers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropForeign(['C_id']);
            $table->dropColumn('C_id');
        });
    }
}
