<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTenderRekanansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tender_rekanans', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('tender_id')->nullable();
			$table->integer('rekanan_id')->nullable();
			$table->string('sipp_no', 191)->nullable();
			$table->date('sipp_date')->nullable();
			$table->date('doc_ambil_date')->nullable();
			$table->string('doc_ambil_by', 191)->nullable();
			$table->boolean('is_pemenang')->default(0);
			$table->boolean('doc_bayar_status')->default(0);
			$table->date('doc_bayar_date')->nullable();
			$table->string('description', 191)->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->dateTime('inactive_at')->nullable();
			$table->integer('inactive_by')->nullable();
			$table->integer('is_recomendasi')->nullable();
			$table->index(['tender_id','rekanan_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tender_rekanans');
	}

}
