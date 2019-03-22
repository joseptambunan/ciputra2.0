<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitTypeSpecificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_type_specifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("unit_type_id")->nullable()->index();
            $table->integer("gambar")->nullable()->index();
            $table->integer("thumbs")->nullable()->index();
            $table->longText("file")->nullable();
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
        Schema::dropIfExists('unit_type_specifications');
    }
}
