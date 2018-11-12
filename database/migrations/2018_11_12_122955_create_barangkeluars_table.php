<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBarangkeluarsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('barangkeluars', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('permintaanbarang_id')->nullable();
			$table->integer('confirmed_by_warehouseman')->nullable();
			$table->integer('confirmed_by_requester')->nullable();
			$table->integer('approval_status_id')->nullable();
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
		Schema::drop('barangkeluars');
	}

}
