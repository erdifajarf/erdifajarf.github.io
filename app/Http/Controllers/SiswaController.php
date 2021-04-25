<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Siswa;

use Illuminate\Http\Request;



class SiswaController extends Controller
{
    private $noPmb;
    private $namaSiswa;
    private $skl;
    private $nilai;
    

    function __construct($noPmb,$namaSiswa,$skl,$nilai){
        $this->noPmb = $noPmb;
        $this->namaSiswa = $namaSiswa;
        $this->skl = $skl;
        $this->nilai = $nilai;
    }
  
    function getNoPmb(){
        return $this->noPmb;
    }
    function getNamaSiswa(){
        return $this->namaSiswa;
    }

    function getSekolah(){
        //Mengembalikan tipe data sekolah seorang siswa
        return $this->skl;
    }

    function getNilai(){
        return $this->nilai;
    }



}
