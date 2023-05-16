<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{

    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('logo');
            $table->string('name');
            $table->text('description');
            $table->string('impact_factor');
            $table->string('tag');
            $table->string('price');
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('category_color')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
