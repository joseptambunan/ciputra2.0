<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRekananGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rekanan_groups', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('npwp_kota')->nullable();
			$table->string('code', 191)->nullable();
			$table->string('name', 191)->nullable();
			$table->integer('pph_percent')->nullable();
			$table->string('npwp_no', 191)->nullable();
			$table->string('npwp_image', 191)->nullable();
			$table->string('npwp_alamat', 191)->nullable();
			$table->string('description', 191)->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->dateTime('inactive_at')->nullable();
			$table->integer('inactive_by')->nullable();
			$table->integer('coa_ppn')->nullable();
			$table->string('cp_name', 512)->nullable();
			$table->string('cp_jabatan', 512)->nullable();
			$table->string('saksi_name', 512)->nullable();
			$table->string('saksi_jabatan', 512)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('rekanan_groups');
	}

}
