<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBarangkeluarDetailPricesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('barangkeluar_detail_prices', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('barangkeluar_detail_id')->nullable();
			$table->integer('inventory_id')->nullable();
			$table->integer('quantity')->nullable();
			$table->float('price', 15)->nullable();
			$table->decimal('ppn', 5)->nullable();
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
		Schema::drop('barangkeluar_detail_prices');
	}

}
