<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsAndCategoriesTables extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id('CG_id');
            $table->string('CG_name', 255);
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id('P_id');
            $table->string('P_name', 255);
            $table->text('P_description')->nullable();
            $table->integer('P_quantity');
            $table->integer('P_price');
            $table->string('P_img', 1000)->nullable();
            $table->foreignId('CG_id')->constrained('categories', 'CG_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');
    }
}
