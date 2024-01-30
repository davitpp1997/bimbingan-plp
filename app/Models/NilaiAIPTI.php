<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiAIPTI extends Model
{
    // use HasFactory;

    protected $table = 'nilai_aipti';

    protected $fillable = [
                'id_peserta',
                'pembimbing',
                'iaipti1',
                'iaipti2',
                'iaipti3',
                'iaipti4',
                'iaipti5',
                'iaipti6',
                'iaipti7',
                'iaipti8',
                'total_skor',
                'catatan'
            ];

    public function nilaiAIPTI($id_peserta, $penilai)
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
