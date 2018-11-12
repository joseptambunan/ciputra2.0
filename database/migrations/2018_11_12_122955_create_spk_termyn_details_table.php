<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSpkTermynDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('spk_termyn_details', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('spk_termyn_id');
			$table->integer('item_pekerjaan_id');
			$table->integer('termyn')->nullable();
			$table->decimal('percentage', 5)->nullable()->default(0.00);
			$table->integer('created_by')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('deleted_by')->nullable();
			$table->integer('updated_by')->nullable();
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
		Schema::drop('spk_termyn_details');
	}

}
