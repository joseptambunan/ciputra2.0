<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInventoryTransfersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inventory_transfers', function(Blueprint $table)
		{
			$table->integer('id')->unsigned()->primary();
			$table->integer('warehouse_id_from')->nullable();
			$table->integer('warehouse_id_to')->nullable();
			$table->integer('sender')->nullable();
			$table->integer('receiver')->nullable();
			$table->integer('approval_status_id')->nullable();
			$table->string('no', 191)->nullable();
			$table->date('date')->nullable();
			$table->string('description', 191)->nullable();
			$table->dateTime('send_at')->nullable();
			$table->dateTime('received_at')->nullable();
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
		Schema::drop('inventory_transfers');
	}

}
