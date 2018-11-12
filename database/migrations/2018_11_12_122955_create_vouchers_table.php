<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVouchersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vouchers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('project_id');
			$table->integer('head_id')->nullable()->index();
			$table->string('head_type', 191)->nullable()->index();
			$table->integer('rekanan_id')->nullable()->index();
			$table->integer('rekanan_rekening_id')->nullable();
			$table->integer('department_id')->nullable()->index();
			$table->integer('pt_id')->nullable()->index();
			$table->date('date')->nullable();
			$table->string('no', 191)->nullable();
			$table->string('no_faktur', 191)->nullable();
			$table->date('tempo_date')->nullable();
			$table->date('penyerahan_date')->nullable();
			$table->date('pencairan_date')->nullable();
			$table->boolean('is_out')->default(1);
			$table->integer('export_count')->nullable();
			$table->integer('posting')->nullable();
			$table->string('description', 191)->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->dateTime('inactive_at')->nullable();
			$table->integer('inactive_by')->nullable();
			$table->string('spm_status', 1)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('vouchers');
	}

}
