<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTemplatepekerjaanDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('templatepekerjaan_details', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('templatepekerjaan_id')->nullable()->index();
			$table->integer('itempekerjaan_id')->nullable()->index();
			$table->integer('group_tahapan_id')->nullable()->index();
			$table->integer('group_item_id')->nullable()->index();
			$table->integer('periode_id')->nullable();
			$table->integer('urutitem')->nullable();
			$table->integer('termin')->nullable();
			$table->float('nilai', 15)->default(0.00);
			$table->string('volume', 191)->nullable();
			$table->string('satuan', 191)->nullable();
			$table->decimal('bobot', 5)->nullable();
			$table->integer('durasi')->default(0);
			$table->boolean('is_pembangunan')->default(1);
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
		Schema::drop('templatepekerjaan_details');
	}

}
