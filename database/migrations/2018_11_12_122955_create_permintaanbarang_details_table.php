<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePermintaanbarangDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('permintaanbarang_details', function(Blueprint $table)
		{
			$table->integer('id')->unsigned()->primary();
			$table->integer('permintaanbarang_id')->nullable();
			$table->integer('item_id')->nullable();
			$table->boolean('is_inventarisasi')->default(0);
			$table->integer('quantity')->nullable();
			$table->date('butuh_date')->nullable();
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
		Schema::drop('permintaanbarang_details');
	}

}
