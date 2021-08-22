<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\Sekolah;
use App\Models\Nilai;
use App\Models\MataPelajaran;
use App\Models\Mahasiswa;
use App\Models\KKM;

use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;



use Alert;


class DataImport2 implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */


    public function model(array $row)
    {
        $dataKKM=null;

        if(isset($row['101_kkm'])){  
        $a=DB::table('sekolah')->select('id_sekolah')->where('nama_sekolah','=',$row['asal_sma'])->value('id_sekolah');
        $b=DB::table('KKM')->select('id_sekolah')->where('id_sekolah','=',$a)->get()->count();
        if($b<=1){
        $dataKKM=new KKM([
            'id_sekolah'=>  DB::table('sekolah')->
                                    select('id_sekolah')->
                                    where('nama_sekolah','=',$row['asal_sma'])->
                                    value('id_sekolah'),
            'id_mata_pelajaran'=> DB::table('mata_pelajaran')->
                                    select('id_mata_pelajaran')->
                                    where('nama_mata_pelajaran','=',$row['mata_pelajaran'])->
                                    value('id_mata_pelajaran'),                
            '101_KKM'  => $row['101_kkm'],
            '102_KKM'  => $row['102_kkm'],
            '111_KKM'  => $row['111_kkm'],
            '112_KKM'  => $row['112_kkm'],
            ]);
        }
    }

        if($dataKKM!=null){
            return array($dataKKM);
        }
             
                
    }


     

            
}



