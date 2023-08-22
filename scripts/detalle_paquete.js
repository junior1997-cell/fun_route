$(document).ready(function () {
  mostrar_detalle(localStorage.getItem("nube_idpaquete"));
});

function mostrar_detalle(id) {
  $.post("controlador/paquete.php?op=mostrar_detalle", {'id_paquete': id}, function (e, status) {
    e = JSON.parse(e); console.log(e);
    if (e.status == true) {

      var nombre_tour = cortar_mitad_texto(e.data.nombre);
      $(".nombre_1").html(nombre_tour[0]); $(".nombre_2").html(nombre_tour[1]);      
      $('.itinerario_html').html(e.data.actividad);
      $('.incluye_html').html(e.data.incluye);
      $('.no_incluye_html').html(e.data.no_incluye);
      $('.recomendaciones_html').html(e.data.recomendaciones);     

      $('.duracion_html').html(e.data.duracion);      
      $('.comida_html').html(e.data.resumen_comida);      
      $('.alojamiento_html').html(e.data.alojamiento == 0 ? 'No incluye' : 'Incluye');      
      $('.actividades_html').html(e.data.resumen_actividad);      

      // $('.gallery_all').html(''); //limpiamos el div      
      e.data.galeria.forEach((val, key) => {
        var galeria_html = `<div > <img src="admin/dist/docs/paquete/galeria/${val.imagen}" onclick="openFullImg(this.src)">  </div>`;
        // $('.gallery_all').append(galeria_html); 
      });

      // Formulario
      $("#nombre_tours_email").val(e.data.nombre); 
      $("#costo_email").val(e.data.costo); 
      
    } else {
      ver_errores(e);
    }
  }).fail(function (e) { ver_errores(e); });
}

function activate_descripcion() {  
	$('.boton-drop').toggleClass("drop-rotate");
	$('.drop-descripcion').toggleClass("drop-active")
}

// ::::::::::::::::::::::::::::::: S E C C I O N   E N V I O   D  E   C O R R E O ::::::::::::::::::::::::

function enviar_correo_tours(e) {
  // e.preventDefault(); //No se activará la acción predeterminada del evento
  var formData = new FormData($("#form-hacer-pedido")[0]);
 
  $.ajax({
    url: "controlador/tours.php?op=enviar_correo",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (e) {
      try {
        e = JSON.parse(e);  console.log(e);
        if ( e.status == true) {
          Swal.fire("Correcto!", "Clasificación registrado correctamente.", "success");
          toastr_success('Exito', 'Correo enviado con exito', 700);
          			
          $("#modal-enviar-correo-tours").modal("hide");
        }else{
          ver_errores(e);
        }
      } catch (err) { console.log('Error: ', err.message); toastr.error('<h5 class="font-size-16px">Error temporal!!</h5> puede intentalo mas tarde, o comuniquese con <i><a href="tel:+51921305769" >921-305-769</a></i> ─ <i><a href="tel:+51921487276" >921-487-276</a></i>'); }      

      $("#btn_enviar_correo").html('Enviar Mensaje').removeClass('disabled');
      
    },
    xhr: function () {
      var xhr = new window.XMLHttpRequest();
      xhr.upload.addEventListener("progress", function (evt) {
        if (evt.lengthComputable) {
          var percentComplete = (evt.loaded / evt.total)*100;
          /*console.log(percentComplete + '%');*/
          $("#barra_progress_categoria_af").css({"width": percentComplete+'%'}).text(percentComplete.toFixed(2)+" %");
        }
      }, false);
      return xhr;
    },
    beforeSend: function () {
      $("#btn_enviar_correo").html('<i class="fas fa-spinner fa-pulse fa-lg"></i>').addClass('disabled');
      $("#barra_progress_categoria_af").css({ width: "0%",  }).text("0%");
    },
    complete: function () {
      $("#barra_progress_categoria_af").css({ width: "0%", }).text("0%");
    },
    error: function (jqXhr) { ver_errores(jqXhr); },
  });
}

$(function () {

  $("#form-hacer-pedido").validate({
    rules: { 
      nombre_persona: { required: true }, 
      correo_persona: { required: true }, 
      telefono_persona: { required: true, }, 
      mensaje_persona: { required: true }, 
    },
    messages: {
      nombre_persona: { required: "Campo requerido", },
      correo_persona: { required: "Campo requerido", },
      telefono_persona: { required: "Campo requerido", },
      mensaje_persona: { required: "Campo requerido", },
    },
        
    errorElement: "span",

    errorPlacement: function (error, element) {
      error.addClass("invalid-feedback");
      element.closest(".form-group").append(error);
    },

    highlight: function (element, errorClass, validClass) {
      $(element).addClass("is-invalid").removeClass("is-valid");
    },

    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass("is-invalid").addClass("is-valid");   
    },
    submitHandler: function (e) {
      enviar_correo_tours(e);      
    },
  });
});