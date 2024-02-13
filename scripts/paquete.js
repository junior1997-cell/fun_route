// Page loading animation
$(window).on('load', function () { $('#js-preloader').addClass('loaded'); });

$(document).ready(function () {
  mostrar_vista();
  mostrar_5_img_aleatorio();
  mostrar_20_img_aleatorio()
  datos_empresa();

});

function mostrar_vista() {
  var destinos ="";
  $.post("controlador/paquete.php?op=mostrar_todos", {}, function (e, status) {
    e = JSON.parse(e); console.log(e); console.log('hola');
    if (e.status == true) {
      $('#paquete-container').html(''); //limpiamos el div
      e.data.forEach((val, key) => { 

        destinos ="";

        val.destinos.data.forEach(function(valor) {
          destinos +=`<p style="color: #fff;margin: 5px 0;font-size: 14px;"> <i class="fa-solid fa-check"></i> ${valor.nombre} </p>`;
        });

        // Estructura interna del tourDiv
        var codigoHTML = `<div class="c-card">
          <div class="card">
            <div class="card__banner">
              <div class="background">
                <div class="c-background">
                  <div class="card__poster">
                    <img src="admin/dist/docs/paquete/perfil/${val.imagen}" alt="" onerror="this.src='admin/dist/docs/paquete/perfil/paquete-sin-foto.jpg'">
                  </div>
                  <div class="card__banner_content" style="width: 282.64px !important; height: 240px !important;">
                    <div class="__content">
                      <button class="buton2">Paquete Turístico</button>
                      <h3 class="__content--title">${val.nombre}</h3>
                      <a href="#" onclick="ir_a_detalle_paquete(${val.idpaquete},'${removeCaracterEspecial_v2(val.nombre)}')">
                        <button class="btn-consultar"> Consultar</button>
                      </a>                      
                      <div class="space1"></div>                    
                      <h4 class="title-actividades"><i class="fa-solid fa-location-dot espacio2"></i>Destinos :</h4>
                      <div class="actividades"> ${destinos}
                       <!--<a href="#" class="btn-txt">
                          ${val.alojamiento}
                        </a>-->
                        
                      </div>
                      
                    </div>
                  </div>
                </div>
              </div>
              <img src="admin/dist/docs/paquete/perfil/${val.imagen}" alt="" onerror="this.src='admin/dist/docs/paquete/perfil/paquete-sin-foto-horizontal.jpg'">
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
  window.location.href = window.location.host =='localhost' || es_numero(parseFloat(window.location.host)) == true ?`${window.location.origin}/fun_route/detalle-paquete.html#${nombre}`: `${window.location.origin}/detalle-paquete.html#${nombre}`;
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