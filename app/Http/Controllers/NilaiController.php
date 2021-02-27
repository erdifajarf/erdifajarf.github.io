<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class NilaiController extends Controller
{
    //MENAMPILKAN DATA PMDK DI HALAMAN UTAMA
    function show(){
        $data=Nilai::paginate(10);
        return view('import',['nilais'=>$data]);
    }
}
