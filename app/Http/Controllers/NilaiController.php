<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Nilai;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class NilaiController extends Controller
{

    private $matpel;

    private $X1_p;
    private $X1_t;

    private $X2_p;
    private $X2_t;

    private $XI1_p;
    private $XI1_t;

    private $XI2_p;
    private $XI2_t;

    private $X1_kkm;
    private $X2_kkm;
    private $XI1_kkm;
    private $XI2_kkm;


    function __construct($matpel='',$X1_kkm='', $X1_p='', $X1_t='', 
                            $X2_kkm='', $X2_p='', $X2_t='', 
                            $XI1_kkm='', $XI1_p='',$XI1_t='',
                            $XI2_kkm='', $XI2_p='',$XI2_t=''){

        $this->matpel = $matpel;

        $this->X1_kkm = $X1_kkm;
        $this->X1_p = $X1_p;
        $this->X1_t = $X1_t;

        $this->X2_kkm = $X2_kkm;
        $this->X2_p = $X2_p;
        $this->X2_t = $X2_t;
        
        $this->XI1_kkm = $XI1_kkm;
        $this->XI1_p = $XI1_p;
        $this->XI1_t = $XI1_t;

        $this->XI2_kkm = $XI2_kkm;
        $this->XI2_p = $XI2_p;
        $this->XI2_t = $XI2_t;
    }


    function getMatpel() : MataPelajaranController{
        return $this->matpel;
    }

    function getRataRata() : Double{
        return $this->rataRata;
    }

    function getX1_kkm() {
        return $this->X1_kkm;
    }

    function getX2_kkm() {
        return $this->X2_kkm;
    }

    function getXI1_kkm() {
        return $this->XI1_kkm;
    }

    function getXI2_kkm() {
        return $this->XI2_kkm;
    }



    function getX1_p() {
        return $this->X1_p;
    }

    function getX1_t() {
        return $this->X1_t;
    }

    function getX2_p(){
        return $this->X2_p;
    }

    function getX2_t(){
        return $this->X2_t;
    }

    function getXI1_p(){
        return $this->XI1_p;
    }

    function getXI1_t(){
        return $this->XI1_t;
    }

    function getXI2_p() {
        return $this->XI2_p;
    }

    function getXI2_t() {
        return $this->XI2_t;
    }


    function hitungRataRata(){
        $total=0;
        $total =$this->X1_p->{'101_p'} + $this->X1_t->{'101_t'} + 
                $this->X2_p->{'102_p'} + $this->X2_t->{'102_t'} + 
                $this->XI1_p->{'111_p'}+ $this->XI1_t->{'111_t'}+
                $this->XI2_p->{'112_p'}+ $this->XI2_t->{'112_t'};

        $total = $total/8;
        return $total;
    }

    function print(){
        
        $kumpulanPeminatPMDK= array();

        $count_ing=1;
        $count_mat=2;

        $count_id_sekolah=1;

        $count_id_nilai=2;
        $jumlah_peminat_PMDK = count(DB::table('siswa')->select('id_siswa')->get()->toArray());






        for($i=0; $i<$jumlah_peminat_PMDK; $i++){
            


            $matpel_ing = DB::table('mata_pelajaran')->select('nama_mata_pelajaran')->where('id_mata_pelajaran','=','1')->first();
            $matpel_mat = DB::table('mata_pelajaran')->select('nama_mata_pelajaran')->where('id_mata_pelajaran','=','2')->first();
            



            $noPmb=DB::table('nilai')->select('id_siswa')->where('id_nilai','=',$count_id_nilai)->first(); 
           
            $nama_sekolah= DB::table('siswa')->join('sekolah', 'siswa.id_sekolah', '=', 'sekolah.id_sekolah')
            ->select('sekolah.nama_sekolah')->where('siswa.id_siswa','=',$noPmb->id_siswa)->first(); 
            
            $peringkat_sekolah= DB::table('siswa')->join('sekolah', 'siswa.id_sekolah', '=', 'sekolah.id_sekolah')
            ->select('sekolah.peringkat_sekolah')->where('siswa.id_siswa','=',$noPmb->id_siswa)->first();



            $sma_siswa = new SekolahController($nama_sekolah, $peringkat_sekolah);

            //NILAI MATEMATIKA
            $x1_mat_kkm=DB::table('nilai')->select('101_KKM')->where('id_nilai','=',$count_mat)->first();
            $x1_mat_p=DB::table('nilai')->select('101_p')->where('id_nilai','=',$count_mat)->first();
            $x1_mat_t=DB::table('nilai')->select('101_t')->where('id_nilai','=',$count_mat)->first();

            $x2_mat_kkm=DB::table('nilai')->select('102_KKM')->where('id_nilai','=',$count_mat)->first();
            $x2_mat_p=DB::table('nilai')->select('102_p')->where('id_nilai','=',$count_mat)->first();
            $x2_mat_t=DB::table('nilai')->select('102_t')->where('id_nilai','=',$count_mat)->first();

            $xi1_mat_kkm=DB::table('nilai')->select('111_KKM')->where('id_nilai','=',$count_mat)->first();
            $xi1_mat_p=DB::table('nilai')->select('111_p')->where('id_nilai','=',$count_mat)->first();
            $xi1_mat_t=DB::table('nilai')->select('111_t')->where('id_nilai','=',$count_mat)->first();

            $xi2_mat_kkm=DB::table('nilai')->select('112_KKM')->where('id_nilai','=',$count_mat)->first();
            $xi2_mat_p=DB::table('nilai')->select('112_p')->where('id_nilai','=',$count_mat)->first();
            $xi2_mat_t=DB::table('nilai')->select('112_t')->where('id_nilai','=',$count_mat)->first();


            //NILAI B.Inggriss
            $x1_ing_kkm=DB::table('nilai')->select('101_KKM')->where('id_nilai','=',$count_ing)->first();
            $x1_ing_p=DB::table('nilai')->select('101_p')->where('id_nilai','=',$count_ing)->first();
            $x1_ing_t=DB::table('nilai')->select('101_t')->where('id_nilai','=',$count_ing)->first();

            $x2_ing_kkm=DB::table('nilai')->select('102_KKM')->where('id_nilai','=',$count_ing)->first();
            $x2_ing_p=DB::table('nilai')->select('102_p')->where('id_nilai','=',$count_ing)->first();
            $x2_ing_t=DB::table('nilai')->select('102_t')->where('id_nilai','=',$count_ing)->first();

            $xi1_ing_kkm=DB::table('nilai')->select('111_KKM')->where('id_nilai','=',$count_ing)->first();
            $xi1_ing_p=DB::table('nilai')->select('111_p')->where('id_nilai','=',$count_ing)->first();
            $xi1_ing_t=DB::table('nilai')->select('111_t')->where('id_nilai','=',$count_ing)->first();

            $xi2_ing_kkm=DB::table('nilai')->select('112_KKM')->where('id_nilai','=',$count_ing)->first();
            $xi2_ing_p=DB::table('nilai')->select('112_p')->where('id_nilai','=',$count_ing)->first();
            $xi2_ing_t=DB::table('nilai')->select('112_t')->where('id_nilai','=',$count_ing)->first();


            
             //Nilai b.inggris siswa
             $siswa_ing = new NilaiController($matpel_ing,$x1_ing_kkm,$x1_ing_p,$x1_ing_t ,
             $x2_ing_kkm,$x2_ing_p,$x2_ing_t,
             $xi1_ing_kkm,$xi1_ing_p,$xi1_ing_t,
             $xi2_ing_kkm,$xi2_ing_p,$xi2_ing_t);

            //Nilai mat siswa
            $siswa_mat = new NilaiController($matpel_mat,$x1_mat_kkm,$x1_mat_p,$x1_mat_t ,
                                            $x2_mat_kkm,$x2_mat_p,$x2_mat_t,
                                            $xi1_mat_kkm,$xi1_mat_p,$xi1_mat_t,
                                            $xi2_mat_kkm,$xi2_mat_p,$xi2_mat_t);

            //nilai kedua matpel siswa
            $nilai=array($siswa_ing,$siswa_mat);

            
            $nama_siswa=DB::table('siswa')->join('nilai', 'siswa.id_siswa', '=', 'nilai.id_siswa')
            ->select('nama_siswa')->where('id_nilai','=',$count_id_nilai)->first(); 

            $siswa = new SiswaController($noPmb,$nama_siswa,$sma_siswa,$nilai);



            $count_mat+=2;
            $count_ing+=2;
            $count_id_nilai+=2;
            array_push($kumpulanPeminatPMDK,$siswa);

                           
        }



        // PRINT PARA PENDAFTAR PMDK
        // for($i=0; $i<count($kumpulanPeminatPMDK); $i++){
        //     echo 'No.Pmb: '. $kumpulanPeminatPMDK[$i]->getNoPmb()->id_siswa. '<br>';
        //     echo 'Nama: '. $kumpulanPeminatPMDK[$i]->getNamaSiswa()->nama_siswa . '<br>';
        //     echo 'Sekolah: '. $kumpulanPeminatPMDK[$i]->getSekolah()->getNamaSekolah()->nama_sekolah;
        //     echo '<br>';
        //     echo '<br>';
        //     echo '<br>';
        // }
        // echo count($kumpulanPeminatPMDK);

        
        
        
        //PRINT HASIL SELEKSI KKM PENDAFTAR PMDK
        $kelasSeleksi = new SeleksiNilaiKkmController($kumpulanPeminatPMDK);
        $hasilSeleksiKkm = $kelasSeleksi->getHasilSeleksiKkm();

        // for($i=0; $i<count($hasilSeleksiKkm); $i++){
        //     echo 'Nama: '. $hasilSeleksiKkm[$i]->getNamaSiswa()->nama_siswa . '<br>';
        //     echo 'Sekolah: '.$hasilSeleksiKkm[$i]->getSekolah()->getNamaSekolah()->nama_sekolah;
        //     echo '<br>';
        //     echo 'Avg_Ing: '.$hasilSeleksiKkm[$i]->getNilai()[0]->hitungRataRata();
        //     echo '<br>';
        //     echo 'Avg_Mat: '.$hasilSeleksiKkm[$i]->getNilai()[1]->hitungRataRata();
        //     echo '<br>';
        //     echo '<br>';
        // }
        // echo count($hasilSeleksiKkm);

        // dump($hasilSeleksiKkm);

        $kelasKriteria = new KriteriaController($hasilSeleksiKkm);

        $namaPeminat= $kelasKriteria->getNamaPeminat();
        $rataRataAkhir= $kelasKriteria->hitungRataRataNilaiAkhir();


        for($i=0; $i<count($hasilSeleksiKkm); $i++){
            echo 'Nama: '. $namaPeminat[$i]->nama_siswa . '<br>';
            echo 'Nilai Akhir: '.$rataRataAkhir[$i];
            echo '<br>';

            echo '<br>';
        }
        












        
    }


















    //MENAMPILKAN DATA PMDK DI HALAMAN UTAMA
    function show(){
        $data=Nilai::paginate(10);
        return view('halamanUtama',['nilais'=>$data]);
    }



}
