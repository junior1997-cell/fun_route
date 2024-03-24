// Page loading animation
$(window).on('load', function () { $('#js-preloader').addClass('loaded'); });

$(document).ready(function () {
  datos_empresa();
  oferta_semanal();
  mostrar_tours_paquete();
  mostrar_testimonio_ceo();
  galeria_noticias();
});

function datos_empresa() {
  $('.float_whatssap').attr('href',`#`).attr('onclick', `toastr_info('Extrayendo numero', 'Cargando data...')`);
  $.post("controlador/inicio.php?op=datos_empresa",  function (e, textStatus, jqXHR) {
    e = JSON.parse(e); 
    $('.ruc_empresa').html(`${e.data.tipo_documento}: ${e.data.num_documento}`);
    $('.razon_social_empresa').html(`Razon Social: ${e.data.nombre_empresa}`);
    $('.float_whatssap').attr('href',`https://api.whatsapp.com/send?phone=+51${e.data.celular}&text=Me%20interesa%20saber%20sobre%20los%20paquetes`).attr('onclick', `toastr_success('Redireccionando', 'WhatsApp abierto...')`);
    $('.direccion').html(`${e.data.direccion}`);
    $('.celular').html(`+51 ${e.data.celular}`);
    $('.correo').html(`${e.data.correo}`);

  });
}

function oferta_semanal() {

  $.post("controlador/inicio.php?op=oferta_semanal", {}, function (e, status) {

    e = JSON.parse(e);

    if (e.status == true) {  
      // valdiamos la cantidad de datos
      if (e.data.length === 0) {
        $('.ofertas_html').html(`<div class="left-slide"> <div style="background-color: #060505"><h1>No hay ofertas</h1></div></div><div class="right-slide"><div style="background-image: url('assets/images/default/sin_oferta.jpg')"></div></div><div class="action-buttons"><button class="down-button"><i class="far fa-dot-circle"></i></button><button class="up-button"> <i class="far fa-dot-circle"></i> </button></div>`);         
      } else { 
        // Revertir el orden del array e.data
        var reversedData = e.data.slice().reverse();

        var html_nombre = ''; var fotos_html = '';
        
        e.data.forEach((val, key) => {
          var detalle = val.tipo_pt == `TOURS` ? `ir_a_detalle_tours(${val.id},'${removeCaracterEspecial_v2(val.nombre)}');` : `ir_a_detalle_paquete(${val.id},'${removeCaracterEspecial_v2(val.nombre)}');` ;
          html_nombre += `<div style="background-color: ${val.color.hexadecimal}"> <h1> ${val.tipo_pt} <br> ${val.nombre}</h1>  <h4> ${val.duracion} <br> S/. <s>${val.costo}</s> - Dcto: (${val.porcentaje_descuento}%) </h4> <button type="button" class="btn btn-primary py-1 mt-2" onclick="${detalle}" ><i class="fas fa-eye"></i> Detalle</button> </div> `;
        }); 
        
        // Recorrer los elementos en orden invertido
        reversedData.forEach((val, key) => {
           fotos_html += `<div style="background-image: url('admin/dist/docs/${val.tipo_pt == 'TOURS' ? 'tours' : 'paquete'}/perfil/${val.imagen}')"></div>`;
        });

        $('.ofertas_html').html(`<div class="left-slide"> ${html_nombre} </div> <div class="right-slide"> ${fotos_html} </div>      
        <div class="action-buttons"> 
          <button class="down-button"> <i class="fa fa-arrow-down"></i> </button> <button class="up-button"> <i class="fa fa-arrow-up"></i> </button>
        </div>`);        
      }

      // ::::::::::::::::::::: activacion plugin :::::::::::::
      const sliderContainer = document.querySelector('.slider-container');
      const slideRight = document.querySelector('.right-slide');
      const slideLeft = document.querySelector('.left-slide');
      const upButton = document.querySelector('.up-button');
      const downButton = document.querySelector('.down-button');
      const slidesLength = slideRight.querySelectorAll('div').length;

      let activeSlideIndex = 0;
      slideLeft.style.top = `-${(slidesLength - 1) * 100}vh`;

      upButton.addEventListener('click', () => changeSlide('up'));
      downButton.addEventListener('click', () => changeSlide('down'));

      const changeSlide = (direction) => {
        const sliderHeight = sliderContainer.clientHeight;
        if (direction === 'up') {activeSlideIndex++;	if (activeSlideIndex > slidesLength - 1) {activeSlideIndex = 0;}} else if (direction === 'down') {activeSlideIndex--;	if (activeSlideIndex < 0) {activeSlideIndex = slidesLength - 1;}}
        slideRight.style.transform = `translateY(-${activeSlideIndex * sliderHeight}px)`;	slideLeft.style.transform = `translateY(${activeSlideIndex * sliderHeight}px)`;
      }

    }else{
      ver_errores(e);
    }
  }).fail(function (e) { ver_errores(e); });
}

function mostrar_tours_paquete() { 

  $.post("controlador/inicio.php?op=mostrar_tours_paquete", {}, function (e, status) {
    e = JSON.parse(e);   
    if (e.status == true) {  
      var tours_html = ''; var paquete_html = '';

      // :::::::::::::::::::: L I S T A   D E   T O U R S ::::::::::::::::::::::::::::::::
      e.data.tours.forEach((val, key) => {
        tours_html += `<div class="item" data-tilt="" >
          <img src="admin/dist/docs/tours/perfil/${val.imagen}" class="card-imgen" alt="" onerror="this.src='admin/dist/docs/tours/perfil/tours-sin-foto.jpg'">
          <div class="card-body">
          <button class="buton1 ${val.estado_descuento == '1' ? 'w-200px' : ''}">Tours ${val.estado_descuento == '1' ? `(Dcto. ${val.porcentaje_descuento}%)` : ''}</button>
            <h4><b>${val.nombre}</b> </h4><small>${val.tipo_tours}</small>
            <div class="line-dec"></div>
            <ul>
              <li class="text-white">${val.descripcion.slice(0,50)}...</li>
              <li><b>Precio * Persona:</b>  <span class="espacio">S/. ${val.costo}</span></li>
              <li><b><i class="fa-regular fa-clock espacio2"></i></b><span class="espacio">${val.duracion}</span></li>
            </ul>
            <button class="learn-more" onclick="ir_a_detalle_tours(${val.idtours},'${removeCaracterEspecial_v2(val.nombre)}')">
              <span class="circle" aria-hidden="true"><span class="icon arrow"></span></span><span class="button-text">Leer Más</span>
            </button>   
          </div>
        </div>`;
        // $(".tours_html").append(`${tours_html}`);
      });
      $('.tours_html').html(`<div class="carousel-tours owlCarousel">${tours_html}</div>`);
      $('.carousel-tours').owlCarousel({
        items: 3, loop: true, margin: 40, dots: false, nav: true, autoplay: true,
        autoplayTimeout: 300, autoplayHoverPause: true,
        responsive: { 0: { items: 1 }, 800: { items: 2 }, 1100: { items: 3 } }
      });
      

      // :::::::::::::::::::: L I S T A   D E   P A Q U E T E ::::::::::::::::::::::::::::::::
      e.data.paquete.forEach((val, key) => {
        paquete_html += `<div class="item" data-tilt="" >
          <img src="admin/dist/docs/paquete/perfil/${val.imagen}" class="card-imgen" alt="" onerror="this.src='admin/dist/docs/paquete/perfil/paquete-sin-foto.jpg'" >
          <div class="card-body">
            <button class="buton1 ${val.estado_descuento == '1' ? 'w-200px' : ''}">Paquete ${val.estado_descuento == '1' ? `(Dcto. ${val.porcentaje_descuento}%)` : ''}</button>
            <h4><b>${val.nombre}</b></h4>
            <div class="line-dec"></div>
            <ul>
              <li class="text-white">${val.descripcion.slice(0,50)}...</li>
              <li><b>Precio * Persona:</b>  <span class="espacio">S/. ${val.costo}</span></li>
              <li><b><i class="fa-regular fa-clock espacio2"></i></b><span class="espacio">${val.cant_dias} dias y ${val.cant_noches} noches</span></li>
            </ul>            
            <button class="learn-more" onclick="ir_a_detalle_paquete(${val.idpaquete},'${removeCaracterEspecial_v2(val.nombre)}')">
              <span class="circle" aria-hidden="true"><span class="icon arrow"></span></span><span class="button-text">Leer Más</span>
            </button>                      
          </div>
        </div>`;
        // $(".tours_html").append(`${tours_html}`);
      });      
      $('.paquete_html').html(`<div class="carousel-paquete owl-carousel owl-theme">${paquete_html}</div>`); 
      $('.carousel-paquete').owlCarousel({
        items: 3, loop: true, margin: 40, dots: false, nav: true, autoplay: true,
        autoplayTimeout: 300, autoplayHoverPause: true, margin: 30,
        responsive: { 0: { items: 1 }, 800: { items: 2 }, 1100: { items: 3 } }
      });  
      
    }else{
      ver_errores(e);
    }
  }).fail(function (e) { ver_errores(e); });
}

function mostrar_testimonio_ceo() { 

  $.post("controlador/inicio.php?op=mostrar_testimonio_ceo", {}, function (e, status) {
    e = JSON.parse(e); 
    if (e.status == true) {  

      // ::::::::::::::::: T E S T I M O N I O :::::::::::::::::

      $('.testimonio_html').html('');
      e.data.experiencia.forEach((val, key) => {
        var testimonio_html = `<div class="slide swiper-slide">
          <img src="admin/dist/docs/experiencia/perfil/${val.img_perfil}" class="image" alt="">
          <p>${val.comentario}</p> <i class="bx bxs-quote-alt-left quote-icon"></i>
          <div class="details"> <span class="name">${val.nombre}</span> <span class="job">${val.lugar}</span> </div>
        </div>`;

        $('.testimonio_html').append(testimonio_html);
      });    
      
      var testimonio_html = `<div class="slide swiper-slide">
        <img src="admin/dist/img/avatar.png" class="image" alt="">
        <p>¿Tienes algo que contarnos? comparte con nosotros tu experiencia vivida con nuestros paquetes!!</p><a href="https://wa.me/51930637287?text=Cuentenos%20Ya!!"><i class="fab fa-whatsapp quote-icon"></i></a> 
        <div class="details"> <span class="name">Escribenos al WhatsApp </span> <span class="job">ya!</span> </div>
      </div>`;

      $('.testimonio_html').append(testimonio_html);

      // Activamos el pluging
      var swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        grabCursor: true,
        loop: true,
        pagination: { el: ".swiper-pagination", clickable: true, },
        navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev", },
      });

      // ::::::::::::::::: C E O :::::::::::::::::
      var ceo_html = `<div class="col-lg-6 col-12">
        <img src="admin/dist/docs/nosotros/perfil_ceo/${e.data.nosotros.perfil_ceo}" class="author-image img-fluid" alt="">
      </div>
      <div class="col-lg-6 col-12 mt-5 mt-lg-0">
        <h2 class="mb-4">${e.data.nosotros.nombre_ceo}</h2>
        <div> ${e.data.nosotros.palabras_ceo}</div>
      </div>`;
      $('.ceo_html').html(ceo_html);

    }else{
      ver_errores(e);
    }
  }).fail(function (e) { ver_errores(e); });
}

function ir_a_detalle_tours(id, nombre) {
  localStorage.setItem('nube_idtours', id);
  window.location.href = window.location.host =='localhost' || es_numero(parseFloat(window.location.host)) == true ?`${window.location.origin}/fun_route/detalle-tours.html#${nombre}`: `${window.location.origin}/detalle-tours.html#${nombre}`;
}

function ir_a_detalle_paquete(id, nombre) {
  localStorage.setItem('nube_idpaquete', id);
  window.location.href = window.location.host =='localhost' || es_numero(parseFloat(window.location.host)) == true ?`${window.location.origin}/fun_route/detalle-paquete.html#${nombre}`: `${window.location.origin}/detalle-paquete.html#${nombre}`;
}

function galeria_noticias(){
  
  $.post("controlador/inicio.php?op=mostrar_datos_noticia", {}, function (e, status) {
      e = JSON.parse(e);   
      if (e.status == true) {
        if (e.data === null || e.data.length === 0) {
          $("#modal_noticia").hide();
          $("#cerrar").hide();
          $("#btn-cerrar").hide();
        }else{
          $("#modal_noticia").show();  
          $("#cerrar").show();  
          $("#btn-cerrar").show();  

          $('.galeria_noticia_html').html('');
          e.data.forEach((val, key) => {
            var galeria_noticia_html = `
            <div class="slide swiper-slide">
              <div class="contenido col col-lg-6 mx-auto text-center">
                <h4>Noticia Diaria: <b>${val.titulo}</b></h4>
                <img src="admin/dist/docs/noticia_inicio/${val.imagen}" class="image" alt="" style="width: 10cm;">
              </div>
            </div>
              `;
            $('.galeria_noticia_html').append(galeria_noticia_html); 
            
          });
          var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            grabCursor: true,
            loop: true,
            autoplay: { delay: 10000, disableOnInteraction: false, },
          });
        }  
        
      } else {
        ver_errores(e);
      }    
    }).fail( function(e) { ver_errores(e); } );
}

fetch('footer.html')
  .then(response => response.text())
  .then(data => {
      document.body.insertAdjacentHTML('beforeend', data);
  });