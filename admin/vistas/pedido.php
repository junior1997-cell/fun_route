<?php
//Activamos el almacenamiento en el buffer
ob_start();

session_start();
if (!isset($_SESSION["nombre"])) {
  header("Location: index.php?file=" . basename($_SERVER['PHP_SELF']));
} else {
?>

  <!DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Pedidos | Admin Fun Route</title>


    <?php $title = "Pedidos";
    require 'head.php'; ?>

    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="../plugins/ekko-lightbox/ekko-lightbox.css">
    <link rel="stylesheet" href="../dist/css/switch.css">

  </head>

  <body class="hold-transition sidebar-collapse sidebar-mini layout-fixed layout-navbar-fixed">
    <!-- Content Wrapper. Contains page content -->
    <div class="wrapper">
      <?php
      require 'nav.php';
      require 'aside.php';
      if ($_SESSION['pedido'] == 1) {
        //require 'enmantenimiento.php';
      ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1><i class="nav-icon  fas fa-dollar-sign"></i> Pedidos</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="otro_ingreso.php">Home</a></li>
                    <li class="breadcrumb-item active">Pedido</li>
                  </ol>
                </div>
              </div>
            </div>
            <!-- /.container-fluid -->
          </section>

          <!-- Main content -->
          <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12">
                  <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">                      
                      <ul class="nav nav-tabs" id="nav-tab" role="tablist">
                        <!-- PEDIDO A TOURS -->
                        <li class="nav-item">
                          <a class="nav-link active" id="nav-pedido_tours-tab" data-toggle="pill" href="#nav-pedido_tours" role="tab" aria-controls="nav-pedido_tours" aria-selected="true">PEDIDO TOURS</a>
                        </li>
                        <!-- PEDIDO PAQUETE -->
                        <li class="nav-item">
                          <a class="nav-link" id="nav-pedido_paquete-tab" data-toggle="pill" href="#nav-pedido_paquete" role="tab" aria-controls="nav-pedido_paquete" aria-selected="false">PEDIDO PAQUETE</a>
                        </li>
                        <!-- PEDIDO A MEDIDA -->
                        <li class="nav-item">
                          <a class="nav-link" id="nav-pedido-a-medida-tab" data-toggle="pill" href="#nav-pedido-a-medida" role="tab" aria-controls="nav-pedido_a_medida" aria-selected="false">PEDIDO A MEDIDA</a>
                        </li>
                      </ul>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body"> 
                      
                      <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active pedido_tours" id="nav-pedido_tours" role="tabpanel" aria-labelledby="nav-pedido_tours-tab">
                          <!-- PEDIDO TOURS --> 
                          <table id="tabla-pedido-tours" class="table table-bordered table-striped display" style="width: 100% !important;">
                            <thead>
                              <tr>
                                <th class="text-center">#</th>
                                <th class="">Acciones</th>
                                <th class="">Fecha </th>
                                <th class="">Tours </th>
                                <th class="">Cliente </th>                              
                                <th class="">Telefono </th>
                                <th class="" >Descripción</th>
                                <th class="">Estado </th>
                              </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                              <tr>
                                <th class="text-center">#</th>
                                <th class="">Acciones</th>
                                <th class="">Fecha </th>
                                <th class="">Tours </th>
                                <th class="">Cliente </th>                              
                                <th class="">Telefono </th>
                                <th class="" >Descripción</th>
                                <th class="">Estado </th>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                        <!-- /.tab-panel -->

                        <div class="tab-pane fade pedido_paquete" id="nav-pedido_paquete" role="tabpanel" aria-labelledby="nav-pedido_paquete-tab">
                          <!-- PEDIDO PAQUETE -->                            
                          <table id="tabla-pedido-paquete" class="table table-bordered table-striped display" style="width: 100% !important;">
                            <thead>
                              <tr>
                                <th class="text-center">#</th>
                                <th class="">Acciones</th>
                                <th class="">Fecha </th>
                                <th class="">Paquete </th>
                                <th class="">Cliente </th>                              
                                <th class="">Telefono </th>
                                <th class="" >Descripción</th>
                                <th class="">Estado </th>
                              </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                              <tr>
                                <th class="text-center">#</th>
                                <th class="">Acciones</th>
                                <th class="">Fecha </th>
                                <th class="">Paquete </th>
                                <th class="">Pedido </th>                              
                                <th class="">Telefono </th>
                                <th class="" >Descripción</th>
                                <th class="">Estado </th>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                        <!-- /.tab-panel --> 

                        <div class="tab-pane fade pedido_a_medida" id="nav-pedido-a-medida" role="tabpanel" aria-labelledby="nav-pedido_a_medida-tab">
                          <!-- PEDIDO A MEDIDA -->
                          <table id="tabla-pedido-a-medida" class="table table-bordered table-striped display" style="width: 100% !important;">
                            <thead>
                              <tr>
                                <th class="text-center">#</th>
                                <th class="">Acciones</th>
                                <th class="">Fecha </th>
                                <th class="">Cliente </th>                              
                                <th class="">Telefono </th>
                                <th class="" >Descripción</th>
                                <th class="">Estado </th>
                              </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                              <tr>
                              <th class="text-center">#</th>
                                <th class="">Acciones</th>
                                <th class="">Fecha </th>
                                <th class="">Cliente </th>                              
                                <th class="">Telefono </th>
                                <th class="" >Descripción</th>
                                <th class="">Estado </th>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                        <!-- /.tab-panel -->                        
                      </div>                     

                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                  
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.container-fluid -->            

            <!-- MODAL - VER IMG-->
            <div class="modal fade bg-color-02020280" id="modal-ver-imagen">
              <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content bg-color-0202022e shadow-none border-0">
                  <div class="modal-header">
                    <h4 class="modal-title text-white nombre-imagen-peril"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span class="text-white cursor-pointer" aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div id="imagen-paquete" class="text-center">
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- MODAL - VER PEDIDO  -->
            <div class="modal fade" id="modal-ver-pedido">
              <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title titulo_pedido">Pedido</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span class="text-danger" aria-hidden="true">&times;</span>
                    </button>
                  </div>

                  <div class="modal-body">
                    <div class="card card-info card-tabs">
                      <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-content-detalle-tab" role="tablist">
                          <!-- DATOS TUORS -->
                          <li class="nav-item">
                            <a class="nav-link active" id="custom-content-detalle-pedido_html-tab" data-toggle="pill" href="#custom-content-detalle-pedido_html" role="tab" aria-controls="custom-content-detalle-pedido_html" aria-selected="true">PEDIDO</a>
                          </li>
                          <!-- DATOS TUORS -->
                          <li class="nav-item">
                            <a class="nav-link" id="custom-content-detalle-home_html-tab" data-toggle="pill" href="#custom-content-detalle-home_html" role="tab" aria-controls="custom-content-detalle-home_html" aria-selected="true">DATOS PRINCIPALES</a>
                          </li>
                          <!-- OTROS -->
                          <li class="nav-item">
                            <a class="nav-link" id="custom-content-detalle-otros_html-tab" data-toggle="pill" href="#custom-content-detalle-otros_html" role="tab" aria-controls="custom-content-detalle-otros_html" aria-selected="false">OTROS</a>
                          </li>
                          <!-- ITINERARIO -->
                          <li class="nav-item">
                            <a class="nav-link" id="custom-content-detalle-itinerario_html-tab" data-toggle="pill" href="#custom-content-detalle-itinerario_html" role="tab" aria-controls="custom-content-detalle-itinerario_html" aria-selected="false">ITINERARIO</a>
                          </li>
                          <!--COSTOS-->
                          <li class="nav-item">
                            <a class="nav-link" id="custom-content-detalle-costo_html-tab" data-toggle="pill" href="#custom-content-detalle-costo_html" role="tab" aria-controls="custom-content-detalle-costo_html" aria-selected="false">COSTOS</a>
                          </li>
                          <!-- RESUMEN-->
                          <li class="nav-item">
                            <a class="nav-link" id="custom-content-detalle-resumen_html-tab" data-toggle="pill" href="#custom-content-detalle-resumen_html" role="tab" aria-controls="custom-content-detalle-resumen_html" aria-selected="false">RESUMEN</a>
                          </li>
                        </ul>
                      </div> 
                      <div class="card-body">
                        <div class="tab-content" id="custom-content-detalle-tabContent">
                          <div class="tab-pane fade show active pedido_html" id="custom-content-detalle-pedido_html" role="tabpanel" aria-labelledby="custom-content-detalle-pedido_html-tab">
                            <!-- DATOS PRINCIPALES --> 
                            <div class="row"> <div class="col-lg-12 mt-3 text-center"> <i class="fas fa-spinner fa-pulse fa-4x"></i><br> <h4>Cargando...</h4></div> </div>
                          </div>
                          <!-- /.tab-panel -->

                          <div class="tab-pane fade show home_html" id="custom-content-detalle-home_html" role="tabpanel" aria-labelledby="custom-content-detalle-home_html-tab">
                            <!-- DATOS PRINCIPALES --> 
                            <div class="row"> <div class="col-lg-12 mt-3 text-center"> <i class="fas fa-spinner fa-pulse fa-4x"></i><br> <h4>Cargando...</h4></div> </div>
                          </div>
                          <!-- /.tab-panel -->

                          <div class="tab-pane fade otros_html" id="custom-content-detalle-otros_html" role="tabpanel" aria-labelledby="custom-content-detalle-otros_html-tab">
                            <!-- OTROS -->                            
                            <div class="row"> <div class="col-lg-12 mt-3 text-center"> <i class="fas fa-spinner fa-pulse fa-4x"></i><br> <h4>Cargando...</h4></div> </div>
                          </div>
                          <!-- /.tab-panel --> 

                          <div class="tab-pane fade itinerario_html" id="custom-content-detalle-itinerario_html" role="tabpanel" aria-labelledby="custom-content-detalle-itinerario_html-tab">
                            <!-- ITINERARIO -->
                            <div class="row"> <div class="col-lg-12 mt-3 text-center"> <i class="fas fa-spinner fa-pulse fa-4x"></i><br> <h4>Cargando...</h4></div> </div>
                          </div>
                          <!-- /.tab-panel -->
                          <div class="tab-pane fade costo_html" id="custom-content-detalle-costo_html" role="tabpanel" aria-labelledby="custom-content-detalle-costo_html-tab">
                            <!-- COSTOS -->
                            <div class="row"> <div class="col-lg-12 mt-3 text-center"> <i class="fas fa-spinner fa-pulse fa-4x"></i><br> <h4>Cargando...</h4></div> </div>
                          </div>
                          <div class="tab-pane fade resumen_html" id="custom-content-detalle-resumen_html" role="tabpanel" aria-labelledby="custom-content-detalle-resumen_html-tab">
                            <!-- RESUMEN -->
                            <div class="row"> <div class="col-lg-12 mt-3 text-center"> <i class="fas fa-spinner fa-pulse fa-4x"></i><br> <h4>Cargando...</h4></div> </div>
                          </div>
                          <!-- /.tab-panel -->
                        </div> 
                      </div>
                    </div>                                                                
                    
                  </div>
                  <div class="modal-footer justify-content-between btn_footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- MODAL - VER PAQUETE A MEDIDA -->
            <div class="modal fade" id="modal-ver-paquete-a-medida">
              <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title titulo_pedido">Paquete a Medida</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span class="text-danger" aria-hidden="true">&times;</span>
                    </button>
                  </div>

                  <div class="modal-body">
                    <div class="card card-info card-tabs">
                      <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-content-detalle-tab" role="tablist">
                          <!-- DATOS TUORS -->
                          <li class="nav-item">
                            <a class="nav-link active" id="custom-content-detalle-datos1_html-tab" data-toggle="pill" href="#custom-content-detalle-datos1_html" role="tab" aria-controls="custom-content-detalle-datos1_html" aria-selected="true">DATOS PERSONALES</a>
                          </li>
                          <!-- DATOS TUORS -->
                          <li class="nav-item">
                            <a class="nav-link" id="custom-content-detalle-home2_html-tab" data-toggle="pill" href="#custom-content-detalle-home2_html" role="tab" aria-controls="custom-content-detalle-home2_html" aria-selected="true">TOURS</a>
                          </li>
                          <!-- OTROS -->
                          <li class="nav-item">
                            <a class="nav-link" id="custom-content-detalle-otros3_html-tab" data-toggle="pill" href="#custom-content-detalle-otros3_html" role="tab" aria-controls="custom-content-detalle-otros3_html" aria-selected="false">OTROS</a>
                          </li>
                          
                        </ul>
                      </div> 
                      <div class="card-body">
                        <div class="tab-content" id="custom-content-detalle-tabContent">
                          <div class="tab-pane fade show active datos1_html" id="custom-content-detalle-datos1_html" role="tabpanel" aria-labelledby="custom-content-detalle-datos1_html-tab">
                            <!-- DATOS PRINCIPALES --> 
                            <div class="row"> <div class="col-lg-12 mt-3 text-center"> <i class="fas fa-spinner fa-pulse fa-4x"></i><br> <h4>Cargando...</h4></div> </div>
                          </div>
                          <!-- /.tab-panel -->

                          <div class="tab-pane fade show home2_html" id="custom-content-detalle-home2_html" role="tabpanel" aria-labelledby="custom-content-detalle-home2_html-tab">
                            <!-- DATOS PRINCIPALES --> 
                            <div class="row"> <div class="col-lg-12 mt-3 text-center"> <i class="fas fa-spinner fa-pulse fa-4x"></i><br> <h4>Cargando...</h4></div> </div>
                          </div>
                          <!-- /.tab-panel -->

                          <div class="tab-pane fade otros3_html" id="custom-content-detalle-otros3_html" role="tabpanel" aria-labelledby="custom-content-detalle-otros3_html-tab">
                            <!-- OTROS -->                            
                            <div class="row"> <div class="col-lg-12 mt-3 text-center"> <i class="fas fa-spinner fa-pulse fa-4x"></i><br> <h4>Cargando...</h4></div> </div>
                          </div>
                          <!-- /.tab-panel --> 
                        </div> 
                      </div>
                    </div>                                                                
                    
                  </div>
                  <div class="modal-footer justify-content-between btn_footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- MODAL - VENDER -->
            <div class="modal fade" id="modal-vender-pedido">
              <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Vender Pedido</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span class="text-white cursor-pointer" aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form id="form-ventas" name="form-ventas" method="post">
                      <div class="row">

                        <!-- Tipo de Empresa -->
                        <div class="col-lg-9">
                          <div class="form-group">
                            <label for="idcliente">
                              <span class="badge badge-info cursor-pointer" data-toggle="tooltip" data-original-title="Recargar trabajador" onclick="reload_trabajador();"><i class="fa-solid fa-rotate-right"></i></span> 
                              <span class="badge badge-info cursor-pointer" data-toggle="tooltip" data-original-title="Recargar proveedor" onclick="reload_proveedor();"><i class="fa-solid fa-rotate-right"></i></span>
                              <span class="badge badge-warning cursor-pointer" data-toggle="tooltip" data-original-title="Recargar cliente" onclick="reload_cliente();"><i class="fa-solid fa-rotate-right"></i></span>
                              Cliente <span class="tipo_persona_venta"></span> <sup class="text-danger">(único*)</sup>
                            </label>
                            <select id="idcliente" name="idcliente" class="form-control select2" data-live-search="true" required title="Seleccione cliente" onchange="extrae_ruc('#idcliente', '#num_doc');"> </select>
                          </div>
                        </div>                        

                        <!-- Tipo de comprobante -->
                        <div class="col-lg-3" id="content-tipo-comprobante">
                          <div class="form-group">
                            <label for="tipo_comprobante">Tipo Comprobante </label>
                            <select name="tipo_comprobante" id="tipo_comprobante" class="form-control select2"   placeholder="Seleccionar ">
                              <option value="NINGUNO">Ninguno</option>
                              <!-- <option value="Boleta">Boleta</option>
                              <option value="Factura">Factura</option> -->
                              <!-- <option value="Nota de venta">Nota de venta</option> -->
                            </select>
                          </div>
                        </div> 
                                                      

                        <!-- IGV-->
                        <div class="col-lg-1" style="display: none;">
                          <div class="form-group">
                            <label for="impuesto">IGV <sup class="text-danger">*</sup></label>
                            <input type="text" name="impuesto" id="impuesto" class="form-control" value="0" onkeyup="modificarSubtotales();" />
                          </div>
                        </div>                        

                        <!-- metodo de pago -->
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label for="metodo_pago">Método de pago <sup class="text-danger">*</sup></label>
                            <select id="metodo_pago" name="metodo_pago" class="form-control select2" data-live-search="true" required title="Seleccione metodo" onchange="capturar_pago_compra();"> 
                              <option title="fas fa-hammer" value="CONTADO">CONTADO</option>
                              <option title="fas fa-gas-pump" value="CREDITO">CREDITO</option>
                              <option title="fas fa-gas-pump" value="TARJETA">TARJETA</option>
                              <option title="fas fa-gas-pump" value="TRANSFERENCIA">TRANSFERENCIA</option>
                              <option title="fas fa-gas-pump" value="MIXTO">MIXTO</option>                                       
                              <option title="fas fa-gas-pump" value="YAPE">YAPE</option>
                              <option title="fas fa-gas-pump" value="PLIN">PLIN</option>
                              <option title="fas fa-gas-pump" value="CULQI">CULQI</option>                                                      
                              <option title="fas fa-gas-pump" value="LUKITA">LUKITA</option>                                                      
                              <option title="fas fa-gas-pump" value="TUNKI">TUNKI</option>
                            </select>
                          </div> 
                        </div>                                  

                        <!-- Pago a realizar -->
                        <div class="col-sm-6 col-lg-4" id="content-code-baucher">
                          <div class="form-group">
                            <label for="code_vaucher">Código de Baucher <span class="span-pago-compra"></span> </label>
                            <input type="text" name="code_vaucher" id="code_vaucher" class="form-control" onClick="this.select();" placeholder="Codigo de baucher" />
                          </div>
                        </div> 

                        <!-- Descripcion-->
                        <div class="col-lg-12" id="content-descripcion">
                          <div class="form-group">
                            <label for="descripcion">Observacion </label> <br />
                            <textarea name="descripcion" id="descripcion" class="form-control" rows="1"></textarea>
                          </div>
                        </div> 

                        <div class="col-lg-12 mb-3" >
                          <div class="table-responsive row-horizon disenio-scroll">
                            <table  class="table table-striped table-bordered table-condensed table-hover">
                              <thead class="bg-color-252e38 text-white" >                                
                                <th>Producto</th>
                                <th>Unidad</th>
                                <th>Cantidad</th>                                        
                                <th data-toggle="tooltip" data-original-title="Precio Unitario">P/U</th>
                                <th>Descuento</th>
                                <th>Subtotal</th>
                              </thead>
                              <tbody id="detalles"></tbody>
                              <tfoot>
                                <td colspan="4" >                                                                                 
                                </td>
                                <th class="text-right">
                                  <h6 class="tipo_gravada">GRAVADA</h6>
                                  <h6 class="val_igv">IGV (18%)</h6>
                                  <h5 class="font-weight-bold">TOTAL</h5>
                                </th>
                                <th class="text-right"> 
                                  <h6 class="font-weight-bold subtotal_venta">S/ 0.00</h6>
                                  <input type="hidden" name="subtotal_venta" id="subtotal_venta" />
                                  <input type="hidden" name="tipo_gravada" id="tipo_gravada" />

                                  <h6 class="font-weight-bold igv_venta">S/ 0.00</h6>
                                  <input type="hidden" name="igv_venta" id="igv_venta" />
                                  
                                  <h5 class="font-weight-bold total_venta">S/ 0.00</h5>
                                  <input type="hidden" name="total_venta" id="total_venta" />
                                  
                                </th>
                              </tfoot>                              
                            </table>                            
                          </div>
                        </div>

                        <!-- Descripcion -->
                        <div class="col-lg-12 pl-0">
                          <div class="px-3 pb-2">
                            <div class="text-primary bg-white" style="position: absolute; top: -6px; z-index: 1000 !important;"> 
                              <b class="mx-1" >PAGO DE VENTA</b>
                            </div>
                          </div>
                        </div>                        

                        <div class="col-lg-12" >
                          <div class="px-3 py-3 b-radio-5px" style="box-shadow: 0 0 1px rgb(0 0 0), 0 1px 3px rgb(0 0 0 / 60%);">
                            <div class="row">                          
                              <div class="col-4 col-sm-4 col-lg-4" id="content-pagar-ctdo" >
                                <div class="form-group">
                                  <label for="pagar_con">Pagar Ctdo. </label>
                                  <input type="text" name="pagar_con_ctdo" id="pagar_con_ctdo" class="form-control" onClick="this.select();" onchange="calcular_vuelto();" onkeyup="calcular_vuelto();" placeholder="Pagar con" />
                                </div>
                              </div>
                              <div class="col-4 col-sm-4 col-lg-4" id="content-pagar-tarj" style="display: none;">
                                <div class="form-group">
                                  <label for="pagar_con">Pagar Tarj. </label>
                                  <input type="text" name="pagar_con_tarj" id="pagar_con_tarj" class="form-control" onClick="this.select();" onchange="calcular_vuelto();" onkeyup="calcular_vuelto();" placeholder="Pagar con" />
                                </div>
                              </div>
                              <div class="col-4 col-sm-4 col-lg-4" id="content-vuelto">
                                <div class="form-group">
                                  <label >Vuelto <small class="falta_o_completo"></small> </label>
                                  <span class="form-control-mejorado vuelto_venta font-weight-bold" >0.00</span>   
                                  <input type="hidden" name="vuelto_venta" id="vuelto_venta">                                             
                                </div>
                              </div>
                              <div class="col-12">
                                <button type="button" class="btn btn-primary btn-sm pago_rapido" onclick="pago_rapido(this)" >0</button>
                                <button type="button" class="btn btn-info btn-sm" onclick="pago_rapido(this)" >10</button>
                                <button type="button" class="btn btn-info btn-sm" onclick="pago_rapido(this)" >20</button>
                                <button type="button" class="btn btn-info btn-sm" onclick="pago_rapido(this)" >50</button>
                                <button type="button" class="btn btn-info btn-sm" onclick="pago_rapido(this)" >100</button>
                                <button type="button" class="btn btn-info btn-sm" onclick="pago_rapido(this)" >200</button>
                              </div>
                            </div>
                          </div>
                        </div>                        
                        
                      </div>
                    </form>
                  </div>
                  <!-- /.modal-body -->
                  <div class="modal-footer justify-content-between btn_footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="">Guardar</button>
                  </div>
                </div>
              </div>
            </div>

            
          </section>
          <!-- /.content -->
        </div>

      <?php
      } else {
        require 'noacceso.php';
      }
      require 'footer.php';
      ?>
    </div>
    <!-- /.content-wrapper -->

    <?php require 'script.php'; ?>   
   
    <!-- Funciones del modulo -->
    <script type="text/javascript" src="scripts/pedido.js"></script>

    <script> $(function() { $('[data-toggle="tooltip"]').tooltip();  }); </script>
    
  </body>

  </html>

<?php } ob_end_flush(); ?>