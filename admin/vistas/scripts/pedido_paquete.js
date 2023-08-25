var tabla_pedido;

//Función que se ejecuta al inicio
function init() {
  
  $("#bloc_LogisticaPaquetes").addClass("menu-open bg-color-191f24");
  
  $("#mLogisticaPaquetes").addClass("active bg-primary");
  
  $("#lPedido_paquete").addClass("active");

  tbla_principal();

  // ══════════════════════════════════════ S E L E C T 2 ══════════════════════════════════════
  lista_select2(
    "../ajax/ajax_general.php?op=select2Paquete",
    "#idpaquete",
    null
  );

  // ══════════════════════════════════════ G U A R D A R   F O R M ══════════════════════════════════════
  $("#guardar_registro-pedido").on("click", function (e) {
    $("#submit-form-pedido").submit();
  });

  // ══════════════════════════════════════ INITIALIZE SELECT2 - OTRO INGRESO  ══════════════════════════════════════
  $("#idpaquete").select2({
    theme: "bootstrap4",
    placeholder: "Selecione paquete",
    allowClear: true,
  });

  // Formato para telefono
  $("[data-mask]").inputmask();
}

function templateBanco(state) {
  //console.log(state);
  if (!state.id) {
    return state.text;
  }
  var baseUrl =
    state.title != ""
      ? `../dist/docs/banco/logo/${state.title}`
      : "../dist/docs/banco/logo/logo-sin-banco.svg";
  var onerror = `onerror="this.src='../dist/docs/banco/logo/logo-sin-banco.svg';"`;
  var $state = $(
    `<span><img src="${baseUrl}" class="img-circle mr-2 w-25px" ${onerror} />${state.text}</span>`
  );
  return $state;
}

// abrimos el navegador de archivos
$("#doc1_i").click(function () {
  $("#doc1").trigger("click");
});
$("#doc1").change(function (e) {
  addImageApplication(e, $("#doc1").attr("id"));
});

// Eliminamos el doc 1
function doc1_eliminar() {
  $("#doc1").val("");
  $("#doc1_ver").html(
    '<img src="../dist/svg/pdf_trasnparent.svg" alt="" width="50%" >'
  );
  $("#doc1_nombre").html("");
}

//Función limpiar
function limpiar_form() {
  $("#idotro_ingreso").val("");
  $("#fecha_i").val("");
  $("#nro_comprobante").val("");
  $("#ruc").val("");
  $("#razon_social").val("");
  $("#direccion").val("");
  $("#subtotal").val("");
  $("#igv").val("");
  $("#precio_parcial").val("");
  $("#descripcion").val("");

  $("#doc_old_1").val("");
  $("#doc1").val("");
  $("#doc1_ver").html(
    `<img src="../dist/svg/pdf_trasnparent.svg" alt="" width="50%" >`
  );
  $("#doc1_nombre").html("");

  $("#idpersona").val("null").trigger("change");
  $("#tipo_comprobante").val("null").trigger("change");
  $("#forma_pago").val("null").trigger("change");

  $("#val_igv").val("");
  $("#tipo_gravada").val("");

  // Limpiamos las validaciones
  $(".form-control").removeClass("is-valid");
  $(".form-control").removeClass("is-invalid");
  $(".error.invalid-feedback").remove();
}

function show_hide_form(flag) {
  if (flag == 1) {
    $("#mostrar-tabla").show();
    $("#mostrar-form").hide();
    $(".btn-regresar").hide();
    $(".btn-agregar").show();
  } else {
    $("#mostrar-tabla").hide();
    $("#mostrar-form").show();
    $(".btn-regresar").show();
    $(".btn-agregar").hide();
  }
}

//Función Listar
function tbla_principal() {
  tabla_pedido = $("#tabla-pedido").dataTable({
    responsive: true,
    lengthMenu: [[-1, 5, 10, 25, 75, 100, 200], ["Todos", 5, 10, 25, 75, 100, 200], ], //mostramos el menú de registros a revisar
    aProcessing: true, //Activamos el procesamiento del datatables
    aServerSide: true, //Paginación y filtrado realizados por el servidor
    dom: "<'row'<'col-md-3'B><'col-md-3 float-left'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>", //Definimos los elementos del control de tabla
    buttons: [      
      { text: '<i class="fa-solid fa-arrows-rotate" data-toggle="tooltip" data-original-title="Recargar"></i>', className: "btn bg-gradient-info", action: function ( e, dt, node, config ) { tabla_pedido.ajax.reload(null, false); toastr_success('Exito!!', 'Actualizando tabla', 400); } },
      { extend: 'copyHtml5', exportOptions: { columns: [0,1,2,3], }, text: `<i class="fas fa-copy" data-toggle="tooltip" data-original-title="Copiar"></i>`, className: "btn bg-gradient-gray", footer: true,  }, 
      { extend: 'excelHtml5', exportOptions: { columns: [0,1,2,3], }, text: `<i class="far fa-file-excel fa-lg" data-toggle="tooltip" data-original-title="Excel"></i>`, className: "btn bg-gradient-success", footer: true,  }, 
      { extend: 'pdfHtml5', exportOptions: { columns: [0,1,2,3], }, text: `<i class="far fa-file-pdf fa-lg" data-toggle="tooltip" data-original-title="PDF"></i>`, className: "btn bg-gradient-danger", footer: false, orientation: 'landscape', pageSize: 'LEGAL',  },
      { extend: "colvis", text: `Columnas`, className: "btn bg-gradient-gray", exportOptions: { columns: "th:not(:last-child)", }, },
    ],
    ajax: {
      url: "../ajax/pedido_paquete.php?op=tbla_principal",
      type: "get",
      dataType: "json",
      error: function (e) {
        console.log(e.responseText);
      },
    },
    createdRow: function (row, data, ixdex) {
      // columna: #
      if (data[0] != "") {
        $("td", row).eq(0).addClass("text-center");
      }
      // columna: sub total
      if (data[1] != "") {
        $("td", row).eq(1).addClass("text-nowrap");
      }
      // columna: sub total
      if (data[5] != "") {
        $("td", row).eq(5).addClass("text-nowrap text-right");
      }
      // columna: igv
      if (data[6] != "") {
        $("td", row).eq(6).addClass("text-nowrap text-right");
      }
      // columna: total
      if (data[7] != "") {
        $("td", row).eq(7).addClass("text-nowrap text-right");
      }
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
      // var api2 = this.api(); var total2 = api2.column( 7 ).data().reduce( function ( a, b ) { return  (parseFloat(a) + parseFloat( b)) ; }, 0 )
      // $( api2.column( 7 ).footer() ).html( `<span class="float-left">S/</span> <span class="float-right">${formato_miles(total2)}</span>` );
      // var api3 = this.api(); var total3 = api3.column( 8 ).data().reduce( function ( a, b ) { return  (parseFloat(a) + parseFloat( b)) ; }, 0 )
      // $( api3.column( 8 ).footer() ).html( `<span class="float-left">S/</span> <span class="float-right">${formato_miles(total3)}</span>` );
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

//segun tipo de comprobante
function comprob_factura() {
  var precio_parcial = $("#precio_parcial").val();

  if (
    $("#tipo_comprobante").select2("val") == "" ||
    $("#tipo_comprobante").select2("val") == null
  ) {
    $(".nro_comprobante").html("Núm. Comprobante");

    $("#val_igv").val("");
    $("#tipo_gravada").val("");

    if (precio_parcial == null || precio_parcial == "") {
      $("#subtotal").val(0);
      $("#igv").val(0);
    } else {
      $("#subtotal").val(parseFloat(precio_parcial).toFixed(2));
      $("#igv").val(0);
    }
  } else {
    if ($("#tipo_comprobante").select2("val") == "Ninguno") {
      $(".nro_comprobante").html("Núm. de Operación");

      $("#val_igv").prop("readonly", true);

      if (precio_parcial == null || precio_parcial == "") {
        $("#subtotal").val(0);
        $("#igv").val(0);

        $("#val_igv").val("0");
        $("#tipo_gravada").val("NO GRAVADA");
      } else {
        $("#subtotal").val(parseFloat(precio_parcial).toFixed(2));
        $("#igv").val(0);

        $("#val_igv").val("0");
        $("#tipo_gravada").val("NO GRAVADA");
      }
    } else {
      if ($("#tipo_comprobante").select2("val") == "Factura") {
        $(".nro_comprobante").html("Núm. Comprobante");

        $(".div_ruc").show();
        $(".div_razon_social").show();

        calculandototales_fact();
      } else {
        $("#val_igv").prop("readonly", true);

        if ($("#tipo_comprobante").select2("val") == "Boleta") {
          $(".nro_comprobante").html("Núm. Comprobante");

          $(".div_ruc").show();
          $(".div_razon_social").show();

          if (precio_parcial == null || precio_parcial == "") {
            $("#subtotal").val(0);
            $("#igv").val(0);
            $("#val_igv").val("0");
          } else {
            $("#subtotal").val("");
            $("#igv").val("");

            $("#subtotal").val(parseFloat(precio_parcial).toFixed(2));
            $("#igv").val(0);

            $("#val_igv").val("0");
            $("#tipo_gravada").val("NO GRAVADA");
          }
        } else {
          $(".nro_comprobante").html("Núm. Comprobante");

          $(".div_ruc").hide();
          $(".div_razon_social").hide();

          $("#ruc").val("");
          $("#razon_social").val("");

          if (precio_parcial == null || precio_parcial == "") {
            $("#subtotal").val(0);
            $("#igv").val(0);

            $("#val_igv").val("0");
            $("#tipo_gravada").val("NO GRAVADA");
          } else {
            $("#subtotal").val(parseFloat(precio_parcial).toFixed(2));
            $("#igv").val(0);

            $("#val_igv").val("0");
            $("#tipo_gravada").val("NO GRAVADA");
          }
        }
      }
    }
  }
}

function validando_igv() {
  if ($("#tipo_comprobante").select2("val") == "Factura") {
    $("#val_igv").prop("readonly", false);
    $("#val_igv").val(0.18);
  } else {
    $("#val_igv").val(0);
  }
}

function calculandototales_fact() {
  //----------------
  $("#tipo_gravada").val("GRAVADA");

  $(".nro_comprobante").html("Núm. Comprobante");

  var precio_parcial = $("#precio_parcial").val();

  var val_igv = $("#val_igv").val();

  if (precio_parcial == null || precio_parcial == "") {
    $("#subtotal").val(0);
    $("#igv").val(0);
  } else {
    var subtotal = 0;
    var igv = 0;

    if (val_igv == null || val_igv == "") {
      $("#subtotal").val(parseFloat(precio_parcial));
      $("#igv").val(0);
    } else {
      $("subtotal").val("");
      $("#igv").val("");

      subtotal = quitar_igv_del_precio(precio_parcial, val_igv, "decimal");
      igv = precio_parcial - subtotal;

      $("#subtotal").val(parseFloat(subtotal).toFixed(2));
      $("#igv").val(parseFloat(igv).toFixed(2));
    }
  }
}

function quitar_igv_del_precio(precio, igv, tipo) {
  console.log(precio, igv, tipo);
  var precio_sin_igv = 0;

  switch (tipo) {
    case "decimal":
      if (parseFloat(precio) != NaN && igv > 0 && igv <= 1) {
        precio_sin_igv =
          (parseFloat(precio) * 100) / (parseFloat(igv) * 100 + 100);
      } else {
        precio_sin_igv = precio;
      }
      break;

    case "entero":
      if (parseFloat(precio) != NaN && igv > 0 && igv <= 100) {
        precio_sin_igv = (parseFloat(precio) * 100) / (parseFloat(igv) + 100);
      } else {
        precio_sin_igv = precio;
      }
      break;

    default:
      $(".val_igv").html("IGV (0%)");
      toastr.success("No has difinido un tipo de calculo de IGV.");
      break;
  }

  return precio_sin_igv;
}

//ver ficha tecnica
function modal_comprobante(comprobante, tipo, numero_comprobante) {
  var dia_actual = moment().format("DD-MM-YYYY");
  $(".nombre_comprobante").html(`${tipo}-${numero_comprobante}`);
  $("#modal-ver-comprobante").modal("show");
  $("#ver_fact_pdf").html(
    doc_view_extencion(
      comprobante,
      "otro_ingreso",
      "comprobante",
      "100%",
      "550"
    )
  );

  if (DocExist(`dist/docs/otro_ingreso/comprobante/${comprobante}`) == 200) {
    $("#iddescargar")
      .attr("href", "../dist/docs/otro_ingreso/comprobante/" + comprobante)
      .attr("download", `${tipo}-${numero_comprobante}  - ${dia_actual}`)
      .removeClass("disabled");
    $("#ver_completo")
      .attr("href", "../dist/docs/otro_ingreso/comprobante/" + comprobante)
      .removeClass("disabled");
  } else {
    $("#iddescargar").addClass("disabled");
    $("#ver_completo").addClass("disabled");
  }

  $(".jq_image_zoom").zoom({ on: "grab" });
}

//Función para guardar o editar
function guardar_y_editar_pedido(e) {
  // e.preventDefault(); //No se activará la acción predeterminada del evento
  var formData = new FormData($("#form-galeria-pedido")[0]);

  $.ajax({
    url: "../ajax/pedido_paquete.php?op=guardar_y_editar_pedido",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (e) {
      try {
        e = JSON.parse(e);
        if (e.status == true) {
          Swal.fire(
            "Correcto!",
            "El registro se guardo correctamente.",
            "success"
          );

          tabla_pedido.ajax.reload(null, false);
          $("#modal-agregar-pedido").modal("hide"); //
          limpiar_form();
        } else {
          ver_errores(e);
        }
      } catch (err) {
        console.log("Error: ", err.message);
        toastr.error(
          '<h5 class="font-size-16px">Error temporal!!</h5> puede intentalo mas tarde, o comuniquese con <i><a href="tel:+51921305769" >921-305-769</a></i> ─ <i><a href="tel:+51921487276" >921-487-276</a></i>'
        );
      }
      $("#guardar_registro").html("Guardar Cambios").removeClass("disabled");
    },
    beforeSend: function () {
      $("#guardar_registro")
        .html('<i class="fas fa-spinner fa-pulse fa-lg"></i>')
        .addClass("disabled");
    },
    error: function (jqXhr) {
      ver_errores(jqXhr);
    },
  });
}

function mostrar_pedido(idpaquete, idpedido_paquete) {
  //variables del array
  $("#cargando-1-fomulario").hide();
  $("#cargando-2-fomulario").show();

  $("#modal-ver-pedido").modal("show");
  $.post(
    "../ajax/pedido_paquete.php?op=mostrar",
    { idpaquete: idpaquete, idpedido_paquete: idpedido_paquete },
    function (e, status) {
      e = JSON.parse(e);
      console.log("jolll");
      console.log(e);
      var imagen =
        e.data.paquete.imagen === undefined || e.data.paquete.imagen === ""
          ? "../dist/svg/user_default.svg"
          : `../dist/docs/paquete/perfil/${e.data.paquete.imagen}`;
      verdatos = ` 
                <div class="col-12 col-sm-12 col-md-12 d-flex align-items-stretch flex-column">
                  <div class="card bg-light d-flex flex-fill">
                    <div class="card-body pt-0">
                      <div class="row">
                        <div class="col-7">
                          <h2 class="lead"><b>${e.data.paquete.nombre}</b></h2>
                          <p class="text-muted text-sm"> ${e.data.paquete.cant_dias} <b> Dias</b> / ${e.data.paquete.cant_noches} <b> Noches</b></p>
                          <ul class="ml-4 mb-0 fa-ul text-muted">
                            <label for="costo">Precio = S/. ${e.data.paquete.costo} </label>
                          </ul>
                          <ul class="ml-4 mb-0 fa-ul text-muted">
                            <li class="small"><span class="fa-li"></span> ${e.data.paquete.descripcion}</li>
                          </ul>
                          
                        </div>
                        <div class="col-5 text-center">
                          <img src="${imagen}" alt="user-avatar" class="img-rounded img-fluid">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>`;

      $("#paquete1").html(verdatos);

      var datosdetalle = `
                <div class="p-2 row">
                  <div class="col-12 " id="accordion">
                    <div class="card card-success card-outline">
                      <a class="d-block w-50" data-toggle="collapse" href="#collapseOne">
                        <div class="card-header">
                          <h4 class="card-title w-100">
                            Mapa
                          </h4>
                        </div>
                      </a>
                      <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">${e.data.paquete.mapa}</div>
                      </div>
                    </div>
                    <div class="card card-secondary card-outline">
                      <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                        <div class="card-header">
                          <h4 class="card-title w-100">
                            Incluye
                          </h4>
                        </div>
                      </a>
                      <div id="collapseTwo" class="collapse" data-parent="#accordion">
                        <div class="card-body">${e.data.paquete.incluye}</div>
                      </div>
                    </div>
                    <div class="card card-orange card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                No Incluye
                            </h4>
                        </div>
                    </a>
                    <div id="collapseThree" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                        <div class="card-body">${e.data.paquete.no_incluye}</div>
                        </div>
                    </div>
                    </div>
                    <div class="card card-gray card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseFour">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                Recomendaciones
                            </h4>
                        </div>
                    </a>
                    <div id="collapseFour" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                        <div class="card-body">${e.data.paquete.descripcion}</div>
                        </div>
                    </div>
                    </div>
                    
                  </div>
                </div>`;
      $("#detalles").html(datosdetalle);

      if (e.data.itinerario==null || e.data.itinerario=="") {
        $(".alerta").show();
      }else{
        $(".alerta").hide();
        var datositinerario="";
        e.data.itinerario.forEach((val,key) => {
          
          console.log(val.actividad);
        
              datositinerario =datositinerario.concat(`
              <div class="card card-row card-default">
                <div class="card-header bg-color-48acc6">  
                </div>
                <div class="card-body">
                <label for="Orden">${ val.numero_orden}</label>
                <textarea class="form-control actividad">${ val.actividad}</textarea>
                </div>
              </div>`);
        });
        
      
        $('#veritinerario').html(datositinerario); // Agregar el contenido al elemento con el ID "codigoGenerado"
         
  
      }

      /*var vergaleria = "";
      e.data.forEach((val, index) => {
        vergaleria = vergaleria.concat(`
        <div class="col-sm-2">
          <a href="../dist/docs/galeria_paquete/galeria_p/${val.imagen}?text=${
          index + 1
        }" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery">
            <img src="../dist/docs/galeria_paquete/galeria_p/${
              val.imagen
            }?text=${index + 1}" class="img-fluid mb-2" alt="white sample"/>
          </a>
        </div>

       `);
      });
      $("#galeria").html(`<div class="row">${vergaleria}</div>`);*/

      $(".jq_image_zoom").zoom({ on: "grab" });

      $("#cargando-1-fomulario").show();
      $("#cargando-2-fomulario").hide();
      tabla_pedido.ajax.reload(null, false);
    }
  ).fail(function (e) {
    ver_errores(e);
  });
}

//Función para desactivar registros
function eliminar_galeria_paquete(idpedido_paquete) {
  crud_eliminar_papelera(
    "../ajax/pedido_paquete.php?op=desactivar",
    "../ajax/pedido_paquete.php?op=eliminar",
    idpedido_paquete,
    "!Elija una opción¡",
    `<b class="text-danger"><del>...</del></b> <br> En <b>papelera</b> encontrará este registro! <br> Al <b>eliminar</b> no tendrá acceso a recuperar este registro!`,
    function () {
      sw_success("♻️ Papelera! ♻️", "Tu registro ha sido reciclado.");
    },
    function () {
      sw_success("Eliminado!", "Tu registro ha sido Eliminado.");
    },
    function () {
      tabla_pedido.ajax.reload(null, false);
    },
    false,
    false,
    false,
    false
  );
}
//Función para activar registros
function vendido(idpedido_paquete) {
  Swal.fire({
    title: "¿Está Seguro que este pedido se a vendido?",
    text: "Este pedido se registrara como vendido",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#28a745",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, vender!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post(
        "../ajax/pedido_paquete.php?op=vendido",
        { idpedido_paquete: idpedido_paquete },
        function (e) {
          try {
            e = JSON.parse(e);
            if (e.status == true) {
              Swal.fire("Vendido!", "El pedido a sido vendido.", "success");
              tabla_pedido.ajax.reload(null, false);
            } else {
              ver_errores(e);
            }
          } catch (e) {
            ver_errores(e);
          }
        }
      ).fail(function (e) {
        ver_errores(e);
      }); // todos los post tienen que tener
    }
  });
}
// :::::::::::::::::::::::::::::::::::::::::::::::::::: S E C C I O N   P R O V E E D O R  ::::::::::::::::::::::::::::::::::::::::::::::::::::
//Función limpiar
function limpiar_pedido() {
  $("#idpedido_paquete").val("");
  $("#idpaquete").val("");
  $("#idnombre").val("");
  $("#idcorreo").val("");
  $("#idtelefono").val("");
  $("#descripcion").val("");

  // Limpiamos las validaciones
  $(".form-control").removeClass("is-valid");
  $(".form-control").removeClass("is-invalid");
  $(".error.invalid-feedback").remove();

  $(".tooltip").removeClass("show").addClass("hidde");
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

// restringimos la fecha para no elegir mañana
no_select_tomorrow("#fecha_i");

init();
// ver imagen grande de la persona
function ver_img_paquete(file, nombre) {
  $(".nombre-paquete").html(nombre);
  $(".tooltip").removeClass("show").addClass("hidde");
  $("#modal-ver-imagen-paquet").modal("show");
  $("#imagen-paquete").html(
    `<span class="jq_image_zoom"><img class="img-thumbnail" src="${file}" onerror="this.src='../dist/svg/404-v2.svg';" alt="Perfil" width="100%"></span>`
  );
  $(".jq_image_zoom").zoom({ on: "grab" });
}
