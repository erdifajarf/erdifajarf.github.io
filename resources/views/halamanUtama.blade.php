<!DOCTYPE html>
<html>
<x-header/>
<head>
    <title>Halaman Utama</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"  integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    
    <link rel="stylesheet" href="\css\app.css" >



</head>

<body>
<div class="tombolLogout">  
    <a href="{{ url('halamanLogin') }}" type="button" class="btn"> <img src="/img/logo_logout.png">  Keluar </a>
</div>

<div class="container">
    @include('sweetalert::alert')
        <div class="headerUpload">
            <h4> Unggah data sekolah peminat PMDK dengan format file Excel. </h4>
        </div>
        <i class="far fa-folder-open"></i>
        <form action="{{ route('importData') }}" id="formUpload" enctype="multipart/form-data" method="POST" class="tabelUpload">
            @csrf
            <input type="file" name="file" id="fileInput">
            <label for="fileInput"> <img src="/img/logo_browse.png" class="logoBrowse"> </label>
            
                <div  class="areaNamaFile">
                <span >
                    <strong>File dipilih:</strong>
                    <span id="namaFile">Kosong</span>
                </span>
                </div>
    
            <script>
                let fileInput = document.getElementById('fileInput');
                let areaNamaFile = document.getElementById('namaFile');
                fileInput.addEventListener('change', function(event){
                    let namaFileUploaded = event.target.files[0].name;
                    areaNamaFile.textContent = namaFileUploaded;
                })
            </script>

            <div class="tombolUpload">
                <button class="btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                    <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
                    </svg>
                </button>
            </div>

        </form>
    
        

    <div class="kolom">
        <table class="table">
            <tr>
                <th rowspan=3 class="table-primary">No</th>
                <th rowspan=3 class="table-primary">No.PMB</th>
                <th rowspan=3 class="table-primary">Nama</th>
                <th rowspan=3 class="table-primary">Mata Pelajaran</th>
                <th colspan=4 class="table-primary">Kelas X</th>
                <th colspan=4 class="table-primary">Kelas XI</th>
            </tr>

        <div class="semester">
            <tr>
                    <th colspan=2 class="table-primary">Semester 1</th>
                    <th colspan=2 class="table-primary">Semester 2</th>
                    <th colspan=2 class="table-primary">Semester 1</th>
                    <th colspan=2 class="table-primary">Semester 2</th>
            </tr>
        </div>

        <div class="jenis_nilai">
            <tr>
                    <th class="table-primary">Praktik</th>
                    <th class="table-primary">Teori</th>
                    <th class="table-primary">Praktik</th>
                    <th class="table-primary">Teori</th>
                    <th class="table-primary">Praktik</th>
                    <th class="table-primary">Teori</th>
                    <th class="table-primary">Praktik</th>
                    <th class="table-primary">Teori</th>
            </tr>
        </div>

    </div>

        @php
            $index=0;
            $anonim=1;

            $linkPage = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $angkaTerakhir=substr($linkPage, -1); 
            $angkaTerakhirKeDua=substr($linkPage, -2, 1);
            
            if($angkaTerakhir=='a'){
                $urutan = 1;
            }
            else if($angkaTerakhirKeDua > 0){
                $totalPage = $angkaTerakhirKeDua.$angkaTerakhir;
                $urutan = (7*$totalPage)-6;
            }
            else{
                $urutan = (7*$angkaTerakhir)-6;
            }
        @endphp
        @foreach($nilais as $nilai)
            <tr>
                @if($index%2=='0')
                    <td rowspan=2>{{$urutan}}</td>
                    <td rowspan=2>{{$nilai['id_siswa']}}</td>
                    <td rowspan=2>{{$nilai['nama_siswa']}}</td>
                    <!-- <td rowspan=2>Siswa {{$anonim}}</td> -->
                    @php $anonim++; $urutan++; @endphp
                @endif
                

                @if($nilai['id_mata_pelajaran']=='2')
                    <td>Matematika</td>
                @else
                    <td>B.Inggris</td>
                @endif 
                
                <td>{{$nilai['101_p']}}</td>
                <td>{{$nilai['101_t']}}</td>
                <td>{{$nilai['102_p']}}</td>
                <td>{{$nilai['102_t']}}</td>
                <td>{{$nilai['111_p']}}</td>
                <td>{{$nilai['111_t']}}</td>
                <td>{{$nilai['112_p']}}</td>
                <td>{{$nilai['112_t']}}</td>
            </tr>
        @php
        $index++;
        @endphp
        @endforeach

    </table>
    
        
    @if($jumlahNilai>14)
        @php
            $halamanTerakhir = number_format(ceil($jumlahNilai/14),0);

            $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $charTerakhir=substr($link, -1); 
            $charTerakhirKeDua=substr($link, -2, 1);
            
            $halamanSaatIni=0;
            if($charTerakhirKeDua>0){
                $halamanSaatIni = $charTerakhirKeDua.$charTerakhir;
            }
            else{
                $halamanSaatIni = $charTerakhir;               
            }

        @endphp

    <nav aria-label="...">
    <ul class="pagination">
        @if($halamanSaatIni>1)
        <li class="page-item">
            <a class="page-link" id="pagePrev" href="?page=" onclick="halamanSebelumnya();">Previous</a>
        </li>
        @endif

        <li class="page-item">
            <a class="page-link" href="?page=1">1</a> 
        </li>
       
        <li class="page-item ">
            <a class="page-link" href="?page=2">2 <span class="sr-only"></span></a>
        </li>

        <li class="page-item">
            <a class="page-link" href="?page=3">3</a>
        </li>
        
        @if($halamanSaatIni<$halamanTerakhir || $charTerakhir=='a')
            <li class="page-item">
                <a class="page-link" id="pageNext" href="?page=" onclick="halamanSelanjutnya();" >Next</a>
            </li>
        @endif
        

        @if($halamanSaatIni!=$halamanTerakhir)
        <li class="page-item">
            <a class="page-link" id="lastPage" href="?page=<?= $halamanTerakhir ?>"> >> </a>
        </li>
        @endif
        
    </ul>
    </nav>
    @endif

    <script>    
        function halamanSelanjutnya() {
            var id = window.location.href;
            var lastChar = id.substr(id.length - 1);
            var lastBefChar = id.substr(id.length - 2);
    
            var pageNext = document.getElementById('pageNext');
           
            if(lastChar=='a'){
                pageNext.setAttribute('href', '?page=2');
            }
            else{
                if(lastBefChar>0){
                    pageNext.setAttribute('href', '?page='+ (parseInt(lastBefChar)+1));
                }
                else{
                    pageNext.setAttribute('href', '?page='+ (parseInt(lastChar)+1));
                }
            }

            return false;
        }

        function halamanSebelumnya() {
            var id = window.location.href;
            var lastChar = id.substr(id.length - 1);
            var lastBefChar = id.substr(id.length - 2);
            
            var pagePrev = document.getElementById('pagePrev');
           
            if(lastChar=='a'){
                pagePrev.setAttribute('href', '?page=1');
            }
            else{
                if(lastBefChar>0){
                    pagePrev.setAttribute('href', '?page='+ (parseInt(lastBefChar)-1));
                }
                else{
                    pagePrev.setAttribute('href', '?page='+ (parseInt(lastChar)-1));
                }
            }
            return false;
        }
    </script>

    <div class="tombolNextPrev">
        <a href="{{('\halamanPenentuanBobotDanKuota')}}" class="next round">&#8250;</a>
    </div>
</div>
</body>
</html>

