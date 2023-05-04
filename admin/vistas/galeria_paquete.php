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
        <title>GaleriaPaquete | Admin Fun Route</title>
        
        <?php $title = "Galeria_paquete"; require 'head.php'; ?>
          
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
                      <h1>Galeria-Paquete</h1>
                    </div>
                    <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="otro_ingreso.php">Home</a></li>
                        <li class="breadcrumb-item active">Galeria Paquete</li>
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
                            <button type="button" class="btn bg-gradient-warning" onclick="limpiar_paquete(); show_hide_form(1);"><i class="fas fa-arrow-left"></i> Regresar</button>                            
                          </h3>
                          <h3 class="card-title btn-agregar">
                            <button type="button" class="btn bg-gradient-success" data-toggle="modal" data-target="#modal-agregar-galeria_paquete" onclick="limpiar_paquete(); show_hide_form(1);"><i class="fas fa-plus-circle"></i> Agregar</button>
                            Administra de manera eficiente tu galeria-paquete.
                          </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                          <div id="mostrar-tabla">
                            <table id="tabla-galeria_paquete" class="table table-bordered table-striped display" style="width: 100% !important;">
                              <thead>
                                <tr>
                                  <th class="text-center">#</th>
                                  <th class="">Acciones</th>
                                  <th class="">Nombre </th>
                                  <th data-toggle="tooltip" data-original-title="Descripcion">Descripción</th>
                                  <th>Imagen</th>
                                </tr>
                              </thead>
                              <tbody></tbody>
                              <tfoot>
                                <tr>
                                  <th class="text-center">#</th>
                                  <th class="">Acciones</th>
                                  <th class="">Nombre</th>
                                  <th data-toggle="tooltip" data-original-title="Descripcion">Descripción</th>
                                  <th>Imagen</th>
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
                
                <!-- Modal agregar galeria-paquete -->
                <div class="modal fade" id="modal-agregar-galeria_paquete">
                  <div class="modal-dialog modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Agregar Galeria</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span class="text-danger" aria-hidden="true">&times;</span>
                        </button>
                      </div>

                      <div class="modal-body">
                        <!-- form start -->
                        <form id="form-galeria-paquete" name="form-galeria-paquete" method="POST">
                          <div class="card-body row">                               
                            
                            <!-- id galeria paquete -->
                            <input type="hidden" name="idgaleria_paquete" id="idgaleria_paquete" />
                            
                            <!-- Id paquete -->
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                  <label for="idpaquete">Paquete <sup class="text-danger">(unico*)</sup></label>
                                  <select name="idpaquete" id="idpaquete" class="form-control select2" style="width: 100%;"> 
                                  </select>
                                </div>
                              </div>
                            <!--Descripcion-->
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                              <div class="form-group ">
                                <label for="descripcion_pago">Descripción</label> <br />
                                <textarea name="descripcion" id="descripcion" class="form-control" rows="2"></textarea>
                              </div>
                            </div>

                            <!-- Factura -->
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" >   
                              <!-- linea divisoria -->
                              <div class="borde-arriba-naranja mt-4"> </div>                            
                              <div class="row text-center">
                                <div class="col-md-12" style="padding-top: 15px; padding-bottom: 5px;">
                                  <label for="cip" class="control-label" > Imagen </label>
                                </div>
                                <div class="col-6 col-md-6 text-center">
                                  <button type="button" class="btn btn-success btn-block btn-xs" id="doc1_i"> <i class="fas fa-upload"></i> Subir.</button>
                                  <input type="hidden" id="doc_old_1" name="doc_old_1" />
                                  <input style="display: none;" id="doc1" type="file" name="doc1" accept="application/pdf, image/*" class="docpdf" /> 
                                </div>
                                <div class="col-6 col-md-6 text-center">
                                  <button type="button" class="btn btn-info btn-block btn-xs" onclick="re_visualizacion(1, 'otro_ingreso', 'comprobante');">
                                  <i class="fas fa-redo"></i> Recargar.
                                  </button>
                                </div>
                              </div>                              
                              <div id="doc1_ver" class="text-center mt-4">
                                <img src="../dist/svg/doc_uploads.svg" alt="" width="50%" >
                              </div>
                              <div class="text-center" id="doc1_nombre"><!-- aqui va el nombre del pdf --></div>
                            </div>
    
                          </div>
                          <!-- /.card-body -->
                          <button type="submit" style="display: none;" id="submit-form-galeria_paquete">Submit</button>
                        </form>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="guardar_registro_galeria_paquete">Guardar Cambios</button>
                      </div>
                    </div>
                  </div>
                </div> 
                <!-- MODAL - imagen valor-->
                <div class="modal fade bg-color-02020280" id="modal-ver-imagen-galeria_paquete">
                  <div class="modal-dialog modal-dialog-centered modal-md">
                    <div class="modal-content bg-color-0202022e shadow-none border-0">
                      <div class="modal-header">
                        <h4 class="modal-title text-white nombre-galeria_paquete"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span class="text-white cursor-pointer" aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body"> 
                        <div id="imagen-galeria_paquete" class="text-center">
                        </div>
                      </div>
                    </div>
                  </div>
                </div> 

                <!--===============Modal-ver-comprobante =========-->
                <div class="modal fade" id="modal-ver-comprobante">
                  <div class="modal-dialog modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Paquetes: <span class="nombre_comprobante text-bold"></span> </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span class="text-danger" aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-6 col-md-6">
                            <a class="btn btn-xs btn-block btn-warning" href="#" id="iddescargar" download="" type="button"><i class="fas fa-download"></i> Descargar</a>
                          </div>
                          <div class="col-6 col-md-6">
                            <a class="btn btn-xs btn-block btn-info" href="#" id="ver_completo"  target="_blank" type="button"><i class="fas fa-expand"></i> Ver completo.</a>
                          </div>
                          <div class="col-12 col-md-12 mt-2">
                            <div id="ver_fact_pdf" width="auto"></div>
                          </div>
                        </div>                          
                      </div>
                    </div>
                  </div>
                </div>

                <!--MODAL - VER DETALLE DE OTRO INGRESO -->
                <div class="modal fade" id="modal-ver-otro-ingreso">
                  <div class="modal-dialog modal-dialog-scrollable modal-xm">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Datos Paquetes</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span class="text-danger" aria-hidden="true">&times;</span>
                        </button>
                      </div>

                      <div class="modal-body"> 
                        <div id="datos_otro_ingreso" class="class-style">
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
        <script type="text/javascript" src="scripts/galeria_paquete.js"></script>

        <script> $(function () { $('[data-toggle="tooltip"]').tooltip(); }); </script>
        
      </body>
    </html>

    <?php  
  }
  ob_end_flush();

?>
