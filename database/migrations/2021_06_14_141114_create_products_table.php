<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->foreignId('category_id')->references('id')->on('category');
            $table->foreignId('supplier_id')->references('id')->on('supplier');
            $table->string('godaun');
            $table->string('Product_Route');
            $table->date('buying_date');
            $table->date('expire_date');
            $table->integer('buying_price');
            $table->integer('selling_price');
            $table->string('image');
            $table->longText('description');
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
        Schema::dropIfExists('products');
    }
}
