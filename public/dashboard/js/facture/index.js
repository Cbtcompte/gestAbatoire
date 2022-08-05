$(function(){
    
    var btn = document.getElementById('load');
    btn.addEventListener("click", function(event) {
        btn.innerHTML = "Loading...";
    });

    $(function () {
        $("#example1").DataTable({
        "responsive": false,
        "ordering": false,
        "lengthChange": false,
        "autoWidth": false,
        "lengthChange": false,
        "paging": true,
        "info":true,
        //   "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        "buttons": ["pdf", "print"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        $('#example2').DataTable({
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        });
    });

    $('.printif').on('click', function(e){
        var idFacture = $(this).attr('data-id');
        $('.listPaiement').hide();
        $('.lacement-paiement').show();
        $.ajax({
            url:'/detail/'+ idFacture,
            method: 'GET',
            beforeSend:function(){
                $('.loading').trigger('click');
            },
            success:function(response){
                $('.listPaiement').show();
                $('.lacement-paiement').hide();
                $('#nomClient_1').html(response.client.name);
                $('#telClient_1').html(response.client.telephone);
                $('#numFact_1').html(idFacture);
                // $('.printIdFact_3').attr('action', '/pdf/reglement/'+idFacture);
                // $('.soldeFact').attr('data-id', idFacture);
                if(response.status == 'SOLDE'){

                    $('#statuFact_1').html(response.status).attr('class', 'btn-success mb-2 ml-1');

                }else{

                    $('#statuFact_1').html(response.status).attr('class', 'btn-danger mb-2 ml-1');
                }
                response.paiement.forEach(element => {
                    console.warn(element);
                    //$('#dataListePaiement').append(`<tr><td>${element.created_at}</td><td>${element.montant_paye}</td><td>${element.acompte}</td><td>${element.reste}</td></tr>`)
                });
            }
        })
    });

    $('.print').on('click', function(e){
        e.preventDefault();
        var url = $(this).parent().attr('action');
        console.warn(url);
        window.open(url, '_blank');
    });

    $('.paye').on('click', function(e){
        $('.formSolde').hide();
        $('.dataloading_3').show();
        e.preventDefault();
        var idFacture = $(this).attr('data-id');
        $('.ferme').trigger('click');
        $.ajax({
            url:'/paiement/' + idFacture,
            method: 'GET',
            beforeSend:function(){
                $('.info').trigger('click');
                $('.dataloading_3').show();
            },
            success:function(response){
                $('#reste').val(response.paiement.reste);
                $('#solde_fact').attr('data-id', idFacture);
                $('.formSolde').show();
                $('.dataloading_3').hide();
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
                        $("#status"+idFacture+"").text('SOLDE');
                    }else{
                        $("#status"+idFacture+"").text('NON SOLDE');
                    }

                    $('.ferme').trigger('click');
                    $('span.acompte').text('');
                    $('#acompte').val('');
                }
            });
        }
    });

    $(".detail").on('click', function(e){
        var idFacture = $(this).attr('data-id');
        $('.dataReglement').hide();
        $('.tableReglement').show();
        $('.tableDetail').hide();
        $('.dataloading').show();
        $.ajax({
            url:'/detail/'+ idFacture,
            method: 'GET',
            beforeSend:function(){
                $('.infoDetails').trigger('click');
            },
            success:function(response){
                $('.regle').html('Détails du règlement de la facture');
                $('.dataReglement').show();
                $('.dataloading').hide();
                $('#dataReste').html('');
                $('#nomClient').html(response.client.name);
                $('#telClient').html(response.client.telephone);
                $('#numFact').html(idFacture);
                $('.stopData').trigger('click');
                $('.printIdFact_3').attr('action', '/pdf/reglement/'+idFacture);
                $('.soldeFact').attr('data-id', idFacture);
                if(response.status == 'SOLDE'){

                    $('#statuFact').html(response.status).attr('class', 'btn-success mb-2 ml-1');

                }else{

                    $('#statuFact').html(response.status).attr('class', 'btn-danger mb-2 ml-1');
                }
                response.paiement.forEach(element => {
                    $('#dataReste').append(`<tr><td>${element.created_at}</td><td>${element.montant_paye}</td><td>${element.acompte}</td><td>${element.reste}</td></tr>`)
                });
            }
        })
    });

    $('.contenu').on('click', function(){
        var idFacture = $(this).attr('data-id');
        $('.dataReglement').hide();
        $('.tableReglement').hide();
        $('.tableDetail').show();
        $('.dataloading').show();
        $.ajax({
            url:'/facture/show/'+ idFacture,
            method: 'GET',
            beforeSend:function(){
                $('.infoDetails').trigger('click');
            },
            success:function(response){
                $('.regle').html('Détails de la Facture');
                $('.dataReglement').show();
                $('.dataloading').hide();
                $('#dataResteDetail').html('');
                $('#dataResteDetail').html('');
                $('#dataResteDetail').html('');
                $('.acompte_1').html(response.paiement.acompte);
                $('.printIdFact_2').attr('action', '/pdf/generate/'+idFacture);
                $('.solde_fact').attr('data-id', idFacture);
                $('.reste').html(response.paiement.reste);
                $('.netPaye').html(response.facture.montant);
                $('#dataResteDetail').html('');
                $('#nomClient').html(response.client.name);
                $('#telClient').html(response.client.telephone);
                $('#numFact').html(idFacture);
                $('.stopData').trigger('click');
                if(response.status == 'SOLDE'){
                    $('#statuFact').html(response.status).attr('class', 'btn-success mb-2 ml-1');
                    $('.solde_fact').attr('style', 'display:none');
                }else{
                    $('#statuFact').html(response.status).attr('class', 'btn-danger mb-2 ml-1');
                    $('.solde_fact').attr('style', '');
                }

                response.items.forEach(element => {
                    $('#dataResteDetail').append(`<tr><td>${element.sous_article}</td><td>${element.qte}</td><td>${element.prix}</td><td>${element.montant}</td></tr>`)
                });
            }
        })
    });
});