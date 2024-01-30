<?php

namespace App\Http\Controllers\Api\Penilaian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\NilaiKS;
use App\Models\NilaiAIPTI;
use App\Models\NilaiPRP;
use App\Models\NilaiLaporan;

use App\Models\LessonStudy;
use App\Models\UjianLisan;

class PenilaianController extends Controller
{
    public function saveNilaiKS(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_peserta'    => 'required',
            'pembimbing'    => 'required',
            'iks1'          => 'required',
            'iks2'          => 'required',
            'iks3'          => 'required',
            'iks4'          => 'required',
            'iks5'          => 'required',
            'iks6'          => 'required',
            'iks7'          => 'required',
            'iks8'          => 'required',
            'iks9'          => 'required',
            'iks10'          => 'required',
            'total_skor'    => 'required'
        ]);

        $data;
        $nks = NilaiKS::where('id_peserta', '=', $request->id_peserta)
                ->where('pembimbing', '=', $request->pembimbing)
                ->first();

        if($nks){
            $data = $nks;
        }else{
            $data                   = new NilaiKS();
        }

        $data->id_peserta       = $request->id_peserta;
        $data->pembimbing       = $request->pembimbing;
        $data->iks1             = $request->iks1;
        $data->iks2             = $request->iks2;
        $data->iks3             = $request->iks3;
        $data->iks4             = $request->iks4;
        $data->iks5             = $request->iks5;
        $data->iks6             = $request->iks6;
        $data->iks7             = $request->iks7;
        $data->iks8             = $request->iks8;
        $data->iks9             = $request->iks9;
        $data->iks10            = $request->iks10;
        $data->total_skor       = $request->total_skor;
        $data->catatan          = $request->catatan;
        $data->save();

        $res['status']  = 'success';
        $res['message'] = 'nilai disimpan';
        $res['data']    =  $data;

        return $res;
    }

    public function saveNilaiAIPTI(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_peserta'        => 'required',
            'pembimbing'        => 'required',
            'iaipti1'          => 'required',
            'iaipti2'          => 'required',
            'iaipti3'          => 'required',
            'iaipti4'          => 'required',
            'iaipti5'          => 'required',
            'iaipti6'          => 'required',
            'iaipti7'          => 'required',
            'iaipti8'          => 'required',
            'total_skor'        => 'required'
        ]);

        $data;
        $naipti = NilaiAIPTI::where('id_peserta', '=', $request->id_peserta)
                ->where('pembimbing', '=', $request->pembimbing)
                ->first();

        if($naipti){
            $data = $naipti;
        }else{
            $data                   = new NilaiAIPTI();
        }

        $data->id_peserta       = $request->id_peserta;
        $data->pembimbing       = $request->pembimbing;
        $data->iaipti1             = $request->iaipti1;
        $data->iaipti2             = $request->iaipti2;
        $data->iaipti3             = $request->iaipti3;
        $data->iaipti4             = $request->iaipti4;
        $data->iaipti5             = $request->iaipti5;
        $data->iaipti6             = $request->iaipti6;
        $data->iaipti7             = $request->iaipti7;
        $data->iaipti8             = $request->iaipti8;
        $data->total_skor       = $request->total_skor;
        $data->catatan          = $request->catatan;
        $data->save();

        $res['status']  = 'success';
        $res['message'] = 'nilai disimpan';
        $res['data']    =  $data;

        return $res;
    }

    public function saveNilaiPRP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_peserta'       => 'required',
            'pembimbing'       => 'required',
            'iprp1'          => 'required',
            'iprp2'          => 'required',
            'iprp3'          => 'required',
            'iprp4'          => 'required',
            'iprp5'          => 'required',
            'total_skor'       => 'required'
        ]);

        $data;
        $nprp = NilaiPRP::where('id_peserta', '=', $request->id_peserta)
                ->where('pembimbing', '=', $request->pembimbing)
                ->first();

        if($nprp){
            $data = $nprp;
        }else{
            $data                   = new NilaiPRP();
        }

        $data->id_peserta       = $request->id_peserta;
        $data->pembimbing       = $request->pembimbing;
        $data->iprp1            = $request->iprp1;
        $data->iprp2            = $request->iprp2;
        $data->iprp3            = $request->iprp3;
        $data->iprp4            = $request->iprp4;
        $data->iprp5            = $request->iprp5;
        $data->total_skor       = $request->total_skor;
        $data->catatan          = $request->catatan;
        $data->save();

        $res['status']  = 'success';
        $res['message'] = 'nilai disimpan';
        $res['data']    =  $data;

        return $res;
    }

    public function saveNilaiLaporan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_peserta'   => 'required',
            'pembimbing'   => 'required',
            'il1'          => 'required',
            'il2'          => 'required',
            'il3'          => 'required',
            'il4'          => 'required',
            'il5'          => 'required',
            'total_skor'   => 'required'
        ]);

        $data;
        $nl = NilaiLaporan::where('id_peserta', '=', $request->id_peserta)
                ->where('pembimbing', '=', $request->pembimbing)
                ->first();

        if($nl){
            $data = $nl;
        }else{
            $data                   = new NilaiLaporan();
        }

        $data->id_peserta     = $request->id_peserta;
        $data->pembimbing     = $request->pembimbing;
        $data->il1            = $request->il1;
        $data->il2            = $request->il2;
        $data->il3            = $request->il3;
        $data->il4            = $request->il4;
        $data->il5            = $request->il5;
        $data->total_skor     = $request->total_skor;
        $data->catatan        = $request->catatan;
        $data->save();

        $res['status']  = 'success';
        $res['message'] = 'nilai disimpan';
        $res['data']    =  $data;

        return $res;
    }

    public function perhitunganNilaiLS(Request $request)
    {
        $data = LessonStudy::join('nilai_km', 'nilai_km.id_ls', '=' , 'lesson_study.id')
                             ->where('lesson_study.id_peserta', '=', $request->id_peserta) 
                             ->where('nilai_km.pembimbing', '=', $request->pembimbing)
                             ->select('lesson_study.ls_ke', 'nilai_km.total_skor')
                             ->get();

        $res['status']  = 'success';
        $res['message'] = 'perhitungan LS';
        $res['data']    =  $data;
        $res['average'] =  $data->avg('total_skor');

        return $res;
    }

    public function perhitunganNilaiAkhir(Request $request)
    {
        $total_nilai = 0;

        $nks = new NilaiKS;
        $naipti = new NilaiAIPTI;
        $nprp = new NilaiPRP;
        $nlaporan = new NilaiLaporan;
        $nls = new LessonStudy; 
        $nujian = new UjianLisan; 

        $nilaiKSDosen = $nks->nilaiKS($request->id_peserta, "dosen");
        $nilaiKSGuru = $nks->nilaiKS($request->id_peserta, "guru");

        $nilaiAIPTIDosen = $naipti->nilaiAIPTI($request->id_peserta, "dosen");
        $nilaiAIPTIGuru = $naipti->nilaiAIPTI($request->id_peserta, "guru");

        $nilaiPRPDosen = $nprp->nilaiPRP($request->id_peserta, "dosen");
        $nilaiPRPGuru = $nprp->nilaiPRP($request->id_peserta, "guru");

        $nilaiLSDosen = $nls->rekapNilai($request->id_peserta, "dosen");
        $nilaiLSGuru  = $nls->rekapNilai($request->id_peserta, "guru");

        $nilaiLaporanDosen = $nlaporan->nilaiLaporan($request->id_peserta, "dosen");
        $nilaiLaporanGuru  = $nlaporan->nilaiLaporan($request->id_peserta, "guru");

        $nilaiUjian = $nujian->nilaiUjian($request->id_peserta);

        $res['nilai_ks_dosen']   =  $nilaiKSDosen * 0.05 ;
        $total_nilai += $res['nilai_ks_dosen'];
        $res['nilai_ks_guru']    =  $nilaiKSGuru * 0.05 ;
        $total_nilai += $res['nilai_ks_guru'];

        $res['nilai_aipti_dosen']   =  $nilaiAIPTIDosen * 0.05 ;
        $total_nilai += $res['nilai_ks_dosen'];
        $res['nilai_aipti_guru']    =  $nilaiAIPTIGuru * 0.05 ;
        $total_nilai += $res['nilai_ks_guru'];

        $res['nilai_prp_dosen']   =  $nilaiPRPDosen * 0.05 ;
        $total_nilai += $res['nilai_prp_dosen'];
        $res['nilai_prp_guru']    =  $nilaiPRPGuru * 0.05 ;
        $total_nilai += $res['nilai_prp_guru'];

        $res['nilai_ls_dosen']   =  $nilaiLSDosen * 0.10 ;
        $total_nilai += $res['nilai_ls_dosen'];
        $res['nilai_ls_guru']    =  $nilaiLSGuru * 0.10 ;
        $total_nilai += $res['nilai_ls_guru'];

        $res['nilai_laporan_dosen']   =  $nilaiLaporanDosen * 0.10 ;
        $total_nilai += $res['nilai_laporan_dosen'];
        $res['nilai_laporan_guru']    =  $nilaiLaporanGuru * 0.10 ;
        $total_nilai += $res['nilai_laporan_guru'];

        $res['nilai_ujian']    =  $nilaiUjian * 0.25 ;
        $total_nilai += $res['nilai_ujian'];
        
        $res['total_nilai'] = $total_nilai;
        return $res;
    }
}
