<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemPricesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('item_prices', function(Blueprint $table)
		{
			$table->integer('id')->unsigned()->primary();
			$table->integer('item_id');
			$table->integer('project_id');
			$table->float('price_kecil', 15);
			$table->float('price_besar', 15);
			$table->string('matauang', 191);
			$table->float('kurs', 15);
			$table->integer('volume');
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
		Schema::drop('item_prices');
	}

}