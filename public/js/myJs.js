/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function buscaAmigos(){
    var Ruta = Routing.generate('anadir_amigos')
    var nick = $('#buscaAmigo').val();
    $.ajax({
        type:'POST',
        url: Ruta,
        data: "b="+nick,
        async: true,
        dataType: 'json',
        success: function(data){
            $('#resultado').html("<p>"+data+"</p><button id='anadir'>Añadir</button>");
        }
    });
}
function anadir(){
    
}
$(document).ready(function(){
    $('#Buscar').click(function(e){
        e.preventDefault();
        buscaAmigos();
    });
    $('#resultado').mouseenter(function(){
        $('#anadir').click(function(e){
            e.preventDefault();
            anadir();
        });
    });
});
