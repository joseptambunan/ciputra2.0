<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePermintaanbarangsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('permintaanbarangs', function(Blueprint $table)
		{
			$table->integer('id')->unsigned()->primary();
			$table->integer('project_id')->nullable();
			$table->integer('pt_id')->nullable();
			$table->integer('department_id')->nullable();
			$table->integer('spk_id')->nullable();
			$table->integer('user_id')->nullable();
			$table->string('no', 191)->nullable();
			$table->date('date')->nullable();
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
		Schema::drop('permintaanbarangs');
	}

}
