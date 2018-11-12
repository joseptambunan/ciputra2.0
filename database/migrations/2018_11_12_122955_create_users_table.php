<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('user_login', 191)->unique();
			$table->string('user_name', 191);
			$table->boolean('is_rekanan')->default(0);
			$table->string('email', 191)->nullable();
			$table->string('user_phone', 191)->nullable();
			$table->string('digitalsignature', 191)->nullable();
			$table->string('photo', 191)->nullable();
			$table->string('password', 191);
			$table->string('description', 191)->nullable();
			$table->string('remember_token', 100)->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->dateTime('inactive_at')->nullable();
			$table->integer('inactive_by')->nullable();
			$table->integer('user_id')->nullable()->index('user_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//Schema::drop('users');
	}

}
