<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTendersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tenders', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('rab_id')->nullable();
			$table->integer('kelas_id')->nullable();
			$table->string('no', 191)->nullable();
			$table->string('name', 191)->nullable();
			$table->string('ambil_doc_date', 191)->nullable();
			$table->date('aanwijzing_date')->nullable();
			$table->date('penawaran1_date')->nullable();
			$table->date('klarifikasi1_date')->nullable();
			$table->date('penawaran2_date')->nullable();
			$table->date('klarifikasi2_date')->nullable();
			$table->date('penawaran3_date')->nullable();
			$table->date('recommendation_date')->nullable();
			$table->date('pengumuman_date')->nullable();
			$table->float('harga_dokumen')->nullable();
			$table->string('sumber', 191)->nullable();
			$table->string('description', 191)->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->dateTime('inactive_at')->nullable();
			$table->integer('inactive_by')->nullable();
			$table->dateTime('final_date')->nullable();
			$table->string('durasi', 32)->nullable();
			$table->string('sifat_tender', 32)->nullable();
			$table->index(['rab_id','kelas_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tenders');
	}

}
