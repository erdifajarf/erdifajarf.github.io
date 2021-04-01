<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    private $npm;
    private $namaMahasiswa;
    private $sekolah;
    private $ipk;
    
    function __construct($npm,$namaMahasiswa,$sekolah,$ipk){
        $this->npm = $npm;
        $this->namaMahasiswa = $namaMahasiswa;
        $this->sekolah = $sekolah;
        $this->ipk = $ipk;
    }

    function getNpm(){
        return $this->npm;
    }
    
    function getNamaMahasiswa(){
        return $this->namaMahasiswa;
    }

    function getSekolah(){
        return $this->sekolah;
    }

    function getIpk(){
        return $this->ipk;
    }

}

