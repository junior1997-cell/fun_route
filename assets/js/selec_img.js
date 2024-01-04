
function input_check(input, id) { console.log( `Tours-${id}: ${$(input).is(':checked')}`);
  if ($(input).is(':checked')) {
    $(`.tours-${id}`).addClass('bg-color-408c98 text-white')
  } else {
    $(`.tours-${id}`).removeClass('bg-color-408c98 text-white')
  }

  
  
}

function input_radio(input_all, input_id) {
  $(input_all).removeClass('bg-color-408c98 text-white');
  $(input_id).addClass('bg-color-408c98 text-white');  
}