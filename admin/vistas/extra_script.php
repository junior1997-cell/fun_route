<!-- nombre de proyeto -->
<script>
  
  if (localStorage.getItem("nube_idproyecto") == 0 || localStorage.getItem("nube_idproyecto") == '0' || localStorage.getItem("nube_idproyecto") == null || localStorage.getItem("nube_idproyecto") === undefined ) {

    $("#ver-proyecto").html('<i class="fas fa-tools"></i> Selecciona un proyecto');
    $(".ver-otros-modulos-1").hide();

  } else {
    console.log("id proyecto actual: " + localStorage.getItem("nube_idproyecto"));
    $("#ver-proyecto").html(`<i class="fas fa-tools"></i> <p class="d-inline-block hide-max-width-1080px">Proyecto:</p> ${localStorage.getItem('nube_nombre_proyecto')}`);
    $(".ver-otros-modulos-1").show();
    //$('#icon_folder_'+localStorage.getItem('nube_idproyecto')).html('<i class="fas fa-folder-open"></i>');
  }
</script>

<script>

  $("#bloc_Accesos").on("click", function (e) {
    $("#bloc_Accesos").removeClass('bg-color-191f24').addClass('bg-color-191f24');
    $("#bloc_Recurso").removeClass('bg-color-191f24');
    $("#bloc_Compras").removeClass('bg-color-191f24');
    $("#bloc_Viaticos").removeClass('bg-color-191f24');
    $("#sub_bloc_comidas").removeClass('bg-color-191f24');    
    $("#bloc_PagosTrabajador").removeClass('bg-color-191f24');
  });

  $("#bloc_Recurso").on("click", function (e) {
    $("#bloc_Accesos").removeClass('bg-color-191f24');
    $("#bloc_Recurso").removeClass('bg-color-191f24').addClass('bg-color-191f24');
    $("#bloc_Compras").removeClass('bg-color-191f24');
    $("#bloc_Viaticos").removeClass('bg-color-191f24');
    $("#sub_bloc_comidas").removeClass('bg-color-191f24');    
    $("#bloc_PagosTrabajador").removeClass('bg-color-191f24');
  });  

  $("#bloc_Compras").on("click", function (e) {    
    $("#bloc_Accesos").removeClass('bg-color-191f24');
    $("#bloc_Recurso").removeClass('bg-color-191f24');
    $("#bloc_Compras").removeClass('bg-color-191f24').addClass('bg-color-191f24');
    $("#bloc_Viaticos").removeClass('bg-color-191f24');
    $("#sub_bloc_comidas").removeClass('bg-color-191f24');    
    $("#bloc_PagosTrabajador").removeClass('bg-color-191f24');
  });

  $("#bloc_Viaticos").on("click", function (e) {
    $("#bloc_Accesos").removeClass('bg-color-191f24');
    $("#bloc_Recurso").removeClass('bg-color-191f24');
    $("#bloc_Compras").removeClass('bg-color-191f24');
    $("#bloc_Viaticos").removeClass('bg-color-191f24').addClass('bg-color-191f24');
    $("#sub_bloc_comidas").removeClass('bg-color-191f24');    
    $("#bloc_PagosTrabajador").removeClass('bg-color-191f24');
  });  

  $("#sub_bloc_comidas").on("click", function (e) {
    $("#bloc_Accesos").removeClass('bg-color-191f24');
    $("#bloc_Recurso").removeClass('bg-color-191f24');
    $("#bloc_Compras").removeClass('bg-color-191f24');
    $("#bloc_Viaticos").removeClass('bg-color-191f24');
    $("#sub_bloc_comidas").removeClass('bg-color-191f24').addClass('bg-color-191f24');    
    $("#bloc_PagosTrabajador").removeClass('bg-color-191f24');
  });  

  $("#bloc_PagosTrabajador").on("click", function (e) {
    $("#bloc_Accesos").removeClass('bg-color-191f24');
    $("#bloc_Recurso").removeClass('bg-color-191f24');
    $("#bloc_Compras").removeClass('bg-color-191f24');
    $("#bloc_Viaticos").removeClass('bg-color-191f24');
    $("#sub_bloc_comidas").removeClass('bg-color-191f24');    
    $("#bloc_PagosTrabajador").removeClass('bg-color-191f24').addClass('bg-color-191f24');
  });

</script>

<script>
  $(document).ready(function () {
    setInterval(function(){
      //ejecutando cada: 20 segundos
    
      $.post("../ajax/ajax_general.php?op=notificacion_pedido",  function (e, textStatus, jqXHR) {
        try {
          e = JSON.parse(e); console.log(e);
          if (e.status == true) { console.log(e.data.pedido.length);
            if (e.data.pedido.length === 0 || e.data.pedido == null ) {
              $(".notificacion_body_pedido_html").html(`<span class="dropdown-item dropdown-header">No hay pedidos</span>
              <div class="dropdown-divider"></div>
              <a href="pedido.php" class="dropdown-item">
              <i class="fa-solid fa-calendar-xmark mr-2"></i>No hay pedido<span class="float-right text-muted text-sm">0 mins</span>
              </a>        
              <div class="dropdown-divider"></div>
              <a href="pedido.php" class="dropdown-item dropdown-footer">Ver todo</a>`);
            } else {            
              var pedido_html = '';
              e.data.pedido.forEach((val, key) => {
                pedido_html += ` <div class="dropdown-divider"></div>
                <a href="pedido.php" class="dropdown-item">
                  <div class="w-250px recorte-text"><span class="float-right text-muted text-sm">${moment(val.created_at).fromNow(true)}</span>
                  <i class="fas fa-envelope mr-2"></i> ${val.nombre}</div>
                </a>`;
              });
              var div_html = `<span class="dropdown-item dropdown-header">${e.data.cant} Pedidos</span> ${pedido_html} <div class="dropdown-divider"></div> <a href="pedido.php" class="dropdown-item dropdown-footer">Ver todo</a>`;
              $(".notificacion_body_pedido_html").html(div_html);
            }

            $(".notificacion_cant_pedido_html").html(e.data.cant);            

            // ejecutamos la alerta
            if ( localStorage.getItem('nube_cant_pedido')  < e.data.cant ) {
              document.getElementById('notificacion_audio').play();
            } 

            // enviamos la cantidad nueva
            localStorage.setItem('nube_cant_pedido', e.data.cant);
            
          } else {
            ver_errores(e);
          }
        } catch (e) { ver_errores(e); }      
      }).fail(function (e) { ver_errores(e); }); // todos los post tienen que tener

    }, 5000); //Tiempo antes de la ejecución
  });
</script>