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
                              <form id="form-datos-generales" name="form-datos-generales" method="POST">
                                <div class="card-body">

                                  <div class="row" id="cargando-1-fomulario">
                                    <!-- id -->
                                    <input type="hidden" name="idnosotros" id="idnosotros" />

                                    <!-- nombre -->
                                    <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                      <div class="form-group">
                                        <label for="nombre">Nombre <sup class="text-danger">*</sup></label>
                                        <input type="text" name="nombre" class="form-control" id="nombre" readonly />
                                      </div>
                                    </div>
                                    <!-- direccion -->
                                    <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                                      <div class="form-group">
                                        <label for="direccion">Dirección <sup class="text-danger">*</sup></label>
                                        <input type="text" name="direccion" class="form-control" id="direccion" readonly />
                                      </div>
                                    </div>
                                    <!-- RUC -->
                                    <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                      <div class="form-group">
                                        <label for="ruc">R.U.C <sup class="text-danger">*</sup></label>
                                        <input type="text" name="ruc" class="form-control" id="ruc" readonly />
                                      </div>
                                    </div>
                                    <!-- celular -->
                                    <div class="col-6 col-sm-6 col-md-6 col-lg-4">
                                      <div class="form-group">
                                        <label for="celular">Celular <sup class="text-danger">*</sup></label>
                                        <input type="text" name="celular" class="form-control" id="celular" readonly />
                                      </div>
                                    </div>
                                    <!-- Teléfono -->
                                    <div class="col-6 col-sm-6 col-md-6 col-lg-4">
                                      <div class="form-group">
                                        <label for="telefono">Teléfono <sup class="text-danger">*</sup></label>
                                        <input type="text" name="telefono" class="form-control" id="telefono" readonly />
                                      </div>
                                    </div>
                                    <!-- Correo -->
                                    <div class="col-6 col-sm-6 col-md-6 col-lg-4">
                                      <div class="form-group">
                                        <label for="correo">Correo <sup class="text-danger">*</sup></label>
                                        <input type="text" name="correo" class="form-control" id="correo" readonly />
                                      </div>
                                    </div>
                                    <!-- Latitud -->
                                    <div class="col-6 col-sm-6 col-md-6 col-lg-4">
                                      <div class="form-group">
                                        <label for="latitud">Latitud <sup class="text-danger">*</sup></label>
                                        <input type="text" name="latitud" class="form-control" id="latitud" readonly />
                                      </div>
                                    </div>
                                    <!-- Longuitud -->
                                    <div class="col-6 col-sm-6 col-md-6 col-lg-4">
                                      <div class="form-group">
                                        <label for="longuitud">Longuitud <sup class="text-danger">*</sup></label>
                                        <input type="text" name="longuitud" class="form-control" id="longuitud" readonly />
                                      </div>
                                    </div>
                                    <!-- Horario-->
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                      <div class="form-group">
                                        <label for="horario">Horario <sup class="text-danger">*</sup> </label> 
                                        <textarea name="horario" id="horario" class="form-control" rows="3" readonly></textarea>
                                      </div>
                                    </div>


                                    <!-- Progress -->
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <div class="progress" id="div_barra_progress" style="display: none !important;">
                                          <div id="barra_progress" class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
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
                                <button type="submit" style="display: none;" id="submit-form-actualizar-registro">Submit</button>
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

        <!-- OPTIONAL SCRIPTS -->
        <script src="../plugins/chart.js/Chart.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../dist/js/demo.js"></script>

        <script type="text/javascript" src="scripts/datos_generales.js"></script>

        <script>  $(function () { $('[data-toggle="tooltip"]').tooltip(); }); </script>
        
      </body>
    </html>
    <?php    
  }
  ob_end_flush();
?>
