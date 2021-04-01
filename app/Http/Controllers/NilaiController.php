<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class NilaiController extends Controller
{

    private $matpel;

    private $X1_p;
    private $X1_t;

    private $X2_p;
    private $X2_t;

    private $XI1_p;
    private $XI1_t;

    private $XI2_p;
    private $XI2_t;

    private $X1_kkm;
    private $X2_kkm;
    private $XI1_kkm;
    private $XI2_kkm;


    function __construct($matpel='',$X1_kkm='', $X1_p='', $X1_t='', 
                            $X2_kkm='', $X2_p='', $X2_t='', 
                            $XI1_kkm='', $XI1_p='',$XI1_t='',
                            $XI2_kkm='', $XI2_p='',$XI2_t=''){

        $this->matpel = $matpel;

        $this->X1_kkm = $X1_kkm;
        $this->X1_p = $X1_p;
        $this->X1_t = $X1_t;

        $this->X2_kkm = $X2_kkm;
        $this->X2_p = $X2_p;
        $this->X2_t = $X2_t;
        
        $this->XI1_kkm = $XI1_kkm;
        $this->XI1_p = $XI1_p;
        $this->XI1_t = $XI1_t;

        $this->XI2_kkm = $XI2_kkm;
        $this->XI2_p = $XI2_p;
        $this->XI2_t = $XI2_t;
    }


    function getMatpel() : MataPelajaranController{
        return $this->matpel;
    }

    function getRataRata() : Double{
        return $this->rataRata;
    }

    function getX1_kkm() {
        return $this->X1_kkm;
    }

    function getX2_kkm() {
        return $this->X2_kkm;
    }

    function getXI1_kkm() {
        return $this->XI1_kkm;
    }

    function getXI2_kkm() {
        return $this->XI2_kkm;
    }



    function getX1_p() {
        return $this->X1_p;
    }

    function getX1_t() {
        return $this->X1_t;
    }

    function getX2_p(){
        return $this->X2_p;
    }

    function getX2_t(){
        return $this->X2_t;
    }

    function getXI1_p(){
        return $this->XI1_p;
    }

    function getXI1_t(){
        return $this->XI1_t;
    }

    function getXI2_p() {
        return $this->XI2_p;
    }

    function getXI2_t() {
        return $this->XI2_t;
    }


    function hitungRataRata(){
        $total=0;
        $total =$this->X1_p->{'101_p'} + $this->X1_t->{'101_t'} + 
                $this->X2_p->{'102_p'} + $this->X2_t->{'102_t'} + 
                $this->XI1_p->{'111_p'}+ $this->XI1_t->{'111_t'}+
                $this->XI2_p->{'112_p'}+ $this->XI2_t->{'112_t'};

        $total = $total/8;
        return $total;
    }







    //MENAMPILKAN DATA PMDK DI HALAMAN UTAMA
    function show(){
        $data=Nilai::paginate(10);
        return view('halamanUtama',['nilais'=>$data]);
    }



}
