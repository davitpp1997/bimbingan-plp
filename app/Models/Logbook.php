<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    // use HasFactory;
    protected $table = 'logbook';

    protected $fillable = [
                'id',
                'id_peserta',
                'judul',
                'tanggal',
                'keterangan',
                'pembimbing',
                'status',
                'created_at',
                'updated_at'
            ];
}
