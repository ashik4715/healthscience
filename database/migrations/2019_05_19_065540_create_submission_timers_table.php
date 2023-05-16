<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmissionTimersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submission_timers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('volume');
            $table->string('issue');
            $table->string('cat_folder');
            $table->integer('category_id');
            $table->string('deadline');
            $table->string('publish_on')->nullable();
            $table->boolean('status');
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
        Schema::dropIfExists('submission_timers');
    }
}
