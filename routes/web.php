<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\MainController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('halamanUtama');
// });

// Route::get('/', function () {
//     return view('import');
// });

// Route::get('export', [MyController::class, 'export'])->name('export');

Route::get('/', [MyController::class, 'halamanImport']);
Route::post('/', [MyController::class,'importData'])->name('importData');
Route::get('/',[NilaiController::class,'show']);

Route::get('/halamanPenentuanBobotDanKuota',[MyController::class,'halamanPenentuanBobot']);



// Route::get('/halamanHasilSeleksi',[MyController::class,'halamanHasilSeleksi']);
Route::get('/halamanHasilSeleksi',[MainController::class,'showHasilSeleksiPMDK']);


