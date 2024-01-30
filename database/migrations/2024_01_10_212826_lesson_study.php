<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lesson_study', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_peserta');
            $table->tinyInteger('ls_ke');
            $table->date('tanggal');
            $table->time('jam');
            $table->string('tempat', 20)->nullable();
            $table->string('mapel', 50);
            $table->string('kd', 100);
            $table->string('metode', 50);
            $table->tinyInteger('jumlah_siswa');
            $table->timestamps();

            //add constraint
            $table->foreign('id_peserta')->references('id')->on('peserta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
