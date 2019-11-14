$('.btn-eliminar').on('click', function(){
    let url = $(this).attr('href');

    $.confirm({
        title: 'Favor de confirmar',
        content: '¿Está seguro que desea eliminar este tipo de comida?',
        buttons: {
            Ok: {
                text: 'Si, quiero eliminarlo',
                btnClass: 'btn-warning',
                keys: ['enter', 'shift'],
                action: function(){
                    window.location.href = url;
                }
            },
            cancel: {
                text: 'No, Cancelar',
                btnClass: 'btn-default'
            }
        }
    });
           

    return false;
});