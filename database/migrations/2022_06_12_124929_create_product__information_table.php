<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product__information', function (Blueprint $table) {
            $table->id();
            $table->string('bar_cod', 45);
            $table->float('pusching_price');
            $table->integer('purchased_count');
            $table->foreignId('product_id');
            $table->foreign('product_id')->on('products')->references('id')->onDelete("cascade");
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
        Schema::dropIfExists('product__information');
    }
};
