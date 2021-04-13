<!DOCTYPE html>
<html>
<x-header/>
<head>
    <title>Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="\css\app.css" >

</head>


<body>
    
<div class="container">

    <div class="headerPenentuanBobot">
         <h3>Penentuan Bobot Antar Kriteria (Nilai Raport, Peringkat Sekolah, IPK)</h3>
    </div> 



    <form action="/halamanHasilSeleksi" method="POST">
        @csrf
        <div class="penentuanBobot">
            <div class="opsi1" >
                <!-- <h5>Nilai Raport Peringkat Sekolah<h5>  -->
                
                <div class="logoPenentuanBobot">
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
                <!-- <h5>Nilai Raport -> IPK Alumni</h5> -->

                <div class="logoPenentuanBobot">
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
                <!-- <h5>Peringkat Sekolah -> IPK Alumni</h5> -->
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
            <button type="submit" class="btn btn-success" href="{{route('main')}}">Jalankan Seleksi </a>
        </div>

    </form>






    <div class="tombolNextPrev">
        <a href="{{('/')}}" class="previous round">&#8249;</a>
    </div>

    <table class="table tabelKeterangan">
    <tr>
        <th class="table-light">Input (AHP)</th>
        <th class="table-light">Keterangan</th>
    </tr>

    <tr>
        <td>1 </td>
        <td>Kriteria 1 sama penting dengan kriteria 2 </td>
    </tr>

    <tr>
        <td>3 </td>
        <td>Kriteria 1 sedikit lebih penting dari kriteria 2 </td>
    </tr>

    <tr>
        <td>5 </td>
        <td>Kriteria 1 cukup lebih penting dari kriteria 2 </td>
    </tr>

    <tr>
        <td>7 </td>
        <td>Kriteria 1 sangat lebih penting dari kriteria 2 </td>
    </tr>

    <tr>
        <td>9 </td>
        <td>Kriteria 1 mutlak lebih penting dari kriteria 2 </td>
    </tr>

    <tr>
        <td>2,4,6,8</td>
        <td>Bernilai di antara 2 nilai pertimbangan yang berdekatan</td>
    </tr>

    <tr>
        <td>-</td>
        <td>Kebalikan, dibaca kriteria 2 &lt;penilaian&gt; kriteria 1 </td>
    </tr>
</table>
    
</div>

</body>
</html>

