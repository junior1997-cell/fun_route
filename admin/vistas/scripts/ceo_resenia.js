
//Función que se ejecuta al inicio
function init() {

  $("#bloc_datos_generales").addClass("menu-open bg-color-191f24");

  $("#mAccesos").addClass("active");

  $("#lceo_resenia").addClass("active");


  $("#actualizar_registro").on("click", function (e) { $("#submit-form-actualizar-ceo-resenia").submit(); });
  mostrar();
  //$('#palabras_ceo').summernote();
  //$('#resenia_h').summernote();
  
  
}

function activar_editar(estado) {

  if (estado=="1") {

    $(".editar").hide();
    $(".actualizar").show();

    $("#palabras_ceo").removeAttr("readonly");
    $("#resenia_h").removeAttr("readonly");
 

    toastr.success('Campos habiliados para editar!!!')

  }

  if (estado=="2") {

    $(".editar").show();
    $(".actualizar").hide();

    $("#palabras_ceo").attr('readonly','true');
    $("#resenia_h").attr('readonly','true');


  }

}
function mostrar() {

  $("#cargando-1-fomulario").hide();
  $("#cargando-2-fomulario").show();

  $.post("../ajax/contacto.php?op=mostrar", {}, function (e, status) {

    e = JSON.parse(e);  console.log(e);  
    if (e.status){

      $("#cargando-1-fomulario").show();
      $("#cargando-2-fomulario").hide();

      $("#idnosotros").val(e.data.idnosotros);
      $("#palabras_ceo").val(e.data.palabras_ceo);
      $("#resenia_h").val(e.data.reseña_historica);

      
    }else{
      ver_errores(e);
    }

  }).fail( function(e) { console.log(e); ver_errores(e); } );
}

function actualizar_datos_generales(e) {
  // e.preventDefault(); //No se activará la acción predeterminada del evento
  var formData = new FormData($("#form-datos-ceo-resenia")[0]);

  $.ajax({
    url: "../ajax/contacto.php?op=actualizar_ceo_resenia",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,

    success: function (e) {
      try {
        e = JSON.parse(e);  console.log(e); 
        if (e.status == true) {

          Swal.fire("Correcto!", "El registro se guardo correctamente.", "success");

          mostrar(); activar_editar(2);

        }else{  
          ver_errores(e);
        } 
      } catch (err) {
        console.log('Error: ', err.message); toastr.error('<h5 class="font-size-16px">Error temporal!!</h5> puede intentalo mas tarde, o comuniquese con <i><a href="tel:+51921305769" >921-305-769</a></i> ─ <i><a href="tel:+51921487276" >921-487-276</a></i>');
      } 

    },
    xhr: function () {
      var xhr = new window.XMLHttpRequest();

      xhr.upload.addEventListener(
        "progress",
        function (evt) {
          if (evt.lengthComputable) {
            var percentComplete = (evt.loaded / evt.total) * 100;
            /*console.log(percentComplete + '%');*/
            $("#barra_progress2").css({ width: percentComplete + "%" });

            $("#barra_progress2").text(percentComplete.toFixed(2) + " %");

            if (percentComplete === 100) {
              l_m();
            }
          }
        },
        false
      );
      return xhr;
    },
  });
}
function l_m() {
  // limpiar();
  $("#barra_progress").css({ width: "0%" });

  $("#barra_progress").text("0%");

  $("#barra_progress2").css({ width: "0%" });

  $("#barra_progress2").text("0%");
}
init();


$(function () {
  
  $.validator.setDefaults({ submitHandler: function (e) { actualizar_datos_generales(e) },  });

  $("#form-datos-ceo-resenia").validate({
    rules: {
     
      palabras_ceo: { required: true } , 
      resenia_h: { required: true } , 
 
    },
    messages: {

      palabras_ceo: { required: "Por favor rellenar el campo", }, 
      resenia_h: { required: "Por favor rellenar el campo", }, 


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

});