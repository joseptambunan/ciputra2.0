<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBapsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('baps', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('spk_id')->nullable()->index();
			$table->date('date')->nullable();
			$table->integer('termin')->nullable();
			$table->string('no', 191)->nullable();
			$table->float('nilai_administrasi', 15)->nullable();
			$table->float('nilai_denda', 15)->nullable();
			$table->float('nilai_selisih', 15)->nullable();
			$table->decimal('nilai_talangan', 11)->nullable();
			$table->decimal('nilai_dp', 11)->nullable();
			$table->bigInteger('nilai_bap_1')->nullable();
			$table->bigInteger('nilai_bap_2')->nullable();
			$table->bigInteger('nilai_bap_3')->nullable();
			$table->bigInteger('nilai_bap_dibayar')->nullable();
			$table->bigInteger('nilai_retensi');
			$table->integer('nilai_pembayaran_saat_ini')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->dateTime('inactive_at')->nullable();
			$table->integer('inactive_by')->nullable();
			$table->integer('spk_retensi_id')->nullable();
			$table->decimal('percentage', 5)->nullable();
			$table->integer('percentage_lapangan')->nullable();
			$table->integer('percentage_sebelumnyas')->nullable();
			$table->integer('status_voucher');
			$table->integer('nilai_spk')->nullable();
			$table->integer('nilai_vo')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('baps');
	}

}
