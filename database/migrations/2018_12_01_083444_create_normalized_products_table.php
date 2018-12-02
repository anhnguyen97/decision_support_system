<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNormalizedProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('normalized_products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id')->nullable();
            $table->float('screen_size',8,4);
            $table->float('camera_font',8,4);
            $table->float('camera_rear',8,4);
            $table->float('cpu_speed',8,4);
            $table->float('ram',8,4);
            $table->float('internal_memory',8,4);
            $table->float('external_memory_card',8,4);
            $table->float('bluetooth',8,4);
            $table->float('length',8,4);
            $table->float('width',8,4);
            $table->float('thickness',8,4);
            $table->float('weight',8,4);
            $table->float('battery',8,4);
            $table->float('cost',8,4);
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
        Schema::dropIfExists('normalied_products');
    }
}
