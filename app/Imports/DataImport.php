<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\Sekolah;
use App\Models\Nilai;
use App\Models\MataPelajaran;
use App\Models\Mahasiswa;

use Illuminate\Support\Facades\DB;


use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */


    public function model(array $row)
    {
        $dataSekolah=null;
        $dataSiswa=null;
        $dataNilai=null;
        $dataMatpel=null;
        $dataMahasiswa=null;


        $nama_matpel_sama= MataPelajaran::where('nama_mata_pelajaran','=',$row['mata_pelajaran'])->get()->count();
        if($nama_matpel_sama===0){
            $dataMatpel=new MataPelajaran([
                'nama_mata_pelajaran'=> $row['mata_pelajaran'],
            ]);
        }
        
        $nama_sekolah_sama = Sekolah::where('nama_sekolah','=',$row['asal_sma'])->get()->count();
        if($nama_sekolah_sama===0)
        {
            $dataSekolah=new Sekolah([
                'nama_sekolah'  => $row['asal_sma'],
                'peringkat_sekolah'=> '15',
            ]);
              
        }

         $nama_siswa_sama = Siswa::where('nama_siswa','=',$row['nama'])->get()->count();
         if ($nama_siswa_sama==0){
         
            $dataSiswa=new Siswa([
                'id_siswa'=>$row['no_pmb'],
                'id_sekolah' => DB::table('sekolah')->
                                select('id_sekolah')->
                                where('nama_sekolah','=',$row['asal_sma'])->
                                value('id_sekolah'),
                
                'nama_siswa' => $row['nama'],
                
            ]) ;
        }


  
        $dataNilai=new Nilai([
           
            'id_siswa' => DB::table('siswa')->
                            select('id_siswa')->
                            where('nama_siswa','=',$row['nama'])->
                            value('id_siswa'),

            'id_mata_pelajaran' => DB::table('mata_pelajaran')->
                            select('id_mata_pelajaran')->
                            where('nama_mata_pelajaran','=',$row['mata_pelajaran'])->
                            value('id_mata_pelajaran'),
             
            '101_kkm'=>$row['101_kkm'],
            '101_p'=>$row['101_p'],
            '101_t'=>$row['101_t'],
            '102_kkm'=>$row['102_kkm'],
            '102_p'=>$row['102_p'],
            '102_t'=>$row['102_t'],
            '111_kkm'=>$row['111_kkm'],
            '111_p'=>$row['111_p'],
            '111_t'=>$row['111_t'],
            '112_kkm'=>$row['112_kkm'],
            '112_p'=>$row['112_p'],
            '112_t'=>$row['112_t'],
         ]);

        


        //  $nama_mahasiswa_sama= Mahasiswa::where('id_mahasiswa','=',$row['npm'])->get()->count();
        //  if($nama_mahasiswa_sama==0){

        //  $dataMahasiswa=new Mahasiswa([
       
        //     'id_mahasiswa'=> $row['npm'],

        //     'id_sekolah'=>  DB::table('sekolah')->
        //                     select('id_sekolah')->
        //                     where('nama_sekolah','=',$row['asal_sma'])->
        //                     value('id_sekolah'),

        //     'nama_mahasiswa'=> $row['nama'],
        //     'IPK'=> $row['ipk_terakhir'],
        //  ]);
        // }

   


        
         //STEP 1
        // if($dataMatpel!=null){
        //     return array($dataMatpel);
        // }
        
        //STEP 2
        // if($dataSekolah!=null){
        //     return array($dataSekolah);
        // }
        
        //STEP 3
        // if($dataMahasiswa!=null){
        //     return array($dataMahasiswa);
        // }

        //STEP 4
        // if($dataSiswa!=null){
        //     return array($dataSiswa);
        // }


        //STEP 5  
        // if($dataNilai!=null){
        //     return array($dataNilai);
        // }

    }
}