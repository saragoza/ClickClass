<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docs', function (Blueprint $table) {
            $table->increments('id')->primary;
            $table->string('description', 100);
            $table->string('type', 20);
            $table->string('tags', 250)->nullable();
            $table->string('addit_info', 500)->nullable();
            $table->integer('owner')->unsigned()->nullable();
            $table->string('filename', 100);
            $table->timestamps();
            $table->foreign('owner')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('docs');
    }
}
