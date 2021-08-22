<?php
namespace App\Http\Controllers;
use App\Models\Nilai;
use App\Models\HasilSeleksi;
use App\Models\Mahasiswa;
use App\Models\MataPelajaran;
use App\Models\Siswa;
use App\Models\KKM;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Imports\DataImport;
use App\Imports\DataImport2;
use App\Imports\DataImport3;
use Maatwebsite\Excel\Facades\Excel;
use Alert;

use App\Imports\DataExport;

use Maatwebsite\Excel\Exceptions\NoTypeDetectedException;


class MainController extends Controller
{

    function main(Request $req){
        
        $count_ing=1;
        $count_mat=2;
        $count_id_nilai=(Nilai::select('id_nilai')->first())->id_nilai;

        $jumlah_peminat_PMDK = count(Nilai::select('id_siswa')->get()->toArray())/2;
        $kumpulanPeminatPMDK= array();


        for($i=0; $i<$jumlah_peminat_PMDK; $i++){

            $matpel_ing = MataPelajaran::select('nama_mata_pelajaran')->where('id_mata_pelajaran','=','1')->first();
            $matpel_mat = MataPelajaran::select('nama_mata_pelajaran')->where('id_mata_pelajaran','=','2')->first();

            $noPmb=Nilai::select('id_siswa')->where('id_nilai','=',$count_id_nilai)->first(); 
        
            $nama_sekolah= Siswa::join('sekolah', 'siswa.id_sekolah', '=', 'sekolah.id_sekolah')
            ->select('sekolah.nama_sekolah')->where('siswa.id_siswa','=',$noPmb->id_siswa)->first(); 
            
            $peringkat_sekolah= Siswa::join('sekolah', 'siswa.id_sekolah', '=', 'sekolah.id_sekolah')
            ->select('sekolah.peringkat_sekolah')->where('siswa.id_siswa','=',$noPmb->id_siswa)->first();


            $sma_siswa = new SekolahController($nama_sekolah, $peringkat_sekolah);

            //NILAI MATEMATIKA
            // $x1_mat_kkm=Nilai::select('101_KKM')->where('id_nilai','=',$count_mat)->first();
        //coba
            $siswa_mat= Nilai::select('id_siswa')->where('id_nilai','=',$count_mat)->first();
            $siswa_mat_idsekolah= Siswa::select('id_sekolah')->where('id_siswa','=',$siswa_mat->id_siswa)->first();
            $x1_mat_kkm=KKM::select('101_KKM')->where('id_sekolah','=',$siswa_mat_idsekolah->id_sekolah)->where('id_mata_pelajaran','=','2')->first();
            $x1_mat_kkm=$x1_mat_kkm->{'101_KKM'};
        //
            $x1_mat_p=Nilai::select('101_p')->where('id_nilai','=',$count_mat)->first();
            $x1_mat_t=Nilai::select('101_t')->where('id_nilai','=',$count_mat)->first();

            // $x2_mat_kkm=Nilai::select('102_KKM')->where('id_nilai','=',$count_mat)->first();
            //coba
            $x2_mat_kkm=KKM::select('102_KKM')->where('id_sekolah','=',$siswa_mat_idsekolah->id_sekolah)->where('id_mata_pelajaran','=','2')->first();
            $x2_mat_kkm=$x2_mat_kkm->{'102_KKM'};
            //
            $x2_mat_p=Nilai::select('102_p')->where('id_nilai','=',$count_mat)->first();
            $x2_mat_t=Nilai::select('102_t')->where('id_nilai','=',$count_mat)->first();

            // $xi1_mat_kkm=Nilai::select('111_KKM')->where('id_nilai','=',$count_mat)->first();
            //coba
            $xi1_mat_kkm=KKM::select('111_KKM')->where('id_sekolah','=',$siswa_mat_idsekolah->id_sekolah)->where('id_mata_pelajaran','=','2')->first();
            $xi1_mat_kkm=$xi1_mat_kkm->{'111_KKM'};
            //            
            $xi1_mat_p=Nilai::select('111_p')->where('id_nilai','=',$count_mat)->first();
            $xi1_mat_t=Nilai::select('111_t')->where('id_nilai','=',$count_mat)->first();

            // $xi2_mat_kkm=Nilai::select('112_KKM')->where('id_nilai','=',$count_mat)->first();
            //coba
            $xi2_mat_kkm=KKM::select('112_KKM')->where('id_sekolah','=',$siswa_mat_idsekolah->id_sekolah)->where('id_mata_pelajaran','=','2')->first();
            $xi2_mat_kkm=$xi2_mat_kkm->{'112_KKM'};
            // 
            $xi2_mat_p=Nilai::select('112_p')->where('id_nilai','=',$count_mat)->first();
            $xi2_mat_t=Nilai::select('112_t')->where('id_nilai','=',$count_mat)->first();


            //NILAI B.Inggriss
            // $x1_ing_kkm=Nilai::select('101_KKM')->where('id_nilai','=',$count_ing)->first();
            //coba
            $siswa_ing= Nilai::select('id_siswa')->where('id_nilai','=',$count_ing)->first();
            $siswa_ing_idsekolah= Siswa::select('id_sekolah')->where('id_siswa','=',$siswa_ing->id_siswa)->first();
            $x1_ing_kkm=KKM::select('101_KKM')->where('id_sekolah','=',$siswa_ing_idsekolah->id_sekolah)->where('id_mata_pelajaran','=','1')->first();
            $x1_ing_kkm=$x1_ing_kkm->{'101_KKM'};
            //            
            $x1_ing_p=Nilai::select('101_p')->where('id_nilai','=',$count_ing)->first();
            $x1_ing_t=Nilai::select('101_t')->where('id_nilai','=',$count_ing)->first();

            // $x2_ing_kkm=Nilai::select('102_KKM')->where('id_nilai','=',$count_ing)->first();
            //coba
            $x2_ing_kkm=KKM::select('102_KKM')->where('id_sekolah','=',$siswa_ing_idsekolah->id_sekolah)->where('id_mata_pelajaran','=','1')->first();
            $x2_ing_kkm=$x2_ing_kkm->{'102_KKM'};
            //  
            $x2_ing_p=Nilai::select('102_p')->where('id_nilai','=',$count_ing)->first();
            $x2_ing_t=Nilai::select('102_t')->where('id_nilai','=',$count_ing)->first();

            // $xi1_ing_kkm=Nilai::select('111_KKM')->where('id_nilai','=',$count_ing)->first();
            //coba
            $xi1_ing_kkm=KKM::select('111_KKM')->where('id_sekolah','=',$siswa_ing_idsekolah->id_sekolah)->where('id_mata_pelajaran','=','1')->first();
            $xi1_ing_kkm=$xi1_ing_kkm->{'111_KKM'};
            //              
            $xi1_ing_p=Nilai::select('111_p')->where('id_nilai','=',$count_ing)->first();
            $xi1_ing_t=Nilai::select('111_t')->where('id_nilai','=',$count_ing)->first();

            // $xi2_ing_kkm=Nilai::select('112_KKM')->where('id_nilai','=',$count_ing)->first();
            //coba
            $xi2_ing_kkm=KKM::select('112_KKM')->where('id_sekolah','=',$siswa_ing_idsekolah->id_sekolah)->where('id_mata_pelajaran','=','1')->first();
            $xi2_ing_kkm=$xi2_ing_kkm->{'112_KKM'};
            //            
            $xi2_ing_p=Nilai::select('112_p')->where('id_nilai','=',$count_ing)->first();
            $xi2_ing_t=Nilai::select('112_t')->where('id_nilai','=',$count_ing)->first();



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

            $nama_siswa=Siswa::join('nilai', 'siswa.id_siswa', '=', 'nilai.id_siswa')
            ->select('nama_siswa')->where('id_nilai','=',$count_id_nilai)->first(); 



            $siswa = new SiswaController($noPmb,$nama_siswa,$sma_siswa,$nilai);

            $count_mat+=2;
            $count_ing+=2;
            $count_id_nilai+=2;
            array_push($kumpulanPeminatPMDK,$siswa);                  
        }





        $jumlahMahasiswa = count(Mahasiswa::get()->toArray());
        $kumpulanMahasiswa= array();
        $arrayNpm= Mahasiswa::select('id_mahasiswa')->orderBy('id_mahasiswa','asc')->get()->toArray(); //sebagai index saja untuk menginsert mahasiswa ke array kumpulan mahasiswa

        for($i=0; $i<$jumlahMahasiswa; $i++){
    
            $npm=Mahasiswa::select('id_mahasiswa')->where('id_mahasiswa','=',$arrayNpm[$i])->first();
            $namaMahasiswa=Mahasiswa::select('nama_mahasiswa')->where('id_mahasiswa','=',$arrayNpm[$i])->first();

            $namaSekolahMahasiswa=Mahasiswa::join('sekolah','mahasiswa.id_sekolah','=','sekolah.id_sekolah')->
            select('sekolah.nama_sekolah')->where('mahasiswa.id_mahasiswa','=',$arrayNpm[$i])->first();
            $peringkatSekolah= Mahasiswa::join('sekolah','mahasiswa.id_sekolah','=','sekolah.id_sekolah')->
            select('peringkat_sekolah')->where('id_mahasiswa','=',$arrayNpm[$i])->first();

            $sekolahMahasiswa = new SekolahController($namaSekolahMahasiswa,$peringkat_sekolah);

            $ipk= Mahasiswa::select('IPK')->where('id_mahasiswa','=',$arrayNpm[$i])->first();;

            $mahasiswa = new MahasiswaController($npm, $namaMahasiswa,$sekolahMahasiswa,$ipk);
            array_push($kumpulanMahasiswa,$mahasiswa); 
        }
        $kelasSeleksi = new SeleksiNilaiKkmController($kumpulanPeminatPMDK);
        $hasilSeleksiKkm = $kelasSeleksi->getHasilSeleksiKkm();

        $kelasKriteria = new KriteriaController($hasilSeleksiKkm,$kumpulanMahasiswa);
        $hasilKriteria = $kelasKriteria->getHasilKriteria();

        $kelasFuzzy = new FuzzyController($hasilKriteria);
        $hasilKategori = $kelasFuzzy->getHasilKategori();

        $selectNtp = $req->ntp;
        $selectNti = $req->nti;
        $selectPti = $req->pti;
        $kuotaPmdk = $req->kuota;
        $kelasFuzzyAhp = new FuzzyAhpController($hasilKategori,$selectNtp,$selectNti,$selectPti);
        $cekNilaiNtp = $kelasFuzzyAhp->getNtp();
        $cekNilaiNti = $kelasFuzzyAhp->getNti();
        $cekNilaiPti = $kelasFuzzyAhp->getPti();

        $bobotAwalKriteria = $kelasFuzzyAhp->getBobotAwalkriteria();
    
        // Hitung CR kriteria
        $CR = $kelasFuzzyAhp->hitungConsistencyRatio($bobotAwalKriteria);
        // dump($CR);
        if($CR<=0.1){
            Alert::success('Berhasil','Lihat hasil seleksi');
            $bobotPrioritasAntarKriteria = $kelasFuzzyAhp->hitungBobotPrioritasAntarKriteria();
            //Cek hasil kategori
            $hasilKategoriAlternatif = $kelasFuzzyAhp->getHasilKategori();
        
            $bobotPrioAltNilaiRaport = $kelasFuzzyAhp->hitungBobotPrioritasAntarAlternatif(0);
            $bobotPrioAltPeringkatSekolah = $kelasFuzzyAhp->hitungBobotPrioritasAntarAlternatif(1);
            $bobotPrioAltfIpk = $kelasFuzzyAhp->hitungBobotPrioritasAntarAlternatif(2);
            $hasilPemeringkatan= $kelasFuzzyAhp->hasilPemeringkatan($bobotPrioritasAntarKriteria,
                                                                $bobotPrioAltNilaiRaport,
                                                                $bobotPrioAltPeringkatSekolah,
                                                                $bobotPrioAltfIpk);
            $hasilPMDK;
            for($i=0; $i<count($hasilPemeringkatan); $i++){
                $hasilPMDK[$i][0]=$hasilKriteria[0][$hasilPemeringkatan[$i][0]];    // data siswa
                $hasilPMDK[$i][1]=number_format($hasilKriteria[1][$hasilPemeringkatan[$i][0]],3);    // rata-rata nilai akhir
                $hasilPMDK[$i][2]=number_format($hasilKriteria[2][$hasilPemeringkatan[$i][0]],2);    // rata-rata ipk alumni
                $hasilPMDK[$i][3]=number_format($hasilPemeringkatan[$i][1],6);
            }

                        
        
        // dump($kumpulanPeminatPMDK);
        // dump($hasilSeleksiKkm);
        // for ($i=0; $i<count($kumpulanPeminatPMDK); $i++){
        //     echo $kumpulanPeminatPMDK[$i]->getNamaSiswa();
        //     echo '<br>';
        //     echo 'B.Inggriss:';
        //     echo '<br>';
        //     echo $kumpulanPeminatPMDK[$i]->getNilai()[0]->getX1_KKM();
        //     echo '<br>';
        //     echo $kumpulanPeminatPMDK[$i]->getNilai()[0]->getX1_p(); 
        //     echo '<br>';
        //     echo $kumpulanPeminatPMDK[$i]->getNilai()[0]->getX1_t(); 
        //     echo '<br>';
        //     echo '<br>';
        //     echo $kumpulanPeminatPMDK[$i]->getNilai()[0]->getX2_KKM();
        //     echo '<br>';
        //     echo $kumpulanPeminatPMDK[$i]->getNilai()[0]->getX2_p(); 
        //     echo '<br>';
        //     echo $kumpulanPeminatPMDK[$i]->getNilai()[0]->getX2_t(); 
        //     echo '<br>';
        //     echo '<br>';
        //     echo $kumpulanPeminatPMDK[$i]->getNilai()[0]->getXI1_KKM();
        //     echo '<br>';
        //     echo $kumpulanPeminatPMDK[$i]->getNilai()[0]->getXI1_p(); 
        //     echo '<br>';
        //     echo $kumpulanPeminatPMDK[$i]->getNilai()[0]->getXI1_t(); 
        //     echo '<br>';
        //     echo '<br>';
        //     echo $kumpulanPeminatPMDK[$i]->getNilai()[0]->getXI2_KKM();
        //     echo '<br>';
        //     echo $kumpulanPeminatPMDK[$i]->getNilai()[0]->getXI2_p(); 
        //     echo '<br>';
        //     echo $kumpulanPeminatPMDK[$i]->getNilai()[0]->getXI2_t(); 
        //     echo '<br>';
        //     echo '<br>';
        //     echo 'Matematika:';
        //     echo '<br>';
        //     echo $kumpulanPeminatPMDK[$i]->getNilai()[1]->getX1_KKM();
        //     echo '<br>';
        //     echo $kumpulanPeminatPMDK[$i]->getNilai()[1]->getX1_p(); 
        //     echo '<br>';
        //     echo $kumpulanPeminatPMDK[$i]->getNilai()[1]->getX1_t(); 
        //     echo '<br>';
        //     echo '<br>';
        //     echo $kumpulanPeminatPMDK[$i]->getNilai()[1]->getX2_KKM();
        //     echo '<br>';
        //     echo $kumpulanPeminatPMDK[$i]->getNilai()[1]->getX2_p(); 
        //     echo '<br>';
        //     echo $kumpulanPeminatPMDK[$i]->getNilai()[1]->getX2_t(); 
        //     echo '<br>';
        //     echo '<br>';
        //     echo $kumpulanPeminatPMDK[$i]->getNilai()[1]->getXI1_KKM();
        //     echo '<br>';
        //     echo $kumpulanPeminatPMDK[$i]->getNilai()[1]->getXI1_p(); 
        //     echo '<br>';
        //     echo $kumpulanPeminatPMDK[$i]->getNilai()[1]->getXI1_t(); 
        //     echo '<br>';
        //     echo '<br>';
        //     echo $kumpulanPeminatPMDK[$i]->getNilai()[1]->getXI2_KKM();
        //     echo '<br>';
        //     echo $kumpulanPeminatPMDK[$i]->getNilai()[1]->getXI2_p(); 
        //     echo '<br>';
        //     echo $kumpulanPeminatPMDK[$i]->getNilai()[1]->getXI2_t(); 
        //     echo '<br>';
        //     echo '<br>';
        //     echo '<br>';
        // }

        // dump($kumpulanMahasiswa);
        // dump($hasilKriteria);
        // dump($hasilKategori);

        
        // dump($cekNilaiNtp);
        // dump($cekNilaiNti);
        // dump($cekNilaiPti);
        // dump($bobotAwalKriteria);
        // //LIHAT HASIL PERHITUNG BOBOT AWAL KRITERIA
        // for($i=0; $i<3; $i++){
        //     for($j=0; $j<3; $j++){
        //         echo number_format($bobotAwalKriteria[$i][$j],1). " ";
        //     }
        //     echo '<br>';
        // }

        // dump($CR);
        // dump($bobotPrioritasAntarKriteria);

        // dump($hasilKategoriAlternatif);

        // $bobotAwalAlternatifRaport = $kelasFuzzyAhp->getBobotAwalAlternatif(0);

        //     for($i=0; $i<count($hasilKategoriAlternatif); $i++){
        //         for($j=0; $j<count($hasilKategoriAlternatif); $j++){
        //             echo number_format($bobotAwalAlternatifRaport[$i][$j],1). " ";
        //         }
        //         echo '<br>';
        //     }

        //     echo '<br>';

        // $tfnAlternatifRaport= $kelasFuzzyAhp->getTfnAlternatif(0);
            // for($i=0; $i<count($hasilKategoriAlternatif); $i++){
            //     for($j=0; $j<count($hasilKategoriAlternatif); $j++){
            //         echo number_format($tfnAlternatifRaport[$i][$j],1). " ";
            //     }
            //     echo '<br>';
            // }

            // dump($bobotPrioAltNilaiRaport);
            // dump($bobotPrioAltPeringkatSekolah);
            // dump($bobotPrioAltfIpk);
            
            // dump($hasilSeleksiKkm);
            // dump($hasilPemeringkatan);

            
           HasilSeleksi::truncate();
           
           if($kuotaPmdk<=count($hasilSeleksiKkm)){

                for($i=0; $i<$kuotaPmdk; $i++){

                    DB::insert('insert into hasil_seleksi(no_pmb,nama,asal_sekolah,peringkat_sekolah,rata_rata_nilai,rata_rata_ipk,bobot_akhir) 
                    values (?,?,?,?,?,?,?)', 
                    [$hasilPMDK[$i][0]->getNoPmb()->id_siswa,
                    $hasilPMDK[$i][0]->getNamaSiswa()->nama_siswa, 
                    $hasilPMDK[$i][0]->getSekolah()->getNamaSekolah()->nama_sekolah, 
                    $hasilPMDK[$i][0]->getSekolah()->getPeringkat()->peringkat_sekolah,
                    $hasilPMDK[$i][1],$hasilPMDK[$i][2],$hasilPMDK[$i][3]]);
                }                 
           }
           else{
                for($i=0; $i<count($hasilSeleksiKkm); $i++){

                    DB::insert('insert into hasil_seleksi(no_pmb,nama,asal_sekolah,peringkat_sekolah,rata_rata_nilai,rata_rata_ipk,bobot_akhir) 
                    values (?,?,?,?,?,?,?)', 
                    [$hasilPMDK[$i][0]->getNoPmb()->id_siswa,
                    $hasilPMDK[$i][0]->getNamaSiswa()->nama_siswa, 
                    $hasilPMDK[$i][0]->getSekolah()->getNamaSekolah()->nama_sekolah,
                    $hasilPMDK[$i][0]->getSekolah()->getPeringkat()->peringkat_sekolah,
                    $hasilPMDK[$i][1],$hasilPMDK[$i][2],$hasilPMDK[$i][3]]);
                }
           }

           $data=HasilSeleksi::all(); 
           return view('halamanHasilSeleksi',['hasilPMDK'=>$data,'kuotaPMDK'=>$kuotaPmdk,
            'jumlahPeminat'=>$jumlah_peminat_PMDK,'jumlahLolosKKM'=>count($hasilSeleksiKkm)]);

        }
        else{
            Alert::error('Penilaian salah','Silakan ulangi penilaian');
            return back();
        }
    }

    public function importData() 
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Nilai::truncate();
        Siswa::truncate();
        KKM::truncate();
        try {
            Excel::import(new DataImport,request()->file('file'));
        } catch (NoTypeDetectedException $e) {
            Alert::warning('Import gagal','Silakan gunakan file yang sesuai');
            return back();
        }
        Excel::import(new DataImport2,request()->file('file'));
    
        Excel::import(new DataImport3,request()->file('file'));
        return back();
     
    }

    //MENAMPILKAN DATA PEMINAT PMDK DI HALAMAN UTAMA
    function showDataPeminat(){
        $jumlahNilai = count(Nilai::all());

        //Proses menyensor nama siswa
        // $isiNilai = count(Nilai::select('id_nilai')->get()->toArray());
        // if($isiNilai>0){
        //     $noPmb= DB::table('siswa')->select('id_siswa')->get()->toArray();
        //     sort($noPmb);
        //     for($i=0; $i<count($noPmb); $i++){
        //         Siswa::where('id_siswa',$noPmb[$i]->id_siswa)->update(['nama_siswa'=>'siswa_'.($i+1)]);
        //     }
        // }
        
        $data=Nilai::join('siswa','nilai.id_siswa','=','siswa.id_siswa')->paginate(14);

        return view('halamanUtama',['nilais'=>$data,'jumlahNilai'=>$jumlahNilai]);

    }

    public function pindahHalamanLogin(){
        return view('halamanLogin');
    }

    public function pindahHalamanImport(){
        return view('halamanUtama');
    }

    public function pindahHalamanPenentuanBobot(){
        $dataNilai = count(Nilai::select('id_nilai')->get()->toArray());

        if($dataNilai>0){
            return view('halamanPenentuanBobotDanKuota');
        }
        else{
            Alert::error('Data nilai masih kosong','Silakan import data terlebih dahulu');
            return back();
        }
      
    }

    public function pindahHalamanHasilSeleksi(){
        return view('halamanHasilSeleksi');
    }




    public function login(Request $request) 
    {   
        $userName = $request->username;
        $pass = $request->password;

        $cekUser=count(DB::table('pengguna')->select('userName')->where('userName','=',$userName)->get()->toArray());

        if($cekUser==1){
            $cekPass=DB::table('pengguna')->select('password')->where('username','=',$userName)->first();

            if($pass == $cekPass->password){
                return redirect()->intended('halamanUtama'); 
            }
            else{
                Alert::error('Login gagal','password yang dimasukkan salah!');
                return back();
            }

        }
        else{
            Alert::warning('Login gagal','username tidak terdaftar pada sistem!');
            return back();
        }

    }
    

    public function exportData() 
    {
        return Excel::download(new DataExport, 'hasilSeleksiPMDK.xlsx');
    }



}
