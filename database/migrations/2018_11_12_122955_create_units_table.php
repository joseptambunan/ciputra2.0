<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUnitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('units', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('blok_id')->nullable()->index();
			$table->integer('templatepekerjaan_id')->nullable()->index();
			$table->integer('pt_id')->nullable()->index();
			$table->integer('peruntukan_id')->nullable()->index();
			$table->integer('unit_arah_id')->nullable()->index();
			$table->integer('unit_hadap_id')->nullable();
			$table->integer('unit_type_id')->nullable()->index();
			$table->string('code', 191)->nullable();
			$table->string('name', 191)->nullable();
			$table->float('tanah_luas', 10)->nullable();
			$table->float('bangunan_luas', 10)->nullable();
			$table->boolean('is_sellable')->default(1);
			$table->integer('status')->default(0);
			$table->string('tag_kategori', 191)->default('b');
			$table->date('st1_date')->nullable();
			$table->date('st2_date')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->dateTime('inactive_at')->nullable();
			$table->integer('inactive_by')->nullable();
			$table->integer('unit_id')->nullable();
			$table->integer('purchaseletter_id')->nullable();
			$table->string('building_class', 32)->nullable();
			$table->integer('is_spk')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('units');
	}

}
