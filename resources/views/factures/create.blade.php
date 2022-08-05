@extends('layouts.master', ['title' => 'Etablir une facture'])

@section('content')
    <div class="container mt-4">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">Facture</a></li>
                        <li class="breadcrumb-item active">Etablir une facture</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <div class="breadcrumb float-sm-right">
                            <a href="{{ route('facture.index', ['retour' => true]) }}"><button class="btn btn-primary"
                                    id="load">Liste des factures</button></a>
                        </div>
                    </div>
                <!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <div class="card">
            <input type="hidden" name="facture_id" class="facture_id" value="{{ $id }}">
            <div class="card-body">
                <div class="row">
                    <div class="col-2">
                        <p>Choisir le client</p>
                    </div>
                    <div class="col-4 form-group">
                        <select name="client" id="client" class="form-control">
                            <option value="">----Choisir un client----</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>
                        <span class="client_id invalid-feedback" style="display:block"></span>
                    </div>
                    <div class="col-4">
                        <button class="btn btn-primary" id="add_client" data-toggle="modal"
                            data-target="#modal-default">Ajouter un client</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-3 form-group">
                        <h5>{{ $configApp->type_article }}</h5>
                        <select name="client" id="article" class="form-control">
                            <option value="">----Choisir un article----</option>
                            @foreach ($articles as $article)
                                <option value="{{ $article->id }}">{{ $article->libelle }}</option>
                            @endforeach
                        </select>
                        <span class="article invalid-feedback" style="display:block"></span>
                    </div>
                    <div class="col-3 form-group" id="sa">
                        <h5>{{ $configApp->type_sousarticle }}</h5>
                        <select name="sous_article" id="sous_article" class="form-control">
                            <option value="">----Sous article----</option>
                        </select>
                        <span class="sous_article_id invalid-feedback" style="display:block"></span>
                    </div>
                    <div class="col-2 form-group" id="prix">

                    </div>
                    <div class="col-2 form-group" id="qte">

                    </div>
                    <div class="col-2 form-group" id="button">

                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="card card-outline card-primary">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5 form-group">
                                <h5>Montant Payé</h5>
                                <input type="number" min="0" name="acompte" id="acompte" class="form-control">
                                <span class="acompte invalid-feedback" style="display:block"></span>
                            </div>
                        </div>

                    </div>
                </div><br>
                <div class="card card-outline card-primary">
                    <div class="card-header text-center">
                        <h5>Liste des lignes de la facture</h5>
                    </div>
                    <div class="card-body">
                        <table id="table" class="table table-borderd border-striped">
                            <thead>
                                <th>N°</th>
                                <th>Article</th>
                                <th>Qte</th>
                                <th>Prix unitaire</th>
                                <th>Montant</th>
                                <th></th>
                            </thead>
                            <tbody id="table_body"></tbody>
                        </table>
                        <div class="row validateFact" style="display: none">
                            <div class="offset-5 col-5 mt-5">
                                <button class="btn btn-primary" id="factEtablir">Etablir la facture</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card card-outline card-primary">
                    <div class="card-header text-center">
                        <h5>Récapitulatif</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h6>Total :</h6>
                            </div>
                            <div class="col-6" id="total">
                                <p class="total_val">0</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h6>Remise :</h6>
                            </div>
                            <div class="col-6" id="remise">
                                <p class="remise_val">0</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h6>Net à payer :</h6>
                            </div>
                            <div class="col-6" id="remise">
                                <p class="net_val">0</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="" class="start-loading" data-toggle="modal" data-target="#modal-loading">
    </div>
    <div class="modal fade" id="modal-loading" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="lacement-facture">
                        <div class="d-flex">
                            <img src="{{ asset('dashboard/img/load.gif') }}" alt="loading..." srcset="" width="30%">
                            <p style="font-weight: 600; margin-top:8%; font-size:120%"> Enregistrement de la facture...</p>
                        </div>
                    </div>
                    <div class="apercu">
                        <div style="text-align: center">
                            <p style="font-weight: 600; font-size:120%">Facture enregistrée avec succès.</p>
                            <div class="d-flex offset-2">
                                <button type="button" class="btn btn-success mr-2" id="aperçu">Voir un aperçu de la facture</button>
                                <button type="button" class="btn btn-danger stop" data-dismiss="modal">Annuler</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-default" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Ajouter un client</h4>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="times" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <form action="#" id="form" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Nom et Prénom</label>
                                <input type="text" name="name" id="name" class="form-control" />
                                <div class="invalid-feedback" style="display:block">
                                    <span class="name"></span>
                                </div </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" id="email" class="form-control" />
                                    <div class="invalid-feedback" style="display:block">
                                        <span class="email"></span>
                                    </div </div>
                                    <div class="form-group">
                                        <label>Téléphone</label>
                                        <input type="tel" name="telephone" id="telephone" class="form-control" />
                                        <div class="invalid-feedback" style="display:block">
                                            <span class="telephone"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <div class="row">
                        <button type="button" class="btn btn-primary" id="save">Enregistrer</button>
                        <div class="waiting_loading"></div>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ asset('dashboard/js/facture/create.js') }}"></script>
    <script>
       
      
    </script>
@endsection
