@extends('layouts.master',  ['title' => 'Dashboard'])


@section('content')
    @include('partials.nav')
    @include('partials.aside')
    <div class="content-wrapper iframe-mode" data-widget="iframe" data-loading-screen="750">
        <div class="nav navbar navbar-expand navbar-white navbar-light border-bottom p-0">
          <div class="nav-item dropdown">
            <a class="nav-link bg-danger dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Close</a>
            <div class="dropdown-menu mt-0">
              <a class="dropdown-item" href="#" data-widget="iframe-close" data-type="all">Fermer tous</a>
              <a class="dropdown-item" href="#" data-widget="iframe-close" data-type="all-other">Fermer les autres onglets</a>
            </div>
          </div>
          <a class="nav-link bg-light" href="#" data-widget="iframe-scrollleft"><i class="fas fa-angle-double-left"></i></a>
          <ul class="navbar-nav overflow-hidden" role="tablist"></ul>
          <a class="nav-link bg-light" href="#" data-widget="iframe-scrollright"><i class="fas fa-angle-double-right"></i></a>
          <a class="nav-link bg-light" href="#" data-widget="iframe-fullscreen"><i class="fas fa-expand"></i></a>
        </div>
        <div class="tab-content">
          <div class="tab-pane fade" id="panel-index" role="tabpanel" aria-labelledby="tab-index">
            {{-- <iframe src="{{ route('admin.dashboard') }}" style="min-height:85vh"></iframe> --}}
          </div>
          <div class="tab-empty">
            <h2 class="display-4">
            </h2>
          </div>
          <div class="tab-loading">
            <div>
                <img class="animation__wobble" src="{{ asset('dashboard/img/img.gif')}}" alt="coq">
            </div>
          </div>
        </div>
      </div>
    @include('partials.footer')
@endsection

