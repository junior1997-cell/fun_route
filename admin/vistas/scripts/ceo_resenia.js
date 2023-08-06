
//Función que se ejecuta al inicio
function init() {

  $("#bloc_empresa").addClass("menu-open");

  $("#bloc_datos_generales").addClass("menu-open bg-color-191f24");

  $("#mempresa").addClass("active");

  $("#lceo_resenia").addClass("active");

  
  $("#actualizar_registro").on("click", function (e) { actualizar_datos_generales_ceo(e); });

  mostrar();

  $('#palabras_ceo').summernote(); $('#resenia_h').summernote();
  
  $('#palabras_ceo').summernote ('disable');   $('#resenia_h').summernote ('disable');
}

function activar_editar(estado) {

  if (estado=="1") {

    $(".editar").hide();
    $(".actualizar").show();

    $("#palabras_ceo").summernote("enable");
    $("#resenia_h").summernote("enable");

    toastr.success('Campos habiliados para editar!!!')

  }

  if (estado=="2") {

    $(".editar").show();
    $(".actualizar").hide();

    $('#resenia_h').summernote ('disable');
    $('#palabras_ceo').summernote ('disable');

  }

}
function mostrar() {

  $("#cargando-1-fomulario").hide();
  $("#cargando-2-fomulario").show();

  $.post("../ajax/contacto.php?op=mostrar", {}, function (e, status) {

    e = JSON.parse(e);  console.log(e);  
    if (e.status){

      $("#cargando-1-fomulario").show();
      $("#cargando-2-fomulario").hide();

      $("#idnosotros").val(e.data.idnosotros);
      $('#resenia_h').summernote ('code', e.data.resenia_historica);
      $('#palabras_ceo').summernote ('code', e.data.palabras_ceo);
      
    }else{
      ver_errores(e);
    }

  }).fail( function(e) { console.log(e); ver_errores(e); } );
}

function actualizar_datos_generales_ceo(e) {
  // e.preventDefault(); //No se activará la acción predeterminada del evento
  var formData = new FormData($("#form-datos-ceo-resenia")[0]);

  $.ajax({
    url: "../ajax/contacto.php?op=actualizar_ceo_resenia",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,

    success: function (e) {
      try {
        e = JSON.parse(e);  console.log(e); 
        if (e.status == true) {

          Swal.fire("Correcto!", "El registro se guardo correctamente.", "success");

          mostrar(); activar_editar(2);

        }else{  
          ver_errores(e);
        } 
      } catch (err) {
        console.log('Error: ', err.message); toastr.error('<h5 class="font-size-16px">Error temporal!!</h5> puede intentalo mas tarde, o comuniquese con <i><a href="tel:+51921305769" >921-305-769</a></i> ─ <i><a href="tel:+51921487276" >921-487-276</a></i>');
      } 
      $("#actualizar_registro").html('Guardar Cambios').removeClass('disabled');

    },
    xhr: function () {
      var xhr = new window.XMLHttpRequest();
      xhr.upload.addEventListener("progress", function (evt) {
        if (evt.lengthComputable) {
          var percentComplete = (evt.loaded / evt.total)*100;
          /*console.log(percentComplete + '%');*/
          $("#barra_progress_mv").css({"width": percentComplete+'%'}).text(percentComplete.toFixed(2)+" %");
        }
      }, false);
      return xhr;
    },
    beforeSend: function () {
      $("#actualizar_registro").html('<i class="fas fa-spinner fa-pulse fa-lg"></i>').addClass('disabled');
      $("#barra_progress_mv").css({ width: "0%",  }).text("0%").addClass('progress-bar-striped progress-bar-animated');
      $("#barra_progress_mv_div").show();
    },
    complete: function () {
      $("#barra_progress_mv").css({ width: "0%", }).text("0%").removeClass('progress-bar-striped progress-bar-animated');
      $("#barra_progress_mv_div").hide();
    },
    error: function (jqXhr) { ver_errores(jqXhr); },

  });
}


init();
