<!DOCTYPE html>
<html>
<x-header/>
<head>
    <title>Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
   
<div class="container">
    <div class="card bg-light mt-3">
        <div class="card-header">
            Unggah data siswa peminat PMDK dengan format file Excel.
        </div>
        <div class="card-body">
            <form action="{{ route('import') }}"  enctype="multipart/form-data" method="POST">
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <button class="btn btn-success">Import Data Siswa</button>
                <!-- <a class="btn btn-warning" href="/export">Export Data Siswa</a> -->
            </form>
        </div>
    </div>
</div>


<div class="container mt-5" >
        <h3>Daftar Peserta PMDK</h3>
        <table class="table" border="1">
            <tr>
                <td>Id_Siswa</td>
                <td>Mata Pelajaran</td>
                <td>Kelas X (smt 1)</td>
                <td>Kelas X (smt 2)</td>
                <td>Kelas XI (smt 1)</td>
                <td>Kelas XI (smt 2)</td>
            </tr>

        @foreach($nilais as $nilai)
        <tr>
                <td>{{$nilai['id_siswa']}}</td>
                <td>{{$nilai['id_mata_pelajaran']}}</td>
                <td>{{$nilai['101']}}</td>
                <td>{{$nilai['102']}}</td>
                <td>{{$nilai['111']}}</td>
                <td>{{$nilai['112']}}</td>
        </tr>
        @endforeach
        </table>
    
    <span> {{$nilais->links()}}</span> 
</div>




<div>
    <a href=""></a>
</div>





<style>
    .w-5{
        display:none
    }
</style>


</body>
</html>