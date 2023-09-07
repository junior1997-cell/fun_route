var tabla_paquete;
var miArray = [];
var i_Array = [];

var idpaquete_r='', nombre_r="";

function init() {

  $("#bloc_LogisticaPaquetes").addClass("menu-open bg-color-191f24");  
  $("#mLogisticaPaquetes").addClass("active bg-primary");
  $("#lPaquetes").addClass("active");

  tbla_principal();
  // ══════════════════════════════════════ S E L E C T 2 ═════════════════════════════════════════
  lista_select2(`../ajax/paquete.php?op=selec2tours`, '#list_tours', null);
   
  // ══════════════════════════════════════ INITIALIZE SELECT2 ════════════════════════════════════
  $("#list_tours").select2({theme:"bootstrap4", placeholder: "Selecionar Tours.", allowClear: true, });

  // ══════════════════════════════════════ G U A R D A R   F O R MS ════════════════════════════════════
  $("#guardar_registro_paquete").on("click", function (e) { $("#submit-form-paquete").submit(); });
  $("#guardar_registro_galeria").on("click", function (e) { $("#submit-form-galeria").submit(); });

  // ══════════════════════════════════════ S U M M E R N O T E ══════════════════════════════════════ 
  $('#descripcion').summernote(); $('#incluye').summernote(); $('#no_incluye').summernote();  
  $('#recomendaciones').summernote(); $('#resumen').summernote();

  // Plugin galeria
  $(document).on('click', '[data-toggle="lightbox"]', function(event) { event.preventDefault(); $(this).ekkoLightbox({ alwaysShowClose: true }); });

  // Formato para telefono
  $("[data-mask]").inputmask();
}

// abrimos el navegador de archivos
$("#doc1_i").click(function() {  $('#doc1').trigger('click'); });
$("#doc1").change(function(e) {  addImageApplication(e,$("#doc1").attr("id")) });

// Eliminamos el doc 1
function doc1_eliminar() {
	$("#doc1").val("");
	$("#doc1_ver").html('<img src="../dist/img/default/img_defecto.png" alt="" width="50%" >');
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
  $("#alimentacion").val("");
  $("#alojamiento").val("");

  //OTROS
  $("#incluye").summernote('code', '');
  $("#no_incluye").summernote('code', '');
  $("#recomendaciones").summernote('code', '');
  $("#mapa").val("");
  
  $('#html_itinerario').html(`<div class="alert alert-warning alert-dismissible alerta delete_multiple_alerta"> <h5><i class="icon fas fa-exclamation-triangle"></i> Alerta!</h5> NO TIENES NINGUNA ACTIVIDAD ASIGNADA A TU PAQUETE </div>`);
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
  $('#doc1_ver').html(`<img src="../dist/img/default/img_defecto.png" alt="" width="50%" >`);
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
    columnDefs: [
      { targets: [6], render: function (data, type) { var number = $.fn.dataTable.render.number(',', '.', 2).display(data); if (type === 'display') { let color = 'numero_positivos'; if (data < 0) {color = 'numero_negativos'; } return `<span class="float-left">S/</span> <span class="float-right ${color} "> ${number} </span>`; } return number; }, },

    ],
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
    xhr: function () {
      var xhr = new window.XMLHttpRequest();
      xhr.upload.addEventListener("progress", function (evt) {
        if (evt.lengthComputable) {
          var percentComplete = (evt.loaded / evt.total)*100;
          /*console.log(percentComplete + '%');*/
          $("#barra_progress_tours").css({"width": percentComplete+'%'}).text(percentComplete.toFixed(2)+" %");
        }
      }, false);
      return xhr;
    },
    beforeSend: function () {
      $("#guardar_registro_paquete").html('<i class="fas fa-spinner fa-pulse fa-lg"></i>').addClass('disabled');
      $("#barra_progress_tours").css({ width: "0%",  }).text("0%").addClass('progress-bar-striped progress-bar-animated');
    },
    complete: function () {
      $("#barra_progress_tours").css({ width: "0%", }).text("0%").removeClass('progress-bar-striped progress-bar-animated');
    },
    error: function (jqXhr) { ver_errores(jqXhr); },
  });
}

function mostrar_paquete(idpaquete) {
  limpiar_paquete();
  
  $("#cargando-1-fomulario").hide();
  $("#cargando-2-fomulario").show();

  $("#modal-agregar-paquete").modal("show");
  $('#html_itinerario').html('');

  $.post("../ajax/paquete.php?op=mostrar", { idpaquete: idpaquete }, function (e, status) {
    
    e = JSON.parse(e); console.log(e);    
    if (e.status == true) {
      // ::::::::::::::::::::  PAQUETE ::::::::::::::::::::
      $("#idpaquete").val(e.data.paquete.idpaquete);
      $("#nombre").val(e.data.paquete.nombre);
      $("#cant_dias").val(e.data.paquete.cant_dias);
      $("#cant_noches").val(e.data.paquete.cant_noches);
      $("#descripcion").summernote ('code', e.data.paquete.descripcion);
      $("#alimentacion").val(e.data.paquete.alimentacion);
      $("#alojamiento").val(e.data.paquete.alojamiento);
      // :::::::::::::::::::: OTROS ::::::::::::::::::::
      $("#incluye").summernote ('code', e.data.paquete.incluye);
      $("#no_incluye").summernote ('code', e.data.paquete.no_incluye);
      $("#recomendaciones").summernote ('code', e.data.paquete.recomendaciones);
      $("#mapa").val(e.data.paquete.mapa);
      // :::::::::::::::::::: COSTO ::::::::::::::::::::
      $("#costo").val(e.data.paquete.costo);
      $("#estado_descuento").val(e.data.paquete.estado_descuento);
      $("#porcentaje_descuento").val(e.data.paquete.porcentaje_descuento);
      $("#monto_descuento").val(e.data.paquete.monto_descuento);
      if (e.data.paquete.estado_descuento == "1") { $("#estado_switch").prop("checked", true);  } else { $("#estado_switch").prop("checked", false); } 

      // :::::::::::::::::::: RESUMEN ::::::::::::::::::::
      $("#resumen").summernote ('code', e.data.paquete.resumen);

      if (e.data.itinerario==null || e.data.itinerario=="") {
        $(".alerta").show();
      }else{
        $(".alerta").hide();
        
        e.data.itinerario.forEach((val,index) => {          

          var itinerario_html =`<hr class="delete_multiple_${val.idtours}" style="height: 1px; background: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));">                      
          <div class="row delete_multiple_${val.idtours}">
            <input type="hidden" name="iditinerario[]" id="iditinerario" value="${val.iditinerario}">
            <input type="hidden" name="idtours[]" id="idtours" value="${val.idtours}">
            <div class="col-12 text-center">
              <span class="text-danger cursor-pointer" aria-hidden="true" data-toggle="tooltip" data-original-title="Eliminar" onclick="remove_itinerario(${val.idtours})" >&times;</span>
            </div>
            <!-- Nombre Tours -->
            <div class="col-12 col-sm-12 col-md-8 col-lg-9">
              <div class="form-group">
                <label for="nombre_tours">Nombre <sup class="text-danger">(unico*)</sup></label>
                <input type="text" name="nombre_tours[]" class="form-control" id="nombre_tours" value="${val.turs}" placeholder="Tours" readonly />
              </div>
            </div>      
            <!-- Numero de Dia-->
            <div class="col-12 col-sm-12 col-md-4 col-lg-3">
              <div class="form-group">
                <label for="idnumero_orden">Num. Día <sup class="text-danger">(unico*)</sup></label>                
                <input type="number" name="r_numero_orden[${val.idtours}]" id="r_numero_orden_${val.idtours}" value="${val.numero_orden}" class="form-control" placeholder="N° Día" onkeyup="replicar_value_input(${val.idtours}, '#numero_orden_${val.idtours}', this );" onchange="replicar_value_input(${val.idtours}, '#numero_orden_${val.idtours}', this );" />
                <input type="hidden" name="numero_orden[]" id="numero_orden_${val.idtours}" value="${val.numero_orden}" />
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
              <div class="form-group">
                <label for="actividades">Descripcion Actividad </label> <br />
                <textarea name="actividad[]" id="actividad" class="form-control actividad">${ val.actividad}</textarea>
              </div>
            </div>
          </div>`;
          $('#html_itinerario').append(itinerario_html); // Agregar el contenido al elemento con el ID "codigoGenerado"
          $(`#r_numero_orden_${val.idtours}`).rules("add", { required: true, min: 0, messages: { required: `Campo requerido.`, min: "Mínimo 0", } });
        });         
        
        $(`.actividad`).summernote(); 
      }

      if (e.data.paquete.imagen == "" || e.data.paquete.imagen == null  ) {   } else {
        $("#doc_old_1").val(e.data.paquete.imagen); 
        $("#doc1_nombre").html(`<div class="row"> <div class="col-md-12"><i>imagen.${extrae_extencion(e.data.paquete.imagen)}</i></div></div>`);
        // cargamos la imagen adecuada par el archivo
        $("#doc1_ver").html(doc_view_extencion(e.data.paquete.imagen,'admin/dist/docs/paquete/perfil/', '100%', '210' ));   //ruta imagen          
      }

      $('.jq_image_zoom').zoom({ on:'grab' });     
    
      $("#cargando-1-fomulario").show();
      $("#cargando-2-fomulario").hide();
    } else {
      ver_errores(e);
    }    
  }).fail( function(e) { ver_errores(e); } );
}

function ver_detalle_paquete(idpaquete) {
  
  $(".titulo_detalle_tours").html('Ver datos del Tours');  

  $("#modal-detalle-paquete").modal("show");

  $.post("../ajax/paquete.php?op=mostrar", { idpaquete: idpaquete }, function (e, status) {
    
    e = JSON.parse(e); console.log(e);  
    
    if (e.status == true) {
      $('.home_html').html(`<div class="table-responsive p-0">
        <table class="table table-hover table-bordered  mt-4">          
          <tbody>
            <tr>
              <th>Nombre</th>
              <td>${e.data.paquete.nombre}</td>
            </tr>
            <tr>
              <th>Dias</th>
              <td>${e.data.paquete.cant_dias}</td>
            </tr>
            <tr>
              <th>Noches</th>
              <td>${e.data.paquete.cant_noches}</td>
            </tr>
            <tr>
              <th>Alimentación</th>
              <td>${e.data.paquete.alimentacion}</td>
            </tr>
            <tr>
              <th>Alojamiento</th>
              <td>${e.data.paquete.alojamiento}</td>
            </tr>
            <tr>
              <th>Descripción</th>
              <td>${e.data.paquete.descripcion}</td>
            </tr>
            <tr>
              <th>Imagen</th>
              <td>${doc_view_extencion(e.data.paquete.imagen,'admin/dist/docs/paquete/perfil/', '300px', 'auto' )}</td>
            </tr>
          </tbody>
        </table>
      </div>`);

      $('.otros_html').html(`<div class="table-responsive p-0">
        <table class="table table-hover table-bordered  mt-4">          
          <tbody>
            <tr>
              <th>Incluye</th>
              <td>${e.data.paquete.incluye}</td>
            </tr>
            <tr>
              <th>No incluye</th>
              <td>${e.data.paquete.no_incluye}</td>
            </tr>
            <tr>
              <th>Recomendaciones</th>
              <td>${e.data.paquete.recomendaciones}</td>
            </tr>
            <tr>
              <th>Mapa</th>
              <td>${e.data.paquete.mapa}</td>
            </tr>            
          </tbody>
        </table>
      </div>`);

      var itinerario_html = '';
      $('.itinerario_html').html('');
      e.data.itinerario.forEach((val,index) => {
        itinerario_html =`<div class="table-responsive p-0">
          <table class="table table-hover table-bordered mt-4">          
            <tbody>
              <tr>
                <th>Nombre Tours</th>
                <td>${val.turs}</td>
              </tr>   
              <tr>
                <th>Orden</th>
                <td>${val.numero_orden}</td>
              </tr>  
              <tr>
                <th>Actividad</th>
                <td>${val.actividad}</td>
              </tr>                    
            </tbody>
          </table>
        </div>`;
        $('.itinerario_html').append(itinerario_html);
      });       

      $('.costo_html').html(`<div class="table-responsive p-0">
        <table class="table table-hover table-bordered  mt-4">          
          <tbody>
            <tr>
              <th>Precio Regular</th>
              <td>${e.data.paquete.costo}</td>
            </tr> 
            <tr>
              <th>Descuento</th>
              <td>${ e.data.paquete.estado_descuento == '1' ? '<span class="badge badge-success">SI</span>' : '<span class="badge badge-danger">NO</span>' }</td>
            </tr> 
            <tr>
              <th>Porcentaje</th>
              <td>${e.data.paquete.porcentaje_descuento}</td>
            </tr> 
            <tr>
              <th>Monto descuento</th>
              <td>${e.data.paquete.monto_descuento}</td>
            </tr>                    
          </tbody>
        </table>
      </div>`);

      $('.resumen_html').html(`<div class="table-responsive p-0">
        <table class="table table-hover table-bordered  mt-4">          
          <tbody>
            <tr>
              <th>Resumen</th>
              <td>${ e.data.paquete.resumen }</td>
            </tr>                      
          </tbody>
        </table>
      </div>`);   

      $('.jq_image_zoom').zoom({ on:'grab' });
    } else {
      ver_errores(e);
    }     
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

function add_itinerario(data) {
  var idtours = $(data).select2('val');  

  if (idtours == null || idtours == '' || idtours === undefined) { } else {
    var text_tours = $('#list_tours').select2('data')[0].text;
    if ($(`#html_itinerario div`).hasClass(`delete_multiple_${idtours}`)) { // validamos si exte el producto agregado
      toastr_error('Existe!!', `<u>${text_tours}</u>, Este tours ya ha sido agregado`);
    } else {    
      $('.delete_multiple_alerta').remove(); 
      $.post("../ajax/paquete.php?op=add_itinerario", { idtours: idtours }, function (e, textStatus, jqXHR) {
        e = JSON.parse(e); console.log(e);
        if (e.status == true) {
          $('#html_itinerario').append(`<hr class="delete_multiple_${idtours}" style="height: 1px; background: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));">          
          <div class="row delete_multiple_${idtours}">
            <input type="hidden" name="iditinerario[]" value="">
            <input type="hidden" name="idtours[]" value="${e.data.idtours}">
            <div class="col-12 text-center">
              <span class="text-danger cursor-pointer" aria-hidden="true" data-toggle="tooltip" data-original-title="Eliminar" onclick="remove_itinerario(${idtours})" >&times;</span>
            </div>
            <!-- Nombre Tours -->
            <div class="col-12 col-sm-12 col-md-8 col-lg-9">
              <div class="form-group">
                <label for="nombre_tours">Nombre <sup class="text-danger">(unico*)</sup></label>
                <input type="text" name="nombre_tours[]" class="form-control" value="${e.data.nombre}" placeholder="Tours" readonly />                
              </div>
            </div>

            <!-- Numero de Dia-->
            <div class="col-12 col-sm-12 col-md-4 col-lg-3">
              <div class="form-group">
                <label for="idnumero_orden">Num. Día <sup class="text-danger">(unico*)</sup></label>                
                <input type="number" name="r_numero_orden[${idtours}]" id="r_numero_orden_${idtours}" class="form-control" placeholder="N° Día" onkeyup="replicar_value_input(${idtours}, '#numero_orden_${idtours}', this );" onchange="replicar_value_input(${idtours}, '#numero_orden_${idtours}', this );" />
                <input type="hidden" name="numero_orden[]" id="numero_orden_${idtours}" />
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
              <div class="form-group">
                <label for="actividades">Descripcion Actividad </label> <br />
                <textarea name="actividad[]" class="form-control actividad">${ e.data.actividad}</textarea>
              </div>
            </div>
          </div>`);
          $(`#r_numero_orden_${idtours}`).rules("add", { required: true, min: 0, messages: { required: `Campo requerido.`, min: "Mínimo 0", } }); 
          
          $(`.actividad`).summernote();   
          $('[data-toggle="tooltip"]').tooltip();

        } else {
          ver_errores(e);
        }        
      }).fail( function(e) { ver_errores(e); } );        
    }
  }
}

function remove_itinerario(id) {
  $(`.tooltip`).remove();
  $(`.delete_multiple_${id}`).remove(); 
  if ($("#html_itinerario").children().length == 0) {
    $('#html_itinerario').html(`<div class="col-12 delete_multiple_alerta">
      <div class="alert alert-warning alert-dismissible"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> <h5><i class="icon fas fa-exclamation-triangle"></i> Alerta!</h5> NO TIENES NINGUNA ACTIVIDAD ASIGNADA A TU PAQUETE. </div>
    </div>`);
  }   
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
	$("#doc2_ver").html('<img src="../dist/img/default/img_defecto.png" alt="" width="50%" >');
	$("#doc2_nombre").html("");
}

function galeria(idpaquete, nombre) {

  idpaquete_r=idpaquete; nombre_r=nombre;
  show_hide_form(2);

  $('.nombre_galeria').html(`Galería del paquete - ${nombre}`);
  $("#idpaqueteg").val(idpaquete)
  $('.imagenes_galeria').html('');  
  $.post("../ajax/paquete.php?op=mostrar_galeria", { idpaquete: idpaquete }, function (e, status) {
    
    e = JSON.parse(e);  console.log(e);    
    if (e.status == true) {
      if (e.data === null || e.data.length === 0) {
        $(".g_imagenes").hide(); $(".sin_imagenes").show();
      }else{
        $(".sin_imagenes").hide(); $(".g_imagenes").show();        
        
        e.data.forEach((val, key) => {
          //style="border: 2px solid black;"
          var galeria_html = `<div class="col-sm-2 text-center px-1 py-1 b-radio-5px" style="border: 2px solid #837f7f;" > 
            <a href="../dist/docs/paquete/galeria/${val.imagen}?text=1" data-toggle="lightbox" data-title="${val.descripcion}" data-gallery="gallery">
              <img src="../dist/docs/paquete/galeria/${val.imagen}?text=1" width="100%" class="img-fluid mb-2 b-radio-t-5px" alt="white sample"/>
            </a>            
            <button class="btn btn-warning btn-sm" onclick="mostrar_editar_galeria(${val.idgaleria_paquete})">Editar</button> 
            <button class="btn btn-danger btn-sm" onclick="eliminar_img(${val.idgaleria_paquete},'${val.descripcion}');">Eliminar</button> 
          </div> `;
          $('.imagenes_galeria').append(galeria_html); // Agregar el contenido 
        }); 
      }
      $('.jq_image_zoom').zoom({ on:'grab' });     
      
      $("#cargando-3-fomulario").show();
      $("#cargando-4-fomulario").hide();
    } else {
      ver_errores(e);
    }    
  }).fail( function(e) { ver_errores(e); } );
}

function limpiar_galeria () {   
  $('#idgaleria_paquete').val("");
  $('#descripcion_g').val("");  

  $("#doc_old_2").val("");
  $("#doc2").val("");  
  $('#doc2_ver').html(`<img src="../dist/img/default/img_defecto.png" alt="" width="50%" >`);
  $('#doc2_nombre').html("");

  // Limpiamos las validaciones
  $(".form-control").removeClass('is-valid');
  $(".form-control").removeClass('is-invalid');
  $(".error.invalid-feedback").remove();
}
 
function eliminar_img(idgaleria_paquete, descripcion) {  
  Swal.fire({
    title: "¿Está seguro de que desea eliminar esta imagen?",
    html: `<b><del class="text-danger">${descripcion}</del></b> se eliminara`,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3567dc",
    cancelButtonColor: "#6c757d",
    confirmButtonText: "Sí, Eliminar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post( "../ajax/paquete.php?op=eliminar_imagen", { idgaleria_paquete: idgaleria_paquete}, function (e) {
        try {
          e = JSON.parse(e);
          if (e.status == true) {
            Swal.fire("Eliminado", "La imagen ha sido eliminado.", "success");             
            galeria(idpaquete_r, nombre_r);
          } else {
            ver_errores(e);
          }
        } catch (e) { ver_errores(e); }
      }).fail(function (e) { ver_errores(e); });
    }
  });

}

function mostrar_editar_galeria(id) {

  limpiar_galeria();

  $("#cargando-3-fomulario").hide();
  $("#cargando-4-fomulario").show();

  $("#modal-agregar-galeria").modal("show");

  $.post("../ajax/paquete.php?op=mostrar_editar_galeria", { 'idgaleria_paquete': id }, function (e, status) {
    e = JSON.parse(e);  console.log(e); 
    
    if (e.status == true) {
      $('#idpaqueteg').val(e.data.idpaquete);
      $('#idgaleria_paquete').val(e.data.idgaleria_paquete);    
      $('#descripcion_g').val(e.data.descripcion);    

      if (e.data.imagen != null || e.data.imagen == '' ) {
        $("#doc_old_2").val(e.data.imagen);      
        $('#doc2_ver').html( doc_view_extencion(e.data.imagen, 'admin/dist/docs/paquete/galeria/', '100%' ) );
        $('#doc2_nombre').html(`img_galeria.${extrae_extencion(e.data.imagen)}`);
      }  
      $("#cargando-3-fomulario").show();
      $("#cargando-4-fomulario").hide();
      $('.jq_image_zoom').zoom({ on:'grab' });  
    } else {
      ver_errores(e);
    }
  }).fail( function(e) { ver_errores(e); } );
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
        e = JSON.parse(e); console.log(e);
        if (e.status == true) {
          Swal.fire("Correcto!", "El registro se guardo correctamente.", "success");
          galeria(idpaquete_r, nombre_r);          
          $('#modal-agregar-galeria').modal('hide'); //
          limpiar_galeria();   
        } else {
          ver_errores(e);
        }
      } catch (err) { console.log('Error: ', err.message); toastr.error('<h5 class="font-size-16px">Error temporal!!</h5> puede intentalo mas tarde, o comuniquese con <i><a href="tel:+51921305769" >921-305-769</a></i> ─ <i><a href="tel:+51921487276" >921-487-276</a></i>'); }      
      $("#guardar_registro_galeria").html('Guardar Cambios').removeClass('disabled');
    },
    xhr: function () {
      var xhr = new window.XMLHttpRequest();
      xhr.upload.addEventListener("progress", function (evt) {
        if (evt.lengthComputable) {
          var percentComplete = (evt.loaded / evt.total)*100;
          /*console.log(percentComplete + '%');*/
          $("#barra_progress_galeria").css({"width": percentComplete+'%'}).text(percentComplete.toFixed(2)+" %");
        }
      }, false);
      return xhr;
    },
    beforeSend: function () {
      $("#guardar_registro_galeria").html('<i class="fas fa-spinner fa-pulse fa-lg"></i>').addClass('disabled');
      $("#barra_progress_galeria").css({ width: "0%",  }).text("0%").addClass('progress-bar-striped progress-bar-animated');
    },
    complete: function () {
      $("#barra_progress_galeria").css({ width: "0%", }).text("0%").removeClass('progress-bar-striped progress-bar-animated');
    },
    error: function (jqXhr) { ver_errores(jqXhr); },
  });
}

// .....::::::::::::::::::::::::::::::::::::: V A L I D A T E   F O R M  :::::::::::::::::::::::::::::::::::::::..
$(function () {   

  // Aplicando la validacion del select cada vez que cambie

  $("#form-paquete").validate({
    ignore: '.select2-input, .select2-focusser, .note-editor *',
    rules: {
      nombre:{ required: true, minlength:4, maxlength:100 },
      cant_dias: { required: true, min: 0, minlength:1, maxlength:2},
      cant_noches: { required: true, min: 0, minlength:1, maxlength:2},      
    },
    messages: {
      nombre:{ required: "Campo requerido", minlength: "Minimo 3 caracteres", maxlength: "Maximo 100 Caracteres" },
      cant_dias: { required: "Campo requerido", min: "Minimo 0",  minlength: "Minimo 1 digitos", maxlength: "Maximo 2 digitos." },
      cant_noches: { required: "Campo requerido", min: "Minimo 0 ",  minlength: "Minimo 1 digitos", maxlength: "Maximo 2 digitos." },
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
      descripcion_g: { required: true, minlength:4 },      
    },
    messages: {
      descripcion_g: {required: "Campo requerido", minlength: "Minimo 4 Caracteres"},
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
    $('#monto_descuento').val(calculando);
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