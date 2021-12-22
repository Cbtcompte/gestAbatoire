@extends('layouts.master',  ['title' => 'Dashboard'])

@section('content')
    @include('partials.nav')
    @include('partials.aside')
    <div class="content-wrapper iframe-mode" data-widget="iframe" data-loading-screen="750">
        <div class="nav navbar navbar-expand navbar-white navbar-light border-bottom p-0">
          <div class="nav-item dropdown">
            <a class="nav-link bg-danger dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Close</a>
            <div class="dropdown-menu mt-0">
              <a class="dropdown-item" href="#" data-widget="iframe-close" data-type="all">Close All</a>
              <a class="dropdown-item" href="#" data-widget="iframe-close" data-type="all-other">Close All Other</a>
            </div>
          </div>
          <a class="nav-link bg-light" href="#" data-widget="iframe-scrollleft"><i class="fas fa-angle-double-left"></i></a>
          <ul class="navbar-nav overflow-hidden" role="tablist"></ul>
          <a class="nav-link bg-light" href="#" data-widget="iframe-scrollright"><i class="fas fa-angle-double-right"></i></a>
          <a class="nav-link bg-light" href="#" data-widget="iframe-fullscreen"><i class="fas fa-expand"></i></a>
        </div>
        <div class="tab-content">
          <div class="tab-empty">
            <h2 class="display-4">
              <div style="display:block" data-widget="treeview" role="menu" data-accordion="false">
                <h1 class="font-weight-bolder">Bienvenue sur {{ $app->nom }}</h1>
                <center>
                  <button id="bt" class="btn btn-primary">Accéder au tableau de bord</button>
                  
                </center>
              </div>
              {{-- @include('admin.dashboard') --}}
            </h2>
          </div>
          <div class="tab-loading">
            <div>
              <h2 class="display-4"><img src="{{ asset('dashboard/img/img.gif')}}" alt="coq"></h2>
            </div>
          </div>
        </div>
      </div>
      <script>
                    var button = document.getElementById('bt');
                    button.addEventListener('click', function(e){
                      var acc = document.getElementById('ac');
                       acc.click();
                    })
                  </script>
    @include('partials.footer')
@endsection
