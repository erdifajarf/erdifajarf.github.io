<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\Sekolah;

use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataSekolahImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    

    public function model(array $row)
    {
        $dataSekolah=null;

        $nama_sekolah_sama = Sekolah::where('nama_sekolah','=',$row['asal_sma'])->get()->count();
        if($nama_sekolah_sama===0)
        {
            $dataSekolah=new Sekolah([
                'nama_sekolah'  => $row['asal_sma'],
            ]);
              
        }

        if($dataSekolah!=null){
            return array($dataSekolah);
        }


    }

}