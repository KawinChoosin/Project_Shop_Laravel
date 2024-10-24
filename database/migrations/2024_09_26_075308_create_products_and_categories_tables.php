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
            $table->foreignId('CG_id')->constrained('categories', 'CG_id')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('customers', function (Blueprint $table) {
            $table->id('C_id');
            $table->string('C_name', 255);
            $table->string('C_password', 255);
            $table->string('C_email', 255)->unique();
            $table->timestamps();
        });
        
        Schema::create('addresses', function (Blueprint $table) {
            $table->id('A_id');
            $table->foreignId('C_id')->constrained('customers', 'C_id')->onDelete('cascade');
            $table->string('address', 255);
            $table->string('street_name_house_no', 255);
            $table->string('building', 255)->nullable();
            $table->string('postal_code', 10);
            $table->string('subdistrict', 255);
            $table->string('district', 255);
            $table->string('province', 255);
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id('O_id');
            $table->foreignId('C_id')
                ->constrained('customers', 'C_id')
                ->onDelete('cascade');
            $table->foreignId('A_id')
                ->constrained('addresses', 'A_id')
                ->onDelete('cascade');
            $table->timestamp('Q_Date_time', 3);
            $table->decimal('O_Total', 65, 30);
            $table->text('O_Description')->nullable();
            $table->timestamps();
        });

        Schema::create('order_details', function (Blueprint $table) {
            $table->id('OD_id');
            $table->foreignId('O_id')
                ->constrained('orders', 'O_id')
                ->onDelete('cascade');
            $table->foreignId('P_id')
                ->constrained('products', 'P_id')
                ->onDelete('cascade');
            $table->integer('OD_quantity');
            $table->decimal('OD_price', 65, 30);
            $table->timestamps();
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id('PM_id');
            $table->decimal('PM_amount', 65, 30);
            $table->string('PM_path', 100);
            $table->timestamp('Date_time', 3);
            $table->foreignId('O_id')
                ->constrained('orders', 'O_id')
                ->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('cart_details', function (Blueprint $table) {
            $table->id('CA_id');
            $table->foreignId('C_id')
                ->constrained('customers', 'C_id')
                ->onDelete('cascade');
            $table->foreignId('P_id')
                ->constrained('products', 'P_id')
                ->onDelete('cascade');
            $table->integer('CA_quantity');
            $table->decimal('CA_price', 65, 30);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_details');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('cart_details');
    }
}
