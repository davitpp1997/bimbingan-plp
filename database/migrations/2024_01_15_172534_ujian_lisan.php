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
        Schema::create('ujian_lisan', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_peserta');
            $table->unsignedInteger('id_penguji');
            $table->date('tanggal')->nullable();
            $table->time('jam')->nullable();
            $table->string('tempat', 20)->nullable();
            $table->timestamps();

            //add constraint
            $table->foreign('id_peserta')->references('id')->on('peserta');
            $table->foreign('id_penguji')->references('id')->on('users');
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
