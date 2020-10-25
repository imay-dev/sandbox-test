<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsLogTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions_log', function (Blueprint $table) {
            $table->engine="innoDB";
            $table->bigIncrements('id');
            $table->unsignedBigInteger('transaction_id');
            $table->string('result_code', 10)->nullable();
            $table->string('result_message', 255)->nullable();

            $table->foreign('transaction_id')
                ->references('id')->on('transactions')->onDelete('cascade');
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
        Schema::drop('transactions_log');
    }
}
