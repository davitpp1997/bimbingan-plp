<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    // use HasFactory;

    protected $table = 'guru';

    public $timestamps = false;

    protected $fillable = [
                'user_id',
                'id_sekolah',
                'id_jurusan'
            ];

    public function bimbingan()
    {
        return $this->hasMany(PesertaPLP::class, 'id_guru_pamong', 'user_id')
                    ->join('mahasiswa', 'mahasiswa.user_id', '=', 'peserta_plp.id_mahasiswa')
                    ;
    }
}
