@extends('layouts.master', ['title' => 'Etablir une facture'])

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <p style="margin-top: 5px;font-weight: bolder;font-size: 120%;">Consulter la liste des factures établir</p>
                    </div>
                    <div class="col-3">
                        <a href="{{ route('facture.index', ['retour' => true])}}"><button class="btn btn-primary" id="load">Liste des factures</button></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <input type="hidden" name="facture_id" class="facture_id" value="{{ $id }}">
            <div class="card-body">
                <div class="alert alert-success" id="client_message" style="display:none">

                </div>
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
                        <button class="btn btn-primary" id="add_client" data-toggle="modal" data-target="#modal-default">Ajouter un client</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-3 form-group">
                        <h5>Article</h5>
                        <select name="client" id="article" class="form-control">
                            <option value="">----Choisir un article----</option>
                            @foreach ($articles as $article)
                                <option value="{{ $article->id }}">{{ $article->libelle }}</option>
                            @endforeach
                        </select>
                        <span class="article invalid-feedback" style="display:block"></span>
                    </div>
                    <div class="col-3 form-group" id="sa">
                        <h5>Sous Article</h5>
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
    </div>

    <div class="modal fade" id="modal-default" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Ajouter un client</h4>
                    <button type="button" class="btn btn-danger"  data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div >
                        <form action="#" id="form" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Nom et Prénom</label>
                                <input type="text" name="name" id="name" class="form-control"/>
                                <div class="invalid-feedback" style="display:block">
                                    <span class="name"></span>
                                </div

                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" id="email" class="form-control"/>
                                <div class="invalid-feedback" style="display:block">
                                    <span class="email"></span>
                                </div
                            </div>
                            <div class="form-group">
                                <label>Téléphone</label>
                                <input type="tel" name="telephone" id="telephone" class="form-control"/>
                                <div class="invalid-feedback" style="display:block">
                                    <span class="telephone"></span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <div class="row">
                        <button type="button" class="btn btn-primary offset-10" id="save" data-dismiss="modal">Enregistrer</button>
                    </div>
                </div>
            </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section('script')

<script>

var article, sous_article, el, cal, client, qte, num = 0, prix, saveCal = 0;
var btn = document.getElementById('load');
btn.addEventListener("click", function(event) {
    btn.innerHTML = "Loading...";
});


$(function(){

    $('#article').on('change', function(e){
        article = $('#article option:selected').val();
        el = document.getElementById('sous_article');
        el.innerHTML = '<option value="">----Sous article----</option>';
        if(article == ''){
            $('#prix').html('');
            $('#qte').html('');
            $('#button').html('');
        }else{
            $.ajax({
                url: '/article/'+article,
                method: 'GET',
                dataType: 'json',
                success:function(response){

                        $('#sa').show();
                        var data = response.article;
                    data.forEach(element => {
                        el.innerHTML += '<option value="'+element.id+'">'+element.libelle+'</option>';
                    });


                },

            });
        }
    });

    $(document).on('change', '#sous_article', function(e){
        e.stopPropagation();
        e.preventDefault();
        sous_article = $('#sous_article option:selected').val();
        if(sous_article == ''){
            $('#prix').html('');
            $('#qte').html('');
            $('#button').html('');
        }else{
            $.ajax({
            url: '/prix_article/'+sous_article,
            method: 'GET',
            dataType: 'json',
            success:function(response){
                if (response.prix == 0) {
                    $('#prix').html(`<h5>Prix unitaire</h5>
                    <input type="text" name="prix" id="prix_val" class="form-control" value=""><span class="prix invalid-feedback" style="display:block"></span>`);
                }else{
                    $('#prix').html(`<h5>Prix unitaire</h5>
                <input type="text" name="prix" disabled id="prix_val" class="form-control" value="${response.prix}">
                <span class="prix invalid-feedback" style="display:block"></span>`);
                }

                $('#qte').html(`<h5>Quantité</h5>
                <input type="text" name="qte" id="qte_val" class="form-control" value=""><span class="qte invalid-feedback" style="display:block"></span>`);
                $('#button').html(`<h5></h5>
                <input type="submit" name="add" id="ajouter" class="btn btn-primary" style="margin-top:14%" value="Ajouter">`);
            }
        });
        }

    });

    $(document).on('keyup', '#qte_val', function(e){
        e.stopPropagation();
        e.preventDefault();

        var remise = $('.remise_val').html();
    });

    $('#save').on('click', function(e){
        e.preventDefault();
        $.each({'name':'', 'email':'', 'telephone':''}, function(index){
            $('span.'+index).text('');
        });
        var data =  $('#form').serialize();

       $.ajax({
           url:'/client/store',
           type:'post',
           data: data,
           dataType:'json',
           success:function(Response){
                $('#client_message').text('Client ajouté avec succès');
                $('#client_message').show();
                setTimeout((e) => {
                    $('#client_message').fadeOut("slow");
                }, 3000);
                $('#client').append('<option value="'+Response.client.id+'" selected>'+Response.client.name+'</option>');
           },
           error:function(jqXHR){
            $.each(jqXHR.responseJSON.errors, function(index, element){
                    $('span.'+index).text(element[0]);
                });
                $('#add_client').trigger('click');
           }
       });
    });

    $(document).on('click', '#ajouter', function(e){
        e.stopPropagation();
        e.preventDefault();
        qte = $('#qte_val').val();
        prix = $('#prix_val').val();
        cal = qte*prix;
        saveCal = saveCal+cal;
        var client = $('#client option:selected').val();
        $.each({'client_id':'', 'qte':'', 'sous_article_id':'','prix':'', 'article':''}, function(index){
                $('span.'+index).text('');
            });
        $.ajax({
            url:'/items/store',
            method:'POST',
            data:{client_id : client , sous_article_id : sous_article , qte : qte , montant : cal , prix : prix, facture_id : $('.facture_id').val()},
            dataType:'json',
            success:function(response){
                // $('#prix').html('');
                // $('#qte').html('');
                // $('#button').html('');
                $('#table_body').append(`<tr id="item`+response.tmp.id+`">
                            <td>`+(++num)+`</td>
                            <td>`+response.article.libelle+`(`+response.sous.libelle+`)</td>
                            <td>`+response.tmp.qte+`</td>
                            <td>`+response.tmp.prix+`</td>
                            <td>`+response.tmp.montant+`</td>
                            <td><button type="button" class="btn btn-danger croix" data-id="`+response.tmp.id+`" aria-label="Close"><span aria-hidden="true" style="color:white">&times;</span></button></td>
                        </tr>`
                );
                $('.validateFact').show();
                $('.total_val').html(''+saveCal+'');
                $('.net_val').html(''+saveCal+'');
                // $('#article').val("").attr('selected');
                // $('#sous_article').val("").attr('selected');
            },
            error:function(jqXHR){
                $.each(jqXHR.responseJSON.errors, function(index, element){
                        $('span.'+index).text(element[0]);
                    });
            }
        });
    });

    $(document).on('click','.croix', function(e){
        e.preventDefault();
        var ligne = $(this).attr('data-id');
        $.ajax({
            url:'/items/delete/'+ligne,
            method:'GET',
            success:function(response){
                saveCal = saveCal-response.total;
                $('.total_val').html(''+saveCal+'');
                $('.net_val').html(''+saveCal+'');
                $('#item'+ligne+'').remove();
                if($('#table_body').html()==""){
                    $('.validateFact').hide();
                }
            }
        });
    });

    $('#factEtablir').on('click', function(e){
        e.stopPropagation();
        e.preventDefault();
        var factureId = $('.facture_id').val();
        var acompte = $('#acompte').val();
        if(acompte == undefined){
            $('.accompte').text('Veuillez entrez le montant payé');
        }else{
            $.ajax({
            url:'/facture/etablir/'+factureId,
            method:'GET',
            data:{acompte :  acompte},
            dataType:'json',
            success:function(response){
                $('.facture_id').val(response.id);
                $('.total_val').html('');
                $('.net_val').html('');
                $('#table_body').html('');
                $('#acompte').val('0');
                $('.validateFact').hide();
                window.open('/pdf/generate/'+factureId , '_blank');
            }
        });
        }
    })
});
    </script>
@endsection
