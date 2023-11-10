<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Validator;

use App\Models\User;
use App\Models\Mahasiswa;

class AuthController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-create', ['only' => ['register']]);
    }

    public function register() {
        $validator = Validator::make(request()->all(), [
            'nama'              => 'required',
            'email'             => 'email|unique:users',
            'roles'             => 'required',
            'username'          => 'required|unique:users',
            'password'          => 'required',
        ]);
 
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
 
        $user = new User;
        $user->nama             = request()->nama;
        $user->email            = request()->email;
        $user->username         = request()->username;
        $user->password         = bcrypt(request()->password);
        $user->save();

        $isMahasiswa    = false;
        $isDosen        = false;
        $isGuru   = false;

        foreach (request()->roles as $role) {
            $user->assignRole($role);

            if($role == 'Mahasiswa'){
                $isMahasiswa = true;
            }

            if($role == 'Dosen Pembimbing'){
                $isDosen = true;
            }

            if($role == 'Guru Pamong'){
                $isGuru = true;
            }
        }

        if($isMahasiswa){
            $data           = new Mahasiswa;
            $data->user_id  = $user['id'];
            $data->nim      = request()->nim;
            $data->angkatan = request()->angkatan;
            $data->save();
        }
 
        return response()->json($user, 201);
    }

    public function login()
    {
        $dataLogin    = request(['username', 'password']);

        $cekDataLogin = User::where('username', request()->username)->first();

        if( !$cekDataLogin ){
            $res['status']  = 'failed';
            $res['message'] = 'Maaf Username Tidak Terdaftar';
            $res['data']    =  [];

            return $res;
        }
 
        if (! $token = auth('api')->attempt($dataLogin)) {
            // return response()->json(['error' => 'Unauthorized'], 401);
            $res['status']  = 'failed';
            $res['message'] = 'Maaf Password Salah';
            $res['data']    =  [];

            return $res;
        }
 
        return response()->json([
            'status'    => 'success',
            'user'      => $cekDataLogin,
            'role'      => $cekDataLogin->getUserRolesAttribute(),
            'token'     => $token,
            'type'      => 'bearer', 
        ]);
    }

    // public function login(Request $request)
    // {
    //     $credentials = [
    //         'username' => $request->username,
    //         'password' => $request->password,
    //     ];

    //     if (Auth::guard('web')->attempt($credentials)) {
    //         $user = Auth::guard('web')->user();
    //         $user->api_token = Str::random(60);
    //         $user->save();

    //         $res["status"] = "success";
    //         $res["data"]   = $user;

    //         return $res;
    //     }

    //     return response()->json(['message' => 'Something went wrong'], 401);
    // }

    public function me()
    {
        $res['status']  = 'success';
        $res['message'] = 'Its Me';
        $res['data']    =  auth('api')->user();

        // $res['data']    =  response()->json(auth('api')->user());

        return $res;
    }

    public function logout()
    {
        auth('api')->logout();
 
        return response()->json(['message' => 'Berhasil keluar']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'type' => 'bearer'
            // 'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
