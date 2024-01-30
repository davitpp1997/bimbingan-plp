<?php

namespace App\Http\Controllers\Api\UjianLisan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\UjianLisan;
use App\Models\NilaiUjian;
use App\Models\SaranPerbaikan;
use App\Models\Peserta;

class UjianLisanController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_peserta'   => 'required',
            'id_penguji'   => 'required',
            'tanggal'      => 'required',
            'jam'          => 'required',
            'tempat'       => 'required'
        ]);

        $data                   = new UjianLisan();
        $data->id_peserta       = $request->id_peserta;
        $data->id_penguji       = $request->id_penguji;
        $data->tanggal          = $request->tanggal;
        $data->jam              = $request->jam;
        $data->tempat           = $request->tempat;
        $data->save();

        $peserta = Peserta::where('id', $request->id_peserta )
                    ->update([
                        'id_dosen_penguji'       => $request->id_penguji
                    ]);

        $res['status']  = 'success';
        $res['message'] = 'ujian lisan ditambahkan';
        $res['data']    =  $data;

        return $res;
    }

    public function saveNilaiUjian(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_ujian'      => 'required',
            'kul1'          => 'required',
            'kul2'          => 'required',
            'kul3'          => 'required',
            'kul4'          => 'required',
            'kul5'          => 'required',
            'kul6'          => 'required',
            'kul7'          => 'required',
            'total_skor'    => 'required'
        ]);

        $data;
        $nilai = NilaiUjian::where('id_ujian', '=', $request->id_ujian)->first();

        if($nilai){
            $data = $nilai;
        }else{
            $data                   = new NilaiUjian();
        }

        $data->id_ujian         = $request->id_ujian;
        $data->kul1             = $request->kul1;
        $data->kul2             = $request->kul2;
        $data->kul3             = $request->kul3;
        $data->kul4             = $request->kul4;
        $data->kul5             = $request->kul5;
        $data->kul6             = $request->kul6;
        $data->kul7             = $request->kul7;
        $data->total_skor       = $request->total_skor;
        $data->catatan          = $request->catatan;
        $data->save();

        $res['status']  = 'success';
        $res['message'] = 'nilai disimpan';
        $res['data']    =  $data;

        return $res;
    }

    public function createSaran(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_ujian'      => 'required',
            'no_halaman'    => 'required',
            'saran'         => 'required'
        ]);

        $data;
        $saran = SaranPerbaikan::where('id_ujian', '=', $request->id_ujian)
                ->where('no_halaman', '=', $request->no_halaman)
                ->first();

        if($saran){
            $data = $saran;
        }else{
            $data                   = new SaranPerbaikan();
        }

        $data->id_ujian         = $request->id_ujian;
        $data->no_halaman       = $request->no_halaman;
        $data->saran            = $request->saran;
        $data->save();

        $res['status']  = 'success';
        $res['message'] = 'saran disimpan';
        $res['data']    =  $data;

        return $res;
    }
}
