<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItempekerjaansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('itempekerjaans', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('parent_id')->nullable()->index();
			$table->integer('department_id')->nullable()->index();
			$table->integer('group_cost')->nullable();
			$table->string('code', 191)->nullable();
			$table->integer('tag')->default(0);
			$table->string('name', 191)->nullable();
			$table->decimal('ppn', 5)->default(0.00);
			$table->string('description', 191)->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->dateTime('inactive_at')->nullable();
			$table->integer('inactive_by')->nullable();
			$table->string('coa_ppn', 64)->nullable();
			$table->integer('escrow_id')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('itempekerjaans');
	}

}
