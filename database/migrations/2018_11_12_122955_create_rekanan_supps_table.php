<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRekananSuppsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rekanan_supps', function(Blueprint $table)
		{
			$table->integer('id')->unsigned()->primary();
			$table->integer('rekanan_id')->nullable()->index();
			$table->integer('pt_id')->nullable()->index();
			$table->integer('penandatangan')->nullable()->index();
			$table->integer('saksi')->nullable()->index();
			$table->integer('supp_template_id')->nullable()->index();
			$table->string('no', 191)->nullable();
			$table->date('date')->nullable();
			$table->date('expired_at')->nullable();
			$table->dateTime('printed_at')->nullable();
			$table->dateTime('setuju_at')->nullable();
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
		Schema::drop('rekanan_supps');
	}

}
