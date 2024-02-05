var tabla_noticias;

function init() {
  $("#bloc_empresa").addClass("menu-open");
  $("#bloc_datos_generales").addClass("menu-open bg-color-191f24");
  $("#mempresa").addClass("active");
  $("#lnoticias").addClass("active");

  galeria_noticias();
  $("#guardar_registro_noticia").on("click", function (e) { $("#submit-form-noticia").submit(); });
  $(document).on('click', '[data-toggle="lightbox"]', function(event) { event.preventDefault(); $(this).ekkoLightbox({ alwaysShowClose: true }); }); //ver imagen

}

function galeria_noticias(){
  $('.imagenes_galeria').html(''); 
  $.post("../ajax/noticias_inicio.php?op=galeria_noticia", function (e, status) {
      e = JSON.parse(e);  console.log(e);    
      if (e.status == true) {
        if (e.data === null || e.data.length === 0) {
          $(".g_imagenes").hide(); $(".sin_imagenes").show();
        }else{
          $(".sin_imagenes").hide(); $(".g_imagenes").show();        
          
          e.data.forEach((val, key) => {
            var ver = (val.estado_mostrar == 1) ? "fa-eye" : "fa-eye-slash";
            var visto = (val.estado_mostrar == 1) ? "Visible" : "Oculto";
            var galeria_html = `
                  <div class="col-sm-2 text-center px-1 py-1 b-radio-5px" style=" margin-right: 1cm;" > 
                      <span class="username"><p class="text-primary m-b-02rem" ><b>${val.titulo}</b></p></span>
                      <span class="description">${val.descripcion}</span>
                      <a href="../dist/docs/noticia_inicio/${val.imagen}" data-toggle="lightbox" data-title="${val.titulo}" data-gallery="gallery">
                          <img src="../dist/docs/noticia_inicio/${val.imagen}" width="100%" class="img-fluid mb-2 b-radio-t-5px" alt="white sample" onerror="this.src='../dist/docs/paquete/galeria/sin-foto.jpg';"/>
                      </a>
                      <div style="background-color: #85FFF4; color: black; padding: 5px; border-radius: 5px;">
                          ${visto}
                      </div>

                      <button style="background: none; border: none; margin-right: 1px;" onclick="visible(${val.idnoticias_inicio}, '${val.estado_mostrar}'); " >
                          <i class="fas ${ver} fa-lg" style="color: #6B8BF5;"></i>
                      </button>   

                      <button style="background: none; border: none; margin-right: 1px;" onclick="actualizar(${val.idnoticias_inicio}); " >
                          <i class="fas fa-edit fa-lg" style="color: #FBDB39;"></i>
                      </button>

                      <button style="background: none; border: none; margin-right: 1px;" onclick="eliminar(${val.idnoticias_inicio}, '${val.titulo}'); " >
                          <i class="fas fa-trash-alt fa-lg" style="color: #F5401A"></i>
                      </button> 

                  </div> `;
            $('.imagenes_galeria').append(galeria_html); // Agregar el contenido 
          }); 
        }
        $('.jq_image_zoom').zoom({ on:'grab' });     
        
      } else {
        ver_errores(e);
      }    
    }).fail( function(e) { ver_errores(e); } );
}

// abrimos el navegador de archivos
$("#doc2_i").click(function() {  $('#doc2').trigger('click'); });
$("#doc2").change(function(e) {  addImageApplication(e,$("#doc2").attr("id")) });

function guardar_noticia_inicio(e){
    var formData = new FormData($("#form-noticia")[0]);
    $.ajax({
        url: "../ajax/noticias_inicio.php?op=guardar_noticia",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (e) {
          try {
            e = JSON.parse(e); console.log(e);
            if (e.status == true) {
              Swal.fire("Correcto!", "El registro se guardo correctamente.", "success");         
              $('#modal-agregar-noticia').modal('hide'); //
              limpiar();
              galeria_noticias();
            } else {
              ver_errores(e);
            }
          } catch (err) { console.log('Error: ', err.message); toastr.error('<h5 class="font-size-16px">Error temporal!!</h5> puede intentalo mas tarde, o comuniquese con <i><a href="tel:+51921305769" >921-305-769</a></i> ─ <i><a href="tel:+51921487276" >921-487-276</a></i>'); }      
          $("#guardar_registro_noticia").html('Guardar Cambios').removeClass('disabled');
        },
        xhr: function () {
          var xhr = new window.XMLHttpRequest();
          xhr.upload.addEventListener("progress", function (evt) {
            if (evt.lengthComputable) {
              var percentComplete = (evt.loaded / evt.total)*100;
              /*console.log(percentComplete + '%');*/
              $("#barra_progress_noticia").css({"width": percentComplete+'%'}).text(percentComplete.toFixed(2)+" %");
            }
          }, false);
          return xhr;
        },
        beforeSend: function () {
          $("#guardar_registro_noticia").html('<i class="fas fa-spinner fa-pulse fa-lg"></i>').addClass('disabled');
          $("#barra_progress_noticia").css({ width: "0%",  }).text("0%").addClass('progress-bar-striped progress-bar-animated');
        },
        complete: function () {
          $("#barra_progress_noticia").css({ width: "0%", }).text("0%").removeClass('progress-bar-striped progress-bar-animated');
        },
        error: function (jqXhr) { ver_errores(jqXhr); },
      });
}

function doc2_eliminar() {
	$("#doc2").val("");
	$("#doc2_ver").html('<img src="../dist/img/default/img_defecto.png" alt="" width="50%" >');
	$("#doc2_nombre").html("");
}

function limpiar () {
    $('#titulo').val("");  
    $('#descripcion').val("");  
    $('#idnoticias_inicio').val("");  
  
    $("#doc2").val(""); 
    $("#doc_old_2").val(""); 
    $('#doc2_nombre').html("");
    $('#doc2_ver').html(`<img src="../dist/img/default/img_defecto.png" alt="" width="50%" >`);
  
    // Limpiamos las validaciones
    $(".form-control").removeClass('is-valid');
    $(".form-control").removeClass('is-invalid');
    $(".error.invalid-feedback").remove();
}

function actualizar(id) {

    limpiar();
  
    $("#cargando-3-fomulario").hide();
    $("#cargando-4-fomulario").show();
  
    $("#modal-agregar-noticia").modal("show");
  
    $.post("../ajax/noticias_inicio.php?op=mostrar_editar_noticia", { 'idnoticias_inicio': id }, function (e, status) {
      e = JSON.parse(e);  console.log(e); 
      
      if (e.status == true) {
        $('#idnoticias_inicio').val(e.data.idnoticias_inicio);
        $('#titulo').val(e.data.titulo);    
        $('#descripcion').val(e.data.descripcion);    
  
        if (e.data.imagen != null || e.data.imagen == '' ) {
          $("#doc_old_2").val(e.data.imagen);      
          $('#doc2_ver').html( doc_view_extencion(e.data.imagen, 'admin/dist/docs/noticia_inicio/', '100%' ) );
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

function eliminar(idnoticias_inicio, titulo) {  
    Swal.fire({
      title: "¿Está seguro de que desea eliminar esta imagen?",
      html: `<b><del class="text-danger">${titulo}</del></b> se eliminara`,
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3567dc",
      cancelButtonColor: "#6c757d",
      confirmButtonText: "Sí, Eliminar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.post( "../ajax/noticias_inicio.php?op=eliminar", { idnoticias_inicio: idnoticias_inicio}, function (e) {
          try {
            e = JSON.parse(e);
            if (e.status == true) {
              Swal.fire("Eliminado", "La imagen ha sido eliminado.", "success");             
              galeria_noticias();
            } else {
              ver_errores(e);
            }
          } catch (e) { ver_errores(e); }
        }).fail(function (e) { ver_errores(e); });
      }
    });
  
}

function visible(idnoticias_inicio, estado_mostrar) {
    let mensaje = "";
  
    if (estado_mostrar == 0) {
      mensaje = "La imagen está disponible en la página principal";
    } else if (estado_mostrar == 1) {
      mensaje = "La imagen a sido ocultada";
    }
  
    $.post("../ajax/noticias_inicio.php?op=visible", { idnoticias_inicio: idnoticias_inicio, estado_mostrar: estado_mostrar }, function (e) {
      try {
        e = JSON.parse(e);
        if (e.status == true) {
          Swal.fire({
            title: "Actualizado",
            text: mensaje,
            icon: "success"
          });
          galeria_noticias();
        } else {
          ver_errores(e);
        }
      } catch (e) {
        ver_errores(e);
      }
    }).fail(function (e) {
      ver_errores(e);
    });
}
  
init();

// .....::::::::::::::::::::::::::::::::::::: V A L I D A T E   F O R M  :::::::::::::::::::::::::::::::::::::::..

$("#form-noticia").validate({
    rules: {
      titulo: { required: true, minlength:4 },           
    },
    messages: {
      titulo: {required: "Campo requerido", minlength: "Minimo 4 Caracteres"},
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
      guardar_noticia_inicio(e);
    },

  });