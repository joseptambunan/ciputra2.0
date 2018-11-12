<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUnitProgressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('unit_progresses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('project_id')->nullable()->index();
			$table->integer('unit_id')->nullable()->index();
			$table->string('unit_type', 191)->nullable();
			$table->integer('itempekerjaan_id')->nullable()->index('itempekerjaan_id');
			$table->integer('group_tahapan_id')->nullable();
			$table->integer('group_item_id')->nullable();
			$table->integer('urutitem')->nullable();
			$table->integer('termin')->nullable();
			$table->float('nilai', 15)->default(0.00);
			$table->string('volume', 191)->nullable();
			$table->string('satuan', 191)->nullable();
			$table->decimal('bobot', 7, 4)->nullable();
			$table->integer('durasi')->default(0);
			$table->boolean('is_pembangunan')->default(1);
			$table->decimal('progresslapangan_percent', 5)->nullable();
			$table->decimal('progressbap_percent', 5)->nullable();
			$table->date('mulai_jadwal_date')->nullable();
			$table->date('selesai_jadwal_date')->nullable();
			$table->date('selesai_actual_date')->nullable();
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
		Schema::drop('unit_progresses');
	}

}
