<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('material_list_id');
            $table->integer('product_id');
            $table->integer('material_id');
            $table->smallInteger('order');
            $table->string('image_url', 200);

            $table->index('material_list_id');
            $table->index(['product_id', 'material_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('material_images');
    }
}
