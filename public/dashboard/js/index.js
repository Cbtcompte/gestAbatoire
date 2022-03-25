
$(function(){
    $('#article').on('change', function(e){
        var article = $('#article option:selected').val();
        alert(article);
        $.ajax({
            url: '/article/'+article,
            method: 'GET',
            dataType: 'json',
            success:function(response){
                var data = response.article;
                var el = document.getElementById('sous_article');
                el.innerHTML = "";
                data.forEach(element => {
                    el.innerHTML += '<option value="'+element.id+'">'+element.libelle+'</option>';
                });

            },

        });

     
    });

    $(document).on('change', '#sous_article', function(){
        var sous_article = $('#sous_article option:selected').val();
        $.ajax({
            url: '/prix_article/'+sous_article,
            method: 'GET',
            dataType: 'json',
            success:function(response){
                $('#prix').html(`<h5>Prix unitaire</h5>
                <input type="text" name="prix" class="form-control" value="${response.prix}">`);
            }
        });
    });

});
