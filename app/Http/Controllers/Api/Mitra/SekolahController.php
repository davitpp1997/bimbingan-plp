<?php

namespace App\Http\Controllers\Api\Mitra;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Sekolah;
use App\Models\Peserta;

class SekolahController extends Controller
{
	function __construct()
    {
        $this->middleware('permission:sekolah-list', ['only' => ['sekolah']]);
        $this->middleware('permission:sekolah-create', ['only' => ['create']]);
        $this->middleware('permission:sekolah-edit', ['only' => ['detail','update']]);
        $this->middleware('permission:sekolah-delete', ['only' => ['delete']]);
    }
    
    public function sekolah()
    {
        $data = Sekolah::orderBy('sekolah','asc')->get();

        $res['status']  = 'success';
        $res['message'] = 'list sekolah';
        $res['data']    =  $data;

        return $res;
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode'     => 'required|unique:sekolah',
            'sekolah'  => 'required',
        ]);

        if($validator->fails()){
            $err = $validator->messages()->first();
            $res['status']   = 'failed';
            $res['message']  = $err;
            $res['data']     = [];

            return $res;
        }

        $data               = new Sekolah();
        $data->kode         = $request->kode;
        $data->sekolah  	= $request->sekolah;
        $data->alamat       = $request->alamat;
        $data->save();

        $res['status']  = 'success';
        $res['message'] = 'sekolah berhasil ditambahkan';
        $res['data']    =  $data;

        return $res;
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode'     => 'required|unique:sekolah,kode,'.request()->id,
            'sekolah'  => 'required',
        ]);

        if($validator->fails()){
            $err = $validator->messages()->first();
            $res['status']   = 'failed';
            $res['message']  = $err;
            $res['data']     = [];

            return $res;
        }

        $data               = Sekolah::findOrFail($request->id);
        $data->kode         = $request->kode;
        $data->sekolah  	= $request->sekolah;
        $data->alamat       = $request->alamat;
        $data->update();

        $res['status']  = 'success';
        $res['message'] = 'sekolah berhasil dirubah';
        $res['data']    =  $data;

        return $res;
    }

    public function detail($id)
    {
        $data               = Sekolah::findOrFail($id);

        $res['status']  = 'success';
        $res['message'] = 'detail sekolah';
        $res['data']    =  $data;

        return $res;
    }


    public function delete($id)
    {
        $cekPeserta = Peserta::where('id_sekolah','=',$id)
                                ->first();

        if($cekPeserta){
            $res['status']  =  'failed';
            $res['message'] =  'sekolah masih terdaftar sebagai peserta program akademik';
            $res['data']    =  [];

            return $res;
        }

        $data               = Sekolah::findOrFail($id);
        $data->delete();

        $res['status']  = 'success';
        $res['message'] = 'sekolah berhasil dihapus';
        $res['data']    =  [];

        return $res;
    }
}