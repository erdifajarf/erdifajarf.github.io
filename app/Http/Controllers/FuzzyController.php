<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FuzzyController extends Controller
{
    //
    private $hasilKriteria;
    private $hasilKategori;

    function __construct($hasilKriteria){
        $this->hasilKriteria = $hasilKriteria;
    }

    function getIndexMax(array $arrNilaiKeanggotaan){
        $idx=0;
        $pertengahan=0;

        for($i=1; $i<count($arrNilaiKeanggotaan); $i++){
            if($arrNilaiKeanggotaan[$i]>$arrNilaiKeanggotaan[$idx]){
                $idx=$i;
            }
            else if($arrNilaiKeanggotaan[$i]==$arrNilaiKeanggotaan[$idx] && $arrNilaiKeanggotaan[$i]!=0){
                $pertengahan=($i-1)+0.5;
            }
        }
        
        if($pertengahan==0){
            return $idx;
        }
        else{
            return $pertengahan;
        }
    }
    
    function hitungNilaiKeanggotaanRaport($x){
        $arrHasil;
        //Dibagi menjadi 4 kategori, cukup, baik, sangat baik, luar biasa
        //kategori cukup
        if($x<=70 && $x <=75){
            $arrHasil[0]=1;
        }
        elseif($x>75 && $x<80){
            $arrHasil[0]=(80-$x)/(80-75);
        }
        else{
            $arrHasil[0]=0;
        }

        //kategori baik
        if($x==80){
            $arrHasil[1]=1;
        }
        elseif($x>80 && $x<85){
            $arrHasil[1]=(85-$x)/(85-80);
        }
        elseif($x>75 && $x<80){
            $arrHasil[1]=($x-75)/(80-75);
        }
        else{
            $arrHasil[1]=0;
        }

        //kategori sangat baik
        if($x==85){
            $arrHasil[2]=1;
        }
        elseif($x>85 && $x<90){
            $arrHasil[2]=(90-$x)/(90-85);
        }
        elseif($x>80 && $x<85){
            $arrHasil[2]=($x-80)/(85-80);
        }
        else{
            $arrHasil[2]=0;
        }
       

        //kategori luar biasa
        if($x>=90){
            $arrHasil[3]=1;
        }
        elseif($x>85 && $x<90){
            $arrHasil[3]=($x-85)/(90-85);
        }
        else{
            $arrHasil[3]=0;
        }



        return $arrHasil;
    }

    function hitungNilaiKeanggotaanPeringkat($x){
        $arrHasil;
        //Dibagi menjadi 4 kategori, cukup, baik, sangat baik, luar biasa
        
        //Kategori cukup
        if($x<=1)
        {
            $arrHasil[0]=1;
        }
        else if($x>1 && $x<250){
            $arrHasil[0]=(250-$x)/(250-1); 
        }
        else{
            $arrHasil[0]=0;
        }


        //Kategori baik
        if($x==250){
            $arrHasil[1]=1;
        }
        else if($x>250 && $x<500){
            $arrHasil[1]=(500-$x)/(500-250);
        }
        else if($x>1 && $x<250){
            $arrHasil[1]=($x-1)/(250-1);
        }
        else{
            $arrHasil[1]=0;
        }
        
        //Kategori sangat baik
        if($x==500){
            $arrHasil[2]=1;
        }
        else if($x>500 && $x<750){
            $arrHasil[2]=(750-$x)/(750-500);
        }
        else if($x>250 && $x<500){
            $arrHasil[2]=($x-250)/(500-250);
        }
        else{
            $arrHasil[2]=0;
        }
        
        //Kategori luar biasa
        if($x>=750){
            $arrHasil[3]= 1;
        }
        else if($x>500 && $x<750){
            $arrHasil[3]= ($x-500)/(750-500);
        }
        else{
            $arrHasil[3]= 0;
        }
        
        return $arrHasil;
    }

    function hitungNilaiKeanggotaanIPK($x){
        $arrHasil;
        //Dibagi menjadi 4 kategori, cukup, baik, sangat baik, luar biasa
        
        //Kategori cukup
        if($x<=2.75)
        {
            $arrHasil[0]=1;
        }
        else if($x>2.75 && $x<3.0){
            $arrHasil[0]=(3.0-$x)/(3.0-2.75); 
        }
        else{
            $arrHasil[0]=0;
        }
        
        
        //Kategori baik
        if($x==3.0){
            $arrHasil[1]=1;
        }
        else if($x>3.0 && $x<3.25){
            $arrHasil[1]=(3.25-$x)/(3.25-3.0);
        }
        else if($x>2.75 && $x<3.0){
            $arrHasil[1]=($x-2.75)/(3.0-2.75);
        }
        else{
            $arrHasil[1]=0;
        }


        //Kategori sangat baik
        if($x==3.25){
            $arrHasil[2]=1;
        }
        else if($x>3.25 && $x<3.5){
            $arrHasil[2]=(3.5-$x)/(3.5-3.25);
        }
        else if($x>3.0 && $x<3.25){
            $arrHasil[2]=($x-3.0)/(3.25-3.0);
        }
        else{
            $arrHasil[2]=0;
        }
        
        
        
        //Kategori luar biasa
        if($x>=3.5){
            $arrHasil[3]= 1;
        }
        else if($x>3.25 && $x<3.5){
            $arrHasil[3]= ($x-3.25)/(3.5-3.25);
        }
        else{
            $arrHasil[3]= 0;
        }
        
        return $arrHasil;
    
    }


    function tentukanKategori():void{
        for($i=0; $i<count($this->hasilKriteria[1]); $i++){
            $skorPeringkat=(1000-$this->hasilKriteria[0][$i]->getSekolah()->getPeringkat()->peringkat_sekolah);
            
            $arrNilai = $this->hitungNilaiKeanggotaanRaport($this->hasilKriteria[1][$i]);
            $arrPeringkat = $this->hitungNilaiKeanggotaanPeringkat($skorPeringkat);
            $arrIpk = $this->hitungNilaiKeanggotaanIPK($this->hasilKriteria[2][$i]);

            $hasil = $this->getIndexMax($arrNilai);


            // CEKK SATU PERSATU HASIL PENGKATEGORIAN !!!
            // dump($arrIpk);
            // dump($this->hasilKriteria[2][$i]);


            for($j=0; $j<3; $j++)
            {
                if($hasil==0){
                    $this->hasilKategori[$i][$j]="C";
                }
                else if($hasil==1){
                    $this->hasilKategori[$i][$j]="B";
                }
                else if($hasil==2){
                    $this->hasilKategori[$i][$j]="SB";
                }
                else if($hasil==3){
                    $this->hasilKategori[$i][$j]="LB";
                }
                else if($hasil==0.5){
                    $this->hasilKategori[$i][$j]="C-B";
                }
                else if($hasil==1.5){
                    $this->hasilKategori[$i][$j]="B-SB";
                }
                else if($hasil==2.5){
                    $this->hasilKategori[$i][$j]="SB-LB";
                }

                if($j==0){
                    $hasil=$this->getIndexMax($arrPeringkat);
                }
                else if($j==1){
                    $hasil=$this->getIndexMax($arrIpk);
                }
                else{
                    $hasil=$this->getIndexMax($arrNilai);
                }
            }


        }
    }

    function getHasilKategori(){
        $this->tentukanKategori();
        return $this->hasilKategori;
    }
}
