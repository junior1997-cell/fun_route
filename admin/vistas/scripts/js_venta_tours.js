// .......::::::::::::::::::::::::::::::::::::::::: AGREGAR FACURAS, BOLETAS, NOTA DE VENTA, ETC :::::::::::::::::::::::::::::::::::.......
//Declaración de variables necesarias para trabajar con las ventas y sus detalles
var impuesto = 18;
var cont = 0;
var detalles = 0;

function agregarDetalleComprobante(idtours, individual) {
  
  // var precio_venta = 0;
  var precio_sin_igv =0;
  var cantidad = 1;
  var descuento = 0;
  var precio_igv = 0;

  if (idtours != "") {    

    if ($(`.producto_${idtours}`).hasClass("producto_selecionado") && individual == false ) {    
      if (document.getElementsByClassName(`.producto_${idtours}`).length == 1) {
        var cant_producto = $(`.producto_${idtours}`).val();
        var sub_total = parseInt(cant_producto, 10) + 1;
        $(`.producto_${idtours}`).val(sub_total).trigger('change');
        toastr_success("Agregado!!",`Producto: ${$(`.nombre_producto_${e.data.idtours}`)[0].innerText} agregado !!`, 700);
        modificarSubtotales();      
      }      
    } else {         
      $.post("../ajax/ajax_general.php?op=mostrar_producto_tours", {'idtours': idtours}, function (e, textStatus, jqXHR) {          
        
        e = JSON.parse(e); console.log(e);
        if (e.status == true) {         

          if ($("#tipo_comprobante").select2("val") == "Factura") {
            var subtotal = cantidad * e.data.costo;
          } else {
            var subtotal = cantidad * e.data.costo;
          }

          var img_p = e.data.imagen == "" || e.data.imagen == null ?img_p = `../dist/docs/tours/perfil/tours-sin-foto.jpg` : `../dist/docs/tours/perfil/${e.data.imagen}` ;          

          var fila = `
          <tr class="filas" id="fila${cont}">         
            <td class="py-1">
              <button type="button" class="btn btn-warning btn-sm" onclick="mostrar_productos(${e.data.idtours}, ${cont})"><i class="fas fa-pencil-alt"></i></button>
              <button type="button" class="btn btn-danger btn-sm btn-file-delete-${cont}" onclick="recover_stock(${e.data.idtours}, ${cont}, 0, 'recover_remove_new');"><i class="fas fa-times"></i></button>
            </td>
            <td class="py-1">         
              <input type="hidden" name="idtours[]" value="${e.data.idtours}">
              <div class="user-block text-nowrap">
                <img class="profile-user-img img-responsive img-circle cursor-pointer img_perfil_${cont}" src="${img_p}" alt="user image" onerror="this.src='../dist/svg/404-v2.svg';" onclick="ver_img_producto('${img_p}', '${encodeHtml(e.data.nombre)}')">
                <span class="username"><p class="mb-0 nombre_producto_${e.data.idtours}">${e.data.nombre}</p></span>
                <span class="description categoria_${cont}"><b>Dcto: </b> ${parseFloat(e.data.porcentaje_descuento)}%<b> |<b>tipo: </b>${e.data.tipo_tours}</span>
              </div>
            </td>
            <td class="py-1">
              <span class="unidad_medida_${cont}">UNIDAD</span> 
              <input type="hidden" class="unidad_medida_${cont}" name="unidad_medida[]" id="unidad_medida[]" value="UNIDAD">
              <input class="tipo_tours_${cont}" type="hidden" name="tipo_tours[]" id="tipo_tours[]" value="${e.data.tipo_tours}">
            </td>
            <td class="py-1 form-group">
              <input type="number" class="w-100px valid_cantidad form-control producto_${e.data.idtours} producto_selecionado" name="valid_cantidad[${cont}]" id="valid_cantidad_${cont}" value="${cantidad}" min="0.01" required onkeyup="replicar_value_input(${cont}, '#cantidad_${cont}', this); update_price(); " onchange="replicar_value_input(${cont}, '#cantidad_${cont}', this); update_price(); ">
              <input type="hidden" class="cantidad_${cont}" name="cantidad[]" id="cantidad_${cont}" value="${cantidad}" min="0.01" required  >            
            </td>            
            <td class="py-1 form-group">
              <input type="number" class="w-135px form-control valid_precio_con_igv" name="valid_precio_con_igv[${cont}]" id="valid_precio_con_igv_${cont}" value="${e.data.costo}" min="0.01" required onkeyup="replicar_value_input(${cont}, '#precio_con_igv_${cont}', this); update_price(); " onchange="replicar_value_input(${cont}, '#precio_con_igv_${cont}', this); update_price(); ">
              <input type="hidden" class="precio_con_igv_${cont}" name="precio_con_igv[]" id="precio_con_igv_${cont}" value="${e.data.costo}" onkeyup="modificarSubtotales();" onchange="modificarSubtotales();">              
              <input type="number" class="w-135px input-no-border precio_sin_igv_${cont}" name="precio_sin_igv[]" id="precio_sin_igv[]" value="0" readonly min="0" >
              <input type="number" class="w-135px input-no-border precio_igv_${cont}" name="precio_igv[]" id="precio_igv[]" value="0" readonly  >
            </td>        
            <td class="py-1 form-group">
              <input type="number" class="w-135px form-control descuento_${cont}" name="descuento[]" value="${ ( e.data.estado_descuento == 0 ? 0 : ( e.data.monto_descuento )) }" min="0.00" onkeyup="modificarSubtotales()" onchange="modificarSubtotales()">
            </td>
            <td class="py-1 text-right"><span class="text-right subtotal_producto_${cont}" name="subtotal_producto" id="subtotal_producto">${subtotal}</span></td>
            <td class="py-1"><button type="button" onclick="modificarSubtotales()" class="btn btn-info btn-sm"><i class="fas fa-sync"></i></button></td>
          </tr>`;

          detalles = detalles + 1;
          $("#detalles").append(fila);
          array_data_venta.push({ id_cont: cont });
          modificarSubtotales();        
          toastr_success("Agregado!!",`Producto: ${e.data.nombre} agregado !!`, 700);

          // reglas de validación     
          $('.valid_precio_con_igv').each(function(e) { 
            $(this).rules('add', { required: true, messages: { required: 'Campo requerido' } }); 
            $(this).rules('add', { min:0.01, messages: { min:"Mínimo 0.01" } }); 
          });
          $('.valid_cantidad').each(function(e) { 
            $(this).rules('add', { required: true, messages: { required: 'Campo requerido' } }); 
            $(this).rules('add', { min:0.01, messages: { min:"Mínimo 0.01" } }); 
          });

          cont++;
          evaluar();    
        } else {
          ver_errores(e);
        }   
      });  
    }
  } else {
    // alert("Error al ingresar el detalle, revisar los datos del artículo");
    toastr_error("Error!!",`Error al ingresar el detalle, revisar los datos del producto.`, 700);
  }
}

function evaluar() {
  if (detalles > 0) {
    $("#guardar_registro_ventas").show();
  } else {
    $("#guardar_registro_ventas").hide();
    cont = 0;
    $(".subtotal_compra").html("S/ 0.00");
    $("#subtotal_compra").val(0);

    $(".igv_venta").html("S/ 0.00");
    $("#igv_venta").val(0);

    $(".total_venta").html("S/ 0.00");
    $("#total_compra").val(0);
  }
}

function default_val_igv() { if ($("#tipo_comprobante").select2("val") == "Factura") { $("#val_igv").val(0.18); } }

function modificarSubtotales() {  

  var val_igv = $('#val_igv').val(); //console.log(array_data_venta);

  if ($("#tipo_comprobante").select2("val") == null) {

    $("#colspan_subtotal").attr("colspan", 5); //cambiamos el: colspan

    $("#val_igv").val(0);
    $("#val_igv").prop("readonly",true);
    $(".val_igv").html('IGV (0%)');

    $("#tipo_gravada").val('NO GRAVADA');
    $(".tipo_gravada").html('NO GRAVADA');

    if (array_data_venta.length === 0) {
    } else {
      array_data_venta.forEach((element, index) => {
        var cantidad = parseFloat($(`.cantidad_${element.id_cont}`).val());
        var precio_con_igv = parseFloat($(`.precio_con_igv_${element.id_cont}`).val());
        var deacuento = parseFloat($(`.descuento_${element.id_cont}`).val());
        var subtotal_producto = 0;

        // Calculamos: IGV
        var precio_sin_igv = precio_con_igv;
        $(`.precio_sin_igv_${element.id_cont}`).val(precio_sin_igv);

        // Calculamos: precio + IGV
        var igv = 0;
        $(`.precio_igv_${element.id_cont}`).val(igv);

        // Calculamos: Subtotal de cada producto
        subtotal_producto = cantidad * parseFloat(precio_con_igv) - deacuento;
        $(`.subtotal_producto_${element.id_cont}`).html(formato_miles(subtotal_producto.toFixed(4)));
      });
      calcularTotalesSinIgv();
    }
  } else if ($("#tipo_comprobante").select2("val") == "Nota de venta") {    
    $("#colspan_subtotal").attr("colspan", 7); //cambiamos el: colspan      
    $("#val_igv").prop("readonly",false);

    if (array_data_venta.length === 0) {
      if (val_igv == '' || val_igv <= 0) {
        $("#tipo_gravada").val('NO GRAVADA');
        $(".tipo_gravada").html('NO GRAVADA');
        $(".val_igv").html(`IGV (0%)`);
      } else {
        $("#tipo_gravada").val('GRAVADA');
        $(".tipo_gravada").html('GRAVADA');
        $(".val_igv").html(`IGV (${(parseFloat(val_igv) * 100).toFixed(2)}%)`);
      }
      
    } else {
      // validamos el valor del igv ingresado        

      array_data_venta.forEach((element, index) => {
        var cantidad = parseFloat($(`.cantidad_${element.id_cont}`).val());
        var precio_con_igv = parseFloat($(`.precio_con_igv_${element.id_cont}`).val());
        var deacuento = parseFloat($(`.descuento_${element.id_cont}`).val());
        var subtotal_producto = 0;

        // Calculamos: Precio sin IGV
        var precio_sin_igv = ( quitar_igv_del_precio(precio_con_igv, val_igv, 'decimal')).toFixed(2);
        $(`.precio_sin_igv_${element.id_cont}`).val(precio_sin_igv);

        // Calculamos: IGV
        var igv = (parseFloat(precio_con_igv) - parseFloat(precio_sin_igv)).toFixed(2);
        $(`.precio_igv_${element.id_cont}`).val(igv);

        // Calculamos: Subtotal de cada producto
        subtotal_producto = cantidad * parseFloat(precio_con_igv) - deacuento;
        $(`.subtotal_producto_${element.id_cont}`).html(formato_miles(subtotal_producto.toFixed(2)));
      });

      calcularTotalesConIgv();
    }
  } else {

    $("#colspan_subtotal").attr("colspan", 5); //cambiamos el: colspan

    $("#val_igv").val(0);
    $("#val_igv").prop("readonly",true);
    $(".val_igv").html('IGV (0%)');

    $("#tipo_gravada").val('NO GRAVADA');
    $(".tipo_gravada").html('NO GRAVADA');

    if (array_data_venta.length === 0) {
    } else {
      array_data_venta.forEach((element, index) => {
        var cantidad = parseFloat($(`.cantidad_${element.id_cont}`).val());
        var precio_con_igv = parseFloat($(`.precio_con_igv_${element.id_cont}`).val());
        var deacuento = parseFloat($(`.descuento_${element.id_cont}`).val());
        var subtotal_producto = 0;

        // Calculamos: IGV
        var precio_sin_igv = precio_con_igv;
        $(`.precio_sin_igv_${element.id_cont}`).val(precio_sin_igv);

        // Calculamos: precio + IGV
        var igv = 0;
        $(`.precio_igv_${element.id_cont}`).val(igv);

        // Calculamos: Subtotal de cada producto
        subtotal_producto = cantidad * parseFloat(precio_con_igv) - deacuento;
        $(`.subtotal_producto_${element.id_cont}`).html(formato_miles(subtotal_producto.toFixed(4)));
      });

      calcularTotalesSinIgv();
    }
  }
    
  capturar_pago_compra();
}

function calcularTotalesSinIgv() {
  var total = 0.0;
  var igv = 0;
  var mtotal = 0;

  if (array_data_venta.length === 0) {
  } else {
    array_data_venta.forEach((element, index) => {
      total += parseFloat(quitar_formato_miles($(`.subtotal_producto_${element.id_cont}`).text()));
    });

    $(".subtotal_compra").html("S/ " + formato_miles(total));
    $("#subtotal_compra").val(redondearExp(total, 4));

    $(".igv_venta").html("S/ 0.00");
    $("#igv_venta").val(0.0);
    $(".val_igv").html('IGV (0%)');

    $(".total_venta").html("S/ " + formato_miles(total.toFixed(2)));
    $("#total_venta").val(redondearExp(total, 4));
  }
}

function calcularTotalesConIgv() {
  var val_igv = $('#val_igv').val();
  var igv = 0;
  var total = 0.0;

  var subotal_sin_igv = 0;

  array_data_venta.forEach((element, index) => {
    total += parseFloat(quitar_formato_miles($(`.subtotal_producto_${element.id_cont}`).text()));
  });

  //console.log(total); 

  subotal_sin_igv = quitar_igv_del_precio(total, val_igv, 'decimal').toFixed(2);
  igv = (parseFloat(total) - parseFloat(subotal_sin_igv)).toFixed(2);

  $(".subtotal_compra").html(`S/ ${formato_miles(subotal_sin_igv)}`);
  $("#subtotal_compra").val(redondearExp(subotal_sin_igv, 4));

  $(".igv_venta").html("S/ " + formato_miles(igv));
  $("#igv_venta").val(igv);

  $(".total_venta").html("S/ " + formato_miles(total.toFixed(2)));
  $("#total_venta").val(redondearExp(total, 4));

  total = 0.0;
}

function ocultar_comprob() {
  if ($("#tipo_comprobante").select2("val") == "Ninguno") {
    $("#content-serie-comprobante").hide().val("");
    $("#content-numero-comprobante").hide().val("");
    $("#content-descripcion").removeClass("col-lg-5").addClass("col-lg-9");
  } else {
    $("#content-serie-comprobante").show();
    $("#content-numero-comprobante").show();
    $("#content-descripcion").removeClass("col-lg-9").addClass("col-lg-5");
  }
}

function eliminarDetalle(idtours, indice) {
  $("#fila" + indice).remove();
  array_data_venta.forEach(function (car, index, object) { if (car.id_cont === indice) { object.splice(index, 1); } });
  modificarSubtotales();
  detalles = detalles - 1;
  evaluar();
  toastr_warning("Removido!!","Producto removido", 700);
}

//mostramos para editar el datalle del comprobante de la ventas
function mostrar_venta(idventa_producto) {

  $("#cargando-1-fomulario").hide();
  $("#cargando-2-fomulario").show();

  limpiar_form_compra();
  array_data_venta = [];

  cont = 0;
  detalles = 0;
  table_show_hide(2);

  $.post("../ajax/venta_tours.php?op=ver_venta_editar", { idventa_producto: idventa_producto }, function (e, status) {
    
    e = JSON.parse(e); //console.log(e);

    if (e.status == true) {
      
      if (e.data.venta.tipo_comprobante == "Factura") {
        $(".content-igv").show();
        $(".content-tipo-comprobante").removeClass("col-lg-5 col-lg-4").addClass("col-lg-4");
        $(".content-descripcion").removeClass("col-lg-4 col-lg-5 col-lg-7 col-lg-8").addClass("col-lg-5");
        $(".content-serie-comprobante").show();
      } else if (e.data.venta.tipo_comprobante == "Boleta" || e.data.venta.tipo_comprobante == "Nota de venta") {
        $(".content-serie-comprobante").show();
        $(".content-igv").hide();
        $(".content-tipo-comprobante").removeClass("col-lg-4 col-lg-5").addClass("col-lg-5");
        $(".content-descripcion").removeClass(" col-lg-4 col-lg-5 col-lg-7 col-lg-8").addClass("col-lg-5");
      } else if (e.data.venta.tipo_comprobante == "Ninguno") {
        $(".content-serie-comprobante").hide();
        $(".content-serie-comprobante").val("");
        $(".content-igv").hide();
        $(".content-tipo-comprobante").removeClass("col-lg-5 col-lg-4").addClass("col-lg-4");
        $(".content-descripcion").removeClass(" col-lg-4 col-lg-5 col-lg-7").addClass("col-lg-8");
      } else {
        $(".content-serie-comprobante").show();
        //$(".content-descripcion").removeClass("col-lg-7").addClass("col-lg-4");
      }

      $("#idventa_producto").val(e.data.venta.idventa_producto);
      $("#idcliente").val(e.data.venta.idpersona).trigger("change");
      $("#fecha_venta").val(e.data.venta.fecha_venta);
      $("#tipo_comprobante").val(e.data.venta.tipo_comprobante).trigger("change");
      $("#serie_comprobante").val(e.data.venta.serie_comprobante).trigger("change");
      $("#val_igv").val(e.data.venta.val_igv);
      $("#descripcion").val(e.data.venta.descripcion);

      $("#metodo_pago").val(e.data.venta.metodo_pago).trigger("change");
      $("#fecha_proximo_pago").val(e.data.venta.fecha_proximo_pago);

      if (e.data.detalle) {

        e.data.detalle.forEach((val, index) => {

          var img = "";

          if (val.imagen == "" || val.imagen == null) {
            img = `../dist/docs/producto/img_perfil/producto-sin-foto.svg`;
          } else {
            img = `../dist/docs/producto/img_perfil/${val.imagen}`;
          }

          recover_stock(val.idtours, cont, val.cantidad );

          var fila = `
          <tr class="filas" id="fila${cont}">
            <td>
              <button type="button" class="btn btn-warning btn-sm" onclick="mostrar_productos(${val.idtours}, ${cont})"><i class="fas fa-pencil-alt"></i></button>
              <button type="button" class="btn btn-danger btn-sm btn-file-delete-${cont}" onclick="recover_stock(${val.idtours}, ${cont}, 0, 'recover_remove_edit');"><i class="fas fa-times"></i></button></td>
            </td>
            <td>
              <input type="hidden" name="idtours[]" value="${val.idtours}">
              <div class="user-block text-nowrap">
                <img class="profile-user-img img-responsive img-circle cursor-pointer img_perfil_${cont}" src="${img}" alt="user image" onerror="this.src='../dist/svg/404-v2.svg';" onclick="ver_img_producto('${img}', '${encodeHtml(val.nombre)}')">
                <span class="username"><p class="mb-0 nombre_producto_${cont}" >${val.nombre}</p></span>
                <span class="description categoria_${cont}"><b>Categoría: </b>${val.categoria}</span>
              </div>
            </td>
            <td> <span class="unidad_medida_${cont}">${val.unidad_medida}</span> <input class="unidad_medida_${cont}" type="hidden" name="unidad_medida[]" id="unidad_medida[]" value="${val.unidad_medida}"> <input class="categoria_${cont}" type="hidden" name="categoria[]" id="categoria[]" value="${val.categoria}"></td>            
            <td class="py-1 form-group">
              <input class="w-100px valid_cantidad form-control producto_${val.idtours} producto_selecionado" type="number" name="valid_cantidad[${cont}]" id="valid_cantidad_${cont}" value="${val.cantidad}" min="0.01" required onkeyup="replicar_value_input(${cont}, '#cantidad_${cont}', this);" onchange="replicar_value_input(${cont}, '#cantidad_${cont}', this);">
              <input type="hidden" class="cantidad_${cont}" name="cantidad[]" id="cantidad_${cont}" value="${val.cantidad}" onkeyup="update_stock(${val.idtours},${cont});" onchange="update_stock(${val.idtours},${cont});">              
              <input type="hidden" class="" name="cantidad_old[]" id="cantidad_old_${cont}" value="${val.cantidad}">
            </td>
            <td class="hidden"><input type="number" class="w-135px input-no-border precio_sin_igv_${cont}" name="precio_sin_igv[]" id="precio_sin_igv[]" value="${val.precio_sin_igv}" readonly ></td>
            <td class="hidden"><input type="number" class="w-135px input-no-border precio_igv_${cont}" name="precio_igv[]" id="precio_igv[]" value="${val.igv}" readonly ></td>             
            <td class="py-1 form-group">
              <input type="number" class="w-135px form-control valid_precio_con_igv" name="valid_precio_con_igv[${cont}]" id="valid_precio_con_igv_${cont}" value="${parseFloat(val.precio_con_igv).toFixed(2)}" min="0.01" required onkeyup="replicar_value_input(${cont}, '#precio_con_igv_${cont}', this);" onchange="replicar_value_input(${cont}, '#precio_con_igv_${cont}', this);">
              <input type="hidden" class="precio_con_igv_${cont}" name="precio_con_igv[]" id="precio_con_igv_${cont}" value="${parseFloat(val.precio_con_igv).toFixed(2)}" onkeyup="modificarSubtotales();" onchange="modificarSubtotales();">
              <input type="hidden" name="precio_compra[]" id="precio_compra_${cont}" value="${val.precio_compra}" >
            </td>
            <td class="py-1 form-group">
              <input type="number" class="w-135px form-control descuento_${cont}" name="descuento[]" value="${val.descuento}" min="0.00" onkeyup="modificarSubtotales()" onchange="modificarSubtotales()">
            </td>
            <td class="text-right"><span class="text-right subtotal_producto_${cont}" name="subtotal_producto" id="subtotal_producto">0.00</span></td>
            <td><button type="button" onclick="modificarSubtotales()" class="btn btn-info btn-sm"><i class="fas fa-sync"></i></button></td>
          </tr>`;

          detalles = detalles + 1;

          $("#detalles").append(fila);

          array_data_venta.push({ id_cont: cont });

          // reglas de validación     
          $('.valid_precio_con_igv').each(function(e) { 
            $(this).rules('add', { required: true, messages: { required: 'Campo requerido' } }); 
            $(this).rules('add', { min:0.01, messages: { min:"Mínimo 0.01" } }); 
          });
          $('.valid_cantidad').each(function(e) { 
            $(this).rules('add', { required: true, messages: { required: 'Campo requerido' } }); 
            $(this).rules('add', { min:0.01, messages: { min:"Mínimo 0.01" } }); 
          });

          cont++;
          evaluar();
        });

        modificarSubtotales();
      } else {  
        toastr_error("Sin productos!!","Este registro no tiene productos para mostrar", 700);     
      }

      $("#cargando-1-fomulario").show();
      $("#cargando-2-fomulario").hide();
      
    } else {
      ver_errores(e);
    }
    
  }).fail( function(e) { ver_errores(e); } );
}

//mostramos para editar el datalle del comprobante de la ventas
function copiar_venta(idventa_producto) {

  $("#cargando-1-fomulario").hide();
  $("#cargando-2-fomulario").show();

  limpiar_form_compra();
  array_data_venta = [];

  cont = 0;
  detalles = 0;
  table_show_hide(2);

  $.post("../ajax/venta_tours.php?op=ver_venta_editar", { idventa_producto: idventa_producto }, function (e, status) {
    
    e = JSON.parse(e); //console.log(e);

    if (e.status == true) {
      
      if (e.data.venta.tipo_comprobante == "Factura") {
        $(".content-igv").show();
        $(".content-tipo-comprobante").removeClass("col-lg-5 col-lg-4").addClass("col-lg-4");
        $(".content-descripcion").removeClass("col-lg-4 col-lg-5 col-lg-7 col-lg-8").addClass("col-lg-5");
        $(".content-serie-comprobante").show();
      } else if (e.data.venta.tipo_comprobante == "Boleta" || e.data.venta.tipo_comprobante == "Nota de venta") {
        $(".content-serie-comprobante").show();
        $(".content-igv").hide();
        $(".content-tipo-comprobante").removeClass("col-lg-4 col-lg-5").addClass("col-lg-5");
        $(".content-descripcion").removeClass(" col-lg-4 col-lg-5 col-lg-7 col-lg-8").addClass("col-lg-5");
      } else if (e.data.venta.tipo_comprobante == "Ninguno") {
        $(".content-serie-comprobante").hide();
        $(".content-serie-comprobante").val("");
        $(".content-igv").hide();
        $(".content-tipo-comprobante").removeClass("col-lg-5 col-lg-4").addClass("col-lg-4");
        $(".content-descripcion").removeClass(" col-lg-4 col-lg-5 col-lg-7").addClass("col-lg-8");
      } else {
        $(".content-serie-comprobante").show();
        //$(".content-descripcion").removeClass("col-lg-7").addClass("col-lg-4");
      }

      // $("#idventa_producto").val(e.data.venta.idventa_producto); // esto no se usa cuando duplicams la factura
      $("#idcliente").val(e.data.venta.idpersona).trigger("change");
      $("#fecha_venta").val(e.data.venta.fecha_venta);
      $("#tipo_comprobante").val(e.data.venta.tipo_comprobante).trigger("change");
      $("#serie_comprobante").val(e.data.venta.serie_comprobante).trigger("change");
      $("#val_igv").val(e.data.venta.val_igv);
      $("#descripcion").val(e.data.venta.descripcion);

      $("#metodo_pago").val(e.data.venta.metodo_pago).trigger("change");
      $("#fecha_proximo_pago").val(e.data.venta.fecha_proximo_pago);

      if (e.data.detalle) {

        e.data.detalle.forEach((val, index) => {

          var img = "";

          if (val.imagen == "" || val.imagen == null) {
            img = `../dist/docs/producto/img_perfil/producto-sin-foto.svg`;
          } else {
            img = `../dist/docs/producto/img_perfil/${val.imagen}`;
          }    

          var fila = `
          <tr class="filas" id="fila${cont}">
            <td>
              <button type="button" class="btn btn-warning btn-sm" onclick="mostrar_productos(${val.idtours}, ${cont})"><i class="fas fa-pencil-alt"></i></button>
              <button type="button" class="btn btn-danger btn-sm btn-file-delete-${cont}" onclick="recover_stock(${val.idtours}, ${cont}, 0, 'recover_remove_new');"><i class="fas fa-times"></i></button></td>
            </td>
            <td>
              <input type="hidden" name="idtours[]" value="${val.idtours}">
              <div class="user-block text-nowrap">
                <img class="profile-user-img img-responsive img-circle cursor-pointer img_perfil_${cont}" src="${img}" alt="user image" onerror="this.src='../dist/svg/404-v2.svg';" onclick="ver_img_producto('${img}', '${encodeHtml(val.nombre)}')">
                <span class="username"><p class="mb-0 nombre_producto_${cont}" >${val.nombre}</p></span>
                <span class="description categoria_${cont}"><b>Categoría: </b>${val.categoria}</span>
              </div>
            </td>
            <td> <span class="unidad_medida_${cont}">${val.unidad_medida}</span> <input class="unidad_medida_${cont}" type="hidden" name="unidad_medida[]" id="unidad_medida[]" value="${val.unidad_medida}"> <input class="categoria_${cont}" type="hidden" name="categoria[]" id="categoria[]" value="${val.categoria}"></td>            
            <td class="py-1 form-group">
              <input class="w-100px valid_cantidad form-control producto_${val.idtours} producto_selecionado" type="number" name="valid_cantidad[${cont}]" id="valid_cantidad_${cont}" value="${val.cantidad}" min="0.01" required onkeyup="replicar_value_input(${cont}, '#cantidad_${cont}', this);" onchange="replicar_value_input(${cont}, '#cantidad_${cont}', this);">
              <input type="hidden" class="cantidad_${cont}" name="cantidad[]" id="cantidad_${cont}" value="${val.cantidad}" onkeyup="update_stock(${val.idtours},${cont});" onchange="update_stock(${val.idtours},${cont});">              
              <input type="hidden" class="" name="cantidad_old[]" id="cantidad_old_${cont}" value="${val.cantidad}">
            </td>
            <td class="hidden"><input type="number" class="w-135px input-no-border precio_sin_igv_${cont}" name="precio_sin_igv[]" id="precio_sin_igv[]" value="${val.precio_sin_igv}" readonly ></td>
            <td class="hidden"><input type="number" class="w-135px input-no-border precio_igv_${cont}" name="precio_igv[]" id="precio_igv[]" value="${val.igv}" readonly ></td>             
            <td class="py-1 form-group">
              <input type="number" class="w-135px form-control valid_precio_con_igv" name="valid_precio_con_igv[${cont}]" id="valid_precio_con_igv_${cont}" value="${parseFloat(val.precio_con_igv).toFixed(2)}" min="0.01" required onkeyup="replicar_value_input(${cont}, '#precio_con_igv_${cont}', this);" onchange="replicar_value_input(${cont}, '#precio_con_igv_${cont}', this);">
              <input type="hidden" class="precio_con_igv_${cont}" name="precio_con_igv[]" id="precio_con_igv_${cont}" value="${parseFloat(val.precio_con_igv).toFixed(2)}" onkeyup="modificarSubtotales();" onchange="modificarSubtotales();">
              <input type="hidden" name="precio_compra[]" id="precio_compra_${cont}" value="${val.precio_compra}" >
            </td>
            <td class="py-1 form-group">
              <input type="number" class="w-135px form-control descuento_${cont}" name="descuento[]" value="${val.descuento}" min="0.00" onkeyup="modificarSubtotales()" onchange="modificarSubtotales()">
            </td>
            <td class="text-right"><span class="text-right subtotal_producto_${cont}" name="subtotal_producto" id="subtotal_producto">0.00</span></td>
            <td><button type="button" onclick="modificarSubtotales()" class="btn btn-info btn-sm"><i class="fas fa-sync"></i></button></td>
          </tr>`;

          detalles = detalles + 1;

          $("#detalles").append(fila);

          array_data_venta.push({ id_cont: cont });

          // reglas de validación     
          $('.valid_precio_con_igv').each(function(e) { 
            $(this).rules('add', { required: true, messages: { required: 'Campo requerido' } }); 
            $(this).rules('add', { min:0.01, messages: { min:"Mínimo 0.01" } }); 
          });
          $('.valid_cantidad').each(function(e) { 
            $(this).rules('add', { required: true, messages: { required: 'Campo requerido' } }); 
            $(this).rules('add', { min:0.01, messages: { min:"Mínimo 0.01" } }); 
          });

          update_stock(val.idtours, cont);

          cont++;
          evaluar();
        });

        modificarSubtotales();
      } else {  
        toastr_error("Sin productos!!","Este registro no tiene productos para mostrar", 700);     
      }

      $("#cargando-1-fomulario").show();
      $("#cargando-2-fomulario").hide();
      
    } else {
      ver_errores(e);
    }
    
  }).fail( function(e) { ver_errores(e); } );
}

//mostramos el detalle del comprobante de la ventas
function ver_detalle_ventas(idventa_producto) {

  $("#cargando-5-fomulario").hide();
  $("#cargando-6-fomulario").show();

  $("#print_pdf_compra").addClass('disabled');
  $("#excel_compra").addClass('disabled');

  $("#modal-ver-ventas").modal("show");

  $.post(`../ajax/ajax_general.php?op=ver_detalle_ventas&idventa_producto=${idventa_producto}`, function (e) {
    e = JSON.parse(e); console.log(e);
    if (e.status == true) {
      $(".detalle_de_compra").html(e.data); 
      $("#cargando-5-fomulario").show();
      $("#cargando-6-fomulario").hide();

      $("#excel_compra").removeClass('disabled').attr('href', `../reportes/export_xlsx_venta_tours.php?id=${idventa_producto}`);
      $("#print_pdf_compra").removeClass('disabled').attr('href', `../reportes/pdf_venta_productos.php?id=${idventa_producto}` );
      
    } else {
      ver_errores(e);
    }    
  }).fail( function(e) { ver_errores(e); } );
}

function update_price() {
  toastr_success("Actualizado!!",`Precio Actualizado.`, 700);
}

function autoincrement_comprobante(data) {
  var comprobante = $(data).select2('val');  

  if (comprobante == null || comprobante == '' ) {
    $('#serie_comprobante').val("");
  } else {
    
    $.post(`../ajax/ajax_general.php?op=autoincrement_comprobante`, function (e, textStatus, jqXHR) {
      e = JSON.parse(e); //console.log(e);

      if (comprobante == 'Boleta') {
        $('#serie_comprobante').val(`B-${e.data.venta_producto_b}`);
      } else if (comprobante == 'Factura'){
        $('#serie_comprobante').val(`F-${e.data.venta_producto_f}`);
      } else if (comprobante == 'Nota de venta'){
        $('#serie_comprobante').val(`NV-${e.data.venta_producto_nv}`);
      }
      
    },);
  }
}

function capturar_pago_compra() {

  $(".span-pago-compra").html('(Seleccione metodo pago)'); 
  var metodo_pago = $("#metodo_pago").val();

  // si se edita, no se puede modificar estos datos  
  if ($("#metodo_pago").select2("val") == null) {
    $("#content-code-baucher").hide(); 
  } else if ($("#metodo_pago").select2("val") == "CONTADO") { 
    $("#content-code-baucher").hide();     
    $(".span-pago-compra").html(`(${metodo_pago})`);
  } else if ($("#metodo_pago").select2("val") == "CREDITO") {
    $("#content-code-baucher").hide();    
  } else {   
    
    $("#content-code-baucher").show();    
    $(".span-pago-compra").html(`(${metodo_pago})`);     
  }  
}