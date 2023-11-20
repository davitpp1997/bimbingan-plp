<?php 

namespace App\Http\Controllers\Api\Akademik;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Peserta;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{   
    // function __construct()
    // {
    //     $this->middleware('permission:user-list', ['only' => ['mahasiswa']]);
    //     $this->middleware('permission:user-create', ['only' => ['create']]);
    //     $this->middleware('permission:user-edit', ['only' => ['detail','update']]);
    //     $this->middleware('permission:user-delete', ['only' => ['delete']]);
    // }

    public function mahasiswa()
    {
        $data = User::role("Mahasiswa")->with('mahasiswa')->get();

        $res['status']  = 'success';
        $res['message'] = 'list mahasiswa';
        $res['data']    =  $data;

        return $res;
    }

    public function create(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'nama'              => 'required',
            'nim'               => 'required|unique:mahasiswa',
            'angkatan'          => 'required',
            'email'             => 'unique:users',
            // 'roles'             => 'required',
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

        $user->roles()->sync(2);

        $mahasiswa              = new Mahasiswa;
        $mahasiswa->user_id     = $user['id'];
        $mahasiswa->nim         = $request->nim;
        $mahasiswa->angkatan    = $request->angkatan;
        $mahasiswa->save();

        $data['user']       = $user;
        $data['mahasiswa']  = $mahasiswa;

        $res['status']  = 'success';
        $res['message'] = 'mahasiswa berhasil ditambahkan';
        $res['data']    =  $data;

        return $res;
    }

    public function update()
    {
        $validator = Validator::make(request()->all(), [
            'nama'              => 'required',
            'nim'               => ['required',Rule::unique('mahasiswa')->ignore(request()->id,'user_id')],
            'angkatan'          => 'required',
            'email'             => 'required|unique:users,email,'.request()->id,
            // 'roles'             => 'required',
            'username'          => 'required|unique:users,username,'.request()->id,
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

        $user               = User::findOrFail(request()->id);
        $user->nama         = request()->nama;
        $user->email        = request()->email;
        $user->username     = request()->username;
        $user->password     = bcrypt(request()->password);
        $user->update();

        // $user->roles()->sync(request()->roles);

        $mahasiswa = Mahasiswa::where('user_id', request()->id )
                    ->update([
                        'nim'       => request()->nim,
                        'angkatan'  => request()->angkatan
                    ]);

        $data['user']       = $user;
        $data['mahasiswa']  = Mahasiswa::where('user_id', request()->id )->get();

        $res['status']  = 'success';
        $res['message'] = 'mahasiswa berhasil dirubah';
        $res['data']    =  $data;

        return $res;
    }

    public function detail($id)
    {
        $user               = User::role("Mahasiswa")->with('mahasiswa')->findOrFail($id);

        // $data['user']       = $user;
        // $data['mahasiswa']  = Mahasiswa::where('user_id', $id)->get();

        $res['status']  = 'success';
        $res['message'] = 'detail mahasiswa';
        $res['data']    =  $user;

        return $res;
    }

    public function delete($id)
    {
        $cekPeserta = Peserta::where('id_mahasiswa','=',$id)
                                ->first();

        if($cekPeserta){
            $res['status']  =  'failed';
            $res['message'] =  'Peserta masih terdaftar sebagai peserta program akademik';
            $res['data']    =  [];

            return $res;
        }

        $mahasiswa  = Mahasiswa::where('user_id', $id )->delete();

        $user  = User::findOrFail($id);
        $user->delete();

        $res['status']  = 'success';
        $res['message'] = 'mahasiswa berhasil dihapus';
        $res['data']    =  [];

        return $res;
    }


}

?>