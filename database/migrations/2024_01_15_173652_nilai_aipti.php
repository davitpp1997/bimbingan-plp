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
        Schema::create('nilai_aipti', function (Blueprint $table) {
            // $table->increments('id');
            $table->unsignedInteger('id_peserta');
            $table->enum('pembimbing', ['dosen', 'guru']);
            $table->tinyInteger('iaipti1');
            $table->tinyInteger('iaipti2');
            $table->tinyInteger('iaipti3');
            $table->tinyInteger('iaipti4');
            $table->tinyInteger('iaipti5');
            $table->tinyInteger('iaipti6');
            $table->tinyInteger('iaipti7');
            $table->tinyInteger('iaipti8');
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
