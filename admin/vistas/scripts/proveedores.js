var tabla;

function init() {

  console.log(location.host);
  $(".mproveedores").addClass("active");

  listar();  

  //Mostramos los proveedores
  $.post("../ajax/proveedores.php?op=select2_proveedor", function (r) { 
    $("#id_proveedor_adm").html(r); 
    $(".cargando__").html('Proveedor <sup class="text-danger">*</sup>');
    $("#id_proveedor_adm").val('null').trigger("change");
  });

  $("#guardar_registro").on("click", function (e) { $("#submit-form-proveedores").submit();});
  
}

// abrimos el navegador de archivos
$("#doc1_i").click(function() {  $('#doc1').trigger('click'); });
$("#doc1").change(function(e) {  addImageApplication(e,$("#doc1").attr("id")) });

function doc1_eliminar() {

	$("#doc1").val("");

	$("#doc1_ver").html('<img src="../dist/svg/drag-n-drop.svg" alt="" width="50%" >');

	$("#doc1_nombre").html("");
}

function limpiar() {

  $("#idproveedor").val("");
  $("#id_proveedor_adm").val('null').trigger("change");
  $("#nombre").val("");
  $("#descripcion").val(""); 

  $.post("../ajax/proveedores.php?op=select2_proveedor", function (r) { 
    $("#id_proveedor_adm").html(r); 
    $(".cargando__").html('Proveedor <sup class="text-danger">*</sup>');
    $("#id_proveedor_adm").val('null').trigger("change");
  });
  
  $("#doc_old_1").val("");
  $("#doc1").val("");  
  $('#doc1_ver').html(`<img src="../dist/svg/drag-n-drop.svg" alt="" width="50%" >`);
  $('#doc1_nombre').html("");

  // Limpiamos las validaciones
  $(".form-control").removeClass('is-valid');
  $(".form-control").removeClass('is-invalid');
  $(".error.invalid-feedback").remove();

}

function mostrar_select(estado) {

  if (estado==1) {
    $(".selectt").show();
    $(".edith").hide();
    $(".selec_proveedor_adm").hide();
    $(".selec_proveedor_adm").hide();
  }

  if (estado==2) {
    $(".selectt").hide();    
    $(".edith").show();
    $(".selec_proveedor_adm").show();
    $(".id_proveedor_adm_edith").show();
  }
  
}

function listar() {

  $(".tabla").hide();
  $(".cargando").show();

  tabla=$('#tabla-proveedor').dataTable({
    "responsive": true,
    lengthMenu: [[ -1, 5, 10, 25, 75, 100, 200,], ["Todos", 5, 10, 25, 75, 100, 200, ]],//mostramos el menú de registros a revisar
    "aProcessing": true,//Activamos el procesamiento del datatables
    "aServerSide": true,//Paginación y filtrado realizados por el servidor
    dom: '<Bl<f>rtip>',//Definimos los elementos del control de tabla
    buttons: ['excelHtml5','pdf'],
    "ajax":{
        url: '../ajax/proveedores.php?op=listar',
        type : "get",
        dataType : "json",						
        error: function(e){
          console.log(e.responseText);	
        }
      },
      createdRow: function (row, data, ixdex) {
        $("td", row).addClass('class_table');
        // columna: #
        if (data[0] != '') { $("td", row).eq(0).addClass('text-center'); }
        if (data[1] != '') { $("td", row).eq(1).addClass('text-center'); }
        // columna: #
        if (data[2] != '') { $("td", row).eq(2).addClass('text-nowrap'); }
      },
    "language": {
      "lengthMenu": "Mostrar: _MENU_ registros",
      "buttons": {
        "copyTitle": "Tabla Copiada",
        "copySuccess": {
          _: '%d líneas copiadas',
          1: '1 línea copiada'
        }
      },
      sLoadingRecords: '<i class="fas fa-spinner fa-pulse fa-lg"></i> Cargando datos...'
    },
    "bDestroy": true,
    "iDisplayLength": 5,//Paginación
    "order": [[ 0, "asc" ]]//Ordenar (columna,orden)
  }).DataTable();
  
  $(".tabla").show();
  $(".cargando").hide();
}

function guardaryeditar(e) {
  
  var formData = new FormData($("#form-proveedores")[0]);
 
  $.ajax({
    url: "../ajax/proveedores.php?op=guardaryeditar",
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
  
          $("#modal-agregar-proveedores").modal("hide");
  
        }else{  
  
          ver_errores(e);
        } 
  
        $("#guardar_registro_fase").html('Guardar Cambios').removeClass('disabled');
  
      } catch (err) {
        console.log('Error: ', err.message); toastr.error('<h5 class="font-size-16px">Error temporal!!</h5> puede intentalo mas tarde, o comuniquese con <i><a href="tel:+51921305769" >921-305-769</a></i> ─ <i><a href="tel:+51921487276" >921-487-276</a></i>');
      } 

    },
  });
}

function mostrar(idproveedor) {

  limpiar();
  mostrar_select(2);
  $("#modal-agregar-proveedores").modal("show");

  $("#cargando-1-fomulario").hide();
  $("#cargando-2-fomulario").show();

  $.post("../ajax/proveedores.php?op=mostrar", { idproveedor: idproveedor }, function (e, status) {

    e = JSON.parse(e);  console.log(e);  
    if (e.status) {
      
      $("#idproveedor").val(e.data.idproveedor);
      $("#nombre").val(e.data.nombre_valor);
      $("#descripcion").val(e.data.descripcion);
      $(".selec_proveedor_adm").val(e.data.razon_social+' - '+e.data.num_documento);
      $("#id_proveedor_adm_edith").val(e.data.id_proveedor_admin);


      if (e.data.img_perfil == "" || e.data.img_perfil == null  ) {

        $("#doc1_ver").html('<img src="../dist/svg/doc_uploads.svg" alt="" width="50%" >');
        $("#doc1_nombre").html('');
        $("#doc_old_1").val(""); $("#doc1").val("");

      } else {

        $("#doc_old_1").val(e.data.img_perfil); 
        $("#doc1_nombre").html(`<div class="row"> <div class="col-md-12"><i>Imagen.${extrae_extencion(e.data.img_perfil)}</i></div></div>`);
        // cargamos la img_perfil adecuada par el archivo
        $("#doc1_ver").html(doc_view_extencion(e.data.img_perfil, 'proveedores', 'imagen_perfil', '100%'));        
      } 

      $("#cargando-1-fomulario").show();
      $("#cargando-2-fomulario").hide();

    } else {
      ver_errores(e);
    } 

  }).fail( function(e) { console.log(e); ver_errores(e); } );
}

//ver img proveedores
function ver_img_perfil(img_perfil,razon_social){

  $('#modal-ver-imagen').modal("show");
  $('#razon_social').html(razon_social);

  if (img_perfil == "" || img_perfil == null  ) {

   $(".img_modal_xl_").html(`<img class="rounded-lg" src="../dist/svg/drag-n-drop.svg" style="width: 100%;"  alt="Image Description"></img>`)

  }else{
    
   $(".img_modal_xl_").html(`<img class="rounded-lg" src="../dist/img/proveedores/imagen_perfil/${img_perfil}" style="width: 100%;"  alt="Image Description"></img>`)

  }

}

function eliminar(idproveedor) {
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
      $.post("../ajax/proveedores.php?op=eliminar", { idproveedor: idproveedor }, function (e) {

        Swal.fire("Eliminado!", "Tu registro ha sido Eliminado.", "success");
    
        tabla.ajax.reload();
        total();
      });      
    }
  });   
}

init();

var idproveedor=0;

$(function () {
  
  $("#form-proveedores").validate({
    ignore: '.select2-input, .select2-focusser',
    rules: { 
      descripcion: {required: true}, 
    },
    messages: { 
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




