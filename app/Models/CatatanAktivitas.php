<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanAktivitas extends Model
{
    // use HasFactory;
    protected $table = 'catatan_aktivitas';

    protected $fillable = [
                'id',
                'id_ls',
                'nama_observer',
                'nomor_siswa',
                'catatan1',
                'catatan2',
                'catatan3'
            ];
}
