var tabla;
var id_get = varaibles_get();
var id =id_get.id;
var carpeta =id_get.carpeta;
console.log(carpeta);

//Función que se ejecuta al inicio
$(document).on("ready", function () {

  $(`.mvalores${id_get.id}`).addClass("active");

  $("#id_paginaweb").val(id_get.id);
  $("#carpeta_pag").val(id_get.carpeta);
  listar(id_get.id);  

  $("#guardar_registro").on("click", function (e) {$("#submit-form-valores").submit();});

});

$("#doc1_i").click(function() {  $('#doc1').trigger('click'); });
$("#doc1").change(function(e) {  addImageApplication(e,$("#doc1").attr("id")) });

// Eliminamos el doc 1
function doc1_eliminar() {

	$("#doc1").val("");

	$("#doc1_ver").html('<img src="../dist/svg/drag-n-drop.svg" alt="" width="50%" >');

	$("#doc1_nombre").html("");
}

//revisualizar imagen
$(document).ready(function() {
  $('.revisualizar').attr("onclick",`1, 'admin/dist/img/${carpeta}/img'`);
  //console.log($('.revisualizar').attr("onclick"));
});

//Función limpiar
function limpiar() {

  $("#idvalores").val("");
  $("#nombre").val("");
  $("#descripcion").val(""); 

  $("#doc_old_1").val("");
  $("#doc1").val("");  
  $('#doc1_ver').html(`<img src="../dist/svg/drag-n-drop.svg" alt="" width="50%" >`);
  $('#doc1_nombre').html("");

  // Limpiamos las validaciones
  $(".form-control").removeClass('is-valid');
  $(".form-control").removeClass('is-invalid');
  $(".error.invalid-feedback").remove();

}

//Función Listar
function listar(id) {

  $(".tabla").hide();
  $(".cargando").show();

  tabla=$('#tabla-valores').dataTable({
    "responsive": true,
    lengthMenu: [[ -1, 5, 10, 25, 75, 100, 200,], ["Todos", 5, 10, 25, 75, 100, 200, ]],//mostramos el menú de registros a revisar
    "aProcessing": true,//Activamos el procesamiento del datatables
    "aServerSide": true,//Paginación y filtrado realizados por el servidor
    dom: '<Bl<f>rtip>',//Definimos los elementos del control de tabla
    buttons: ['excelHtml5','pdf'],
    "ajax":{
        url: `../ajax/valores.php?op=listar&id=${id}&carpeta=${carpeta}`,
        type : "get",
        dataType : "json",						
        error: function(e){
          console.log(e.responseText);	
        }
      },
      createdRow: function (row, data, ixdex) {
        if (data[0] != '') { $("td", row).eq(0).addClass('text-center'); }
        if (data[2] != '') { $("td", row).eq(2).addClass('text-nowrap'); }
        $("td", row).addClass('class_table');
      },
    "language": {
      "lengthMenu": "Mostrar: _MENU_ registros",
      "buttons": {
        "copyTitle": "Tabla Copiada",
        "copySuccess": {
          _: '%d líneas copiadas',
          1: '1 línea copiada'
        }
      }
    },
    "bDestroy": true,
    "iDisplayLength": 5,//Paginación
    "order": [[ 0, "asc" ]]//Ordenar (columna,orden)
  }).DataTable();
  
  $(".tabla").show();
  $(".cargando").hide();
}

//ver imagen
function ver_img_perfil(img_perfil,nombre_valor){

  $('#modal-ver-imagen').modal("show");
  $('#nombre_valor').html(nombre_valor);

  if (img_perfil == "" || img_perfil == null  ) {

    $(".img_modal_xl_").html(`<img class="rounded-lg" src="../dist/svg/drag-n-drop.svg" style="width: 100%;"  alt="Image Description"></img>`)

  }else{
    
    $(".img_modal_xl_").html(`<img class="rounded-lg" src="../dist/${carpeta}/img/${img_perfil}" style="width: 100%;"  alt="Image Description"></img>`)

  }
}

//Función para guardar o editar

function guardaryeditar(e) {
  // e.preventDefault(); //No se activará la acción predeterminada del evento
  var formData = new FormData($("#form-valores")[0]);
 
  $.ajax({
    url: "../ajax/valores.php?op=guardaryeditar",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (e) {             
      try {
        e = JSON.parse(e);  console.log(e);   
        if (e.status == true) {
          Swal.fire("Correcto!", "Registrado correctamente", "success");
          tabla.ajax.reload();         
          limpiar();  
          $("#modal-agregar-valores").modal("hide");  
        }else{  
          ver_errores(e);
        }   
      } catch (err) {
        console.log('Error: ', err.message); toastr.error('<h5 class="font-size-16px">Error temporal!!</h5> puede intentalo mas tarde, o comuniquese con <i><a href="tel:+51921305769" >921-305-769</a></i> ─ <i><a href="tel:+51921487276" >921-487-276</a></i>');
      } 
      $("#guardar_registro").html('Actualizar').removeClass('disabled');

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
      $("#guardar_registro").html('<i class="fas fa-spinner fa-pulse fa-lg"></i>').addClass('disabled');
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

function mostrar(idvalores) {
  limpiar();

  $("#modal-agregar-valores").modal("show");

  $("#cargando-1-fomulario").hide();
  $("#cargando-2-fomulario").show();

  $.post("../ajax/valores.php?op=mostrar_valor", { idvalores: idvalores }, function (e, status) {

    e = JSON.parse(e);  console.log(e);  

    if (e.status == true) {      

      $("#id_paginaweb").val(e.data.idpagina_web);
      $("#idvalores").val(e.data.idvalores);
      $("#nombre").val(e.data.nombre_valor);
      $("#descripcion").val(e.data.descripcion);
        
      if (e.data.icono == "" || e.data.icono == null  ) {

        $("#doc1_ver").html('<img src="../dist/svg/doc_uploads.svg" alt="" width="50%" >');
        $("#doc1_nombre").html('');
        $("#doc_old_1").val(""); $("#doc1").val("");

      } else {

        $("#doc_old_1").val(e.data.icono); 
        $("#doc1_nombre").html(`<div class="row"> <div class="col-md-12"><i>Imagen.${extrae_extencion(e.data.icono)}</i></div></div>`);
        $("#doc1_ver").html(doc_view_extencion(e.data.icono, `admin/dist/${carpeta}/img`, '100%'));        
      } 

      $("#cargando-1-fomulario").show();
      $("#cargando-2-fomulario").hide();
      
    } else {
      ver_errores(e);
    } 

  }).fail( function(e) { console.log(e); ver_errores(e); } );
}

//Función para eliminar registros
function eliminar(idvalores) {
  Swal.fire({
    title: "¿Está Seguro de  Eliminar el registro?",
    text: "",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#28a745",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Eliminar!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post("../ajax/valores.php?op=eliminar", { idvalores: idvalores }, function (e) {

        Swal.fire("Eliminado!", "Tu registro ha sido Eliminado.", "success");
    
        tabla.ajax.reload();
      });      
    }
  });   
}

var idproyecto=0;

$(function () {  

  $("#form-valores").validate({
    ignore: '.select2-input, .select2-focusser',
    rules: {
      nombre:{required: true},
      descripcion:{required: true}, 
    },
    messages: {
      nombre: { required: "Campo requerido", },
      descripcion: { required: "Campo requerido", }, 
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
      guardaryeditar(e);      
    },
  });

});

function extrae_extencion(filename) {
    return filename.split('.').pop();
}




