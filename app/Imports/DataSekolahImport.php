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

        $nama_sekolah_sama = Sekolah::where('nama_sekolah','=',$row['asal_sma'])->get();
        
        $jumlah_sekolah = $nama_sekolah_sama->count();

        if($jumlah_sekolah===0)
        {
            return new Sekolah([
                'nama_sekolah'  => $row['asal_sma'],
            ]);
              
        }


    }

}