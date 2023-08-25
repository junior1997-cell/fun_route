
name_p = $('#name_P_tt').val(); //"
console.log(name_p);
var tours_paquete='';
function init() {
  $("#bloc_empresa").addClass("menu-open bg-color-191f24");
  // mempresa
  $("#mempresa").addClass("active bg-primary");

  $("#bloc_lPoliticas").addClass("menu-open bg-color-191f24");

  $("#mlPaquetes").addClass("active");

  $("#mlPoliticas").addClass("active bg-primary");

  if (name_p == "politicas_paquete") { 

    $("#lPoliticasPaquete").addClass("active bg-color-f5f5f59e"); 

    $("#lPoliticasTours").removeClass("active"); 
  }

  if (name_p == "politicas_tours") { 
        
    $("#lPoliticasTours").addClass("active bg-color-f5f5f59e"); 

    $("#lPoliticasPaquete").removeClass("active"); 

  
  }

  $("#actualizar_registro").on("click", function (e) { actualizar_datos_generales_mv(e); });

  $('#condiciones_generales').summernote(); 
  $('#reservas').summernote(); 
  $('#pago').summernote(); 
  $('#cancelacion').summernote();

  $('#condiciones_generales').summernote('disable'); 
  $('#reservas').summernote('disable'); 
  $('#pago').summernote('disable'); 
  $('#cancelacion').summernote('disable');

  idpolitica = $("#idpoliticas").val();

  $('#reservas_tours').summernote(); 
  $('#cancelacion_tours').summernote(); 
  $('#responsabilidad_cliente_tours').summernote(); 
  $('#cancelacion_proveedor_tours').summernote(); 
  $('#responsabilidad_proveedor_tours').summernote();
  
  $('#reservas_tours').summernote('disable'); 
  $('#cancelacion_tours').summernote('disable'); 
  $('#responsabilidad_cliente_tours').summernote('disable'); 
  $('#cancelacion_proveedor_tours').summernote('disable'); 
  $('#responsabilidad_proveedor_tours').summernote('disable');

  mostrar(idpolitica);

}

function activar_editar(estado) {

tours_paquete = estado;
console.log(tours_paquete);
  if (estado == "1") {

    $(".editar_t").hide();
    $(".actualizar_t").show();

    $('#reservas_tours').summernote('enable'); 
    $('#cancelacion_tours').summernote('enable'); 
    $('#responsabilidad_cliente_tours').summernote('enable'); 
    $('#cancelacion_proveedor_tours').summernote('enable'); 
    $('#responsabilidad_proveedor_tours').summernote('enable');

    toastr.success('Campos habiliados para editar!!!')

  }else if(estado == "3"){
    $(".editar_t").show();
    $(".actualizar_t").hide();

    $('#reservas_tours').summernote('disable'); 
    $('#cancelacion_tours').summernote('disable'); 
    $('#responsabilidad_cliente_tours').summernote('disable'); 
    $('#cancelacion_proveedor_tours').summernote('disable'); 
    $('#responsabilidad_proveedor_tours').summernote('disable');
  }

  if (estado == "2") {//modificado de 2 a 0
    $(".editar").hide();
    $(".actualizar").show();

    $('#condiciones_generales').summernote('enable');
    $('#reservas').summernote('enable');
    $('#pago').summernote('enable');
    $('#cancelacion').summernote('enable');
    toastr.success('Campos habiliados para editar!!!')

  }else if(estado == "3"){

    $(".editar").show();
    $(".actualizar").hide();

    $('#condiciones_generales').summernote('disable'); 
    $('#reservas').summernote('disable'); 
    $('#pago').summernote('disable'); 
    $('#cancelacion').summernote('disable');
  }

}
function mostrar(idpolitica) {

  $("#cargando-1-fomulario").hide();
  $("#cargando-2-fomulario").show();

  $.post("../ajax/politicas.php?op=mostrar", { idpolitica: idpolitica }, function (e, status) {

    e = JSON.parse(e); console.log(e);
    if (e.status) {
      
      $("#cargando-1-fomulario").show();
      $("#cargando-2-fomulario").hide();

      if (e.data.idpoliticas=='1') { //politicas

        $("#idpoliticas").val(e.data.idpoliticas);

        $('#condiciones_generales').summernote('code', e.data.condiciones_generales);
        $('#reservas').summernote('code', e.data.reservas);
        $('#pago').summernote('code', e.data.pago);
        $('#cancelacion').summernote('code', e.data.cancelacion);
        
      }
      if (e.data.idpoliticas=='2') { //tours

        $("#idpoliticas").val(e.data.idpoliticas);

        $('#reservas_tours').summernote('code', e.data.reservas); 
        $('#cancelacion_tours').summernote('code', e.data.cancelacion); 
        $('#responsabilidad_cliente_tours').summernote('code', e.data.responsabilidad_cliente); 
        $('#cancelacion_proveedor_tours').summernote('code', e.data.cancelaiones_proveedor); 
        $('#responsabilidad_proveedor_tours').summernote('code', e.data.responsabilidad_proveedor);
        
      }


    } else {
      ver_errores(e);
    }

  }).fail(function (e) { console.log(e); ver_errores(e); });
}

function actualizar_datos_generales_mv(e) {
  // e.preventDefault(); //No se activará la acción predeterminada del evento
  var formData = new FormData($("#form-datos-politicas")[0]);

  $.ajax({
    url: "../ajax/politicas.php?op=actualizar_politicas",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,

    success: function (e) {
      try {
        e = JSON.parse(e); console.log(e);
        if (e.status == true) {

          Swal.fire("Correcto!", "El registro se guardo correctamente.", "success");

          mostrar(idpolitica); activar_editar(3);

        } else {
          ver_errores(e);
        }
      } catch (err) {
        console.log('Error: ', err.message); toastr.error('<h5 class="font-size-16px">Error temporal!!</h5> puede intentalo mas tarde, o comuniquese con <i><a href="tel:+51921305769" >921-305-769</a></i> ─ <i><a href="tel:+51921487276" >921-487-276</a></i>');
      }
      $("#actualizar_registro").html('Guardar Cambios').removeClass('disabled');

    },
    xhr: function () {
      var xhr = new window.XMLHttpRequest();
      xhr.upload.addEventListener("progress", function (evt) {
        if (evt.lengthComputable) {
          var percentComplete = (evt.loaded / evt.total) * 100;
          /*console.log(percentComplete + '%');*/
          $("#barra_progress_ceo_resenia").css({ "width": percentComplete + '%' }).text(percentComplete.toFixed(2) + " %");
        }
      }, false);
      return xhr;
    },
    beforeSend: function () {
      $("#actualizar_registro").html('<i class="fas fa-spinner fa-pulse fa-lg"></i>').addClass('disabled');
      $("#barra_progress_ceo_resenia").css({ width: "0%", }).text("0%").addClass('progress-bar-striped progress-bar-animated');
      $("#barra_progress_ceo_resenia_div").show();
    },
    complete: function () {
      $("#barra_progress_ceo_resenia").css({ width: "0%", }).text("0%").removeClass('progress-bar-striped progress-bar-animated');
      $("#barra_progress_ceo_resenia_div").hide();
    },
    error: function (jqXhr) { ver_errores(jqXhr); },

  });
}

init();
