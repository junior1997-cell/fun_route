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
    <title>Tours | Admin Fun Route</title>

    <?php $title = "Tours";
    require 'head.php'; ?>
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="../plugins/ekko-lightbox/ekko-lightbox.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">

    <!-- summernote -->
    <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="../dist/css/switch.css">
  </head>

  <body class="hold-transition sidebar-collapse sidebar-mini layout-fixed layout-navbar-fixed">
    <!-- Content Wrapper. Contains page content -->
    <div class="wrapper">
      <?php
      require 'nav.php';
      require 'aside.php';
      if ($_SESSION['otro_ingreso'] == 1) {
        //require 'enmantenimiento.php';
      ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1>Tours</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="otro_ingreso.php">Home</a></li>
                    <li class="breadcrumb-item active">Tours</li>
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
                        <button type="button" class="btn bg-gradient-warning" onclick="show_hide_form(1);"><i class="fas fa-arrow-left"></i> Regresar</button>
                        <button type="button" class="btn bg-gradient-success btn-agregar-galeria" data-toggle="modal" onclick="show_hide_form(2); limpiar_galeria();" data-target="#modal-agregar-galeria_tours"><i class="fas fa-plus-circle"></i> Galeria</button>
                      </h3>
                      <h3 class="card-title btn-agregar">
                        <button type="button" class="btn bg-gradient-success" data-toggle="modal" data-target="#modal-agregar-tours" onclick="limpiar_tours(); show_hide_form(1);"><i class="fas fa-plus-circle"></i> Agregar</button>
                      </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <div id="mostrar-tabla">
                        <table id="tabla-tours" class="table table-bordered table-striped display" style="width: 100% !important;">
                          <thead>
                            <tr>
                              <th class="text-center">#</th>
                              <th class="">Acciones</th>
                              <th class="">Nombre</th>
                              <th data-toggle="tooltip" data-original-title="">Alojamieno</th>
                              <th data-toggle="tooltip" data-original-title="Descripcion">Descripción</th>
                              <th>Imagen</th>
                              <th>Estado</th>
                              <th>Galeria</th>

                            </tr>
                          </thead>
                          <tbody></tbody>
                          <tfoot>
                            <tr>
                              <th class="text-center">#</th>
                              <th class="">Acciones</th>
                              <th class="">Nombre</th>
                              <th data-toggle="tooltip" data-original-title="">Alojamiento</th>
                              <th data-toggle="tooltip" data-original-title="Descripcion">Descripción</th>
                              <th>Imagen</th>
                              <th>Estado</th>
                              <th>Galeria</th>

                            </tr>
                          </tfoot>
                        </table>
                      </div>
                      <div id="galeria" style="display: none;">

                        <div class="col-12 g_imagenes">
                          <div class="card card-primary">
                            <div class="card-header">
                              <h4 class="card-title nombre_galeria"></h4>
                            </div>
                            <div class="card-body">
                              <div class="row imagenes_galeria">

                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-12 sin_imagenes">

                          <div class="card col-12 px-3 py-3" style="box-shadow: 0 0 1px rgb(0 0 0), 0 1px 3px rgb(0 0 0 / 60%);">
                            <!-- agregando -->
                            <div class="alert alert-warning alert-dismissible alerta">
                              <h5><i class="icon fas fa-exclamation-triangle"></i> Alerta!</h5>
                              NO TIENES NUNGINA IMAGEN ASIGNADA A TOURS
                            </div>
                          </div>

                        </div>

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

            <!-- Modal agregar tours -->
            <div class="modal fade" id="modal-agregar-tours">
              <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title titulo">Agregar Tours</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span class="text-danger" aria-hidden="true">&times;</span>
                    </button>
                  </div>

                  <div class="modal-body">
                    <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                      <!-- DATOS TUORS -->
                      <li class="nav-item">
                        <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">DATOS PRINCIPALES</a>
                      </li>
                      <!-- OTROS -->
                      <li class="nav-item">
                        <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">OTROS</a>
                      </li>
                      <!-- ITINERARIO -->
                      <li class="nav-item">
                        <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill" href="#custom-content-below-messages" role="tab" aria-controls="custom-content-below-messages" aria-selected="false">ITINERARIO</a>
                      </li>
                      <!--COSTOS-->
                      <li class="nav-item">
                        <a class="nav-link" id="custom-content-below-asistencia-tab" data-toggle="pill" href="#custom-content-below-asistencia" role="tab" aria-controls="custom-content-below-asistencia" aria-selected="false">COSTOS</a>
                      </li>

                      <!-- Mapa-->
                      <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-settings" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">RESUMEN</a>
                      </li>
                    </ul>
                    <!-- ======================================== -->
                    <!-- form start -->
                    <form id="form-tours" name="form-tours" method="POST">
                      <div class="tab-content" id="custom-content-below-tabContent">
                        <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                          <!-- Datos tours -->
                          <div class="card-body row datos_tours">
                            <!-- id tours -->
                            <input type="hidden" name="idtours" id="idtours" />

                            <!-- Nombre -->
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                              <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre del tours" />
                              </div>
                            </div>

                            <!-- Tipo Tours -->
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                              <div class="form-group">
                                <label for="idtipo_tours">Tipo Tours</label>
                                <select name="idtipo_tours" id="idtipo_tours" class="form-control select2" style="width: 100%;">
                                  <!-- Aqui listamos los tipos de tours -->
                                </select>
                              </div>
                            </div>
                            <!-- duracion -->
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                              <div class="form-group">
                                <label for="duracion">Duración</label>
                                <input type="text" name="duracion" class="form-control" id="duracion" placeholder="Duración" />
                              </div>
                            </div>

                            <!--Descripcion-->
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                              <div class="form-group">
                                <label for="descripcion">Descripción</label> <br />
                                <textarea name="descripcion" id="descripcion" class="form-control" rows="2"></textarea>
                              </div>
                            </div>

                            <!-- Factura -->
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                              <!-- linea divisoria -->
                              <div class="borde-arriba-naranja mt-4"></div>
                              <div class="row text-center">
                                <div class="col-md-12" style="padding-top: 15px; padding-bottom: 5px;">
                                  <label for="cip" class="control-label"> Imagen </label>
                                </div>
                                <div class="col-6 col-md-6 text-center">
                                  <button type="button" class="btn btn-success btn-block btn-xs" id="doc1_i"><i class="fas fa-upload"></i> Subir.</button>
                                  <input type="hidden" id="doc_old_1" name="doc_old_1" />
                                  <input style="display: none;" id="doc1" type="file" name="doc1" accept="application/pdf, image/*" class="docpdf" />
                                </div>
                                <div class="col-6 col-md-6 text-center">
                                  <button type="button" class="btn btn-info btn-block btn-xs" onclick="re_visualizacion(1, 'tours', 'perfil');"><i class="fas fa-redo"></i> Recargar.</button>
                                </div>
                              </div>
                              <div id="doc1_ver" class="text-center mt-4">
                                <img src="../dist/svg/doc_uploads.svg" alt="" width="50%" />
                              </div>
                              <div class="text-center" id="doc1_nombre"><!-- aqui va el nombre del pdf --></div>
                            </div>
                          </div>
                          <!-- /.card-body -->

                        </div>
                        <!-- /.tab-panel -->

                        <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                          <!-- OTROS -->
                          <div class="card-body row otros">

                            <!--incluye -->
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                              <div class="form-group">
                                <label for="incluye">Incluye <sup class="text-danger">*</sup> </label>
                                <textarea name="incluye" id="incluye" class="form-control" rows="10"></textarea>
                              </div>
                            </div>

                            <!-- no_incluye-->
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                              <div class="form-group">
                                <label for="no_incluye">No incluye <sup class="text-danger">*</sup> </label>
                                <textarea name="no_incluye" id="no_incluye" class="form-control" rows="10"></textarea>
                              </div>
                            </div>

                            <!--incluye,no_incluye recomendaciones-->
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                              <div class="form-group">
                                <label for="recomendaciones">Recomendaciones <sup class="text-danger">*</sup> </label>
                                <textarea name="recomendaciones" id="recomendaciones" class="form-control" rows="10"></textarea>
                              </div>
                            </div>

                          </div>

                        </div>
                        <!-- /.tab-panel -->

                        <div class="tab-pane fade" id="custom-content-below-messages" role="tabpanel" aria-labelledby="custom-content-below-messages-tab">
                          <!-- ITINERARIO -->
                          <div class="card-body row itinerario">

                            <!--ITINERARIO -->
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                              <div class="form-group">
                                <!-- <label for="incluye"> <sup class="text-danger">*</sup> </label>  -->
                                <textarea name="actividad" id="actividad" class="form-control"></textarea>
                              </div>
                            </div>

                          </div>
                        </div>
                        <!-- /.tab-panel  datos_tours,otros,itinerario,costos-->
                        <div class="tab-pane fade" id="custom-content-below-asistencia" role="tabpanel" aria-labelledby="custom-content-below-asistencia-tab">
                          <div class="card-body row costos">
                            <!-- costo -->
                            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                              <div class="form-group">
                                <label for="costo">Precio Regular</label>
                                <input type="text" name="costo" class="form-control" id="costo" placeholder="Precio Regular" onkeyup="funtion_switch();" />
                              </div>
                            </div>
                            <!-- Estado descuento -->
                            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                              <div class="form-group">
                                <label for="costo">Descuento</label> <br>
                                <div class="switch-toggle">
                                  <input type="checkbox" id="estado_switch" onchange="funtion_switch();">
                                  <label for="estado_switch"></label>
                                  <input type="hidden" id="estado_descuento" name="estado_descuento" value="0">
                                </div>
                              </div>
                            </div>
                            <!-- porcentaje descuento -->
                            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                              <div class="form-group">
                                <label for="porcentaje_descuento">Porcentaje</label>
                                <input type="text" name="porcentaje_descuento" class="form-control" id="porcentaje_descuento" onkeyup="calcular_monto_descuento();" placeholder="10 %" readonly />
                              </div>
                            </div>
                            <!-- monto_descuento -->
                            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                              <div class="form-group">
                                <label for="monto_descuento">Monto descuento</label>
                                <input type="text" name="monto_descuento" class="form-control" id="monto_descuento" placeholder="Monto descuento" readonly />
                              </div>
                            </div>
                          </div>

                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-settings" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
                          <div class="card-body row resumen">
                            <!-- Posee Alojamiento -->
                            <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                              <div class="form-group">
                                <label for="alajamiento">¿Incluye Alojamiento?</label> <br>
                                <div class="switch-toggle">
                                  <input type="checkbox" id="estado_switch2" onchange="funtion_switch2();">
                                  <label for="estado_switch2"></label>
                                  <input type="hidden" id="alojamiento" name="alojamiento" value="0">
                                </div>
                              </div>
                            </div>

                            <!--resumen de actividades -->
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                              <div class="form-group">
                                <label for="resumen_actividad">Resumen de Actividades <sup class="text-danger">*</sup> </label>
                                <textarea name="resumen_actividad" id="resumen_actividad" class="form-control" rows="10"></textarea>
                              </div>
                            </div>

                            <!--resumen de comida -->
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                              <div class="form-group">
                                <label for="resumen_comida">Resumen de Comida <sup class="text-danger">*</sup> </label>
                                <textarea name="resumen_comida" id="resumen_comida" class="form-control" rows="10"></textarea>
                              </div>
                            </div>
                          </div>

                        </div>
                        <!-- /.tab-panel -->
                      </div>

                      <button type="submit" style="display: none;" id="submit-form-tours">Submit</button>
                    </form>
                  </div>
                  <div class="modal-footer justify-content-between btn_footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" id="guardar_registro_tours">Guardar Cambios</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- MODAL - imagen valor-->
            <div class="modal fade bg-color-02020280" id="modal-ver-imagen-tours">
              <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content bg-color-0202022e shadow-none border-0">
                  <div class="modal-header">
                    <h4 class="modal-title text-white nombre-tours"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span class="text-white cursor-pointer" aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div id="imagen-tours" class="text-center"></div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal agregar galeria-tours -->
            <div class="modal fade" id="modal-agregar-galeria_tours">
              <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Agregar Galería</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span class="text-danger" aria-hidden="true">&times;</span>
                    </button>
                  </div>

                  <div class="modal-body">
                    <!-- form start -->
                    <form id="form-galeria-tours" name="form-galeria-tours" method="POST">
                      <div class="card-body row">

                        <!-- id galeria Tours -->
                        <input type="hidden" name="idgaleria_tours" id="idgaleria_tours" />
                        <input type="hidden" name="idtours_t" id="idtours_t" />

                        <!-- Descripción -->
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                          <div class="form-group">
                            <label for="direccion">Descripción</label>
                            <input type="text" name="descripcion_g" class="form-control" id="descripcion_g" placeholder="Descripción" />
                          </div>
                        </div>
                        <!-- imagen perfil -->
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                          <!-- linea divisoria -->
                          <div class="borde-arriba-naranja mt-4"></div>
                          <div class="row text-center">
                            <div class="col-md-12" style="padding-top: 15px; padding-bottom: 5px;">
                              <label for="cip" class="control-label"> Imagen </label>
                            </div>
                            <div class="col-6 col-md-6 text-center">
                              <button type="button" class="btn btn-success btn-block btn-xs" id="doc2_i"><i class="fas fa-upload"></i> Subir.</button>
                              <input type="hidden" id="doc_old_2" name="doc_old_2" />
                              <input style="display: none;" id="doc2" type="file" name="doc2" accept="application/pdf, image/*" class="docpdf" />
                            </div>
                            <div class="col-6 col-md-6 text-center">
                              <button type="button" class="btn btn-info btn-block btn-xs" onclick="re_visualizacion(1, 'paquete', 'galeria');"><i class="fas fa-redo"></i> Recargar.</button>
                            </div>
                          </div>
                          <div id="doc2_ver" class="text-center mt-4">
                            <img src="../dist/svg/doc_uploads.svg" alt="" width="50%" />
                          </div>
                          <div class="text-center" id="doc2_nombre"><!-- aqui va el nombre del pdf --></div>
                        </div>

                      </div>
                      <!-- /.card-body -->
                      <button type="submit" style="display: none;" id="submit-form-galeria_tours">Submit</button>
                    </form>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" id="guardar_registro_galeria_tours">Guardar Cambios</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- MODAL - imagen valor-->
            <div class="modal fade bg-color-02020280" id="modal-ver-imagen-galeria_tours">
              <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content bg-color-0202022e shadow-none border-0">
                  <div class="modal-header">
                    <h4 class="modal-title text-white nombre-galeria_tours"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span class="text-white cursor-pointer" aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div id="imagen-galeria_tours" class="text-center">
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
                    <h4 class="modal-title">Tours: <span class="nombre_comprobante text-bold"></span></h4>
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
                        <a class="btn btn-xs btn-block btn-info" href="#" id="ver_completo" target="_blank" type="button"><i class="fas fa-expand"></i> Ver completo.</a>
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
                    <h4 class="modal-title">Datos Tours</h4>
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
      } else {
        require 'noacceso.php';
      }
      require 'footer.php';
      ?>
    </div>
    <!-- /.content-wrapper -->

    <?php require 'script.php'; ?>
    <!-- Plugion summernote -->
    <script src="../plugins/summernote/summernote-bs4.min.js"></script>
    <!-- Ekko Lightbox -->
    <script src="../plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
    
    <!-- Funciones del modulo -->
    <script type="text/javascript" src="scripts/tours.js"></script>

    <script>
      $(function() {
        $('[data-toggle="tooltip"]').tooltip();
      });
    </script>
  </body>

  </html>

<?php
}
ob_end_flush();

?>