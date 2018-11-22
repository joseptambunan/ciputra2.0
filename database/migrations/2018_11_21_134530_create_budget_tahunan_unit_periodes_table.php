<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetTahunanUnitPeriodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget_tahunan_unit_periodes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('budget_tahunan_unit_id')->nullable()->index();
            $table->softDeletes();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->dateTime('inactive_at')->nullable();
            $table->integer('inactive_by')->nullable();
            $table->timestamps();
            $table->float('januari', 10, 0)->nullable();
            $table->float('februari', 10, 0)->nullable();
            $table->float('maret', 10, 0)->nullable();
            $table->float('april', 10, 0)->nullable();
            $table->float('mei', 10, 0)->nullable();
            $table->float('juni', 10, 0)->nullable();
            $table->float('juli', 10, 0)->nullable();
            $table->float('agustus', 10, 0)->nullable();
            $table->float('september', 10, 0)->nullable();
            $table->float('oktober', 10, 0)->nullable();
            $table->float('november', 10, 0)->nullable();
            $table->float('desember', 10, 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('budget_tahunan_unit_periodes');
    }
}
