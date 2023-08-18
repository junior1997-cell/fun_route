$(document).ready(function() {
  mostrar_vista(); 
});

function mostrar_vista() {
  $.post("admin/ajax/tours.php?op=mostrar_vista", {}, function (response, status) {
      response = JSON.parse(response); 
      if (response.status) {
          var toursContainer = $('#toursContainer'); //console.log(response.data);
          for (var i = 0; i < response.data.length; i++) {
              var tourData = response.data[i];
              var tourDiv = $('<div class="c-card"></div>'); // contenedor del tours

              // Estructura interna del tourDiv
              var codigoHTML = `
                  <style>
                    .card__banner${tourData.idtours}::before {
                        content: '';
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background-image: url('./assets/images/laguna-azul.jpg');
                        background-color: rgba(0, 0, 0, 0.5); 
                        opacity: 1; 
                        z-index: -1;
                    }                
                  </style>
                  <div class="card" id="card" name="card">
                        <div class="card__banner${tourData.idtours}" id="card__banner${tourData.idtours}">
                            <div class="background">
                              <div class="c-background">
                                <div class="card__poster">
                                  <img src="admin/dist/docs/tours/perfil/${tourData.imagen}" alt=""  style="width: 150px; height: auto;">
                                </div>                          
                                  <div class="card__banner_content" style="width: 282.64px !important; height: 240px !important;">
                                      <div class="__content">
                                          <h3 class="__content--title">${tourData.nombre}</h3>
                                          <button class="buton1">Tours</button>
                                          <div class="space1"></div>
                                          <h4 class="title-actividades"><i class="fa-solid fa-camera espacio2"></i>Actividades :</h4>
                                          <div class="actividades">
                                              <a href="#" class="btn-txt">${tourData.descripcion}</a>
                                          </div>
                                          <a href="paquetes/laguna-azul.html">
                                              <button class="btn-consultar"> Consultar</button>
                                          </a>
                                      </div>
                                  </div>
                              </div>
                            </div>
                          <div class="drop">
                              <i class="fa-solid fa-circle-chevron-down" id="boton-drop6"></i>
                          </div>
                        </div>
                      <div class="card__descripcion" id="drop-descripcion6${tourData.idtours}">
                          <div class="c-card__descripcion">
                              <div class="card__descripcion__texto">
                                  <p>${tourData.descripcion}</p>
                              </div>
                          </div>
                      </div>
                  </div>

              `;

              tourDiv.html(codigoHTML);

              toursContainer.append(tourDiv); // Agrega el tourDiv al contenedor principal
          }
      } else {
          ver_errores(response);
      }
  }).fail(function(e) {
      console.log(e);
      ver_errores(e);
  });
}


/*
$(document).ready(function() {
	$('#boton-drop').click(function() {
		$('#boton-drop').toggleClass("drop-rotate");
		$('#drop-descripcion').toggleClass("drop-active")
	})
})
*/