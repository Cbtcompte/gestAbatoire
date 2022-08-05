@extends('layouts.master', ['title'=> "Facture"])

@section('content')
<input type="hidden" name="" data-target="#modal-default" data-toggle="modal" class="info">
<input type="hidden" name="" data-target="#modal-default2" data-toggle="modal" class="infoDetails">
<input type="hidden" name="" data-target="#modal-loading" data-toggle="modal" class="loading">
<div class="ml-2 mr-2 mt-4">
    <div class="card">
        <div class="card-header">
            <div class="">
                <div class="col-3">
                    <h3 class="card-title" style="font-weight: bolder;font-size: 120%;">Liste des factures</h3>
                </div>
                <div style="float:right;" class="col-3">
                    <a href="{{ route('facture.create', ['retour' => true])}}"><button class="btn btn-primary" id="load">Nouvelle facture</button></a>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped table-responsive">
            <thead>
            <tr>
              <th>N°</th>
              <th>Cassier</th>
              <th>Client</th>
              <th>Montant Total</th>
              <th>Acompte</th>
              <th>Reste</th>
              <th>Status</th>
              <th>Date de création</th>
              {{-- <th>Date de modification</th> --}}
              <th></th>
            </tr>
            </thead>
            <tbody>
                @foreach($factures as $facture)
                    <tr>
                        <td>{{ $facture->id}}</td>
                        <td>{{ $facture->user->name}}</td>
                        <td>{{ $facture->client->name}}</td>
                        <td>{{ $facture->montant}}</td>
                        <td id="{{ __('acompte').$facture->id }}">{{ $facture->payements->last()->acompte}}</td>
                        <td id="{{ __('reste').$facture->id }}">{{ $facture->payements->last()->reste}}</td>
                        @if($facture->payements->last()->reste == 0)
                            <td><span class="badge badge-success" id="{{ __('status').$facture->id }}"></span></td>
                        @else
                            <td><span class="badge badge-danger" id="{{ __('status').$facture->id }}"></span></td>
                        @endif
                        <td>{{ Carbon\Carbon::parse($facture->created_at)->locale('fr_FR')->isoFormat('LLLL')}}</td>
                        {{-- <td>{{ Carbon\Carbon::parse($facture->updated_at)->locale('fr_FR')->isoFormat('LLLL')}}</td> --}}
                        <td>
                            {{-- <div class="btn-group">
                                <button type="button" class="btn btn-danger">Action</button>
                                <button type="button" class="btn btn-danger dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="true">
                                  <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu" style>
                                    <form action="{{ route('facture.generate', ['facture' => $facture->id]) }}" method="get" class="dropdown-item">
                                        @method('GET')
                                        @csrf
                                        <button type="submit" class="print btn btn-success" title="Aperçu de la facture"> Imprimer</button>
                                    </form>
                                    @if($facture->payements->last()->reste != 0)
                                        <button id="{{ __('button').$facture->id }}" type="button" data-id="{{ $facture->id }}" class="dropdown-item paye btn btn-warning" title="Payé le reste du montant"> Soldé</button>
                                    @endif
                                    <button id="{{ __('details').$facture->id }}" type="button" data-id="{{ $facture->id }}" class="dropdown-item detail btn btn-primary" title="Détails de paiement">Détails</button>
                                </div>
                              </div> --}}
                            <div class="d-flex">
                                {{-- <form action="{{ route('facture.generate', ['facture' => $facture->id]) }}" method="get">
                                    @method('GET')
                                    @csrf
                                </form> --}}
                                <button type="button" data-id="{{ $facture->id }}" class="printif btn btn-success mr-2" title="Aperçu et impresion de la facture"><i class="fas fa-print"></i></button>
                                @if($facture->payements->last()->reste != 0)
                                    <button id="{{ __('button').$facture->id }}" type="button" data-id="{{ $facture->id }}" class="paye btn btn-warning mr-2" title="Payé le reste du montant"> Solder</button>
                                @endif
                                <span class="btn btn-primary dropdown-toggle mr-2" data-toggle="dropdown" aria-expanded="true">
                                  Détails
                                </span>
                                <div class="dropdown-menu" role="menu" style>
                                    <button id="{{ __('details').$facture->id }}" type="button" data-id="{{ $facture->id }}" class="detail mr-2 dropdown-item">Règlement de la facture</button>
                                    <hr>
                                    <button id="{{ __('contenu').$facture->id }}" type="button" data-id="{{ $facture->id }}" class="contenu mr-2 dropdown-item">Contenu de la facture</button>
                                </div>
                                <button id="{{ __('supprimer').$facture->id }}" type="button" data-id="{{ $facture->id }}" class="supprimer btn btn-danger" title="Supprimer la facture"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
            @endforeach
        </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
</div>
<div class="modal fade" id="modal-default" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="formSolde">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Remboursement</h4>
                    <button type="button" class="ferme btn btn-danger"  data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" id="form" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Montant dû</label>
                            <input type="text" disabled name="reste" id="reste" class="form-control" value=""/>
                        </div>
                        <div class="form-group">
                            <label>Montant payé</label>
                            <input type="number" name="acompte" id="acompte" class="form-control"/>
                            <div class="invalid-feedback" style="display:block">
                                <span class="acompte"></span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <div class="row">
                        <div class="col-6">
                            <button type="button" class="btn btn-primary form-control mr-3" id="solde_fact">Solder</button>
                        </div>
                        <div class="col-6">
                            <button type="button" data-dismiss="modal" class="btn btn-danger form-control">Annuler</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dataloading_3">
                <div class="modal-body">
                    <div class="lacement-facture">
                        <div class="d-flex">
                            <img src="{{ asset('dashboard/img/load.gif') }}" alt="loading..." srcset="" width="30%">
                            <p style="font-weight: 600; margin-top:8%; font-size:120%"> Chargement en cours...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-default2" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="dataReglement">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title regle"></h4>
                    <button type="button" class="ferme btn btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="row">
                            <div class="offset-1 col-6">
                                <p>
                                    <span><strong>Client : </strong></span>
                                    <span id="nomClient"></span>
                                </p>
                            </div>
                            <div class="col-5">
                                <span><strong>Téléphone : </strong></span>
                                <span id="telClient"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="offset-1 col-6">
                                <p>
                                    <span><strong>N° de facture : </strong></span>
                                    <span id="numFact"></span>
                                </p>
                            </div>
                            <div class="col-5">
                                <span><strong>Status : </strong></span>
                                <span id="statuFact"></span>
                            </div>
                        </div>
                        <div class="tableReglement">
                            <div class="table">
                                <table class="table table-bordered table-striped table-responsive">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Montant Payé</th>
                                        <th>Accompte total</th>
                                        <th>Reste à payer</th>
                                    </tr>
                                    </thead>
                                    <tbody id="dataReste">
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <div class="row">
                                <button type="button" data-id="" class="btn btn-primary form-control mr-2 soldeFact offset-2 col-4 paye">Solde</button>
                                <form class="printIdFact_3" action="" method="get">
                                    @csrf
                                    @method('GET')
                                    <button type="button" class="btn btn-success form-control ventFact print">Voir la facture</button>
                                </form>
                            </div>
                        </div>
                        <div class="tableDetail">
                            <div class="table">
                                <table class="table table-bordered table-striped table-responsive">
                                    <thead>
                                    <tr>
                                        <th>{{ $configApp->type_article }}</th>
                                        <th>Quantité</th>
                                        <th>Prix unitaire</th>
                                        <th>Montant</th>
                                    </tr>
                                    </thead>
                                    <tbody id="dataResteDetail">
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <p><span class="alert-link">Net à payer : </span><span class="netPaye"></span><span class="mr-2"> FCFA</span></p>
                                    <p><span class="alert-link">Acompte : </span><span class="acompte_1"></span><span class="mr-2"> FCFA</span></p>
                                    <p><span class="alert-link">Reste : </span><span class="reste"></span><span class="mr-2"> FCFA</span></p>
                                </div>
                                <div class="col-6">
                                    <p><button type="button" data-id="" class="btn btn-primary form-control mr-2 solde_fact paye">Solde</button></p>
                                    <form class="printIdFact_2" action="" method="get">
                                        @csrf
                                        @method('GET')
                                        <button type="button" class="btn btn-success form-control vent_fact print">Voir la facture</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="dataloading">
                <div class="modal-body">
                    <div class="lacement-facture">
                        <div class="d-flex">
                            <img src="{{ asset('dashboard/img/load.gif') }}" alt="loading..." srcset="" width="30%">
                            <p style="font-weight: 600; margin-top:8%; font-size:120%"> Chargement en cours...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-loading" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="listPaiement">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Impression de facture</h4>
                    <button type="button" class="ferme btn btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="offset-1 col-6">
                            <p>
                                <span><strong>Client : </strong></span>
                                <span id="nomClient_1"></span>
                            </p>
                        </div>
                        <div class="col-5">
                            <span><strong>Téléphone : </strong></span>
                            <span id="telClient_1"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="offset-1 col-6">
                            <p>
                                <span><strong>N° de facture : </strong></span>
                                <span id="numFact_1"></span>
                            </p>
                        </div>
                        <div class="col-5">
                            <span><strong>Status : </strong></span>
                            <span id="statuFact_1"></span>
                        </div>
                    </div>
                    <div class="table">
                        <table class="table table-bordered table-striped table-responsive">
                            <thead>
                            <tr>
                                <th>Type de paiement</th>
                                <th>Date de paiement</th>
                                <th>Montant payé</th>
                                <th>Reste</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody id="dataListePaiement">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="lacement-paiement">
                <div class="modal-body">
                    <div class="d-flex">
                        <img src="{{ asset('dashboard/img/load.gif') }}" alt="loading..." srcset="" width="30%">
                        <p style="font-weight: 600; margin-top:8%; font-size:120%"> Chargement en cours...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script src="{{ asset('dashboard/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/facture/index.js') }}"></script>
@endsection
