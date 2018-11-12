<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePurchaserequestDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('purchaserequest_details', function(Blueprint $table)
		{
			$table->integer('id')->unsigned()->primary();
			$table->integer('purchaserequest_id');
			$table->integer('itempekerjaan_id');
			$table->integer('item_id');
			$table->integer('item_satuan_id');
			$table->integer('brand_id');
			$table->string('recomended_supplier', 191);
			$table->integer('quantity');
			$table->string('description', 191);
			$table->integer('rec_1')->nullable();
			$table->integer('rec_2')->nullable();
			$table->integer('rec_3')->nullable();
			$table->date('delivery_date');
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
		Schema::drop('purchaserequest_details');
	}

}
