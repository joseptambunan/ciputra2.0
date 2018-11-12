<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBarangmasuksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('barangmasuks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('purchaseorder_id')->nullable();
			$table->integer('sumber_id')->nullable();
			$table->string('sumber_type', 191)->nullable();
			$table->string('confirmed_by_warehouseman', 191)->nullable();
			$table->string('confirmed_by_requester', 191)->nullable();
			$table->dateTime('confirmed_by_warehouseman_at')->nullable();
			$table->dateTime('confirmed_by_requester_at')->nullable();
			$table->integer('approval_status_id')->default(0);
			$table->string('no', 191)->nullable();
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
		Schema::drop('barangmasuks');
	}

}
