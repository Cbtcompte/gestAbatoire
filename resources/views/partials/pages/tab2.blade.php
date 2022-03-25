<table id="example1" class="table table-bordered table-striped" data-name="{{ $app->societe->configsociete->type_article }}" data-name2="{{ $app->societe->configsociete->type_sousarticle }}">
    <thead>
        <tr>
            <th>N°</th>
            <th>{{ $app->societe->configsociete->type_article }}</th>
            <th></th>
        </tr>
    </thead>
    <tbody class="tbody">
        @foreach ($app->societe->articles as $value)
            <tr id="{{ $value->id }}">
                <td>{{ $value->id }}</td>
                <td>{{ $value->libelle }}</td>
                <td>
                    <div class="d-flex">
                        <button type="button" class="btn btn-success mr-2 show_btn"
                            data-id="{{ $value->id }}"><i
                                class="fas fa-eye"></i></button>
                        <button type="button" class="btn btn-warning mr-2 modif"
                            data-id="{{ $value->id }}"><i
                                class="fas fa-edit"></i></button>
                        <button type="button" class="btn btn-danger mr-2 del" data-id="{{ $value->id }}"><i
                                class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script src="{{ asset('dashboard/js/custome.js') }}"></script>
