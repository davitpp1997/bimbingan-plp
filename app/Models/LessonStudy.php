<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonStudy extends Model
{
    //use HasFactory;
    protected $table = 'lesson_study';

    protected $fillable = [
                'id',
                'id_peserta',
                'ls_ke',
                'tanggal',
                'jam',
                'mapel',
                'kd',
                'metode',
                'jumlah_siswa',
                'created_at',
                'updated_at'
            ];


    public function rekapNilai($id_peserta,$pembimbing)
    {
        $data = $this->join('nilai_km', 'nilai_km.id_ls', '=' , 'lesson_study.id')
                    ->where('lesson_study.id_peserta', '=', $id_peserta) 
                    ->where('nilai_km.pembimbing', '=', $pembimbing)
                    // ->select('lesson_study.ls_ke', 'nilai_km.total_skor')
                    ->avg('nilai_km.total_skor');

        return $data;
    }
}
