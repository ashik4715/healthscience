<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailExcelsTable extends Migration
{

    public function up()
    {
        Schema::create('email_excels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('author_name');
            $table->string('publisher');
            $table->string('country');
            $table->string('email');
            $table->string('year');
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('email_excels');
    }
}
