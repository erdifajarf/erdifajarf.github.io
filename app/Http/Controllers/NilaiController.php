<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Nilai;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class NilaiController extends Controller
{

    private $matpel;
    private $X1;
    private $X2;
    private $XI1;
    private $XI2;
    private $rataRata;

    function __construct($matpel='', $X1='', $X2='', $XI1='', $XI2=''){
        $this->matpel = $matpel;
        // $this->siswa = $siswa;
        $this->X1 = $X1;
        $this->X2 = $X2;
        $this->XI1 = $XI1;
        $this->XI2 = $XI2;
    }


    function getMatpel() : MataPelajaranController{
        return $this->matpel;
    }

    function getRataRata() : Double{
        return $this->rataRata;
    }

    function getX1() {
        return $this->X1;
    }

    function getX2(){
        return $this->X2;
    }

    function getXI1(){
        return $this->XI1;
    }

    function getXI2() {
        return $this->XI2;
    }

    function print(){
        
        $kumpulanPeminatPMDK= array();

        $count_mat=1;
        $count_ing=2;
        $count_id_sekolah=1;

        $jumlah_peminat_PMDK = count(DB::table('siswa')->select('id_siswa')->get()->toArray());

        for($i=0; $i<$jumlah_peminat_PMDK; $i++){
        

            $matpel_mat = DB::table('mata_pelajaran')->select('nama_mata_pelajaran')->where('id_mata_pelajaran','=','1')->first();
            $matpel_ing = DB::table('mata_pelajaran')->select('nama_mata_pelajaran')->where('id_mata_pelajaran','=','2')->first();
            

            $nama_sekolah= DB::table('sekolah')->select('nama_sekolah')->where('id_sekolah','=',$count_id_sekolah)->first();
            $sma_siswa = new SekolahController($nama_sekolah, '1');

            $x1_mat=DB::table('nilai')->select('101')->where('id_nilai','=',$count_mat)->first();
            $x2_mat=DB::table('nilai')->select('102')->where('id_nilai','=',$count_mat)->first();
            $xi1_mat=DB::table('nilai')->select('111')->where('id_nilai','=',$count_mat)->first();
            $xi2_mat=DB::table('nilai')->select('112')->where('id_nilai','=',$count_mat)->first();

            
            $x1_ing=DB::table('nilai')->select('101')->where('id_nilai','=',$count_ing)->first();
            $x2_ing=DB::table('nilai')->select('102')->where('id_nilai','=',$count_ing)->first();
            $xi1_ing=DB::table('nilai')->select('111')->where('id_nilai','=',$count_ing)->first();
            $xi2_ing=DB::table('nilai')->select('112')->where('id_nilai','=',$count_ing)->first();
        
            $siswa_mat = new NilaiController($matpel_mat,$x1_mat,$x2_mat,$xi1_mat,$xi2_mat);
            $siswa_ing = new NilaiController($matpel_ing,$x1_ing,$x2_ing,$xi1_ing,$xi2_ing);

            $nl_siswa_mat = array($siswa_mat->getX1(),$siswa_mat->getX2(),$siswa_mat->getXI1(),$siswa_mat->getXI2());
            $nl_siswa_ing = array($siswa_ing->getX1(), $siswa_ing->getX2(), $siswa_ing->getXI1(), $siswa_ing->getXI2());
        
            $nama_siswa=DB::table('siswa')->select('nama_siswa')->where('id_siswa','=',$i+1)->first(); 
            $siswa = new SiswaController($nama_siswa,$sma_siswa,$nl_siswa_mat,$nl_siswa_ing);

            $count_mat+=2;
            $count_ing+=2;
            $count_id_sekolah+=1;
            

            array_push($kumpulanPeminatPMDK,$siswa);

               
        }

        // dump($nl_siswa_mat);


        for($i=0; $i<count($kumpulanPeminatPMDK); $i++){
            echo 'Nama: '. $kumpulanPeminatPMDK[$i]->getNamaSiswa() . '<br>';
            // echo serialize($kumpulanPeminatPMDK[$i]->getNilaiMat()[0]). '<br>';
            // echo serialize($kumpulanPeminatPMDK[$i]->getNilaiMat()[1]). '<br>';
            // echo serialize($kumpulanPeminatPMDK[$i]->getNilaiMat()[2]). '<br>';
            // echo serialize($kumpulanPeminatPMDK[$i]->getNilaiMat()[3]). '<br>';

            echo 'mat: '. $kumpulanPeminatPMDK[$i]->hitungRataRata($kumpulanPeminatPMDK[$i]->getNilaiMat());
            echo '<br>';
            echo 'ing: ' . $kumpulanPeminatPMDK[$i]->hitungRataRata($kumpulanPeminatPMDK[$i]->getNilaiIng());

            echo '<br>';
            echo '<br>';
        }
        
    }



    //MENAMPILKAN DATA PMDK DI HALAMAN UTAMA
    function show(){
        $data=Nilai::paginate(10);
        return view('halamanUtama',['nilais'=>$data]);
    }




    // public function print(){
    //     $dataMat=DB::table('nilai')->select('id_nilai')->where('101','=','82')->get();

    //     $data=$dataMat->toArray();

    //     foreach($data as $isi){
    //         echo $isi->id_nilai.'<br>';
    //     }
    // }

    
    //HITUNG RATA RATA NILAI
    // public function print(){
    //     $dataMat=DB::table('nilai')->select('id_siswa','101','102','111','112')->where('id_mata_pelajaran','=','1')->get()->toArray();
    //     $dataIng=DB::table('nilai')->select('id_siswa','101','102','111','112')->where('id_mata_pelajaran','=','2')->get()->toArray();
            

    //     foreach($dataMat as $isi){
    //         $rataRata=0;
    //         $rataRata=($isi->{'101'} + $isi->{'102'}+ $isi->{'111'}+ $isi->{'112'})/4;
    //         echo $rataRata. '<br>';
    //     }

    //     foreach($dataIng as $isi){
    //         $rataRata=0;
    //         $rataRata=($isi->{'101'} + $isi->{'102'}+ $isi->{'111'}+ $isi->{'112'})/4;
    //         echo $rataRata. '<br>';
    //     }
    // }


}
