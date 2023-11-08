<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Guru extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guru', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('nomor_identitas')->unique();
            $table->string('kode_sekolah');
            $table->string('kode_jurusan');
            
            //add constraint
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('kode_sekolah')->references('kode')->on('sekolah')->onUpdate('cascade');
            $table->foreign('kode_jurusan')->references('kode')->on('jurusan')->onUpdate('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guru');
    }
}
