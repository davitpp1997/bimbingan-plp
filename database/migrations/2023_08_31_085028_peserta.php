<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Peserta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peserta', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_program');
            $table->unsignedInteger('id_mahasiswa');
            $table->unsignedInteger('id_dosen_pembimbing');
            $table->unsignedSmallInteger('id_sekolah');
            $table->unsignedTinyInteger('id_jurusan');
            $table->unsignedInteger('id_guru_pamong');
            $table->unsignedInteger('id_dosen_penguji')->nullable();
            $table->timestamps();

            //add constraint
            $table->foreign('id_program')->references('id')->on('program');
            $table->foreign('id_mahasiswa')->references('id')->on('users');
            $table->foreign('id_dosen_pembimbing')->references('id')->on('users');
            $table->foreign('id_dosen_penguji')->references('id')->on('users');
            $table->foreign('id_sekolah')->references('id')->on('sekolah');
            $table->foreign('id_jurusan')->references('id')->on('jurusan');
            $table->foreign('id_guru_pamong')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peserta_plp');
    }
}
