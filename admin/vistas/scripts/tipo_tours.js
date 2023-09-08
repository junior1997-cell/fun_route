var tabla_tipo_tours;

//Función que se ejecuta al inicio
function init() {
  
  $("#bloc_Recurso").addClass("menu-open");

  $("#mRecurso").addClass("active");

  //$("#lAllMateriales").addClass("active");

  listar_tipo_tours();

  $("#guardar_registro_tipo_tours").on("click", function (e) { $("#submit-form-tipo-tours").submit(); });

  // Evento para mostrar el lengthMenu nuevamente al hacer clic en un botón (o cualquier otro evento)
  $('#mostrarLengthMenu').on('click', function() {
    $('.dataTables_length').css('display', 'block');
  });

  // Formato para telefono
  $("[data-mask]").inputmask();
}

//Función limpiar
function limpiar_tipo_tours() {
  $("#guardar_registro_tipo_tours").html('Guardar Cambios').removeClass('disabled');
  //Mostramos los Materiales
  $("#idtipo_tours").val("");
  $("#nombre_tt").val(""); 
  $("#descripcion_tt").val(""); 

  // Limpiamos las validaciones
  $(".form-control").removeClass('is-valid');
  $(".form-control").removeClass('is-invalid');
  $(".error.invalid-feedback").remove();
}

//Función Listar
function listar_tipo_tours() {

  tabla_tipo_tours=$('#tabla-tipo-tours').dataTable({
    responsive: true,
    lengthMenu: [[ -1, 5, 10, 25, 75, 100, 200,], ["Todos", 5, 10, 25, 75, 100, 200, ]],//mostramos el menú de registros a revisar
    aProcessing: true,//Activamos el procesamiento del datatables
    aServerSide: true,//Paginación y filtrado realizados por el servidor
    dom:"<'row'<'col-md-3'B><'col-md-3 float-left'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>", //Definimos los elementos del control de tabla
    buttons: [
      { text: '<i class="fa-solid fa-arrows-rotate" data-toggle="tooltip" data-original-title="Recargar"></i>', className: "btn bg-gradient-info", action: function ( e, dt, node, config ) { tabla_tipo_tours.ajax.reload(); toastr_success('Exito!!', 'Actualizando tabla', 400); } },
      { extend: 'copyHtml5', footer: true, exportOptions: { columns: [0,2,3], }, text: `<i class="fas fa-copy" data-toggle="tooltip" data-original-title="Copiar"></i>`, className: "px-2 btn bg-gradient-gray", }, 
      { extend: 'excelHtml5', footer: true, exportOptions: { columns: [0,2,3], }, text: `<i class="far fa-file-excel fa-lg" data-toggle="tooltip" data-original-title="Excel"></i>`, className: "px-2 btn bg-gradient-success", }, 
      { extend: 'pdfHtml5', footer: false, exportOptions: { columns: [0,2,3], }, text: `<i class="far fa-file-pdf fa-lg" data-toggle="tooltip" data-original-title="PDF"></i>`, className: "px-2 btn bg-gradient-danger", } ,
      //{ extend: "colvis", text: `Columnas`, className: "btn bg-gradient-gray", exportOptions: { columns: "th:not(:last-child)", }, },
    ],
    ajax:{
      url: '../ajax/tipo_tours.php?op=listar_tabla_principal',
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

function guardaryeditar_tipo(e) {
  // e.preventDefault(); //No se activará la acción predeterminada del evento
  var formData = new FormData($("#form-tipo-tours")[0]);
 
  $.ajax({
    url: "../ajax/tipo_tours.php?op=guardaryeditar_tipo_tours",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (e) {
      e = JSON.parse(e);  console.log(e);  
      if (e.status == true) {

				Swal.fire("Correcto!", "Tipo tours registrado correctamente.", "success");

	      tabla_tipo_tours.ajax.reload(null, false);
         
				limpiar_tipo_tours();

        $("#modal-agregar-tipo-tours").modal("hide");        
        
        $("#guardar_registro_tipo_tours").html('Guardar Cambios').removeClass('disabled');
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
          $("#barra_progress_tipo_tours").css({"width": percentComplete+'%'}).text(percentComplete.toFixed(2)+" %");
        }
      }, false);
      return xhr;
    },
    beforeSend: function () {
      $("#guardar_registro_tipo_tours").html('<i class="fas fa-spinner fa-pulse fa-lg"></i>').addClass('disabled');
      $("#barra_progress_tipo_tours").css({ width: "0%",  }).text("0%");
    },
    complete: function () {
      $("#barra_progress_tipo_tours").css({ width: "0%", }).text("0%");
    },
    error: function (jqXhr) { ver_errores(jqXhr); },
  });
}

function mostrar_tipo_tours(idtipo_tours) {
  $(".tooltip").removeClass("show").addClass("hidde");
  $("#cargando-5-fomulario").hide();
  $("#cargando-6-fomulario").show();

  limpiar_tipo_tours();

  $("#modal-agregar-tipo-tours").modal("show")

  $.post("../ajax/tipo_tours.php?op=mostrar_tipo_tours", { idtipo_tours: idtipo_tours }, function (e, status) {

    e = JSON.parse(e);  console.log(e);  

    if (e.status) {
      $("#idtipo_tours").val(e.data.idtipo_tours);
      $("#nombre_tt").val(e.data.nombre);
      $("#descripcion_tt").val(e.data.descripcion);

      $("#cargando-5-fomulario").show();
      $("#cargando-6-fomulario").hide();
    } else {
      ver_errores(e);
    }
  }).fail( function(e) { ver_errores(e); } );
}

//Función para eliminar registros
function eliminar_tipo_tours(idtipo_tours, nombre) {  
  
  crud_eliminar_papelera(
    "../ajax/tipo_tours.php?op=desactivar_tipo_tours",
    "../ajax/tipo_tours.php?op=eliminar_tipo_tours", 
    idtipo_tours, 
    "!Elija una opción¡", 
    `<b class="text-danger"><del>${nombre}</del></b> <br> En <b>papelera</b> encontrará este registro! <br> Al <b>eliminar</b> no tendrá acceso a recuperar este registro!`, 
    function(){ sw_success('♻️ Papelera! ♻️', "Tu registro ha sido reciclado." ) }, 
    function(){ sw_success('Eliminado!', 'Tu registro ha sido Eliminado.' ) }, 
    function(){  tabla_tipo.ajax.reload(null, false); },
    false, 
    false, 
    false,
    false
  );

}

init();

$(function () {

  $("#form-tipo-tours").validate({
    rules: {
      nombre_tipo: { required: true }      // terms: { required: true },
    },
    messages: {
      nombre_tipo: { required: "Por favor ingrese nombre.", },
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
      guardaryeditar_tipo(e);      
    },
  });
});

