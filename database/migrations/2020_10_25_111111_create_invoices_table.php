<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invoices', function (Blueprint $table) {
			$table->bigIncrements('id');

			$table->decimal('price', 15, 2);
			$table->unsignedInteger('user_id');
			$table->unsignedInteger('service_id');
			$table->enum('status', ['INIT', 'PAID', 'SUCCESS'])->default('INIT');

            $table->foreign('user_id')
                ->references('id')->on('users')->onDelete('cascade');
            $table->foreign('service_id')
                ->references('id')->on('services')->onDelete('cascade');

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
		Schema::drop('invoices');
	}
}
