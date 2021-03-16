<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Siswa;

use Illuminate\Http\Request;



class SiswaController extends Controller
{
    private $namaSiswa;
    private $skl;
    private $nlMat;
    private $nlIng;

    // private $RataRataMat;
    // private $RataRataIng;


    function __construct($namaSiswa,$skl,$nlMat,$nlIng){
        $this->namaSiswa = $namaSiswa;
        $this->skl = $skl;
        $this->nlMat = $nlMat;
        $this->nlIng= $nlIng;
    }

    function getNamaSiswa(){
        return $this->namaSiswa->nama_siswa;
    }


    function getSekolah(){
        return $this->skl;
    }

    function getNilaiMat(){

        return $this->nlMat;
    }

    function getNilaiIng(){

        return $this->nlIng;
    }

    function hitungRataRata($nlMatpel){
        $total=0;

        $total = $nlMatpel[0]->{'101'}+
        $nlMatpel[1]->{'102'}+
        $nlMatpel[2]->{'111'}+ 
        $nlMatpel[3]->{'112'};

        $total = $total/4;
        return $total;
    }




}
