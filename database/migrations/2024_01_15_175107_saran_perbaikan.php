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
        Schema::create('saran_perbaikan', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_ujian');
            $table->tinyInteger('no_halaman');
            $table->string('saran');
            $table->timestamps();

            //add constraint
            $table->foreign('id_ujian')->references('id')->on('ujian_lisan');
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
