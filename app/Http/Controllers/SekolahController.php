<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class SekolahController extends Controller
{
    //
    private $namaSekolah;
    private $peringkat;

    public function __construct($namaSekolah='', $peringkat=''){
        $this->namaSekolah = $namaSekolah;
        $this->peringkat = $peringkat;
    }

    public function getNamaSekolah(){
        return $this->namaSekolah;
    }

    public function getPeringkat(){
        return $this->peringkat;
    }
}
