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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name',45);
            $table->float('price');
            $table->string('code',20)->unique();
            $table->string('info',100)->nullable();
            $table->integer('count');
            $table->boolean('exist')->default(true);
            $table->foreignId('sub_category_id');
            $table->foreign('sub_category_id')->on('sub_categories')->references('id')->onDelete('cascade');
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
};
