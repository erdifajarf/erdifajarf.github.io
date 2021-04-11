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

    <div class="headerHasilSeleksi">
         <h2>Hasil Seleksi PMDK Siswa Tahun 2019</h2>
    </div> 

    <div class="kolom">

        <table class="table table-striped">

            <tr>
                <th class="table-primary">No</th>
                <th class="table-primary">No.PMB</th>
                <th class="table-primary">Nama</th>
                <th class="table-primary">Asal Sekolah</th>
                <th class="table-primary">Peringkat Sekolah</th>
                <th class="table-primary">Rata-rata Nilai Raport</th>
                <th class="table-primary">Rata-rata IPK</th>
                <th class="table-primary">Bobot Akhir (AHP)</th>

            </tr>

    </div>

        @for($i=0; $i<$kuotaPMDK; $i++)
            @if($i<count($hasilPMDK))
            <tr>
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
            <a href="{{('/halamanPenentuanBobotDanKuota')}}" class="previous round">&#8249;</a>
        </div>


</div>



</body>
</html>

