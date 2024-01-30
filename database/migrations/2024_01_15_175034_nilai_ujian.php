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
        Schema::create('nilai_ujian', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_ujian');
            $table->tinyInteger('kul1');
            $table->tinyInteger('kul2');
            $table->tinyInteger('kul3');
            $table->tinyInteger('kul4');
            $table->tinyInteger('kul5');
            $table->tinyInteger('kul6');
            $table->tinyInteger('kul7');
            $table->tinyInteger('total_skor');
            $table->string('catatan')->nullable();
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
