<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KKM extends Model
{
    use HasFactory;
    protected $primaryKey='id_KKM';
    protected $fillable=['id_sekolah','id_mata_pelajaran','101_KKM','102_KKM','111_KKM','112_KKM'];


    public $table ="KKM";
    public $timestamps=false;
}
