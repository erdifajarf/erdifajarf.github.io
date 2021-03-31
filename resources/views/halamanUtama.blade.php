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
    <div class="card bg-light mt-3">
        <div class="card-header">
            Unggah data sekolah peminat PMDK dengan format file Excel.
        </div>
        <div class="card-body">
            <form action="{{ route('importData') }}"  enctype="multipart/form-data" method="POST">
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <button class="btn btn-success">Import Data</button>
                <!-- <a class="btn btn-warning" href="/export">Export Data Siswa</a> -->
            </form>
        </div>
    </div>


<div class="kolom">
    <table class="table table-striped">
        <tr>
            <th rowspan=3 class="table-primary">No.PMB</th>
            <th rowspan=3 class="table-primary">MATA PELAJARAN</th>
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
    </div>

@foreach($nilais as $nilai)

    <tr>
        <td>{{$nilai['id_siswa']}}</td>
        @if($nilai['id_mata_pelajaran']=='1')
            <td>Matematika</td>
        @else
            <td>B.Ingriss</td>
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
@endforeach
</table>

<nav aria-label="...">
  <ul class="pagination">
    <li class="page-item disabled">
      <a class="page-link" href="#" tabindex="-1">Previous</a>
    </li>
    <li class="page-item"><a class="page-link" href="?page=1">1</a></li>
    <li class="page-item active">
      <a class="page-link" href="?page=2">2 <span class="sr-only"></span></a>
    </li>
    <li class="page-item"><a class="page-link" href="?page=3">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav>


<!-- <span>
    {{$nilais->links()}}
</span> -->


<div class="tombolNextPrev">
    <a href="{{('halamanPenentuanBobotDanKuota')}}" class="next round">&#8250;</a>
</div>


</body>
</html>

