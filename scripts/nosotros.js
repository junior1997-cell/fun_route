// Page loading animation
$(window).on('load', function () { $('#js-preloader').addClass('loaded'); });

$(document).ready(function () {
  mostrar();
});

function mostrar() {
  // Agregar código para mostrar el spinner
  $('#mision_vista').html('<div class="spinner"></div>');
  $('#vision_vista').html('<div class="spinner"></div>');
  $('#valores_vista').html('<div class="spinner"></div>');
  $('#resena_vista').html('<div class="spinner"></div>');
  $('#ceo_vista').html('<div class="spinner"></div>');

  $.post("controlador/nosotros.php?op=mostrar", {}, function (e, status) {
    e = JSON.parse(e);
    if (e.status == true) {
      var tempDiv = document.createElement('div');

      // Mostrar Misión
      if (e.data.mision !== undefined && e.data.mision !== null) {
        tempDiv.innerHTML = e.data.mision;
        var formattedMision = tempDiv.innerHTML;
        $('#mision_vista').html(formattedMision);
      }

      // Mostrar Visión
      if (e.data.vision !== undefined && e.data.vision !== null) {
        tempDiv.innerHTML = e.data.vision;
        var formattedVision = tempDiv.innerHTML;
        $('#vision_vista').html(formattedVision);
      }

      // Mostrar Valores
      if (e.data.valores !== undefined && e.data.valores !== null) {
        tempDiv.innerHTML = e.data.valores;
        var formattedValores = tempDiv.innerHTML;
        $('#valores_vista').html(formattedValores);
      }

      // Mostrar Reseña
      if (e.data.resenia_historica !== undefined && e.data.resenia_historica !== null) {
        tempDiv.innerHTML = e.data.resenia_historica;
        var formattedResena = tempDiv.innerHTML;
        $('#resena_vista').html(formattedResena);
      }

      // Mostrar Palabras CEO
      if (e.data.palabras_ceo !== undefined && e.data.palabras_ceo !== null) {
        tempDiv.innerHTML = e.data.palabras_ceo;
        var formattedCeo = tempDiv.innerHTML;
        $('#ceo_vista').html(formattedCeo);
      }

      $('.datos-sunat').html(`Nos complace informarte que <b>${e.data.nombre_empresa}</b> con <b>${e.data.tipo_documento}: ${e.data.num_documento}</b>
      ha completado exitosamente su registro en la Superintendencia Nacional de Aduanas y de Administración Tributaria (SUNAT). 
      Este proceso es fundamental para cumplir con las obligaciones tributarias y aduaneras correspondientes.`);

    } else {
      ver_errores(e);
    }
  }).fail(function (e) { ver_errores(e); });
}
