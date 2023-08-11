$(document).ready(function() {
    mostrar();
  });
  
  function mostrar() {
    $.post("admin/ajax/contacto.php?op=mostrar", {}, function (e, status) {
      e = JSON.parse(e);
      if (e.status) {
        var tempDiv = document.createElement('div');
            
        // Mostrar Misión
        tempDiv.innerHTML = e.data.mision;
        var formattedMision = tempDiv.innerHTML;
        $('#mision_vista').html(formattedMision);

        // Mostrar Visión
        tempDiv.innerHTML = e.data.vision;
        var formattedVision = tempDiv.innerHTML;
        $('#vision_vista').html(formattedVision);

        // Mostrar Valores
        tempDiv.innerHTML = e.data.valores;
        var formattedValores = tempDiv.innerHTML;
        $('#valores_vista').html(formattedValores);

        // Mostrar Reseña
        tempDiv.innerHTML = e.data.resenia_historica;
        var formattedResena = tempDiv.innerHTML;
        $('#resena_vista').html(formattedResena);

        // Mostrar Reseña
        tempDiv.innerHTML = e.data.palabras_ceo;
        var formattedCeo = tempDiv.innerHTML;
        $('#ceo_vista').html(formattedCeo);

      } else {
        ver_errores(e);
      }
    }).fail(function(e) { 
      console.log(e); 
      ver_errores(e); 
    });
  }
  
  
  