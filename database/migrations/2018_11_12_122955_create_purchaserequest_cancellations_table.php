<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePurchaserequestCancellationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('purchaserequest_cancellations', function(Blueprint $table)
		{
			$table->integer('id')->unsigned()->primary();
			$table->integer('purchaserequest_id');
			$table->string('no', 191);
			$table->date('date');
			$table->string('status', 191);
			$table->string('description', 191);
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
		Schema::drop('purchaserequest_cancellations');
	}

}
