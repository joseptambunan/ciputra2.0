<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupPrivilegesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('group_privileges', function(Blueprint $table)
		{
			$table->integer('id')->unsigned()->primary();
			$table->integer('user_group_id')->nullable();
			$table->integer('menu_id')->nullable();
			$table->boolean('add')->default(1);
			$table->boolean('edit')->default(1);
			$table->boolean('delete')->default(1);
			$table->boolean('view')->default(1);
			$table->boolean('visible')->default(1);
			$table->timestamps();
			$table->softDeletes();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->dateTime('inactive_at')->nullable();
			$table->integer('inactive_by')->nullable();
			$table->index(['user_group_id','menu_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('group_privileges');
	}

}
