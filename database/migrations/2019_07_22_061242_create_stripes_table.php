<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStripesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stripes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('paper_id');
            $table->string('card_holder_name');
            $table->string('payment_id');
            $table->string('transaction_id');
            $table->string('payment_method');
            $table->string('amount');
            $table->string('receipt_url');
            $table->string('pay_type');
            $table->string('card_type');
            $table->string('fingerprint');
            $table->string('last4');
            $table->string('publish')->default(0);
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
        Schema::dropIfExists('stripes');
    }
}
