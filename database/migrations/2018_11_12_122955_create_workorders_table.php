<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWorkordersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('workorders', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('budget_tahunan_id')->nullable()->index();
			$table->integer('department_from')->nullable()->index();
			$table->integer('department_to')->nullable()->index();
			$table->string('no', 191)->nullable();
			$table->string('name', 191)->nullable();
			$table->integer('durasi')->default(0);
			$table->integer('satuan_waktu')->default(0);
			$table->float('estimasi_nilaiwo', 15)->nullable();
			$table->date('date')->nullable();
			$table->integer('posisi_dokumen')->default(1);
			$table->string('description', 191)->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->dateTime('inactive_at')->nullable();
			$table->integer('inactive_by')->nullable();
			$table->dateTime('end_date')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('workorders');
	}

}
