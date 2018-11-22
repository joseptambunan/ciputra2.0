<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItempekerjaanHargasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itempekerjaan_hargas', function (Blueprint $table) {
			$table->increments('id');
            $table->integer('itempekerjaan_id')->nullable()->index();
            $table->integer('project_id')->nullable()->index();
            $table->float('nilai', 15)->default(0.00);
            $table->string('satuan', 191)->nullable();
            $table->softDeletes();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->dateTime('inactive_at')->nullable();
            $table->integer('inactive_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('itempekerjaan_hargas');
    }
}
