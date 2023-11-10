<?php

namespace App\Http\Controllers\Api\Akademik;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

// use App\Models\User;
use App\Models\MataKuliah;

class MataKuliahController extends Controller
{
    
    public function list()
    {
        $data = MataKuliah::get();

        $res['status']  = 'success';
        $res['message'] = 'daftar mata kuliah';
        $res['data']    =  $data;

        return $res;
    }

    public function create(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'kode'         => 'required|unique:mata_kuliah',
            'mata_kuliah'  => 'required',
            'sks'          => 'required',
            'praktikum'    => 'required',
        ]);
 
        if($validator->fails()){
            $err = $validator->messages()->first();
            $res['status']   = 'failed';
            $res['message']  = $err;
            $res['data']     = [];
            // return response()->json($err, 400);

            return $res;
        }

        // $anyKode = MataKuliah::where('kode','=',$request->kode)->first();
        
        // if($anyKode){
            // $res['status']   = 'failed';
            // $res['message']  = 'kode mata kuliah sudah ada';
            // $res['data']     = [];

        //     return $res;
        // }

        $data               = new MataKuliah();
        $data->kode         = $request->kode;
        $data->mata_kuliah  = $request->mata_kuliah;
        $data->sks          = $request->sks;
        $data->praktikum    = $request->praktikum;
        $data->keterangan   = $request->keterangan;
        $data->save();

        $res['status']  = 'success';
        $res['message'] = 'mata kuliah berhasil ditambahkan';
        $res['data']    =  $data;

        return $res;
    }

    public function update(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'kode'         => ['required',Rule::unique('mata_kuliah')->ignore(request()->id,'id')],
            'mata_kuliah'  => 'required',
            'sks'          => 'required',
            'praktikum'    => 'required',
        ]);

        if($validator->fails()){
            $err = $validator->messages()->first();
            $res['status']   = 'failed';
            $res['message']  = $err;
            $res['data']     = [];
            // return response()->json($err, 400);

            return $res;
        }

        $data               = MataKuliah::findOrFail($request->id);
        $data->kode         = $request->kode;
        $data->mata_kuliah  = $request->mata_kuliah;
        $data->sks          = $request->sks;
        $data->praktikum    = $request->praktikum;
        $data->keterangan   = $request->keterangan;
        $data->update();

        $res['status']  = 'success';
        $res['message'] = 'mata kuliah berhasil dirubah';
        $res['data']    =  $data;

        return $res;
    }

    public function delete($id)
    {
        $data               = MataKuliah::findOrFail($id);
        $data->delete();

        $res['status']  = 'success';
        $res['message'] = 'mata kuliah berhasil dihapus';
        $res['data']    =  [];

        return $res;
    }
}