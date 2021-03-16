<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class SekolahController extends Controller
{
    //
    private $namaSekolah;
    private $peringkat;

    function __construct($namaSekolah='', $peringkat=''){
        $this->namaSekolah = $namaSekolah;
        $this->peringkat = $peringkat;
    }

    function getNamaSekolah(){
        return $this->namaSekolah;
    }

    function getPeringkat(){
        return $this->peringkat;
    }
}