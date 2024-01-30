<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiKM extends Model
{
    // use HasFactory;
    protected $table = 'nilai_km';

    protected $fillable = [
                // 'id',
                'id_ls',
                'pembimbing',
                'ikm1',
                'ikm2',
                'ikm3',
                'ikm4',
                'ikm5',
                'ikm6',
                'ikm7',
                'ikm8',
                'total_skor',
                'keterangan'
            ];
}
