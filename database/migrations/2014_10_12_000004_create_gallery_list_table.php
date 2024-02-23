<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleryListTable extends Migration
{
    public function up()
    {
        Schema::create('gallery_list', function (Blueprint $table) {
            $table->id();
            $table->string('image_path')->nullable();
            $table->integer('slug')->nullable();
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('gallery_list');
    }
}