<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTenderPenawaranDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tender_penawaran_details', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('tender_penawaran_id')->nullable()->index();
			$table->integer('rab_pekerjaan_id')->nullable()->index();
			$table->string('keterangan', 191)->nullable();
			$table->float('nilai', 15)->nullable();
			$table->float('volume', 10)->nullable();
			$table->string('satuan', 32);
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
		Schema::drop('tender_penawaran_details');
	}

}
