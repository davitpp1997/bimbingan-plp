<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';

    public $timestamps = false;

    protected $fillable = [
                'user_id',
                'nim',
                'angkatan'
            ];
}
