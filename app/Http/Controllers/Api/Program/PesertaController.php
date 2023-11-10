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
            $res['status']  = 'failed';
            $res['message'] =  $validator->errors();
            $res['data']    =  [];

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
        $data->save();

        $res['status']  = 'success';
        $res['message'] = 'peserta PLP berhasil ditambahkan';
        $res['data']    =  $data;

        return $res;
    }
}

?>