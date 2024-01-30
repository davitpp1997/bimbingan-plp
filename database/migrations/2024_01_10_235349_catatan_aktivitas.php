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
        Schema::create('catatan_aktivitas', function (Blueprint $table) {
            // $table->increments('id');
            $table->unsignedInteger('id_ls');
            $table->string('nama_observer', 50);
            $table->tinyInteger('nomor_siswa');
            $table->string('catatan1')->nullable();
            $table->string('catatan2')->nullable();
            $table->string('catatan3')->nullable();
            $table->timestamps();

            //add constraint
            $table->foreign('id_ls')->references('id')->on('lesson_study');
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
