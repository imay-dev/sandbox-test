<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transactions', function (Blueprint $table) {
			$table->engine = "innoDB";
			$table->bigIncrements('id');

			$table->enum('driver', array_keys(config('payment.map')));
			$table->decimal('price', 15, 2);
			$table->string('reference_id', 100)->nullable()->unique();
			$table->unsignedBigInteger('invoice_id');
			$table->string('tracking_code', 50)->nullable();
			$table->string('card_number', 50)->nullable();
			$table->enum('status', ['INIT', 'SUCCEED', 'FAILED'])->default('INIT');
			$table->timestamp('paid_at')->nullable();
            $table->text('description')->nullable();

            $table->foreign('invoice_id')
                ->references('id')->on('invoices')->onDelete('cascade');

            $table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('transactions');
	}
}
