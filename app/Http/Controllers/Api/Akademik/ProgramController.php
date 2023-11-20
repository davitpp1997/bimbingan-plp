<?php

namespace App\Http\Controllers\Api\Akademik;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Program;

class ProgramController extends Controller
{
	// function __construct()
 //    {
 //        $this->middleware('permission:program-list', ['only' => ['program']]);
 //        $this->middleware('permission:program-create', ['only' => ['create']]);
 //        $this->middleware('permission:program-edit', ['only' => ['detail','update']]);
 //        $this->middleware('permission:program-delete', ['only' => ['delete']]);
 //    }
    
    public function program()
    {
        $data = Program::with('mataKuliah')->get();

        $res['status']  = 'success';
        $res['message'] = 'list sekolah';
        $res['data']    =  $data;

        return $res;
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode'              => 'required|unique:program',
            'id_mata_kuliah'    => 'required',
            'program'           => 'required',
            'semester'          => 'required',
            'tahun_ajaran'      => 'required',
        ]);

        if($validator->fails()){
            $err = $validator->messages()->first();
            $res['status']   = 'failed';
            $res['message']  = $err;
            $res['data']     = [];

            return $res;
        }

        $data                   = new Program();
        $data->kode             = $request->kode;
        $data->id_mata_kuliah   = $request->id_mata_kuliah;
        $data->program          = $request->program;
        $data->semester         = $request->semester;
        $data->tahun_ajaran     = $request->tahun_ajaran;
        $data->keterangan       = $request->keterangan;
        $data->save();

        $res['status']  = 'success';
        $res['message'] = 'program berhasil ditambahkan';
        $res['data']    =  $data;

        return $res;
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode'              => 'required|unique:program,kode,'.request()->id,
            'program'           => 'required',
            'id_mata_kuliah'    => 'required',
            'semester'          => 'required',
            'tahun_ajaran'      => 'required',
        ]);

        if($validator->fails()){
            $err = $validator->messages()->first();
            $res['status']   = 'failed';
            $res['message']  = $err;
            $res['data']     = [];

            return $res;
        }

        $data                   = Program::findOrFail($request->id);
        $data->kode             = $request->kode;
        $data->program          = $request->program;
        $data->id_mata_kuliah   = $request->id_mata_kuliah;
        $data->semester         = $request->semester;
        $data->tahun_ajaran     = $request->tahun_ajaran;
        $data->keterangan       = $request->keterangan;
        $data->update();

        $res['status']  = 'success';
        $res['message'] = 'program berhasil dirubah';
        $res['data']    =  $data;

        return $res;
    }

    public function detail($id)
    {
        $data               = Program::where('id', '=', $id)->with('mataKuliah')->get();

        $res['status']  = 'success';
        $res['message'] = 'detail program';
        $res['data']    =  $data;

        return $res;
    }


    public function delete($id)
    {
        $data               = Program::findOrFail($id);
        $data->delete();

        $res['status']  = 'success';
        $res['message'] = 'program berhasil dihapus';
        $res['data']    =  [];

        return $res;
    }
}