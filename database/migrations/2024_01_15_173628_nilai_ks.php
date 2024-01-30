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
        Schema::create('nilai_ks', function (Blueprint $table) {
            // $table->increments('id');
            $table->unsignedInteger('id_peserta');
            $table->enum('pembimbing', ['dosen', 'guru']);
            $table->tinyInteger('iks1');
            $table->tinyInteger('iks2');
            $table->tinyInteger('iks3');
            $table->tinyInteger('iks4');
            $table->tinyInteger('iks5');
            $table->tinyInteger('iks6');
            $table->tinyInteger('iks7');
            $table->tinyInteger('iks8');
            $table->tinyInteger('iks9');
            $table->tinyInteger('iks10');
            $table->tinyInteger('total_skor');
            $table->string('catatan')->nullable();
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
