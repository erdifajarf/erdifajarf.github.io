<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    private $hasilSeleksiKkm; // Array Siswa, dari yang sudah di seleksiKKM
    private $alumniSekolah; //Array kumpulan mahasiswa di DB
    // private $ipkAlumni; //Array ipk para alumni sekolah yg sama dengan peminat PMDK

    function __construct($hasilSeleksiKkm,$alumniSekolah){
        $this->hasilSeleksiKkm = $hasilSeleksiKkm;
        $this->alumniSekolah = $alumniSekolah;
    }


    function hitungRataRataNilaiAkhir($idx){

        return ($this->hasilSeleksiKkm[$idx]->getNilai()[0]->hitungRataRata()+
        $this->hasilSeleksiKkm[$idx]->getNilai()[1]->hitungRataRata())/2;
    }

    function hitungIpkAlumni($idx){

        $ipkAlumni=0;
        $hitungJumlahAlumni = 0;
        $jumlahIPK=0;
        $rataRataIPK=0;

             for ($j = 0; $j < count($this->alumniSekolah); $j++) 
                {
                    if($this->hasilSeleksiKkm[$idx]->getSekolah()->getNamaSekolah()->nama_sekolah == $this->alumniSekolah[$j]->getSekolah()->getNamaSekolah()->nama_sekolah){
                         $jumlahIPK+=$this->alumniSekolah[$j]->getIpk()->IPK;
                         $hitungJumlahAlumni+=1;
                    }   
                }

                if($hitungJumlahAlumni==0)
                {
                    $ipkAlumni=0;
                }
                else{
                    $ipkAlumni=$jumlahIPK/$hitungJumlahAlumni;
                    $hitungJumlahAlumni=0;
                    $jumlahIPK=0;
                }

                return $ipkAlumni;
        }

    function getHasilKriteria(){
        $hasilSeleksi;

        for($i=0; $i<3; $i++){
            for($j=0; $j<count($this->hasilSeleksiKkm); $j++){
                if ($i==0){
                    $hasilSeleksi[$i][$j]=$this->hasilSeleksiKkm[$j];
                }
                else if($i==1){
                    $hasilSeleksi[$i][$j]=$this->hitungRataRataNilaiAkhir($j);
                }
                else{
                    $hasilSeleksi[$i][$j]=$this->hitungIpkAlumni($j);
                }
          
            }
        }
        

        return $hasilSeleksi;
        
    }




}
