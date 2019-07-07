$(document).ready(function(){
var root = document.location.origin + "/TCCProgamacao/async/";

    $('#btnSearch').click(function(){

        $('form').submit(function(){
            var dados = $(this).serialize();
            $.ajax({
                url: root + "search.php",
                method: 'post',
                dataType: 'html',
                data: dados,
                success: function(data) {
                    $('#itemCatalogo').empty().html(data);
                },
            });

            return false;
        });

        $('form').trigger('submit');

    });


     $('#categoria').change(function(){
        var element = document.getElementById("categoria");
        var inputFrom = document.querySelector('#campo').value = "";
        var selectedValue = element.options[element.selectedIndex].value;

        $('form').submit(function(){
            var dados = $(this).serialize();

            $.ajax({
                url: root + "search2.php",
                method: 'post',
                dataType: 'html',
                data: dados,
                success: function(data) {
                    $('#itemCatalogo').empty().html(data);
                },
            });

            return false;
        });

        $('form').trigger('submit');

    });



/// Adicionar ao carrinho
    var itemSelecionado = "";

    $(".addCarrinho").click(function(){
        itemSelecionado  = $(this).attr("id");
        $.ajax({
            url: root + 'addCart.php?id=' + itemSelecionado,
            method: 'post',
            success: function(data) {
                myFunction();
            }
        });
        // $('#'+itemSelecionado).load("async/addCart.php?id=" + itemSelecionado);
    })

});