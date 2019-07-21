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
            $table->string('title');
            $table->double('price',10,2)->nullable();
            $table->unsignedInteger('brand_id');
            $table->integer('stock')->default(0);
            $table->unsignedInteger('subcategory_id');
            $table->UnsignedInteger('action')->nullable();
            $table->string('status')->default('pending');
            $table->unsignedinteger('type')->nullable();
            $table->unsignedinteger('offer')->nullable();
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
