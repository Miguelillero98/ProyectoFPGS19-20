/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
let Routing = require('..\..\vendor\friendsofsymfony\jsrouting-bundle\resources\public\js\router');
let Routes = require('.\js_routes.json');
Routing.setRoutingData(Routes);
$(document).ready(function(){
    $('#Buscar').click(function(e){
        e.preventDefault();
        buscaAmigos();
    });
    $('#resultado').mouseenter(function(){
        $('#anadir').click(function(e){
            e.preventDefault();
           // anadir();
        });
    });
});
function buscaAmigos(){
    var Ruta = Routing.generate('anadir_amigos');
    var nick = $('#buscaAmigo').val();
    $.ajax({
        type:'GET',
        url: Ruta,
        dataType: 'json',
        data: {
            'b':nick
        },
        async: true,
        success: function(response){
            var jsonData = JSON.parse(response);
            $('#resultado').val("<p>" + jsonData + "</p>");
        },
        error: function(xhr, status) 
            {
                alert('hay error');
                //alert('ERROR -> '. status);
            }
    });
}
function anadir(){
    var Ruta = Routing.generate('anadir');
    var nick = $('#buscaAmigo').val();
    $.ajax({
        type:'POST',
        url: Ruta,
        data: {"nick":nick},
        async: true,
        dataType: 'json',
        success: function(){
            window.location.reload();
        }
    });
}

