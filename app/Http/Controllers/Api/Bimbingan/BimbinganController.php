<?php 
namespace App\Http\Controllers\Api\Bimbingan;

// use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Dosen;
use App\Models\Peserta;


/**
 * 
 */
class BimbinganController extends Controller
{
	
	// function __construct(argument)
	// {
	// 	// code...
	// }

	public function bimbinganDosenById($id)
    {
        $data = [];

        $data = Peserta::where('id_dosen_pembimbing','=',$id)->with('program','mahasiswa','pamong','penguji')->get();

        $res['status']  = 'success';
        $res['message'] = 'list bimbingan dosen';
        $res['data']    =  $data;

        return $res;
    }
}

?>