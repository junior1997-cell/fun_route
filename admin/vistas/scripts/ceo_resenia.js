var id_get = varaibles_get();
var id =id_get.id;

//Función que se ejecuta al inicio
$(document).on("ready", function () {

  $(`.mceo_resena${id_get.id}`).addClass("active");

  $("#actualizar_registro").on("click", function (e) { $("#submit-form-actualizar-registro").submit();  });
  $("#form-palabrasceo-resenia").on("submit", function (e) { actualizar_ceo_resenia(e) });

  mostrar(id_get.id)

});

function mostrar(get_id) {

  $("#cargando-1-fomulario").hide();
  $("#cargando-2-fomulario").show();

  $.post("../ajax/contacto.php?op=mostrar", {id:get_id}, function (e, status) {

    e = JSON.parse(e);  console.log(e);  
    if (e.status == true){
      

      $("#id").val(e.data.idcontacto);
      $(".p_ceo").html(e.data.palabras_ceo);
      $(".r_hist").html(e.data.reseña_historica); 

      $("#palabras_ceo").val(e.data.palabras_ceo);
      $("#resenia_h").val(e.data.reseña_historica);

      $("#cargando-1-fomulario").show();
      $("#cargando-2-fomulario").hide();

    }else{
      ver_errores(e);
    }

  }).fail( function(e) { console.log(e); ver_errores(e); } );
}

function actualizar_ceo_resenia(e) {
  e.preventDefault(); //No se activará la acción predeterminada del evento
  $("#palabras_ceo").val($(".p_ceo").html());
  $("#resenia_h").val($(".r_hist").html());
  var formData = new FormData($("#form-palabrasceo-resenia")[0]);

  $.ajax({
    url: "../ajax/contacto.php?op=actualizar_ceo_resenia",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (e) {
      try {
        e = JSON.parse(e);
        if (e.status == true) {
          Swal.fire("Correcto!", "Datos actualizados correctamente", "success");  
          mostrar(id_get.id);   
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

function l_m() {
  // limpiar();
  $("#barra_progress").css({ width: "0%" });

  $("#barra_progress").text("0%");

  $("#barra_progress2").css({ width: "0%" });

  $("#barra_progress2").text("0%");
}



/*$(function () {
  
  $.validator.setDefaults({ submitHandler: function (e) { actualizar_ceo_resenia(e) },  });

  $("#form-palabrasceo-reseña").validate({
    rules: {
      palabras_ceo: { required: true } ,  
      resenia_h: { required: true }  
    },
    messages: {
      palabras_ceo: { required: "Por favor rellenar el campo misióm", },
      resenia_h: { required: "Por favor rellenar el campo Visión", },

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

  });

});*/
