// Page loading animation
$(window).on('load', function () { $('#js-preloader').addClass('loaded'); });

$(document).ready(function () {
  mostrar_detalle(localStorage.getItem("nube_idtours"));
  datos_empresa();
  
});

function mostrar_detalle(id) {
  $.post("controlador/tours.php?op=mostrar_detalle", {'id_tours': id}, function (e, status) {
    e = JSON.parse(e); console.log(e);
    if (e.status == true) {

      // ::::::::::::::::::::: TITULO :::::::::::::::::::::
      var nombre_tour = cortar_mitad_texto(e.data.nombre);
      $(".nombre_1").html(nombre_tour[0]); $(".nombre_2").html(nombre_tour[1]);      

      // ::::::::::::::::::::: PRECIOS :::::::::::::::::::::
      if (e.data.estado_descuento == '1') {
        $('.precio_regular').html(`<span> <b>PRECIO REGULAR: </b><s style="font-weight: 900;">S/ ${e.data.costo}</s> * Persona</span>` );      
        $('.precio_actual').html(`<span><b>DESCUENTO (${e.data.porcentaje_descuento}%): </b><b style="font-weight: 900; color: #1877f2;">S/ ${e.data.monto_descuento}</b> * Persona</span>`);
      } else {
        $('.precio_regular').html(`<span> <b>PRECIO: </b><b class="text-primary" style="font-weight: 900;">S/ ${e.data.costo}</b> * Persona</span>` );      
        $('.precio_actual').html(`<span><b>Sin Descuentos  </b></span>`);
      }

      // ::::::::::::::::::::: DESCRIPCION :::::::::::::::::::::
      $('.duracion_hml').html(e.data.duracion);
      $('.nombre_tab_html').html(e.data.nombre);

      $('.itinerario_html').html(e.data.actividad);
      $('.incluye_html').html(e.data.incluye);
      $('.no_incluye_html').html(e.data.no_incluye);
      $('.recomendaciones_html').html(e.data.recomendaciones);   
      
      $('.mapa_html').html(e.data.mapa); 

      // ::::::::::::::::::::: RESUMEN :::::::::::::::::::::
      $('.duracion_html').html(e.data.duracion);      
      $('.comida_html').html(e.data.resumen_comida);      
      $('.alojamiento_html').html(e.data.alojamiento == 0 ? 'No incluye' : 'Incluye');      
      $('.actividades_html').html(e.data.resumen_actividad);      
      $('.image_itinerario').html(`<div  style="height: 20em; background: url(admin/dist/docs/tours/perfil/${e.data.imagen.replace(/\s/g, "%20")}), url(assets/images/splash2.jpg); background-size: cover; background-position: center center; background-blend-mode: screen;"></div>`);      

      // :::::::::::: GALERIA ::::::::::::::

      $('.gallery_all').html(''); //limpiamos el div      
      e.data.galeria.forEach((val, key) => {
        var galeria_html = `<div > <img src="admin/dist/docs/tours/galeria/${val.imagen}" onclick="openFullImg(this.src)">  </div>`;
        $('.gallery_all').append(galeria_html); 
      });

      // ::::::::::::::: FORMULARIO CORREO :::::::::::
      $("#idtours_email").val(id); 
      $("#nombre_tours_email").val(e.data.nombre); 
      $("#costo_email").val(e.data.costo); 
      $('.descripcion_email').html(`${e.data.descripcion.slice(0,150)}...` );
      mostrar_politicas();
    } else {
      ver_errores(e);
    }
  }).fail(function (e) { ver_errores(e); });
}


function mostrar_politicas() {

  $.post("controlador/politicas_tour_paquete.php?op=politicas_tours", {}, function (e, status) {
    e = JSON.parse(e); console.log('hola'); console.log(e);
    if (e.status == true) {

      $(".p_reservas").html(e.data.reservas); 
      $(".cancelacion_modificacion").html(e.data.cancelacion); 
      $(".responsabilidadcliente").html(e.data.responsabilidad_cliente); 
      $(".cambioxproveedor").html(e.data.cancelaiones_proveedor); 
      $(".responsabilidad_proveedor").html(e.data.responsabilidad_proveedor); 

      $(".spiner_reservas_tours").hide(); 
      
    } else {
      ver_errores(e);
    }
  }).fail(function (e) { ver_errores(e); });
}

function mostrar_info_empresa(){
  $.post("controlador/tours.php?op=mostrar_empresa", {}, function (e, status) {
    e = JSON.parse(e); console.log('hola'); console.log(e);
    if (e.status == true) {

      $("#direccion").html(e.data.direccion); 
      $("#celular").html(e.data.celular); 
      $("#correo").html(e.data.correo); 
      
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

function limpiar_form_correo() {
  $('#nombre_email').val("");
  $('#correo_email').val("");
  $('#telefono_email').val("");
  $('#mensaje_email').val("");
}

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
          Swal.fire("Correcto!", "Cotizacion enviado.", "success");  
          $( ".btn-close" ).click(); //cerramos el modal        			
          limpiar_form_correo(); // limpiamos el formulario
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
          console.log(percentComplete + '%');
          $("#barra_progress_correo").css({"width": percentComplete+'%'}).text(percentComplete.toFixed(2)+" %");
        }
      }, false);
      return xhr;
    },
    beforeSend: function () {
      $("#btn_enviar_correo").html('<i class="fas fa-spinner fa-pulse fa-lg"></i> Enviando...').addClass('disabled');
      $("#barra_progress_correo").css({ width: "0%",  }).text("0%");
    },
    complete: function () {
      $("#barra_progress_correo").css({ width: "0%", }).text("0%");
    },
    error: function (jqXhr) { ver_errores(jqXhr); },
  });
}




$(function () {

  $("#form-hacer-pedido").validate({
    rules: { 
      nombre_email:   { required: true }, 
      correo_email:   { required: true, email: true }, 
      telefono_email: { required: true, maxlength: 9 }, 
      mensaje_email:  { required: true }, 
    },
    messages: {
      nombre_email:   { required: "Campo requerido", },
      correo_email:   { required: "Campo requerido", email: 'Ingrese un correo válido' },
      telefono_email: { required: "Campo requerido", maxlength: "Maximo 9 Caracteres" },
      mensaje_email:  { required: "Campo requerido", },
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

// ::::::::::::::::::::::::::::::: F O O T E R  ::::::::::::::::::::::::
function datos_empresa() {
  $.post("controlador/inicio.php?op=datos_empresa",  function (e, textStatus, jqXHR) {
    e = JSON.parse(e); console.log(e);
    $('.direccion').html(`${e.data.direccion}`);
    $('.celular').html(`+51 ${e.data.celular}`);
    $('.correo').html(`${e.data.correo}`);

  });
}

fetch('footer.html')
  .then(response => response.text())
  .then(data => {
      document.body.insertAdjacentHTML('beforeend', data);
  });
