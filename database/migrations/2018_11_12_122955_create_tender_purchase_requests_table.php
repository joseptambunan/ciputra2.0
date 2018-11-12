<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTenderPurchaseRequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tender_purchase_requests', function(Blueprint $table)
		{
			$table->integer('id')->unsigned()->primary();
			$table->integer('rab_id')->nullable();
			$table->integer('kelas_id')->nullable();
			$table->string('no', 191)->nullable();
			$table->string('name', 191)->nullable();
			$table->date('ambil_doc_date')->nullable();
			$table->date('aanwijzing_date')->nullable();
			$table->date('penawaran1_date')->nullable();
			$table->date('klarifikasi1_date')->nullable();
			$table->date('penawaran2_date')->nullable();
			$table->date('klarifikasi2_date')->nullable();
			$table->date('penawaran3_date')->nullable();
			$table->date('final_date')->nullable();
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
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tender_purchase_requests');
	}

}
