
$(function(){
       var article, sous_article, el, cal, client, qte, num = 0,
            prix, saveCal = 0;
        var btn = document.getElementById('load');
        btn.addEventListener("click", function(event) {
            btn.innerHTML = "Loading...";
        });

    $('#article').on('change', function(e) {
        article = $('#article option:selected').val();
        el = document.getElementById('sous_article');
        el.innerHTML = '<option value="">----Sous article----</option>';
        if (article == '') {
            $('#prix').html('');
            $('#qte').html('');
            $('#button').html('');
        } else {
            $.ajax({
                url: '/article/' + article,
                method: 'GET',
                dataType: 'json',
                success: function(response) {

                    $('#sa').show();
                    var data = response.article;
                    data.forEach(element => {
                        el.innerHTML += '<option value="' + element.id + '">' +
                            element.libelle + '</option>';
                    });
                },
            });
        }
    });

    $(document).on('change', '#sous_article', function(e) {
        e.stopPropagation();
        e.preventDefault();
        sous_article = $('#sous_article option:selected').val();
        if (sous_article == '') {
            $('#prix').html('');
            $('#qte').html('');
            $('#button').html('');
        } else {
            $.ajax({
                url: '/prix_article/' + sous_article,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.prix == 0) {
                        $('#prix').html(
                            `<h5>Prix unitaire</h5>
            <input type="text" name="prix" id="prix_val" class="form-control" value=""><span class="prix invalid-feedback" style="display:block"></span>`
                            );
                    } else {
                        $('#prix').html(`<h5>Prix unitaire</h5>
        <input type="text" name="prix" disabled id="prix_val" class="form-control" value="${response.prix}">
        <span class="prix invalid-feedback" style="display:block"></span>`);
                    }

                    $('#qte').html(
                        `<h5>Quantité</h5>
        <input type="text" name="qte" id="qte_val" class="form-control" value=""><span class="qte invalid-feedback" style="display:block"></span>`
                        );
                    $('#button').html(
                        `<h5></h5>
        <input type="submit" name="add" id="ajouter" class="btn btn-primary" style="margin-top:14%" value="Ajouter">`);
                }
            });
        }

    });

    $(document).on('keyup', '#qte_val', function(e) {
        e.stopPropagation();
        e.preventDefault();

        var remise = $('.remise_val').html();
    });

    $('#save').on('click', function(e) {
        e.preventDefault();
        $.each({
            'name': '',
            'email': '',
            'telephone': ''
        }, function(index) {
            $('span.' + index).text('');
        });
        var data = $('#form').serialize();

        $.ajax({
            url: '/client/store',
            type: 'post',
            data: data,
            dataType: 'json',
            beforeSend : function(){
                $('#save').text('Patientez svp...')
                $('#save').attr('disabled', 'disabled')
                $('.waiting_loading').html(`<img src="/dashboard/img/load.gif" alt="loading..." srcset="" width="30%">`)
            },
            success: function(Response) {
                $('#save').text('Enregistrer')
                $('.waiting_loading').html('')
                toastr.success('Client ajouté avec succès')
                $('#times').trigger('click');
                                $('#save').removeAttr('disabled')

                $('#client').append('<option value="' + Response.client.id +
                    '" selected>' + Response.client.name + '</option>');
            },
            error: function(jqXHR) {
                $.each(jqXHR.responseJSON.errors, function(index, element) {
                    $('span.' + index).text(element[0]);
                    
                    toastr.error(element[0])
                });
                $('#save').removeAttr('disabled')
                $('#save').text('Enregistrer')
                $('.waiting_loading').html('')
            }
        });
    });

    $(document).on('click', '#ajouter', function(e) {
        e.stopPropagation();
        e.preventDefault();
        qte = $('#qte_val').val();
        prix = $('#prix_val').val();
        cal = qte * prix;
        saveCal = saveCal + cal;
        var client = $('#client option:selected').val();
        $.each({
            'client_id': '',
            'qte': '',
            'sous_article_id': '',
            'prix': '',
            'article': ''
        }, function(index) {
            $('span.' + index).text('');
        });
        $.ajax({
            url: '/items/store',
            method: 'POST',
            data: {
                client_id: client,
                sous_article_id: sous_article,
                qte: qte,
                montant: cal,
                prix: prix,
                facture_id: $('.facture_id').val()
            },
            dataType: 'json',
            beforeSend:function(){
                $('#ajouter').attr('disabled','disabled');
            },
            success: function(response) {
                $('#prix').html('');
                $('#qte').html('');
                $('#button').html('');
                $('#table_body').append(`<tr id="item` + response.tmp.id + `">
                    <td>` + (++num) + `</td>
                    <td>` + response.article.libelle + `(` + response.sous.libelle + `)</td>
                    <td>` + response.tmp.qte + `</td>
                    <td>` + response.tmp.prix + `</td>
                    <td>` + response.tmp.montant + `</td>
                    <td><button type="button" class="btn btn-danger croix" data-id="` + response.tmp.id + `" aria-label="Close"><span aria-hidden="true" style="color:white">&times;</span></button></td>
                </tr>`);
                $('.validateFact').show();
                $('.total_val').html('' + saveCal + '');
                $('.net_val').html('' + saveCal + '');
                $('#ajouter').removeAttr('disabled');
                toastr.success('Achat ajouter avec succès')
                // $('#article').val("").attr('selected');
                // $('#sous_article').val("").attr('selected');
            },
            error: function(jqXHR) {
                $('#ajouter').removeAttr('disabled');
                $.each(jqXHR.responseJSON.errors, function(index, element) {
                    $('span.' + index).text(element[0]);
                    toastr.error(element[0])
                });
            }
        });
    });

    $(document).on('click', '.croix', function(e) {
        e.preventDefault();
        var ligne = $(this).attr('data-id');
        $.ajax({
            url: '/items/delete/' + ligne,
            method: 'GET',
            beforeSend:function(){
                $(this).attr('disabled', 'disabled');
            },
            success: function(response) {
                saveCal = saveCal - response.total;
                $('.total_val').html('' + saveCal + '');
                $('.net_val').html('' + saveCal + '');
                $('#item' + ligne + '').remove();
                toastr.success('Ligne supprimée');
                if ($('#table_body').html() == "") {
                    $('.validateFact').hide();
                }
            }
        });
    });
    var saveId;

    $('#factEtablir').on('click', function(e) {
        e.stopPropagation();
        e.preventDefault();
        var factureId = $('.facture_id').val();
        saveId = factureId;
        var acompte = $('#acompte').val();
        $(".lacement-facture").show();
        $(".apercu").hide();
        if (acompte == undefined) {
            $('.accompte').text('Veuillez entrez le montant payé');
        } else {
            $.ajax({
                url: '/facture/etablir/' + factureId,
                method: 'GET',
                data: {
                    acompte: acompte
                },
                dataType: 'json',
                beforeSend: function() {
                    $(".start-loading").trigger('click');
                },
                success: function(response) {
                    $(".apercu").show();
                    $(".lacement-facture").hide();
                    $('.facture_id').val(response.id);
                    $('.total_val').html('0');
                    $('.net_val').html("0");
                    $('#table_body').html('');
                    $('#acompte').val('0');
                    $('.validateFact').hide();
                }
            });
        }
    });

    $('#aperçu').on('click', function(e){
        $(".lacement-facture").show();
        $(".apercu").hide();
        $(".stop").trigger('click');
        window.open('/pdf/generate/'+saveId , '_blank');
    });

});
