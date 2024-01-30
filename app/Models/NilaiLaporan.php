<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiLaporan extends Model
{
    // use HasFactory;

    protected $table = 'nilai_laporan';

    protected $fillable = [
                'id_peserta',
                'pembimbing',
                'il1',
                'il2',
                'il3',
                'il4',
                'il5',
                'total_skor',
                'catatan'
            ];

    public function nilaiLaporan($id_peserta, $penilai)
    {
        $data = $this->where('id_peserta','=', $id_peserta)
                     ->where('pembimbing','=', $penilai)
                     ->first();

        if(!$data){
            return 0;
        }

        return $data->total_skor;
    }
}
