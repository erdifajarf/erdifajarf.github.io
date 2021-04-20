<!DOCTYPE html>
<html>
<x-header/>
<head>
    <title>Halaman Hasil Seleksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="\css\app.css" >

</head>


<body>
    
<div class="container">
    @include('sweetalert::alert')

    <div class="headerHasilSeleksi">
        <div class="keteranganHasil">
            <h2>Hasil Seleksi PMDK Siswa Tahun 2019</h2>
            <p>Total pendaftar : {{$jumlahPeminat}} orang </p> 
            <p>Total lolos KKM : {{$jumlahLolosKKM}} orang  </p>

            @if($kuotaPMDK<=$jumlahLolosKKM)
                <p>Hasil Seleksi PMDK : {{$kuotaPMDK}} orang  </p>
            @else
                <p>Hasil Seleksi PMDK : {{$jumlahLolosKKM}} orang  </p>
            @endif
        </div>

    </div> 


        <div class="tombolDownload">
            <form action="{{ route('exportData') }}"  enctype="multipart/form-data" method="POST" class="tabelDownload">
                @csrf
                <button class="submit btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                </svg></button>
            </form>
        </div>

    <div class="tabelHasilSeleksi">

        <table class="table table-striped">

            <tr>
                <th class="table-info">No</th>
                <th class="table-info">No.PMB</th>
                <th class="table-info">Nama</th>
                <th class="table-info">Asal Sekolah</th>
                <th class="table-info">Peringkat Sekolah</th>
                <th class="table-info">Rata-rata Nilai Raport</th>
                <th class="table-info">Rata-rata IPK</th>
                <th class="table-info">Bobot Akhir (AHP)</th>

            </tr>

    </div>

        @for($i=0; $i<$kuotaPMDK; $i++)

            <tr>    
            @if($i<count($hasilPMDK))
                    <td>{{$i+1}}</td>
                    <td>{{$hasilPMDK[$i][0]->getNoPmb()->id_siswa}}</td>
                    <td>{{$hasilPMDK[$i][0]->getNamaSiswa()->nama_siswa}}</td>
                    <td>{{$hasilPMDK[$i][0]->getSekolah()->getNamaSekolah()->nama_sekolah}}</td>
                @if ($hasilPMDK[$i][0]->getSekolah()->getPeringkat()->peringkat_sekolah > '1000')
                    <td>>1000</td>
                @else
                    <td>{{$hasilPMDK[$i][0]->getSekolah()->getPeringkat()->peringkat_sekolah}}</td>
                @endif
                    <td>{{$hasilPMDK[$i][1]}}</td>
                @if ($hasilPMDK[$i][2]== '0')
                    <td>-</td>
                @else
                    <td>{{$hasilPMDK[$i][2]}}</td>
                @endif
                
                    <td>{{$hasilPMDK[$i][3]}}</td>

            @endif


            </tr>

        @endfor

        



             

     
                    
               
            

        </table>


        <div class="tombolNextPrev">
            <a href="{{('\halamanPenentuanBobotDanKuota')}}" class="previous round">&#8249;</a>
        </div>


</div>



</body>
</html>

