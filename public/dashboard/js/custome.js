$ (function () {
  var text = '', name = '';
  $ ('#example1').DataTable ({
    responsive: true,
    autoWidth: false,
    lengthChange: false,
    paging: true,
    pageLength: 5,
    language: {
      emptyTable: 'Aucune donnée disponible',
      info: 'Affiche _START_ sur _END_ pour _TOTAL_ données',
      infoEmpty: 'Affiche 0 sur 0 pour 0 données',
      infoFiltered: '',
      loadingRecords: 'Chargement...',
      processing: 'Processing...',
      searchPlaceholder: 'Recherche...',
      search: '',
      zeroRecords: 'Aucune donnée trouvé',
      paginate: {
        first: 'Premier',
        last: 'Dernier',
        next: 'Suivant',
        previous: 'Précédent',
      },
    },
  });

  $ ('#example1_wrapper .col-md-6:eq(0)').append (
    `<button class='btn btn-primary addA'><i class="fas fa-plus mr-2"></i>Ajouter</button>`
  );
  $ ('#example1_wrapper .col-md-6:eq(1) #example1_filter label').attr (
    'class',
    'form-group'
  );

  $ (document).on ('click', '.show_btn', function (e) {
    e.stopPropagation ();
    e.preventDefault ();
    name = $ ('#example1').attr ('data-name2');
    var id = $ (this).attr ('data-id');
    $.ajax ({
      url: '/article/' + id,
      method: 'GET',
      data: {
        type: 2,
      },
      dataType: 'json',
      beforeSend: function () {
        $ ('.modal-title').html (name);
        $ ('#modal-large').modal ('show');
        $ ('.modal-dialog').attr ('class', 'modal-dialog modal-lg');
        $ ('.body_modal').html (
          `<div style="text-align:center"><img src="/dashboard/img/load.gif" width="150"><p style="font-size:35px">Chargement...</p></div>`
        );
        $ ('.modal-footer .row').html ('');
      },
      success: function (response) {
        $ ('.body_modal').html (response.zone);
      },
    });
  });

  $ (document).on ('click', '.addA', function (e) {
    e.stopPropagation ();
    e.preventDefault ();
    name = $ ('#example1').attr ('data-name');
    $ ('.modal-title').html (name);
    $ ('.modal-dialog').attr ('class', 'modal-dialog');
    $ ('.body_modal').html (`<div class="form-group">
            <label>Libelle</label>
            <input type="text" class="form-control addInput">
            <span class="libelle" style="color:red"></span>
        </div>`);
    $ ('.modal-footer .row').html (
      `<button class="btn btn-primary saveA">Sauvegarder</button>`
    );
    $ ('#modal-large').modal ('show');
  });

  $ (document).on ('click', '.saveA', function (e) {
    var libelA = $ ('.addInput').val ();
    e.stopPropagation ();
    e.preventDefault ();
    if (libelA.length < 0 || libelA == undefined || libelA == null) {
      $ ('.libelle').html ('Ce champ est obligatoire');
    } else {
      text = name + ' bien ajouté';
      $.ajax ({
        url: '/article',
        type: 'POST',
        data: {
          libelle: libelA,
        },
        dataType: 'json',
        success: function (response) {
          $ ('#modal-large').modal ('hide');
          $ ('#article').html (response.zone);
          toastr.success (text);
        },
        error: function (jQRH, err, status) {},
      });
    }
  });

  $ (document).on ('focus', '.addInput', function (e) {
    e.stopPropagation ();
    e.preventDefault ();
    $ ('.libelle').html ('');
  });

  $ (document).on ('click', '.modif', function (e) {
    e.stopPropagation ();
    e.preventDefault ();
    var id = $ (this).attr ('data-id');
    var libe = $ ('#' + id + ' td:eq(1)').text ();
    $ ('.modal-title').html ('Modification');
    $ ('.modal-dialog').attr ('class', 'modal-dialog');
    $ ('.body_modal').html (`<div class="form-group">
            <label>Libelle</label>
            <input type="text" class="form-control addInput" data-id="${id}" value="${libe}">
            <span class="libelle" style="color:red"></span>
        </div>`);
    $ ('.modal-footer .row').html (
      `<button class="btn btn-primary modifA">Modifier</button>`
    );
    $ ('#modal-large').modal ('show');
  });

  $ (document).on ('click', '.modifA', function (e) {
    var libelA = $ ('.addInput').val ();
    var id = $ ('.addInput').attr ('data-id');
    e.stopPropagation ();
    e.preventDefault ();
    if (libelA.length < 0 || libelA == undefined || libelA == null) {
      $ ('.libelle').html ('Ce champ est obligatoire');
    } else {
      text = ' Modification effectuée';
      $.ajax ({
        url: `/article/${id}`,
        type: 'PUT',
        data: {
          libelle: libelA,
        },
        dataType: 'json',
        success: function (response) {
          $ ('#modal-large').modal ('hide');
          $ ('#' + id + ' td:eq(1)').text (libelA);
          toastr.success (text);
        },
        error: function (jQRH, err, status) {},
      });
    }
  });

  $(document).on ('click', '.del', function (e) {
    e.stopPropagation ();
    e.preventDefault ();
    var id = $ (this).attr ('data-id');
    $ ('.modal-title').html ('Suppression');
    $ ('.modal-dialog').attr ('class', 'modal-dialog');
    $ ('.body_modal').html (`<div class="form-group">
            <input type="hidden" class="id_cache" value="${id}">
            <p>Voulez-vous vraiment continuer cette action ? </p><br>
            <div class="d-flex" style="text-align:center">
                <button class="btn btn-primary mr-2 oui">Oui</button>
                <button class="btn btn-danger mr-2 non" data-dismiss="modal">Non</button>
            </div>
        </div>`);
    $ ('.modal-footer .row').html('');
    $ ('#modal-large').modal ('show');
  });

  $(document).on('click', '.oui', function(e){
    var id = $('.id_cache').val();
    $.ajax({
        url : `/article/${id}`,
        type : 'DELETE',
        dataType : 'json',
        success:function(response){
            toastr.success (response.message);
            $ ('#modal-large').modal ('hide');
            $('#example1').DataTable().rows($ ('#' + id + '')).remove().draw();
        }
    });
  });
});
