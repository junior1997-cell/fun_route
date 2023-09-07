var tabla_comentario;

//Función que se ejecuta al inicio
function init() {
  //Activamos el "aside"

  $("#bloc_LogisticaComentario_paquete").addClass("menu-open");

  $("#bloc_lComentario_paquete").addClass("menu-open bg-color-191f24");

  $("#mlComentario_paquete").addClass("active");

  $("#mlComentario_paquete").addClass("active bg-green");

  $("#lComentario_paquete").addClass("active");

  
  tbla_principal();

  
  // ══════════════════════════════════════ G U A R D A R   F O R M ══════════════════════════════════════ 
  $("#guardar_registro_comentario_paquete").on("click", function (e) { $("#submit-form-comentario-paquete").submit(); });

  // ══════════════════════════════════════ INITIALIZE SELECT2 - OTRO INGRESO  ══════════════════════════════════════
  $("#idpersona").select2({ theme: "bootstrap4", placeholder: "Selecione un proveedor o productor", allowClear: true,   });
  $("#idtipopersona").select2({ theme: "bootstrap4", placeholder: "Selecione un tipo", allowClear: true,   });

  // Formato para telefono
  $("[data-mask]").inputmask();
}

function show_hide_form(flag) {
	if (flag == 1)	{		
		$("#mostrar-tabla").show();
    $("#mostrar-form").hide();
    $(".btn-regresar").hide();
    $(".btn-agregar").show();
	}	else	{
		$("#mostrar-tabla").hide();
    $("#mostrar-form").show();
    $(".btn-regresar").show();
    $(".btn-agregar").hide();
	}
}

//Función Listar
function tbla_principal() {
  tabla_comentario_paquete = $("#tabla-comentario-paquete").dataTable({
    responsive: true,
    lengthMenu: [[ -1, 5, 10, 25, 75, 100, 200,], ["Todos", 5, 10, 25, 75, 100, 200, ]], //mostramos el menú de registros a revisar
    aProcessing: true, //Activamos el procesamiento del datatables
    aServerSide: true, //Paginación y filtrado realizados por el servidor
    dom: "<'row'<'col-md-3'B><'col-md-3 float-left'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>", //Definimos los elementos del control de tabla
    buttons: [      
      { text: '<i class="fa-solid fa-arrows-rotate" data-toggle="tooltip" data-original-title="Recargar"></i>', className: "btn bg-gradient-info", action: function ( e, dt, node, config ) { tabla_comentario_paquete.ajax.reload(null, false); toastr_success('Exito!!', 'Actualizando tabla', 400); } },
      { extend: 'copyHtml5', exportOptions: { columns: [0,2], }, text: `<i class="fas fa-copy" data-toggle="tooltip" data-original-title="Copiar"></i>`, className: "btn bg-gradient-gray", footer: true,  }, 
      { extend: 'excelHtml5', exportOptions: { columns: [0,2], }, text: `<i class="far fa-file-excel fa-lg" data-toggle="tooltip" data-original-title="Excel"></i>`, className: "btn bg-gradient-success", footer: true,  }, 
      { extend: 'pdfHtml5', exportOptions: { columns: [0,2], }, text: `<i class="far fa-file-pdf fa-lg" data-toggle="tooltip" data-original-title="PDF"></i>`, className: "btn bg-gradient-danger", footer: false, orientation: 'landscape', pageSize: 'LEGAL',  },
      { extend: "colvis", text: `Columnas`, className: "btn bg-gradient-gray", exportOptions: { columns: "th:not(:last-child)", }, },
    ],
    ajax: {
      url: "../ajax/comentario_paquete.php?op=tbla_principal",
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
      if (data[6] != "") { $("td", row).eq(6).addClass("text-nowrap text-right"); }
      // columna: total
      if (data[7] != "") { $("td", row).eq(7).addClass("text-nowrap text-right"); }
    },
    language: {
      lengthMenu: "Mostrar: _MENU_ registros",
      buttons: { copyTitle: "Tabla Copiada", copySuccess: { _: "%d líneas copiadas", 1: "1 línea copiada", }, },
      sLoadingRecords: '<i class="fas fa-spinner fa-pulse fa-lg"></i> Cargando datos...'
    },
    footerCallback: function( tfoot, data, start, end, display ) {
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
function guardar_y_editar_comentario_paquete(e) {
  // e.preventDefault(); //No se activará la acción predeterminada del evento
  var formData = new FormData($("#form-comentario-paquete")[0]);

  $.ajax({
    url: "../ajax/comentario_paquete.php?op=guardar_y_editar_comentario_paquete",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (e) {
      try {
        e = JSON.parse(e);
        if (e.status == true) {

          Swal.fire("Correcto!", "El registro se guardo correctamente.", "success");

          tabla_comentario_paquete.ajax.reload(null, false);

          limpiar_form();    

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
function mostrar_comentario_paquete(idcomentario_paquete) {

  limpiar_comentario_paquete();
  
  $("#cargando-1-fomulario").hide();
  $("#cargando-2-fomulario").show();

  $("#modal-agregar-comentario-paquete").modal("show");

  $.post("../ajax/comentario_paquete.php?op=mostrar_comentario_paquete", { idcomentario_paquete: idcomentario_paquete }, function (e, status) {
    
    e = JSON.parse(e); console.log('jolll'); console.log(e);    

    $("#idcomentario_paquete").val(e.data.idcomentario_paquete).trigger("change");
    $("#nombre").val(e.data.nombre).trigger("change");
    $("#correo").val(e.data.correo).trigger("change");
    $("#nota").val(e.data.comentario_paquete).trigger("change");
    $("#fecha").val(e.data.fecha).trigger("change");
    $("#estrella").val(e.data.estrella);
    
    if (e.data.imagen == "" || e.data.imagen == null  ) {

      $("#doc1_ver").html('<img src="../dist/svg/pdf_trasnparent.svg" alt="" width="50%" >');

      $("#doc1_nombre").html('');

      $("#doc_old_1").val(""); $("#doc1").val("");

    } else {

      $("#doc_old_1").val(e.data.comprobante); 

      $("#doc1_nombre").html(`<div class="row"> <div class="col-md-12"><i>Baucher.${extrae_extencion(e.data.imagen)}</i></div></div>`);
      // cargamos la imagen adecuada par el archivo
      $("#doc1_ver").html(doc_view_extencion(e.data.imagen,'admin/dist/docs/paquete/perfil/', '100%', '210' ));   //ruta imagen    
          
    }
    $('.jq_image_zoom').zoom({ on:'grab' });
     
    
    $("#cargando-1-fomulario").show();
    $("#cargando-2-fomulario").hide();
  }).fail( function(e) { ver_errores(e); } );
}


//Función para eliminar comt_paq
function eliminar_comentario_paquete(idcomentario_paquete, nombre) {

  crud_eliminar_papelera(
    "../ajax/comentario_paquete.php?op=desactivar",
    "../ajax/comentario_paquete.php?op=eliminar", 
    idcomentario_paquete, 
    "!Elija una opción¡", 
    `<b class="text-danger"><del>${nombre}</del></b> <br> En <b>papelera</b> encontrará este registro! <br> Al <b>eliminar</b> no tendrá acceso a recuperar este registro!`, 
    function(){ sw_success('♻️ Papelera! ♻️', "Tu registro ha sido reciclado." ) }, 
    function(){ sw_success('Eliminado!', 'Tu registro ha sido Eliminado.' ) }, 
    function(){ tabla_comentario.ajax.reload(null, false); },
    false, 
    false, 
    false,
    false
  );
}

//Función para verificar comt_paq
function verificar_comentario(idcomentario_paquete) {
  Swal.fire({
    title: "¿Está seguro de que desea verificar este comentario?",
    text: "Este comentario se verificará",
    icon: "success",
    showCancelButton: true,
    confirmButtonColor: "#3567dc",
    cancelButtonColor: "#6c757d",
    confirmButtonText: "Sí, verificar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post(
        "../ajax/comentario_paquete.php?op=verificar",
        { idcomentario_paquete: idcomentario_paquete},
        function (response) {
          try {
            response = JSON.parse(response);
            if (response.status == true) {
              Swal.fire("Verificado", "El comentario ha sido verificado.", "success");
              // Aquí puedes realizar cualquier otra acción después de verificar el comentario
              tbla_principal();
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

//Función para desactivar la verificación de comt_paq
function desactivar_comentario(idcomentario_paquete) {
  Swal.fire({
    title: "¿Está seguro de que desea desactivar la verificación de este comentario?",
    text: "Este comentario se desactivará",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#dc3b35",
    cancelButtonColor: "#6c757d",
    confirmButtonText: "Sí, dasactivar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post(
        "../ajax/comentario_paquete.php?op=no_verificar",
        { idcomentario_paquete: idcomentario_paquete},
        function (response) {
          try {
            response = JSON.parse(response);
            if (response.status == true) {
              Swal.fire("Desactivado", "El comentario ha sido desactivado.", "success");
              // Aquí puedes realizar cualquier otra acción después de verificar el comentario
              tbla_principal();
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



// :::::::::::::::::::::::::::::::::::::::::::::::::::: S E C C I O N   P R O V E E D O R  ::::::::::::::::::::::::::::::::::::::::::::::::::::
// .....::::::::::::::::::::::::::::::::::::: V A L I D A T E   F O R M  :::::::::::::::::::::::::::::::::::::::..
$(function () {   

  // Aplicando la validacion del select cada vez que cambie
  $("#forma_pago").on("change", function () { $(this).trigger("blur"); });
  $("#tipo_comprobante").on("change", function () { $(this).trigger("blur"); });

  $("#idpersona").on('change', function() { $(this).trigger('blur'); });
  $("#banco").on('change', function() { $(this).trigger('blur'); });
  $("#idtipopersona").on('change', function() { $(this).trigger('blur'); });


  $("#form-comentario-paquete").validate({
    ignore: '.select2-input, .select2-focusser',
    rules: {
      nombre:{ required: true, minlength:4, maxlength:100 },
      correo:  { email: true, minlength: 10, maxlength: 50 },
      comentario: { minlength:4 },
      fecha:{},
      estrella:{required:true},
      
    },
    messages: {
      nombre:{ required: "Campo requerido", minlength: "Minimo 3 caracteres", maxlength: "Maximo 100 Caracteres" },
      correo: { required: "Campo requerido", min: "Minimo 2 caracteres", max: "Maximo 20 Caracteres" },
      comentario: {minlength: "Minimo 4 Caracteres"},
      fecha:{},
      estrella:{required:"Campo requerido"},
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
      guardar_y_editar_comentario_paquete(e);
    },

  });


  

});

// .....::::::::::::::::::::::::::::::::::::: F U N C I O N E S    A L T E R N A S  :::::::::::::::::::::::::::::::::::::::..

// restringimos la fecha para no elegir mañana
no_select_tomorrow('#fecha_i');

init();