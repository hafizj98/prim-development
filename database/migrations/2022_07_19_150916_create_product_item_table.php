<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_item', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('desc')->nullable();
            $table->integer('quantity')->nullable();
            $table->double('price', 8, 2)->nullable();
            $table->string('image')->nullable();
            $table->integer('status');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('product_group_id')->index();

            $table->foreign('product_group_id')->references('id')->on('product_group')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_item', function(Blueprint $table)
        {
            $table->drop('product_group_id');
        });
    }
}