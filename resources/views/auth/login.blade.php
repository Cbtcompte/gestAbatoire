@extends('layouts.app', ['title' => 'Connexion'])

@section('context')
<div class="bg order-1 order-md-2" style="background-image: url('/inscription/images/bg_1.jpg');"></div>
    <div class="contents order-2 order-md-1">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
            <strong><h1 style="text-align:center; font-size:35px; color:#007bff; font-weight:bolder">Connexion</h1></strong>
            <p class="mb-4" style="text-align:center">Accéder à votre espace de gestion</p>
            <form action="{{ route('login') }}" method="POST">
                @csrf
              <div class="input-group" style="border:2px solid #efefef; margin-bottom:1rem; padding-left:8px">
                <input type="text" name="username" class="form-control  @error('username') is-invalid @enderror" placeholder="Nom d'utilisateur" id="username">
                <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-envelope"></span>
                    </div>
                  </div>
                @error('username')
                <span class="invalid-feedback">
                    {{ $message }}
                </span>
            @enderror
            </div>

              <div class="input-group mb-3"  style="border:2px solid #efefef; margin-bottom:1rem;padding-left:8px">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Mot de passe" id="password">
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
              
              <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Se souvenir de moi</span>
                  <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}/>
                  <div class="control__indicator"></div>
                </label>
                <span class="ml-auto"><a href="#" class="forgot-pass">Mot de passe oublié</a></span> 
              </div>

              <input type="submit" value="Connexion" class="btn btn-block btn-primary">

            </form>
          </div>
        </div>
      </div>
    </div>
@endsection