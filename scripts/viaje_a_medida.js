function init() {
  datos_empresa();
  $.post("controlador/tours.php?op=mostrar_todos",  function (e, textStatus, jqXHR) {
    e = JSON.parse(e); console.log(e);

    $('.html-tours-lista').html('');

    $('.html-tours-lista').append(`<div class="col-lg-12">
      <div class="m-3 text-center">
        <h4 class="font-weight-bold">ARMA TU VIAJE, Selecciona los lugares que quieres conocer</h4>
      </div>            
    </div>`);

    e.data.forEach((val, key) => {
      $('.html-tours-lista').append(` <div class="col-lg-3">
        <div class="m-3 form-group">
          <input type="checkbox" name="idtours[]" id="idtours_${val.idtours}" class="checkbox idtours"  value="${val.idtours}" style="position: relative; top: 37px; left: 5px; width: 25px; height: 25px;">
          <label for="idtours_${val.idtours}" class="teal_color_check border border-success rounded p-2 w-100 cursor-pointer">                
            <img src="admin/dist/docs/tours/perfil/${val.imagen}"  class="img-fluid rounded-3" onerror="this.src='admin/dist/docs/tours/perfil/tours-sin-foto.jpg'" style="width: 100%; height: 100px; object-fit: cover;">
            <div class="mt-1 text-center"><b>${val.nombre}</b></div>
            <div >${val.resumen_actividad}</div>
          </label>              
        </div>
        <div class="text-center h-1px">
          <button type="button" class="btn btn-warning btn-sm p-1" onclick="ir_a_detalle_tours(${val.idtours},'${removeCaracterEspecial_v2(val.nombre)}')" style="position: relative; top: -30px; "><i class="fas fa-eye"></i></button>
          <!-- <button type="button" class="btn btn-warning btn-sm p-1"><i class="fas fa-images"></i></button> -->
        </div>
      </div>`);
      $(`#idtours_${val.idtours}`).rules('add', { required: true, messages: {  required: "Campo requerido" } });
    });

    $('.html-tours-lista').append(`<div class="col-lg-12">
      <div class="m-3">
        <h5 class="cuestion1"><i class="fa-solid fa-forward"></i> Haganos saber aqui si desea visitar otros lugares no mencionados anteriormente.... </h5>
        <div class="form-group">
          <textarea class="form-control" name="otro_lugar" id="" rows="3"></textarea>
        </div>   
      </div>                    
    </div>`);

  });

}

function ir_a_detalle_tours(id, nombre) {

  localStorage.setItem('nube_idtours', id);

  var anchor = document.createElement('a');
  anchor.href = window.location.host =='localhost' || es_numero(parseFloat(window.location.host)) == true ?`${window.location.origin}/fun_route/detalle-tours.html#${nombre}`: `${window.location.origin}/detalle-tours.html#${nombre}`;
  anchor.target="_blank";
  anchor.click();  
}

function limpiar_form_correo() {

  $(".idtours").attr( 'checked', false ).trigger("change");
  $("input[name=tipoviaje]").attr( 'checked', false ).trigger("change");
  $("input[name=ocacion_viaje]").attr( 'checked', false ).trigger("change");
  $("input[name=presupuesto]").attr( 'checked', false ).trigger("change");
  $("input[name=hotel]").attr( 'checked', false ).trigger("change");

  $("form input[type=text], form input[type=number], form input[type=email], form textarea").each(function() { this.value = '' });  

  // Limpiamos las validaciones
  $(".form-control").removeClass('is-valid');
  $(".form-control").removeClass('is-invalid');
  $(".error.invalid-feedback").remove();
}

function agregar_y_editar_viaje(e) {
  // e.preventDefault(); //No se activará la acción predeterminada del evento
  var formData = new FormData($("#form-viaje-a-medida")[0]);
 
  $.ajax({
    url: "controlador/viaje_a_medida.php?op=agregar_y_editar_viaje",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (e) {
      try {
        e = JSON.parse(e);  console.log(e);
        if ( e.status == true) {
          Swal.fire("Correcto!", "Cotizacion enviado.", "success");         
          limpiar_form_correo(); // limpiamos el formulario
        }else{
          ver_errores(e);
        }
      } catch (err) { console.log('Error: ', err.message); toastr.error('<h5 class="font-size-16px">Error temporal!!</h5> puede intentalo mas tarde, o comuniquese con <i><a href="tel:+51921305769" >921-305-769</a></i> ─ <i><a href="tel:+51921487276" >921-487-276</a></i>'); }      

      $(".btn-enviar-mensaje").html('Enviar Mensaje').removeClass('disabled');
      
    },
    xhr: function () {
      var xhr = new window.XMLHttpRequest();
      xhr.upload.addEventListener("progress", function (evt) {
        if (evt.lengthComputable) {
          var percentComplete = (evt.loaded / evt.total)*100;
          console.log(percentComplete + '%');
          $("#barra_progress_correo").css({"width": percentComplete+'%'}).text(percentComplete.toFixed(2)+" %");
        }
      }, false);
      return xhr;
    },
    beforeSend: function () {
      $(".btn-enviar-mensaje").html('<i class="fas fa-spinner fa-pulse fa-lg"></i> Enviando...').addClass('disabled');
      $("#barra_progress_correo").css({ width: "0%",  }).text("0%");
    },
    complete: function () {
      $("#barra_progress_correo").css({ width: "0%", }).text("0%");
    },
    error: function (jqXhr) { ver_errores(jqXhr); },
  });
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



$(function () {

  $("#form-viaje-a-medida").validate({
    ignore: false,
    rules: {       
      otro_lugar:         { minlength: 4, maxlength: 100 }, 
      tipoviaje:          { required: true }, 
      ocacion_viaje:        { required: true }, 
      presupuesto:        { required: true }, 
      hotel:              { required: true }, 

      nombre_y_apellidos: { required: true, minlength: 4, maxlength: 45 }, 
      correo_persona:     { required: true, email: true, minlength: 4, maxlength: 45 }, 
      numero_celular:     { required: true, minlength: 4, maxlength: 9 }, 
      p_tipo_contacto:    { required: true },       
      p_descripcion:      { minlength: 4, maxlength: 100 },       
    },
    messages: {
      tipoviaje:          { required: "CON QUIEN VIAJA campo requerido", },
      ocacion_viaje:      { required: "MOTIVO DE VIAJE campo requerido", },
      presupuesto:        { required: "PRESUPUESTO campo requerido", },
      hotel:              { required: "HOTEL campo requerido", },

      nombre_y_apellidos: { required: "NOMBRE campo requerido", },
      correo_persona:     { required: "CORREO campo requerido", email: 'Ingrese un correo válido' },
      numero_celular:     { required: "CELULAR campo requerido", maxlength: "Maximo {0} caracteres" },
      p_tipo_contacto:    { required: "TIPO CONTACTO campo requerido", },
      p_descripcion:      { minlength: "Minimo {0} caracteres", maxlength: "Maximo {0} caracteres", },
    },
        
    errorElement: "span",

    errorPlacement: function (error, element) { 
      error.addClass("invalid-feedback"); toastr_error('Rellenar!!', error.text());
      element.closest(".form-group").append(error);
    },

    highlight: function (element, errorClass, validClass) {
      $(element).addClass("is-invalid").removeClass("is-valid");
    },

    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass("is-invalid").addClass("is-valid");   
    },
    submitHandler: function (e) {
      agregar_y_editar_viaje(e);      
    },
  });

  init();
});