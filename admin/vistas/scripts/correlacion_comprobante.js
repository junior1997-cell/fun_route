var tabla_correlacion;

//Función que se ejecuta al inicio
function init() {
  
  $("#bloc_Recurso").addClass("menu-open");
  $("#mRecurso").addClass("active");

  listar_correlacion();

  $("#guardar_registro_correlacion").on("click", function (e) { $("#submit-form-correlacion").submit(); }); 

  // Formato para telefono
  $("[data-mask]").inputmask();
}

//Función limpiar
function limpiar_correlacion() {
  $("#guardar_registro_correlacion").html('Guardar Cambios').removeClass('disabled');
  $("#idcorrelacion").val('');
  $("#nombre_co").val('');
  $("#abreviatura_co").val('');
  $("#serie_co").val('');
  $("#numero_co").val('');

  // Limpiamos las validaciones
  $(".form-control").removeClass('is-valid');
  $(".form-control").removeClass('is-invalid');
  $(".error.invalid-feedback").remove();
}

//Función Listar
function listar_correlacion() {

  tabla_correlacion=$('#tabla-correlacion').dataTable({
    responsive: true,
    lengthMenu: [[ -1, 5, 10, 25, 75, 100, 200,], ["Todos", 5, 10, 25, 75, 100, 200, ]],//mostramos el menú de registros a revisar
    aProcessing: true,//Activamos el procesamiento del datatables
    aServerSide: true,//Paginación y filtrado realizados por el servidor
    dom:"<'row'<'col-md-3'B><'col-md-3 float-left'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>", //Definimos los elementos del control de tabla
    buttons: [
      { text: '<i class="fa-solid fa-arrows-rotate" data-toggle="tooltip" data-original-title="Recargar"></i>', className: "btn bg-gradient-info", action: function ( e, dt, node, config ) { tabla_correlacion.ajax.reload(); toastr_success('Exito!!', 'Actualizando tabla', 400); } },
      { extend: 'copyHtml5', footer: true, exportOptions: { columns: [0,2,3], }, text: `<i class="fas fa-copy" data-toggle="tooltip" data-original-title="Copiar"></i>`, className: "px-2 btn bg-gradient-gray", }, 
      { extend: 'excelHtml5', footer: true, exportOptions: { columns: [0,2,3], }, text: `<i class="far fa-file-excel fa-lg" data-toggle="tooltip" data-original-title="Excel"></i>`, className: "px-2 btn bg-gradient-success", }, 
      { extend: 'pdfHtml5', footer: false, exportOptions: { columns: [0,2,3], }, text: `<i class="far fa-file-pdf fa-lg" data-toggle="tooltip" data-original-title="PDF"></i>`, className: "px-2 btn bg-gradient-danger", } ,
      //{ extend: "colvis", text: `Columnas`, className: "btn bg-gradient-gray", exportOptions: { columns: "th:not(:last-child)", }, },
    ],
    ajax:{
      url: '../ajax/correlacion_comprobante.php?op=tbla_principal',
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

}

//Función para guardar o editar

function guardar_y_editar_correlacion(e) {
  // e.preventDefault(); //No se activará la acción predeterminada del evento
  var formData = new FormData($("#form-correlacion")[0]);
 
  $.ajax({
    url: "../ajax/correlacion_comprobante.php?op=guardar_y_editar_correlacion",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (e) {
      try {
        e = JSON.parse(e);  console.log(e);  
        if (e.status == true) {
          Swal.fire("Correcto!", "Comprobante registrado correctamente.", "success");
          tabla_correlacion.ajax.reload(null, false);         
          limpiar_correlacion();
          $("#modal-agregar-correlacion").modal("hide");          
        }else{
          ver_errores(e);	
        }
      } catch (err) {
        console.log('Error: ', err.message); toastr.error('<h5 class="font-size-16px">Error temporal!!</h5> puede intentalo mas tarde, o comuniquese con <i><a href="tel:+51921305769" >921-305-769</a></i> ─ <i><a href="tel:+51921487276" >921-487-276</a></i>');
      } 
      $("#guardar_registro_correlacion").html('Guardar Cambios').removeClass('disabled');
    },
    xhr: function () {
      var xhr = new window.XMLHttpRequest();
      xhr.upload.addEventListener("progress", function (evt) {
        if (evt.lengthComputable) {
          var percentComplete = (evt.loaded / evt.total)*100;
          /*console.log(percentComplete + '%');*/
          $("#barra_progress_correlacion").css({"width": percentComplete+'%'}).text(percentComplete.toFixed(2)+" %");
        }
      }, false);
      return xhr;
    },
    beforeSend: function () {
      $("#guardar_registro_correlacion").html('<i class="fas fa-spinner fa-pulse fa-lg"></i>').addClass('disabled');
      $("#barra_progress_correlacion").css({ width: "0%",  }).text("0%");
    },
    complete: function () {
      $("#barra_progress_correlacion").css({ width: "0%", }).text("0%");
    },
    error: function (jqXhr) { ver_errores(jqXhr); },
  });
}

function mostrar_correlacion(idcorrelacion) {
  $(".tooltip").removeClass("show").addClass("hidde");
  $("#cargando-17-fomulario").hide();
  $("#cargando-18-fomulario").show();

  limpiar_correlacion();

  $("#modal-agregar-correlacion").modal("show")

  $.post("../ajax/correlacion_comprobante.php?op=mostrar_correlacion", { 'idcorrelacion': idcorrelacion }, function (e, status) {

    e = JSON.parse(e);  console.log(e);  

    if (e.status == true) {
      $("#idcorrelacion").val(e.data.idsunat_correlacion_comprobante);
      $("#nombre_co").val(e.data.nombre);
      $("#abreviatura_co").val(e.data.abreviatura);
      $("#serie_co").val(e.data.serie);
      $("#numero_co").val(e.data.numero);

      $("#cargando-17-fomulario").show();
      $("#cargando-18-fomulario").hide();
    } else {
      ver_errores(e);
    }
  }).fail( function(e) { ver_errores(e); } );
}

//Función para desactivar registros
function desactivar_correlacion(idcorrelacion, nombre) {  
  
  crud_simple_alerta(
    "../ajax/correlacion_comprobante.php?op=papelera_correlacion",
    idcorrelacion, 
    "!Desactivar¡", 
    `<b class="text-danger"><del>${nombre}</del></b> <br> Este <b>registro</b> no se será visible! `, 
    'Si desactivar',
    function(){ sw_success('♻️ Desactivado! ♻️', "Tu registro ha sido desactivado." ) }, 
    function(){  tabla_correlacion.ajax.reload(null, false); },
    false, 
    false, 
    false,
    false
  );

}

//Función para activar registros
function activar_correlacion(idcorrelacion, nombre) {  
  
  crud_simple_alerta(
    "../ajax/correlacion_comprobante.php?op=activar_correlacion",
    idcorrelacion, 
    "!Activar¡", 
    `<b class="text-success">.::: ${nombre} :::.</b> <br> Este <b>registro</b> se <b>será visible!</b> `, 
    'Si activar',
    function(){ sw_success('✔️ Activado! ✔️', "Tu registro ha sido activado." ) }, 
    function(){  tabla_correlacion.ajax.reload(null, false); },
    false, 
    false, 
    false,
    false
  );

}

init();

$(function () {

  $("#form-correlacion").validate({
    rules: {
      nombre_co:      { required: true, minlength:2, maxlength:30 },      
      abreviatura_co: { required: true, minlength:1, maxlength:20 },     
      serie_co:       { required: true, minlength:2, maxlength:7 },  
      numero_co:      { required: true, number: true, min:0,  },  
    },
    messages: {
      nombre_co:      { required: "Campo requerido.", minlength: "MINIMO 2 caracteres.", maxlength: "MAXIMO 30 caracteres." },
      abreviatura_co: { required: "Campo requerido.", minlength: "MINIMO 1 caracteres.", maxlength: "MAXIMO 20 caracteres." },
      serie_co:       { required: "Campo requerido.", minlength: "MINIMO 2 caracteres.", maxlength: "MAXIMO 7 caracteres." },
      numero_co:      { required: "Campo requerido.", number: "Campo númerico", min: "MINIMO 0 digitos." },
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
      guardar_y_editar_correlacion(e);      
    },
  });
});

