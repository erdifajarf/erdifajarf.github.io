<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    //

    private $namaMataPelajaran;

    function __construct($namaMataPelajaran){
        $this->namaMataPelajaran = $namaMataPelajaran;
    }

    function getMataPelajaran(){
        return $this->namaMataPelajaran;
    }
}
