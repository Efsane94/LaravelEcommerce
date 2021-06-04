<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned()->unique();
            $table->boolean('show_slider')->default(0);
            $table->boolean('opportunity_day')->default(0);
            $table->boolean('stand_out')->default(0);
            $table->boolean('selling_lot')->default(0);
            $table->boolean('show_sales')->default(0);
            $table->string('product_img',100);
            $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_detail');
    }
}
