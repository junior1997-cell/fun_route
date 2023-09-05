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
                  <h1>Pedido</h1>
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
                  <div class="card card-primary card-outline">
                    <div class="card-header">                      
                      <h3 class="float-left mb-0"> Pedidos Tours. </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                      <div id="mostrar-tabla">
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

                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                  <div class="card card-primary card-outline">
                    <div class="card-header">                      
                      <h3 class="float-left mb-0"> Pedidos Paquete. </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                      <div id="mostrar-tabla">
                        <table id="tabla-pedido-paquete" class="table table-bordered table-striped display" style="width: 100% !important;">
                          <thead>
                            <tr>
                              <th class="text-center">#</th>
                              <th class="">Acciones</th>
                              <th class="">Fecha </th>
                              <th class="">Nombre Paquete </th>
                              <th class="">Nombre Cliente </th>                              
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
                              <th class="">Nombre Paquete </th>
                              <th class="">Nombre Pedido </th>                              
                              <th class="">Telefono </th>
                              <th class="" >Descripción</th>
                              <th class="">Estado </th>
                            </tr>
                          </tfoot>
                        </table>
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
            <div class="modal fade bg-color-02020280" id="modal-ver-imagen-paquete">
              <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content bg-color-0202022e shadow-none border-0">
                  <div class="modal-header">
                    <h4 class="modal-title text-white nombre-paquete"></h4>
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