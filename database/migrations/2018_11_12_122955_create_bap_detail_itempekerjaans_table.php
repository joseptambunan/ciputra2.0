<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBapDetailItempekerjaansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bap_detail_itempekerjaans', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('bap_detail_id')->nullable();
			$table->integer('spkvo_unit_id')->nullable();
			$table->integer('itempekerjaan_id')->nullable();
			$table->float('terbayar_percent', 15, 6)->nullable();
			$table->float('lapangan_percent', 15, 6)->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->dateTime('inactive_at')->nullable();
			$table->integer('inactive_by')->nullable();
			$table->index(['bap_detail_id','itempekerjaan_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('bap_detail_itempekerjaans');
	}

}
