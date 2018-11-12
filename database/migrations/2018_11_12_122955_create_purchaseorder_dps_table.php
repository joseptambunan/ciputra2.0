<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePurchaseorderDpsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('purchaseorder_dps', function(Blueprint $table)
		{
			$table->integer('id')->unsigned()->primary();
			$table->integer('purchaseorder_id');
			$table->integer('goodreceive_detail_id');
			$table->integer('goodreceive_detail_id_applied');
			$table->date('date');
			$table->decimal('percentage');
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
		Schema::drop('purchaseorder_dps');
	}

}
