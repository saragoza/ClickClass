<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perms', function (Blueprint $table) {
            $table->integer('id_user')->unsigned();
            $table->integer('id_doc')->unsigned();
            $table->primary(['id_user', 'id_doc']);
            $table->boolean('write_perm')->default(true);
            $table->timestamps();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_doc')->references('id')->on('docs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perms');
    }
}
