<table id="example2" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>N°</th>
            <th>{{ $article->societe->configsociete->type_sousarticle }}</th>
            <th>Prix</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($article->sousArticles as $value)
            <tr id="{{ __("sous").$value->id }}">
                <td>{{ $value->id }}</td>
                <td>{{ $value->libelle }}</td>
                <td>{{ $value->prix }}</td>
                <td>
                    <div class="d-flex">
                        <button type="button" class="btn btn-danger del"><i class="fas fa-trash"></i></button>
                    </div>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Page specific script -->
<script>
    $(function() {

        $("#example2").DataTable({
            "responsive": true,
            "autoWidth": false,
            "lengthChange": false,
            "paging": true,
            "pageLength": 6,
            "language": {
                "emptyTable": "Aucune donnée disponible",
                "info": "",
                "infoEmpty": "",
                "infoFiltered": "",
                "loadingRecords": "Chargement...",
                "processing": "Processing...",
                "searchPlaceholder": "Recherche...",
                "search": "",
                "zeroRecords": "Aucune donnée trouvé",
                "paginate": {
                    "first": "Premier",
                    "last": "Dernier",
                    "next": "Suivant",
                    "previous": "Précédent"
                },
            }
        });
        $('#example2_wrapper .col-md-6:eq(0)').append(
            `<button class='btn btn-primary addSA'><i class="fas fa-plus mr-2"></i>Ajouter</button>`);
        $('#example2_wrapper .col-md-6:eq(1) #example2_filter label').attr('class', 'form-group');
    });
</script>
