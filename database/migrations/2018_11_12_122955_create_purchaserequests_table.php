<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePurchaserequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('purchaserequests', function(Blueprint $table)
		{
			$table->integer('id')->unsigned()->primary();
			$table->integer('pt_id');
			$table->integer('department_id');
			$table->integer('location_id');
			$table->string('no', 191);
			$table->date('date');
			$table->date('butuh_date');
			$table->string('is_urgent', 8);
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
		Schema::drop('purchaserequests');
	}

}
