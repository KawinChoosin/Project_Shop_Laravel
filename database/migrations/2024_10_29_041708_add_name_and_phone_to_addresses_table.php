<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->string('A_name')->nullable(); // Add name column
            $table->string('A_phone_number')->nullable(); // Add phone number column
        });
    }

    public function down()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropColumn(['A_name', 'A_phone_number']); // Drop columns on rollback
        });
    }
};
