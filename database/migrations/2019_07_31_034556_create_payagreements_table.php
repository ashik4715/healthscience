<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayagreementsTable extends Migration
{

    public function up()
    {
        Schema::create('payagreements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('submit_id');
            $table->string('agreement')->nullable();
            $table->string('payment')->nullable();
            $table->boolean('status')->default(0);
            $table->integer('update_count')->default(0);
            $table->boolean('is_done')->default(0);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('payagreements');
    }
}
