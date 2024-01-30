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
        Schema::create('logbook', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_peserta');
            $table->string('judul', 50);
            $table->date('tanggal');
            $table->string('keterangan');
            $table->enum('pembimbing', ['dosen', 'guru']);
            $table->enum('status', ['Valid', 'Menunggu Validasi']);
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
