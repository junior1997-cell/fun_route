var tabla_paquete;
var miArray = [];
var codigoHTML='';
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

  // ══════════════════════════════════════ G U A R D A R   F O R M ════════════════════════════════════
  $("#guardar_registro_paquete").on("click", function (e) { $("#submit-form-paquete").submit(); });

  // ══════════════════════════════════════ S U M M E R N O T E ══════════════════════════════════════ 
  $('#descripcion').summernote(); $('#incluye').summernote(); $('#no_incluye').summernote();  $('#recomendaciones').summernote();

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
  $("#imagen").val("");

  //OTROS
  $("#incluye").summernote('code', '');
  $("#no_incluye").summernote('code', '');
  $("#recomendaciones").summernote('code', '');
  $("#mapa").val("");

  //itinerario
  // codigoHTML ='';
  // $('.codigoGenerado').remove();
  // eliminar_tours(id);
  $(".alerta").show();
  // COSTOS
  $("#costo").val("");
  $("#porcentaje_descuento").val("");
  $("#monto_descuento").val("");
  
  // Limpiamos las validaciones
  $(".form-control").removeClass('is-valid');
  $(".form-control").removeClass('is-invalid');
  $(".error.invalid-feedback").remove();

  $(".tooltip").removeClass("show").addClass("hidde");
}

function show_hide_form(flag) {
	if (flag == 1)	{	// tabla principal	
		$("#div-tabla-paquete").show();
    $("#div-tabla-galeria").hide();
    $(".btn-regresar").hide();
    $(".btn-agregar-paquete").show();
    $(".btn-agregar-galeria").hide();
    $('#h1-nombre-paquete').html('');
	}	else if (flag == 2)	{// tabla galeria
		$("#div-tabla-paquete").show();
    $("#div-tabla-galeria").hide();
    $(".btn-regresar").show();
    $(".btn-agregar-paquete").hide();
    $(".btn-agregar-galeria").show();
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
    buttons: ["copyHtml5", "excelHtml5", "pdf"],
    ajax: {
      url: "../ajax/paquete.php?op=tbla_principal",
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
          $('#modal-agregar-paquete').modal('hide'); //
          limpiar_paquete();   

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
    $("#cant_dias").val(e.paquete.cant_dias).trigger("change");
    $("#cant_noches").val(e.paquete.cant_noches).trigger("change");
    $("#descripcion").summernote ('code', e.paquete.descripcion);
    
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

    if (e.paquete.estado_descuento == "1") {
      $("#estado_switch").prop("checked", true);
    } else {
      $("#estado_switch").prop("checked", false);
    } 

    if (e.itinerario==null || e.itinerario=="") {
      $(".alerta").show();
    }else{
      $(".alerta").hide();
      
      e.itinerario.forEach(element => {
        
        console.log(element.actividad);
      
        codigoHTML =codigoHTML.concat(`<hr class="tours_${element.idtours}" style="height: 1px; background: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));">
                    <input type="hidden" name="iditinerario[]" id="iditinerario" value="${element.iditinerario}">
                    <input type="hidden" name="idtours[]" id="idtours" value="${element.idtours}">
                    <div class="row tours_${element.idtours}">
                    <div class="col-12 text-center">
                      <span class="text-danger cursor-pointer" aria-hidden="true" data-toggle="tooltip" data-original-title="Eliminar" onclick="eliminar_tours(${element.idtours})" >&times;</span>
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
                    </div>`);
      });
      
    
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
function eliminar_paquete(idpaquete) {

  crud_eliminar_papelera(
    "../ajax/paquete.php?op=desactivar",
    "../ajax/paquete.php?op=eliminar", 
    idpaquete, 
    "!Elija una opción¡", 
    `<b class="text-danger"><del>...</del></b> <br> En <b>papelera</b> encontrará este registro! <br> Al <b>eliminar</b> no tendrá acceso a recuperar este registro!`, 
    function(){ sw_success('♻️ Papelera! ♻️', "Tu registro ha sido reciclado." ) }, 
    function(){ sw_success('Eliminado!', 'Tu registro ha sido Eliminado.' ) }, 
    function(){ tabla_paquete.ajax.reload(null, false); },
    false, 
    false, 
    false,
    false
  );
}
// :::::::::::::::::::::::::::::::::::::::::::::::::::: S E C C I O N  GALERIA  ::::::::::::::::::::::::::::::::::::::::::::::::::::
function entrar_a_galeria(idpaquete, nombre) {// importa el orden

  show_hide_form(2);
  $('#h1-nombre-paquete').html(`- ${nombre}`);
}
//::::::::::::::::::::::::::::::::::::::::::::::::::::::Capturar JQUERRY:::::::::::::::::::::::::::::::::::::::::::::

function ver_actividad(){
  // $("#nombre_tours").val("");
  codigoHTML='';
  var idtours=$("#list_tours").val();

  $.post("../ajax/paquete.php?op=ver_actividad", { idtours: idtours }, function (e, status) {
    
    e = JSON.parse(e); console.log(e); 
    console.log('holaaaa'); 

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

          // console.log(miArray);
        
          codigoHTML = `<hr class="tours_${e.data.idtours}" style="height: 1px; background: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));">
                      <input type="hidden" name="iditinerario[]" id="iditinerario" value="">
                      <input type="hidden" name="idtours[]" id="idtours" value="${e.data.idtours}">
                      <div class="row tours_${e.data.idtours}">
                      <div class="col-12 text-center">
                        <span class="text-danger cursor-pointer" aria-hidden="true" data-toggle="tooltip" data-original-title="Eliminar" onclick="eliminar_tours(${e.data.idtours})" >&times;</span>
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
        
      
        $('.codigoGenerado').append(codigoHTML); // Agregar el contenido al elemento con el ID "codigoGenerado"
        $(`.actividad`).summernote();   
        $('[data-toggle="tooltip"]').tooltip();

      }

    }
    
  }).fail( function(e) { ver_errores(e); } );
  

}

function eliminar_tours(id) {
  $(`.tours_${id}`).remove();

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
    ignore: '.select2-input, .select2-focusser',
    rules: {
      nombre:{ required: true, minlength:4, maxlength:100 },
      cant_dias: { required: true, minlength:2, maxlength:20},
      cant_noches: { required: true, minlength:2, maxlength:20},
      descripcion: { minlength:4 },
      
    },
    messages: {
      nombre:{ required: "Campo requerido", minlength: "Minimo 3 caracteres", maxlength: "Maximo 100 Caracteres" },
      cant_dias: { required: "Campo requerido", min: "Minimo 2 caracteres", max: "Maximo 20 Caracteres" },
      cant_noches: { required: "Campo requerido", min: "Minimo 2 caracteres", max: "Maximo 20 Caracteres" },
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
      guardar_y_editar_paquete(e);
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