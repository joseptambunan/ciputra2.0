<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssetProgressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('asset_progresses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('asset_id')->nullable()->index();
			$table->string('asset_type', 191)->nullable();
			$table->integer('templatepekerjaan_detail_id')->nullable()->index();
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
		Schema::drop('asset_progresses');
	}

}
