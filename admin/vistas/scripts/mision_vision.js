var id_get = varaibles_get();
var id =id_get.id;

//Función que se ejecuta al inicio
$(document).on("ready", function () {
  
  $(`.mvision_vision${id}`).addClass("active");

  $("#actualizar_registro").on("click", function (e) { $("#submit-form-actualizar-registro").submit(); });
  $("#form-mision-vision").on("submit", function (e) { actualizar_m_v(e); });

  mostrar_m_v(id);

});

function mostrar_m_v(get_id) {

  $("#cargando-1-fomulario").hide();
  $("#cargando-2-fomulario").show();

  $.post("../ajax/contacto.php?op=mostrar", {'id':get_id}, function (e, status) {

    e = JSON.parse(e);  console.log(e);  

    if (e.status == true){     

      $("#id").val(e.data.idcontacto);
      $("#mision").val(e.data.mision);
      $("#vision").val(e.data.vision);
      $(".clss_mision").html(e.data.mision);
      $(".clss_vision").html(e.data.vision);

      $("#cargando-1-fomulario").show();
      $("#cargando-2-fomulario").hide();

    }else{
      ver_errores(e);
    }

  }).fail( function(e) { console.log(e); ver_errores(e); } );
}

function actualizar_m_v(e) {
  
  e.preventDefault(); //No se activará la acción predeterminada del evento
  $("#mision").val($(".clss_mision").html());
  $("#vision").val($(".clss_vision").html());

  var formData = new FormData($("#form-mision-vision")[0]);

  $.ajax({
    url: "../ajax/contacto.php?op=actualizar_mision_vision",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (e) {
      try {
        e = JSON.parse(e);
        if (e.status == true) {
          Swal.fire("Correcto!", "Misión y visión actualizado correctamente", "success");
          mostrar_m_v(id); 
        } else {
          Swal.fire("Error!", datos, "error");
        }

      } catch (err) { console.log('Error: ', err.message); toastr_error("Error temporal!!",'Puede intentalo mas tarde, o comuniquese con:<br> <i><a href="tel:+51921305769" >921-305-769</a></i> ─ <i><a href="tel:+51921487276" >921-487-276</a></i>', 700); }      
      $("#actualizar_registro").html('Actualizar').removeClass('disabled');      
    },
    xhr: function () {
      var xhr = new window.XMLHttpRequest();
      xhr.upload.addEventListener("progress", function (evt) {
        if (evt.lengthComputable) {
          var percentComplete = (evt.loaded / evt.total)*100;
          /*console.log(percentComplete + '%');*/
          $("#barra_progress").css({"width": percentComplete+'%'});
          $("#barra_progress").text(percentComplete.toFixed(2)+" %");
        }
      }, false);
      return xhr;
    },
    beforeSend: function () {
      $("#actualizar_registro").html('<i class="fas fa-spinner fa-pulse fa-lg"></i>').addClass('disabled');
      $("#barra_progress").css({ width: "0%",  });
      $("#barra_progress").text("0%").addClass('progress-bar-striped progress-bar-animated');
    },
    complete: function () {
      $("#barra_progress").css({ width: "0%", });
      $("#barra_progress").text("0%").removeClass('progress-bar-striped progress-bar-animated');
    },
    error: function (jqXhr) { ver_errores(jqXhr); },
  });
}
function l_m() {
  // limpiar();
  $("#barra_progress").css({ width: "0%" });

  $("#barra_progress").text("0%");

  $("#barra_progress2").css({ width: "0%" });

  $("#barra_progress2").text("0%");
}
