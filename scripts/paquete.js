$(document).ready(function () {
  mostrar_vista();
  mostrar_5_img_aleatorio();
  mostrar_20_img_aleatorio()
});

function mostrar_vista() {
  $.post("controlador/paquete.php?op=mostrar_todos", {}, function (e, status) {
    e = JSON.parse(e); console.log(e);
    if (e.status == true) {
      $('#paquete-container').html(''); //limpiamos el div
      e.data.forEach((val, key) => {       
       
        // Estructura interna del tourDiv
        var codigoHTML = `<div class="c-card">
          <div class="card">
            <div class="card__banner">
              <div class="background">
                <div class="c-background">
                  <div class="card__poster">
                    <img src="admin/dist/docs/paquete/perfil/${val.imagen}" alt="">
                  </div>
                  <div class="card__banner_content" style="width: 282.64px !important; height: 240px !important;">
                    <div class="__content">
                      <h3 class="__content--title">${val.nombre}</h3>
                      <button class="buton2">Paquete Turístico</button>
                      <div class="space1"></div>                    
                      <h4 class="title-actividades"><i class="fa-solid fa-location-dot espacio2"></i>Destinos :</h4>
                      <div class="actividades">
                        <a href="#" class="btn-txt">
                          ${val.alojamiento}
                        </a>
                        
                      </div>
                      <a href="#" onclick="ir_a_detalle_paquete(${val.idpaquete},'${removeCaracterEspecial_v2(val.nombre)}')">
                        <button class="btn-consultar"> Consultar</button>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <img src="admin/dist/docs/paquete/perfil/${val.imagen}" alt="">
              <div class="drop">
                <i class="fa-solid fa-circle-chevron-down boton-drop"  onclick="activate_descripcion();"></i>
              </div>
            </div>

            <div class="card__descripcion drop-descripcion" >
              <div class="c-card__descripcion">
                <div class="card__descripcion__texto">
                  <h1>Descubra</h1>
                  <p>${val.descripcion} </p>
                </div>
              </div>
            </div>
            
          </div>
        </div>`;

        $('#paquete-container').append(codigoHTML);
        
      });
      
    } else {
      ver_errores(response);
    }
  }).fail(function (e) { ver_errores(e); });
}

function mostrar_5_img_aleatorio() {
  $.post("controlador/paquete.php?op=mostrar_galeria_5_aleatorios", {}, function (e, status) {
    e = JSON.parse(e); console.log(e);
    if (e.status == true) {
      $('.5_img_carrucel').html(''); //limpiamos el div
      e.data.forEach((val, key) => {              
        // Estructura interna del div
        var codigoHTML = `<div class="item"> <img src="admin/dist/docs/paquete/galeria/${val.imagen}" alt=""> </div>`;
        $('.5_img_carrucel').append(codigoHTML);        
      });     
      // activamos el pluging
      $('.owl-banner').owlCarousel({ items: 1, loop: true, dots: false, nav: true, autoplay: true, margin: 30, responsive: { 0: { items: 1	}, 600: { items: 1 }, 1000: { items: 1 } } });
    } else {
      ver_errores(response);
    }
  }).fail(function (e) { ver_errores(e); });
}

function mostrar_20_img_aleatorio() {
  $.post("controlador/paquete.php?op=mostrar_galeria_20_aleatorios", {}, function (e, status) {
    e = JSON.parse(e); console.log(e);
    if (e.status == true) {
      $('.20_img_carrucel').html(''); //limpiamos el div
      e.data.forEach((val, key) => {        
        // Estructura interna del div
        var codigoHTML = `<div class="swiper-slide"> <img src="admin/dist/docs/paquete/galeria/${val.imagen}" alt="">  </div>`;
        $('.20_img_carrucel').append(codigoHTML);        
      });  
      // activamos el pluging 
      var swiper = new Swiper(".swiper-hero", {	effect: "coverflow",grabCursor: true,	centeredSlides: true,	slidesPerView: "auto",coverflowEffect: {rotate: 15,strech: 0,depth: 300,	modifier: 1,slideShadows: true,	}, loop: true,});   
    } else {
      ver_errores(response);
    }
  }).fail(function (e) { ver_errores(e); });
}

function activate_descripcion() {  
	$('.boton-drop').toggleClass("drop-rotate");
	$('.drop-descripcion').toggleClass("drop-active")
}

function ir_a_detalle_paquete(id, nombre) {
  localStorage.setItem('nube_idpaquete', id);
  window.location.href = `${window.location.origin}/fun_route/detalle-paquete.html#${nombre}`;
}