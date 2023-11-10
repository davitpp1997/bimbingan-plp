<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MataKuliah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mata_kuliah', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('kode')->unique();
            $table->string('mata_kuliah');
            $table->tinyInteger('sks');
            $table->boolean('praktikum')->default(0);
            $table->string('keterangan')->nullable();
            // $table->timestamps();
            // $table->softDeletes('deleted_at', 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mata_kuliah');
    }
}
