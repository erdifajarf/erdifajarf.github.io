<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FuzzyAhpController extends Controller
{
    //
    private $ntp,$nti,$pti;
    private $hasilKategori;

    private $bobotAwalKriteria; //Menyimpan penilaian awal kriteria
    private $tempTfnKriteria; //Menyimpan penilaian awal kriteria yang telah dimodifikasi untuk dijadikan ke TFN

    private $bobotPrioritasAntarKriteria;
    private $bobotPrioritasAntarAlternatif;

    function __construct($hasilKategori,$ntp, $nti, $pti){
        $this->ntp = $ntp;
        $this->nti = $nti;
        $this->pti = $pti;
    }

    function getNtp(){
        return $this->ntp;
    }

    function getNti(){
        return $this->nti;
    }

    function getPti(){
        return $this->pti;
    }

    function getBobotAwalKriteria(){
        $this->susunBobotAwalKriteria();
        return $this->bobotAwalKriteria;
    }

    
    function getTfnKriteria(){
        $this->susunBobotAwalKriteria();
        return $this->tempTfnKriteria;
    }


    function susunBobotAwalKriteria():void{
        for ($i = 0; $i < 3; $i++) {
            for ($j = 0; $j < 3; $j++) {
                if($i==$j){
                    $this->bobotAwalKriteria[$i][$j]=1;
                    $this->tempTfnKriteria[$i][$j]=1;
                }
                
                else if ($i==0 &&$j==1){
                    if($this->ntp>0){
                        $this->bobotAwalKriteria[$i][$j]=$this->ntp;
                        $this->tempTfnKriteria[$i][$j]=$this->ntp;
                    }
                    else{
                        $this->bobotAwalKriteria[$i][$j]= (1/$this->ntp);
                        $this->tempTfnKriteria[$i][$j]=-$this->ntp;
                    }
                    
                }
                else if ($i==0 &&$j==2){
                    if($this->nti>0){
                        $this->bobotAwalKriteria[$i][$j]=($this->nti);
                        $this->tempTfnKriteria[$i][$j]=($this->nti);
                    }
                    else{
                        $this->bobotAwalKriteria[$i][$j]=(1/$this->nti);
                        $this->tempTfnKriteria[$i][$j]=-$this->nti;
                    }
                    
                }
                else if ($i==1 && $j==2){
                     if($this->pti>0){
                        $this->bobotAwalKriteria[$i][$j]=($this->pti);
                        $this->tempTfnKriteria[$i][$j]=$this->pti;
                    }
                    else{
                        $this->bobotAwalKriteria[$i][$j]=(1/$this->pti);
                        $this->tempTfnKriteria[$i][$j]=-$this->pti;
                    }
                }
                else{
                    $this->bobotAwalKriteria[$i][$j]= 1/$this->bobotAwalKriteria[$j][$i];
                    $this->tempTfnKriteria[$i][$j]=-$this->tempTfnKriteria[$j][$i];
                }
            }
        }
    }


    function hitungConsistencyRatio(array $arrKriteria){
        $totalKolom=array_fill(0,count($arrKriteria),0);        //array 1 dimensi menjumlahkan setiap kolom
        
        for ($i = 0; $i<count($arrKriteria); $i++) {
            for ($j = 0; $j < count($arrKriteria); $j++) {
                $totalKolom[$j]+=$arrKriteria[$i][$j];
            }
        }
        
        // $normalisasi;
        for ($i = 0; $i <count($arrKriteria); $i++){ //array 2 dimensi untuk menampung hasil normalisasi
            for ($j = 0; $j < count($arrKriteria[0]); $j++) {
                $normalisasi[$i][$j]= $arrKriteria[$i][$j]/$totalKolom[$j];
            }
        }
        
        $totalBaris=array(0=>0,1=>0,2=>0); //array 1 dimensi menjumlahkan setiap baris
        for ($i = 0; $i <count($totalBaris); $i++) {
            for ($j = 0; $j<count($totalBaris); $j++) {
                $totalBaris[$j]+=$normalisasi[$j][$i];
            }
        }
        
        $rataRata; //array 1 dimensi menyimpan rata-rata setiap baris
        for ($i = 0; $i <count($totalBaris) ; $i++) {
           $rataRata[$i]=$totalBaris[$i]/count($totalBaris);
        }
        
        $lambdaMax=0; //nilai lambda max
        for ($i=0; $i<count($rataRata);$i++){
            $lambdaMax+= $totalKolom[$i]*$rataRata[$i];
        }
        
        $CI= ($lambdaMax-count($arrKriteria))/(count($arrKriteria)-1); //nilai consistency index
        
        $RI= array(0=>0.0, 1=> 0.0, 2=> 0.58, 3=>0.90, 4=>1.12, 5=>1.24, 6=>1.32,
        7=>1.41, 8=>1.45, 9=>1.49, 10=>1.51, 11=>1.53, 12=> 1.56, 13=>1.57, 14=>1.59);  //nilai random index

        $CR= $CI/$RI[count($arrKriteria)-1]; //nilai consistency ratio
        
        if($CR<=0.1){
            return number_format($CR,2);
        }
        else{
            echo 'ULANGI PENILAIAN ANDA';
        }
      
    }

    function hitungBobotPrioritasAntarKriteria(){
       $this->susunBobotAwalKriteria();
       $delta = 1;
       $tfn;
       $countJ=0;

    //bentuk triangular fuzzy number
       for ($i = 0; $i < count($this->tempTfnKriteria); $i++) {
           for ($j = 0; $j < count($this->tempTfnKriteria)*count($this->tempTfnKriteria); $j+=3) { 
                
                if($this->tempTfnKriteria[$i][$countJ]==1)
                    {
                        $tfn[$i][$j]=$this->tempTfnKriteria[$i][$countJ];
                        $tfn[$i][$j+1]=$this->tempTfnKriteria[$i][$countJ];
                        $tfn[$i][$j+2]=$this->tempTfnKriteria[$i][$countJ];
                    }
                else if($this->tempTfnKriteria[$i][$countJ]>1){
                        $tfn[$i][$j]=$this->tempTfnKriteria[$i][$countJ]-$delta;
                        $tfn[$i][$j+1]=$this->tempTfnKriteria[$i][$countJ];
                        $tfn[$i][$j+2]=$this->tempTfnKriteria[$i][$countJ]+$delta;
                    }
                else{
                        $tfn[$i][$j]=1/(abs($this->tempTfnKriteria[$i][$countJ])+$delta);
                        $tfn[$i][$j+1]=1/(abs($this->tempTfnKriteria[$i][$countJ]));
                        $tfn[$i][$j+2]=1/(abs($this->tempTfnKriteria[$i][$countJ])-$delta);
                    }
                    $countJ+=1; 
            }
           $countJ=0;
       }

       //menghitung nilai rata-rata geometris dari tfn
       $rataRataGeo;
       $a=0;
       $b=3;
       $c=6;
       $jumlahKolom = 1.0/count($this->tempTfnKriteria[0]);
       
        for ($i = 0; $i < count($this->tempTfnKriteria); $i++) {
            for ($j = 0; $j < count($this->tempTfnKriteria[0]); $j++) {
        
                $rataRataGeo[$i][$j]=pow($tfn[$i][$a]*$tfn[$i][$b]*$tfn[$i][$c],$jumlahKolom);
                $a++;
                $b++;
                $c++;
            }
            $a=0;
            $b=3;
            $c=6;
        }
       
        //menghitung hasil jumlah nilai geometris
       $jumlahNilaiGeo=array_fill(0,3,0);
       
        for ($i = 0; $i < count($rataRataGeo); $i++) {
           for ($j = 0; $j < count($rataRataGeo[0]); $j++) {
               $jumlahNilaiGeo[$i]+=$rataRataGeo[$j][$i];
           }
         
        }

        //menghitung bobot fuzzy untuk setiap kriteria
        $bobotFuzzy;;
    
        $idxGeo=2;
        for ($i = 0; $i < count($rataRataGeo); $i++) {
            for ($j = 0; $j < count($rataRataGeo[0]); $j++) {
                $bobotFuzzy[$i][$j]=number_format($rataRataGeo[$i][$j]*1/$jumlahNilaiGeo[$idxGeo],2);
                $idxGeo--;
            }
            $idxGeo=2;
        }

       //hasil defuzifikasi atau bobot prioritas setiap kriteria
       $hasilDefuzzifikasi=array_fill(0,count($bobotFuzzy),0);
       $jumlahBobot=0;
       $hasilNormalisasi;
       
       for ($i = 0; $i <count($bobotFuzzy); $i++) {
           for ($j = 0; $j < count($bobotFuzzy[0]); $j++) {
               $hasilDefuzzifikasi[$i]+=number_format($bobotFuzzy[$i][$j],3);
           }
           $hasilDefuzzifikasi[$i]=number_format($hasilDefuzzifikasi[$i]/3,3);
       }
       
       foreach ($hasilDefuzzifikasi as $nilai){
           $jumlahBobot+=number_format($nilai,3);
       }
       
       for ($i = 0; $i < count($bobotFuzzy); $i++) {
           $hasilNormalisasi[$i]=number_format($hasilDefuzzifikasi[$i]/$jumlahBobot,3);
       }
       
       return $hasilNormalisasi;
    
    }





    
}
