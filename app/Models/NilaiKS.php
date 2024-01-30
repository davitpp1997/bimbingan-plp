<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiKS extends Model
{
    // use HasFactory;
    protected $table = 'nilai_ks';

    protected $fillable = [
                'id_peserta',
                'pembimbing',
                'iks1',
                'iks2',
                'iks3',
                'iks4',
                'iks5',
                'iks6',
                'iks7',
                'iks8',
                'iks9',
                'iks10',
                'total_skor',
                'catatan'
            ];

    public function nilaiKS($id_peserta, $penilai)
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
