<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePtMasterRekeningsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pt_master_rekenings', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('pt_id')->nullable();
			$table->integer('bank_id')->nullable();
			$table->string('rekening', 64)->nullable();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->timestamp('inactive_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->integer('inactive_by')->nullable();
			$table->softDeletes();
			$table->timestamps();
			$table->index(['pt_id','bank_id'], 'pt_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pt_master_rekenings');
	}

}
