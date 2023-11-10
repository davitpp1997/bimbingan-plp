<?php 
namespace App\Http\Controllers\Api\Bimbingan;

// use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Dosen;
use App\Models\PesertaPLP;


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

        $data = PesertaPLP::where('id_dosen_pembimbing','=',$id)->with('program','mahasiswa','pamong')->get();

        $res['status']  = 'success';
        $res['message'] = 'list dosen';
        $res['data']    =  $data;

        return $res;
    }
}

?>