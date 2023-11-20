<?php 

namespace App\Http\Controllers\Api\Mitra;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Guru;
use App\Models\Peserta;

class GuruController extends Controller
{   
    // function __construct()
    // {
    //     $this->middleware('permission:user-list', ['only' => ['guru']]);
    //     $this->middleware('permission:user-create', ['only' => ['create']]);
    //     $this->middleware('permission:user-edit', ['only' => ['detail','update']]);
    //     $this->middleware('permission:user-delete', ['only' => ['delete']]);
    // }

    public function guru()
    {
        $data = User::role("Guru Pamong")->with('guru')->get();

        $res['status']  = 'success';
        $res['message'] = 'list guru';
        $res['data']    =  $data;

        return $res;
    }

    public function create()
    {
        $validator = Validator::make(request()->all(), [
            'nama'              => 'required',
            'kode_sekolah'      => 'required',
            'kode_jurusan'      => 'required',
            'email'             => 'unique:users',
            'nomor_identitas'   => 'required|unique:guru',
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

        // $user->roles()->sync(request()->roles);
        $user->roles()->sync(4);

        $guru                   = new Guru;
        $guru->user_id          = $user['id'];
        $guru->nomor_identitas  = request()->nomor_identitas;
        $guru->kode_sekolah       = request()->kode_sekolah;
        $guru->kode_jurusan       = request()->kode_jurusan;
        $guru->save();


        $res['status']  = 'success';
        $res['message'] = 'guru berhasil ditambahkan';
        $res['data']    =  $user;

        return $res;
    }

    public function update()
    {
        $validator = Validator::make(request()->all(), [
            'nama'              => 'required',
            'nomor_identitas'   => ['required',Rule::unique('guru')->ignore(request()->id,'user_id')],
            'kode_sekolah'      => 'required',
            'kode_jurusan'      => 'required',
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

        $guru = Guru::where('user_id', request()->id )
                    ->update([
                        'nomor_identitas'   => request()->nomor_identitas,
                        'kode_sekolah'      => request()->kode_sekolah,
                        'kode_jurusan'      => request()->kode_jurusan
                    ]);


        $res['status']  = 'success';
        $res['message'] = 'guru berhasil dirubah';
        $res['data']    =  $user;

        return $res;
    }

    public function detail($id)
    {
        $user               = User::where('id', '=', $id)->with('guru')->get();

        $res['status']  = 'success';
        $res['message'] = 'detail guru';
        $res['data']    =  $user;

        return $res;
    }

    public function delete($id)
    {
        $cekPeserta = Peserta::where('id_guru_pamong','=',$id)
                                ->first();

        if($cekPeserta){
            $res['status']  =  'failed';
            $res['message'] =  'Guru masih terdaftar sebagai peserta program akademik';
            $res['data']    =  [];

            return $res;
        }

        $guru  = Guru::where('user_id', $id )->delete();

        $user  = User::findOrFail($id);
        $user->delete();

        $res['status']  = 'success';
        $res['message'] = 'guru berhasil dihapus';
        $res['data']    =  [];

        return $res;
    }


}

?>