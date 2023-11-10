<?php

namespace App\Http\Controllers\Api\Mitra;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Jurusan;

class JurusanController extends Controller
{
	function __construct()
    {
        $this->middleware('permission:jurusan-list', ['only' => ['jurusan']]);
        $this->middleware('permission:jurusan-create', ['only' => ['create']]);
        $this->middleware('permission:jurusan-edit', ['only' => ['detail','update']]);
        $this->middleware('permission:jurusan-delete', ['only' => ['delete']]);
    }
    
    public function jurusan()
    {
        $data = Jurusan::get();

        $res['status']  = 'success';
        $res['message'] = 'list jurusan';
        $res['data']    =  $data;

        return $res;
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode'     => 'required|unique:jurusan',
            'jurusan'  => 'required',
        ]);

        if($validator->fails()){
            $res['status']  = 'failed';
            $res['message'] =  $validator->errors();
            $res['data']    =  [];

            return $res;
        }

        $data               = new Jurusan();
        $data->kode         = $request->kode;
        $data->jurusan  	= $request->jurusan;
        $data->save();

        $res['status']  = 'success';
        $res['message'] = 'jurusan berhasil ditambahkan';
        $res['data']    =  $data;

        return $res;
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode'     => 'required|unique:jurusan,kode,'.request()->id,
            'jurusan'  => 'required',
        ]);

        if($validator->fails()){
            $res['status']  = 'failed';
            $res['message'] =  $validator->errors();
            $res['data']    =  [];

            return $res;
        }

        $data               = Jurusan::findOrFail($request->id);
        $data->kode         = $request->kode;
        $data->jurusan  	= $request->jurusan;
        $data->update();

        $res['status']  = 'success';
        $res['message'] = 'jurusan berhasil dirubah';
        $res['data']    =  $data;

        return $res;
    }

    public function detail($id)
    {
        $data               = Jurusan::findOrFail($id);

        $res['status']  = 'success';
        $res['message'] = 'detail jurusan';
        $res['data']    =  $data;

        return $res;
    }


    public function delete($id)
    {
        $data               = Jurusan::findOrFail($id);
        $data->delete();

        $res['status']  = 'success';
        $res['message'] = 'jurusan berhasil dihapus';
        $res['data']    =  [];

        return $res;
    }
}