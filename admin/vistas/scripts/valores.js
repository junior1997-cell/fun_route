var tabla_valores;

//Función que se ejecuta al inicio
function init() {
  //Activamos el "aside"

  $("#bloc_datos_generales").addClass("menu-open bg-color-191f24");

  $("#mAccesos").addClass("active");

  $("#lvalores").addClass("active");
 
 // $('#nombre').summernote();
 // $('#icono').summernote();
  //$('#descripcion').summernote();
  
  tbla_principal();
  console.log();

  // ══════════════════════════════════════ S E L E C T 2 ══════════════════════════════════════
  lista_select2("../ajax/otro_ingreso.php?op=selecct_produc_o_provee", '#idpersona', null);
  lista_select2("../ajax/otro_ingreso.php?op=select_tipo_persona", '#idtipopersona', null);
  lista_select2("../ajax/ajax_general.php?op=select2Banco", '#banco', null);

  // ══════════════════════════════════════ G U A R D A R   F O R M ══════════════════════════════════════ 
  $("#guardar_registro_valores").on("click", function (e) { $("#submit-form-valores").submit(); });

  // ══════════════════════════════════════ INITIALIZE SELECT2 - OTRO INGRESO  ══════════════════════════════════════
  $("#idpersona").select2({ theme: "bootstrap4", placeholder: "Selecione un proveedor o productor", allowClear: true,   });
  $("#idtipopersona").select2({ theme: "bootstrap4", placeholder: "Selecione un tipo", allowClear: true,   });

  $("#tipo_comprobante").select2({ theme: "bootstrap4", placeholder: "Seleccinar tipo comprobante", allowClear: true, });

  $("#forma_pago").select2({ theme: "bootstrap4", placeholder: "Seleccinar forma de pago", allowClear: true, });

  $("#banco").select2({templateResult: templateBanco, theme: "bootstrap4", placeholder: "Selecione un banco", allowClear: true, });

  // Formato para telefono
  $("[data-mask]").inputmask();
}

function templateBanco (state) {
  //console.log(state);
  if (!state.id) { return state.text; }
  var baseUrl = state.title != '' ? `../dist/docs/banco/logo/${state.title}`: '../dist/docs/banco/logo/logo-sin-banco.svg'; 
  var onerror = `onerror="this.src='../dist/docs/banco/logo/logo-sin-banco.svg';"`;
  var $state = $(`<span><img src="${baseUrl}" class="img-circle mr-2 w-25px" ${onerror} />${state.text}</span>`);
  return $state;
};

// abrimos el navegador de archivos
$("#doc1_i").click(function() {  $('#doc1').trigger('click'); });
$("#doc1").change(function(e) {  addImageApplication(e,$("#doc1").attr("id")) });

// Eliminamos el doc 1
function doc1_eliminar() {
	$("#doc1").val("");
	$("#doc1_ver").html('<img src="../dist/svg/pdf_trasnparent.svg" alt="" width="50%" >');
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
  $('#doc1_ver').html(`<img src="../dist/svg/pdf_trasnparent.svg" alt="" width="50%" >`);
  $('#doc1_nombre').html("");

  $("#idpersona").val("null").trigger("change");
  $("#tipo_comprobante").val("null").trigger("change");
  $("#forma_pago").val("null").trigger("change");

  $("#val_igv").val(""); 
  $("#tipo_gravada").val(""); 

  // Limpiamos las validaciones
  $(".form-control").removeClass('is-valid');
  $(".form-control").removeClass('is-invalid');
  $(".error.invalid-feedback").remove();
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
  tabla_valores = $("#tabla-valores").dataTable({
    responsive: true,
    lengthMenu: [[ -1, 5, 10, 25, 75, 100, 200,], ["Todos", 5, 10, 25, 75, 100, 200, ]], //mostramos el menú de registros a revisar
    aProcessing: true, //Activamos el procesamiento del datatables
    aServerSide: true, //Paginación y filtrado realizados por el servidor
    dom: "<'row'<'col-md-3'B><'col-md-3 float-left'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>", //Definimos los elementos del control de tabla
    buttons: [      
      { text: '<i class="fa-solid fa-arrows-rotate" data-toggle="tooltip" data-original-title="Recargar"></i>', className: "btn bg-gradient-info", action: function ( e, dt, node, config ) { tabla_valores.ajax.reload(null, false); toastr_success('Exito!!', 'Actualizando tabla', 400); } },
      { extend: 'copyHtml5', exportOptions: { columns: [0,1,2,3], }, text: `<i class="fas fa-copy" data-toggle="tooltip" data-original-title="Copiar"></i>`, className: "btn bg-gradient-gray", footer: true,  }, 
      { extend: 'excelHtml5', exportOptions: { columns: [0,1,2,3], }, text: `<i class="far fa-file-excel fa-lg" data-toggle="tooltip" data-original-title="Excel"></i>`, className: "btn bg-gradient-success", footer: true,  }, 
      { extend: 'pdfHtml5', exportOptions: { columns: [0,1,2,3], }, text: `<i class="far fa-file-pdf fa-lg" data-toggle="tooltip" data-original-title="PDF"></i>`, className: "btn bg-gradient-danger", footer: false, orientation: 'landscape', pageSize: 'LEGAL',  },
      { extend: "colvis", text: `Columnas`, className: "btn bg-gradient-gray", exportOptions: { columns: "th:not(:last-child)", }, },
    ],
    ajax: {
      url: "../ajax/valores.php?op=tbla_principal",
      type: "get",
      dataType: "json",
      error: function (e) {
        console.log(e.responseText); verer
      },
    },
    createdRow: function (row, data, ixdex) {
      // columna: #
      if (data[0] != "") { $("td", row).eq(0).addClass("text-center"); }
      // columna: sub total
      if (data[1] != "") { $("td", row).eq(1).addClass("text-nowrap"); }
    
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

//segun tipo de comprobante
function comprob_factura() {

  var precio_parcial = $("#precio_parcial").val(); 

  
  if ($("#tipo_comprobante").select2("val") == "" || $("#tipo_comprobante").select2("val") == null) {

    $(".nro_comprobante").html("Núm. Comprobante");

    $("#val_igv").val(""); $("#tipo_gravada").val(""); 

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


      $("#val_igv").prop("readonly",true);

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

        $(".div_ruc").show(); $(".div_razon_social").show();
      
          calculandototales_fact();     
    
      } else { 

        $("#val_igv").prop("readonly",true);

        if ($("#tipo_comprobante").select2("val") == "Boleta") {

          $(".nro_comprobante").html("Núm. Comprobante");
  
          $(".div_ruc").show(); $(".div_razon_social").show();
          
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

          $(".div_ruc").hide(); $(".div_razon_social").hide();

          $("#ruc").val(""); $("#razon_social").val("");

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

    $("#val_igv").prop("readonly",false);
    $("#val_igv").val(0.18); 

  }else {

    $("#val_igv").val(0); 

  }  
}

function calculandototales_fact() {
  //----------------
  $("#tipo_gravada").val("GRAVADA"); 
         
  $(".nro_comprobante").html("Núm. Comprobante");

  var precio_parcial = $("#precio_parcial").val();

  var val_igv = $('#val_igv').val();

  if (precio_parcial == null || precio_parcial == "") {

    $("#subtotal").val(0);
    $("#igv").val(0); 

  } else {
 
    var subtotal = 0;
    var igv = 0;

    if (val_igv == null || val_igv == "") {

      $("#subtotal").val(parseFloat(precio_parcial));
      $("#igv").val(0);

    }else{

      $("subtotal").val("");
      $("#igv").val("");

      subtotal = quitar_igv_del_precio(precio_parcial, val_igv, 'decimal');
      igv = precio_parcial - subtotal;

      $("#subtotal").val(parseFloat(subtotal).toFixed(2));
      $("#igv").val(parseFloat(igv).toFixed(2));

    }

  }  

}

function quitar_igv_del_precio(precio , igv, tipo ) {
  console.log(precio , igv, tipo);
  var precio_sin_igv = 0;

  switch (tipo) {
    case 'decimal':

      if (parseFloat(precio) != NaN && igv > 0 && igv <= 1 ) {
        precio_sin_igv = ( parseFloat(precio) * 100 ) / ( ( parseFloat(igv) * 100 ) + 100 )
      }else{
        precio_sin_igv = precio;
      }
    break;

    case 'entero':

      if (parseFloat(precio) != NaN && igv > 0 && igv <= 100 ) {
        precio_sin_igv = ( parseFloat(precio) * 100 ) / ( parseFloat(igv)  + 100 )
      }else{
        precio_sin_igv = precio;
      }
    break;
  
    default:
      $(".val_igv").html('IGV (0%)');
      toastr.success('No has difinido un tipo de calculo de IGV.')
    break;
  } 
  
  return precio_sin_igv; 
}

//ver ficha tecnica
function modal_comprobante(comprobante,tipo,numero_comprobante) {

  var dia_actual = moment().format('DD-MM-YYYY');
  $(".nombre_comprobante").html(`${tipo}-${numero_comprobante}`);
  $('#modal-ver-comprobante').modal("show");
  $('#ver_fact_pdf').html(doc_view_extencion(comprobante, 'admin/dist/docs/otro_ingreso/comprobante/', '100%', '550'));

  if (DocExist(`dist/docs/otro_ingreso/comprobante/${comprobante}`) == 200) {
    $("#iddescargar").attr("href","../dist/docs/otro_ingreso/comprobante/"+comprobante).attr("download", `${tipo}-${numero_comprobante}  - ${dia_actual}`).removeClass("disabled");
    $("#ver_completo").attr("href","../dist/docs/otro_ingreso/comprobante/"+comprobante).removeClass("disabled");
  } else {
    $("#iddescargar").addClass("disabled");
    $("#ver_completo").addClass("disabled");
  }

  $('.jq_image_zoom').zoom({ on:'grab' }); 

}

//Función para guardar o editar
function guardar_y_editar_valores(e) {
  // e.preventDefault(); //No se activará la acción predeterminada del evento
  var formData = new FormData($("#form-valores")[0]);

  $.ajax({
    url: "../ajax/valores.php?op=guardar_y_editar_valores",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (e) {
      try {
        e = JSON.parse(e);
        if (e.status == true) {

          Swal.fire("Correcto!", "El registro se guardo correctamente.", "success");

          tabla_valores.ajax.reload(null, false);
          $('#modal-agregar-valores').modal('hide'); //
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

function mostrar_valores(idvalores) {

  limpiar_valores();
  
  $("#cargando-1-fomulario").hide();
  $("#cargando-2-fomulario").show();

  $("#modal-agregar-valores").modal("show");

  $.post("../ajax/valores.php?op=mostrar", { idvalores: idvalores }, function (e, status) {
    
    e = JSON.parse(e); console.log('jolll'); console.log(e);    

    $("#idvalores").val(e.data.idvalores).trigger("change");
    $("#nombre").val(e.data.nombre_valor).trigger("change");
    $("#descripcion").val(e.data.descripcion);
    
    if (e.data.icono == "" || e.data.icono == null  ) {

      $("#doc1_ver").html('<img src="../dist/svg/pdf_trasnparent.svg" alt="" width="50%" >');

      $("#doc1_nombre").html('');

      $("#doc_old_1").val(""); $("#doc1").val("");

    } else {

      $("#doc_old_1").val(e.data.icono); 

      $("#doc1_nombre").html(`<div class="row"> <div class="col-md-12"><i>Baucher.${extrae_extencion(e.data.icono)}</i></div></div>`);
      // cargamos la imagen adecuada par el archivo
      $("#doc1_ver").html(doc_view_extencion(e.data.icono,'admin/dist/docs/valores/iconos/', '100%', '210' ));   //ruta imagen    
          
    }
    $('.jq_image_zoom').zoom({ on:'grab' });
     
    
    $("#cargando-1-fomulario").show();
    $("#cargando-2-fomulario").hide();
  }).fail( function(e) { ver_errores(e); } );
}

function ver_datos(idotro_ingreso) {
  $("#modal-ver-otro-ingreso").modal("show");
  $('#datos_otro_ingreso').html(`<div class="row"><div class="col-lg-12 text-center"><i class="fas fa-spinner fa-pulse fa-6x"></i><br/><br/><h4>Cargando...</h4></div></div>`);

  var comprobante=''; var btn_comprobante = '';

  $.post("../ajax/otro_ingreso.php?op=verdatos", { idotro_ingreso: idotro_ingreso }, function (e, status) {
    e = JSON.parse(e);  console.log(e);

    if (e.data.comprobante != '') {
        
      comprobante =  doc_view_extencion(e.data.comprobante, 'admin/dist/docs/otro_ingreso/comprobante/', '100%');
      
      btn_comprobante=`
      <div class="row">
        <div class="col-6"">
          <a type="button" class="btn btn-info btn-block btn-xs" target="_blank" href="../dist/docs/otro_ingreso/comprobante/${e.data.comprobante}"> <i class="fas fa-expand"></i></a>
        </div>
        <div class="col-6"">
          <a type="button" class="btn btn-warning btn-block btn-xs" href="../dist/docs/otro_ingreso/comprobante/${e.data.comprobante}" download="comprobante - ${removeCaracterEspecial(e.data.razon_social)}"> <i class="fas fa-download"></i></a>
        </div>
      </div>`;
    
    } else {

      comprobante='Sin Ficha Técnica';
      btn_comprobante='';

    }

    var ver_datos_html = `                                                                            
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <table class="table table-hover table-bordered">        
            <tbody>
              <tr data-widget="expandable-table" aria-expanded="false">
                <th>Nombres </th>
                <td>${e.data.nombres} <br> <b>${e.data.tipo_documento}:</b> ${e.data.numero_documento} </td>
              </tr>
              <tr data-widget="expandable-table" aria-expanded="false">
                <th>Forma Pago</th>
                <td>${e.data.forma_de_pago}</td>
              </tr>
              <tr data-widget="expandable-table" aria-expanded="false">
                <th>Tipo Comprobante</th>
                <td>${e.data.tipo_comprobante}</td>
              </tr>
              <tr data-widget="expandable-table" aria-expanded="false">
                <th>Núm. Comprobante</th>
                  <td>${e.data.numero_comprobante}</td>
              </tr>
              <tr data-widget="expandable-table" aria-expanded="false">
                <th>Fecha Emisión</th>
                <td>${e.data.fecha_ingreso}</td>
              </tr>
              <tr data-widget="expandable-table" aria-expanded="false">
                <th>Sub total</th>
                <td>${e.data.precio_sin_igv}</td>
              </tr>
              <tr data-widget="expandable-table" aria-expanded="false">
                <th>IGV</th>
                <td>${e.data.precio_igv}</td>
              </tr>
              <tr data-widget="expandable-table" aria-expanded="false">
                <th>Monto total</th>
                <td>${parseFloat(e.data.precio_con_igv).toFixed(2)}</td>
              </tr>
              <tr data-widget="expandable-table" aria-expanded="false">
                <th>Comprobante</th>
                <td> ${comprobante} <br>${btn_comprobante}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>`;

    $("#datos_otro_ingreso").html(ver_datos_html);
  }).fail( function(e) { ver_errores(e); } );
}

//Función para desactivar registros
function eliminar_valores(idvalores) {

  crud_eliminar_papelera(
    "../ajax/valores.php?op=desactivar",
    "../ajax/valores.php?op=eliminar", 
    idvalores, 
    "!Elija una opción¡", 
    `<b class="text-danger"><del>...</del></b> <br> En <b>papelera</b> encontrará este registro! <br> Al <b>eliminar</b> no tendrá acceso a recuperar este registro!`, 
    function(){ sw_success('♻️ Papelera! ♻️', "Tu registro ha sido reciclado." ) }, 
    function(){ sw_success('Eliminado!', 'Tu registro ha sido Eliminado.' ) }, 
    function(){ tabla_valores.ajax.reload(null, false); },
    false, 
    false, 
    false,
    false
  );
}
// :::::::::::::::::::::::::::::::::::::::::::::::::::: S E C C I O N   P R O V E E D O R  ::::::::::::::::::::::::::::::::::::::::::::::::::::
//Función limpiar
function limpiar_valores() {
  $("#idvalores").val("");
  $("#nombre").val("");
  $("#icono").val("");
  $("#duracion").val("");
  
  
  // Limpiamos las validaciones
  $(".form-control").removeClass('is-valid');
  $(".form-control").removeClass('is-invalid');
  $(".error.invalid-feedback").remove();

  $(".tooltip").removeClass("show").addClass("hidde");
}

//guardar proveedor
function guardarpersona(e) {
  // e.preventDefault(); //No se activará la acción predeterminada del evento
  var formData = new FormData($("#form-persona")[0]);

  $.ajax({
    url: "../ajax/otro_ingreso.php?op=guardarpersona",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (e) {
      e = JSON.parse(e);

      try {
        if (e.status == true) {
          // toastr.success("proveedor registrado correctamente");
          Swal.fire("Correcto!", "Persona guardado correctamente.", "success");          
          limpiar_persona();
          $("#modal-agregar-persona").modal("hide");
          //Cargamos los items al select persona
          lista_select2("../ajax/otro_ingreso.php?op=selecct_produc_o_provee", '#idpersona', e.data);
        } else {
          ver_errores(e);
        }
      } catch (err) { console.log('Error: ', err.message); toastr_error("Error temporal!!",'Puede intentalo mas tarde, o comuniquese con:<br> <i><a href="tel:+51921305769" >921-305-769</a></i> ─ <i><a href="tel:+51921487276" >921-487-276</a></i>', 700); }       
      
      $("#guardar_registro_persona").html('Guardar Cambios').removeClass('disabled');
    },
  });
}


// damos formato a: Cta, CCI
function formato_banco() {

  if ($("#banco").select2("val") == null || $("#banco").select2("val") == "" || $("#banco").select2("val") == "1" ) {

    $("#c_bancaria").prop("readonly", true);
    $("#cci").prop("readonly", true);

  } else {
    
    $(".chargue-format-1").html('<i class="fas fa-spinner fa-pulse fa-lg text-danger"></i>');
    $(".chargue-format-2").html('<i class="fas fa-spinner fa-pulse fa-lg text-danger"></i>');
    $(".chargue-format-3").html('<i class="fas fa-spinner fa-pulse fa-lg text-danger"></i>');    

    $.post("../ajax/ajax_general.php?op=formato_banco", { 'idbanco': $("#banco").select2("val") }, function (e, status) {
      
      e = JSON.parse(e);  // console.log(e);

      if (e.status == true) {
        $(".chargue-format-1").html("Cuenta Bancaria");
        $(".chargue-format-2").html("CCI");
        $(".chargue-format-3").html("Cuenta Detracciones");

        $("#c_bancaria").prop("readonly", false);
        $("#cci").prop("readonly", false);

        var format_cta = decifrar_format_banco(e.data.formato_cta);
        var format_cci = decifrar_format_banco(e.data.formato_cci);
        var formato_detracciones = decifrar_format_banco(e.data.formato_detracciones);
        // console.log(format_cta, formato_detracciones);

        $("#c_bancaria").inputmask(`${format_cta}`);
        $("#cci").inputmask(`${format_cci}`);
      } else {
        ver_errores(e);
      }      
    }).fail( function(e) { ver_errores(e); } );
  }
}

// .....::::::::::::::::::::::::::::::::::::: V A L I D A T E   F O R M  :::::::::::::::::::::::::::::::::::::::..
$(function () {   

  


  $("#form-valores").validate({
    ignore: '.select2-input, .select2-focusser',
    rules: {
      nombre:{ required: true, minlength:4, maxlength:100 },
      descripcion: { minlength:4 },
      
    },
    messages: {
      nombre:{ required: "Campo requerido", minlength: "Minimo 3 caracteres", maxlength: "Maximo 100 Caracteres" },
      descripcion: {minlength: "Minimo 4 Caracteres"},
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
      guardar_y_editar_valores(e);
    },

  });


  //agregando la validacion del select  ya que no tiene un atributo name el plugin 
  $("#forma_pago").rules("add", { required: true, messages: { required: "Campo requerido" } });
  $("#tipo_comprobante").rules("add", { required: true, messages: { required: "Campo requerido" } });

  $("#idpersona").rules('add', { required: true, messages: {  required: "Campo requerido" } });
  $("#banco").rules('add', { required: true, messages: {  required: "Campo requerido" } });
  $("#idtipopersona").rules('add', { required: true, messages: {  required: "Campo requerido" } });
  

});

// .....::::::::::::::::::::::::::::::::::::: F U N C I O N E S    A L T E R N A S  :::::::::::::::::::::::::::::::::::::::..

// restringimos la fecha para no elegir mañana
no_select_tomorrow('#fecha_i');

init();

// ver imagen grande de la persona
function ver_img_valor(file, nombre) {
  $('.nombre-valor').html(nombre);
  $(".tooltip").removeClass("show").addClass("hidde");
  $("#modal-ver-imagen-valor").modal("show");
  $('#imagen-valor').html(`<span class="jq_image_zoom"><img class="img-thumbnail" src="${file}" onerror="this.src='../dist/svg/404-v2.svg';" alt="Perfil" width="100%"></span>`);
  $('.jq_image_zoom').zoom({ on:'grab' });
}