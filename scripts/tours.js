$(document).ready(function () {
  mostrar_vista();
});

function mostrar_vista() {
  $.post("controlador/tours.php?op=mostrar_vista", {}, function (e, status) {
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
                    <img src="admin/dist/docs/tours/perfil/${val.imagen}" alt="">
                  </div>
                  <div class="card__banner_content" style="width: 282.64px !important; height: 240px !important;">
                    <div class="__content">
                      <h3 class="__content--title">${val.nombre}</h3>
                      <button class="buton1">Tours</button>
                      <div class="space1"></div>
                      <h4 class="title-actividades"><i class="fa-solid fa-camera espacio2"></i>Actividades :</h4>
                      <div class="actividades">
                        <a href="#" class="btn-txt">
                          ${val.resumen_actividad}
                        </a>
                      </div>
                      <a href="paquetes/laguna-azul.html">
                        <button class="btn-consultar"> Consultar</button>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <img src="admin/dist/docs/tours/perfil/${val.imagen}" alt="">
              <div class="drop" >
                <i class="fa-solid fa-circle-chevron-down boton-drop" onclick="activate_descripcion();"></i>
              </div>
            </div>

            <div class="card__descripcion drop-descripcion" >
              <div class="c-card__descripcion">
                <div class="card__descripcion__texto">
                  <h1>Descubra: </h1>
                  <p>${val.resumen_actividad}</p>
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