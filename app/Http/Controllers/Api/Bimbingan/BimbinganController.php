<?php 
namespace App\Http\Controllers\Api\Bimbingan;

// use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// use App\Models\Dosen;
use App\Models\Peserta;
// use App\Models\Logbook;

/**
 * 
 */
class BimbinganController extends Controller
{
	
	// function __construct(argument)
	// {
	// 	// code...
	// }

	public function bimbingan(Request $request)
    {
        $data = [];

        if($request->pembimbing == 'dosen'){
            $data = Peserta::where('id_dosen_pembimbing','=',$request->id)
                    // ->select('id as id_peserta', 'mahasiswa')
                    ->with('mahasiswa')
                    ->get();

        }elseif ($request->pembimbing == 'guru') {
            $data = Peserta::where('id_dosen_pembimbing','=',$request->id)->with('program','mahasiswa','pamong','penguji')->get();
        }

        // $data = Peserta::where('id_dosen_pembimbing','=',$id)->with('program','mahasiswa','pamong','penguji')->get();

        $res['status']  = 'success';
        $res['message'] = 'list bimbingan';
        $res['data']    =  $data;

        return $res;
    }

    
}

?>