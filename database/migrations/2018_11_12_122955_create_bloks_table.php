<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBloksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bloks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('project_id')->nullable();
			$table->integer('project_kawasan_id')->nullable();
			$table->string('name', 191)->nullable();
			$table->float('luas', 10)->nullable()->default(1.00);
			$table->string('description', 191)->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->dateTime('inactive_at')->nullable();
			$table->integer('inactive_by')->nullable();
			$table->string('kode', 21);
			$table->integer('block_id')->nullable()->index('blok_id');
			$table->index(['project_id','project_kawasan_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('bloks');
	}

}
