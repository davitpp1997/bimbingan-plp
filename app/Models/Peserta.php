<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Program;
use App\Models\Sekolah;
use App\Models\Jurusan;

class Peserta extends Model
{
    // use HasFactory;
    protected $table = 'peserta';

    protected $fillable = [
                'id',
                'id_program',
                'id_mahasiswa',
                'id_dosen_pembimbing',
                'id_sekolah',
                'id_jurusan',
                'id_guru_pamong'
            ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'id_program',
        'id_mahasiswa',
        'id_dosen_pembimbing',
        'id_sekolah',
        'id_jurusan',
        'id_guru_pamong',
        'id_dosen_penguji'
    ];

    public function program()
    {
        return $this->hasOne(Program::class,  'id', 'id_program')
                    ->select(
                        'id',
                        'kode',
                        'program'
                    );
    }

    public function mahasiswa()
    {
        return $this->hasOne(User::class,  'id', 'id_mahasiswa')
                    // ->join('mahasiswa', 'mahasiswa.user_id', '=', 'users.id')
                    ->select(
                        'users.id',
                        'users.nama',
                        // 'mahasiswa.nim',
                        // 'mahasiswa.angkatan'
                    );
    }

    public function pembimbing()
    {
        return $this->hasOne(User::class,  'id', 'id_dosen_pembimbing')
                    // ->join('dosen', 'dosen.user_id', '=', 'users.id')
                    ->select(
                        'users.id',
                        'users.nama',
                        // 'dosen.nip',
                    );
    }

    public function pamong()
    {
        return $this->hasOne(User::class,  'id', 'id_guru_pamong')
                    // ->join('guru', 'guru.user_id', '=', 'users.id')
                    ->select(
                        'users.id',
                        'users.nama',
                        // 'guru.nip',
                    );
    }

    public function penguji()
    {
        return $this->hasOne(User::class,  'id', 'id_dosen_penguji')
                    // ->join('dosen', 'dosen.user_id', '=', 'users.id')
                    ->select(
                        'users.id',
                        'users.nama',
                        // 'dosen.nip',
                    );
    }

    public function sekolah()
    {
        return $this->hasOne(Sekolah::class,  'id', 'id_sekolah');
    }

    public function jurusan()
    {
        return $this->hasOne(Jurusan::class,  'id', 'id_jurusan');
    }

    


    
}
