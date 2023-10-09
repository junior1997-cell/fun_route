
function clas_select(id) {
    if ($(`#dessert-${id}`).is(':checked')) {
        $(`.contenedor_${id}`).addClass('activado')
    }else {
        $(`.contenedor_${id}`).removeClass('activado')
    }
}