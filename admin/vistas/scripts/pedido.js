var tabla_pedido;

//Función que se ejecuta al inicio
function init() {
  
  $("#bloc_LogisticaPaquetes").addClass("menu-open bg-color-191f24");
  
  $("#mLogisticaPaquetes").addClass("active bg-primary");
  
  $("#lPedido_paquete").addClass("active");

  tbla_principal_tours();

  // ══════════════════════════════════════ S E L E C T 2 ══════════════════════════════════════
  lista_select2("../ajax/ajax_general.php?op=select2Paquete", "#idpaquete", null);

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
  $("#fecha_i").val("");
  $("#nro_comprobante").val("");
  $("#ruc").val("");
  $("#razon_social").val("");
  $("#direccion").val("");
  $("#subtotal").val("");

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
function tbla_principal_tours() {
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
      url: "../ajax/pedido.php?op=tbla_principal_tours",
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

//Función para guardar o editar
function guardar_y_editar_pedido(e) {
  // e.preventDefault(); //No se activará la acción predeterminada del evento
  var formData = new FormData($("#form-galeria-pedido")[0]);

  $.ajax({
    url: "../ajax/pedido.php?op=guardar_y_editar_pedido",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (e) {
      try {
        e = JSON.parse(e);
        if (e.status == true) {
          Swal.fire( "Correcto!", "El registro se guardo correctamente.", "success" );
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
  $(".titulo_pedido").html(`Pedido: <i class="fas fa-spinner fa-pulse fa-lg"></i> `);
  $("#modal-ver-pedido").modal("show");

  $.post("../ajax/pedido.php?op=mostrar_detalle_tours", { 'idpaquete': idpaquete, 'idpedido_paquete': idpedido_paquete }, function (e, status) {
    e = JSON.parse(e);   console.log(e);  
    if (e.status == true) {
      $(".titulo_pedido").html(`Pedido: <i class="fas fa-spinner fa-pulse fa-lg"></i> `);

      $("#paquete1").html(verdatos);   


      $(".jq_image_zoom").zoom({ on: "grab" });      
      tabla_pedido.ajax.reload(null, false);
    } else {
      ver_errores(e);
    } 
  }).fail(function (e) { ver_errores(e); });
}

//Función para desactivar registros
function eliminar_galeria_paquete(idpedido_paquete) {
  crud_eliminar_papelera(
    "../ajax/pedido.php?op=desactivar",
    "../ajax/pedido.php?op=eliminar",
    idpedido_paquete,
    "!Elija una opción¡",
    `<b class="text-danger"><del>...</del></b> <br> En <b>papelera</b> encontrará este registro! <br> Al <b>eliminar</b> no tendrá acceso a recuperar este registro!`,
    function () { sw_success("♻️ Papelera! ♻️", "Tu registro ha sido reciclado.");  },
    function () { sw_success("Eliminado!", "Tu registro ha sido Eliminado."); },
    function () { tabla_pedido.ajax.reload(null, false); },
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
        "../ajax/pedido.php?op=vendido",
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
