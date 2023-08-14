var tabla_paquete;
var miArray = [];
var i_Array = [];
var codigoHTML='';
var idpaquete_r='', nombre_r="";
//Función que se ejecuta al inicio
function init() {
  //Activamos el "aside"

  $("#bloc_LogisticaPaquetes").addClass("menu-open");

  $("#bloc_lPaquetes").addClass("menu-open bg-color-191f24");

  $("#mlPaquetes").addClass("active");

  $("#mlPaquetes").addClass("active bg-green");

  $("#lPaquetes").addClass("active");
  
  tbla_principal();
   // ══════════════════════════════════════ S E L E C T 2 ═════════════════════════════════════════
   lista_select2(`../ajax/paquete.php?op=selec2tours`, '#list_tours', null);
   
  // ══════════════════════════════════════ INITIALIZE SELECT2 ════════════════════════════════════
  $("#list_tours").select2({theme:"bootstrap4", placeholder: "Selecionar Tours.", allowClear: true, });

  // ══════════════════════════════════════ G U A R D A R   F O R MS ════════════════════════════════════
  $("#guardar_registro_galeria").on("click", function (e) { $("#submit-form-galeria").submit(); });

  // ══════════════════════════════════════ S U M M E R N O T E ══════════════════════════════════════ 
  $('#descripcion').summernote(); $('#incluye').summernote(); $('#no_incluye').summernote();  
  $('#recomendaciones').summernote(); $('#resumen').summernote();

  // Formato para telefono
  $("[data-mask]").inputmask();
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
function limpiar_paquete() {
   // Paquete
  $("#idpaquete").val("");
  $("#nombre").val("");
  $("#cant_dias").val("");
  $("#cant_noches").val("");
  $("#descripcion").summernote('code', '');
  //$("#doc1").val("");
  $("#alimentacion").val("");
  $("#alojamiento").val("");

  //OTROS
  $("#incluye").summernote('code', '');
  $("#no_incluye").summernote('code', '');
  $("#recomendaciones").summernote('code', '');
  $("#mapa").val("");
  miArray = []; i_Array = [];
  $('.codigoGenerado').html(`<div class="alert alert-warning alert-dismissible alerta"> <h5><i class="icon fas fa-exclamation-triangle"></i> Alerta!</h5> NO TIENES NINGUNA ACTIVIDAD ASIGNADA A TU PAQUETE </div>`);
  //itinerario
  $(".alerta").show();
  // COSTOS
  $("#costo").val("");
  $("#porcentaje_descuento").val("");
  $("#monto_descuento").val("");

  //RESUMEN
  $("#resumen").summernote('code', '');

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
	if (flag == 1)	{	// tabla principal	
		$("#div-tabla-paquete").show();
    $("#div-galeria").hide();
    $(".btn-regresar").hide();
    $(".btn-agregar-paquete").show();
    $(".btn-agregar-galeria").hide();
    $('#h1-nombre-paquete').html('');
    $(".btn-agregar").show();
	}	else if (flag == 2)	{// tabla galeria
		$("#div-tabla-paquete").hide();
    $("#div-galeria").show();
    $(".btn-regresar").show();
    $(".btn-agregar-paquete").hide();
    $(".btn-agregar-galeria").show();
    $(".btn-agregar").hide();
	}
}

//Función Listar
function tbla_principal() {
  tabla_paquete = $("#tabla-paquete").dataTable({
    responsive: true,
    lengthMenu: [[ -1, 5, 10, 25, 75, 100, 200,], ["Todos", 5, 10, 25, 75, 100, 200, ]], //mostramos el menú de registros a revisar
    aProcessing: true, //Activamos el procesamiento del datatables
    aServerSide: true, //Paginación y filtrado realizados por el servidor
    dom: "<'row'<'col-md-3'B><'col-md-3 float-left'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>", //Definimos los elementos del control de tabla
    buttons: [      
      { text: '<i class="fa-solid fa-arrows-rotate" data-toggle="tooltip" data-original-title="Recargar"></i>', className: "btn bg-gradient-info", action: function ( e, dt, node, config ) { tabla_paquete.ajax.reload(null, false); toastr_success('Exito!!', 'Actualizando tabla', 400); } },
      { extend: 'copyHtml5', exportOptions: { columns: [0,1,2,3], }, text: `<i class="fas fa-copy" data-toggle="tooltip" data-original-title="Copiar"></i>`, className: "btn bg-gradient-gray", footer: true,  }, 
      { extend: 'excelHtml5', exportOptions: { columns: [0,1,2,3], }, text: `<i class="far fa-file-excel fa-lg" data-toggle="tooltip" data-original-title="Excel"></i>`, className: "btn bg-gradient-success", footer: true,  }, 
      { extend: 'pdfHtml5', exportOptions: { columns: [0,1,2,3], }, text: `<i class="far fa-file-pdf fa-lg" data-toggle="tooltip" data-original-title="PDF"></i>`, className: "btn bg-gradient-danger", footer: false, orientation: 'landscape', pageSize: 'LEGAL',  },
      { extend: "colvis", text: `Columnas`, className: "btn bg-gradient-gray", exportOptions: { columns: "th:not(:last-child)", }, },
    ],
    ajax: {
      url: "../ajax/paquete.php?op=tbla_principal",
      type: "get",
      dataType: "json",
      error: function (e) {
        console.log(e.responseText);
      },
    },
    createdRow: function (row, data, ixdex) {
      // columna: #
      if (data[0] != "") { $("td", row).eq(0).addClass("text-center"); }
      // columna: sub total
      if (data[1] != "") { $("td", row).eq(1).addClass("text-nowrap"); }
      // columna: sub total
      if (data[5] != "") { $("td", row).eq(5).addClass("text-nowrap text-right"); }
      // columna: igv
      if (data[6] != "") { $("td", row).eq(6).addClass("text-center"); }
      // columna: total
      if (data[7] != "") { $("td", row).eq(7).addClass("text-center"); }
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
function guardar_y_editar_paquete(e) {
  // e.preventDefault(); //No se activará la acción predeterminada del evento
  var formData = new FormData($("#form-paquete")[0]);

  $.ajax({
    url: "../ajax/paquete.php?op=guardar_y_editar_paquete",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (e) {
      try {
        e = JSON.parse(e);
        if (e.status == true) {

          Swal.fire("Correcto!", "El registro se guardo correctamente.", "success");

          tabla_paquete.ajax.reload(null, false);
          $('#modal-agregar-paquete').modal('hide');
          limpiar_paquete();  

        } else {
          ver_errores(e);
        }
      } catch (err) { console.log('Error: ', err.message); toastr.error('<h5 class="font-size-16px">Error temporal!!</h5> puede intentalo mas tarde, o comuniquese con <i><a href="tel:+51921305769" >921-305-769</a></i> ─ <i><a href="tel:+51921487276" >921-487-276</a></i>'); }      
      $("#guardar_registro_paquete").html('Guardar Cambios').removeClass('disabled');
    },
    beforeSend: function () {
      $("#guardar_registro_paquete").html('<i class="fas fa-spinner fa-pulse fa-lg"></i>').addClass('disabled');
    },
    error: function (jqXhr) { ver_errores(jqXhr); },
  });
}

function mostrar_paquete(idpaquete) {
  limpiar_paquete();
  
  $("#cargando-1-fomulario").hide();
  $("#cargando-2-fomulario").show();

  $("#modal-agregar-paquete").modal("show");

  $.post("../ajax/paquete.php?op=mostrar", { idpaquete: idpaquete }, function (e, status) {
    
    e = JSON.parse(e); console.log(e);    

    // Paquete
    $("#idpaquete").val(e.paquete.idpaquete);
    $("#nombre").val(e.paquete.nombre);
    $("#cant_dias").val(e.paquete.cant_dias);
    $("#cant_noches").val(e.paquete.cant_noches);
    $("#descripcion").summernote ('code', e.paquete.descripcion);
    $("#alimentacion").val(e.paquete.alimentacion);
    $("#alojamiento").val(e.paquete.alojamiento);
    
    //Otros
    $("#incluye").summernote ('code', e.paquete.incluye);
    $("#no_incluye").summernote ('code', e.paquete.no_incluye);
    $("#recomendaciones").summernote ('code', e.paquete.recomendaciones);
    $("#mapa").val(e.paquete.mapa);
    
    // -------COSTO----------
    $("#costo").val(e.paquete.costo);
    $("#estado_descuento").val(e.paquete.estado_descuento);
    $("#porcentaje_descuento").val(e.paquete.porcentaje_descuento);
    $("#monto_descuento").val(e.paquete.monto_descuento);
    // -------RESUMEN --------
    $("#resumen").summernote ('code', e.paquete.resumen);

    if (e.paquete.estado_descuento == "1") {
      $("#estado_switch").prop("checked", true);
    } else {
      $("#estado_switch").prop("checked", false);
    } 

    if (e.itinerario==null || e.itinerario=="") {
      $(".alerta").show();
    }else{
      $(".alerta").hide();
      
      e.itinerario.forEach((element,index) => {
        if (!i_Array.includes(index)) { i_Array.push(index); }

        codigoHTML =`<hr class=" id_${index} tours_${element.idtours}" style="height: 1px; background: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));">
                    <input type="hidden" name="iditinerario[]" id="iditinerario" value="${element.iditinerario}">
                    <input type="hidden" name="idtours[]" id="idtours" value="${element.idtours}">
                    <div class="row id_${index} tours_${element.idtours}">
                    <div class="col-12 text-center">
                      <span class="text-danger cursor-pointer" aria-hidden="true" data-toggle="tooltip" data-original-title="Eliminar" onclick="eliminar_tours(${index})" >&times;</span>
                    </div>
                      <!-- Nombre Tours -->
                      <div class="col-12 col-sm-12 col-md-8 col-lg-9">
                        <div class="form-group">
                          <label for="nombre_tours">Nombre <sup class="text-danger">(unico*)</sup></label>
                          <input type="text" name="nombre_tours[]" class="form-control" id="nombre_tours" value="${element.turs}" placeholder="Tours" readonly />
                        </div>
                      </div>
    
                      <!-- Numero de Dia-->
                      <div class="col-12 col-sm-12 col-md-4 col-lg-3">
                        <div class="form-group">
                          <label for="idnumero_orden">Num. Día <sup class="text-danger">(unico*)</sup></label>
                          <input type="number" name="numero_orden[]" class="form-control" id="numero_orden" placeholder="N° Día" value="${element.numero_orden}" />
    
                        </div>
                      </div>
                      <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                          <label for="actividades">Descripcion Actividad </label> <br />
                          <textarea name="actividad[]" id="actividad" class="form-control actividad">${ element.actividad}</textarea>
                        </div>
                      </div>
                    </div>`;
      });
      
      if (i_Array.length === 0) { $(".alerta").show(); } else { $(".alerta").hide(); }
      $('.codigoGenerado').append(codigoHTML); // Agregar el contenido al elemento con el ID "codigoGenerado"
      $(`.actividad`).summernote(); 



    }

    if (e.paquete.imagen == "" || e.paquete.imagen == null  ) {

      $("#doc1_ver").html('<img src="../dist/svg/doc_uploads.svg" alt="" width="50%" >');

      $("#doc1_nombre").html('');

      $("#doc_old_1").val(""); $("#doc1").val("");

    } else {

      $("#doc_old_1").val(e.paquete.imagen); 

      $("#doc1_nombre").html(`<div class="row"> <div class="col-md-12"><i>imagen.${extrae_extencion(e.paquete.imagen)}</i></div></div>`);
      // cargamos la imagen adecuada par el archivo
      $("#doc1_ver").html(doc_view_extencion(e.paquete.imagen,'paquete', 'perfil', '100%', '210' ));   //ruta imagen    
          
    }
    $('.jq_image_zoom').zoom({ on:'grab' });
     
    
    $("#cargando-1-fomulario").show();
    $("#cargando-2-fomulario").hide();
  }).fail( function(e) { ver_errores(e); } );
}

function ver_detalle_paquete(idpaquete) {
  limpiar_paquete();
  $(".btn_footer").hide();
  $(".titulo").html('Ver datos del Paquete');

  $(".datos_paquete").css('pointer-events', 'none');
  $(".otros").css('pointer-events', 'none');
  $(".itinerario").css('pointer-events', 'none');
  $(".costos").css('pointer-events', 'none');

  $("#cargando-1-fomulario").hide();
  $("#cargando-2-fomulario").show();

  $("#modal-agregar-paquete").modal("show");

  $.post("../ajax/paquete.php?op=mostrar", { idpaquete: idpaquete }, function (e, status) {
    
    e = JSON.parse(e); console.log(e);    

    // Paquete
    $("#idpaquete").val(e.paquete.idpaquete);
    $("#nombre").val(e.paquete.nombre);
    $("#cant_dias").val(e.paquete.cant_dias);
    $("#cant_noches").val(e.paquete.cant_noches);
    $("#descripcion").summernote ('code', e.paquete.descripcion);
    $("#alimentacion").val(e.paquete.alimentacion);
    $("#alojamiento").val(e.paquete.alojamiento);
    
    //Otros
    $("#incluye").summernote ('code', e.paquete.incluye);
    $("#no_incluye").summernote ('code', e.paquete.no_incluye);
    $("#recomendaciones").summernote ('code', e.paquete.recomendaciones);
    $("#mapa").val(e.paquete.mapa);
    
    // -------COSTO----------
    $("#costo").val(e.paquete.costo);
    $("#estado_descuento").val(e.paquete.estado_descuento);
    $("#porcentaje_descuento").val(e.paquete.porcentaje_descuento);
    $("#monto_descuento").val(e.paquete.monto_descuento);
    $("#list_tours").val(e.itinerario);
    // -------RESUMEN --------
    $("#resumen").summernote ('code', e.paquete.resumen);

    if (e.paquete.estado_descuento == "1") {
      $("#estado_switch").prop("checked", true);
    } else {
      $("#estado_switch").prop("checked", false);
    } 

    if (e.itinerario==null || e.itinerario=="") {
      $(".alerta").show();
    }else{
      $(".alerta").hide();
      
      e.itinerario.forEach((element,index) => {
        if (!i_Array.includes(index)) { i_Array.push(index); }

        codigoHTML =`<hr class=" id_${index} tours_${element.idtours}" style="height: 1px; background: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));">
                    <input type="hidden" name="iditinerario[]" id="iditinerario" value="${element.iditinerario}">
                    <input type="hidden" name="idtours[]" id="idtours" value="${element.idtours}">
                    <div class="row id_${index} tours_${element.idtours}">
                    <div class="col-12 text-center">
                      <span class="text-danger cursor-pointer" aria-hidden="true" data-toggle="tooltip" data-original-title="Eliminar" onclick="eliminar_tours(${index})" >&times;</span>
                    </div>
                      <!-- Nombre Tours -->
                      <div class="col-12 col-sm-12 col-md-8 col-lg-9">
                        <div class="form-group">
                          <label for="nombre_tours">Nombre <sup class="text-danger">(unico*)</sup></label>
                          <input type="text" name="nombre_tours[]" class="form-control" id="nombre_tours" value="${element.turs}" placeholder="Tours" readonly />
                        </div>
                      </div>
    
                      <!-- Numero de Dia-->
                      <div class="col-12 col-sm-12 col-md-4 col-lg-3">
                        <div class="form-group">
                          <label for="idnumero_orden">Num. Día <sup class="text-danger">(unico*)</sup></label>
                          <input type="number" name="numero_orden[]" class="form-control" id="numero_orden" placeholder="N° Día" value="${element.numero_orden}" />
    
                        </div>
                      </div>
                      <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                          <label for="actividades">Descripcion Actividad </label> <br />
                          <textarea name="actividad[]" id="actividad" class="form-control actividad">${ element.actividad}</textarea>
                        </div>
                      </div>
                    </div>`;
      });
      
      if (i_Array.length === 0) { $(".alerta").show(); } else { $(".alerta").hide(); }
      $('.codigoGenerado').append(codigoHTML); // Agregar el contenido al elemento con el ID "codigoGenerado"
      $(`.actividad`).summernote(); 



    }



    if (e.paquete.imagen == "" || e.paquete.imagen == null  ) {

      $("#doc1_ver").html('<img src="../dist/svg/doc_uploads.svg" alt="" width="50%" >');

      $("#doc1_nombre").html('');

      $("#doc_old_1").val(""); $("#doc1").val("");

    } else {

      $("#doc_old_1").val(e.paquete.comprobante); 

      $("#doc1_nombre").html(`<div class="row"> <div class="col-md-12"><i>imagen.${extrae_extencion(e.paquete.imagen)}</i></div></div>`);
      // cargamos la imagen adecuada par el archivo
      $("#doc1_ver").html(doc_view_extencion(e.paquete.imagen,'paquete', 'perfil', '100%', '210' ));   //ruta imagen    
          
    }
    $('.jq_image_zoom').zoom({ on:'grab' });
     
    
    $("#cargando-1-fomulario").show();
    $("#cargando-2-fomulario").hide();
  }).fail( function(e) { ver_errores(e); } );
}

//Función para desactivar registros
function eliminar_paquete(idpaquete,nombre) {

  crud_eliminar_papelera(
    "../ajax/paquete.php?op=desactivar",
    "../ajax/paquete.php?op=eliminar", 
    idpaquete, 
    "!Elija una opción¡", 
    `<b class="text-danger"><del> ${nombre} </del></b> <br> En <b>papelera</b> encontrará este registro! <br> Al <b>eliminar</b> no tendrá acceso a recuperar este registro!`, 
    function(){ sw_success('♻️ Papelera! ♻️', "Tu registro ha sido reciclado." ) }, 
    function(){ sw_success('Eliminado!', 'Tu registro ha sido Eliminado.' ) }, 
    function(){ tabla_paquete.ajax.reload(null, false); },
    false, 
    false, 
    false,
    false
  );
}
// :::::::::::::::::::::::::::::::::::::::::::::::::::: S E C C I O N  G A L E R I A  ::::::::::::::::::::::::::::::::::::::::::::::::::::
// :::::::::::::::::::::::::::::::::::::::::::::::::::: S E C C I O N  G A L E R I A  ::::::::::::::::::::::::::::::::::::::::::::::::::::
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

function galeria(idpaquete, nombre) {

  idpaquete_r=idpaquete; nombre_r=nombre;
  show_hide_form(2);

  $('.nombre_galeria').html(`Galería del paquete - ${nombre}`);
  $("#idpaqueteg").val(idpaquete)
  $('.imagenes_galeria').html('');
  var codigoHTML="";
  $.post("../ajax/paquete.php?op=mostrar_galeria", { idpaquete: idpaquete }, function (e, status) {
    
    e = JSON.parse(e);  console.log(e);    

    if (e.data==null || e.data=="") {
      $(".g_imagenes").hide(); $(".sin_imagenes").show();
    }else{
      $(".sin_imagenes").hide(); $(".g_imagenes").show();

      // $('.imagenes_galeria').filterizr('destroy');
      
      e.data.forEach(element => {
        //style="border: 2px solid black;"
        codigoHTML =codigoHTML.concat(`<div class="col-sm-2 pb-2 pt-2" style="border: 2px solid #837f7f;">
        <a href="../dist/docs/paquete/galeria/${element.imagen}?text=1" data-toggle="lightbox" data-title="${element.descripcion}" data-gallery="gallery">
         <img src="../dist/docs/paquete/galeria/${element.imagen}?text=1" class="img-fluid mb-2" alt="white sample"/>
        </a>
        <div class="text-center text-white" style="background-color: #1f7387; cursor: pointer; border-radius: 0.25rem;" onclick="eliminar_img(${element.idgaleria_paquete},'${element.descripcion}');">Eliminar
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

function limpiar_galeria () { 
  $('#descripcion_g').val("");
  $('#idgaleria_paquete').val("");

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
 
 function eliminar_img(idgaleria_paquete,descripcion) {  
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
        "../ajax/paquete.php?op=eliminar_imagen",
        { idgaleria_paquete: idgaleria_paquete},
        function (response) {
          try {
            response = JSON.parse(response);
            if (response.status == true) {
              Swal.fire("Verificado", "El comentario ha sido verificado.", "success");
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
function guardar_y_editar_galeria(e) {
  // e.preventDefault(); //No se activará la acción predeterminada del evento
  var formData = new FormData($("#form-galeria")[0]);

  $.ajax({
    url: "../ajax/paquete.php?op=guardar_y_editar_galeria",
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
          // tabla_paquete.ajax.reload(null, false);
          $('#modal-agregar-galeria').modal('hide'); //
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
//::::::::::::::::::::::::::::::::::::::::::::::::::::::Capturar JQUERRY:::::::::::::::::::::::::::::::::::::::::::::

function ver_actividad(){
  // $("#nombre_tours").val("");
  codigoHTML='';
  var idtours=$("#list_tours").val();

  $.post("../ajax/paquete.php?op=ver_actividad", { idtours: idtours }, function (e, status) {
    
    e = JSON.parse(e); console.log(e); 

    if (e.data==null || e.data=="") { 
      $(".alerta").show();
    }else{
      console.log('si hay data'+e.data.idtours);
      $(".alerta").hide();
      // Utilizando el método includes()
      if (miArray.includes(e.data.idtours)) {
        // "El valor existe en el array
        toastr.warning("NO ES POSIBLE AGREGAR NUEVAMENTE !!");
      } else {
        agregarElemento(e.data.idtours);
        //El valor no existe en el array
        toastr.success("AGREGADO CORRECTAMENTE !!");
        //generarCodigo(); // Generar el código HTML actualizado

        for (var i = 0; i < miArray.length; i++) {
          if (!i_Array.includes(i)) { i_Array.push(i); }
          // console.log(miArray);
        
          codigoHTML = `<hr class=" id_${i} tours_${e.data.idtours}" style="height: 1px; background: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));">
                      <input type="hidden" name="iditinerario[]" id="iditinerario" value="">
                      <input type="hidden" name="idtours[]" id="idtours" value="${e.data.idtours}">
                      <div class="row id_${i} tours_${e.data.idtours}">
                      <div class="col-12 text-center">
                        <span class="text-danger cursor-pointer" aria-hidden="true" data-toggle="tooltip" data-original-title="Eliminar" onclick="eliminar_tours(${i})" >&times;</span>
                      </div>
                        <!-- Nombre Tours -->
                        <div class="col-12 col-sm-12 col-md-8 col-lg-9">
                          <div class="form-group">
                            <label for="nombre_tours">Nombre <sup class="text-danger">(unico*)</sup></label>
                            <input type="text" name="nombre_tours[]" class="form-control" id="nombre_tours" value="${e.data.nombre}" placeholder="Tours" readonly />
                          </div>
                        </div>
      
                        <!-- Numero de Dia-->
                        <div class="col-12 col-sm-12 col-md-4 col-lg-3">
                          <div class="form-group">
                            <label for="idnumero_orden">Num. Día <sup class="text-danger">(unico*)</sup></label>
                            <input type="number" name="numero_orden[]" class="form-control" id="numero_orden" placeholder="N° Día" />
      
                          </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                          <div class="form-group">
                            <label for="actividades">Descripcion Actividad </label> <br />
                            <textarea name="actividad[]" id="actividad" class="form-control actividad">${ e.data.actividad}</textarea>
                          </div>
                        </div>
                      </div>`;
        }
        
        if (i_Array.length === 0) { $(".alerta").show(); } else { $(".alerta").hide(); }

        $('.codigoGenerado').append(codigoHTML); // Agregar el contenido al elemento con el ID "codigoGenerado"
        $(`.actividad`).summernote();   
        $('[data-toggle="tooltip"]').tooltip();

      }

    }
    
  }).fail( function(e) { ver_errores(e); } );
  

}

function eliminar_tours(id) {

  var index = i_Array.indexOf(id);

  if (index !== -1) {

    i_Array.splice(index, 1);

    $(`.id_${id}`).remove();

    if (i_Array.length === 0) {

      miArray = [];

      $(".alerta").show();

    } else {

      $(".alerta").hide();

    }

  }

}

function agregarElemento(id) {
 if (!miArray.includes(id)) {
    miArray.push(id);
  }
}

// .....::::::::::::::::::::::::::::::::::::: V A L I D A T E   F O R M  :::::::::::::::::::::::::::::::::::::::..
$(function () {   

  // Aplicando la validacion del select cada vez que cambie

  $("#form-paquete").validate({
    ignore: '.select2-input, .select2-focusser, .note-editor *',
    rules: {
      nombre:{ required: true, minlength:4, maxlength:100 },
      cant_dias: { required: true, minlength:2, maxlength:20},
      cant_noches: { required: true, minlength:2, maxlength:20},
      
    },
    messages: {
      nombre:{ required: "Campo requerido", minlength: "Minimo 3 caracteres", maxlength: "Maximo 100 Caracteres" },
      cant_dias: { required: "Campo requerido", min: "Minimo 2 caracteres", max: "Maximo 20 Caracteres" },
      cant_noches: { required: "Campo requerido", min: "Minimo 2 caracteres", max: "Maximo 20 Caracteres" },
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
      guardar_y_editar_paquete(e);
    },

  });

  $("#form-galeria").validate({
    ignore: '.select2-input, .select2-focusser, .note-editor *',
    rules: {
      descripcion_g: { minlength:4 },
      
    },
    messages: {
      descripcion_g: {minlength: "Minimo 4 Caracteres"},
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
      guardar_y_editar_galeria(e);
    },

  });

});

// .....::::::::::::::::::::::::::::::::::::: F U N C I O N E S    A L T E R N A S  :::::::::::::::::::::::::::::::::::::::..

init();
// ver imagen grande de la persona
function ver_img_paquete(file, nombre) {
  $('.nombre-paquete').html(nombre);
  $(".tooltip").removeClass("show").addClass("hidde");
  $("#modal-ver-imagen-paquete").modal("show");
  $('#imagen-paquete').html(`<span class="jq_image_zoom"><img class="img-thumbnail" src="${file}" onerror="this.src='../dist/svg/404-v2.svg';" alt="Perfil" width="100%"></span>`);
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