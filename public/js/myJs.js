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
        data: nick,
        async: true,
        dataType: 'html',
        success: function(data){
            console.log(data['addUser']);
        }
    });
}
$(document).ready(function(){
    $('#Buscar').click(function(){
        buscaAmigos();
    });
});
