<?php

namespace App\Models;

use app\Imports\DataImport;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;
    

    protected $primaryKey='id_nilai';
    protected $fillable=['id_siswa','id_mata_pelajaran','101_KKM','101_p','101_t','102_KKM','102_p','102_t',
    '111_KKM','111_p','111_t','112_KKM','112_p','112_t'];

    public $table ="nilai";

    public $timestamps=false;

}
