<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePiutangPembayaransTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('piutang_pembayarans', function(Blueprint $table)
		{
			$table->integer('id')->unsigned()->primary();
			$table->integer('piutang_id')->nullable()->index();
			$table->integer('sumber_id')->nullable()->index();
			$table->string('sumber_type', 191)->nullable()->index();
			$table->float('nilai', 15)->nullable();
			$table->string('cara_pembayaran', 191)->nullable();
			$table->date('date')->nullable();
			$table->string('description', 191)->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->dateTime('inactive_at')->nullable();
			$table->integer('inactive_by')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('piutang_pembayarans');
	}

}
