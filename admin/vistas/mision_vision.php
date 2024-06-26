<?php
  //Activamos el almacenamiento en el buffer
  ob_start();
  session_start();

  if (!isset($_SESSION["nombre"])){
    header("Location: index.php?file=".basename($_SERVER['PHP_SELF']));
  }else{ ?>
    <!DOCTYPE html>
    <html lang="es">
      <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Misión y Visión | Admin Fun Route</title>

        <?php $title = "Misión y Visión"; require 'head.php'; ?>
        <!-- summernote -->
        <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
     
      </head>
      <body class="hold-transition sidebar-mini sidebar-collapse layout-fixed layout-navbar-fixed ">
        
        <div class="wrapper">
          <!-- Preloader -->
          <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="../dist/svg/logo_principal.svg" alt="AdminLTELogo" width="360" />
          </div>
        
          <?php
            require 'nav.php';
            require 'aside.php';
            if ($_SESSION['acceso']==1){
              //require 'enmantenimiento.php';
              ?>           
              <!--Contenido-->
              <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                  <div class="container-fluid">
                    <div class="row mb-2">
                      <div class="col-sm-6">
                        <h1 class="m-0">Misión y Visión</h1>
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="Datos Generales.php">Home</a></li>
                          <li class="breadcrumb-item active">Tablero</li>
                        </ol>
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->
                  </div>
                  <!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-12">
                        <div class="card card-primary card-outline">

                        <div class="modal-body">
                              <!-- form start -->
                              <form id="form-datos-misionvision" name="form-datos-misionvision" method="POST">
                                <div class="card-body">

                                  <div class="row" id="cargando-1-fomulario">
                                    <!-- id -->
                                    <input type="hidden" name="idnosotros" id="idnosotros" />
                                    
                                    <!-- Mision-->
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                                      <div class="form-group">
                                        <label for="mision">Misión <sup class="text-danger">*</sup> </label> 
                                        <textarea name="mision" id="mision" class="form-control" rows="10"></textarea>
                                      </div>
                                    </div>

                                     <!-- Vision-->
                                     <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                                      <div class="form-group">
                                        <label for="vision">Visión <sup class="text-danger">*</sup> </label> 
                                        <textarea name="vision" id="vision" class="form-control" rows="10"></textarea>
                                      </div>
                                    </div>

                                    <!-- valores-->
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                                      <div class="form-group">
                                        <label for="valores">Valores <sup class="text-danger">*</sup> </label> 
                                        <textarea name="valores" id="valores" class="form-control" rows="10"></textarea>
                                      </div>
                                    </div>

                                    <!-- barprogress -->
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 m-t-20px" id="barra_progress_mv_div" style="display: none;">
                                      <div class="progress" >
                                        <div id="barra_progress_mv" class="progress-bar" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: 0%;">
                                          0%
                                        </div>
                                      </div>
                                    </div>

                                  </div>
                                  
                                  <div class="row" id="cargando-2-fomulario" style="display: none;" >
                                    <div class="col-lg-12 text-center">
                                      <i class="fas fa-spinner fa-pulse fa-6x"></i><br><br>
                                      <h4>Cargando...</h4>
                                    </div>
                                  </div>
                                        
                                </div>
                                <!-- /.card-body -->
                                <button type="submit" style="display: none;" id="submit-form-actualizar-misionvision">Submit</button>
                              </form>
                            </div>
                            <div class="modal-footer justify-content-end">
                              <button class="btn btn-warning editar"  onclick="activar_editar(1);">Editar</button>
                              <button type="submit" class="btn btn-success actualizar" id="actualizar_registro" style="display: none;">Actualizar</button>
                            </div>

                        </div>
                        <!-- /.card -->
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->
                  </div>
                  <!-- /.container-fluid -->

                  <!-- Modal agregar proyecto -->
                 
                </section>
                <!-- /.content -->
              </div>
              <!--Fin-Contenido-->
              <?php
            }else{
              require 'noacceso.php';
            }
            require 'footer.php';
          ?>

        </div>

        <?php require 'script.php'; ?>
        <!-- Plugion summernote -->
        <script src="../plugins/summernote/summernote-bs4.min.js"></script>

        <!-- OPTIONAL SCRIPTS -->
        <script src="../plugins/chart.js/Chart.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../dist/js/demo.js"></script>

        <script type="text/javascript" src="scripts/mision_vision.js"></script>

        <script>  $(function () { $('[data-toggle="tooltip"]').tooltip(); }); </script>
        
      </body>
    </html>
    <?php    
  }
  ob_end_flush();
?>
