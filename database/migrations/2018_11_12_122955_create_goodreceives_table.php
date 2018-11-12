<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGoodreceivesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('goodreceives', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('purchaseorder_id')->nullable();
			$table->integer('approval_status_id')->nullable();
			$table->string('no', 191)->nullable();
			$table->date('date')->nullable();
			$table->boolean('is_downpayment')->default(0);
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
		Schema::drop('goodreceives');
	}

}
