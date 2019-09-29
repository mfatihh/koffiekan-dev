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
            $table->increments('id');
            $table->string('name', 60);
            $table->double('cash_price'); //untuk harga cash
            //$table->double('credit_price')->nullable(); //untuk harga credit
            $table->string('kode_produk');
            $table->integer('status');
            $table->string('unit_id');
            $table->string('sisa_stok');
            $table->timestamps();
        });

        Schema::create('ingredient', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ingredient_nama');
            $table->string('satuan');
            $table->integer('stok');
            $table->timestamps();
        });

        Schema::create('product_ingredient', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->integer('ingredient_id');
            $table->integer('harga');
            $table->integer('nilai');
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
        Schema::dropIfExists('ingredient');
        Schema::dropIfExists('product_ingredient');
    }
}
