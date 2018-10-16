<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangreturDetailsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'barangretur_details';

    /**
     * Run the migrations.
     * @table barangretur_details
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('barangretur_id');
            $table->integer('goodreceive_detail_id');
            $table->integer('quantity')->nullable()->default(null);
            $table->double('price')->nullable()->default(null);
            $table->decimal('ppn', 5, 2)->nullable()->default(null);
            $table->decimal('pph', 5, 2)->nullable()->default(null);
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);
            $table->timestamp('inactive_at')->nullable()->default(null);
            $table->integer('inactive_by')->nullable()->default(null);

            $table->index(["goodreceive_detail_id"], 'barangretur_details_goodreceive_detail_id_index');

            $table->index(["barangretur_id"], 'barangretur_details_barangretur_id_index');
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
