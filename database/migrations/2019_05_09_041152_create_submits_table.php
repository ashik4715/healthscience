<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmitsTable extends Migration
{

    public function up()
    {
        Schema::create('submits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('paper_id')->unique();
            $table->string('paper_access_key')->unique();
            $table->integer('user_id');
            $table->integer('type_id');
            $table->integer('journal_id');
            $table->integer('issue_id');
            $table->string('aresearch');
            $table->string('ptitle');
            $table->string('title_slug');
            $table->text('abstract');
            $table->string('docx');
            $table->string('pdf');
            $table->text('author_name');
            $table->text('paper_tags');
            $table->text('funder_name');
            $table->integer('no_figures');
            $table->integer('no_tables');
            $table->integer('no_words');
            $table->integer('terms_and_condition');
            $table->integer('agreement');
            $table->integer('special_issue')->default(0);
            $table->integer('status')->default(0);
            $table->boolean('is_payment')->default(0);
            $table->boolean('publish')->default(0);
            $table->integer('auto_publish')->default(0);
            $table->integer('view_count')->default(0);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('submits');
    }
}
