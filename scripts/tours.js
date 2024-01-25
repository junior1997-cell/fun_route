// Page loading animation
$(window).on('load', function () { $('#js-preloader').addClass('loaded'); });

$(document).ready(function () {
  mostrar_vista();
});

function mostrar_vista() {
  $.post("controlador/tours.php?op=mostrar_todos", {}, function (e, status) {
    e = JSON.parse(e); console.log(e);
    if (e.status == true) {
      $('#tours-container').html(''); //limpiamos el div
      e.data.forEach((val, key) => {       
       
        // Estructura interna del tourDiv
        var codigoHTML = `<div class="c-card">
          <div class="card">
            <div class="card__banner">
              <div class="background">
                <div class="c-background">
                  <div class="card__poster">
                    <img src="admin/dist/docs/tours/perfil/${val.imagen}" alt="" onerror="this.src='admin/dist/docs/tours/perfil/tours-sin-foto.jpg'">
                  </div>
                  <div class="card__banner_content" style="width: 282.64px !important; height: 240px !important;">
                    <div class="__content">
                      <button class="buton1 w-150px">${val.tipo_tours}</button>
                      <h3 class="__content--title">${val.nombre}</h3>
                      <a href="#" onclick="ir_a_detalle_tours(${val.idtours},'${removeCaracterEspecial_v2(val.nombre)}')">
                        <button class="btn-consultar"> Consultar</button>
                      </a>
                      <div class="space1"></div>
                      <h4 class="title-actividades"><i class="fa-solid fa-camera espacio2"></i>Actividades :</h4>
                      <div class="actividades">
                        <a href="#" class="btn-txt">
                          ${val.resumen_actividad}
                        </a>
                      </div>
                      
                    </div>
                  </div>
                </div>
              </div>
              <img src="admin/dist/docs/tours/perfil/${val.imagen}" alt="" onerror="this.src='admin/dist/docs/tours/perfil/tours-sin-foto-horizontal.jpg'">
              <div class="drop" >
                <i class="fa-solid fa-circle-chevron-down boton-drop" onclick="activate_descripcion();"></i>
              </div>
            </div>

            <div class="card__descripcion drop-descripcion" >
              <div class="c-card__descripcion">
                <div class="card__descripcion__texto">
                  <h1>Descubra: </h1>
                  <p>${val.descripcion}</p>
                </div>
              </div>
            </div>

          </div>
        </div>`;

        $('#tours-container').append(codigoHTML);
        
      });
      
    } else {
      ver_errores(response);
    }
  }).fail(function (e) { ver_errores(e); });
}

function activate_descripcion() {  
	$('.boton-drop').toggleClass("drop-rotate");
	$('.drop-descripcion').toggleClass("drop-active")
}

function ir_a_detalle_tours(id, nombre) {
  localStorage.setItem('nube_idtours', id);
  window.location.href = window.location.host =='localhost' || es_numero(parseFloat(window.location.host)) == true ?`${window.location.origin}/fun_route/detalle-tours.html#${nombre}`: `${window.location.origin}/detalle-tours.html#${nombre}`;
}