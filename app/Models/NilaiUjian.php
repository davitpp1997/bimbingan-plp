<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiUjian extends Model
{
    // use HasFactory;

    protected $table = 'nilai_ujian';

    protected $fillable = [
                'id',
                'id_ujian',
                'kul1',
                'kul2',
                'kul3',
                'kul4',
                'kul5',
                'kul6',
                'kul7',
                'total_skor',
                'catatan'
            ];
}
