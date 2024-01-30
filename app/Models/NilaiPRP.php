<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiPRP extends Model
{
    // use HasFactory;

    protected $table = 'nilai_prp';

    protected $fillable = [
                'id_peserta',
                'pembimbing',
                'iprp1',
                'iprp2',
                'iprp3',
                'iprp4',
                'iprp5',
                'total_skor',
                'catatan'
            ];

    public function nilaiPRP($id_peserta, $penilai)
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
