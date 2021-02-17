<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class NilaiController extends Controller
{
    //
    public function index()
    {
        return view('import', [
            'users' => DB::table('nilai')->paginate(5)
        ]);
    }

    public function show(){
        $data = Nilai::paginate(2);
        return view('import',['nilais'=>$data]);
    }
}
