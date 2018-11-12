<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTenderDocumentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tender_documents', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('tender_id')->nullable()->index('tender_id');
			$table->string('document_name', 64)->nullable();
			$table->integer('created_by')->nullable();
			$table->timestamps();
			$table->integer('updated_by')->nullable();
			$table->softDeletes();
			$table->integer('deleted_by')->nullable();
			$table->integer('inactive_by')->nullable();
			$table->dateTime('inactive_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tender_documents');
	}

}
