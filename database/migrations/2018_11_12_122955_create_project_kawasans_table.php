<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectKawasansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('project_kawasans', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('project_id')->nullable();
			$table->integer('project_type_id')->nullable();
			$table->string('code', 191)->nullable();
			$table->string('name', 191)->nullable();
			$table->string('lahan_status', 191)->nullable();
			$table->float('lahan_luas', 15)->nullable();
			$table->float('lahan_sellable', 15)->default(0.00);
			$table->string('zipcode', 191)->nullable();
			$table->boolean('is_kawasan')->default(1);
			$table->string('description', 191)->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->dateTime('inactive_at')->nullable();
			$table->integer('inactive_by')->nullable();
			$table->integer('cluster_id')->nullable();
			$table->integer('status_gross')->nullable()->index('status_gross');
			$table->index(['project_id','project_type_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('project_kawasans');
	}

}
