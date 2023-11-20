<?php

namespace App\Http\Controllers\Api\Akademik;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Peserta;

class DosenController extends Controller
{
    // function __construct()
    // {
    //     $this->middleware('permission:user-list', ['only' => ['dosen']]);
    //     $this->middleware('permission:user-create', ['only' => ['create']]);
    //     $this->middleware('permission:user-edit', ['only' => ['detail','update']]);
    //     $this->middleware('permission:user-delete', ['only' => ['delete']]);
    // }
    
    public function dosen()
    {
        // $data = [];
        // $data = User::with('dosen')->get();

        if(request()->roles == null){
            $data = User::role(["Dosen Pembimbing","Dosen Penguji"])->with('roles:id,name','dosen')->get();
        }
        else{
            $data = User::role(request()->roles)->with('dosen','roles:id,name')->get();
        }

        $res['status']  = 'success';
        $res['message'] = 'list dosen';
        $res['data']    =  $data;

        return $res;
    }

    public function create(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'nama'              => 'required',
            'email'             => 'unique:users',
            'nomor_identitas'   => 'required|unique:dosen',
            'roles'             => 'required',
            'username'          => 'required|unique:users',
            'password'          => 'required',
        ]);
 
        if($validator->fails()){
            $err = $validator->messages()->first();
            $res['status']   = 'failed';
            $res['message']  = $err;
            $res['data']     = [];
            // return response()->json($err, 400);

            return $res;
        }

        $user               = new User;
        $user->nama         = request()->nama;
        $user->email        = request()->email;
        $user->username     = request()->username;
        $user->password     = bcrypt(request()->password);
        $user->save();

        $user->roles()->sync(request()->roles);

        $dosen                  = new Dosen;
        $dosen->user_id         = $user['id'];
        $dosen->nomor_identitas = $request->nomor_identitas;
        $dosen->save();

        $res['status']  = 'success';
        $res['message'] = 'dosen berhasil ditambahkan';
        $res['data']    =  $user;

        return $res;
    }

    public function update(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'nama'              => 'required',
            'nomor_identitas'   => ['required',Rule::unique('dosen')->ignore(request()->id,'user_id')],
            'email'             => 'unique:users,email,'.$request->id,
            'roles'             => 'required',
            'username'          => 'required|unique:users,username,'.$request->id,
            // 'password'          => 'required',
        ]);

        if($validator->fails()){
            $err = $validator->messages()->first();
            $res['status']   = 'failed';
            $res['message']  = $err;
            $res['data']     = [];
            // return response()->json($err, 400);

            return $res;
        }

        $user               = User::findOrFail($request->id);
        $user->nama         = $request->nama;
        $user->email        = $request->email;
        $user->username     = $request->username;

        if($request->password != null ){
            $user->password     = bcrypt($request->password);
        }

        $user->update();

        $user->roles()->sync($request->roles);

        $dosen = Dosen::where('user_id', request()->id )
                    ->update([
                        'nomor_identitas'       => request()->nomor_identitas
                    ]);

        $res['status']  = 'success';
        $res['message'] = 'dosen berhasil dirubah';
        $res['data']    =  $user;

        return $res;
    }

    public function detail($id)
    {
        $user  = User::where('id','=',$id)->with('dosen','roles:id,name')->get();

        $res['status']  = 'success';
        $res['message'] = 'dosen berhasil ditemukan';
        $res['data']    =  $user;

        return $res;
    }

    public function delete($id)
    {
        $cekPeserta = Peserta::where('id_dosen_pembimbing','=',$id)
                                ->first();

        if($cekPeserta){
            $res['status']  =  'failed';
            $res['message'] =  'Dosen masih terdaftar sebagai peserta program akademik';
            $res['data']    =  [];

            return $res;
        }

        $dosen  = Dosen::where('user_id', $id )->delete();
        $user  = User::findOrFail($id);
        $user->delete();


        $res['status']  = 'success';
        $res['message'] = 'dosen berhasil dihapus';
        $res['data']    =  [];

        return $res;
    }
}
