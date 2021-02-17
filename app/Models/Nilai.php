<?php

namespace App\Models;

use app\Imports\DataImport;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;
    
    public $table ="nilai";
    protected $primaryKey='id_nilai';
    protected $fillable=['id_siswa','id_mata_pelajaran','101','102','111','112'];

    // protected $attributes=[
    //     'rata_rata'=>('101'+'102'+'111'+'112')/4,
    // ];
    

    public $timestamps=false;

}
