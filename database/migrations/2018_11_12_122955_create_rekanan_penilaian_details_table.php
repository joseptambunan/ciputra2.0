<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRekananPenilaianDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rekanan_penilaian_details', function(Blueprint $table)
		{
			$table->integer('id')->unsigned()->primary();
			$table->integer('rekanan_penilaian_id')->nullable()->index();
			$table->integer('spk_id')->nullable()->index();
			$table->integer('grade')->nullable();
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
		Schema::drop('rekanan_penilaian_details');
	}

}
