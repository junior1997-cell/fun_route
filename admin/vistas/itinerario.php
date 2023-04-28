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
        <title>Itinerario | Admin Fun Route</title>
        
        <?php $title = "Itinerario"; require 'head.php'; ?>
        <!-- summernote -->
        <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
          
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
                      <h1>Itinerario</h1>
                    </div>
                    <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="itinerario.php">Home</a></li>
                        <li class="breadcrumb-item active">Itinerario</li>
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
                          <h3 class="card-title btn-regresar" style="display: none;">
                            <button type="button" class="btn bg-gradient-warning" onclick="limpiar_form(); show_hide_form(1);"><i class="fas fa-arrow-left"></i> Regresar</button>                            
                          </h3>
                          <h3 class="card-title btn-agregar">
                            <button type="button" class="btn bg-gradient-success" data-toggle="modal" data-target="#modal-agregar-itinerario" onclick="limpiar_form(); show_hide_form(1);"><i class="fas fa-plus-circle"></i> Agregar</button>
                            Administra de manera eficiente itinerarios.
                          </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                          <div id="mostrar-tabla">
                            <table id="tabla-itinerario" class="table table-bordered table-striped display" style="width: 100% !important;">
                              <thead>
                                <tr>
                                  <th class="text-center">#</th>
                                  <th class="">Opciones</th>
                                  <th class="">Mapa</th>
                                  <th class="">Incluye</th>
                                  <th class="">No Incluye</th>
                                  <th class="">Recomendaciones</th>
                                </tr>
                              </thead>
                              <tbody></tbody>
                              <tfoot>
                                <tr>
                                <th class="text-center">#</th>
                                  <th class="">Opciones</th>
                                  <th class="">Mapa</th>
                                  <th class="">Incluye</th>
                                  <th class="">No Incluye</th>
                                  <th class="">Recomendaciones</th>
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
                <div class="modal fade" id="modal-agregar-itinerario">
                  <div class="modal-dialog modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Agregar paquete</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span class="text-danger" aria-hidden="true">&times;</span>
                        </button>
                      </div>

                      <div class="modal-body">
                        <!-- form start -->
                        <form id="form-itinerario" name="form-itinerario" method="POST">
                          <div class="card-body row">                               
                            
                            <!-- id paquete -->
                            <input type="hidden" name="iditinerario" id="iditinerario" />
                            <input type="hidden" name="idpaquete" id="idpaquete" value="1" />
                            <!--mapa-->
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                              <div class="form-group ">
                                <label for="mapa">Mapa</label> <br />
                                <textarea name="mapa" id="mapa" class="form-control" rows="2"></textarea>
                              </div>
                            </div>
                            <!--incluye--->
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                              <label for="incluye">incluye</label> <br />
                              <textarea id="incluye" name="incluye">
                                 <em>Describe tu</em> <u>texto</u> 
                              </textarea>
                            </div>
                             <!--no incluye--->
                             <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                              <label for="no_incluye">no incluye</label> <br />
                              <textarea id="no_incluye" name="no_incluye">
                                 <em>Describe tu</em> <u>texto</u> 
                              </textarea>
                            </div>
                             <!--comentarios--->
                             <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                              <label for="recomendaciones">recomendaciones</label> <br />
                              <textarea id="recomendaciones" name="recomendaciones">
                                 <em>Describe tu</em> <u>recomendaciones</u> 
                              </textarea>
                            </div>
                            <!-- Progress - -->
                            <div class="col-md-12 m-t-20px" id="barra_progress_itinerario_div" style="display: none;">
                              <div class="form-group">
                                  <div class="progress" >
                                   <div id="barra_progress_itinerario" class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                              </div>
                            </div>

                          </div>
                          <!-- /.card-body -->
                          <button type="submit" style="display: none;" id="submit-form-itinerario">Submit</button>
                        </form>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="guardar_registro_itinerario">Guardar Cambios</button>
                      </div>
                    </div>
                  </div>
                </div> 
                <!--MODAL - VER DETALLE DE OTRO INGRESO -->
                <div class="modal fade" id="modal-ver-itinerario">
                  <div class="modal-dialog modal-dialog-scrollable modal-xm">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Datos de Itinerario</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span class="text-danger" aria-hidden="true">&times;</span>
                        </button>
                      </div>

                      <div class="modal-body"> 
                        <div id="datos_itinerario" class="class-style">
                          <!-- vemos los datos del trabajador -->
                        </div>
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
        
        <!-- Plugion summernote -->
        <script src="../plugins/summernote/summernote-bs4.min.js"></script>
        <!-- Funciones del modulo -->
        <script type="text/javascript" src="scripts/itinerario.js"></script>

        <script> $(function () { $('[data-toggle="tooltip"]').tooltip(); }); </script>
        
      </body>
    </html>

    <?php  
  }
  ob_end_flush();

?>
