<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Program extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedTinyInteger('id_mata_kuliah');
            $table->string('kode')->unique();
            $table->string('program');
            $table->string('semester');
            $table->string('tahun_ajaran');
            $table->string('keterangan')->nullable();
            $table->timestamps();

            //add constraint
            $table->foreign('id_mata_kuliah')->references('id')->on('mata_kuliah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('program_plp');
    }
}
