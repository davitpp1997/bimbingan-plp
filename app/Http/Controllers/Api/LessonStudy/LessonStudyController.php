<?php

namespace App\Http\Controllers\Api\LessonStudy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\LessonStudy;

class LessonStudyController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_peserta'   => 'required',
            'ls_ke'        => 'required',
            'tanggal'      => 'required',
            'jam'          => 'required',
            'tempat'       => 'required',
            'mapel'        => 'required',
            'kd'           => 'required',
            'metode'       => 'required',
            'jumlah_siswa' => 'required'
        ]);

        $data                   = new LessonStudy();
        $data->id_peserta       = $request->id_peserta;
        $data->ls_ke            = $request->ls_ke;
        $data->tanggal          = $request->tanggal;
        $data->jam              = $request->jam;
        $data->tempat           = $request->tempat;
        $data->mapel            = $request->mapel;
        $data->kd               = $request->kd;
        $data->metode           = $request->metode;
        $data->jumlah_siswa     = $request->jumlah_siswa;
        $data->save();

        $res['status']  = 'success';
        $res['message'] = 'lesson study ditambahkan';
        $res['data']    =  $data;

        return $res;
    }
}
