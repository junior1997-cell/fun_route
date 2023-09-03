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
        
        <?php $title = "Comentario"; require 'head.php'; ?>
          
      </head>
      <body class="hold-transition sidebar-collapse sidebar-mini layout-fixed layout-navbar-fixed">
        <!-- Content Wrapper. Contains page content -->
        <div class="wrapper">
          <?php
          require 'nav.php';
          require 'aside.php';
          if ($_SESSION['tours']==1){
            //require 'enmantenimiento.php';
            ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper" >
              <!-- Content Header (Page header) -->
              <section class="content-header">
                <div class="container-fluid">
                  <div class="row mb-2">
                    <div class="col-sm-6">
                      <h1>Experiencias</h1>
                    </div>
                    <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="otro_ingreso.php">Home</a></li>
                        <li class="breadcrumb-item active">Experiencias</li>
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
                        <!-- Start Main Top -->
                        <div class="main-top">
                          <div class="container-fluid border-bottom">
                            <div class="row">
                              <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"> 
                                <div class="card-header">
                                  <h3 class="card-title">
                                    <!--data-toggle="modal" data-target="#modal-agregar-compra"  onclick="limpiar();"-->
                                    <button type="button" class="btn bg-gradient-primary" id="btn_agregar" data-toggle="modal" data-target="#modal-experiencia" onclick="limpiar_form_comentario();">
                                      <i class="fas fa-plus-circle"></i> Agregar
                                    </button>                                    
                                    <button type="button" class="btn bg-gradient-warning" id="regresar" style="display: none;" onclick="regresar();">
                                      <i class="fas fa-arrow-left"></i> Regresar
                                    </button>                                    
                                  </h3>
                                </div>
                              </div>

                            </div>
                          </div>
                        </div>
                        <!-- End Main Top -->
                        
                        <!-- /.card-header -->
                        <div class="card-body">

                          <div id="mostrar-tabla">
                            <table id="tabla-experiencia" class="table table-bordered table-striped display" style="width: 100% !important;">
                              <thead>
                                <tr>
                                  <th class="text-center">#</th>
                                  <th class="">Acciones</th>
                                  <th class="">Nombre</th>
                                  <th class="">Des. Lugar</th>
                                  <th data-toggle="tooltip" data-original-title="Comentario">Comentario</th>
                                  <th>Estrella</th>
                                </tr>
                              </thead>
                              <tbody></tbody>
                              <tfoot>
                                <tr>
                                <th class="text-center">#</th>
                                  <th class="">Acciones</th>
                                  <th class="">Nombre</th>
                                  <th class="">Des. Lugar</th>
                                  <th data-toggle="tooltip" data-original-title="Comentario">Comentario</th>
                                  <th>Estrella</th>
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
                <div class="modal fade" id="modal-experiencia">
                  <div class="modal-dialog modal-dialog-scrollable modal-md">
                    <div class="modal-content">
                      <div class="modal-header">
 
                      </div>
                      <div class="modal-body">
                        <!-- form start -->
                        <form id="form-experiencia" name="form-experiencia" method="POST">
                          <div class="card-body row">                               
                            
                            <!-- id paquete -->
                            <input type="hidden" name="idexperiencia" id="idexperiencia" />

                            <!-- Nombre -->
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                              <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" />
                              </div>
                            </div>
                            <!-- Lugar  idexperiencia,nombre, lugar, estrella, comentario  -->
                            <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
                              <div class="form-group">
                                <label for="lugar">Lugar que visitó</label>
                                <input type="text" name="lugar" class="form-control" id="lugar" placeholder="Lugar que visitó" />
                              </div>
                            </div>
                             <!--Estrella-->
                             <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                              <div class="form-group ">
                                <label for="estrella">Estrella</label> <br />
                                <input type='number' name="estrella" id="estrella" class="form-control" min='1' max='5' >
                              </div> 
                              </div>

                            <!--Comentario-->
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                              <div class="form-group ">
                                <label for="comentario">Comentario</label> <br />
                                <textarea name="comentario" id="comentario" class="form-control" rows="2"></textarea>
                              </div>
                            </div>

                            <!-- imagen perfil -->
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="col-lg-12 borde-arriba-naranja mt-2 mb-2"></div>
                                <label for="foto1">Foto de perfil</label> <br />
                                <img onerror="this.src='../dist/img/default/img_defecto.png';" src="../dist/img/default/img_defecto.png" class="img-thumbnail" id="foto1_i" style="cursor: pointer !important;" width="auto" />
                                <input style="display: none;" type="file" name="foto1" id="foto1" accept="image/*" />
                                <input type="hidden" name="foto1_actual" id="foto1_actual" />
                                <div class="text-center" id="foto1_nombre"><!-- aqui va el nombre de la FOTO --></div>
                              </div>


                          </div>
                          <!-- /.card-body -->
                          <button type="submit" style="display: none;" id="submit-form-experiencia">Submit</button>
                        </form>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"  onclick="limpiar_form_comentario();" >Close</button>
                        <button type="submit" class="btn btn-primary" id="guardar_registro_experiencia">Guardar Cambios</button>
                      </div>
                    </div>
                  </div>
                </div> 

                <!-- MODAL - VER PERFIL PERSONA-->
                <div class="modal fade bg-color-02020280" id="modal-ver-perfil-persona">
                  <div class="modal-dialog modal-dialog-centered modal-md">
                    <div class="modal-content bg-color-0202022e shadow-none border-0">
                      <div class="modal-header">
                        <h4 class="modal-title text-white foto-persona">Foto Persona</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span class="text-white cursor-pointer" aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body"> 
                        <div id="perfil-persona" class="text-center">
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
        
        <!-- Funciones del modulo -->
        <script type="text/javascript" src="scripts/experiencia.js"></script>

        <script> $(function () { $('[data-toggle="tooltip"]').tooltip(); }); </script>
        
      </body>
    </html>

    <?php  
  }
  ob_end_flush();

?>
