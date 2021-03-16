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
         <h2>Penentuan Bobot Antar Kriteria & Jumlah Kuota Penerimaan</h2>
    </div> 

        <div class="penentuanBobot">
            <div class="opsi1">
                <h5>Nilai Raport -> Peringkat Sekolah<h5> 
                    <select>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                    </select>
            </div>  
            
            <div class="opsi2">
                <h5>Nilai Raport -> IPK Alumni</h5>
                    <select>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                    </select>
                </div>


            <div class="opsi3">
                <h5>Peringkat Sekolah -> IPK Alumni</h5>
                    <select>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                    </select>
            </div>

            <div class="opsi4">
                <form>
                    <label for=""> <h5>Jumlah Kuota</h5> </label>
                    <input type="text"  name="kuota" placeholder="...">
                </form>
            </div>
        </div>


        <!-- <div class="tombolSeleksi">
            <button type="button" class="btn btn-success" onclick="{{('print')}}">Jalankan Seleksi</button>
        </div> -->

        <a href="{{('/print')}}">run!</a>


        <div class="tombolNextPrev">
            <a href="{{('/')}}" class="previous round">&#8249;</a>
        </div>
    
  

</div>

</body>
</html>

