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


class DataImport2 implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */


    public function model(array $row)
    {
        $dataNilai=null;

            if(isset($row['101_p']) && isset($row['asal_sma']) && isset($row['peringkat_sekolah'])){
                $dataNilai=new Nilai([
                        'id_siswa' => DB::table('siswa')->
                                    select('id_siswa')->
                                    where('nama_siswa','=',$row['nama'])->
                                    value('id_siswa'),
                        'id_mata_pelajaran' => DB::table('mata_pelajaran')->
                                    select('id_mata_pelajaran')->
                                    where('nama_mata_pelajaran','=',$row['mata_pelajaran'])->
                                    value('id_mata_pelajaran'),
                            
                        '101_KKM'=>$row['101_kkm'],
                        '101_p'=>$row['101_p'],
                        '101_t'=>$row['101_t'],
                        '102_KKM'=>$row['102_kkm'],
                        '102_p'=>$row['102_p'],
                        '102_t'=>$row['102_t'],
                        '111_KKM'=>$row['111_kkm'],
                        '111_p'=>$row['111_p'],
                        '111_t'=>$row['111_t'],
                        '112_KKM'=>$row['112_kkm'],
                        '112_p'=>$row['112_p'],
                        '112_t'=>$row['112_t'],
                    ]);

                if($dataNilai!=null ){
                    Alert::success('Import data nilai siswa berhasil','Silakan proses di halaman selanjutnya');
                    return array($dataNilai);
                }
            }


    }



}