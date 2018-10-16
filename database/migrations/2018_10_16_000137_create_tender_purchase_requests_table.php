<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenderPurchaseRequestsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'tender_purchase_requests';

    /**
     * Run the migrations.
     * @table tender_purchase_requests
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('rab_id')->nullable()->default(null);
            $table->integer('kelas_id')->nullable()->default(null);
            $table->string('no', 191)->nullable()->default(null);
            $table->string('name', 191)->nullable()->default(null);
            $table->date('ambil_doc_date')->nullable()->default(null);
            $table->date('aanwijzing_date')->nullable()->default(null);
            $table->date('penawaran1_date')->nullable()->default(null);
            $table->date('klarifikasi1_date')->nullable()->default(null);
            $table->date('penawaran2_date')->nullable()->default(null);
            $table->date('klarifikasi2_date')->nullable()->default(null);
            $table->date('penawaran3_date')->nullable()->default(null);
            $table->date('final_date')->nullable()->default(null);
            $table->date('recommendation_date')->nullable()->default(null);
            $table->date('pengumuman_date')->nullable()->default(null);
            $table->double('harga_dokumen')->nullable()->default(null);
            $table->string('sumber', 191)->nullable()->default(null);
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
