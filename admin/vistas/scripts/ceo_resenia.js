
//Función que se ejecuta al inicio
function init() {

  $("#bloc_empresa").addClass("menu-open");
  $("#bloc_datos_generales").addClass("menu-open bg-color-191f24");
  $("#mempresa").addClass("active");
  $("#lceo_resenia").addClass("active");
  
  $("#actualizar_registro").on("click", function (e) { actualizar_datos_generales_ceo(e); });

  mostrar();

  $('#palabras_ceo').summernote(); 
  $('#resenia_h').summernote();  
  $('#palabras_ceo').summernote ('disable');   
  $('#resenia_h').summernote ('disable');
}

// abrimos el navegador de archivos
$("#foto1_i").click(function () { $("#foto1").trigger("click"); });
$("#foto1").change(function (e) { addImage(e, $("#foto1").attr("id"), "../dist/img/default/img_defecto.png"); });

function foto1_eliminar() {
  $("#foto1").val(""); $("#foto1_actual").val("");
  $("#foto1_i").attr("src", "../dist/img/default/img_defecto.png");
  $("#foto1_nombre").html("");
}

function activar_editar(estado) {
  if (estado=="1") {
    $(".editar").hide();
    $(".actualizar").show();
    $("#palabras_ceo").summernote("enable");
    $("#resenia_h").summernote("enable");
    toastr.success('Campos habiliados para editar!!!');
  }else  if (estado=="2") {
    $(".editar").show();
    $(".actualizar").hide();
    $('#resenia_h').summernote ('disable');
    $('#palabras_ceo').summernote ('disable');
  }
}

function limpiar_form_ceo_reseña() {
  $("#idnosotros").val('');
  $('#resenia_h').summernote ('code', '');
  $('#palabras_ceo').summernote ('code', '');
  $('#nombre_ceo').val ('');

  $("#foto1").val(""); $("#foto1_actual").val("");
  $("#foto1_i").attr("src", "../dist/img/default/img_defecto.png");
  $("#foto1_nombre").html("");
}

function mostrar() {

  limpiar_form_ceo_reseña();

  $("#cargando-1-fomulario").hide();
  $("#cargando-2-fomulario").show();

  $.post("../ajax/contacto.php?op=mostrar", {}, function (e, status) {

    e = JSON.parse(e);  console.log(e);  
    if (e.status == true){    

      $("#idnosotros").val(e.data.idnosotros);
      $('#resenia_h').summernote ('code', e.data.resenia_historica);
      $('#palabras_ceo').summernote ('code', e.data.palabras_ceo);
      $('#nombre_ceo').val ( e.data.nombre_ceo);

      if (e.data.perfil_ceo != "" || e.data.perfil_ceo != null ) {        
        $("#foto1_i").attr("src", "../dist/docs/nosotros/perfil_ceo/" + e.data.perfil_ceo);  
        $("#foto1_actual").val(e.data.perfil_ceo);
      }

      $("#cargando-1-fomulario").show();
      $("#cargando-2-fomulario").hide();
      
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
          $("#barra_progress_ceo_resenia").css({"width": percentComplete+'%'}).text(percentComplete.toFixed(2)+" %");
        }
      }, false);
      return xhr;
    },
    beforeSend: function () {
      $("#actualizar_registro").html('<i class="fas fa-spinner fa-pulse fa-lg"></i>').addClass('disabled');
      $("#barra_progress_ceo_resenia").css({ width: "0%",  }).text("0%").addClass('progress-bar-striped progress-bar-animated');
      $("#barra_progress_ceo_resenia_div").show();
    },
    complete: function () {
      $("#barra_progress_ceo_resenia").css({ width: "0%", }).text("0%").removeClass('progress-bar-striped progress-bar-animated');
      $("#barra_progress_ceo_resenia_div").hide();
    },
    error: function (jqXhr) { ver_errores(jqXhr); },
  });
}

init();
