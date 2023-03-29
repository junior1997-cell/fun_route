var tabla;
var tabla_fases;
//Función que se ejecuta al inicio
function init() {

  $(".mproyectos").addClass("active");

  listar();  

  //Mostramos los proyecto
  $.post("../ajax/proyecto.php?op=select2_proyecto", function (r) { 
    $("#id_pryecto_adm").html(r); 
    $(".cargando_").html('Proyecto <sup class="text-danger">*</sup>');
    $("#id_pryecto_adm").val('null').trigger("change");
  });

  $("#guardar_registro").on("click", function (e) {$("#submit-form-proyecto").submit();});

  $("#form-imagen-proyect").on("submit", function (e) { guardaryeditar_imagen(e) });

  $("#guardar_registro_fase").on("click", function (e) {$("#submit-form-proyecto-fase").submit();});

  mostrar_section(1);
}
//comprobante - perfil proyecto
$("#doc1_i").click(function () {  $("#doc1").trigger("click"); });
$("#doc1").change(function (e) { addImageApplication(e, $("#doc1").attr("id"),'', '100%', '320'); });

//ficha tecnica - imagen
$("#doc2_i").click(function() {  $('#doc2').trigger('click'); });
$("#doc2").change(function(e) {  addImageApplication(e,$("#doc2").attr("id")) });

// Eliminamos el perfil proyecto
function doc1_eliminar() {
  $("#doc1").val("");
  $("#doc_old_1").val("");
  $("#doc1_ver").html('<img src="../dist/svg/doc_uploads.svg" alt="" width="50%" >');
  $("#doc1_nombre").html("");
}

// Eliminamos el doc imagen
function doc2_eliminar() {
  $("#doc2").val("");
  $("#doc_old_2").val("");
  $("#doc2_ver").html('<img src="../dist/svg/drag-n-drop.svg" alt="" width="50%" >');
  $("#doc2_nombre").html("");
}


//Función limpiar
function limpiar() {

  $("#idproyecto").val("");
  $("#id_pryecto_adm").val('null').trigger("change");
  $("#nombre").val("");
  $("#descripcion").val(""); 

  $.post("../ajax/proyecto.php?op=select2_proyecto", function (r) { 
    $("#id_pryecto_adm").html(r); 
    $(".cargando_").html('Proyecto <sup class="text-danger">*</sup>');
    $("#id_pryecto_adm").val('null').trigger("change");
  });

  $("#doc_old_1").val("");
  $("#doc1").val("");  
  $('#doc1_ver').html(`<img src="../dist/svg/drag-n-drop.svg" alt="" width="50%" >`);
  $('#doc1_nombre').html("");

  // Limpiamos las validaciones
  $(".form-control").removeClass('is-valid');
  $(".form-control").removeClass('is-invalid');
  $(".error.invalid-feedback").remove();

}

function mostrar_select(estado) {

  if (estado==1) {
    $(".selectt").show();
    $(".edith").hide();
    $(".selec_proyecto_adm").hide();
    $(".selec_proyecto_adm").hide();
  }

  if (estado==2) {
    $(".selectt").hide();    
    $(".edith").show();
    $(".selec_proyecto_adm").show();
    $(".id_pryecto_adm_edith").show();
  }
  
}

function mostrar_section(estado) {

  if (estado==1) {

    $(".tabla").show();
    $(".botones_galeria").hide();
    $(".btn_add_proyect").show();
    $(".botones_fases").hide();
    
    $(".galeria").hide();
    $("#l_galeria").html("");
    $(".fases_proyecto").hide();
  }

  if (estado==2) {

    $(".tabla").hide();
    $(".botones_galeria").show();
    $(".btn_add_proyect").hide();
    $(".botones_fases").hide();
    
    $(".galeria").show();
    $(".fases_proyecto").hide();
  }

  if (estado==3) {

    $(".tabla").hide();
    $(".botones_galeria").hide();
    $(".btn_add_proyect").hide();
    $(".galeria").hide();

    $(".botones_fases").show();
    $(".fases_proyecto").show();
    
  }

}

//------------------------------------------------------------------------
//-----------------------P R O Y E C T O ---------------------------------
//------------------------------------------------------------------------

function listar() {

  $(".tabla").hide(); $(".cargando").show();

  tabla=$('#tabla-proyecto').dataTable({

    "responsive": true,
    lengthMenu: [[ -1, 5, 10, 25, 75, 100, 200,], ["Todos", 5, 10, 25, 75, 100, 200, ]],
    "aProcessing": true,
    "aServerSide": true,
    dom: '<Bl<f>rtip>',
    buttons: ['excelHtml5','pdf'],
    "ajax":{
        url: '../ajax/proyecto.php?op=listar',
        type : "get",
        dataType : "json",						
        error: function(e){
          console.log(e.responseText);	
        }
      },
    "language": {
      "lengthMenu": "Mostrar: _MENU_ registros",
      "buttons": {
        "copyTitle": "Tabla Copiada",
        "copySuccess": {
          _: '%d líneas copiadas',
          1: '1 línea copiada'
        }
      },
      sLoadingRecords: '<i class="fas fa-spinner fa-pulse fa-lg"></i> Cargando datos...'
    },
    "bDestroy": true,
    "iDisplayLength": 5,//Paginación
    "order": [[ 0, "asc" ]]//Ordenar (columna,orden)

  }).DataTable();
    
  $(".tabla").show(); $(".cargando").hide();

}

function ver_img_perfil(img_perfil,nombre_proyecto){

  $('#modal-ver-imagen').modal("show");
  $('#nombre_proyecto').html(nombre_proyecto);

  if (img_perfil == "" || img_perfil == null  ) {

   $(".img_modal_xl_").html(`<img class="rounded-lg" src="../dist/svg/drag-n-drop.svg" style="width: 100%;"  alt="Image Description"></img>`)
 
  }else{
    
   $(".img_modal_xl_").html(`<img class="rounded-lg" src="../dist/img/proyecto/imagen_perfil/${img_perfil}" style="width: 100%;"  alt="Image Description"></img>`)

  }

}

function guardaryeditar(e) { 

  var formData = new FormData($("#form-proyecto")[0]);
  $.ajax({
    url: "../ajax/proyecto.php?op=guardaryeditar",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (e) {             

      try {
        e = JSON.parse(e);  console.log(e); 
  
        if (e.status == true) {
  
          toastr.success('Registrado correctamente');

          tabla.ajax.reload();  

          limpiar();

          $("#modal-agregar-proyecto").modal("hide");  
  
        }else{  
  
          ver_errores(e);
        } 
  
        $("#guardar_registro_fase").html('Guardar Cambios').removeClass('disabled');
  
      } catch (err) {
        console.log('Error: ', err.message); toastr.error('<h5 class="font-size-16px">Error temporal!!</h5> puede intentalo mas tarde, o comuniquese con <i><a href="tel:+51921305769" >921-305-769</a></i> ─ <i><a href="tel:+51921487276" >921-487-276</a></i>');
      } 

      $("#guardar_registro").html('Guardar Cambios').removeClass('disabled');

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
      $("#guardar_registro").html('<i class="fas fa-spinner fa-pulse fa-lg"></i>').addClass('disabled');
      $("#barra_progress").css({ width: "0%",  });
      $("#barra_progress").text("0%").addClass('progress-bar-striped progress-bar-animated');
    },
    complete: function () {
      $("#barra_progress").css({ width: "0%", });
      $("#barra_progress").text("0%").removeClass('progress-bar-striped progress-bar-animated');
    },
    error: function (jqXhr) { ver_errores(jqXhr); },
  });
}

function mostrar(idproyecto) {

  limpiar();
  mostrar_select(2);
  $("#modal-agregar-proyecto").modal("show");
  //$("#proveedor").val("").trigger("change"); 
  $("#cargando-1-fomulario").hide();
  $("#cargando-2-fomulario").show();

  $.post("../ajax/proyecto.php?op=mostrar_valor", { idproyecto: idproyecto }, function (e, status) {

    e = JSON.parse(e);  console.log(e);  
    if (e.status) {
      $("#idproyecto").val(e.data.idproyecto);
      $("#nombre").val(e.data.nombre_valor);
      $("#descripcion").val(e.data.descripcion);
      $(".selec_proyecto_adm").val(e.data.codigo_proyecto);
      $("#id_pryecto_adm_edith").val(e.data.id_proyecto_admin);

      if (e.data.img_perfil == "" || e.data.img_perfil == null  ) {

        $("#doc1_ver").html('<img src="../dist/svg/doc_uploads.svg" alt="" width="50%" >');
        $("#doc1_nombre").html('');
        $("#doc_old_1").val(""); $("#doc1").val("");

      } else {

        $("#doc_old_1").val(e.data.img_perfil); 
        $("#doc1_nombre").html(`<div class="row"> <div class="col-md-12"><i>Imagen.${extrae_extencion(e.data.img_perfil)}</i></div></div>`);
        // cargamos la img_perfil adecuada par el archivo
        $("#doc1_ver").html(doc_view_extencion(e.data.img_perfil, 'proyecto', 'imagen_perfil', '100%'));        
      }  

      $("#cargando-1-fomulario").show();
      $("#cargando-2-fomulario").hide();
    } else {
      ver_errores(e);
    } 
  }).fail( function(e) { console.log(e); ver_errores(e); } );
}

function eliminar(idproyecto) {
  Swal.fire({
    title: "¿Está Seguro de  Eliminar el registro?",
    text: "",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#28a745",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Eliminar!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post("../ajax/proyecto.php?op=eliminar", { idproyecto: idproyecto }, function (e) {

        Swal.fire("Eliminado!", "Tu registro ha sido Eliminado.", "success");
    
        tabla.ajax.reload();
        total();
      });      
    }
  });   
}

//------------------------------------------------------------------------
//-----------------------G A L E R I A------------------------------------
//------------------------------------------------------------------------

function limpiar_galeria() {

  $("#idgaleria_proyecto").val("");

  $("#doc_old_2").val("");
  $("#doc2").val("");  
  $('#doc2_ver').html(`<img src="../dist/svg/drag-n-drop.svg" alt="" width="50%" >`);
  $('#doc2_nombre').html("");

}

function galeria(idproyecto) { 

  $("#idproyecto_img").val(idproyecto); 

  localStorage.setItem('idproyecto_img',idproyecto);
  $("#g_cargando").html('<p><i class="fas fa-spinner fa-pulse fa-1x"></i> <h4>Cargando...</h4></p>');
  mostrar_section(2);

  //Mostramos los proyectos
  $.post('../ajax/proyecto.php?op=select2_fases&idproyecto='+idproyecto, function (r) { 
    $("#id_fase_select").html(r); 
    $(".cargando_select").html('Fase <sup class="text-danger">*</sup>');
    $("#id_fase_select").val('null').trigger("change");
  });

  $.post("../ajax/proyecto.php?op=listar_galeria", {idproyecto:idproyecto }, function (e, status) {

    $("#l_galeria").html("");

    e = JSON.parse(e); console.log(e); 
    imagen=""; mostrar_img="";
    if (e.status == true) {

      if (e.data.length == 0) {

        $("#g_cargando").html(`<div class="col-lg-12">
        <div class="cbp-item product">
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Ninguna imagen por mostrar!</strong> puede registar una en el boton   <strong> 
            <button type="button" class="btn btn-primary btn-xs" style="cursor: no-drop;"><i class="fas fa-plus-circle"></i> Agregar</button></strong> en la parte superior.
          </div>
        </div>
      </div>`);

      } else {

        $.each(e.data, function (index, value) {

          if (value.imagen!=null || value.imagen!="") { imagen='../dist/img/proyecto/img_galeria/'+value.imagen; } else { imagen='../dist/svg/drag-n-drop.svg'; }

            var l_galeria = ` <div class="col-lg-4">
                                <div class="cbp-item product">
                                    <div class="overflow-hidden rounded-lg">
                                      <div class="cbp-caption-defaultWrap geeks">
                                        <a onclick="modal_xl('${value.imagen}')">
                                          <img class="rounded-lg" src="${imagen}" style="width: 90%;" onerror="this.src='../dist/svg/drag-n-drop.svg';" alt="Image Description">
                                        </a>
                                      </div>
                                      <div class="text-center font-size-11px">
                                      <span style="font-weight: bold;">${value.fase} : </span> <i>${value.nombre_imagen}</i> 
                                      </div>
                                    </div>
                                    <div class="card-footer">
                                      <ul class="list-inline list-separator small text-body">
                                        <li class="list-inline-item" > 
                                          <a style="cursor: pointer; font-size: 13px;" onclick="editar_imagen(${value.idgaleria_proyecto},${value.idfase_proyecto},'${value.imagen}','${value.nombre_imagen}')"> 
                                            <span class="badge badge-soft-warning mr-2"  style="font-size: 13px;"> Editar</span> 
                                          </a>
                                        </li>
                                        <li class="list-inline-item">
                                          <a style="cursor: pointer; font-size: 13px;" onclick="eliminar_imagen(${value.idgaleria_proyecto})"> 
                                              <span class="badge badge-soft-danger mr-2"  style="font-size: 13px;"> Eliminar</span> 
                                          </a>
                                        </li>
                                      </ul>
                                    </div>
                                </div>
                              </div>`;

            $("#l_galeria").append(l_galeria);
            
        });

        $("#g_cargando").html("");

      }
    } else {
      ver_errores(e);
    }   

  }).fail( function(e) { console.log(e); ver_errores(e); } );

}

function guardaryeditar_imagen(e) {
  e.preventDefault(); //No se activará la acción predeterminada del evento
  var formData = new FormData($("#form-imagen-proyect")[0]);

  $.ajax({
    url: "../ajax/proyecto.php?op=guardaryeditar_imagen",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (e) {
      
      try {
        e = JSON.parse(e);  console.log(e); 
  
        if (e.status == true) {

          Swal.fire("Correcto!", "Datos actualizados correctamente", "success");

          galeria(localStorage.getItem('idproyecto_img'));

          $("#modal-agregar-imagen").modal("hide");
  
        }else{  
  
          ver_errores(e);
        } 
  
        $("#guardar_registro_fase").html('Guardar Cambios').removeClass('disabled');
  
      } catch (err) {
        console.log('Error: ', err.message); toastr.error('<h5 class="font-size-16px">Error temporal!!</h5> puede intentalo mas tarde, o comuniquese con <i><a href="tel:+51921305769" >921-305-769</a></i> ─ <i><a href="tel:+51921487276" >921-487-276</a></i>');
      } 

      $("#submit-form-imagen-proyect").html('Guardar Cambios').removeClass('disabled');
    },
    xhr: function () {
      var xhr = new window.XMLHttpRequest();
      xhr.upload.addEventListener("progress", function (evt) {
        if (evt.lengthComputable) {
          var percentComplete = (evt.loaded / evt.total)*100;
          /*console.log(percentComplete + '%');*/
          $("#barra_progress_galeria").css({"width": percentComplete+'%'});
          $("#barra_progress_galeria").text(percentComplete.toFixed(2)+" %");
        }
      }, false);
      return xhr;
    },
    beforeSend: function () {
      $("#submit-form-imagen-proyect").html('<i class="fas fa-spinner fa-pulse fa-lg"></i>').addClass('disabled');
      $("#barra_progress_galeria").css({ width: "0%",  });
      $("#barra_progress_galeria").text("0%").addClass('progress-bar-striped progress-bar-animated');
    },
    complete: function () {
      $("#barra_progress_galeria").css({ width: "0%", });
      $("#barra_progress_galeria").text("0%").removeClass('progress-bar-striped progress-bar-animated');
    },
    error: function (jqXhr) { ver_errores(jqXhr); },
  });
}

function editar_imagen(idgaleria_proyecto,idfase_proyecto,imagen,nombre_imagen) {

    limpiar_galeria();
    
    $("#modal-agregar-imagen").modal("show");
    $("#id_fase_select").val("").trigger("change"); 
    
    $("#cargando-3-fomulario").hide();
    $("#cargando-4-fomulario").show();

    $("#id_fase_select").val(idfase_proyecto).trigger("change"); 

    $("#idgaleria_proyecto").val(idgaleria_proyecto);
    $("#nombre_img").val(nombre_imagen);

    if (imagen == "" || imagen == null  ) {

      $("#doc2_ver").html('<img src="../dist/svg/doc_uploads.svg" alt="" width="50%" >');
      $("#doc2_nombre").html('');
      $("#doc_old_2").val(""); $("#doc2").val("");

    } else {

      $("#doc_old_2").val(imagen); 
      $("#doc2_nombre").html(`<div class="row"> <div class="col-md-12"><i>Imagen.${extrae_extencion(imagen)}</i></div></div>`);
      // cargamos la imagen adecuada par el archivo
      $("#doc2_ver").html(doc_view_extencion(imagen, 'proyecto', 'img_galeria', '100%'));        
    }  

    $("#cargando-3-fomulario").show();
    $("#cargando-4-fomulario").hide();
}

function eliminar_imagen(idgaleria_proyecto) {
  Swal.fire({
    title: "¿Está Seguro de  Eliminar el registro?",
    text: "",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#28a745",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Eliminar!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post("../ajax/proyecto.php?op=eliminar_galeria", { idgaleria_proyecto: idgaleria_proyecto }, function (e) {

        Swal.fire("Eliminado!", "Tu registro ha sido Eliminado.", "success");
        galeria(localStorage.getItem('idproyecto_img'));
      });      
    }
  });   
}

function modal_xl(imagen) {
  //console.log(imagen);
  $("#modal_xl").modal("show");
  
  if (imagen == "" || imagen == null  ) {

    $(".img_modal_xl_").html(`<img class="rounded-lg" src="../dist/svg/drag-n-drop.svg" style="width: 100%;"  alt="Image Description"></img>`)
  
   }else{

    $(".img_modal_xl").html(`<img class="rounded-lg" src="../dist/img/proyecto/img_galeria/${imagen}" style="width: 100%;"  alt="Image Description"></img>`)
 
   }

}

//--------------------------------------------------------------------------
//-----------------------F A S E S -----------------------------------------
//--------------------------------------------------------------------------
    
function limpiar_fase(){

  $("idfase").val("");
  $("n_fase").val("");
  $("nombre_fase").val("");

}

function fases_proyecto(idproyecto) {
  mostrar_section(3);
  $("#idproyecto_fase").val(idproyecto)
  
  //$("#f_cargando").html(' <p><i class="fas fa-spinner fa-pulse fa-1x"></i> <h4>Cargando...</h4></p>');

  tabla_fases=$('#tabla-fases').dataTable({
    "responsive": true,
    lengthMenu: [[ -1, 5, 10, 25, 75, 100, 200,], ["Todos", 5, 10, 25, 75, 100, 200, ]],//mostramos el menú de registros a revisar
    "aProcessing": true,//Activamos el procesamiento del datatables
    "aServerSide": true,//Paginación y filtrado realizados por el servidor
    dom: '<Bl<f>rtip>',//Definimos los elementos del control de tabla
    buttons: ['excelHtml5','pdf'],
    "ajax":{
        url: '../ajax/proyecto.php?op=listar_fase&idproyecto='+idproyecto,
        type : "get",
        dataType : "json",						
        error: function(e){
          console.log(e.responseText);	
        }
      },
    "language": {
      "lengthMenu": "Mostrar: _MENU_ registros",
      "buttons": {
        "copyTitle": "Tabla Copiada",
        "copySuccess": {
          _: '%d líneas copiadas',
          1: '1 línea copiada'
        }
      }
    },
    "bDestroy": true,
    "iDisplayLength": 5,//Paginación
    "order": [[ 0, "asc" ]]//Ordenar (columna,orden)
  }).DataTable();
}

function guardaryeditar_fase(e) {
  //e.preventDefault(); //No se activará la acción predeterminada del evento
  var formData = new FormData($("#form-fase")[0]);

  $.ajax({
    url: "../ajax/proyecto.php?op=guardaryeditar_fase",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,

    success: function (e) {

      try {
        e = JSON.parse(e);  console.log(e); 
  
        if (e.status == true) {
  
          Swal.fire("Correcto!", "Datos actualizados correctamente", "success");

          $("#modal-agregar-fase").modal("hide");

          tabla_fases.ajax.reload();
  
        }else{  
  
          ver_errores(e);
        } 
  
        $("#guardar_registro_fase").html('Guardar Cambios').removeClass('disabled');
  
      } catch (err) {
        console.log('Error: ', err.message); toastr.error('<h5 class="font-size-16px">Error temporal!!</h5> puede intentalo mas tarde, o comuniquese con <i><a href="tel:+51921305769" >921-305-769</a></i> ─ <i><a href="tel:+51921487276" >921-487-276</a></i>');
      } 


    },
    beforeSend: function () {
      $("#guardar_registro_fase").html('<i class="fas fa-spinner fa-pulse fa-lg"></i>').addClass('disabled');
    },

  });
  
}

function mostrar_fase(idfase_proyecto) {

  limpiar_fase();
  mostrar_select(3);

  $("#modal-agregar-fase").modal("show");

  $("#cargando-5-fomulario").hide();
  $("#cargando-6-fomulario").show();

  $.post("../ajax/proyecto.php?op=mostrar_fase", { idfase: idfase_proyecto }, function (e, status) {

    e = JSON.parse(e);  console.log(e);  
    if (e.status) {

      $("#idfase").val(e.data.idfase_proyecto);
      $("#idproyecto_fase").val(e.data.idproyecto);
      $("#n_fase").val(e.data.numero_fase);
      $("#nombre_f").val(e.data.nombre);

      $("#cargando-5-fomulario").show();
      $("#cargando-6-fomulario").hide();

    } else {
      ver_errores(e);
    } 

  }).fail( function(e) { console.log(e); ver_errores(e); } );
  
}

//Función para eliminar registros
function eliminar_fase(idfase_proyecto) {
  Swal.fire({
    title: "¿Está Seguro de  Eliminar el registro?",
    text: "",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#28a745",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Eliminar!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post("../ajax/proyecto.php?op=eliminar_fase", { idfase: idfase_proyecto }, function (e) {

        Swal.fire("Eliminado!", "Tu registro ha sido Eliminado.", "success");
    
        tabla_fases.ajax.reload();
      });      
    }
  });   
}


init();

$(function () {

  $("#form-proyecto").validate({
    ignore: '.select2-input, .select2-focusser',
    rules: {
      nombre:{required: true},
      descripcion:{required: true}, 
      // terms: { required: true },
    },
    messages: {
      nombre: { required: "Campo requerido", },
      descripcion: { required: "Campo requerido", }, 
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
      guardaryeditar(e);      
    },
  });
   
  $("#form-fase").validate({
    rules: {
      n_fase:{required: true},
      nombre_f:{required: true},
      // terms: { required: true },
    },
    messages: {
      n_fase: { required: "Campo requerido", },
      nombre_f: { required: "Campo requerido", },
    },
        
    errorElement: "span",

    errorPlacement: function (error, element) {
      error.addClass("invalid-feedback");
      element.closest(".form-group").append(error);    },

    highlight: function (element, errorClass, validClass) {
      $(element).addClass("is-invalid").removeClass("is-valid");
    },

    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass("is-invalid").addClass("is-valid");   
    },
    submitHandler: function (e) { 
      $(".modal-body").animate({ scrollTop: $(document).height() }, 600); // Scrollea hasta abajo de la página
      guardaryeditar_fase(e);
    },
  });

});

function extrae_extencion(filename) {
    return filename.split('.').pop();
  }





