@extends('layouts.master', ['title'=> "Facture"])

@section('content')
<input type="hidden" name="" data-target="#modal-default" data-toggle="modal" class="info">
<input type="hidden" name="" data-target="#modal-default2" data-toggle="modal" class="infoDetails">
<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    <p style="margin-top: 5px;font-weight: bolder;font-size: 120%;">Etablir une nouvelle facture</p>
                </div>
                <div class="col-3">
                    <a href="{{ route('facture.create', ['retour' => true])}}"><button class="btn btn-primary" id="load">Nouvelle facture</button></a>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
          <h3 class="card-title" style="font-weight: bolder;font-size: 120%;">Liste des factures établies</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Numéro de facture</th>
              <th>Cassier</th>
              <th>Client</th>
              <th>Montant</th>
              <th>Acompte</th>
              <th>Reste</th>
              <th>Status</th>
              <th>Date de création</th>
              <th>Date de modification</th>
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
                        <td>{{ $facture->status}}</td>
                        <td>{{ Carbon\Carbon::parse($facture->created_at)->locale('fr_FR')->isoFormat('LLLL')}}</td>
                        <td>{{ Carbon\Carbon::parse($facture->updated_at)->locale('fr_FR')->isoFormat('LLLL')}}</td>
                        <td>
                            <div class="d-flex">
                                <form action="{{ route('facture.generate', ['facture' => $facture->id]) }}" method="get">
                                    @method('GET')
                                    @csrf
                                    <button type="submit" class="print btn btn-success mr-2" title="Aperçu de la facture"><i class="fas fa-print"></i></button>
                                </form>
                                @if($facture->payements->last()->reste != 0)
                                    <button id="{{ __('button').$facture->id }}" type="button" data-id="{{ $facture->id }}" class="paye btn btn-warning mr-2" title="Payé le reste du montant"><i class="fas fa-dollar-sign"></i></button>
                                @endif
                                <button id="{{ __('details').$facture->id }}" type="button" data-id="{{ $facture->id }}" class="detail btn btn-primary" title="Détails de paiement"><i class="fas fa-info"></i></button>
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
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Paiement reste facture</h4>
                <button type="button" class="ferme btn btn-danger"  data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div >
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
                            </div
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <div class="row">
                    <button type="button" class="btn btn-primary form-control" id="solde_fact">Solder</button>
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
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Paiement reste facture</h4>
                <button type="button" class="ferme btn btn-danger"  data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div >

                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <div class="row">
                    {{-- <button type="button" class="btn btn-primary form-control" id="solde_fact">Solder</button> --}}
                </div>
            </div>
        </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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
<script src="{{ asset('dashboard/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<!-- Page specific script -->
<script>

        var btn = document.getElementById('load');
  btn.addEventListener("click", function(event) {
      btn.innerHTML = "Loading...";
  });

  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false, "lengthChange": false, "paging": true,
    //   "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      "buttons": ["pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

  $('.print').on('click', function(e){
    e.preventDefault();
    var url = $(this).parent().attr('action');
    window.open(url, '_blank');
  });

  $('.paye').on('click', function(e){
      e.preventDefault();
      var idFacture = $(this).attr('data-id');
    $.ajax({
        url:'/paiement/' + idFacture,
        method: 'GET',
        success:function(response){
            $('#reste').val(response.paiement.reste);
            $('#solde_fact').attr('data-id', idFacture);
            $('.info').trigger('click');
       }
    });
  });

  $('#solde_fact').on('click', function(e){
    e.preventDefault();
    var idFacture = $(this).attr('data-id');
    var acompte = $('#acompte').val();
    if(acompte.length <=0){
        $('span.acompte').text('Le montant est obligatoire');
    }else{
        $.ajax({
        url:'/paiement/store',
        method: 'POST',
        data:{facture_id: idFacture, acompte : acompte},
        dataType:'json',
        success:function(response){
            $("#acompte"+idFacture+"").text(response.paiement.acompte);
            $("#reste"+idFacture+"").text(response.paiement.reste);
            if(response.paiement.reste == 0){
                $("#button"+idFacture+"").remove();
            }
            $('.ferme').trigger('click');
            $('span.acompte').text('');
            $('#acompte').val('');
        }
    });
    }

  });
  </script>
@endsection
