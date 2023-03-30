var id_get = varaibles_get();
var id =id_get.id;
//Función que se ejecuta al inicio
$(document).on("ready", function () {

  $(`.mdatos_generales${id_get.id}`).addClass("active");

  $("#actualizar_registro").on("click", function (e) { $("#submit-form-actualizar-registro").submit(); });

  mostrar(id_get.id);
});

function activar_editar(estado) {

  if (estado=="1") {

    $(".btn_editar").hide();
    $(".btn_actualizar").show();

    $("#direcccion").removeAttr("readonly");
    $("#celular").removeAttr("readonly");
    $("#telefono").removeAttr("readonly");
    $("#latitud").removeAttr("readonly");
    $("#longuitud").removeAttr("readonly");
    $("#correo").removeAttr("readonly");
    $("#horario").removeAttr("readonly");

    toastr.success('Campos habiliados para editar!!!')

  }else if (estado=="2") {

    $(".btn_editar").show();
    $(".btn_actualizar").hide();

    $("#direcccion").attr('readonly','true');
    $("#celular").attr('readonly','true');
    $("#telefono").attr('readonly','true');
    $("#latitud").attr('readonly','true');
    $("#longuitud").attr('readonly','true');
    $("#correo").attr('readonly','true');
    $("#horario").attr('readonly','true');
  }

}

function mostrar(get_id) {

  $("#cargando-1-fomulario").hide();
  $("#cargando-2-fomulario").show();

  $.post("../ajax/contacto.php?op=mostrar", {id: get_id}, function (e, status) {

    e = JSON.parse(e);  //console.log(e);  
    if (e.status == true){    

      $("#id").val(e.data.idcontacto);
      $("#direcccion").val(e.data.direccion);
      $("#celular").val(e.data.celular);
      $("#telefono").val(e.data.telefono_fijo);
      $("#latitud").val(e.data.latitud);
      $("#longuitud").val(e.data.longitud);
      $("#correo").val(e.data.correo);
      $("#horario").val(e.data.horario);

      $("#cargando-1-fomulario").show();
      $("#cargando-2-fomulario").hide();
      
    }else{
      ver_errores(e);
    }

  }).fail( function(e) { console.log(e); ver_errores(e); } );
}

function actualizar_datos_generales(e) {
  // e.preventDefault(); //No se activará la acción predeterminada del evento
  var formData = new FormData($("#form-datos-generales")[0]);

  $.ajax({
    url: "../ajax/contacto.php?op=actualizar_datos_generales",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (e) {
      try {
        e = JSON.parse(e);
        if (e.status == true) {
          Swal.fire("Correcto!", "Datos actualizados correctamente", "success");
          mostrar(id); 
          activar_editar(2);
        } else {
          Swal.fire("Error!", datos, "error");
        }
      } catch (err) { console.log('Error: ', err.message); toastr_error("Error temporal!!",'Puede intentalo mas tarde, o comuniquese con:<br> <i><a href="tel:+51921305769" >921-305-769</a></i> ─ <i><a href="tel:+51921487276" >921-487-276</a></i>', 700); }      
      $("#actualizar_registro").html('Actualizar').removeClass('disabled');
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
      $("#actualizar_registro").html('<i class="fas fa-spinner fa-pulse fa-lg"></i>').addClass('disabled');
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


$(function () {  

  $("#form-datos-generales").validate({
    rules: {
      direcccion: { required: true } , 
      celular: { required: true } , 
      telefono: { required: true } , 
      latitud: { required: true } , 
      longuitud: { required: true } , 
      correo: { required: true } , 
      horario: { required: true } 
    },
    messages: {

      direcccion: { required: "Por favor rellenar el campo", }, 
      celular: { required: "Por favor rellenar el campo", }, 
      telefono: { required: "Por favor rellenar el campo", }, 
      latitud: { required: "Por favor rellenar el campo", }, 
      longuitud: { required: "Por favor rellenar el campo", }, 
      correo: { required: "Por favor rellenar el campo", }, 
      horario: { required: "Por favor rellenar el campo", }

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
      actualizar_datos_generales(e);
    },

  });

});
