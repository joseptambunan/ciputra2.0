<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetTahunanUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget_tahunan_units', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('budget_tahunan_id')->nullable()->index();
            $table->integer('unit_type_id')->nullable()->index();
            $table->integer('volume')->nullable();
            $table->integer('total_unit')->nullable();
            $table->string('satuan', 191)->nullable();
            $table->integer('nilai')->nullable();
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
        Schema::dropIfExists('budget_tahunan_units');
    }
}
