<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade');
            $table->float('screen_size')->nullable();
            $table->float('camera_font')->nullable();
            $table->float('camera_rear')->nullable();
            $table->float('cpu_speed')->nullable();
            $table->integer('ram')->nullable();
            $table->integer('internal_memory')->nullable();
            $table->integer('external_memory_card')->nullable();
            $table->float('bluetooth')->nullable();
            $table->float('length')->nullable();
            $table->float('width')->nullable();
            $table->float('thickness')->nullable();
            $table->float('weight')->nullable();
            $table->float('battery')->nullable();
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
        Schema::dropIfExists('product_details');
    }
}
