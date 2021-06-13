<!DOCTYPE html>
<html>
<x-header/>
<head>
    <title>Halaman Penentuan Bobot dan Kuota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="\css\app.css" >

</head>


<body>
<div class="tombolLogout">  
    <a href="{{ url('halamanLogin') }}" class="btn btn-success"> <img src="/img/logo_logout.png">  Keluar </a>
</div>

<div class="container">
@include('sweetalert::alert')



    <div class="headerPenentuanBobot">
         <h3>Penentuan Bobot Antar Kriteria (Nilai Raport, Peringkat Sekolah, IPK)</h3>
    </div> 



    <form action="/halamanHasilSeleksi" method="POST">
        @csrf
        <div class="penentuanBobot">
            <div class="opsi1" >
                <!-- <h5>Nilai Raport Peringkat Sekolah<h5>  -->
                
                <div class="logoPenentuanBobot">
                    <div class="tagOpsi1">
                        <p>Nilai Raport</p>
                        <p>Sekolah</p>
                    </div>
                    <img src="/img/logo_nilai_raport.png" class="logoNilai">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="80"  fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                    </svg>

                    <img src="/img/logo_sekolah.png" class="logoSekolah">
                </div>

                <div class="jumlahBobot">
                    <p>Bobot:  
                        <select name="ntp">
                            <option value="-9">-9</option>
                            <option value="-8">-8</option>
                            <option value="-7">-7</option>
                            <option value="-6">-6</option>
                            <option value="-5">-5</option>
                            <option value="-4">-4</option>
                            <option value="-3">-3</option>
                            <option value="-2">-2</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                        </select> 
                    </p>
                </div>
                   
            </div>  
            
            
            <div class="opsi2">

                <div class="logoPenentuanBobot">
                    <div class="tagOpsi2">
                        <p>Nilai Raport</p>
                        <p>IPK Alumni</p>
                    </div>
                    <img src="/img/logo_nilai_raport.png" class="logoNilai">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="80"  fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                    </svg>
                    <img src="/img/logo_IPK.png" class="logoIpk">
                </div>
                
                <div class="jumlahBobot">
                <p>Bobot:  
                        <select name="nti">
                            <option value="-9">-9</option>
                            <option value="-8">-8</option>
                            <option value="-7">-7</option>
                            <option value="-6">-6</option>
                            <option value="-5">-5</option>
                            <option value="-4">-4</option>
                            <option value="-3">-3</option>
                            <option value="-2">-2</option>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                        </select> 
                    </p>
                </div>
            </div>

            <div class="opsi3">
                    <div class="tagOpsi3">
                        <p>Sekolah</p>
                        <p>IPK Alumni</p>
                    </div>
                <div class="logoPenentuanBobot">
                    <img src="/img/logo_sekolah.png" class="logoSekolah">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="80" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                    </svg>
                    <img src="/img/logo_IPK.png" class="logoIpk">
                </div>

                    <div class="jumlahBobot">
                    <p>Bobot:  
                            <select name="pti">
                                <option value="-9">-9</option>
                                <option value="-8">-8</option>
                                <option value="-7">-7</option>
                                <option value="-6">-6</option>
                                <option value="-5">-5</option>
                                <option value="-4">-4</option>
                                <option value="-3">-3</option>
                                <option value="-2">-2</option>
                                <option value="1" selected>1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                            </select> 
                        </p>
                    </div>
            </div>

            <div class="opsi4">
                <label for=""> <h5>Jumlah Kuota Penerimaan: </h5> </label>
                <input type="text"  name="kuota" placeholder="contoh:15">
            </div>
        </div>

        <div class="tombolSeleksi">
            <button type="submit" class="btn btn-success" href="{{ route('jalankanSeleksi') }}">Jalankan Seleksi </a>
        </div>

    </form>






    <div class="tombolNextPrev">
        <a href="{{('/halamanUtama')}}" class="previous round">&#8249;</a>
    </div>

    <div class="tombolLihatKeterangan ">
        <button type="button" class="btn btn-success " id="tombolLihatKeterangan" onclick="showTable()">   <img src="/img/logo_help.png"></button>
    </div>

 
    <div class="tagKeteranganInput ">
        <h5 >Lihat keterangan setiap bobot input </h5> 
    </div>



    
<table class="table tabelKeterangan" id="tabelKeterangan" style="display:none;">
    <tr>
        <th class="table-info">Input (AHP)</th>
        <th class="table-info">Keterangan</th>
    </tr>


    <tr>
        <td>1 </td>
        <td> &lt;Kriteria1&gt; sama penting dengan &lt;Kriteria2&gt; </td>
    </tr>

    <tr>
        <td>3 </td>
        <td>&lt;Kriteria1&gt; sedikit lebih penting dari &lt;Kriteria2&gt; </td>
    </tr>

    <tr>
        <td>5 </td>
        <td>&lt;Kriteria1&gt; cukup lebih penting dari &lt;Kriteria2&gt; </td>
    </tr>

    <tr>
        <td>7 </td>
        <td>&lt;Kriteria1&gt; sangat lebih penting dari &lt;Kriteria2&gt; </td>
    </tr>

    <tr>
        <td>9 </td>
        <td>&lt;Kriteria1&gt; mutlak lebih penting dari &lt;Kriteria2&gt; </td>
    </tr>

    <tr>
        <td>2,4,6,8</td>
        <td>Bernilai di antara 2 nilai pertimbangan yang berdekatan</td>
    </tr>

    <tr>
        <td>-</td>
        <td>Kebalikan, dibaca &lt;Kriteria2&gt; &lt;input&gt; &lt;Kriteria1&gt; </td>
    </tr>
</table>

</div>

<script>
         function showTable(){
            var tabelKeterangan= document.getElementById("tabelKeterangan");
            var tombolLihatKeterangan = document.getElementById("tombolLihatKeterangan");

            if(tabelKeterangan.style.display != "none"){
                tabelKeterangan.style.display = "none";
                // tombolLihatKeterangan.innerHTML =' <img src="/img/logo_help.png">';
            }

            else{
                tabelKeterangan.style.display = "";
                // tombolLihatKeterangan.innerHTML ='&#8659;';
            }
        
        }
         
    </script>

</body>
</html>

