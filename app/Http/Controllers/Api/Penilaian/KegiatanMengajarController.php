<?php

namespace App\Http\Controllers\Api\Penilaian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\NilaiKM;

class KegiatanMengajarController extends Controller
{
    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_ls'         => 'required',
            'ls_penilai'    => 'required',
            'ikm1'          => 'required',
            'ikm2'          => 'required',
            'ikm3'          => 'required',
            'ikm4'          => 'required',
            'ikm5'          => 'required',
            'ikm6'          => 'required',
            'ikm7'          => 'required',
            'ikm8'          => 'required',
            'total_skor'    => 'required'
        ]);

        $data;
        $nkm = NilaiKM::where('id_ls', '=', $request->id_ls)
                ->where('pembimbing', '=', $request->pembimbing)
                ->first();

        if($nkm){
            $data = $nkm;
        }else{
            $data                   = new NilaiKM();
        }

        $data->id_ls            = $request->id_ls;
        $data->pembimbing       = $request->pembimbing;
        $data->ikm1             = $request->ikm1;
        $data->ikm2             = $request->ikm2;
        $data->ikm3             = $request->ikm3;
        $data->ikm4             = $request->ikm4;
        $data->ikm5             = $request->ikm5;
        $data->ikm6             = $request->ikm6;
        $data->ikm7             = $request->ikm7;
        $data->ikm8             = $request->ikm8;
        $data->total_skor       = $request->total_skor;
        $data->catatan          = $request->catatan;
        $data->save();

        $res['status']  = 'success';
        $res['message'] = 'nilai disimpan';
        $res['data']    =  $data;

        return $res;
    }
}
