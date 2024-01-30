<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaranPerbaikan extends Model
{
    // use HasFactory;
    protected $table = 'saran_perbaikan';

    protected $fillable = [
                'id',
                'id_ujian',
                'no_halaman',
                'saran'
            ];
}
