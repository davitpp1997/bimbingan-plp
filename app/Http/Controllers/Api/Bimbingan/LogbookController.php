<?php

namespace App\Http\Controllers\Api\Bimbingan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\Logbook;

class LogbookController extends Controller
{
    public function logbook()
    {
        $data = Logbook::get();

        $res['status']  = 'success';
        $res['message'] = 'daftar logbook';
        $res['data']    =  $data;

        return $res;
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_peserta'  => 'required',
            'judul'       => 'required',
            'tanggal'     => 'required',
            'keterangan'  => 'required',
            'pembimbing'  => 'required',
        ]);

        if($validator->fails()){
            $err = $validator->messages()->first();
            $res['status']   = 'failed';
            $res['message']  = $err;
            $res['data']     = [];

            return $res;
        }

        $data                   = new Logbook();
        $data->id_peserta       = $request->id_peserta;
        $data->judul            = $request->judul;
        $data->tanggal          = $request->tanggal;
        $data->keterangan       = $request->keterangan;
        $data->pembimbing       = $request->pembimbing;
        $data->status           = 'Menunggu Validasi';
        $data->save();

        $res['status']  = 'success';
        $res['message'] = 'logbook berhasil ditambahkan';
        $res['data']    =  $data;

        return $res;
    }

    public function logbookPembimbing(Request $request)
    {
        $data = Logbook::where('id_peserta', '=', $request->id_peserta)
                        ->where('pembimbing','=', $request->pembimbing)
                        ->get();

        $res['status']  = 'success';
        $res['message'] = 'daftar logbook';
        $res['data']    =  $data;

        return $res;
    }

    public function validasi($id)
    {
        $logbook = Logbook::where('id', $id )
                    ->update([
                        'status'   => 'Valid',
                    ]);

        $res['status']  = 'success';
        $res['message'] = 'logbook berhasil divalidasi';
        $res['data']    =  $logbook;

        return $res;
    }

}
