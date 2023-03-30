var tabla; 
//Función que se ejecuta al inicio
function init() {
  $(".mpersona").addClass("active");
  tbla_principal();

  // ══════════════════════════════════════ S E L E C T 2 ══════════════════════════════════════
  lista_select2("../ajax/persona.php?op=cargo_persona", '#cargo_persona', null);
  // lista_select2("../ajax/persona.php?op=cargo_persona", '#banco', null);
  
  // ══════════════════════════════════════ G U A R D A R   F O R M ══════════════════════════════════════
  $("#guardar_registro_persona").on("click", function (e) {  $("#submit-form-persona").submit(); });  

  // ══════════════════════════════════════ INITIALIZE SELECT2 ══════════════════════════════════════
  $("#tipo_documento").select2({theme:"bootstrap4", placeholder: "Selec. tipo Doc.", allowClear: true, });

}

init();


// abrimos el navegador de archivos
$("#foto1_i").click(function() { $('#foto1').trigger('click'); });
$("#foto1").change(function(e) { addImage(e,$("#foto1").attr("id")) });

function foto1_eliminar() {

	$("#foto1").val("");

	$("#foto1_i").attr("src", "../dist/img/default/img_defecto.png");

	$("#foto1_nombre").html("");
}

//Función limpiar
function limpiar_form_persona() {
  
  $("#guardar_registro_persona").html('Guardar Cambios').removeClass('disabled');

  $("#idpersona").val(""); 
  $("#tipo_documento").val("null").trigger("change");
  $("#num_documento").val(""); 
  $("#nombre").val("");
  $("#email").val(""); 
  $("#telefono").val("");
  $("#direccion").val("");

  $("#foto1_i").attr("src", "../dist/img/default/img_defecto.png");
	$("#foto1").val("");
	$("#foto1_actual").val("");  
  $("#foto1_nombre").html(""); 
  
  // Limpiamos las validaciones
  $(".form-control").removeClass('is-valid');
  $(".form-control").removeClass('is-invalid');
  $(".error.invalid-feedback").remove();
}

//Función Listar
function tbla_principal() {
  $(".tabla").hide();
  $(".cargando").show();

  tabla=$('#tabla-persona').dataTable({
    responsive: true,
    lengthMenu: [[ -1, 5, 10, 25, 75, 100, 200,], ["Todos", 5, 10, 25, 75, 100, 200, ]],//mostramos el menú de registros a revisar
    aProcessing: true,//Activamos el procesamiento del datatables
    aServerSide: true,//Paginación y filtrado realizados por el servidor
    dom: '<Bl<f>rtip>',//Definimos los elementos del control de tabla
    buttons: [
      { extend: 'copyHtml5', footer: true, exportOptions: { columns: [4,5,6,7,8,3], } }, 
      { extend: 'excelHtml5', footer: true, exportOptions: { columns: [4,5,6,7,8,3], } }, 
      { extend: 'pdfHtml5', footer: false, orientation: 'landscape', pageSize: 'LEGAL', exportOptions: { columns: [4,5,6,7,8,3], } }, {extend: "colvis"} ,
    ],
    ajax:{
      url: `../ajax/persona.php?op=tbla_principal`,
      type : "get",
      dataType : "json",						
      error: function(e){
        console.log(e.responseText);  ver_errores(e);
      }
    },
    createdRow: function (row, data, ixdex) {
      // columna: #
      if (data[0] != '') { $("td", row).eq(0).addClass('text-center'); } 
      // columna: 1
      if (data[1] != '') { $("td", row).eq(1).addClass('text-nowrap'); }
    },
    language: {
      lengthMenu: "Mostrar: _MENU_ registros",
      buttons: { copyTitle: "Tabla Copiada", copySuccess: { _: "%d líneas copiadas", 1: "1 línea copiada", }, },
      sLoadingRecords: '<i class="fas fa-spinner fa-pulse fa-lg"></i> Cargando datos...'
    },
    bDestroy: true,
    iDisplayLength: 10,//Paginación
    order: [[ 0, "asc" ]],//Ordenar (columna,orden)
    columnDefs: [
      { targets: [4,5,6,7,8], visible: false, searchable: false, }, 
    ],
  }).DataTable();

  $(".tabla").show();
  $(".cargando").hide();

}

//Función para guardar o editar
function guardar_y_editar_persona(e) {
  // e.preventDefault(); //No se activará la acción predeterminada del evento
  var formData = new FormData($("#form-persona")[0]);

  $.ajax({
    url: "../ajax/persona.php?op=guardaryeditar",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (e) {
      try {
        e = JSON.parse(e);  //console.log(e); 
        if (e.status == true) {	
          Swal.fire("Correcto!", "persona guardado correctamente", "success");
          tabla.ajax.reload(null, false);          
          limpiar_form_persona();
          $("#modal-agregar-persona").modal("hide"); 
          
        }else{
          ver_errores(e);
        }
      } catch (err) { console.log('Error: ', err.message); toastr_error("Error temporal!!",'Puede intentalo mas tarde, o comuniquese con:<br> <i><a href="tel:+51921305769" >921-305-769</a></i> ─ <i><a href="tel:+51921487276" >921-487-276</a></i>', 700); }      

      $("#guardar_registro_persona").html('Guardar Cambios').removeClass('disabled');
    },
    xhr: function () {
      var xhr = new window.XMLHttpRequest();
      xhr.upload.addEventListener("progress", function (evt) {
        if (evt.lengthComputable) {
          var percentComplete = (evt.loaded / evt.total)*100;
          /*console.log(percentComplete + '%');*/
          $("#barra_progress").css({"width": percentComplete+'%'});
          $("#barra_progress").text(percentComplete.toFixed(2)+" %");
        }
      }, false);
      return xhr;
    },
    beforeSend: function () {
      $("#guardar_registro_persona").html('<i class="fas fa-spinner fa-pulse fa-lg"></i>').addClass('disabled');
      $("#barra_progress").css({ width: "0%",  });
      $("#barra_progress").text("0%");
    },
    complete: function () {
      $("#barra_progress").css({ width: "0%", });
      $("#barra_progress").text("0%");
    },
    error: function (jqXhr) { ver_errores(jqXhr); },
  });
}

// ver detallles del registro
function verdatos(idpersona){

  $(".tooltip").removeClass("show").addClass("hidde");

  $('#datospersona').html(''+
  '<div class="row" >'+
    '<div class="col-lg-12 text-center">'+
      '<i class="fas fa-spinner fa-pulse fa-6x"></i><br />'+
      '<br />'+
      '<h4>Cargando...</h4>'+
    '</div>'+
  '</div>');

  var verdatos=''; 

  var imagen_perfil =''; btn_imagen_perfil=''; 

  $("#modal-ver-persona").modal("show")

  $.post("../ajax/persona.php?op=verdatos", { idpersona: idpersona }, function (e, status) {

    e = JSON.parse(e);  //console.log(e); 
    
    if (e.status == true) {
      
    
      if (e.data.imagen_perfil != '') {

        imagen_perfil=`<img src="../dist/docs/persona/perfil/${e.data.imagen_perfil}" alt="" class="img-thumbnail w-130px">`
        
        btn_imagen_perfil=`
        <div class="row">
          <div class="col-6"">
            <a type="button" class="btn btn-info btn-block btn-xs" target="_blank" href="../dist/docs/persona/perfil/${e.data.imagen_perfil}"> <i class="fas fa-expand"></i></a>
          </div>
          <div class="col-6"">
            <a type="button" class="btn btn-warning btn-block btn-xs" href="../dist/docs/persona/perfil/${e.data.imagen_perfil}" download="PERFIL ${e.data.nombres}"> <i class="fas fa-download"></i></a>
          </div>
        </div>`;
      
      } else {
        imagen_perfil='No hay imagen';
        btn_imagen_perfil='';
      }

      verdatos=`                                                                            
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <table class="table table-hover table-bordered">        
              <tbody>
                <tr data-widget="expandable-table" aria-expanded="false">
                  <th rowspan="2" class="text-center">${imagen_perfil}<br>${btn_imagen_perfil} </th>
                  <td> <b>Nombre: </b>${e.data.nombres}</td>
                </tr>
                <tr data-widget="expandable-table" aria-expanded="false">
                  <td> <b>DNI: </b>${e.data.numero_documento}</td>
                </tr>
                <tr data-widget="expandable-table" aria-expanded="false">
                  <th>Dirección</th>
                  <td>${e.data.direccion}</td>
                </tr>
                <tr data-widget="expandable-table" aria-expanded="false">
                  <th>Correo</th>
                  <td>${e.data.email}</td>
                </tr>
                <tr data-widget="expandable-table" aria-expanded="false">
                  <th>Teléfono</th>
                  <td>${e.data.telefono}</td>
                </tr>
                <tr data-widget="expandable-table" aria-expanded="false">
                  <th>Fecha Nac.</th>
                  <td>${e.data.fecha_nacimiento}</td>
                </tr>
                
                <tr data-widget="expandable-table" aria-expanded="false">
                  <th>Titular cuenta </th>
                  <td>${e.data.titular_cuenta}</td>
                </tr>
                <tr data-widget="expandable-table" aria-expanded="false">
                  <th>Banco </th>
                  <td>${e.data.banco}</td>
                </tr>
                <tr data-widget="expandable-table" aria-expanded="false">
                  <th>Cuenta bancaria </th>
                  <td>${e.data.cuenta_bancaria}</td>
                </tr>
                <tr data-widget="expandable-table" aria-expanded="false">
                  <th>cci </th>
                  <td>${e.data.cci}</td>
                </tr>
                <tr data-widget="expandable-table" aria-expanded="false">
                  <th>Sueldo mensual </th>
                  <td>${e.data.sueldo_mensual}</td>
                </tr>
                <tr data-widget="expandable-table" aria-expanded="false">
                  <th>Sueldo diario </th>
                  <td>${e.data.sueldo_diario}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>`;
    
      $("#datospersona").html(verdatos);

    } else {
      ver_errores(e);
    }

  }).fail( function(e) { ver_errores(e); } );
}

// mostramos los datos para editar
function mostrar(idpersona) {
  $(".tooltip").removeClass("show").addClass("hidde");
  limpiar_form_persona();  

  $("#cargando-1-fomulario").hide();
  $("#cargando-2-fomulario").show();

  $("#modal-agregar-persona").modal("show")

  $.post("../ajax/persona.php?op=mostrar", { idpersona: idpersona }, function (e, status) {

    e = JSON.parse(e);  console.log(e);   

    if (e.status == true) {       

      $("#tipo_documento").val(e.data.tipo_documento).trigger("change");
      $("#nombre").val(e.data.nombre_persona);
      $("#num_documento").val(e.data.numero_documento);
      $("#direccion").val(e.data.direccion);
      $("#telefono").val(e.data.celular);
      $("#email").val(e.data.correo);
      $("#idpersona").val(e.data.idpersona);
    
      $("#cargo_persona").val(e.data.idcargo_persona).trigger("change"); 


      if (e.data.foto_perfil!="") {
        $("#foto1_i").attr("src", "../dist/img/persona/perfil/" + e.data.foto_perfil);
        $("#foto1_actual").val(e.data.foto_perfil);
      }


      $("#cargando-1-fomulario").show();
      $("#cargando-2-fomulario").hide();

    } else {
      ver_errores(e);
    }    
  }).fail( function(e) { ver_errores(e); } );
}

//Función para desactivar registros
function eliminar_persona(idpersona, nombre) {

  crud_eliminar_papelera(
    "../ajax/persona.php?op=desactivar",
    "../ajax/persona.php?op=eliminar", 
    idpersona, 
    "!Elija una opción¡", 
    `<b class="text-danger"><del>${nombre}</del></b> <br> En <b>papelera</b> encontrará este registro! <br> Al <b>eliminar</b> no tendrá acceso a recuperar este registro!`, 
    function(){ sw_success('♻️ Papelera! ♻️', "Tu registro ha sido reciclado." ) }, 
    function(){ sw_success('Eliminado!', 'Tu registro ha sido Eliminado.' ) }, 
    function(){ tabla.ajax.reload(null, false); },
    false, 
    false, 
    false,
    false
  );
 
}

// .....::::::::::::::::::::::::::::::::::::: V A L I D A T E   F O R M  :::::::::::::::::::::::::::::::::::::::..

$(function () {   

  $("#tipo_documento").on('change', function() { $(this).trigger('blur'); });
  $("#cargo_persona").on('change', function() { $(this).trigger('blur'); });

  $("#form-persona").validate({
    rules: {
      tipo_documento: { required: true },
      num_documento:  { required: true, minlength: 6, maxlength: 20 },
      nombre:         { required: true, minlength: 6, maxlength: 100 },
      email:          { email: true, minlength: 10, maxlength: 50 },
      direccion:      { minlength: 5, maxlength: 70 },
      telefono:       { minlength: 8 },
      cargo_persona:  { required: true },

    },
    messages: {
      tipo_documento: { required: "Campo requerido.", },
      num_documento:  { required: "Campo requerido.", minlength: "MÍNIMO 6 caracteres.", maxlength: "MÁXIMO 20 caracteres.", },
      nombre:         { required: "Campo requerido.", minlength: "MÍNIMO 6 caracteres.", maxlength: "MÁXIMO 100 caracteres.", },
      email:          { required: "Campo requerido.", email: "Ingrese un coreo electronico válido.", minlength: "MÍNIMO 10 caracteres.", maxlength: "MÁXIMO 50 caracteres.", },
      direccion:      { minlength: "MÍNIMO 5 caracteres.", maxlength: "MÁXIMO 70 caracteres.", },
      telefono:       { minlength: "MÍNIMO 8 caracteres.", },
      cargo_persona:  { required: "Campo requerido.", },
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
      $(".modal-body").animate({ scrollTop: $(document).height() }, 600); // Scrollea hasta abajo de la página
      guardar_y_editar_persona(e);
    },
  });

  $("#tipo_documento").rules('add', { required: true, messages: {  required: "Campo requerido" } });
  $("#cargo_persona").rules('add', { required: true, messages: {  required: "Campo requerido" } });
});

