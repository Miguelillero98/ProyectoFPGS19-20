/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function buscaAmigos(){
    var Ruta = Routing.generate('anadir_amigos');
    var nick = $('#buscaAmigo').val();
    $.ajax({
        type:'POST',
        url: Ruta,
<<<<<<< HEAD
        dataType: 'json',
        data: {"nick":nick},
        async: true,
        
        success: function(response){
            var jsonData = JSON.parse(response);
            $('#resultado').html("<p>" + jsonData + "</p><button id='anadir' value='" + jsonData + "'>Añadir</button>");
        }
    });
}
function anadir(){
    var Ruta = Routing.generate('anadir')
    var nick = $('#buscaAmigo').val();
    $.ajax({
        type:'POST',
        url: Ruta,
        data: {"nick":nick},
        async: true,
        dataType: 'json',
        success: function(){
            window.reload();
        }
    });
}
=======
        data: nick,
        async: true,
        dataType: 'html',
        success: function(data){
            console.log(data['addUser']);
        }
    });
}
>>>>>>> parent of 3edea8d... 24/03
$(document).ready(function(){
    $('#Buscar').click(function(){
        buscaAmigos();
    });
<<<<<<< HEAD
    $('#resultado').mouseenter(function(){
        $('#anadir').click(function(e){
            e.preventDefault();
           // anadir();
        });
    });
=======
>>>>>>> parent of 3edea8d... 24/03
});
