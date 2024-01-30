<?php

namespace App\Http\Controllers\Api\LessonStudy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Validator;

use App\Models\AktivitasSiswa;
use App\Models\CatatanAktivitas;

class PengamatanSiswaController extends Controller
{
    public function saveAktivitas(Request $request)
    {
        $data;
        $aktivitas = AktivitasSiswa::where('id_ls', '=', $request->id_ls)
                ->where('nomor_siswa', '=', $request->id_penilai)
                ->first();

        if($aktivitas){
            $data = $aktivitas;
        }else{
            $data                   = new AktivitasSiswa();
        }

        $data->id_ls            = $request->id_ls;
        $data->nama_observer    = $request->nama_observer;
        $data->nomor_siswa      = $request->nomor_siswa;
        $data->ias1a            = $request->ias1a;
        $data->ias1b            = $request->ias1b;
        $data->ias1c            = $request->ias1c;
        $data->ias1d            = $request->ias1d;
        $data->ias2a            = $request->ias2a;
        $data->ias2b            = $request->ias2b;
        $data->ias2c            = $request->ias2c;
        $data->ias2d            = $request->ias2d;
        $data->ias2e            = $request->ias2e;
        $data->ias3a            = $request->ias3a;
        $data->ias3b            = $request->ias3b;
        $data->ias3c            = $request->ias3c;
        $data->ias3d            = $request->ias3d;
        $data->ias4a            = $request->ias4a;
        $data->ias4b            = $request->ias4b;
        $data->ias4c            = $request->ias4c;
        $data->ias4d            = $request->ias4d;
        $data->ias4e            = $request->ias4e;
        $data->ias4f            = $request->ias4f;
        $data->keterangan       = $request->keterangan;

        $data->save();

        $res['status']  = 'success';
        $res['message'] = 'aktivitas siswa disimpan';
        $res['data']    =  $data;

        return $res;
    }

    public function saveCatatan(Request $request)
    {
        $data;
        $aktivitas = CatatanAktivitas::where('id_ls', '=', $request->id_ls)
                ->where('nomor_siswa', '=', $request->id_penilai)
                ->first();

        if($aktivitas){
            $data = $aktivitas;
        }else{
            $data                   = new CatatanAktivitas();
        }

        $data->id_ls            = $request->id_ls;
        $data->nama_observer    = $request->nama_observer;
        $data->nomor_siswa      = $request->nomor_siswa;
        $data->catatan1         = $request->catatan1;
        $data->catatan2         = $request->catatan2;
        $data->catatan3         = $request->catatan3;

        $data->save();

        $res['status']  = 'success';
        $res['message'] = 'catatan aktivitas siswa disimpan';
        $res['data']    =  $data;

        return $res;
    }
}
