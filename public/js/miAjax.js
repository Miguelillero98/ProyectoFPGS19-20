/* global Routing */

function darLike(id){
    var Ruta = Routing.generate('likes');
    $.ajax({
        type: 'POST',
        url: Ruta,
        data: ({'id': id}),
        async: true,
        dataType: 'json',
        success: function(data){
            window.location.reload();
        }
    });
}