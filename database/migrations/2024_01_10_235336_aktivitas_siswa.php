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
        Schema::create('aktivitas_siswa', function (Blueprint $table) {
            // $table->increments('id');
            $table->unsignedInteger('id_ls');
            $table->string('nama_observer', 50);
            $table->tinyInteger('nomor_siswa');
            $table->boolean('ias1a')->default(0);
            $table->boolean('ias1b')->default(0);
            $table->boolean('ias1c')->default(0);
            $table->boolean('ias1d')->default(0);
            $table->boolean('ias2a')->default(0);
            $table->boolean('ias2b')->default(0);
            $table->boolean('ias2c')->default(0);
            $table->boolean('ias2d')->default(0);
            $table->boolean('ias2e')->default(0);
            $table->boolean('ias3a')->default(0);
            $table->boolean('ias3b')->default(0);
            $table->boolean('ias3c')->default(0);
            $table->boolean('ias3d')->default(0);
            $table->boolean('ias4a')->default(0);
            $table->boolean('ias4b')->default(0);
            $table->boolean('ias4c')->default(0);
            $table->boolean('ias4d')->default(0);
            $table->boolean('ias4e')->default(0);
            $table->boolean('ias4f')->default(0);
            $table->string('keterangan')->nullable();
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
