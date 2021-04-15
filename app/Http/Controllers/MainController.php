<?php

namespace App\Http\Controllers;
use App\Models\Nilai;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Imports\DataImport;
use Maatwebsite\Excel\Facades\Excel;
use Alert;


class MainController extends Controller
{

    function main(Request $req){
        
        $count_ing=1;
        $count_mat=2;
        // $count_id_sekolah=1;
        $count_id_nilai=2;
        $jumlah_peminat_PMDK = count(DB::table('siswa')->select('id_siswa')->get()->toArray());
        $kumpulanPeminatPMDK= array();


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



        $jumlahMahasiswa = count(DB::table('mahasiswa')->get()->toArray());
        $kumpulanMahasiswa= array();
        $arrayNpm= DB::table('mahasiswa')->select('id_mahasiswa')->orderBy('id_mahasiswa','asc')->get()->toArray(); //sebagai index saja untuk menginsert mahasiswa ke array kumpulan mahasiswa

        for($i=0; $i<$jumlahMahasiswa; $i++){
    
            $npm=DB::table('mahasiswa')->select('id_mahasiswa')->where('id_mahasiswa','=',$arrayNpm[$i]->id_mahasiswa)->first();
            $namaMahasiswa=DB::table('mahasiswa')->select('nama_mahasiswa')->where('id_mahasiswa','=',$arrayNpm[$i]->id_mahasiswa)->first();

            $namaSekolahMahasiswa=DB::table('mahasiswa')->join('sekolah','mahasiswa.id_sekolah','=','sekolah.id_sekolah')->
            select('sekolah.nama_sekolah')->where('mahasiswa.id_mahasiswa','=',$arrayNpm[$i]->id_mahasiswa)->first();
            $peringkatSekolah= DB::table('mahasiswa')->join('sekolah','mahasiswa.id_sekolah','=','sekolah.id_sekolah')->
            select('peringkat_sekolah')->where('id_mahasiswa','=',$arrayNpm[$i]->id_mahasiswa)->first();

            $sekolahMahasiswa = new SekolahController($namaSekolahMahasiswa,$peringkat_sekolah);

            $ipk= DB::table('mahasiswa')->select('IPK')->where('id_mahasiswa','=',$arrayNpm[$i]->id_mahasiswa)->first();;

            $mahasiswa = new MahasiswaController($npm, $namaMahasiswa,$sekolahMahasiswa,$ipk);
            array_push($kumpulanMahasiswa,$mahasiswa); 
        }

        // dump($kumpulanMahasiswa);


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




        $kelasKriteria = new KriteriaController($hasilSeleksiKkm,$kumpulanMahasiswa);
        $hasilKriteria = $kelasKriteria->getHasilKriteria();
        

        dump($hasilKriteria);

        // for($i=0; $i<count($hasilKriteria[0]); $i++){
        //     echo $i+1;
        //     echo '<br>';
        //     echo 'Nama: '. $hasilKriteria[0][$i]->getNamaSiswa()->nama_siswa . '<br>';
        //     echo '<br>';
        //     echo 'Nilai Akhir: '. $hasilKriteria[1][$i] . '<br>';
        //     echo '<br>';
        //     echo 'IPK Alumni: '. $hasilKriteria[2][$i] . '<br>';
        //     echo '<br>';
        //     echo '<br>';
        // }
        

        $kelasFuzzy = new FuzzyController($hasilKriteria);
        $hasilKategori = $kelasFuzzy->getHasilKategori();

        // dump($hasilKategori);


        $selectNtp = $req->ntp;
        $selectNti = $req->nti;
        $selectPti = $req->pti;
        $kuotaPmdk = $req->kuota;
        $kelasFuzzyAhp = new FuzzyAhpController($hasilKategori,$selectNtp,$selectNti,$selectPti);
        $cekNilaiNtp = $kelasFuzzyAhp->getNtp();
        $cekNilaiNti = $kelasFuzzyAhp->getNti();
        $cekNilaiPti = $kelasFuzzyAhp->getPti();

        // dump($cekNilaiNtp);
        // dump($cekNilaiNti);
        // dump($cekNilaiPti);

        
        $bobotAwalKriteria = $kelasFuzzyAhp->getBobotAwalkriteria();
        //LIHAT HASIL PERHITUNG BOBOT AWAL KRITERIA
        // for($i=0; $i<3; $i++){
        //     for($j=0; $j<3; $j++){
        //         echo number_format($bobotAwalKriteria[$i][$j],1). " ";
        //     }
        //     echo '<br>';
        // }
        // dump($bobotAwalKriteria);
        
        // Hitung CR kriteria
        $CR = $kelasFuzzyAhp->hitungConsistencyRatio($bobotAwalKriteria);
        // dump($CR);




        //hitungBobotPrioritasKriteria
        $bobotPrioritasAntarKriteria = $kelasFuzzyAhp->hitungBobotPrioritasAntarKriteria();
        // dump($bobotPrioritasAntarKriteria);
        
        
        //Cek hasil kategori
        $hasilKategoriAlternatif = $kelasFuzzyAhp->getHasilKategori();
        dump($hasilKategoriAlternatif);
        


        //Bobot Awal alternatif Raport
        // $bobotAwalAlternatifRaport = $kelasFuzzyAhp->getBobotAwalAlternatif(0);


        // for($i=0; $i<count($hasilKategoriAlternatif); $i++){
        //     for($j=0; $j<count($hasilKategoriAlternatif); $j++){
        //         echo number_format($bobotAwalAlternatifRaport[$i][$j],1). " ";
        //     }
        //     echo '<br>';
        // }

        // echo '<br>';

        // for($i=0; $i<count($hasilKategoriAlternatif); $i++){
        //     for($j=0; $j<count($hasilKategoriAlternatif); $j++){
        //         echo number_format($tfnAlternatifRaport[$i][$j],1). " ";
        //     }
        //     echo '<br>';
        // }


        $bobotPrioAltNilaiRaport = $kelasFuzzyAhp->hitungBobotPrioritasAntarAlternatif(0);
        $bobotPrioAltPeringkatSekolah = $kelasFuzzyAhp->hitungBobotPrioritasAntarAlternatif(1);
        $bobotPrioAltfIpk = $kelasFuzzyAhp->hitungBobotPrioritasAntarAlternatif(2);

        // dump($bobotPrioAltNilaiRaport);
        // dump($bobotPrioAltPeringkatSekolah);
        // dump($bobotPrioAltfIpk);

        
        $hasilPemeringkatan= $kelasFuzzyAhp->hasilPemeringkatan($bobotPrioritasAntarKriteria,
                                                            $bobotPrioAltNilaiRaport,
                                                            $bobotPrioAltPeringkatSekolah,
                                                            $bobotPrioAltfIpk);

        // dump($hasilPemeringkatan);
        
        // $hasilKategoriPemeringkatan;
        // for($i=0; $i<count($hasilPemeringkatan); $i++){
        //     $hasilKategoriPemeringkatan=
        // }

        


        $hasilPMDK;
        for($i=0; $i<count($hasilPemeringkatan); $i++){
            $hasilPMDK[$i][0]=$hasilKriteria[0][$hasilPemeringkatan[$i][0]];    // data siswa
            $hasilPMDK[$i][1]=number_format($hasilKriteria[1][$hasilPemeringkatan[$i][0]],3);    // rata-rata nilai akhir
            $hasilPMDK[$i][2]=number_format($hasilKriteria[2][$hasilPemeringkatan[$i][0]],2);    // rata-rata ipk alumni
            $hasilPMDK[$i][3]=number_format($hasilPemeringkatan[$i][1],5);

        }
        

        return view('halamanHasilSeleksi',['hasilPMDK'=>$hasilPMDK,'kuotaPMDK'=>$kuotaPmdk,'jumlahPeminat'=>$jumlah_peminat_PMDK,'jumlahLolosKKM'=>count($hasilSeleksiKkm)]);


    }


    
    //MENAMPILKAN DATA PMDK DI HALAMAN UTAMA
    function showDataPeminat(){
        $data=Nilai::join('siswa','nilai.id_siswa','=','siswa.id_siswa')->
        paginate(14);

        return view('halamanUtama',['nilais'=>$data]);

    }

    public function pindahHalamanImport(){
        return view('halamanUtama');
    }

    public function pindahHalamanPenentuanBobot(){
        return view('halamanPenentuanBobotDanKuota');
    }

    public function pindahHalamanHasilSeleksi(){
        return view('halamanHasilSeleksi');
    }





    public function importData() 
    {   

        Excel::import(new DataImport,request()->file('file'));
        Alert::success('Import data siswa berhasil','Lanjutkan ke halaman selanjutnya');

        // Alert::error('GAGAL','import gagal');
        
        return back();



    }



}
