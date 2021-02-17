<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\Sekolah;
use App\Models\Nilai;

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
        // $dataSekolah=null;
        $dataSiswa=null;
        $dataNilai=null;
        

        // $nama_sekolah_sama = Sekolah::where('nama_sekolah','=',$row['asal_sma'])->get();
        
        // $jumlah_sekolah = $nama_sekolah_sama->count();

        // if($jumlah_sekolah===0)
        // {
        //     $dataSekolah= new Sekolah([
        //         'nama_sekolah'  => $row['asal_sma'],
        //     ]);
              
        // }

         $jumlah_siswa_sama = Siswa::where('nama_siswa','=',$row['nama'])->get()->count();
         if ($jumlah_siswa_sama==0){
         
            $dataSiswa=new Siswa([
                'id_sekolah' => DB::table('sekolah')->
                                select('id_sekolah')->
                                where('nama_sekolah','=',$row['asal_sma'])->
                                value('id_sekolah'),
                
                'nama_siswa' => $row['nama'],
                
            ]);
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
             
            '101'=>$row['nilai'],
            '102'=>$row['nilai'],
            '111'=>$row['nilai'],
            '112'=>$row['nilai'],
            'rata_rata'=>2.5,
         ]);

        
      
        if($dataSiswa===null){
            
            return array($dataNilai);
        }
        else {
            return array($dataSiswa,$dataNilai);
        }

    }

 
}
