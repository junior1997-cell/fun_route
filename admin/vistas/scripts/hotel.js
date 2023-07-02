var tabla_hotel;

//Función que se ejecuta al inicio
function init() {
  
  $("#bloc_Recurso").addClass("menu-open");

  $("#mRecurso").addClass("active");

  //$("#lAllMateriales").addClass("active");

  listar_hotel();

  $("#guardar_registro_hotel").on("click", function (e) { $("#submit-form-hotel").submit(); });

  // Formato para telefono
  $("[data-mask]").inputmask();
}

//Función limpiar
function limpiar_hotel() {
  $("#guardar_registro_hotel").html('Guardar Cambios').removeClass('disabled');
  //Mostramos los Materiales
  // idhoteles,nro_estrellas, nombre_hotel
  $("#idhoteles").val("");
  $("#nro_estrellas").val(""); 
  $("#nombre_hotel").val(""); 

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
      { extend: 'copyHtml5', footer: true, exportOptions: { columns: [0,2,3], } }, { extend: 'excelHtml5', footer: true, exportOptions: { columns: [0,2,3], } }, { extend: 'pdfHtml5', footer: false, exportOptions: { columns: [0,2], } } ,
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

function guardaryeditar_hotel(e) {
  // e.preventDefault(); //No se activará la acción predeterminada del evento
  var formData = new FormData($("#form-hotel")[0]);
 
  $.ajax({
    url: "../ajax/hotel.php?op=guardaryeditar_hotel",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (e) {
      e = JSON.parse(e);  console.log(e);  
      if (e.status == true) {

				Swal.fire("Correcto!", "hotel trabajado registrado correctamente.", "success");

	      tabla_hotel.ajax.reload(null, false);
         
				limpiar_hotel();

        $("#modal-agregar-hotel").modal("hide");        
        
        $("#guardar_registro_hotel").html('Guardar Cambios').removeClass('disabled');
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
          $("#barra_progress_hotel").css({"width": percentComplete+'%'});

          $("#barra_progress_hotel").text(percentComplete.toFixed(2)+" %");
        }
      }, false);
      return xhr;
    },
    beforeSend: function () {
      $("#guardar_registro_hotel").html('<i class="fas fa-spinner fa-pulse fa-lg"></i>').addClass('disabled');
      $("#barra_progress_hotel").css({ width: "0%",  });
      $("#barra_progress_hotel").text("0%");
    },
    complete: function () {
      $("#barra_progress_hotel").css({ width: "0%", });
      $("#barra_progress_hotel").text("0%");
    },
    error: function (jqXhr) { ver_errores(jqXhr); },
  });
}

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

init();

$(function () {

  $("#form-hotel").validate({
    rules: {
      nombre_hotel: { required: true },      // terms: { required: true },
      nro_estrellas: { number: true,min:0, max: 5 }
    },
    messages: {
      nombre_hotel: { required: "Por favor ingrese nombre.", },
      nro_estrellas: {
        number: "Por favor ingrese un número válido.",
        max: "El número no puede ser mayor que 5."
      }
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
});

