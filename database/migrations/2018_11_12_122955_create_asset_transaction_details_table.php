<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssetTransactionDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('asset_transaction_details', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('asset_transaction_id')->nullable();
			$table->integer('asset_detail_item_id')->nullable();
			$table->integer('from_user_id')->nullable();
			$table->integer('from_department_id')->nullable();
			$table->integer('from_unit_sub_id')->nullable();
			$table->integer('from_location_id')->nullable();
			$table->integer('to_user_id')->nullable();
			$table->integer('to_department_id')->nullable();
			$table->integer('to_unit_sub_id')->nullable();
			$table->integer('to_location_id')->nullable();
			$table->dateTime('received_at')->nullable();
			$table->integer('status')->nullable();
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
		Schema::drop('asset_transaction_details');
	}

}
