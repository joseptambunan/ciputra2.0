<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenderBeritaAcarasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tender_berita_acaras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("tender_id")->nullable()->index();
            $table->integer("step")->nullable();
            $table->string("resume")->nullable();
            $table->longtext("content")->nullable();
            $table->timestamps();
            $table->softDeletes();
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
        Schema::dropIfExists('tender_berita_acara');
    }
}
