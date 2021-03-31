<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;


    protected $primaryKey='id_mahasiswa';
    protected $fillable=['id_mahasiswa','id_sekolah','nama_mahasiswa','IPK'];


    public $table ="mahasiswa";
    public $timestamps=false;
}
