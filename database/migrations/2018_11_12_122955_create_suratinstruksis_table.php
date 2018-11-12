<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSuratinstruksisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('suratinstruksis', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('spk_id')->nullable()->index();
			$table->string('no', 191)->nullable();
			$table->date('date')->nullable();
			$table->string('perihal', 191)->nullable();
			$table->text('content', 16777215)->nullable();
			$table->boolean('biaya')->default(0);
			$table->boolean('is_tambahbiaya')->default(0);
			$table->date('start_date')->nullable();
			$table->date('finish_date')->nullable();
			$table->string('type', 191)->nullable();
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
		Schema::drop('suratinstruksis');
	}

}
