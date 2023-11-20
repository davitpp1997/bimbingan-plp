<?php  
namespace App\Http\Controllers\Api\Program;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Peserta;

/**
 * 
 */
class PesertaController extends Controller
{
	
	// function __construct(argument)
	// {
	// 	// code...
	// }

	public function peserta()
    {
        $data = Peserta::with('program','mahasiswa','pembimbing','pamong','sekolah','jurusan','penguji')->get();

        $res['status']  = 'success';
        $res['message'] = 'list peserta PLP';
        $res['data']    =  $data;

        return $res;
    }

	public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_program'    		=> 'required',
            'id_mahasiswa'  		=> 'required',
            'id_dosen_pembimbing'  	=> 'required',
            'id_sekolah'  			=> 'required',
            'id_jurusan'  			=> 'required',
            'id_guru_pamong'  		=> 'required',
        ]);

        if($validator->fails()){
            $err = $validator->messages()->first();
            $res['status']   = 'failed';
            $res['message']  = $err;
            $res['data']     = [];

            return $res;
        }

        $cekPeserta = Peserta::where('id_program','=',$request->id_program)
                                ->where('id_mahasiswa','=',$request->id_mahasiswa)
                                ->first();

        if($cekPeserta){
            $res['status']  =  'failed';
            $res['message'] =  'Peserta sudah terdaftar pada program yang dipilih';
            $res['data']    =  [];

            return $res;
        }

        $data               		= new Peserta();
        $data->id_program         	= $request->id_program;
        $data->id_mahasiswa  		= $request->id_mahasiswa;
        $data->id_dosen_pembimbing	= $request->id_dosen_pembimbing;
        $data->id_sekolah  			= $request->id_sekolah;
        $data->id_jurusan  			= $request->id_jurusan;
        $data->id_guru_pamong  		= $request->id_guru_pamong;
        if( $request->id_dosen_penguji!= null ){
            $data->id_dosen_penguji  = $request->id_dosen_penguji;
        }
        $data->save();

        $res['status']  = 'success';
        $res['message'] = 'peserta PLP berhasil ditambahkan';
        $res['data']    =  $data;

        return $res;
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_program'            => 'required',
            'id_mahasiswa'          => 'required',
            'id_dosen_pembimbing'   => 'required',
            'id_sekolah'            => 'required',
            'id_jurusan'            => 'required',
            'id_guru_pamong'        => 'required',
        ]);

        if($validator->fails()){
            $err = $validator->messages()->first();
            $res['status']   = 'failed';
            $res['message']  = $err;
            $res['data']     = [];

            return $res;
        }

        $cekPeserta = Peserta::where('id','!=',$request->id)
                                // ->where('id_program','=',$request->id_program)
                                ->where('id_program','=',$request->id_program)
                                ->where('id_mahasiswa','=',$request->id_mahasiswa)
                                ->first();
        if($cekPeserta){
            $res['status']  =  'failed';
            $res['message'] =  'Peserta sudah terdaftar pada program yang dipilih';
            $res['data']    =  [];

            return $res;
        }

        $data                       = Peserta::where('id','=',$request->id)->first();
        $data->id_program           = $request->id_program;
        $data->id_mahasiswa         = $request->id_mahasiswa;
        $data->id_dosen_pembimbing  = $request->id_dosen_pembimbing;
        $data->id_sekolah           = $request->id_sekolah;
        $data->id_jurusan           = $request->id_jurusan;
        $data->id_guru_pamong       = $request->id_guru_pamong;
        if( $request->id_dosen_penguji!= null ){
            $data->id_dosen_penguji  = $request->id_dosen_penguji;
        }
        $data->save();

        $res['status']  = 'success';
        $res['message'] = 'peserta PLP berhasil diupdate';
        $res['data']    =  $data;

        return $res;
    }

    public function detail($id)
    {
        $data = Peserta::where('id','=',$id)
                            ->with('program','mahasiswa','pembimbing','pamong','sekolah','jurusan','penguji')
                            ->get();

        $res['status']  = 'success';
        $res['message'] = 'detail peserta PLP';
        $res['data']    =  $data;

        return $res;
    }

    public function delete($id)
    {
        $data               = Peserta::findOrFail($id);
        $data->delete();

        $res['status']  = 'success';
        $res['message'] = 'peserta berhasil dihapus';
        $res['data']    =  [];

        return $res;
    }
}

?>