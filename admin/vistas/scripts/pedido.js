var tabla_pedido_tours;
var tabla_pedido_paquete;
var tabla_pedido_a_medida;

//Función que se ejecuta al inicio
function init() {
  
  $("#bloc_LogisticaPaquetes").addClass("menu-open bg-color-191f24");  
  $("#mLogisticaPaquetes").addClass("active bg-primary");  
  $("#lPedido_paquete").addClass("active");

  tbla_principal_tours();
  tbla_principal_paquete();
  tbla_principal_a_medida();

  // ══════════════════════════════════════ S E L E C T 2 ══════════════════════════════════════
  lista_select2("../ajax/ajax_general.php?op=select2Persona_por_tipo&tipo=3", '#idcliente', null);
  lista_select2("../ajax/ajax_general.php?op=select2Tipo_comprobante&tipos='12'", '#tipo_comprobante', null);

  // ══════════════════════════════════════ G U A R D A R   F O R M ══════════════════════════════════════
  $("#guardar_registro-pedido").on("click", function (e) { $("#submit-form-pedido").submit(); });

  // ══════════════════════════════════════ INITIALIZE SELECT2 - OTRO INGRESO  ══════════════════════════════════════  
  $("#idcliente").select2({templateResult: templatePersona, theme: "bootstrap4", placeholder: "Selecione cliente", allowClear: true, });
  $("#tipo_comprobante").select2({ theme: "bootstrap4", placeholder: "Selecione Comprobante", allowClear: true, });

  $("#metodo_pago").select2({ theme: "bootstrap4", placeholder: "Selecione método", allowClear: true, });

  // Formato para telefono
  $("[data-mask]").inputmask();
}

function templatePersona (state) {
  //console.log(state);
  if (!state.id) { return state.text; }
  var baseUrl = state.title != '' ? `../dist/docs/persona/perfil/${state.title}`: '../dist/svg/user_default.svg'; 
  var onerror = `onerror="this.src='../dist/svg/user_default.svg';"`;
  var $state = $(`<span><img src="${baseUrl}" class="img-circle mr-2 w-25px" ${onerror} />${state.text}</span>`);
  return $state;
}

//Función limpiar
function limpiar_form() {
  $("#idotro_ingreso").val("");

  // Limpiamos las validaciones
  $(".form-control").removeClass("is-valid");
  $(".form-control").removeClass("is-invalid");
  $(".error.invalid-feedback").remove();
}

// ::::::::::::::::::::::::::::::::::::::::: PEDIDO TOURS :::::::::::::::::::::::::::

//Función Listar
function tbla_principal_tours() {
  tabla_pedido_tours = $("#tabla-pedido-tours").dataTable({
    responsive: true,
    lengthMenu: [[-1, 5, 10, 25, 75, 100, 200], ["Todos", 5, 10, 25, 75, 100, 200], ], //mostramos el menú de registros a revisar
    aProcessing: true, //Activamos el procesamiento del datatables
    aServerSide: true, //Paginación y filtrado realizados por el servidor
    dom: "<'row'<'col-md-3'B><'col-md-3 float-left'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>", //Definimos los elementos del control de tabla
    buttons: [      
      { text: '<i class="fa-solid fa-arrows-rotate" data-toggle="tooltip" data-original-title="Recargar"></i>', className: "btn bg-gradient-info", action: function ( e, dt, node, config ) { tabla_pedido_tours.ajax.reload(null, false); toastr_success('Exito!!', 'Actualizando tabla', 400); } },
      { extend: 'copyHtml5', exportOptions: { columns: [0,1,2,3], }, text: `<i class="fas fa-copy" data-toggle="tooltip" data-original-title="Copiar"></i>`, className: "btn bg-gradient-gray", footer: true,  }, 
      { extend: 'excelHtml5', exportOptions: { columns: [0,1,2,3], }, text: `<i class="far fa-file-excel fa-lg" data-toggle="tooltip" data-original-title="Excel"></i>`, className: "btn bg-gradient-success", footer: true,  }, 
      { extend: 'pdfHtml5', exportOptions: { columns: [0,1,2,3], }, text: `<i class="far fa-file-pdf fa-lg" data-toggle="tooltip" data-original-title="PDF"></i>`, className: "btn bg-gradient-danger", footer: false, orientation: 'landscape', pageSize: 'LEGAL',  },
      { extend: "colvis", text: `Columnas`, className: "btn bg-gradient-gray", exportOptions: { columns: "th:not(:last-child)", }, },
    ],
    ajax: {
      url: "../ajax/pedido.php?op=tbla_principal_tours",
      type: "get",
      dataType: "json",
      error: function (e) {
        console.log(e.responseText);
      },
    },
    createdRow: function (row, data, ixdex) {
      // columna: #
      if (data[0] != "") {  $("td", row).eq(0).addClass("text-center"); }
      // columna: acciones
      if (data[1] != "") { $("td", row).eq(1).addClass("text-nowrap");  }
      // columna: estado
      if (data[7] != "") {  $("td", row).eq(7).addClass("text-nowrap");  }
    },
    language: {
      lengthMenu: "Mostrar: _MENU_ registros",
      buttons: {
        copyTitle: "Tabla Copiada",
        copySuccess: { _: "%d líneas copiadas", 1: "1 línea copiada" },
      },
      sLoadingRecords:
        '<i class="fas fa-spinner fa-pulse fa-lg"></i> Cargando datos...',
    },
    footerCallback: function (tfoot, data, start, end, display) {
      // var api1 = this.api(); var total1 = api1.column( 6 ).data().reduce( function ( a, b ) { return  (parseFloat(a) + parseFloat( b)) ; }, 0 )
      // $( api1.column( 6 ).footer() ).html( `<span class="float-left">S/</span> <span class="float-right">${formato_miles(total1)}</span>` );
    },
    bDestroy: true,
    iDisplayLength: 10, //Paginación
    order: [[0, "asc"]], //Ordenar (columna,orden)
    columnDefs: [
      // //{ targets: [], visible: false, searchable: false, },
      // { targets: [5], render: $.fn.dataTable.render.moment('YYYY-MM-DD', 'DD/MM/YYYY'), },
      // { targets: [6,7,8], render: function (data, type) { var number = $.fn.dataTable.render.number(',', '.', 2).display(data); if (type === 'display') { let color = 'numero_positivos'; if (data < 0) {color = 'numero_negativos'; } return `<span class="float-left">S/</span> <span class="float-right ${color} "> ${number} </span>`; } return number; }, },
    ],
  }).DataTable();
}

function mostrar_pedido_tours(idtours, idpedido_tours) {
  //variables del array
  $(".titulo_pedido").html(`Pedido: <i class="fas fa-spinner fa-pulse fa-lg"></i> `);
  $("#modal-ver-pedido").modal("show");

  $.post("../ajax/pedido.php?op=mostrar_detalle_tours", { 'idtours': idtours, 'idpedido_tours': idpedido_tours }, function (e, status) {
    e = JSON.parse(e);   console.log(e);  
    if (e.status == true) {
      $(".titulo_pedido").html(`Pedido: ${e.data.pedido.nombre}`);

      $('.pedido_html').html(`<div class="table-responsive p-0">
        <table class="table table-hover table-bordered  mt-4">          
          <tbody>
            <tr>
              <th>Nombre</th>
              <td>${e.data.pedido.nombre}</td>
            </tr>
            <tr>
              <th>Telefono</th>
              <td><a href="tel:+51${e.data.pedido.telefono}">${e.data.pedido.telefono}</a></td>
            </tr>
            <tr>
              <th>Correo</th>
              <td><a href="mailto:${e.data.pedido.correo}">${e.data.pedido.correo}</a></td>
            </tr>
            <tr>
              <th>Descripción</th>
              <td>${e.data.pedido.descripcion}</td>
            </tr>           
          </tbody>
        </table>
      </div>`);

      $('.home_html').html(`<div class="table-responsive p-0">
        <table class="table table-hover table-bordered  mt-4">          
          <tbody>
            <tr>
              <th>Nombre</th>
              <td>${e.data.tours.nombre}</td>
            </tr>
            <tr>
              <th>Tipo Tours</th>
              <td>${e.data.tours.tipo_tours}</td>
            </tr>
            <tr>
              <th>Duración</th>
              <td>${e.data.tours.duracion}</td>
            </tr>
            <tr>
              <th>Descripción</th>
              <td>${e.data.tours.descripcion}</td>
            </tr>
            <tr>
              <th>Imagen</th>
              <td>${doc_view_extencion(e.data.tours.imagen, 'admin/dist/docs/tours/perfil/', '300px', 'auto' )}</td>
            </tr>
          </tbody>
        </table>
      </div>`);

      $('.otros_html').html(`<div class="table-responsive p-0">
        <table class="table table-hover table-bordered  mt-4">          
          <tbody>
            <tr>
              <th>Incluye</th>
              <td>${e.data.tours.incluye}</td>
            </tr>
            <tr>
              <th>No incluye</th>
              <td>${e.data.tours.no_incluye}</td>
            </tr>
            <tr>
              <th>Recomendaciones</th>
              <td>${e.data.tours.recomendaciones}</td>
            </tr>
            <tr>
              <th>Mapa</th>
              <td>${e.data.tours.mapa}</td>
            </tr>            
          </tbody>
        </table>
      </div>`);

      $('.itinerario_html').html(`<div class="table-responsive p-0">
        <table class="table table-hover table-bordered  mt-4">          
          <tbody>
            <tr>
              <th>Itinerario</th>
              <td>${e.data.tours.actividad}</td>
            </tr>                    
          </tbody>
        </table>
      </div>`);

      $('.costo_html').html(`<div class="table-responsive p-0">
        <table class="table table-hover table-bordered  mt-4">          
          <tbody>
            <tr>
              <th>Precio Regular</th>
              <td>${e.data.tours.costo}</td>
            </tr> 
            <tr>
              <th>Descuento</th>
              <td>${ e.data.tours.estado_descuento == '1' ? '<span class="badge badge-success">SI</span>' : '<span class="badge badge-danger">NO</span>' }</td>
            </tr> 
            <tr>
              <th>Porcentaje</th>
              <td>${e.data.tours.porcentaje_descuento}</td>
            </tr> 
            <tr>
              <th>Monto descuento</th>
              <td>${e.data.tours.monto_descuento}</td>
            </tr>                    
          </tbody>
        </table>
      </div>`);

      $('.resumen_html').html(`<div class="table-responsive p-0">
        <table class="table table-hover table-bordered  mt-4">          
          <tbody>
            <tr>
              <th>¿Incluye Alojamiento?</th>
              <td>${ e.data.tours.alojamiento == '1' ? '<span class="badge badge-success">SI</span>' : '<span class="badge badge-danger">NO</span>' }</td>
            </tr> 
            <tr>
              <th>Resumen de Actividades</th>
              <td>${e.data.tours.resumen_actividad}</td>
            </tr>             
            <tr>
              <th>Resumen de Comida</th>
              <td>${e.data.tours.resumen_comida}</td>
            </tr>            
          </tbody>
        </table>
      </div>`);      


      $(".jq_image_zoom").zoom({ on: "grab" });      
      tabla_pedido_tours.ajax.reload(null, false);
    } else {
      ver_errores(e);
    } 
  }).fail(function (e) { ver_errores(e); });
}

//Función para activar registros
function vendido_tours(idpedido_tours, nombre) {
  Swal.fire({
    title: "¿Está Seguro que este pedido se a vendido?",
    html: `<b class="text-success">.::: ${nombre} :::.</b> <br>Este pedido se registrara como vendido`,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#28a745",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, vender!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post("../ajax/pedido.php?op=vendido_tours", { idpedido_tours: idpedido_tours }, function (e) {
        try {
          e = JSON.parse(e);
          if (e.status == true) {
            Swal.fire("Vendido!", "El pedido a sido vendido.", "success");
            tabla_pedido_tours.ajax.reload(null, false);
          } else {
            ver_errores(e);
          }
        } catch (e) { ver_errores(e); }
      }).fail(function (e) { ver_errores(e); }); // todos los post tienen que tener
    }
  });
}

//Función para activar registros
function remover_vendido_tours(idpedido_tours, nombre) {
  Swal.fire({
    title: "¿Está Seguro de REMOVER lo vendido?",
    html: `<b class="text-danger">.::: <del>${nombre}</del> :::.</b> <br>Este pedido se removera como <b>no vendido</b> `,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#28a745",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, remover!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post("../ajax/pedido.php?op=remover_vendido_tours", { idpedido_tours: idpedido_tours }, function (e) {
        try {
          e = JSON.parse(e);
          if (e.status == true) {
            Swal.fire("Removido!", "El pedido a sido <b>no vendido</b>.", "success");
            tabla_pedido_tours.ajax.reload(null, false);
          } else {
            ver_errores(e);
          }
        } catch (e) { ver_errores(e); }
      }).fail(function (e) { ver_errores(e); }); // todos los post tienen que tener
    }
  });
}

//Función para desactivar registros
function eliminar_pedido_tours(idpedido, nombre) {
  crud_eliminar_papelera(
    "../ajax/pedido.php?op=desactivar_tours",
    "../ajax/pedido.php?op=eliminar_tours",
    idpedido,
    "!Elija una opción¡",
    `<b class="text-danger"><del>${nombre}</del></b> <br> En <b>papelera</b> encontrará este registro! <br> Al <b>eliminar</b> no tendrá acceso a recuperar este registro!`,
    function () { sw_success("♻️ Papelera! ♻️", "Tu registro ha sido reciclado.");  },
    function () { sw_success("Eliminado!", "Tu registro ha sido Eliminado."); },
    function () { tabla_pedido_tours.ajax.reload(null, false); },
    false,
    false,
    false,
    false
  );
}

// ::::::::::::::::::::::::::::::::::::::::: PEDIDO PAQUETE :::::::::::::::::::::::::::

//Función Listar
function tbla_principal_paquete() {
  tabla_pedido_paquete = $("#tabla-pedido-paquete").dataTable({
    responsive: true,
    lengthMenu: [[-1, 5, 10, 25, 75, 100, 200], ["Todos", 5, 10, 25, 75, 100, 200], ], //mostramos el menú de registros a revisar
    aProcessing: true, //Activamos el procesamiento del datatables
    aServerSide: true, //Paginación y filtrado realizados por el servidor
    dom: "<'row'<'col-md-3'B><'col-md-3 float-left'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>", //Definimos los elementos del control de tabla
    buttons: [      
      { text: '<i class="fa-solid fa-arrows-rotate" data-toggle="tooltip" data-original-title="Recargar"></i>', className: "btn bg-gradient-info", action: function ( e, dt, node, config ) { tabla_pedido_paquete.ajax.reload(null, false); toastr_success('Exito!!', 'Actualizando tabla', 400); } },
      { extend: 'copyHtml5', exportOptions: { columns: [0,1,2,3], }, text: `<i class="fas fa-copy" data-toggle="tooltip" data-original-title="Copiar"></i>`, className: "btn bg-gradient-gray", footer: true,  }, 
      { extend: 'excelHtml5', exportOptions: { columns: [0,1,2,3], }, text: `<i class="far fa-file-excel fa-lg" data-toggle="tooltip" data-original-title="Excel"></i>`, className: "btn bg-gradient-success", footer: true,  }, 
      { extend: 'pdfHtml5', exportOptions: { columns: [0,1,2,3], }, text: `<i class="far fa-file-pdf fa-lg" data-toggle="tooltip" data-original-title="PDF"></i>`, className: "btn bg-gradient-danger", footer: false, orientation: 'landscape', pageSize: 'LEGAL',  },
      { extend: "colvis", text: `Columnas`, className: "btn bg-gradient-gray", exportOptions: { columns: "th:not(:last-child)", }, },
    ],
    ajax: {
      url: "../ajax/pedido.php?op=tbla_principal_paquete",
      type: "get",
      dataType: "json",
      error: function (e) {
        console.log(e.responseText);
      },
    },
    createdRow: function (row, data, ixdex) {
      // columna: #
      if (data[0] != "") {  $("td", row).eq(0).addClass("text-center"); }
      // columna: acciones
      if (data[1] != "") { $("td", row).eq(1).addClass("text-nowrap");  }
      // columna: estado
      if (data[7] != "") {  $("td", row).eq(7).addClass("text-nowrap");  }
    },
    language: {
      lengthMenu: "Mostrar: _MENU_ registros",
      buttons: {
        copyTitle: "Tabla Copiada",
        copySuccess: { _: "%d líneas copiadas", 1: "1 línea copiada" },
      },
      sLoadingRecords:
        '<i class="fas fa-spinner fa-pulse fa-lg"></i> Cargando datos...',
    },
    footerCallback: function (tfoot, data, start, end, display) {
      // var api1 = this.api(); var total1 = api1.column( 6 ).data().reduce( function ( a, b ) { return  (parseFloat(a) + parseFloat( b)) ; }, 0 )
      // $( api1.column( 6 ).footer() ).html( `<span class="float-left">S/</span> <span class="float-right">${formato_miles(total1)}</span>` );
    },
    bDestroy: true,
    iDisplayLength: 10, //Paginación
    order: [[0, "asc"]], //Ordenar (columna,orden)
    columnDefs: [
      // //{ targets: [], visible: false, searchable: false, },
      // { targets: [5], render: $.fn.dataTable.render.moment('YYYY-MM-DD', 'DD/MM/YYYY'), },
      // { targets: [6,7,8], render: function (data, type) { var number = $.fn.dataTable.render.number(',', '.', 2).display(data); if (type === 'display') { let color = 'numero_positivos'; if (data < 0) {color = 'numero_negativos'; } return `<span class="float-left">S/</span> <span class="float-right ${color} "> ${number} </span>`; } return number; }, },
    ],
  }).DataTable();
}

function mostrar_pedido_paquete(idpaquete, idpedido_paquete) {
  //variables del array
  $(".titulo_pedido").html(`Pedido: <i class="fas fa-spinner fa-pulse fa-lg"></i> `);
  $("#modal-ver-pedido").modal("show");

  $.post("../ajax/pedido.php?op=mostrar_detalle_paquete", { 'idpaquete': idpaquete, 'idpedido_paquete': idpedido_paquete }, function (e, status) {
    e = JSON.parse(e);   console.log(e);  
    if (e.status == true) {
      $(".titulo_pedido").html(`Pedido: ${e.data.pedido.nombre}`);

      $('.pedido_html').html(`<div class="table-responsive p-0">
        <table class="table table-hover table-bordered  mt-4">          
          <tbody>
            <tr>
              <th>Nombre</th>
              <td>${e.data.pedido.nombre}</td>
            </tr>
            <tr>
              <th>Telefono</th>
              <td><a href="tel:+51${e.data.pedido.telefono}">${e.data.pedido.telefono}</a></td>
            </tr>
            <tr>
              <th>Correo</th>
              <td><a href="mailto:${e.data.pedido.correo}">${e.data.pedido.correo}</a></td>
            </tr>
            <tr>
              <th>Descripción</th>
              <td>${e.data.pedido.descripcion}</td>
            </tr>           
          </tbody>
        </table>
      </div>`);

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


      $(".jq_image_zoom").zoom({ on: "grab" });      
      tabla_pedido_paquete.ajax.reload(null, false);
    } else {
      ver_errores(e);
    } 
  }).fail(function (e) { ver_errores(e); });
}

//Función para activar registros
function vendido_paquete(idpedido, nombre) {
  Swal.fire({
    title: "¿Está Seguro que este pedido se a vendido?",
    html: `<b class="text-success">.::: ${nombre} :::.</b> <br>Este pedido se registrara como vendido`,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#28a745",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, vender!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post( "../ajax/pedido.php?op=vendido_paquete", { 'idpedido': idpedido },  function (e) {
        try {
          e = JSON.parse(e);
          if (e.status == true) {
            Swal.fire("Vendido!", "El pedido a sido vendido.", "success");
            tabla_pedido_paquete.ajax.reload(null, false);
          } else {
            ver_errores(e);
          }
        } catch (e) { ver_errores(e); }
      }).fail(function (e) { ver_errores(e); }); // todos los post tienen que tener
    }
  });
}

//Función para activar registros
function remover_vendido_paquete(idpedido, nombre) {
  Swal.fire({
    title: "¿Está Seguro de REMOVER lo vendido?",
    html: `<b class="text-danger">.::: <del>${nombre}</del> :::.</b> <br>Este pedido se removera como <b>no vendido</b> `,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#28a745",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, vender!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post( "../ajax/pedido.php?op=remover_vendido_paquete", { 'idpedido': idpedido },  function (e) {
        try {
          e = JSON.parse(e);
          if (e.status == true) {
            Swal.fire("Removido!", "El pedido a sido <b>no vendido</b>.", "success");
            tabla_pedido_paquete.ajax.reload(null, false);
          } else {
            ver_errores(e);
          }
        } catch (e) { ver_errores(e); }
      }).fail(function (e) { ver_errores(e); }); // todos los post tienen que tener
    }
  });
}

//Función para desactivar registros
function eliminar_pedido_paquete(idpedido, nombre) {
  crud_eliminar_papelera(
    "../ajax/pedido.php?op=desactivar_paquete",
    "../ajax/pedido.php?op=eliminar_paquete",
    idpedido,
    "!Elija una opción¡",
    `<b class="text-danger"><del>${nombre}</del></b> <br> En <b>papelera</b> encontrará este registro! <br> Al <b>eliminar</b> no tendrá acceso a recuperar este registro!`,
    function () { sw_success("♻️ Papelera! ♻️", "Tu registro ha sido reciclado.");  },
    function () { sw_success("Eliminado!", "Tu registro ha sido Eliminado."); },
    function () { tabla_pedido_paquete.ajax.reload(null, false); },
    false,
    false,
    false,
    false
  );
}




// ::::::::::::::::::::::::::::::::::::::::: PEDIDO PAQUETE A MEDIDA :::::::::::::::::::::::::::

//Función Listar
function tbla_principal_a_medida() {
  tabla_pedido_a_medida = $("#tabla-pedido-a-medida").dataTable({
    responsive: true,
    lengthMenu: [[-1, 5, 10, 25, 75, 100, 200], ["Todos", 5, 10, 25, 75, 100, 200], ], //mostramos el menú de registros a revisar
    aProcessing: true, //Activamos el procesamiento del datatables
    aServerSide: true, //Paginación y filtrado realizados por el servidor
    dom: "<'row'<'col-md-3'B><'col-md-3 float-left'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>", //Definimos los elementos del control de tabla
    buttons: [      
      { text: '<i class="fa-solid fa-arrows-rotate" data-toggle="tooltip" data-original-title="Recargar"></i>', className: "btn bg-gradient-info", action: function ( e, dt, node, config ) { tabla_pedido_a_medida.ajax.reload(null, false); toastr_success('Exito!!', 'Actualizando tabla', 400); } },
      { extend: 'copyHtml5', exportOptions: { columns: [0,1,2,3], }, text: `<i class="fas fa-copy" data-toggle="tooltip" data-original-title="Copiar"></i>`, className: "btn bg-gradient-gray", footer: true,  }, 
      { extend: 'excelHtml5', exportOptions: { columns: [0,1,2,3], }, text: `<i class="far fa-file-excel fa-lg" data-toggle="tooltip" data-original-title="Excel"></i>`, className: "btn bg-gradient-success", footer: true,  }, 
      { extend: 'pdfHtml5', exportOptions: { columns: [0,1,2,3], }, text: `<i class="far fa-file-pdf fa-lg" data-toggle="tooltip" data-original-title="PDF"></i>`, className: "btn bg-gradient-danger", footer: false, orientation: 'landscape', pageSize: 'LEGAL',  },
      { extend: "colvis", text: `Columnas`, className: "btn bg-gradient-gray", exportOptions: { columns: "th:not(:last-child)", }, },
    ],
    ajax: {
      url: "../ajax/pedido.php?op=tbla_principal_a_medida",
      type: "get",
      dataType: "json",
      error: function (e) {
        console.log(e.responseText);
      },
    },
    createdRow: function (row, data, ixdex) {
      // columna: #
      if (data[0] != "") {  $("td", row).eq(0).addClass("text-center"); }
      // columna: acciones
      if (data[1] != "") { $("td", row).eq(1).addClass("text-nowrap");  }
      // columna: estado
      if (data[7] != "") {  $("td", row).eq(7).addClass("text-nowrap");  }
    },
    language: {
      lengthMenu: "Mostrar: _MENU_ registros",
      buttons: {
        copyTitle: "Tabla Copiada",
        copySuccess: { _: "%d líneas copiadas", 1: "1 línea copiada" },
      },
      sLoadingRecords:
        '<i class="fas fa-spinner fa-pulse fa-lg"></i> Cargando datos...',
    },
    footerCallback: function (tfoot, data, start, end, display) {
      },
    bDestroy: true,
    iDisplayLength: 10, //Paginación
    order: [[0, "asc"]], //Ordenar (columna,orden)
    columnDefs: [
    ],
  }).DataTable();
}

//Función Mostrar Tods los Datos
function mostrar_paquete_a_medida(idpaquete_a_medida) {
  //variables del array
  $(".titulo_pedido").html(`Pedido: <i class="fas fa-spinner fa-pulse fa-lg"></i> `);
  $("#modal-ver-paquete-a-medida").modal("show");

  $.post("../ajax/pedido.php?op=mostrar_detalle_paquete_a_medida", { 'idpaquete_a_medida': idpaquete_a_medida }, function (e, status) {
    e = JSON.parse(e);   console.log(e);  
    if (e.status == true) {
      $(".titulo_pedido").html(`Pedido de: ${e.data.paquete_a_medida.p_nombre}`);

      $('.datos1_html').html(`<div class="table-responsive p-0">
        <table class="table table-hover table-bordered  mt-4">          
          <tbody>
            <tr>
              <th>Nombre</th>
              <td>${e.data.paquete_a_medida.p_nombre}</td>
            </tr>
            <tr>
              <th>Telefono</th>
              <td><a href="tel:+51${e.data.paquete_a_medida.p_celular}">${e.data.paquete_a_medida.p_celular}</a></td>
            </tr>
            <tr>
              <th>Correo</th>
              <td><a href="mailto:${e.data.paquete_a_medida.p_correo}">${e.data.paquete_a_medida.p_correo}</a></td>
            </tr>
            <tr>
              <th>Descripción</th>
              <td>${e.data.paquete_a_medida.p_descripcion}</td>
            </tr>           
          </tbody>
        </table>
      </div>`);

      $('.home2_html').html('');
      e.data.tours.forEach((val, key) => {
        $('.home2_html').append(`<div class="table-responsive p-0">
          <table class="table table-hover table-bordered  mt-4">    
            <thead> <tr> <th class="text-center" colspan="2" >${val.nombre_tours}</th> </tr> </thead>      
            <tbody>
              <tr> <th>IMAGEN</th>  <td><img src="../dist/docs/tours/perfil/${val.imagen}"  width="100px" height="auto" onerror="this.src='../dist/docs/tours/perfil/tours-sin-foto.jpg'"></td> </tr>
              <tr> <th>RESUMEN</th>  <td>${val.resumen_actividad}</td> </tr>              
            </tbody>
          </table>
        </div>`);
      });      

      $('.otros3_html').html(`<div class="table-responsive p-0">
        <table class="table table-hover table-bordered  mt-4">          
          <tbody>
            <tr>
              <th>Motivo de Viaje</th>
              <td>${e.data.paquete_a_medida.ocacion_viaje}</td>
            </tr>
            <tr>
              <th>Tipo de Hotel</th>
              <td>${e.data.paquete_a_medida.tipo_hotel}</td>
            </tr>
            <tr>
              <th>Presupuesto</th>
              <td>${e.data.paquete_a_medida.presupuesto}</td>
            </tr>
            <tr>
              <th>Tipo de Viaje</th>
              <td>${e.data.paquete_a_medida.tipo_viaje}</td>
            </tr>            
          </tbody>
        </table>
      </div>`);
      
      tabla_pedido_a_medida.ajax.reload(null, false);
    } else {
      ver_errores(e);
    } 
  }).fail(function (e) { ver_errores(e); });
}


// .....::::::::::::::::::::::::::::::::::::: V A L I D A T E   F O R M  :::::::::::::::::::::::::::::::::::::::..
$(function () {
  // Aplicando la validacion del select cada vez que cambie
  $("#idpaquete").on("change", function () {  $(this).trigger("blur"); });

  $("#form-galeria-pedido").validate({
    ignore: ".select2-input, .select2-focusser",
    rules: {
      idpaquete: { required: true },
      nombre: { minlength: 2 },
      correo: { email: true, minlength: 10, maxlength: 50 },
      telefono: { minlength: 8 },
      descripcion: { minlength: 4 },
    },
    messages: {
      idpaquete: { required: "Campo requerido" },
      nombre: { minlength: "Minimo 2 caracteres" },
      correo: {
        required: "Campo requerido.",
        email: "Ingrese un correo electronico válido.",
        minlength: "MÍNIMO 10 caracteres.",
        maxlength: "MÁXIMO 50 caracteres.",
      },
      telefono: { minlength: "Minimo 8 caracteres" },
      descripcion: { minlength: "Minimo 4 Caracteres" },
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
      guardar_y_editar_pedido(e);
    },
  });

  $("#form-ventas").validate({
    ignore: '.select2-input, .select2-focusser',
    rules: {      
      tipo_comprobante:   { required: true },      
      descripcion:        { minlength: 4 },       
      pagar_con_ctdo:     { required: true, number: true, min:0,  },
      pagar_con_ctdo:     { required: true },      
      pagar_con_tarj:     { required: true }, 
    },
    messages: {      
      tipo_comprobante:   { required: "Campo requerido", },     
      descripcion:        { minlength: "Minimo 4 caracteres", },         
      pagar_con_ctdo:     { required: "Campo requerido", number: 'Ingrese un número', min:'Mínimo 0', },
      agar_con_ctdo:      { required: "Campo requerido" },      
      pagar_con_tarj:     { required: "Campo requerido" },            
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

    submitHandler: function (form) {
      guardar_y_editar_ventas(form);
    },
  }); 

  //agregando la validacion del select  ya que no tiene un atributo name el plugin
  $("#idpaquete").rules("add", { required: true, messages: { required: "Campo requerido" }, });
});

// .....::::::::::::::::::::::::::::::::::::: VENDER PEDIDO  :::::::::::::::::::::::::::::::::::::::..

var impuesto = 18;

function vender_pedido(idpedido, idtours) {

  $("#modal-vender-pedido").modal("show");

  var cont = 0;
  var cantidad = 1;

  $.post("../ajax/ajax_general.php?op=mostrar_producto_tours", {'idtours': idtours}, function (e, textStatus, jqXHR) {          
        
    e = JSON.parse(e); console.log(e);
    if (e.status == true) {
     
      var subtotal =  e.data.costo;      

      var img_p = e.data.imagen == "" || e.data.imagen == null ?img_p = `../dist/docs/tours/perfil/tours-sin-foto.jpg` : `../dist/docs/tours/perfil/${e.data.imagen}` ;          

      var fila = `
      <tr class="filas" id="fila${cont}">       
        <td class="py-1">         
          <input type="hidden" name="idtours[]" value="${e.data.idtours}">
          <div class="user-block text-nowrap">
            <img class="profile-user-img img-responsive img-circle cursor-pointer img_perfil_${cont}" src="${img_p}" alt="user image" onerror="this.src='../dist/svg/404-v2.svg';" onclick="ver_img_producto('${img_p}', '${encodeHtml(e.data.nombre)}')">
            <span class="username"><p class="mb-0 nombre_producto_${e.data.idtours}">${e.data.nombre}</p></span>
            <span class="description categoria_${cont}"><b>Dcto: </b> ${parseFloat(e.data.porcentaje_descuento)}%<b> |<b>tipo: </b>${e.data.tipo_tours}</span>
          </div>
        </td>
        <td class="py-1">
          <span class="unidad_medida_${cont}">UNIDAD</span> 
          <input type="hidden" class="unidad_medida_${cont}" name="unidad_medida[]" id="unidad_medida[]" value="UNIDAD">
          <input class="tipo_tours_${cont}" type="hidden" name="tipo_tours[]" id="tipo_tours[]" value="${e.data.tipo_tours}">
        </td>
        <td class="py-1 form-group">
          <input type="number" class="w-100px valid_cantidad form-control producto_${e.data.idtours} producto_selecionado" name="valid_cantidad[${cont}]" id="valid_cantidad_${cont}" value="${cantidad}" min="0.01" required onkeyup="replicar_value_input(${cont}, '#cantidad_${cont}', this); update_price(); " onchange="replicar_value_input(${cont}, '#cantidad_${cont}', this); update_price(); ">
          <input type="hidden" class="cantidad_${cont}" name="cantidad[]" id="cantidad_${cont}" value="1" min="0.01" required  >            
        </td>            
        <td class="py-1 form-group">
          <input type="number" class="w-135px form-control valid_precio_con_igv" name="valid_precio_con_igv[${cont}]" id="valid_precio_con_igv_${cont}" value="${e.data.costo}" min="0.01" required onkeyup="replicar_value_input(${cont}, '#precio_con_igv_${cont}', this); update_price(); " onchange="replicar_value_input(${cont}, '#precio_con_igv_${cont}', this); update_price(); ">
          <input type="hidden" class="precio_con_igv_${cont}" name="precio_con_igv[]" id="precio_con_igv_${cont}" value="${e.data.costo}" onkeyup="modificarSubtotales();" onchange="modificarSubtotales();">              
          <input type="hidden" class="precio_sin_igv_${cont}" name="precio_sin_igv[]" id="precio_sin_igv[]" value="0" min="0" >
          <input type="hidden" class="precio_igv_${cont}" name="precio_igv[]" id="precio_igv[]" value="0"  >
        </td>        
        <td class="py-1 form-group">
          <input type="number" class="w-135px form-control descuento_${cont}" name="descuento[]" value="${ ( e.data.estado_descuento == 0 ? 0 : ( e.data.monto_descuento )) }" min="0.00" onkeyup="modificarSubtotales()" onchange="modificarSubtotales()">
        </td>
        <td class="py-1 text-right"><span class="text-right subtotal_producto_${cont}" id="subtotal_producto">${subtotal}</span> <input type="hidden" name="subtotal_producto[]" id="subtotal_producto_${cont}" value="0" > </td>
        <td class="py-1"><button type="button" onclick="modificarSubtotales()" class="btn btn-info btn-sm"><i class="fas fa-sync"></i></button></td>
      </tr>`;

      
      $("#detalles").html(fila);      

      // reglas de validación     
      $('.valid_precio_con_igv').each(function(e) { 
        $(this).rules('add', { required: true, messages: { required: 'Campo requerido' } }); 
        $(this).rules('add', { min:0.01, messages: { min:"Mínimo 0.01" } }); 
      });
      $('.valid_cantidad').each(function(e) { 
        $(this).rules('add', { required: true, messages: { required: 'Campo requerido' } }); 
        $(this).rules('add', { min:0.01, messages: { min:"Mínimo 0.01" } }); 
      });    
      
    } else {
      ver_errores(e);
    }   
  });
}
function calcular_vuelto() {
  var contado = $('#pagar_con_ctdo').val() == null || $('#pagar_con_ctdo').val() == '' ? 0 : parseFloat($('#pagar_con_ctdo').val());  
  var mixto = $('#pagar_con_tarj').val() == null || $('#pagar_con_tarj').val() == '' ? 0 : parseFloat($('#pagar_con_tarj').val());
  var total_venta = $('#total_venta').val() == null || $('#total_venta').val() == '' ? 0 : parseFloat($('#total_venta').val());
  
  if ($('#pagar_con_ctdo').val() != '' || $('#pagar_con_tarj').val() != '' ) { 
    if ($("#metodo_pago").select2("val") == "MIXTO") {    
      var vuelto_1 = redondearExp(( ( contado + mixto ) - total_venta ), 2); console.log(vuelto_1);
      $('.vuelto_venta').html(vuelto_1);
      $('#vuelto_venta').val(vuelto_1);
      vuelto_1 < 0 ? $('.vuelto_venta').addClass('bg-danger').removeClass('bg-success') : $('.vuelto_venta').addClass('bg-success').removeClass('bg-danger') ;
      vuelto_1 < 0 ? $('.falta_o_completo').html('(falta)').addClass('text-danger').removeClass('text-success') : $('.falta_o_completo').html('(completo)').addClass('text-success').removeClass('text-danger') ;
    } else {    
      var vuelto_2 = redondearExp((contado - total_venta), 2) ; console.log(vuelto_2);
      $('.vuelto_venta').html(vuelto_2);
      $('#vuelto_venta').val(vuelto_2);
      vuelto_2 < 0 ? $('.vuelto_venta').addClass('bg-danger').removeClass('bg-success') : $('.vuelto_venta').addClass('bg-success').removeClass('bg-danger') ;
      vuelto_2 < 0 ? $('.falta_o_completo').html('(falta)').addClass('text-danger').removeClass('text-success') : $('.falta_o_completo').html('(completo)').addClass('text-success').removeClass('text-danger') ;
    } 
  }  
}

function pago_rapido(val) {
  var pago_monto = $(val).text(); console.log(pago_monto);
  $('#pagar_con_ctdo').val(pago_monto);
  calcular_vuelto();
  $("#form-ventas").valid();
}
// .....::::::::::::::::::::::::::::::::::::: F U N C I O N E S    A L T E R N A S  :::::::::::::::::::::::::::::::::::::::..

init();
// ver imagen grande de la persona
function ver_img_perfil(file, nombre) {
  $(".nombre-imagen-peril").html(nombre);    
  $("#imagen-paquete").html(
    `<span class="jq_image_zoom"><img class="img-thumbnail" src="${file}" onerror="this.src='../dist/svg/404-v2.svg';" alt="Perfil" width="100%"></span>`
  );
  $("#modal-ver-imagen").modal("show");
  $(".jq_image_zoom").zoom({ on: "grab" });
  $(".tooltip").remove();
}
