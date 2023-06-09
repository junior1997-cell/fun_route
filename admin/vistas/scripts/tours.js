var tabla_tours;
var idpaquete_r, nombre_r;
//Función que se ejecuta al inicio
function init() {
  //Activamos el "aside"

  $("#bloc_Logisticatours").addClass("menu-open");

  $("#bloc_ltours").addClass("menu-open bg-color-191f24");
  // bloc_ltourss
  $("#mltours").addClass("active");

  $("#mltours").addClass("active bg-green");

  $("#ltours").addClass("active");
  
  tbla_principal();
  // ══════════════════════════════════════ S E L E C T 2 ═════════════════════════════════════════
  lista_select2("../ajax/tours.php?op=selec2tipotours", '#idtipo_tours', null);

  // ══════════════════════════════════════ G U A R D A R   F O R M ═══════════════════════════════
  $("#guardar_registro_tours").on("click", function (e) { $("#submit-form-tours").submit(); });
  $("#guardar_registro_galeria_tours").on("click", function (e) { $("#submit-form-galeria_tours").submit(); });
  // $("#guardar_registro_galeria").on("click", function (e) { $("#submit-form-galeria").submit(); });

  // ══════════════════════════════════════ INITIALIZE SELECT2 ════════════════════════════════════
  $("#idtipo_tours").select2({theme:"bootstrap4", placeholder: "Selec. tipo tours.", allowClear: true, });

  // ══════════════════════════════════════ INITIALIZE SUMERNOTE ══════════════════════════════════
  $('#incluye').summernote(); $('#no_incluye').summernote();  $('#recomendaciones').summernote();
  $('#actividad').summernote({ placeholder: 'Descripión de las actividades'});
  
 // incluye,no_incluye recomendaciones
  // Formato para telefono
  $("[data-mask]").inputmask();
  $(".titulo").html('Agregar Tours');
}

// abrimos el navegador de archivos
$("#doc1_i").click(function() {  $('#doc1').trigger('click'); });
$("#doc1").change(function(e) {  addImageApplication(e,$("#doc1").attr("id")) });


// Eliminamos el doc 1
function doc1_eliminar() {
	$("#doc1").val("");
	$("#doc1_ver").html('<img src="../dist/svg/doc_uploads.svg" alt="" width="50%" >');
	$("#doc1_nombre").html("");
}

//Función limpiar
function limpiar_tours() {
  $("#idtours").val("");
  $("#idtipo_tours").val("").trigger("change");
  $("#nombre").val("");
  $("#imagen").val("");
  $("#descripcion").val("");

 // -------OTROS----------
 
 $("#incluye").summernote('code', '');
 $("#no_incluye").summernote('code', '');
 $("#recomendaciones").summernote('code', '');
  // -------ITINERARIO-------
 $("#actividad").summernote('code', '');

  // -------COSTO----------
 $("#costo").val("");
 $("#estado_descuento").val("");
 $("#porcentaje_descuento").val("");
 $("#monto_descuento").val("");

 $(".btn_footer").show();

 $(".datos_tours").css('pointer-events', '');
 $(".otros").css('pointer-events', '');
 $(".itinerario").css('pointer-events', '');
 $(".costos").css('pointer-events', '');

 $("#doc_old_1").val("");
 $("#doc1").val("");  
 $('#doc1_ver').html(`<img src="../dist/svg/doc_uploads.svg" alt="" width="50%" >`);
 $('#doc1_nombre').html("");

  // Limpiamos las validaciones
  $(".form-control").removeClass('is-valid');
  $(".form-control").removeClass('is-invalid');
  $(".error.invalid-feedback").remove();

  $(".tooltip").removeClass("show").addClass("hidde");
}

function show_hide_form(flag) {
	if (flag == 1)	{		
		$("#mostrar-tabla").show();
    $("#mostrar-form").hide();
    $(".btn-regresar").hide();
    $(".btn-agregar-galeria").hide();
    
    $(".btn-agregar").show();
    $("#galeria").hide();
	}	else	{
		$("#mostrar-tabla").hide();
    $("#mostrar-form").show();
    $(".btn-regresar").show();
    $(".btn-agregar-galeria").show();
    $(".btn-agregar").hide();
    $("#galeria").show();
	}
}

//Función Listar
function tbla_principal() {
  tabla_tours = $("#tabla-tours").dataTable({
    responsive: true,
    lengthMenu: [[ -1, 5, 10, 25, 75, 100, 200,], ["Todos", 5, 10, 25, 75, 100, 200, ]], //mostramos el menú de registros a revisar
    aProcessing: true, //Activamos el procesamiento del datatables
    aServerSide: true, //Paginación y filtrado realizados por el servidor
    dom: "<'row'<'col-md-3'B><'col-md-3 float-left'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>", //Definimos los elementos del control de tabla
    buttons: [      
      { text: '<i class="fa-solid fa-arrows-rotate" data-toggle="tooltip" data-original-title="Recargar"></i>', className: "btn bg-gradient-info", action: function ( e, dt, node, config ) { tabla_tours.ajax.reload(null, false); toastr_success('Exito!!', 'Actualizando tabla', 400); } },
      { extend: 'copyHtml5', exportOptions: { columns: [0,1,2,3], }, text: `<i class="fas fa-copy" data-toggle="tooltip" data-original-title="Copiar"></i>`, className: "btn bg-gradient-gray", footer: true,  }, 
      { extend: 'excelHtml5', exportOptions: { columns: [0,1,2,3], }, text: `<i class="far fa-file-excel fa-lg" data-toggle="tooltip" data-original-title="Excel"></i>`, className: "btn bg-gradient-success", footer: true,  }, 
      { extend: 'pdfHtml5', exportOptions: { columns: [0,1,2,3], }, text: `<i class="far fa-file-pdf fa-lg" data-toggle="tooltip" data-original-title="PDF"></i>`, className: "btn bg-gradient-danger", footer: false, orientation: 'landscape', pageSize: 'LEGAL',  },
      { extend: "colvis", text: `Columnas`, className: "btn bg-gradient-gray", exportOptions: { columns: "th:not(:last-child)", }, },
    ],
    ajax: {
      url: "../ajax/tours.php?op=tbla_principal",
      type: "get",
      dataType: "json",
      error: function (e) {
        console.log(e.responseText); 
      },
    },
    createdRow: function (row, data, ixdex) {
      // columna: #
      if (data[0] != "") { $("td", row).eq(0).addClass("text-center"); }
      // columna: 
      if (data[1] != "") { $("td", row).eq(1).addClass("text-nowrap"); }
      // columna: 
      if (data[5] != "") { $("td", row).eq(5).addClass("text-nowrap"); }
      // columna: 
      if (data[6] != "") { $("td", row).eq(6).addClass("text-center"); }

    },
    language: {
      lengthMenu: "Mostrar: _MENU_ registros",
      buttons: { copyTitle: "Tabla Copiada", copySuccess: { _: "%d líneas copiadas", 1: "1 línea copiada", }, },
      sLoadingRecords: '<i class="fas fa-spinner fa-pulse fa-lg"></i> Cargando datos...'
    },
    footerCallback: function( tfoot, data, start, end, display ) {},
    bDestroy: true,
    iDisplayLength: 10, //Paginación
    order: [[0, "asc"]], //Ordenar (columna,orden)
    columnDefs: [],
  }).DataTable();

}

//Función para guardar o editar
function guardar_y_editar_tours(e) {
  // e.preventDefault(); //No se activará la acción predeterminada del evento
  var formData = new FormData($("#form-tours")[0]);

  $.ajax({
    url: "../ajax/tours.php?op=guardar_y_editar_tours",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (e) {
      try {
        e = JSON.parse(e);
        if (e.status == true) {

          Swal.fire("Correcto!", "El registro se guardo correctamente.", "success");

          tabla_tours.ajax.reload(null, false);
          $('#modal-agregar-tours').modal('hide'); //
          
          limpiar_tours();   

        } else {
          ver_errores(e);
        }
      } catch (err) { console.log('Error: ', err.message); toastr.error('<h5 class="font-size-16px">Error temporal!!</h5> puede intentalo mas tarde, o comuniquese con <i><a href="tel:+51921305769" >921-305-769</a></i> ─ <i><a href="tel:+51921487276" >921-487-276</a></i>'); }      
      $("#guardar_registro").html('Guardar Cambios').removeClass('disabled');
    },
    beforeSend: function () {
      $("#guardar_registro").html('<i class="fas fa-spinner fa-pulse fa-lg"></i>').addClass('disabled');
    },
    error: function (jqXhr) { ver_errores(jqXhr); },
  });
}


function mostrar_tours(idtours) {

  limpiar_tours();
  // $(".btn_footer").hide();
  $(".titulo").html('Ver datos del Tours para editar');

  $("#cargando-1-fomulario").hide();
  $("#cargando-2-fomulario").show();

  $("#modal-agregar-tours").modal("show");

  $.post("../ajax/tours.php?op=mostrar", { idtours: idtours }, function (e, status) {
    
    e = JSON.parse(e); console.log(e);    

    $("#idtours").val(e.data.idtours).trigger("change");
    $("#idtipo_tours").val(e.data.idtipo_tours).trigger("change");
    $("#nombre").val(e.data.nombre).trigger("change");
    $("#descripcion").val(e.data.descripcion);

    $("#incluye").summernote ('code', e.data.incluye);
    $("#no_incluye").summernote ('code', e.data.no_incluye);
    $("#recomendaciones").summernote ('code', e.data.recomendaciones);
     // -------ITINERARIO-------
    $("#actividad").summernote ('code', e.data.actividad);
   
     // -------COSTO----------
    $("#costo").val(e.data.costo);
    $("#estado_descuento").val(e.data.estado_descuento);
    $("#porcentaje_descuento").val(e.data.porcentaje_descuento);
    $("#monto_descuento").val(e.data.monto_descuento);

    if (e.data.estado_descuento == "1") {
      $("#estado_switch").prop("checked", true);
    } else {
      $("#estado_switch").prop("checked", false);
    } 

        
    if (e.data.imagen == "" || e.data.imagen == null  ) {

      $("#doc1_ver").html('<img src="../dist/svg/pdf_trasnparent.svg" alt="" width="50%" >');

      $("#doc1_nombre").html('');

      $("#doc_old_1").val(""); $("#doc1").val("");

    } else {

      $("#doc_old_1").val(e.data.comprobante); 

      $("#doc1_nombre").html(`<div class="row"> <div class="col-md-12"><i>Baucher.${extrae_extencion(e.data.imagen)}</i></div></div>`);
      // cargamos la imagen adecuada par el archivo
      $("#doc1_ver").html(doc_view_extencion(e.data.imagen,'tours', 'perfil', '100%', '210' ));   //ruta imagen    
          
    }
    $('.jq_image_zoom').zoom({ on:'grab' });
     
    
    $("#cargando-1-fomulario").show();
    $("#cargando-2-fomulario").hide();
  }).fail( function(e) { ver_errores(e); } );
}

function ver_detalle_tours(idtours) {
  limpiar_tours();
  $(".btn_footer").hide();
  $(".titulo").html('Ver datos del Tours');

  $(".datos_tours").css('pointer-events', 'none');
  $(".otros").css('pointer-events', 'none');
  $(".itinerario").css('pointer-events', 'none');
  $(".costos").css('pointer-events', 'none');
  
  $("#cargando-1-fomulario").hide();
  $("#cargando-2-fomulario").show();

  $("#modal-agregar-tours").modal("show");

  $.post("../ajax/tours.php?op=mostrar", { idtours: idtours }, function (e, status) {
    
    e = JSON.parse(e); console.log(e);    

    $("#idtours").val(e.data.idtours).trigger("change");
    $("#idtipo_tours").val(e.data.idtipo_tours).trigger("change");
    $("#nombre").val(e.data.nombre).trigger("change");
    $("#descripcion").val(e.data.descripcion);

    $("#incluye").summernote ('code', e.data.incluye);
    $("#no_incluye").summernote ('code', e.data.no_incluye);
    $("#recomendaciones").summernote ('code', e.data.recomendaciones);
     // -------ITINERARIO-------
    $("#actividad").summernote ('code', e.data.actividad);
   
     // -------COSTO----------
    $("#costo").val(e.data.costo);
    $("#estado_descuento").val(e.data.estado_descuento);
    $("#porcentaje_descuento").val(e.data.porcentaje_descuento);
    $("#monto_descuento").val(e.data.monto_descuento);

    if (e.data.estado_descuento == "1") {
      $("#estado_switch").prop("checked", true);
    } else {
      $("#estado_switch").prop("checked", false);
    } 

        
    if (e.data.imagen == "" || e.data.imagen == null  ) {

      $("#doc1_ver").html('<img src="../dist/svg/pdf_trasnparent.svg" alt="" width="50%" >');

      $("#doc1_nombre").html('');

      $("#doc_old_1").val(""); $("#doc1").val("");

    } else {

      $("#doc_old_1").val(e.data.comprobante); 

      $("#doc1_nombre").html(`<div class="row"> <div class="col-md-12"><i>Baucher.${extrae_extencion(e.data.imagen)}</i></div></div>`);
      // cargamos la imagen adecuada par el archivo
      $("#doc1_ver").html(doc_view_extencion(e.data.imagen,'tours', 'perfil', '100%', '210' ));   //ruta imagen    
          
    }
    $('.jq_image_zoom').zoom({ on:'grab' });
     
    
    $("#cargando-1-fomulario").show();
    $("#cargando-2-fomulario").hide();
  }).fail( function(e) { ver_errores(e); } );
}

//Función para desactivar registros
function eliminar_tours(idtours,nombre) {

  crud_eliminar_papelera(
    "../ajax/tours.php?op=desactivar",
    "../ajax/tours.php?op=eliminar", 
    idtours, 
    "!Elija una opción¡", 
    `<b class="text-danger"><del> ${nombre} </del></b> <br> En <b>papelera</b> encontrará este registro! <br> Al <b>eliminar</b> no tendrá acceso a recuperar este registro!`, 
    function(){ sw_success('♻️ Papelera! ♻️', "Tu registro ha sido reciclado." ) }, 
    function(){ sw_success('Eliminado!', 'Tu registro ha sido Eliminado.' ) }, 
    function(){ tabla_tours.ajax.reload(null, false); },
    false, 
    false, 
    false,
    false
  );
}
// .....::::::::::::::::::::::::::::::::::::: F U N C I O N E S   G A L E R I A  :::::::::::::::::::::::::::::::::::::::..
// :::::::::::::::::::::::::::::::::::::::::::::::::::: S E C C I O N  G A L E R I A  ::::::::::::::::::::::::::::::::::::::::::::::::::::

// abrimos el navegador de archivos
$("#doc2_i").click(function() {  $('#doc2').trigger('click'); });
$("#doc2").change(function(e) {  addImageApplication(e,$("#doc2").attr("id")) });

// Eliminamos
function doc2_eliminar() {
	$("#doc2").val("");
	$("#doc2_ver").html('<img src="../dist/svg/doc_uploads.svg" alt="" width="50%" >');
	$("#doc2_nombre").html("");
}

function limpiar_galeria () { 
  $('#descripcion_g').val("");
  $('#idgaleria_tours').val("");

  $("#doc_old_2").val("");
  $("#doc2").val("");  
  $('#doc2_ver').html(`<img src="../dist/svg/doc_uploads.svg" alt="" width="50%" >`);
  $('#doc2_nombre').html("");

  // Limpiamos las validaciones
  $(".form-control").removeClass('is-valid');
  $(".form-control").removeClass('is-invalid');
  $(".error.invalid-feedback").remove();

  $(".tooltip").removeClass("show").addClass("hidde");
 
}

function galeria(idtours, nombre) {

  idpaquete_r=idtours; nombre_r=nombre;
  show_hide_form(2);

  $('.nombre_galeria').html(`Galería del TOURS - ${nombre}`);
  $('#idtours_t').val(idtours);
  $('.imagenes_galeria').html('');
  var codigoHTML="";
  $.post("../ajax/tours.php?op=mostrar_galeria", { idtours: idtours }, function (e, status) {
    
    e = JSON.parse(e);  console.log(e);    

    if (e.data==null || e.data=="") {
      $(".g_imagenes").hide(); $(".sin_imagenes").show();
    }else{
      $(".sin_imagenes").hide(); $(".g_imagenes").show();
      
      e.data.forEach(element => {
        //style="border: 2px solid black;"
        codigoHTML =codigoHTML.concat(`<div class="col-sm-2 pb-2 pt-2" style="border: 2px solid #837f7f;">
        <a href="../dist/docs/tours/galeria/${element.imagen}?text=1" data-toggle="lightbox" data-title="${element.descripcion}" data-gallery="gallery">
         <img src="../dist/docs/tours/galeria/${element.imagen}?text=1" class="img-fluid mb-2" alt="white sample"/>
        </a>
        <div class="text-center text-white" style="background-color: #1f7387; cursor: pointer; border-radius: 0.25rem;" onclick="eliminar_img(${element.idgaleria_tours},'${element.descripcion}');">Eliminar
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
     
    
    $("#cargando-3-fomulario").show();
    $("#cargando-4-fomulario").hide();
  }).fail( function(e) { ver_errores(e); } );

}


 
function eliminar_img(idgaleria_tours,descripcion) {  
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
        "../ajax/tours.php?op=eliminar_imagen",
        { idgaleria_tours: idgaleria_tours},
        function (response) {
          try {
            response = JSON.parse(response);
            if (response.status == true) {
              Swal.fire("Verificado", "LA imagen ha sido verificado.", "success");
              // Aquí puedes realizar cualquier otra acción después de verificar el comentario
              // tbla_principal();
              galeria(idpaquete_r, nombre_r);
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

//Función para guardar o editar
function guardar_y_editar_galeria_tours(e) {
  // e.preventDefault(); //No se activará la acción predeterminada del evento
  var formData = new FormData($("#form-galeria-tours")[0]);

  $.ajax({
    url: "../ajax/tours.php?op=guardar_y_editar_galeria",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (e) {
      try {
        e = JSON.parse(e);
        if (e.status == true) {

          Swal.fire("Correcto!", "El registro se guardo correctamente.", "success");

          galeria(idpaquete_r, nombre_r);
          $('#modal-agregar-galeria_tours').modal('hide'); //
          limpiar_galeria();   

        } else {
          ver_errores(e);
        }
      } catch (err) { console.log('Error: ', err.message); toastr.error('<h5 class="font-size-16px">Error temporal!!</h5> puede intentalo mas tarde, o comuniquese con <i><a href="tel:+51921305769" >921-305-769</a></i> ─ <i><a href="tel:+51921487276" >921-487-276</a></i>'); }      
      $("#guardar_registro").html('Guardar Cambios').removeClass('disabled');
    },
    beforeSend: function () {
      $("#guardar_registro").html('<i class="fas fa-spinner fa-pulse fa-lg"></i>').addClass('disabled');
    },
    error: function (jqXhr) { ver_errores(jqXhr); },
  });
}


// .....::::::::::::::::::::::::::::::::::::: V A L I D A T E   F O R M  :::::::::::::::::::::::::::::::::::::::..
$(function () {   

  // Aplicando la validacion del select cada vez que cambie
  $("#idtipo_tours").on('change', function() { $(this).trigger('blur'); });
  $("#form-tours").validate({
    ignore: '.select2-input, .select2-focusser',
    rules: {
      
      idtipo_tours: { required: true},
      nombre:{ required: true, minlength:4, maxlength:100 },
      descripcion: { minlength:4 },
      costo: { required: true},
      
    },
    messages: {
      idtipo_tours: { required: "Campo requerido"},
      nombre:{ required: "Campo requerido", minlength: "Minimo 3 caracteres", maxlength: "Maximo 100 Caracteres" },
      descripcion: {minlength: "Minimo 4 Caracteres"},
      costo: { required: "Campo requerido"},
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
      guardar_y_editar_tours(e);
    },

  });

  $("#form-galeria-tours").validate({
    ignore: '.select2-input, .select2-focusser',
    rules: { descripcion: { minlength:4 }, },
    messages: { descripcion: {minlength: "Minimo 4 Caracteres"}, },

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
      guardar_y_editar_galeria_tours(e);
    },

  });
  
  $("#idtipo_tours").rules('add', { required: true, messages: {  required: "Campo requerido" } });

});

// .....::::::::::::::::::::::::::::::::::::: F U N C I O N E S    A L T E R N A S  :::::::::::::::::::::::::::::::::::::::..

init();
// ver imagen grande de la persona
function ver_img_tours(file, nombre) {
  $('.nombre-tours').html(nombre);
  $(".tooltip").removeClass("show").addClass("hidde");
  $("#modal-ver-imagen-tours").modal("show");
  $('#imagen-tours').html(`<span class="jq_image_zoom"><img class="img-thumbnail" src="${file}" onerror="this.src='../dist/svg/404-v2.svg';" alt="Perfil" width="100%"></span>`);
  $('.jq_image_zoom').zoom({ on:'grab' });
}

// ver imagen DEL TOURS
function ver_img_galeria_tours(file, nombre) {
  $('.nombre-galeria_tours').html(nombre);
  $(".tooltip").removeClass("show").addClass("hidde");
  $("#modal-ver-imagen-galeria_tours").modal("show");
  $('#imagen-galeria_tours').html(`<span class="jq_image_zoom"><img class="img-thumbnail" src="${file}" onerror="this.src='../dist/svg/404-v2.svg';" alt="Perfil" width="100%"></span>`);
  $('.jq_image_zoom').zoom({ on:'grab' });
}

function calcular_monto_descuento() { 

  var costo =$('#costo').val(); 
    
  var porcentaje =$('#porcentaje_descuento').val(); 

  if (porcentaje==null || porcentaje=="") {
    toastr.warning("Porcentaje no asignado !!");
    
  }else{
    var calculando = (costo*porcentaje)/100;

    console.log(calculando);

    $('#monto_descuento').val(calculando)

  }

}

function funtion_switch() {  
  $("#estado_descuento").val(0);

  var isChecked = $('#estado_switch').prop('checked');

  if (isChecked) {

    $("#estado_descuento").val(1)
    $('#porcentaje_descuento').removeAttr('readonly'); 

    var costo =$('#costo').val(); 

    if (costo==null || costo=="") {
  
      toastr.warning("Precio Regualr no asignado !!");
      $('#porcentaje_descuento').attr('readonly', 'readonly');
        
    }else{

      $('#porcentaje_descuento').removeAttr('readonly'); 

      calcular_monto_descuento();
    }

  } else {

    $("#estado_descuento").val(0);

    $("#porcentaje_descuento").val('0');
    $("#monto_descuento").val('0.00');
    $('#porcentaje_descuento').attr('readonly', 'readonly');

  }

}


