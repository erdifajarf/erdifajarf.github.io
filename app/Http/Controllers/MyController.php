<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Exports\UsersExport;
use App\Imports\DataImport;
use App\Imports\DataSekolahImport;
use Maatwebsite\Excel\Facades\Excel;


Use App\Http\Controllers\Redirect;

class MyController extends Controller
{
    
    // public function importExportView()
    // {
    //    return view('import');
    // }
     
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function export() 
    // {
    //     return Excel::download(new UsersExport, 'users.xlsx');
    // }
     
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function halamanImport(){
        return view('import');
    }

    public function halamanPenentuanBobot(){
        return view('halamanPenentuanBobotDanKuota');
    }


    public function importDataSiswa() 
    {
        Excel::import(new DataImport,request()->file('file'));
        return back();
    }

    public function importDataSekolah(){
        Excel::import(new DataSekolahImport,request()->file('file'));
        return back();

    }

}
