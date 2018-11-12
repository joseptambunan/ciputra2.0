<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssetDetailItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('asset_detail_items', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('asset_detail_id')->nullable();
			$table->integer('barangkeluar_detail_price_id')->nullable();
			$table->integer('item_id')->nullable();
			$table->string('barcode', 191)->nullable();
			$table->integer('status')->default(0);
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
		Schema::drop('asset_detail_items');
	}

}
