@extends('layouts.master', ['title' => 'Votre société'])

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Paramètres</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Configuration</a></li>
                            <li class="breadcrumb-item active">Settings</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <!-- Profile Image -->
                        <div class="card card-danger card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <div>
                                        <i class="fas fa-user-tie" style="font-size:800%"></i>
                                    </div>
                                    <hr>
                                </div>

                                <h3 class="profile-username text-center">
                                    {{ $app->societe->users->where('id', auth()->user()->id)->first()->name }}</h3>

                                <p class="text-muted text-center">
                                    {{ $app->societe->users->where('id', auth()->user()->id)->first()->role }}</p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>{{ $app->societe->configsociete->type_user }}</b> <a
                                            class="float-right">{{ $app->societe->users->where('role', 'admin')->count() }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>{{ $app->societe->configsociete->type_article }}</b> <a
                                            class="float-right">{{ $app->societe->articles->count() }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Factures</b> <a class="float-right">0</a>
                                    </li>
                                </ul>

                                <a href="#" class="btn btn-danger btn-block"><b>Détails</b></a>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card card-primary card-outline">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item pro"><a class="nav-link active" href="#profil"
                                            data-toggle="tab">Profil</a></li>
                                    <li class="nav-item art"><a class="nav-link" href="#article"
                                            data-toggle="tab">{{ $app->societe->configsociete->type_article }}</a></li>
                                    <li class="nav-item app"><a class="nav-link" href="#app"
                                            data-toggle="tab">Application</a></li>
                                    <li class="nav-item fac"><a class="nav-link" href="#facture"
                                            data-toggle="tab">Facture</a></li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="profil">
                                        <div class="post">
                                            <div class="user-block d-flex">
                                                <div class="text-center" style="color: black">
                                                    <div>
                                                        <i class="fas fa-user-tie" style="font-size:800%"></i>
                                                    </div>
                                                    <hr>
                                                    <h3 class="text-center">
                                                        {{ Str::upper($app->societe->users->where('id', auth()->user()->id)->first()->role) }}
                                                    </h3>
                                                </div>
                                                <div class="username">
                                                    <span class="d-flex">
                                                        <h5>Nom d'utilisateur : <a
                                                                href="#">{{ $app->societe->users->where('id', auth()->user()->id)->first()->name }}</a>
                                                        </h5>
                                                    </span><br>
                                                    <span class="d-flex">
                                                        <h5>Email : <a
                                                                href="#">{{ $app->societe->users->where('id', auth()->user()->id)->first()->email }}</a>
                                                        </h5>
                                                    </span><br>
                                                    <span class="d-flex">
                                                        <h5>Téléphone : <a
                                                                href="#">{{ $app->societe->users->where('id', auth()->user()->id)->first()->telephone }}</a>
                                                        </h5>
                                                    </span><br>
                                                </div>
                                            </div>

                                            <!-- /.user-block -->

                                            <input class="form-control form-control-sm btn btn-primary" type="button"
                                                value="Modifier">
                                        </div>
                                        <!-- /.post -->
                                    </div>
                                    <div class="tab-pane" id="article">
                                        @include('partials.pages.tab2', ['app' => $app])
                                    </div>
                                    <div class="tab-pane" id="app">
                                        <form class="form-horizontal">
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" id="inputName"
                                                        placeholder="Name">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" id="inputEmail"
                                                        placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputName2"
                                                        placeholder="Name">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputExperience"
                                                    class="col-sm-2 col-form-label">Experience</label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" id="inputExperience"
                                                        placeholder="Experience"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputSkills"
                                                        placeholder="Skills">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"> I agree to the <a href="#">terms and
                                                                conditions</a>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <button type="submit" class="btn btn-danger">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <div class="card so card-warning card-outline">
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="profil1">
                                        <!-- Post -->
                                        <div class="post">
                                            <div class="user-block d-flex">
                                                <div class="text-center" style="color: black">
                                                    <div class="mt-5">
                                                        <img src="{{ asset('dashboard/img/prod-4.jpg') }}" alt=""
                                                            style="width:100%">
                                                    </div>
                                                    <hr>
                                                </div>
                                                <div class="username">
                                                    <span class="d-flex">
                                                        <h5>Raison Social : <a
                                                                href="#">{{ $app->societe->raisonSocial }}</a>
                                                        </h5>
                                                    </span><br>
                                                    @if ($app->societe->email != null)
                                                        <span class="d-flex">
                                                            <h5>Email : <a href="#">{{ $app->societe->email }}</a>
                                                            </h5>
                                                        </span><br>
                                                    @endif

                                                    @if ($app->societe->telephone != null)
                                                        <span class="d-flex">
                                                            <h5>Téléphone : <a
                                                                    href="#">{{ $app->societe->telephone }}</a>
                                                            </h5>
                                                        </span><br>
                                                    @endif
                                                    @if ($app->societe->adresse != null)
                                                        <span class="d-flex">
                                                            <h5>Adresse : <a href="#">{{ $app->societe->adresse }}</a>
                                                            </h5>
                                                        </span><br>
                                                    @endif

                                                </div>
                                            </div>
                                            <input class="form-control form-control-sm btn btn-warning" type="button"
                                                value="Modifier">
                                        </div>
                                        <!-- /.post -->
                                    </div>
                                </div>
                                <!-- /.tab-content -->
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <div class="modal fade" id="modal-large">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="body_modal"></div>
                </div>
                <div class="modal-footer justify-content-between">
                    <div class="row"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/toastr/toastr.min.js') }}"></script>
    <script>
        $(function() {
            $('.pro').click(function(e) {
                $('.so').show();
            });

            $('.app').click(function(e) {
                $('.so').hide();
            });

            $('.art').click(function(e) {
                $('.so').hide();
            });

            $('.fact').click(function(e) {
                $('.so').hide();
            });
        });
    </script>
    <script src="{{ asset('dashboard/js/custome.js') }}"></script>
@endsection
