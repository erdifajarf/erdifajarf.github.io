<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilSeleksi extends Model
{
    use HasFactory;


    protected $fillable=['no','no_pmb','nama','asal_sekolah','peringkat_sekolah','rata_rata_nilai','rata_rata_ipk','bobot_akhir'];

    public $table ="hasil_seleksi";
    public $timestamps=false;


}
