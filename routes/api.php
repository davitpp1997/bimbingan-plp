<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Authentication
use App\Http\Controllers\Api\Auth\AuthController;

//Akademik
use App\Http\Controllers\Api\Akademik\MataKuliahController;
use App\Http\Controllers\Api\Akademik\MahasiswaController;
use App\Http\Controllers\Api\Akademik\DosenController;
use App\Http\Controllers\Api\Akademik\ProgramController;

// Mitra
use App\Http\Controllers\Api\Mitra\GuruController;
use App\Http\Controllers\Api\Mitra\SekolahController;
use App\Http\Controllers\Api\Mitra\JurusanController;

// Program PLP
use App\Http\Controllers\Api\Program\PesertaController;

// Bimbingan
use App\Http\Controllers\Api\Bimbingan\BimbinganController;
use App\Http\Controllers\Api\Bimbingan\LogbookController;

// Lesson Study
use App\Http\Controllers\Api\LessonStudy\LessonStudyController;
use App\Http\Controllers\Api\LessonStudy\PengamatanSiswaController;
use App\Http\Controllers\Api\Penilaian\KegiatanMengajarController;

// Ujian Lisan
use App\Http\Controllers\Api\UjianLisan\UjianLisanController;


// Penilaian
use App\Http\Controllers\Api\Penilaian\PenilaianController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::group([
 
//     'middleware' => 'api',
//     'prefix' => 'auth'
 
// ], function ($router) {
//     Route::post('/register', [AuthController::class, 'register'])->name('register');
//     Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
//     Route::post('/refresh', [AuthController::class, 'refresh'])->name('refresh');
//     Route::post('/me', [AuthController::class, 'me'])->name('me');
// });

Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth.jwt']], function() {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('me', [AuthController::class, 'me']);
    Route::post('refresh', [AuthController::class, 'refresh']);

    // Mata Kuliah
    Route::get('mata_kuliah', [MataKuliahController::class, 'list']);
    Route::post('create_mata_kuliah', [MataKuliahController::class, 'create']);
    Route::post('update_mata_kuliah', [MataKuliahController::class, 'update']);
    Route::get('delete_mata_kuliah/{id}', [MataKuliahController::class, 'delete']);

    //Dosen
    Route::post('dosen', [DosenController::class, 'dosen']);
    Route::post('create_dosen', [DosenController::class, 'create']);
    Route::post('update_dosen', [DosenController::class, 'update']);
    Route::get('detail_dosen/{id}', [DosenController::class, 'detail']);
    Route::get('delete_dosen/{id}', [DosenController::class, 'delete']);

    //Mahasiswa
    Route::get('mahasiswa', [MahasiswaController::class, 'mahasiswa']);
    Route::post('create_mahasiswa', [MahasiswaController::class, 'create']);
    Route::post('update_mahasiswa', [MahasiswaController::class, 'update']);
    Route::get('detail_mahasiswa/{id}', [MahasiswaController::class, 'detail']);
    Route::get('delete_mahasiswa/{id}', [MahasiswaController::class, 'delete']);

    //Program
    Route::get('program', [ProgramController::class, 'program']);
    Route::post('create_program', [ProgramController::class, 'create']);
    Route::post('update_program', [ProgramController::class, 'update']);
    Route::get('detail_program/{id}', [ProgramController::class, 'detail']);
    Route::get('delete_program/{id}', [ProgramController::class, 'delete']);

    //Sekolah
    Route::get('sekolah', [SekolahController::class, 'sekolah']);
    Route::post('create_sekolah', [SekolahController::class, 'create']);
    Route::post('update_sekolah', [SekolahController::class, 'update']);
    Route::get('detail_sekolah/{id}', [SekolahController::class, 'detail']);
    Route::get('delete_sekolah/{id}', [SekolahController::class, 'delete']);

    //Jurusan
    // Route::get('jurusan', [JurusanController::class, 'jurusan']);
    // Route::post('create_jurusan', [JurusanController::class, 'create']);
    // Route::post('update_jurusan', [JurusanController::class, 'update']);
    // Route::get('detail_jurusan/{id}', [JurusanController::class, 'detail']);
    // Route::get('delete_jurusan/{id}', [JurusanController::class, 'delete']);

    //Guru
    Route::get('guru', [GuruController::class, 'guru']);
    Route::post('create_guru', [GuruController::class, 'create']);
    Route::post('update_guru', [GuruController::class, 'update']);
    Route::get('detail_guru/{id}', [GuruController::class, 'detail']);
    Route::get('delete_guru/{id}', [GuruController::class, 'delete']);

    //Peserta
    Route::get('peserta', [PesertaController::class, 'peserta']);
    Route::post('create_peserta', [PesertaController::class, 'create']);
    Route::post('update_peserta', [PesertaController::class, 'update']);
    Route::get('detail_peserta/{id}', [PesertaController::class, 'detail']);
    Route::get('delete_peserta/{id}', [PesertaController::class, 'delete']);

    //Bimbingan
    Route::post('bimbingan', [BimbinganController::class, 'bimbingan']);

    // Logbok
    Route::post('create_logbook', [LogbookController::class, 'create']);
    Route::post('logbook_pembimbing', [LogbookController::class, 'logbookPembimbing']);
    Route::get('validasi/{id}', [LogbookController::class, 'validasi']);

    // Lesson Study
    Route::post('create_ls', [LessonStudyController::class, 'create']);

    // Penilaian Kegiatan Mengajar
    Route::post('save_nkm', [KegiatanMengajarController::class, 'save']);

    // Observer
    Route::post('save_aktivitas', [PengamatanSiswaController::class, 'saveAktivitas']);
    Route::post('save_catatan', [PengamatanSiswaController::class, 'saveCatatan']);

    // Ujian Lisan 
    Route::post('create_ujian', [UjianLisanController::class, 'create']);
    Route::post('save_nilai_ujian', [UjianLisanController::class, 'saveNilaiUjian']);
    Route::post('create_saran', [UjianLisanController::class, 'createSaran']);

    // Penilaian
    Route::post('save_nks', [PenilaianController::class, 'saveNilaiKS']);
    Route::post('save_naipti', [PenilaianController::class, 'saveNilaiAIPTI']);
    Route::post('save_nprp', [PenilaianController::class, 'saveNilaiPRP']);
    Route::post('save_nlaporan', [PenilaianController::class, 'saveNilaiLaporan']);
    Route::post('perhitungan_nls', [PenilaianController::class, 'perhitunganNilaiLS']);
    Route::post('perhitungan_nakhir', [PenilaianController::class, 'perhitunganNilaiAkhir']);

});
