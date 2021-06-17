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
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;



use Alert;


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
        $dataMahasiswa=null;
         
        $nama_sekolah_sama = Sekolah::where('nama_sekolah','=',$row['asal_sma'])->get()->count();
        if($nama_sekolah_sama===0)
        {
            $dataSekolah=new Sekolah([
                'nama_sekolah'  => $row['asal_sma'],
                'peringkat_sekolah'=> $row['peringkat_sekolah'],
            ]);
              
        }

        if($dataSekolah!=null){
            return array($dataSekolah);
        }
        
       
        if(isset($row['npm'])){  
            $npm_sama = Mahasiswa::where('id_mahasiswa','=',$row['npm'])->get()->count();
            if($npm_sama==0){
                $nama_mahasiswa_sama= Mahasiswa::where('id_mahasiswa','=',$row['npm'])->get()->count();
                if($nama_mahasiswa_sama==0){
                        $dataMahasiswa=new Mahasiswa([
                        'id_mahasiswa'=> $row['npm'],
                        'id_sekolah'=>  DB::table('sekolah')->
                                        select('id_sekolah')->
                                        where('nama_sekolah','=',$row['asal_sma'])->
                                        value('id_sekolah'),
                        'nama_mahasiswa'=> $row['nama'],
                        'IPK'=> $row['ipk_terakhir'],
                    ]);
                }
        }
       }
        if($dataMahasiswa!=null){
            return array($dataMahasiswa);
        }
        
        if(isset($row['no_pmb'])){
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
        }

        if($dataSiswa!=null){
            return array($dataSiswa);
        }

    }



}