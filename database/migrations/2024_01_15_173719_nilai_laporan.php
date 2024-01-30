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
        Schema::create('nilai_laporan', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_peserta');
            $table->enum('pembimbing', ['dosen', 'guru']);
            $table->tinyInteger('il1');
            $table->tinyInteger('il2');
            $table->tinyInteger('il3');
            $table->tinyInteger('il4');
            $table->tinyInteger('il5');
            $table->tinyInteger('total_skor');
            $table->string('catatan')->nullable();
            $table->timestamps();

            //add constraint
            $table->foreign('id_peserta')->references('id')->on('peserta');
            // $table->foreign('id_penilai')->references('id')->on('users');
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
