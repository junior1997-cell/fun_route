$(document).ready(function() {
  mostrar();
});

function mostrar() {
  // Agregar código para mostrar el spinner
  $('#mision_vista').html('<div class="spinner"></div>');
  $('#vision_vista').html('<div class="spinner"></div>');
  $('#valores_vista').html('<div class="spinner"></div>');
  $('#resena_vista').html('<div class="spinner"></div>');
  $('#ceo_vista').html('<div class="spinner"></div>');

  $.post("admin/ajax/contacto.php?op=mostrar", {}, function (e, status) {
      e = JSON.parse(e);
      if (e.status) {
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

      } else {
          ver_errores(e);
      }
  }).fail(function(e) {
      console.log(e);
      ver_errores(e);
  });
}
