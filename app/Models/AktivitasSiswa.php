<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AktivitasSiswa extends Model
{
    // use HasFactory;

    protected $table = 'aktivitas_siswa';

    protected $fillable = [
            'id',
            'id_ls',
            'nama_observer',
            'nomor_siswa',
            'ias1a',
            'ias1b',
            'ias1c',
            'ias1d',
            'ias2a',
            'ias2b',
            'ias2c',
            'ias2d',
            'ias2e',
            'ias3a',
            'ias3b',
            'ias3c',
            'ias3d',
            'ias4a',
            'ias4b',
            'ias4c',
            'ias4d',
            'ias4e',
            'ias4f',
            'keterangan'
    ];
}
