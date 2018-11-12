<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRekanansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rekanans', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('rekanan_group_id')->nullable();
			$table->integer('kelas_id')->nullable();
			$table->integer('surat_kota')->nullable();
			$table->string('name', 191)->nullable();
			$table->string('surat_alamat', 191)->nullable();
			$table->string('surat_kodepos', 191)->nullable();
			$table->string('email', 191)->nullable();
			$table->string('telp', 191)->nullable();
			$table->string('fax', 191)->nullable();
			$table->string('cp_name', 191)->nullable();
			$table->string('cp_ktp', 191)->nullable();
			$table->string('cp_ktp_image', 191)->nullable();
			$table->string('cp_jabatan', 191)->nullable();
			$table->string('cp_whatsap', 191)->nullable();
			$table->string('cp_line', 191)->nullable();
			$table->integer('survey_status')->nullable()->default(1);
			$table->date('survey_date')->nullable();
			$table->date('pkp_date')->nullable();
			$table->integer('pkp_status')->nullable()->default(1);
			$table->integer('aktif_status')->nullable()->default(2);
			$table->integer('stujk')->nullable()->default(1);
			$table->string('siup_no', 191)->nullable();
			$table->string('siup_image', 191)->nullable();
			$table->string('tdp_no', 191)->nullable();
			$table->string('tdp_image', 191)->nullable();
			$table->date('gabung_date')->nullable();
			$table->string('description', 191)->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->dateTime('inactive_at')->nullable();
			$table->integer('inactive_by')->nullable();
			$table->integer('ppn');
			$table->string('saksi_name', 512)->nullable();
			$table->string('saksi_jabatan', 512)->nullable();
			$table->index(['kelas_id','surat_kota','rekanan_group_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('rekanans');
	}

}
