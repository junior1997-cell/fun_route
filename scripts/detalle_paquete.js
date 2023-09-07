// Page loading animation
$(window).on('load', function () { $('#js-preloader').addClass('loaded'); });

$(document).ready(function () {
  mostrar_detalle(localStorage.getItem("nube_idpaquete"));
  mostrar_hotel();
});

function mostrar_detalle(id) {
  $.post("controlador/paquete.php?op=mostrar_detalle", {'id_paquete': id}, function (e, status) {
    e = JSON.parse(e); console.log(e);
    if (e.status == true) {

      // titulo
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

      // ::::::::::::::::::::: RESUMEN :::::::::::::::::::::
      $('.duracion_html').html(`${e.data.cant_dias} dias / ${e.data.cant_noches} noches` );      
      $('.comida_html').html(e.data.desc_comida);      
      $('.alojamiento_html').html(e.data.desc_alojamiento );  

      // ::::::::::::::::::::: DETALLE :::::::::::::::::::::
      $('.itinerario_html').html(e.data.actividad);
      $('.incluye_html').html(e.data.incluye);
      $('.no_incluye_html').html(e.data.no_incluye);
      $('.recomendaciones_html').html(e.data.recomendaciones);           
          
      $('.actividades_html').html(e.data.resumen);      
      $('.mapa_html').html(e.data.mapa); 
      
      // ::::::::::::::::::::: POLITICA :::::::::::::::::::::
      $('.condicion_general_html').html(e.data.politica.condiciones_generales);
      $('.politica_reserva_html').html(e.data.politica.reservas);
      $('.politica_pago_html').html(e.data.politica.pago);
      $('.politica_cancelacion_html').html(e.data.politica.cancelacion);

      // ::::::::::::::::::::: GALERIA :::::::::::::::::::::
      $('.galeria_paquete').html(''); //limpiamos el div      
      e.data.galeria.forEach((val, key) => {
        var galeria_html = `<div > <img src="admin/dist/docs/paquete/galeria/${val.imagen}" onclick="openFullImg(this.src)">  </div>`;
        $('.galeria_paquete').append(galeria_html); 
      });      

      // ::::::::::::::::::::: LISTA DIAS :::::::::::::::::::::
      $(".btn_dia_html").html('');  //limpiamos el div     
      e.data.itinerario.forEach((val, key) => {        
        $(".btn_dia_html").append(`<li><a href="javascript:;" class="tabLink ${key == 0 ? 'activeLink' : ''} " id="cont-${key}">DÍA ${val.numero_orden}</a></li>`); 
        $(".content_dia_html").append(`<div class="tabcontent ${key == 0 ? '' : 'hide'}" id="cont-${key}-1">
          <div class="TabImage">
            <div style="height: 20em; background: url(admin/dist/docs/tours/perfil/${val.imagen.replace(/\s/g, "%20")}), url(assets/images/splash2.jpg); background-size: cover; background-position: center center; background-blend-mode: screen;"></div>                          
          </div>
          <div class="Description">
            <h3>DÍA ${val.numero_orden} - ${val.nombre_tours}</h3>
            ${val.actividad}            
          </div>
        </div>`); 

        // ::::::::::::::::::::: LISTA FOTOS ::::::::::::::::::::
        $(".btn_fotos_html").append(`<button href="javascript:;" class="tab_btn" id="conta-${key+1}">${val.nombre_tours}</button>`); 
        var html_foto = '';
        val.galeria.forEach((val2, key2) => {
          html_foto = html_foto.concat(`<div > <img src="admin/dist/docs/tours/galeria/${val2.imagen}" onclick="openFullImg(this.src)"> </div>`) ;
        });
        $('.content_fotos_html').append(`<div id="conta-${key+1}-2" class="tabContentImg"> <div class="gallery_all"> ${html_foto} </div> </div>`);
      }); 
      
      // ::::::::::::::::::::: FORMULARIO CORREO :::::::::::::::::::::
      $("#idpaquete_email").val(id); 
      $("#nombre_paquete_email").val(e.data.nombre); 
      $("#costo_email").val(e.data.costo); 
      $('.descripcion_email').html(`${e.data.descripcion.slice(0,150)}...` );

      // pluging - itinerario dia
      $(".tabLink").each(function(){ $(this).click(function(){ tabeId = $(this).attr('id'); $(".tabLink").removeClass("activeLink"); $(this).addClass("activeLink"); $(".tabcontent").addClass("hide"); $("#"+tabeId+"-1").removeClass("hide"); return false; }); });

      // pluging - fotos
      $(".tabContentImg").addClass("hiden"); $("#conta-0-2").removeClass("hiden");
      $(".tab_btn").each(function(){ $(this).click(function(){ tabeIds = $(this).attr('id'); $(".tab_btn").removeClass("activeTab"); $(this).addClass("activeTab"); $(".tabContentImg").addClass("hiden"); $("#"+tabeIds+"-2").removeClass("hiden"); return false; });  });

      // pluging - politicas
      $(".tabLinkP").each(function(){ $(this).click(function(){  tabeIdes = $(this).attr('id'); $(".tabLinkP").removeClass("activeLinkP"); $(this).addClass("activeLinkP"); $(".tabcontentP").addClass("hide"); $("#"+tabeIdes+"-1").removeClass("hide"); return false; });  });
      
    } else {
      ver_errores(e);
    }
  }).fail(function (e) { ver_errores(e); });
}

function mostrar_hotel() {
  $.post("controlador/paquete.php?op=mostrar_hotel",  function (e, textStatus, jqXHR) {
    e = JSON.parse(e); console.log(e);

    if (e.status == true) {
      $('.list_hotel_html').html('');

      e.data.forEach((val, key) => {
        $('.list_hotel_html').append(`<div class="item" 
        style=" background:  linear-gradient( rgb(0 0 0 / 75%), rgb(0 0 0 / 35%) ),  url(admin/dist/docs/hotel/img_perfil/${val.imagen_perfil}); background-size:cover; background-repeat: no-repeat; background-position: center center;">
          <div class="content p-r-10px p-l-10px py-5 b-radio-10px bg-color-000000cc">
            <div class="name "><h1 class="text-white">${val.nombre}</h1></div>
            <div class="des font-size-2em text-warning" >${val.estrellas_html}</div>
            <p class="text-white p-2" >Check in: ${val.check_in} - Check out: ${val.check_out}</p>
            <!-- CARACTERIZTICAS DEL HOTEL  -->
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-detalle-hotel" onclick="ver_detalle_hotel(${val.idhoteles});">
              Ver Caracteristica
            </button>
            <!-- /* CARACTERIZTICAS DEL HOTEL */ -->
          </div>
        </div>`);
      });
      
    } else {
      ver_errores(e);
    }

  }).fail(function (e) { ver_errores(e); });
}

function ver_detalle_hotel(id) {

  $.post("controlador/paquete.php?op=ver_detalle_hotel", {'id': id}, function (e, textStatus, jqXHR) {
    e = JSON.parse(e); console.log(e);
    if (e.status == true) {
      $('#modal_title_detalle_hotel').html(`${e.data.nombre} - ${e.data.estrellas_html} `);
      // :::::::::::::::::::::::::::::::::::: habitacion ::::::::::::::::::::::::::::::
      $('.habitaciones_hotel').html('');
      e.data.habitacion.forEach((val1, key1) => {
        var html_habitacion = `<h6><b>HABITACION:</b> ${val1.nombre}</h6> <div class="line_buttom"></div> <h6 class="caract_H"><b>CARACTERÍSTICAS DE LA HABITACION</b></h6>`;
        var det_habitacion = '';
        val1.detalle_habitacion.forEach((val2, key2) => {
          det_habitacion = det_habitacion.concat(`<div class="col-lg-6 px-auto">
            <div class="box-item font-size-11px">
              <i class="${val2.icono_font} pr-1"></i>
              <span><b class="espacio">${val2.nombre}: </b> ${val2.estado_si_no == '1' ? '<span class="bg-success text-white px-1 b-radio-5px">SI</span>' : '<span class="bg-danger text-white px-1 b-radio-5px">NO</span>'}</span>
            </div>
          </div>`);
        });

        $('.habitaciones_hotel').append(`${html_habitacion} <div class="row"> ${det_habitacion} </div>`);
      });

      // ::::::::::::::::::::::::::::::::: instalacion ::::::::::::::::::::::::::::
      $('.instalacion_hotel').html('');
      e.data.instalaciones_hotel.forEach((val3, key3) => {
        $('.instalacion_hotel').append(`<div class="col-lg-6">
          <div class="box-item font-size-11px">
            <i class="${val3.icono_font} espacio"></i> 
            <span><b class="espacio">${val3.nombre}: </b> ${val3.estado_si_no == '1' ? '<span class="bg-success text-white px-1 b-radio-5px">SI</span>' : '<span class="bg-danger text-white px-1 b-radio-5px">NO</span>'}</span>
          </div>
        </div>`);
      });

      // ::::::::::::::::::::::::::::::::: galeria :::::::::::::::::::::::::::::
      e.data.galeria_hotel.forEach((val4, key4) => {
        $('.galeria_hotel').append(`<div class="col-sm-6 col-md-4 col-lg-3" > <img src="admin/dist/docs/hotel/galeria/${val4.imagen}" >  </div>`);
      });
       
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
    url: "controlador/paquete.php?op=enviar_correo",
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
          /*console.log(percentComplete + '%');*/
          $("#barra_progress_correo").css({"width": percentComplete+'%'}).text(percentComplete.toFixed(2)+" %");
        }
      }, false);
      return xhr;
    },
    beforeSend: function () {
      $("#btn_enviar_correo").html('<i class="fas fa-spinner fa-pulse fa-lg"></i>').addClass('disabled');
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
      nombre_email: { required: true }, 
      correo_email: { required: true }, 
      telefono_email: { required: true, maxlength:9 }, 
      mensaje_email: { required: true }, 
    },
    messages: {
      nombre_email: { required: "Campo requerido", },
      correo_email: { required: "Campo requerido", },
      telefono_email: { required: "Campo requerido", maxlength: "Maximo 9 Caracteres" },
      mensaje_email: { required: "Campo requerido", },
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