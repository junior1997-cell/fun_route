var tabla_hotel;
var tabla_habitacion;
var tabla_caract_hotel;
var idhoteles_R = "", nombre_R = "";
//Función que se ejecuta al inicio
function init() {
  
  $("#bloc_Recurso").addClass("menu-open");

  $("#mRecurso").addClass("active");

  listar_hotel();

  $("#guardar_registro_hotel").on("click", function (e) { $("#submit-form-hotel").submit(); });
  $("#guardar_registro_habitacion").on("click", function (e) { $("#submit-form-habitacion").submit(); });
  $("#guardar_registro_caracteristicas_h").on("click", function (e) { $("#submit-form-caracteristicas_h").submit(); });
  $("#guardar_registro_caract_hotel").on("click", function (e) { $("#submit-form-caract-hotel").submit(); });
  $("#guardar_registro_galeria_hotel").on("click", function (e) { $("#submit-form-galeria-hotel").submit(); });

  $('#d_check_in').datetimepicker({  format: 'LT', });
  $('#d_check_out').datetimepicker({  format: 'LT' });

  $("#icono_font_c").select2({templateResult: templateFont, theme:"bootstrap4", placeholder: "Selec. icono.", allowClear: true, });
  $("#icono_font_i").select2({templateResult: templateFont, theme:"bootstrap4", placeholder: "Selec. icono.", allowClear: true, });

  // Formato para telefono
  $("[data-mask]").inputmask();
}

function templateFont (state) {
  if (!state.id) { return state.text; }
  var icono = state.title != '' ? state.title : 'fas fa-chevron-right';   
  var $state = $(`<span><i class="${icono}"></i> ${state.text}</span>`);
  return $state;
};

// abrimos el navegador de archivos
$("#foto1_i").click(function () { $("#foto1").trigger("click"); });
$("#foto1").change(function (e) { addImage(e, $("#foto1").attr("id"), "../dist/img/default/img_defecto_hotel.jpg"); });

function foto1_eliminar() {
  $("#foto1").val("");
  $("#foto1_i").attr("src", "../dist/img/default/img_defecto_hotel.jpg");
  $("#foto1_nombre").html("");
  $("#foto1_actual").val("");
}

//Función limpiar
function limpiar_hotel() {

  $("#guardar_registro_hotel").html('Guardar Cambios').removeClass('disabled');

  $("#idhoteles").val("");
  $("#nombre_hotel").val(""); 
  $("#nro_estrellas").val("");
  $("#check_in").val(""); 
  $("#check_out").val("");   

  $("#foto1_i").attr("src", "../dist/img/default/img_defecto_hotel.jpg");
  $("#foto1").val("");
  $("#foto1_actual").val("");
  $("#foto1_nombre").html("");  

  // Limpiamos las validaciones
  $(".form-control").removeClass('is-valid');
  $(".form-control").removeClass('is-invalid');
  $(".error.invalid-feedback").remove();
}

//Función Listar
function listar_hotel() {

  tabla_hotel=$('#tabla-hotel').dataTable({
    responsive: true,
    lengthMenu: [[ -1, 5, 10, 25, 75, 100, 200,], ["Todos", 5, 10, 25, 75, 100, 200, ]],//mostramos el menú de registros a revisar
    aProcessing: true,//Activamos el procesamiento del datatables
    aServerSide: true,//Paginación y filtrado realizados por el servidor
    dom: '<Bl<f>rtip>',//Definimos los elementos del control de tabla
    buttons: [
      { text: '<i class="fa-solid fa-arrows-rotate" data-toggle="tooltip" data-original-title="Recargar"></i>', className: "btn bg-gradient-info", action: function ( e, dt, node, config ) { tabla_hotel.ajax.reload(); toastr_success('Exito!!', 'Actualizando tabla', 400); } },
      { extend: 'copyHtml5', footer: true, exportOptions: { columns: [0,2], }, text: `<i class="fas fa-copy" data-toggle="tooltip" data-original-title="Copiar"></i>`, className: "px-2 btn bg-gradient-gray", }, 
      { extend: 'excelHtml5', footer: true, exportOptions: { columns: [0,2], }, text: `<i class="far fa-file-excel fa-lg" data-toggle="tooltip" data-original-title="Excel"></i>`, className: "px-2 btn bg-gradient-success",  }, 
      { extend: 'pdfHtml5', footer: false, exportOptions: { columns: [0,2], }, text: `<i class="far fa-file-pdf fa-lg" data-toggle="tooltip" data-original-title="PDF"></i>`, className: "px-2 btn bg-gradient-danger", } ,
    ],
    ajax:{
      url: '../ajax/hotel.php?op=listar_hotel',
      type : "get",
      dataType : "json",						
      error: function(e){
        console.log(e.responseText);	ver_errores(e);
      }
    },
    createdRow: function (row, data, ixdex) {
      // columna: #
      if (data[0] != '') { $("td", row).eq(0).addClass("text-center"); }
      // columna: #
      if (data[1] != '') { $("td", row).eq(1).addClass("text-nowrap"); }
      // columna: #
      if (data[4] != '') { $("td", row).eq(4).addClass("text-center"); }
    },
    language: {
      lengthMenu: "Mostrar: _MENU_",
      buttons: { copyTitle: "Tabla Copiada", copySuccess: { _: "%d líneas copiadas", 1: "1 línea copiada", }, },
      sLoadingRecords: '<i class="fas fa-spinner fa-pulse fa-lg"></i> Cargando datos...'
    },
    bDestroy: true,
    iDisplayLength: 5,//Paginación
    order: [[ 0, "asc" ]]//Ordenar (columna,orden)
  }).DataTable();
  // Ocultar el lengthMenu mediante jQuery
   $('.dataTables_length').css('display', 'none');

  // Referencia a la fila previamente seleccionada
  var filaSeleccionadaAnterior = null;

  // Agregar el evento onclick a las filas de la tabla
  $('#tabla-hotel tbody').on('mouseenter', 'tr', function () {
    $(this).css('cursor', 'pointer');
    }).on('mouseleave', 'tr', function () {
        $(this).css('cursor', 'default');
    }).on('click', 'tr', function () {
      // Eliminar el estilo de fila-seleccionada de la fila anterior
      if (filaSeleccionadaAnterior !== null) {
        filaSeleccionadaAnterior.css('background-color', '');
      }

      // Aplicar el estilo a la nueva fila seleccionada
      $(this).css('background-color', 'rgba(67, 189, 201, 0.23)');
      // Guardar la referencia de la nueva fila seleccionada
      filaSeleccionadaAnterior = $(this);

      // Obtener los datos de la fila seleccionada
      var datosFila = tabla_hotel.row(this).data();
      // Hacer lo que desees con los datos de la fila
      //filaSelecc_tabajador(datosFila[1],datosFila[2],datosFila[3],datosFila[4]);
      listar_habitacion(datosFila[3],datosFila[4]);
      listar_caract_hotel(datosFila[3],datosFila[4]);
      listar_galeria_hotel(datosFila[3],datosFila[4]);
  });
}

//Función para guardar o editar
function guardaryeditar_hotel(e) {

  var formData = new FormData($("#form-hotel")[0]);
 
  $.ajax({
    url: "../ajax/hotel.php?op=guardaryeditar_hotel",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (e) {
      try {
        e = JSON.parse(e);  console.log(e);  
        if (e.status == true) {
          Swal.fire("Correcto!", "hotel trabajado registrado correctamente.", "success");
          tabla_hotel.ajax.reload(null, false);         
          limpiar_hotel();
          $("#modal-agregar-hotel").modal("hide");         
          
        }else{
          ver_errores(e);	
        }
      } catch (err) { console.log('Error: ', err.message); toastr_error("Error temporal!!",'Puede intentalo mas tarde, o comuniquese con:<br> <i><a href="tel:+51921305769" >921-305-769</a></i> ─ <i><a href="tel:+51921487276" >921-487-276</a></i>', 700); }      

      $("#guardar_registro_hotel").html('Guardar Cambios').removeClass('disabled');
      
    },
    xhr: function () {
      var xhr = new window.XMLHttpRequest();
      xhr.upload.addEventListener("progress", function (evt) {
        if (evt.lengthComputable) {
          var percentComplete = (evt.loaded / evt.total)*100;
          /*console.log(percentComplete + '%');*/
          $("#barra_progress_hotel").css({"width": percentComplete+'%'}).text(percentComplete.toFixed(2)+" %");
        }
      }, false);
      return xhr;
    },
    beforeSend: function () {
      $("#guardar_registro_hotel").html('<i class="fas fa-spinner fa-pulse fa-lg"></i>').addClass('disabled');
      $("#barra_progress_hotel").css({ width: "0%",  }).text("0%");
    },
    complete: function () {
      $("#barra_progress_hotel").css({ width: "0%", }).text("0%");
    },
    error: function (jqXhr) { ver_errores(jqXhr); },
  });
}

//mostrar un solo registro
function mostrar_hotel(idhoteles) {

  $(".tooltip").removeClass("show").addClass("hidde");
  $("#cargando-9-fomulario").hide();
  $("#cargando-10-fomulario").show();

  limpiar_hotel();

  $("#modal-agregar-hotel").modal("show")

  $.post("../ajax/hotel.php?op=mostrar_hotel", { idhoteles: idhoteles }, function (e, status) {

    e = JSON.parse(e);  console.log(e);  

    if (e.status) {
      $("#idhoteles").val(e.data.idhoteles);
      $("#nombre_hotel").val(e.data.nombre);
      $("#nro_estrellas").val(e.data.estrellas);

      $("#check_in").val(e.data.check_in);
      $("#check_out").val(e.data.check_out);

      if (e.data.imagen_perfil != "") {        
        $("#foto1_i").attr("src", `../dist/docs/hotel/img_perfil/${e.data.imagen_perfil}`);  
        $("#foto1_actual").val(e.data.imagen_perfil);
        $("#foto1_nombre").html(`Imagen-perfil.${extrae_extencion(e.data.imagen_perfil)}`);
      }

      $("#cargando-9-fomulario").show();
      $("#cargando-10-fomulario").hide();
    } else {
      ver_errores(e);
    }
  }).fail( function(e) { ver_errores(e); } );
}

//Función para eliminar registros
function eliminar_hotel(idhotel, nombre) {  
  
  crud_eliminar_papelera(
    "../ajax/hotel.php?op=desactivar_hotel",
    "../ajax/hotel.php?op=eliminar_hotel", 
    idhotel, 
    "!Elija una opción¡", 
    `<b class="text-danger"><del>${nombre}</del></b> <br> En <b>papelera</b> encontrará este registro! <br> Al <b>eliminar</b> no tendrá acceso a recuperar este registro!`, 
    function(){ sw_success('♻️ Papelera! ♻️', "Tu registro ha sido reciclado." ) }, 
    function(){ sw_success('Eliminado!', 'Tu registro ha sido Eliminado.' ) }, 
    function(){  tabla_hotel.ajax.reload(null, false); },
    false, 
    false, 
    false,
    false
  );

}

//==========================HABITACIONES========================
//==========================HABITACIONES========================
//==========================HABITACIONES========================
//Función limpiar
function limpiar_habitacion() {

  $("#guardar_registro_habitacion").html('Guardar Cambios').removeClass('disabled');

  $("#idhabitacion").val("");
  $("#nombre_habitacion").val("");

  // Limpiamos las validaciones
  $(".form-control").removeClass('is-valid');
  $(".form-control").removeClass('is-invalid');
  $(".error.invalid-feedback").remove();
}

//Función Listar
function listar_habitacion(idhoteles,nombre) {
  console.log(idhoteles+'   '+nombre);
  $("#idhoteles_G").val(idhoteles);
  $(".vacio").hide(); $(".mTable").show();

  $('.name_hotel').html(`<i class="fas fa-arrow-right"></i> ${nombre}  <sup class="text-danger">*</sup>`);

  tabla_habitacion=$('#tabla-habitacion').dataTable({
    responsive: true,
    lengthMenu: [[ -1, 5, 10, 25, 75, 100, 200,], ["Todos", 5, 10, 25, 75, 100, 200, ]],//mostramos el menú de registros a revisar
    aProcessing: true,//Activamos el procesamiento del datatables
    aServerSide: true,//Paginación y filtrado realizados por el servidor
    dom: '<Bl<f>rtip>',//Definimos los elementos del control de tabla
    buttons: [
      { text: '<i class="fa-solid fa-arrows-rotate" data-toggle="tooltip" data-original-title="Recargar"></i>', className: "btn bg-gradient-info", action: function ( e, dt, node, config ) { tabla_hotel.ajax.reload(); toastr_success('Exito!!', 'Actualizando tabla', 400); } },
      { extend: 'copyHtml5', footer: true, exportOptions: { columns: [0,2], }, text: `<i class="fas fa-copy" data-toggle="tooltip" data-original-title="Copiar"></i>`, className: "px-2 btn bg-gradient-gray", }, 
      { extend: 'excelHtml5', footer: true, exportOptions: { columns: [0,2], }, text: `<i class="far fa-file-excel fa-lg" data-toggle="tooltip" data-original-title="Excel"></i>`, className: "px-2 btn bg-gradient-success",  }, 
      { extend: 'pdfHtml5', footer: false, exportOptions: { columns: [0,2], }, text: `<i class="far fa-file-pdf fa-lg" data-toggle="tooltip" data-original-title="PDF"></i>`, className: "px-2 btn bg-gradient-danger", } , 
    ],
    ajax:{
      url: '../ajax/hotel.php?op=listar_habitacion&idhoteles=' + idhoteles,
      type : "get",
      dataType : "json",						
      error: function(e){
        console.log(e.responseText);	ver_errores(e);
      }
    },
    createdRow: function (row, data, ixdex) {
      // columna: #
      if (data[0] != '') { $("td", row).eq(0).addClass("text-center"); }
      // columna: #
      if (data[1] != '') { $("td", row).eq(1).addClass("text-nowrap"); }
      // columna: #
      if (data[4] != '') { $("td", row).eq(4).addClass("text-center"); }
    },
    language: {
      lengthMenu: "Mostrar: _MENU_ registros",
      buttons: { copyTitle: "Tabla Copiada", copySuccess: { _: "%d líneas copiadas", 1: "1 línea copiada", }, },
      sLoadingRecords: '<i class="fas fa-spinner fa-pulse fa-lg"></i> Cargando datos...'
    },
    bDestroy: true,
    iDisplayLength: 5,//Paginación
    order: [[ 0, "asc" ]]//Ordenar (columna,orden)
  }).DataTable();
  // Ocultar el lengthMenu mediante jQuery
   $('.dataTables_length').css('display', 'none');

  // Referencia a la fila previamente seleccionada
  var filaSeleccionadaAnterior = null;

  // Agregar el evento onclick a las filas de la tabla
  $('#tabla-habitacion tbody').on('mouseenter', 'tr', function () {
    $(this).css('cursor', 'pointer');
    }).on('mouseleave', 'tr', function () {
        $(this).css('cursor', 'default');
    }).on('click', 'tr', function () {
      // Eliminar el estilo de fila-seleccionada de la fila anterior
      if (filaSeleccionadaAnterior !== null) {
        filaSeleccionadaAnterior.css('background-color', '');
      }

      // Aplicar el estilo a la nueva fila seleccionada
      $(this).css('background-color', 'rgba(67, 189, 201, 0.23)');
      // Guardar la referencia de la nueva fila seleccionada
      filaSeleccionadaAnterior = $(this);

      // Obtener los datos de la fila seleccionada
      var datosFila = tabla_habitacion.row(this).data();
      // Hacer lo que desees con los datos de la fila
      //filaSelecc_tabajador(datosFila[1],datosFila[2],datosFila[3],datosFila[4]);
      listar_caracteristicas_h(datosFila[3],datosFila[2]);
  });
}

//Función para guardar o editar
function guardaryeditar_habitacion(e) {

  var formData = new FormData($("#form-habitacion")[0]);
 
  $.ajax({
    url: "../ajax/hotel.php?op=guardaryeditar_habitacion",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (e) {
      e = JSON.parse(e);  console.log(e);  
      if (e.status == true) {

				Swal.fire("Correcto!", "Habitación registrado correctamente.", "success");

	      tabla_habitacion.ajax.reload(null, false);
         
				limpiar_habitacion();

        $("#modal-agregar-habitacion").modal("hide");        
        
        $("#guardar_registro_habitacion").html('Guardar Cambios').removeClass('disabled');
			}else{
				ver_errores(e);	
			}
    },
    xhr: function () {

      var xhr = new window.XMLHttpRequest();

      xhr.upload.addEventListener("progress", function (evt) {

        if (evt.lengthComputable) {

          var percentComplete = (evt.loaded / evt.total)*100;
          /*console.log(percentComplete + '%');*/
          $("#barra_progress_habitacion").css({"width": percentComplete+'%'});

          $("#barra_progress_habitacion").text(percentComplete.toFixed(2)+" %");
        }
      }, false);
      return xhr;
    },
    beforeSend: function () {
      $("#guardar_registro_habitacion").html('<i class="fas fa-spinner fa-pulse fa-lg"></i>').addClass('disabled');
      $("#barra_progress_habitacion").css({ width: "0%",  });
      $("#barra_progress_habitacion").text("0%");
    },
    complete: function () {
      $("#barra_progress_habitacion").css({ width: "0%", });
      $("#barra_progress_habitacion").text("0%");
    },
    error: function (jqXhr) { ver_errores(jqXhr); },
  });
}

//mostrar un solo registro
function mostrar_habitacion(idhabitacion) {

  $(".tooltip").removeClass("show").addClass("hidde");
  $("#cargando-11-fomulario").hide();
  $("#cargando-12-fomulario").show();

  limpiar_habitacion();

  $("#modal-agregar-habitacion").modal("show")

  $.post("../ajax/hotel.php?op=mostrar_habitacion", { idhabitacion: idhabitacion }, function (e, status) {

    e = JSON.parse(e);  console.log(e);  

    if (e.status) {
      $("#idhoteles_G").val(e.data.idhoteles);
      $("#idhabitacion").val(e.data.idhabitacion);
      $("#nombre_habitacion").val(e.data.nombre);

      $("#cargando-11-fomulario").show();
      $("#cargando-12-fomulario").hide();
    } else {
      ver_errores(e);
    }
  }).fail( function(e) { ver_errores(e); } );
}

//Función para eliminar registros
function eliminar_habitacion(idhabitacion, nombre) {  
  
  crud_eliminar_papelera(
    "../ajax/hotel.php?op=desactivar_habitacion",
    "../ajax/hotel.php?op=eliminar_habitacion", 
    idhabitacion, 
    "!Elija una opción¡", 
    `<b class="text-danger"><del>${nombre}</del></b> <br> En <b>papelera</b> encontrará este registro! <br> Al <b>eliminar</b> no tendrá acceso a recuperar este registro!`, 
    function(){ sw_success('♻️ Papelera! ♻️', "Tu registro ha sido reciclado." ) }, 
    function(){ sw_success('Eliminado!', 'Tu registro ha sido Eliminado.' ) }, 
    function(){  tabla_habitacion.ajax.reload(null, false); },
    false, 
    false, 
    false,
    false
  );

}
//==========================FIN HABITACIONES====================

//==========================CARACTERISTICAS HABITACIONES====================
//==========================CARACTERISTICAS HABITACIONES====================

function ver_incono_c() {
  if ($("#icono_font_c").val() == null || $("#icono_font_c").val() == '' ) {  } else {
    var icon = $("#icono_font_c").val(); console.log(icon);
    $("#select2-icono_font_c-container").prepend(`<i class="${icon} mr-1"></i>`);
  }
}

//Función limpiar
function limpiar_caracteristicas_h() {

  $("#guardar_registro_caracteristicas_h").html('Guardar Cambios').removeClass('disabled');

  $("#iddetalle_habitacion").val("");
  $("#nombre_caracteristica_h").val("");
  $("#icono_font_c").val('').trigger('change');
  $('#estado_switch').prop('checked', false); 

  // Limpiamos las validaciones
  $(".form-control").removeClass('is-valid');
  $(".form-control").removeClass('is-invalid');
  $(".error.invalid-feedback").remove();
}

//Función Listar
function listar_caracteristicas_h(idhabitacion,nombre_habitacion) {
  console.log(idhabitacion+'   '+nombre_habitacion);
  $("#idhabitacion_G").val(idhabitacion);
  $(".vacio_h").hide(); $(".mTable").show();

  $('.name_habitacion').html(`<i class="fas fa-arrow-right"></i> ${nombre_habitacion}  <sup class="text-danger">*</sup>`);

  tabla_caracteristicas_h=$('#tabla-caracteristicas_h').dataTable({
    responsive: true,
    lengthMenu: [[ -1, 5, 10, 25, 75, 100, 200,], ["Todos", 5, 10, 25, 75, 100, 200, ]],//mostramos el menú de registros a revisar
    aProcessing: true,//Activamos el procesamiento del datatables
    aServerSide: true,//Paginación y filtrado realizados por el servidor
    dom: '<Bl<f>rtip>',//Definimos los elementos del control de tabla
    buttons: [
      { text: '<i class="fa-solid fa-arrows-rotate" data-toggle="tooltip" data-original-title="Recargar"></i>', className: "btn bg-gradient-info", action: function ( e, dt, node, config ) { tabla_caracteristicas_h.ajax.reload(); toastr_success('Exito!!', 'Actualizando tabla', 400); } },

      { extend: 'copyHtml5', footer: true, exportOptions: { columns: [0,2], }, text: `<i class="fas fa-copy" data-toggle="tooltip" data-original-title="Copiar"></i>`, className: "px-2 btn bg-gradient-gray", }, 
      { extend: 'excelHtml5', footer: true, exportOptions: { columns: [0,2], }, text: `<i class="far fa-file-excel fa-lg" data-toggle="tooltip" data-original-title="Excel"></i>`, className: "px-2 btn bg-gradient-success",  }, 
      { extend: 'pdfHtml5', footer: false, exportOptions: { columns: [0,2], }, text: `<i class="far fa-file-pdf fa-lg" data-toggle="tooltip" data-original-title="PDF"></i>`, className: "px-2 btn bg-gradient-danger", } ,
    

    ],
    ajax:{
      url: '../ajax/hotel.php?op=listar_caracteristicas_h&idhabitacion=' + idhabitacion,
      type : "get",
      dataType : "json",						
      error: function(e){
        console.log(e.responseText);	ver_errores(e);
      }
    },
    createdRow: function (row, data, ixdex) {
      // columna: #
      if (data[0] != '') { $("td", row).eq(0).addClass("text-center"); }
      // columna: #
      if (data[1] != '') { $("td", row).eq(1).addClass("text-nowrap"); }

    },
    language: {
      lengthMenu: "Mostrar: _MENU_",
      buttons: { copyTitle: "Tabla Copiada", copySuccess: { _: "%d líneas copiadas", 1: "1 línea copiada", }, },
      sLoadingRecords: '<i class="fas fa-spinner fa-pulse fa-lg"></i> Cargando datos...'
    },
    bDestroy: true,
    iDisplayLength: 5,//Paginación
    order: [[ 0, "asc" ]]//Ordenar (columna,orden)
  }).DataTable();
  // Ocultar el lengthMenu mediante jQuery
   $('.dataTables_length').css('display', 'none');

}

//Función para guardar o editar
function guardaryeditar_caracteristicas_h(e) {

  var formData = new FormData($("#form-caracteristicas_h")[0]);
 
  $.ajax({
    url: "../ajax/hotel.php?op=guardaryeditar_caracteristicas_h",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (e) {
      e = JSON.parse(e);  console.log(e);  
      if (e.status == true) {

				Swal.fire("Correcto!", "Característica registrada correctamente.", "success");

	      tabla_caracteristicas_h.ajax.reload(null, false);
         
				limpiar_caracteristicas_h();

        $("#modal-agregar-caracteristicas_h").modal("hide");        
        
        $("#guardar_registro_caracteristicas_h").html('Guardar Cambios').removeClass('disabled');
			}else{
				ver_errores(e);	
			}
    },
    xhr: function () {

      var xhr = new window.XMLHttpRequest();

      xhr.upload.addEventListener("progress", function (evt) {

        if (evt.lengthComputable) {

          var percentComplete = (evt.loaded / evt.total)*100;
          /*console.log(percentComplete + '%');*/
          $("#barra_progress_caracteristicas_h").css({"width": percentComplete+'%'});

          $("#barra_progress_caracteristicas_h").text(percentComplete.toFixed(2)+" %");
        }
      }, false);
      return xhr;
    },
    beforeSend: function () {
      $("#guardar_registro_caracteristicas_h").html('<i class="fas fa-spinner fa-pulse fa-lg"></i>').addClass('disabled');
      $("#barra_progress_caracteristicas_h").css({ width: "0%",  });
      $("#barra_progress_caracteristicas_h").text("0%");
    },
    complete: function () {
      $("#barra_progress_caracteristicas_h").css({ width: "0%", });
      $("#barra_progress_caracteristicas_h").text("0%");
    },
    error: function (jqXhr) { ver_errores(jqXhr); },
  });
}

//mostrar un solo registro
function mostrar_caracteristicas_h(iddetalle_habitacion) {

  $(".tooltip").removeClass("show").addClass("hidde");
  $("#cargando-13-fomulario").hide();
  $("#cargando-14-fomulario").show();

  limpiar_caracteristicas_h();

  $("#modal-agregar-caracteristicas_h").modal("show")

  $.post("../ajax/hotel.php?op=mostrar_caracteristicas_h", { iddetalle_habitacion: iddetalle_habitacion }, function (e, status) {

    e = JSON.parse(e);  console.log(e);  

    if (e.status == true) {
      $("#idhabitacion_G").val(e.data.idhabitacion);
      $("#iddetalle_habitacion").val(e.data.iddetalle_habitacion);
      $("#nombre_caracteristica_h").val(e.data.nombre);

      if (e.data.estado_si_no == '1') { $('#estado_switch').prop('checked', true);    }

      $("#icono_font_c").val(e.data.icono_font).trigger('change');

      $("#cargando-13-fomulario").show();
      $("#cargando-14-fomulario").hide();
    } else {
      ver_errores(e);
    }
  }).fail( function(e) { ver_errores(e); } );
}

//Función para eliminar registros
function eliminar_caracteristicas_h(idcaracteristicas_h, nombre) {  
  
  crud_eliminar_papelera(
    "../ajax/hotel.php?op=desactivar_caracteristicas_h",
    "../ajax/hotel.php?op=eliminar_caracteristicas_h", 
    idcaracteristicas_h, 
    "!Elija una opción¡", 
    `<b class="text-danger"><del>${nombre}</del></b> <br> En <b>papelera</b> encontrará este registro! <br> Al <b>eliminar</b> no tendrá acceso a recuperar este registro!`, 
    function(){ sw_success('♻️ Papelera! ♻️', "Tu registro ha sido reciclado." ) }, 
    function(){ sw_success('Eliminado!', 'Tu registro ha sido Eliminado.' ) }, 
    function(){  tabla_caracteristicas_h.ajax.reload(null, false); },
    false, 
    false, 
    false,
    false
  );

}

//==========================FIN CARACTERISTICAS HABITACIONES====================
//==========================FIN CARACTERISTICAS HABITACIONES====================




//============================== INSTALACIONES HOTEL==========================
//============================== INSTALACIONES HOTEL==========================

function ver_incono_i() {
  if ($("#icono_font_i").val() == null || $("#icono_font_i").val() == '' ) {  } else {
    var icon = $("#icono_font_i").val(); console.log(icon);
    $("#select2-icono_font_i-container").prepend(`<i class="${icon} mr-1"></i>`);
  }
}

//Función limpiar
function limpiar_caract_hotel() {

  $("#guardar_registro_caract_hotel").html('Guardar Cambios').removeClass('disabled');
  $("#idinstalaciones_hotel").val("");
  $("#nombre_c_hotel").val(""); 

  $("#icono_font_i").val('').trigger('change');
  $('#estado_switch2').prop('checked', false); 

  // Limpiamos las validaciones
  $(".form-control").removeClass('is-valid');
  $(".form-control").removeClass('is-invalid');
  $(".error.invalid-feedback").remove();
}

//Función Listar
function listar_caract_hotel(idhoteles,nombre) {
  console.log(idhoteles+'   '+nombre);
  $("#idhoteles_GN").val(idhoteles);
  $(".vacio").hide(); $(".mTable").show();

  $('.name_hoteles').html(`<i class="fas fa-arrow-right"></i> ${nombre}  <sup class="text-danger">*</sup>`);

  tabla_caract_hotel=$('#tabla-caract-hotel').dataTable({
    responsive: true,
    lengthMenu: [[ -1, 5, 10, 25, 75, 100, 200,], ["Todos", 5, 10, 25, 75, 100, 200, ]],//mostramos el menú de registros a revisar
    aProcessing: true,//Activamos el procesamiento del datatables
    aServerSide: true,//Paginación y filtrado realizados por el servidor
    dom: '<Bl<f>rtip>',//Definimos los elementos del control de tabla
    buttons: [
      { text: '<i class="fa-solid fa-arrows-rotate" data-toggle="tooltip" data-original-title="Recargar"></i>', className: "btn bg-gradient-info", action: function ( e, dt, node, config ) { tabla_caract_hotel.ajax.reload(); toastr_success('Exito!!', 'Actualizando tabla', 400); } },
      { extend: 'copyHtml5', footer: true, exportOptions: { columns: [0,2], }, text: `<i class="fas fa-copy" data-toggle="tooltip" data-original-title="Copiar"></i>`, className: "px-2 btn bg-gradient-gray", }, 
      { extend: 'excelHtml5', footer: true, exportOptions: { columns: [0,2], }, text: `<i class="far fa-file-excel fa-lg" data-toggle="tooltip" data-original-title="Excel"></i>`, className: "px-2 btn bg-gradient-success",  }, 
      { extend: 'pdfHtml5', footer: false, exportOptions: { columns: [0,2], }, text: `<i class="far fa-file-pdf fa-lg" data-toggle="tooltip" data-original-title="PDF"></i>`, className: "px-2 btn bg-gradient-danger", } ,
    ],
    ajax:{
      url: '../ajax/hotel.php?op=listar_caract_hotel&idhoteles=' + idhoteles,
      type : "get",
      dataType : "json",						
      error: function(e){
        console.log(e.responseText);	ver_errores(e);
      }
    },
    createdRow: function (row, data, ixdex) {
      // columna: #
      if (data[0] != '') { $("td", row).eq(0).addClass("text-center"); }
      // columna: #
      if (data[1] != '') { $("td", row).eq(1).addClass("text-nowrap"); }
      // columna: #
      if (data[4] != '') { $("td", row).eq(4).addClass("text-center"); }
    },
    language: {
      lengthMenu: "Mostrar: _MENU_ registros",
      buttons: { copyTitle: "Tabla Copiada", copySuccess: { _: "%d líneas copiadas", 1: "1 línea copiada", }, },
      sLoadingRecords: '<i class="fas fa-spinner fa-pulse fa-lg"></i> Cargando datos...'
    },
    bDestroy: true,
    iDisplayLength: 5,//Paginación
    order: [[ 0, "asc" ]]//Ordenar (columna,orden)
  }).DataTable();
  // Ocultar el lengthMenu mediante jQuery
   $('.dataTables_length').css('display', 'none');

}

//Función para guardar o editar
function guardaryeditar_caract_hotel(e) {

  var formData = new FormData($("#form-caract-hotel")[0]);
 
  $.ajax({
    url: "../ajax/hotel.php?op=guardaryeditar_caract_hotel",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (e) {
      e = JSON.parse(e);  console.log(e);  
      if (e.status == true) {

				Swal.fire("Correcto!", " Instalación del hotel registrado correctamente.", "success");

	      tabla_caract_hotel.ajax.reload(null, false);
         
				limpiar_caract_hotel();

        $("#modal-agregar-caract-hotel").modal("hide");        
        
        $("#guardar_registro_caract_hotel").html('Guardar Cambios').removeClass('disabled');
			}else{
				ver_errores(e);	
			}
    },
    xhr: function () {

      var xhr = new window.XMLHttpRequest();

      xhr.upload.addEventListener("progress", function (evt) {

        if (evt.lengthComputable) {

          var percentComplete = (evt.loaded / evt.total)*100;
          /*console.log(percentComplete + '%');*/
          $("#barra_progress_caract_hotel").css({"width": percentComplete+'%'});

          $("#barra_progress_caract_hotel").text(percentComplete.toFixed(2)+" %");
        }
      }, false);
      return xhr;
    },
    beforeSend: function () {
      $("#guardar_registro_caract_hotel").html('<i class="fas fa-spinner fa-pulse fa-lg"></i>').addClass('disabled');
      $("#barra_progress_caract_hotel").css({ width: "0%",  });
      $("#barra_progress_caract_hotel").text("0%");
    },
    complete: function () {
      $("#barra_progress_caract_hotel").css({ width: "0%", });
      $("#barra_progress_caract_hotel").text("0%");
    },
    error: function (jqXhr) { ver_errores(jqXhr); },
  });
}

//mostrar un solo registro
function mostrar_caract_hotel(idinstalaciones_hotel) {

  $(".tooltip").removeClass("show").addClass("hidde");
  $("#cargando-15-fomulario").hide();
  $("#cargando-16-fomulario").show();

  limpiar_caract_hotel();

  $("#modal-agregar-caract-hotel").modal("show")

  $.post("../ajax/hotel.php?op=mostrar_caract_hotel", { idinstalaciones_hotel: idinstalaciones_hotel }, function (e, status) {

    e = JSON.parse(e);  console.log(e);  

    if (e.status == true) {
      $("#idhoteles_GN").val(e.data.idhoteles);
      $("#idinstalaciones_hotel").val(e.data.idinstalaciones_hotel);
      $("#nombre_c_hotel").val(e.data.nombre);
      $("#icono_font_i").val(e.data.icono_font).trigger('change');
      if (e.data.estado_si_no == '1') { $('#estado_switch2').prop('checked', true);   }

      $("#cargando-15-fomulario").show();
      $("#cargando-16-fomulario").hide();
    } else {
      ver_errores(e);
    }
  }).fail( function(e) { ver_errores(e); } );
}

//Función para eliminar registros
function eliminar_caract_hotel(idinstalaciones_hotel, nombre) {  
  
  crud_eliminar_papelera(
    "../ajax/hotel.php?op=desactivar_caract_hotel",
    "../ajax/hotel.php?op=eliminar_caract_hotel", 
    idinstalaciones_hotel, 
    "!Elija una opción¡", 
    `<b class="text-danger"><del>${nombre}</del></b> <br> En <b>papelera</b> encontrará este registro! <br> Al <b>eliminar</b> no tendrá acceso a recuperar este registro!`, 
    function(){ sw_success('♻️ Papelera! ♻️', "Tu registro ha sido reciclado." ) }, 
    function(){ sw_success('Eliminado!', 'Tu registro ha sido Eliminado.' ) }, 
    function(){  tabla_caract_hotel.ajax.reload(null, false); },
    false, 
    false, 
    false,
    false
  );

}

//============================= FIN CARACTERISTICAS HOTEL=======================
//============================= FIN CARACTERISTICAS HOTEL=======================



//=================================== GALERIA HOTEL ============================
//=================================== GALERIA HOTEL ============================
//=================================== GALERIA HOTEL ============================
// abrimos el navegador de archivos
$("#imagen_H_i").click(function() {  $('#imagen_H').trigger('click'); });
$("#imagen_H").change(function(e) {  addImageApplication(e,$("#imagen_H").attr("id")) });

// Eliminamos
function eliminar_galeria() {
	$("#imagen_H").val("");
	$("#imagen_H_ver").html('<img src="../dist/svg/doc_uploads.svg" alt="" width="50%" >');
	$("#imagen_H_nombre").html("");
}

//Función Listar
function listar_galeria_hotel(idhoteles, nombre) {

  idhoteles_R = idhoteles; nombre_R = nombre;
  $("#idhotelesG").val(idhoteles);
  $(".vacio").hide(); $(".mGaleria").show();
  var codigoHTML="";
  $('.nombre_galeria').html(`Galería del hotel - ${nombre}`);
  $('.imagenes_galeria').html('');
  $.post("../ajax/hotel.php?op=listar_galeria_hotel", { idhoteles: idhoteles }, function (e, status) {
    
    e = JSON.parse(e);  console.log(e);

    if (e.data==null || e.data=="") {
      $(".g_imagenes").hide(); $(".sin_imagenes").show();
    }else{
      $(".sin_imagenes").hide(); $(".g_imagenes").show();

      // $('.imagenes_galeria').filterizr('destroy');
      
      e.data.forEach(element => {
        //style="border: 2px solid black;"
        codigoHTML =codigoHTML.concat(`<div class="col-sm-2 pb-2 pt-2" style="border: 2px solid #837f7f;">
        <a href="../dist/docs/hotel/galeria/${element.imagen}?text=1" data-toggle="lightbox" data-title="${element.descripcion}" data-gallery="gallery">
         <img src="../dist/docs/hotel/galeria/${element.imagen}?text=1" class="img-fluid mb-2" alt="white sample"/>
        </a>
        <div class="text-center text-white" style="background-color: #1f7387; cursor: pointer; border-radius: 0.25rem;" onclick="eliminar_imagen_hotel(${element.idgaleria_hotel},'${element.descripcion}');">Eliminar
        </div>

      </div> `);

      });
    
      $('.imagenes_galeria').html(codigoHTML); // Agregar el contenido 

      $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({
          alwaysShowClose: true
        });
      });

    }

    $('.jq_image_zoom').zoom({ on:'grab' });
     
    
    $("#cargando-17-fomulario").show();
    $("#cargando-18-fomulario").hide();
  }).fail( function(e) { ver_errores(e); } );

}

function limpiar_galeria_hotel () { 
  $('#descripcion_G').val("");
  $('#idgaleria_hotel').val("");

  $("#doc_old").val("");
  $("#imagen_H").val("");  
  $('#imagen_H_ver').html(`<img src="../dist/svg/doc_uploads.svg" alt="" width="50%" >`);
  $('#imagen_H_nombre').html("");
  // Limpiamos las validaciones
  $(".form-control").removeClass('is-valid');
  $(".form-control").removeClass('is-invalid');
  $(".error.invalid-feedback").remove();

  $(".tooltip").removeClass("show").addClass("hidde");

}

function eliminar_imagen_hotel(idgaleria_hotel,descripcion) {  
  Swal.fire({
    title: "¿Está seguro de que desea eliminar esta imagen?",
    text: `${descripcion} se eliminara`,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3567dc",
    cancelButtonColor: "#6c757d",
    confirmButtonText: "Sí, Eliminar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post(
        "../ajax/hotel.php?op=eliminar_imagen_hotel",
        { idgaleria_hotel: idgaleria_hotel},
        function (response) {
          try {
            response = JSON.parse(response);
            if (response.status == true) {
              Swal.fire("Verificado", "El comentario ha sido verificado.", "success");
              listar_galeria_hotel(idhoteles_R, nombre_R);
              // Aquí puedes realizar cualquier otra acción después de verificar el comentario
              // tbla_principal();
            } else {
              ver_errores(response);
            }
          } catch (e) {
            ver_errores(e);
          }
        }
      ).fail(function (response) {
        ver_errores(response);
      });
    }
  });

}

function guardar_editar_galeria_hotel(e) {
  // e.preventDefault(); //No se activará la acción predeterminada del evento
  var formData = new FormData($("#form-galeria-hotel")[0]);

  $.ajax({
    url: "../ajax/hotel.php?op=guardar_editar_galeria_hotel",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (e) {
      try {
        e = JSON.parse(e);
        if (e.status == true) {

          Swal.fire("Correcto!", "El registro se guardo correctamente.", "success");
          listar_galeria_hotel(idhoteles_R, nombre_R);
          // tabla_hotel.ajax.reload(null, false);
          $('#modal-agregar-imagen-hotel').modal('hide'); //
          limpiar_galeria_hotel();


        } else {
          ver_errores(e);
        }
      } catch (err) { console.log('Error: ', err.message); toastr.error('<h5 class="font-size-16px">Error temporal!!</h5> puede intentalo mas tarde, o comuniquese con <i><a href="tel:+51921305769" >921-305-769</a></i> ─ <i><a href="tel:+51921487276" >921-487-276</a></i>'); }      
      $("#guardar_registro_galeria_hotel").html('Guardar Cambios').removeClass('disabled');
    },
    beforeSend: function () {
      $("#guardar_registro_galeria_hotel").html('<i class="fas fa-spinner fa-pulse fa-lg"></i>').addClass('disabled');
    },
    error: function (jqXhr) { ver_errores(jqXhr); },
  });
}


//=============================== FIN GALERIA HOTEL ============================
//=============================== FIN GALERIA HOTEL ============================
//=============================== FIN GALERIA HOTEL ============================


init();

$(function () {

  $('#icono_font_c').on('change', function() { $(this).trigger('blur'); });

  $("#form-hotel").validate({
    rules: {
      nombre_hotel: { required: true },
      nro_estrellas: { required: true,  number: true,min:0, max: 5 }
    },
    messages: {
      nombre_hotel: { required: "Campo requerido.", },
      nro_estrellas: { required: "Campo requerido.",  number: "Ingrese un número válido.",   max: "MAXIMO 5.", min: 'MINIMO 0' }
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
      guardaryeditar_hotel(e);      
    },
  });

  $("#form-habitacion").validate({
    rules: {
      nombre_habitacion: { required: true }, 
    },
    messages: {
      nombre_habitacion: { required: "Por favor ingrese nombre.", },
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
      guardaryeditar_habitacion(e);      
    },
  });

  $("#form-caracteristicas_h").validate({
    rules: {
      nombre_caracteristica_h: { required: true }, 
      icono_font_c : {required: true },
    },
    messages: {
      nombre_caracteristica_h: { required: "Campo requerido.", },
      icono_font_c: { required: "Campo requerido.", },
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
      guardaryeditar_caracteristicas_h(e);      
    },
  });

  $("#form-caract-hotel").validate({
    rules: {
      nombre_c_hotel: { required: true }    // terms: { required: true },
    },
    messages: {
      nombre_c_hotel: { required: "Por favor ingrese nombre.", }
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
      guardaryeditar_caract_hotel(e);      
    },
  });

  $("#form-galeria-hotel").validate({
    rules: {
      descripcion_G: { minlength:4 },
      
    },
    messages: {
      descripcion_G: {minlength: "Minimo 4 Caracteres"},
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
      guardar_editar_galeria_hotel(e);
    },

  });

  $('#icono_font_c').rules('add', { required: true, messages: {  required: "Campo requerido" } });

});

