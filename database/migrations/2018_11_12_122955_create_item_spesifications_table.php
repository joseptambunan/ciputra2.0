<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemSpesificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('item_spesifications', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('project_id')->nullable()->index('project_id');
			$table->integer('itempekerjaan_id')->nullable()->index('itempekerjaan_id');
			$table->string('name', 512)->nullable();
			$table->decimal('volume', 15)->nullable();
			$table->string('satuan', 8)->nullable();
			$table->integer('nilai')->nullable();
			$table->integer('created_by')->nullable();
			$table->timestamps();
			$table->integer('updated_by')->nullable();
			$table->softDeletes();
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
		Schema::drop('item_spesifications');
	}

}
