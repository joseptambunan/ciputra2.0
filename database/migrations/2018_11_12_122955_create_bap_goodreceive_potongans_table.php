<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBapGoodreceivePotongansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bap_goodreceive_potongans', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('head_id')->nullable()->index();
			$table->string('head_type', 191)->nullable()->index();
			$table->integer('voucher_id')->nullable()->index();
			$table->integer('coa_id')->nullable()->index();
			$table->float('nilai', 15)->nullable();
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
		Schema::drop('bap_goodreceive_potongans');
	}

}
