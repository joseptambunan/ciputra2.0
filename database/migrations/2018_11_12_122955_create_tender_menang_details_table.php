<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTenderMenangDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tender_menang_details', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('tender_menang_id')->nullable()->index();
			$table->integer('templatepekerjaan_detail_id')->nullable()->index();
			$table->integer('itempekerjaan_id')->nullable()->index();
			$table->float('nilai', 15)->nullable();
			$table->float('volume', 10)->nullable();
			$table->string('satuan', 191)->nullable();
			$table->string('description', 191)->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->dateTime('inactive_at')->nullable();
			$table->integer('inactive_by')->nullable();
			$table->boolean('is_pembangunan')->nullable()->default(1);
			$table->decimal('ppn', 5)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tender_menang_details');
	}

}
