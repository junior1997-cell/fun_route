$(window).on('load', function () { $('#js-preloader').addClass('loaded'); });

$(document).ready(function () {
    condiciones_paquete();
    condiciones_tours();
    datos_empresa();
});

function condiciones_paquete() {
  $.post("controlador/seguridad.php?op=politicas_paquete", function (e, textStatus, jqXHR) {
    e = JSON.parse(e); console.log(e);
    if (e.status == true) {
      $('#condicion_paquete').html(e.data.condiciones_generales);
      $('#reserva_paquete').html(e.data.reservas);
      $('#pago_paquete').html(e.data.pago);
      $('#cancelacion_paquete').html(e.data.cancelacion);
    }else {
      ver_errores(e);
    }
  }).fail(function (e) { ver_errores(e); });
}

function condiciones_tours() {
  $.post("controlador/seguridad.php?op=politicas_tours", function (e, textStatus, jqXHR) {
    e = JSON.parse(e); console.log(e);
    if (e.status == true) {
      $('#reserva_tours').html(e.data.reservas);
      $('#canselacion_tours').html(e.data.cancelacion);
      $('#responsabilidad_cliente').html(e.data.responsabilidad_cliente);
      $('#cambios_proveedor').html(e.data.cancelaiones_proveedor);
      $('#responsabilidad_proveedor').html(e.data.responsabilidad_proveedor);
    }else {
      ver_errores(e);
    }
  }).fail(function (e) { ver_errores(e); });
}

// ::::::::::::::::::::::::::::::: F O O T E R  ::::::::::::::::::::::::
function datos_empresa() {
  $.post("controlador/inicio.php?op=datos_empresa",  function (e, textStatus, jqXHR) {
    e = JSON.parse(e); console.log(e);
    $('.direccion').html(`${e.data.direccion}`);
    $('.celular').html(`+51 ${e.data.celular}`);
    $('.correo').html(`${e.data.correo}`);

  });
}

fetch('footer.html')
  .then(response => response.text())
  .then(data => {
      document.body.insertAdjacentHTML('beforeend', data);
  });