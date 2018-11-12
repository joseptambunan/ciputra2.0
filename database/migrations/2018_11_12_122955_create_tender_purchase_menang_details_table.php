<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTenderPurchaseMenangDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tender_purchase_menang_details', function(Blueprint $table)
		{
			$table->integer('id')->unsigned()->primary();
			$table->integer('tender_menang_id')->nullable()->index();
			$table->integer('templatepekerjaan_detail_id')->nullable()->index();
			$table->integer('itempekerjaan_id')->nullable()->index();
			$table->boolean('is_pembangunan')->default(1);
			$table->float('nilai', 15)->nullable();
			$table->integer('volume')->nullable();
			$table->string('satuan', 191)->nullable();
			$table->decimal('ppn', 5)->default(0.00);
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
		Schema::drop('tender_purchase_menang_details');
	}

}
