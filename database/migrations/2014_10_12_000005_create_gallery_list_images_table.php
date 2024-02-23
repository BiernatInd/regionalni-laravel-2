<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleryListImagesTable extends Migration
{
    public function up()
    {
        Schema::create('gallery_list_images', function (Blueprint $table) {
            $table->id();
            $table->string('image_path')->nullable();
            $table->integer('slug')->nullable();
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('gallery_list_images');
    }
}