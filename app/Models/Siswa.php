<?php

namespace App\Models;

use app\Imports\DataImport;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    
    protected $primaryKey='id_siswa';
    protected $fillable=['id_sekolah','nama_siswa'];


    public $table ="siswa";
    public $timestamps=false;


}
