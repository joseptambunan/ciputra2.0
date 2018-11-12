<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBarangkeluarDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('barangkeluar_details', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('barangkeluar_id')->nullable();
			$table->integer('permintaanbarang_detail_id')->nullable();
			$table->integer('item_id')->nullable();
			$table->integer('warehouse_id')->nullable();
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
		Schema::drop('barangkeluar_details');
	}

}
