<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UjianLisan extends Model
{
    protected $table = 'ujian_lisan';

    protected $fillable = [
                'id',
                'id_peserta',
                'id_penguji',
                'tanggal',
                'jam',
                'tempat',
                'created_at',
                'updated_at'
            ];

    public function nilaiUjian($id_peserta)
    {
        $data = $this->join('nilai_ujian', 'nilai_ujian.id_ujian', '=' , 'ujian_lisan.id')
                     ->where('ujian_lisan.id_peserta', '=', $id_peserta)
                     ->first();

        if(!$data){
            return 0;
        }

        return $data->total_skor;
    }
}
