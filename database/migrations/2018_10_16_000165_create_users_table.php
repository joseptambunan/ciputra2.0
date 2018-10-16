<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'users';

    /**
     * Run the migrations.
     * @table users
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('user_login', 191);
            $table->string('user_name', 191);
            $table->tinyInteger('is_rekanan')->default('0');
            $table->string('email', 191);
            $table->string('user_phone', 191)->nullable()->default(null);
            $table->string('digitalsignature', 191)->nullable()->default(null);
            $table->string('photo', 191)->nullable()->default(null);
            $table->string('password', 191);
            $table->string('description', 191)->nullable()->default(null);
            $table->rememberToken();
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);
            $table->timestamp('inactive_at')->nullable()->default(null);
            $table->integer('inactive_by')->nullable()->default(null);

            $table->unique(["user_login"], 'users_user_login_unique');

            $table->unique(["email"], 'users_email_unique');
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
