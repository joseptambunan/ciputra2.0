<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRabPekerjaansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rab_pekerjaans', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('rab_unit_id')->nullable()->index();
			$table->integer('templatepekerjaan_detail_id')->nullable()->index();
			$table->integer('itempekerjaan_id')->nullable();
			$table->decimal('nilai', 24)->nullable();
			$table->float('volume', 10)->nullable();
			$table->string('satuan', 191)->nullable();
			$table->decimal('ppn', 5)->default(0.00);
			$table->string('description', 191)->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->dateTime('inactive_at')->nullable();
			$table->integer('inactive_by')->nullable();
			$table->boolean('is_pembangunan')->nullable()->default(1);
			$table->integer('urutitem')->nullable();
			$table->integer('termin')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('rab_pekerjaans');
	}

}
