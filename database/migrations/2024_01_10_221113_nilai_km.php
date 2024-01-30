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
        Schema::create('nilai_km', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_ls');
            $table->enum('pembimbing', ['dosen', 'guru']);
            $table->tinyInteger('ikm1');
            $table->tinyInteger('ikm2');
            $table->tinyInteger('ikm3');
            $table->tinyInteger('ikm4');
            $table->tinyInteger('ikm5');
            $table->tinyInteger('ikm6');
            $table->tinyInteger('ikm7');
            $table->tinyInteger('ikm8');
            $table->tinyInteger('total_skor');
            $table->string('catatan')->nullable();
            $table->timestamps();

            //add constraint
            $table->foreign('id_ls')->references('id')->on('lesson_study');
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
