<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInventoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inventories', function(Blueprint $table)
		{
			$table->integer('id')->unsigned()->primary();
			$table->integer('item_id')->nullable();
			$table->integer('rekanan_id')->nullable();
			$table->integer('warehouse_id')->nullable();
			$table->integer('sumber_id')->nullable();
			$table->string('sumber_type', 191)->nullable();
			$table->date('date')->nullable();
			$table->integer('quantity')->nullable();
			$table->integer('quantity_terpakai')->nullable();
			$table->float('price', 15)->nullable();
			$table->integer('description')->nullable();
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
		Schema::drop('inventories');
	}

}
