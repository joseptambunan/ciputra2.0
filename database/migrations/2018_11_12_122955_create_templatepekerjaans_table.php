<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTemplatepekerjaansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('templatepekerjaans', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('code', 191)->nullable();
			$table->integer('unit_type_id');
			$table->integer('tag')->default(0);
			$table->string('name', 191)->nullable();
			$table->float('luasbangunan', 10)->default(0.00);
			$table->float('luas_tanah', 11);
			$table->float('hppbangunanpermeter', 15)->nullable();
			$table->boolean('is_sellable')->default(1);
			$table->string('description', 191)->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
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
		Schema::drop('templatepekerjaans');
	}

}
