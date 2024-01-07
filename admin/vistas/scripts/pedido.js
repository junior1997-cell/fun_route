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
  // lista_select2("../ajax/ajax_general.php?op=select2Paquete", "#idpaquete", null);

  // ══════════════════════════════════════ G U A R D A R   F O R M ══════════════════════════════════════
  $("#guardar_registro-pedido").on("click", function (e) { $("#submit-form-pedido").submit(); });

  // ══════════════════════════════════════ INITIALIZE SELECT2 - OTRO INGRESO  ══════════════════════════════════════
  $("#idpaquete").select2({ theme: "bootstrap4", placeholder: "Selecione paquete", allowClear: true, });

  // Formato para telefono
  $("[data-mask]").inputmask();
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
  $("#idpaquete").on("change", function () {
    $(this).trigger("blur");
  });

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

  //agregando la validacion del select  ya que no tiene un atributo name el plugin
  $("#idpaquete").rules("add", {
    required: true,
    messages: { required: "Campo requerido" },
  });
});

// .....::::::::::::::::::::::::::::::::::::: F U N C I O N E S    A L T E R N A S  :::::::::::::::::::::::::::::::::::::::..

init();
// ver imagen grande de la persona
function ver_img_perfil(file, nombre) {
  $(".nombre-paquete").html(nombre);
  $(".tooltip").removeClass("show").addClass("hidde");
  $("#modal-ver-imagen-paquet").modal("show");
  $("#imagen-paquete").html(
    `<span class="jq_image_zoom"><img class="img-thumbnail" src="${file}" onerror="this.src='../dist/svg/404-v2.svg';" alt="Perfil" width="100%"></span>`
  );
  $(".jq_image_zoom").zoom({ on: "grab" });
}
