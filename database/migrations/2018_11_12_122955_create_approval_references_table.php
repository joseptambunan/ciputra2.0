<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApprovalReferencesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('approval_references', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->nullable();
			$table->integer('project_id')->nullable();
			$table->integer('pt_id')->nullable();
			$table->string('document_type', 191)->nullable();
			$table->integer('no_urut')->nullable();
			$table->float('min_value', 15)->nullable();
			$table->float('max_value', 15)->nullable();
			$table->string('description', 191)->nullable();
			$table->boolean('is_action')->default(1);
			$table->timestamps();
			$table->softDeletes();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->dateTime('inactive_at')->nullable();
			$table->integer('inactive_by')->nullable();
			$table->index(['user_id','project_id','pt_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('approval_references');
	}

}
