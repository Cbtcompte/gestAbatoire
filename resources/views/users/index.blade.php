@extends('layouts.master', ['title' =>'Liste des utilisateurs'])

@section('content')
<div class="container mt-4">
    @if(session()->has('message'))
    <div class="alert alert-success">
        <span>{{ session()->get('message') }} </span>
    </div>
    @endif

    @if($users ->isEmpty())
        <div class="">
            <div style="margin-top:20%" class="text-center">
                <i class="fas fa-users-slash" style="font-size:300%"></i>
                <h4>Aucun utilisateur enregistré</h4>
                <div class="row">
                    <div class="offset-4 col-4">

                        <a href="{{ route('user.create', ['retour' => true])}}" ><button class="btn btn-primary" id="load" >Ajouter un utilisateur</button></a>
                    </div>
                </div>
            </div>

        </div>
    @else
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <p>Liste des caissiers</p>
                    </div>
                    <div class="col-4">
                        <a href="{{ route('user.create', ['retour' => true])}}"><button class="btn btn-primary" id="load">Ajouter un utilisateur</button></a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @foreach($users as $user)
    <div class="row">
        <div class="col-4">
            <div class="card card-outline card-primary">
                <div class="card-body">
                    <div style="margin-left:30%">
                        <i class="fas fa-user-tie" style="font-size:800%"></i>
                    </div><hr>
                    <div class="row">
                        <div class="col-5">
                            <p style="font-size:15px; font-weight:bolder">Nom : </p>
                            <p style="font-size:15px; font-weight:bolder">Contacte : </p>
                            <p style="font-size:15px; font-weight:bolder">Email : </p>
                        </div>
                        <div class="col-7">
                            <p style="font-size:15px">{{ $user->name}}</p>
                            <p style="font-size:15px">{{ $user->telephone}}</p>
                            <p style="font-size:15px">{{ $user->email}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                           <a  href="#"><button class="btn btn-warning text-white">Modifier</button></a>
                        </div>
                        <div class="offset-1 col-5">
                            <a href="#"><button class="btn btn-danger">Supprimer</button></a>
                        </div>
                    </div>
                </div>
                <!-- /.form-box -->
            </div><!-- /.card -->
        </div>
    </div>
    @endforeach
</div>
<script>
    var btn = document.getElementById('load');
  btn.addEventListener("click", function(event) {
      btn.innerHTML = "Loading...";
  });
</script>
  <!-- /.register-box -->

@endsection
