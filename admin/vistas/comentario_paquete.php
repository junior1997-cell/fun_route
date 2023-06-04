<?php
  //Activamos el almacenamiento en el buffer
  ob_start();

  session_start();
  if (!isset($_SESSION["nombre"])){
    header("Location: index.php?file=".basename($_SERVER['PHP_SELF']));
  }else{
    ?>

    <!DOCTYPE html>
    <html lang="es">
      <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Paquetes | Admin Fun Route</title>
        
        <?php $title = "Comentario_paquete"; require 'head.php'; ?>
          
      </head>
      <body class="hold-transition sidebar-collapse sidebar-mini layout-fixed layout-navbar-fixed">
        <!-- Content Wrapper. Contains page content -->
        <div class="wrapper">
          <?php
          require 'nav.php';
          require 'aside.php';
          if ($_SESSION['otro_ingreso']==1){
            //require 'enmantenimiento.php';
            ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper" >
              <!-- Content Header (Page header) -->
              <section class="content-header">
                <div class="container-fluid">
                  <div class="row mb-2">
                    <div class="col-sm-6">
                      <h1>Comentario Paquete</h1>
                    </div>
                    <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="otro_ingreso.php">Home</a></li>
                        <li class="breadcrumb-item active">Comentario Paquete</li>
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
                        
                        <!-- /.card-header -->
                        <div class="card-body">

                          <div id="mostrar-tabla">
                            <table id="tabla-comentario-paquete" class="table table-bordered table-striped display" style="width: 100% !important;">
                              <thead>
                                <tr>
                                  <th class="text-center">#</th>
                                  <th class="">Acciones</th>
                                  <th class="">Nombre</th>
                                  <th data-toggle="tooltip" data-original-title="Correo">Correo</th>
                                  <th data-toggle="tooltip" data-original-title="Comentario">Comentario</th>
                                  <th data-toggle="tooltip" data-original-title="Fecha">Fecha</th>
                                  <th>Estrella</th>
                                  <th>Estado</th>
                                </tr>
                              </thead>
                              <tbody></tbody>
                              <tfoot>
                                <tr>
                                  <th class="text-center">#</th>
                                  <th class="">Acciones</th>
                                  <th class="">Nombre</th>
                                  <th data-toggle="tooltip" data-original-title="Correo">Correo</th>
                                  <th data-toggle="tooltip" data-original-title="Comentario">Comentario</th>
                                  <th data-toggle="tooltip" data-original-title="Fecha">Fecha</th>
                                  <th>Estrella</th>
                                  <th>Estado</th>
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
                
                <!-- Modal agregar paquete -->
                <div class="modal fade" id="modal-comentario-paquete">
                  <div class="modal-dialog modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
 
                      </div>
                      <div class="modal-body">
                        <!-- form start -->
                        <form id="form-paquete" name="form-paquete" method="POST">
                          <div class="card-body row">                               
                            
                            <!-- id paquete -->
                            <input type="hidden" name="idcomentario_paquete" id="idcomentario_paquete" />

                            <!-- Nombre -->
                            <div class="col-lg-10">
                              <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" />
                              </div>
                            </div>

                            <!-- correo -->
                            <div class="col-lg-2">
                              <div class="form-group">
                                <label for="correo">correo</label>
                                <input type="number" name="correo" class="form-control" id="correo" placeholder="Correo" />
                              </div>
                            </div>

                            <!--Comentario-->
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                              <div class="form-group ">
                                <label for="nota">Comentario</label> <br />
                                <textarea name="nota" id="nota" class="form-control" rows="2"></textarea>
                              </div>
                            </div>
                             <!--fecha-->
                             <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                              <div class="form-group ">
                                <label for="fecha">Fecha</label> <br />
                                <textarea name="fecha" id="fecha" class="form-control" rows="2"></textarea>
                              </div>
                            </div>
                             <!--Estrella-->
                             <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                              <div class="form-group ">
                                <label for="estrella">Estrella</label> <br />
                                <textarea name="estrella" id="estrella" class="form-control" rows="2"></textarea>
                              </div>
                            </div>

                          </div>
                          <!-- /.card-body -->
                          <button type="submit" style="display: none;" id="submit-form-comentario-paquete">Submit</button>
                        </form>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="guardar_registro_comentario_paquete">Guardar Cambios</button>
                      </div>
                    </div>
                  </div>
                </div> 


              </section>
              <!-- /.content -->
            </div>

            <?php
          }else{
            require 'noacceso.php';
          }
          require 'footer.php';
          ?>
        </div>
        <!-- /.content-wrapper -->

        <?php require 'script.php'; ?>
        
        <!-- Funciones del modulo -->
        <script type="text/javascript" src="scripts/comentario_paquete.js"></script>

        <script> $(function () { $('[data-toggle="tooltip"]').tooltip(); }); </script>
        
      </body>
    </html>

    <?php  
  }
  ob_end_flush();

?>
