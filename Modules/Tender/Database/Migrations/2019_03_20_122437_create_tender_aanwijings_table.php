<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenderAanwijingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tender_aanwijings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("tender_id")->nullable()->index();
            $table->datetime("tanggal")->nullable();
            $table->time("waktu")->nullable();
            $table->string("tempat")->nullable();
            $table->string("masa_pelaksanaan")->nullable();
            $table->string("masa_penawaran")->nullable();
            $table->string("jaminan_penawaran")->nullable();
            $table->string("jaminan_pelaksanaan")->nullable();
            $table->string("denda")->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->integer("created_by")->nullable();
            $table->integer("updated_by")->nullable();
            $table->integer("deleted_by")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tender_aanwijing');
    }
}
