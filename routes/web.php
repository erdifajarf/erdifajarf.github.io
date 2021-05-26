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

Route::get('/', function () {
    return view('halamanLogin');
});


Route::get('/halamanLogin', [MainController::class, 'pindahHalamanLogin']);
Route::post('/halamanLogin',[MainController::class, 'login'])->name('jalankanLogin');

Route::get('/halamanUtama',[MainController::class,'pindahHalamanImport']);
Route::post('/halamanUtama', [MainController::class,'importData'])->name('importData');
Route::get('/halamanUtama',[MainController::class,'showDataPeminat']);

Route::get('/halamanPenentuanBobotDanKuota',[MainController::class,'pindahHalamanPenentuanBobot']);
Route::post('/halamanHasilSeleksi',[MainController::class,'main'])->name('jalankanSeleksi');


Route::post('/halamanPenentuaBobotDanKuota',[MainController::class,'exportData'])->name('exportData');



