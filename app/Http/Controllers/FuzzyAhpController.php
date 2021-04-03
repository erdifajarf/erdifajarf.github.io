<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FuzzyAhpController extends Controller
{
    //
    private $ntp,$nti,$pti;
    private $hasilKategori;

    function __construct($hasilKategori,$ntp, $nti, $pti){
        $this->ntp = $ntp;
        $this->nti = $nti;
        $this->pti = $pti;
    }

    function getNtp(){
        return $this->ntp;
    }

    function getNti(){
        return $this->nti;
    }

    function getPti(){
        return $this->pti;
    }
}
