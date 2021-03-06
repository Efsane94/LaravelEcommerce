<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cart_id')->unsigned();
            $table->decimal('order_total',10,4);
            $table->string('status',30)->nullable();

            $table->string('username',50);
            $table->string('address',200);
            $table->string('phone',15);
            $table->string('card',20);
            $table->string('installment_count')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->unique('cart_id');
            $table->foreign('cart_id')->references('id')->on('cart')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
