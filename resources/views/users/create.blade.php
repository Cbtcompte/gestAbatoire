@extends('layouts.master', ['title' =>'Utilisateur'])

@section('content')

<div class="container mt-4" id="create">
    @if($retour == true)
        <div class="row">
            <div class="col-4">
                <a href="{{ route('user.index')}}"><button type="submit" id="load" class="btn btn-primary btn-block">Retour</button></a>
            </div>
        </div>
    @endif
    <div class="card card-outline card-primary mt-3">
      <div class="card-header text-center">
        <a href="#" class="h1"><b>{{ $app->nom }}</b></a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Enregistrer un nouveau utilisateur</p>
  
        <form action="{{ route('user.store') }}" method="post">
            @csrf
          <div class="input-group mb-3">
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nom complet*">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
            @error('name')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
            @enderror
          </div>
          <div class="input-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
            @error('email')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
            @enderror
          </div>
          <div class="input-group mb-3">
            <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror" placeholder="Téléphone*">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-phone"></span>
              </div>
            </div>
            @error('telephone')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
            @enderror
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Mot de passe*">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            @error('password')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
            @enderror
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirmer le mot de passe*">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
           
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="offset-4 col-4">
              <button type="submit" id="load1" class="btn btn-primary btn-block">Enregistrer</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <script>
          var btn = document.getElementById('load');
        btn.addEventListener("click", function(event) {
            btn.innerHTML = "Loading...";
        });

        var btn1 = document.getElementById('load1');
        btn1.addEventListener("click", function(event) {
            btn1.innerHTML = "Loading...";
        });
      </script>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
  <!-- /.register-box -->
  
@endsection
