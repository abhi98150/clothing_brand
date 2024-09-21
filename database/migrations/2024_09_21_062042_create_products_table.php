<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name'); // Product Name
            $table->string('sku')->unique(); // SKU
            $table->string('category'); // Category
            $table->unsignedBigInteger('category_id'); // Category ID
            $table->decimal('price', 10, 2); // Price
            $table->integer('qty'); // Quantity
            $table->unsignedBigInteger('created_by'); // Created By (admin id)
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('created_by')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
