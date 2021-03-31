<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    private $hasilSeleksiKkm; // Array Siswa, dari yang sudah di seleksiKKM
    private $alumniSekolah; //Array kumpulan mahasiswa di DB

    private $namaPeminat;
    private $rataRataNilaiAkhir; // Rata rata nilai mat dan ing
    private $ipkAlumni; //Array ipk para alumni sekolah yg sama dengan peminat PMDK

    function __construct($hasilSeleksiKkm){
        $this->hasilSeleksiKkm = $hasilSeleksiKkm;
        // $this->alumniSekolah = $alumniSekolah;
    }

    function getNamaPeminat(){
        for($i=0; $i<count($this->hasilSeleksiKkm); $i++){
            $this->namaPeminat[$i]=$this->hasilSeleksiKkm[$i]->getNamaSiswa();
        }
        return $this->namaPeminat;
    }

    function hitungRataRataNilaiAkhir(){
        for($i=0; $i<count($this->hasilSeleksiKkm); $i++){
            $this->rataRataNilaiAkhir[$i]= ($this->hasilSeleksiKkm[$i]->getNilai()[0]->hitungRataRata()+
            $this->hasilSeleksiKkm[$i]->getNilai()[1]->hitungRataRata())/2;
        }
        return $this->rataRataNilaiAkhir;
    }




}
