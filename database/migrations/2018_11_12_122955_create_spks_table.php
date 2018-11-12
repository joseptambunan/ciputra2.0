<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSpksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('spks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('project_id')->nullable()->index();
			$table->integer('dp_nilai')->nullable()->default(0);
			$table->integer('rekanan_id')->nullable()->index();
			$table->integer('tender_rekanan_id')->nullable()->index();
			$table->integer('spk_type_id')->nullable()->index();
			$table->string('spk_parent_id', 21)->nullable()->index();
			$table->string('no', 191)->nullable();
			$table->date('date')->nullable();
			$table->string('name', 191)->nullable();
			$table->date('start_date')->nullable();
			$table->date('finish_date')->nullable();
			$table->date('fa_date')->nullable();
			$table->decimal('dp_percent', 15)->nullable();
			$table->integer('denda_a')->nullable();
			$table->integer('denda_b')->nullable();
			$table->string('matauang', 191)->nullable();
			$table->float('nilai_tukar', 10)->nullable();
			$table->string('jenis_kontrak', 191)->nullable();
			$table->text('memo_cara_bayar', 65535)->nullable();
			$table->text('memo_lingkup_kerja', 65535)->nullable();
			$table->boolean('is_instruksilangsung')->default(0);
			$table->string('description', 191)->nullable();
			$table->string('carapembayaran', 191)->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->dateTime('inactive_at')->nullable();
			$table->integer('inactive_by')->nullable();
			$table->float('garansi_nilai', 10)->nullable();
			$table->integer('coa_pph_default_id')->nullable();
			$table->integer('pic_id')->nullable();
			$table->string('st_1', 12)->nullable();
			$table->string('st_2', 12)->nullable();
			$table->string('st_3', 12)->nullable();
			$table->integer('partner_id')->nullable()->index('partner_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('spks');
	}

}
