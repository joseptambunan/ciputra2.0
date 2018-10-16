<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenderPurchaseRequestRekanansTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'tender_purchase_request_rekanans';

    /**
     * Run the migrations.
     * @table tender_purchase_request_rekanans
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('tender_purchase_request_id')->nullable()->default(null);
            $table->integer('rekanan_id')->nullable()->default(null);
            $table->string('sipp_no', 191)->nullable()->default(null);
            $table->date('sipp_date')->nullable()->default(null);
            $table->date('doc_ambil_date')->nullable()->default(null);
            $table->string('doc_ambil_by', 191)->nullable()->default(null);
            $table->tinyInteger('is_pemenang')->default('0');
            $table->tinyInteger('doc_bayar_status')->default('0');
            $table->date('doc_bayar_date')->nullable()->default(null);
            $table->string('description', 191)->nullable()->default(null);
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);
            $table->timestamp('inactive_at')->nullable()->default(null);
            $table->integer('inactive_by')->nullable()->default(null);
            $table->softDeletes();
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->set_schema_table);
     }
}
