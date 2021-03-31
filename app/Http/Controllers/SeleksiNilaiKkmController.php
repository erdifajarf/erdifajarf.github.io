<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeleksiNilaiKkmController extends Controller
{
    //
    private $peminatPmdk;
    private $hasilSeleksiPeminat;

    public function __construct($peminatPMDK){
        $this->peminatPmdk=$peminatPMDK;
    }


    public function getHasilSeleksiKkm(){

        //$jumlahLolos untuk menghitung jumlah siswa yang lolos pada seleksi KKM
        //$idx merupakan array untuk menandai siswa yang lolos KKM pada array of peminat, bila index adalah 1,
        //maka siswa lolos kkm, bila -1, maka siswa tidak lolos KKm
    
        $jumlahLolos=0;
        $idx=array(count($this->peminatPmdk));

        for ($i=0; $i<count($this->peminatPmdk); $i++){
            

            // Peminat PMDK ke-i dari array siswa,
            // Mengecek nilai praktek dan teori pada tiap semester, berdasarkan KKM tiap semesternya
            // Nilai diambil menggunakan getter pada kelas nilai, kelas nilai ini menjadi atribut pada kelas siswa.

                
            $cekLolos=false;
            

            for($j=0; $j<2; $j++){

                if($this->peminatPmdk[$i]->getNilai()[$j]->getX1_p()->{'101_p'}  >= $this->peminatPmdk[$i]->getNilai()[$j]->getX1_kkm()->{'101_KKM'} &&
                    $this->peminatPmdk[$i]->getNilai()[$j]->getX1_t()->{'101_t'}  >= $this->peminatPmdk[$i]->getNilai()[$j]->getX1_kkm()->{'101_KKM'} &&

                    $this->peminatPmdk[$i]->getNilai()[$j]->getX2_p()->{'102_p'}  >= $this->peminatPmdk[$i]->getNilai()[$j]->getX2_kkm()->{'102_KKM'} &&
                    $this->peminatPmdk[$i]->getNilai()[$j]->getX2_t()->{'102_t'} >= $this->peminatPmdk[$i]->getNilai()[$j]->getX2_kkm()->{'102_KKM'} &&
                        
                    $this->peminatPmdk[$i]->getNilai()[$j]->getXI1_p()->{'111_p'}  >= $this->peminatPmdk[$i]->getNilai()[$j]->getXI1_kkm()->{'111_KKM'} &&
                    $this->peminatPmdk[$i]->getNilai()[$j]->getXI1_t()->{'111_t'} >= $this->peminatPmdk[$i]->getNilai()[$j]->getXI1_kkm()->{'111_KKM'} &&
                        
                    $this->peminatPmdk[$i]->getNilai()[$j]->getXI2_p()->{'112_p'}  >= $this->peminatPmdk[$i]->getNilai()[$j]->getXI2_kkm()->{'112_KKM'} &&
                    $this->peminatPmdk[$i]->getNilai()[$j]->getXI2_t()->{'112_t'}  >= $this->peminatPmdk[$i]->getNilai()[$j]->getXI2_kkm()->{'112_KKM'}) {

                    $cekLolos = true;
                }
                        
                else {
                    $cekLolos = false;
                    $break;
                }

            }

                            
                if($cekLolos==true){
                    $jumlahLolos++;
                    $idx[$i]=$i;
                }
                else{
                    $idx[$i]=-1;
                }
                   
            

        }

        //Deklarasi ukuran array hasil seleksi menggunakan variabel jumlah lolos
        //$mark adalah index untuk mengisi array hasilSeleksi tersebut berdasarkan array $idx

        $this->hasilSeleksiPeminat= array($jumlahLolos);
        $mark=0;

        for ($i=0; $i<count($this->peminatPmdk); $i++){
            if($idx[$i]!=-1){
                $this->hasilSeleksiPeminat[$mark]=$this->peminatPmdk[$idx[$i]];
                $mark+=1;
            }
        }

        return $this->hasilSeleksiPeminat;
    } 
}
