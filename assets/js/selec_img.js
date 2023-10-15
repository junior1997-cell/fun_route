
function clas_select(id) {
    if ($(`#dessert-${id}`).is(':checked')) {
        $(`.contenedor_${id}`).addClass('activado')
    }else {
        $(`.contenedor_${id}`).removeClass('activado')
    }
}

function clas_selector(id) {
    if ($(`#optionF-${id}`).is(':checked')) {
        $(`.selection_${id}`).addClass('active2')
    }else {
        $(`.selection_${id}`).removeClass('active2')
    }
}