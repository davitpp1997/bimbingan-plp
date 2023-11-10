<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\PesertaPLP;

class Dosen extends Model
{
    // use HasFactory;

    protected $table = 'dosen';

    public $timestamps = false;

    protected $fillable = [
                'user_id'
            ];


    public function bimbingan()
    {
        return $this->hasMany(PesertaPLP::class, 'id_dosen_pembimbing', 'user_id')
                    ->join('mahasiswa', 'mahasiswa.user_id', '=', 'peserta_plp.id_mahasiswa')
                    ;
    }
}
