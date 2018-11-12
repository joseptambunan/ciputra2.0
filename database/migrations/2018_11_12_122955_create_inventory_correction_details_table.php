<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInventoryCorrectionDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inventory_correction_details', function(Blueprint $table)
		{
			$table->integer('id')->unsigned()->primary();
			$table->integer('inventory_correction_id')->index();
			$table->integer('item_id')->index();
			$table->integer('warehouse_id')->index();
			$table->integer('satuan_id')->index();
			$table->integer('quantity_app')->nullable();
			$table->integer('quantity_fisik')->nullable();
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
		Schema::drop('inventory_correction_details');
	}

}
