function init(){
  mostrar_tours();
  // mostrar_paquetes();

};

function mostrar_tours() {


  $.post("controlador/inicio.php?op=mostrar_tours", {}, function (e, status) {

    e = JSON.parse(e); console.log(e);

    if (e.status) {
      var codigo_tours = '';

      e.data.forEach((element, index) => {
        //${item.nombre}
        codigo_tours += `
        <div class="item" data-tilt>
          <img src="admin/dist/docs/tours/perfil/${element.imagen}" class="card-imgen" alt="">
          <div class="card-body">
            <button class="buton1">Tours</button>
            <h4><b>${element.nombre}</b></h4>
            <div class="line-dec"></div>
            <ul>
              <li><b>${recortarTexto(element.descripcion, 60)}</b></li>
              <li><b>Precio * Persona:</b> <span class="espacio">S/. ${element.costo}</span></li>
              <li><b><i class="fa-regular fa-clock espacio2"></i>Horario:</b><span class="espacio">${element.duracion}</span></li>
            </ul>
            <a href="paquetes/lamas.html">
              <button class="learn-more">
                <span class="circle" aria-hidden="true">
                  <span class="icon arrow"></span>
                </span>
                <span class="button-text">Leer Más</span>
              </button>
            </a>
          </div>
        </div>
        `;

      });

      $('.codigoGenTours').html(codigo_tours); // Agregar el contenido

    }

  });

  // $.post("controlador/inicio.php?op=mostrar_paquetes", {}, function (response, status) {
  //   response = JSON.parse(response);
  //   console.log(response);

  //   if (response.status) {
  //     var codigoHTML = '';
  //     response.data.forEach((item, index) => {

  //       codigoHTML += `
  //           <div class="item popular-item">
  //             <div class="thumb">
  //               <img src="admin/dist/docs/paquete/perfil/${item.imagen}" alt="">
  //               <div class="property-description">
  //                 <h5>${item.nombre} </h5>
  //                 <button class="buton2">Paquete Turistico</button>
  //               </div>
  //               <div class="plus-button">
  //                 <a href="paquetes/escape-tarapoto.html"><i class="fa fa-plus"></i></a>
  //               </div>
  //             </div>
  //           </div>
  //       `;

  //     });


  //     $('.codigoGenerado').html(codigoHTML); // Agregar el contenido


  //     //  $('.paquetes_').owlCarousel({
  //     //   items:3,
  //     //   loop:true,
  //     //   margin:40,
  //     //   responsiveClass:true,
  //     //   responsive:{
  //     //     0:{
  //     //       items:1
  //     //     },
  //     //     800:{
  //     //       items:2
  //     //     },
  //     //     1100:{
  //     //       items:3
  //     //   }
  //     // }
  //     // })


  //   }

  // });


}

function mostrar_paquetes() {
 

  $.post("controlador/inicio.php?op=mostrar_paquetes", {}, function (response, status) {
    response = JSON.parse(response);
    console.log(response);

    if (response.status) {
      var codigoHTML = '';
      response.data.forEach((item, index) => {

        codigoHTML += `
            <div class="item popular-item">
              <div class="thumb">
                <img src="admin/dist/docs/paquete/perfil/${item.imagen}" alt="">
                <div class="property-description">
                  <h5>${item.nombre} </h5>
                  <button class="buton2">Paquete Turistico</button>
                </div>
                <div class="plus-button">
                  <a href="paquetes/escape-tarapoto.html"><i class="fa fa-plus"></i></a>
                </div>
              </div>
            </div>
        `;

      });


      $('.codigoGenerado').html(codigoHTML); // Agregar el contenido


       $('.paquetes_').owlCarousel({
        items:3,
        loop:true,
        margin:40,
        responsiveClass:true,
        responsive:{
          0:{
            items:1
          },
          800:{
            items:2
          },
          1100:{
            items:3
        }
      }
      })


    }

  });

}

init();

function recortarTexto(texto, longitudMaxima) {
  if (texto.length > longitudMaxima) {
    return texto.substring(0, longitudMaxima) + "...";
  }
  return texto;
}
