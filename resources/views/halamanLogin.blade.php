<!DOCTYPE html>
<html>
<x-header/>
<head>
    <title>Halaman Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="\css\app.css" >

</head>


<body>
  
@include('sweetalert::alert')

<div class="container">
    <div class="frameLogin">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Masuk ke sistem PMDK menggunakan username dan password</h5>
            
            <form class="form-signin formLogin" action="{{ route('jalankanLogin') }}" method="POST" >
            @csrf
              <div class="form-label-group">
                <input type="id" name="username" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                <label for="inputEmail">Username</label>
              </div>

              <div class="form-label-group">
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                <label for="inputPassword">Password</label>
              </div>

              <button class="btn btn-lg btn-success btn-block text-uppercase tombolLogin" >Login</button>
            </form>

          </div>
        </div>
      </div>
    </div>

    @if($errors->any())
      <h4>{{$errors->first()}}</h4>
    @endif
  </div>










</div>

</body>
</html>

