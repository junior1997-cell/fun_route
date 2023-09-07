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
    <title>Paquetes | Admin Fun Route</title>

    <?php $title = "Paquetes";
    require 'head.php'; ?>
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="../plugins/ekko-lightbox/ekko-lightbox.css">
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
      if ($_SESSION['paquete_definido'] == 1) {
        //require 'enmantenimiento.php';
      ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1>Paquetes <b id="h1-nombre-paquete"></b></h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="otro_ingreso.php">Home</a></li>
                    <li class="breadcrumb-item active">Paquetes</li>
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
                      <h3 class="card-title btn-agregar">
                        <button type="button" class="btn bg-gradient-success" data-toggle="modal" data-target="#modal-agregar-paquete" onclick="limpiar_paquete(); show_hide_form(1);"><i class="fas fa-plus-circle"></i> Agregar</button>
                      </h3>
                      <!--  -->
                      <h3 class="card-title btn-regresar" style="display: none;" >
                        <button type="button" class="btn bg-gradient-warning btn-regresar" onclick="limpiar_galeria(); show_hide_form(1);"><i class="fas fa-arrow-left"></i> Regresar</button>

                        <button type="button" class="btn bg-gradient-success btn-agregar-galeria" data-toggle="modal" data-target="#modal-agregar-galeria" onclick="limpiar_galeria(); show_hide_form(2);"><i class="fas fa-plus-circle"></i> Agregar Galería</button>
                      </h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                      <div id="div-tabla-paquete">
                        <table id="tabla-paquete" class="table table-bordered table-striped display" style="width: 100% !important;">
                          <thead>
                            <tr>
                              <th class="text-center">#</th>
                              <th class="">Acciones</th>
                              <th class="">Paquete</th>
                              <th data-toggle="tooltip" data-original-title="Duración">Duración</th>
                              <th data-toggle="tooltip" data-original-title="Descripcion">Descripción</th>
                              <th>Recomendaciones</th>
                              <th>Costo</th>
                              <th>Estado</th>
                              <th>Galería</th>

                            </tr>
                          </thead>
                          <tbody></tbody>
                          <tfoot>
                            <tr>
                              <th class="text-center">#</th>
                              <th class="">Acciones</th>
                              <th class="">Paquete</th>
                              <th data-toggle="tooltip" data-original-title="Duración">Duración</th>
                              <th data-toggle="tooltip" data-original-title="Descripcion">Descripción</th>
                              <th>Recomendaciones</th>
                              <th>Costo</th>
                              <th>Estado</th>
                              <th>Galería</th>
                            </tr>
                          </tfoot>
                        </table>
                      </div>

                      <div id="div-galeria" style="display: none;">

                        <div class="col-12 g_imagenes">
                          <div class="card card-primary">
                            <div class="card-header">
                              <h4 class="card-title nombre_galeria"></h4>
                            </div>
                            <div class="card-body">
                              <div class="row imagenes_galeria text-center"> </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-12 sin_imagenes">
                          <div class="card col-12 px-3 py-3" style="box-shadow: 0 0 1px rgb(0 0 0), 0 1px 3px rgb(0 0 0 / 60%);" >
                            <!-- agregando -->
                            <div class="alert alert-warning alert-dismissible alerta">
                              <h5><i class="icon fas fa-exclamation-triangle"></i> Alerta!</h5> NO TIENES NUNGINA IMAGEN ASIGNADA A TU PAQUETE
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

            <!-- MODAL - AGREGAR PAQUETE charge-1 -->
            <div class="modal fade" id="modal-agregar-paquete">
              <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Agregar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span class="text-danger" aria-hidden="true">&times;</span>
                    </button>
                  </div>

                  <div class="modal-body">
                    <div id="cargando-1-fomulario">
                      <div class="card card-orange card-tabs">
                        <div class="card-header p-0 pt-1">
                          <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                            <!-- DATOS TUORS -->
                            <li class="nav-item">
                              <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Paquete</a>
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
                            <!--RESUMEN-->
                            <li class="nav-item">
                              <a class="nav-link" id="custom-content-below-informacion-tab" data-toggle="pill" href="#custom-content-below-informacion" role="tab" aria-controls="custom-content-below-informacion" aria-selected="false">RESUMEN</a>
                            </li>
                          </ul>
                        </div>
                        <!-- ======================================== -->
                        <!-- form start -->
                        <form id="form-paquete" name="form-paquete" method="POST">
                          <div class="tab-content" id="custom-content-below-tabContent">
                            <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                              <!-- Datos paquete -->
                              <div class="card-body row datos_paquete">
                                <!-- id paquete -->
                                <input type="hidden" name="idpaquete" id="idpaquete" />

                                <!-- Nombre -->
                                <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                                  <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre del paquete" />
                                  </div>
                                </div>

                                <!-- cant_dias -->
                                <div class="col-12 col-sm-12 col-md-2 col-lg-2">
                                  <div class="form-group">
                                    <label for="cant_dias">Días</label>
                                    <input type="number" name="cant_dias" class="form-control" id="cant_dias" placeholder="Dias" />
                                  </div>
                                </div>
                                <!-- cant_dias -->
                                <div class="col-12 col-sm-12 col-md-2 col-lg-2">
                                  <div class="form-group">
                                    <label for="cant_noches">Noches</label>
                                    <input type="number" name="cant_noches" class="form-control" id="cant_noches" placeholder="Noches" />
                                  </div>
                                </div>
                                <!--Alimentacion-->
                                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-6">
                                  <div class="form-group ">
                                    <label for="alimentacion">Alimentación</label> <br />
                                    <textarea name="alimentacion" id="alimentacion" class="form-control" rows="2"></textarea>
                                  </div>
                                </div>
                                <!--Alojamiento-->
                                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-6">
                                  <div class="form-group ">
                                    <label for="alojamiento">Alojamiento</label> <br />
                                    <textarea name="alojamiento" id="alojamiento" class="form-control" rows="2"></textarea>
                                  </div>
                                </div>

                                <!--Descripcion-->
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                  <div class="form-group ">
                                    <label for="descripcion">Descripción</label> <br />
                                    <textarea name="descripcion" id="descripcion" class="form-control" rows="2"></textarea>
                                  </div>
                                </div>

                                <!-- IMAGEN -->
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
                                      <button type="button" class="btn btn-info btn-block btn-xs" onclick="re_visualizacion(1, 'admin/dist/docs/paquete/perfil/', '100%'); reload_zoom();"><i class="fas fa-redo"></i> Recargar.</button>
                                    </div>
                                  </div>
                                  <div id="doc1_ver" class="text-center mt-4">
                                    <img src="../dist/img/default/img_defecto.png" alt="" width="50%" />
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

                                <!-- recomendaciones-->
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                  <div class="form-group">
                                    <label for="recomendaciones">Recomendaciones <sup class="text-danger">*</sup> </label>
                                    <textarea name="recomendaciones" id="recomendaciones" class="form-control" rows="10"></textarea>
                                  </div>
                                </div>
                                <!--mapa-->
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                  <div class="form-group ">
                                    <label for="mapa">Mapa - <a href="https://www.google.com/maps/d/u/0/" target="_blank">Crear mapa <i class="fa-solid fa-up-right-from-square"></i></a></label> <br />
                                    <textarea name="mapa" id="mapa" class="form-control" rows="2"></textarea>
                                  </div>
                                </div>
                              </div>

                            </div>
                            <!-- /.tab-panel -->

                            <div class="tab-pane fade" id="custom-content-below-messages" role="tabpanel" aria-labelledby="custom-content-below-messages-tab">
                              <!-- ITINERARIO -->
                              <div class="card-body row itinerario">
                                <!--ITINERARIO -->

                                <!-- Id Tours -->
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                  <div class="form-group">
                                    <label for="list_tours">Tours <sup class="text-danger">(unico*)</sup></label>
                                    <select name="list_tours" id="list_tours" class="form-control select2" style="width: 100%;" onchange="add_itinerario(this);" >
                                    </select>
                                    
                                  </div>
                                </div>

                                <div class="col-12 pl-0">
                                  <div class="text-primary"><label for="">ACTIVIDADES </label></div>
                                </div>

                                <div class="card col-12 px-3 py-3" id="html_itinerario" style="box-shadow: 0 0 1px rgb(0 0 0), 0 1px 3px rgb(0 0 0 / 60%);" >
                                    <!-- agregando -->
                                    <div class="alert alert-warning alert-dismissible delete_multiple_alerta">
                                      <h5><i class="icon fas fa-exclamation-triangle"></i> Alerta!</h5>
                                      NO TIENES NINGUNA ACTIVIDAD ASIGNADA A TU PAQUETE
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
                                    <input type="number" name="costo" class="form-control" id="costo" placeholder="Precio Regular" onkeyup="funtion_switch();" />
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
                            <!-- /.tab-panel -->

                            <div class="tab-pane fade" id="custom-content-below-informacion" role="tabpanel" aria-labelledby="custom-content-below-informacion-tab">
                              <!-- RESUMEN -->
                              <div class="card-body row resumen">

                                <!--resumen -->
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                  <div class="form-group">
                                    <label for="resumen">Resumen <sup class="text-danger">*</sup> </label>
                                    <textarea name="resumen" id="resumen" class="form-control" rows="10"></textarea>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- /.tab-panel -->
                          </div>
                          <button type="submit" style="display: none;" id="submit-form-paquete">Submit</button>
                        </form>

                        <div class="row">
                          <!-- barprogress -->
                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 m-t-20px" id="barra_progress_paquete_div">
                            <div class="progress" >
                              <div id="barra_progress_paquete" class="progress-bar" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: 0%;">
                                0%
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.cargando-1 -->
                    <div class="row" id="cargando-2-fomulario" style="display: none;" >
                      <div class="col-lg-12 text-center">
                        <i class="fas fa-spinner fa-pulse fa-6x"></i><br><br>
                        <h4>Cargando...</h4>
                      </div>
                    </div>
                    <!-- /.cargando-2 -->                    
                  </div>

                  <div class="modal-footer justify-content-between btn_footer">
                    <button type="button" class="btn btn-danger" onclick="limpiar_paquete();" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" id="guardar_registro_paquete">Guardar Cambios</button>
                  </div>

                </div>
              </div>
            </div>

            <!-- MODAL - VER IMAGEN-->
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

            <!-- MODAL - DETALLE TOURS  -->
            <div class="modal fade" id="modal-detalle-paquete">
              <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title titulo_detalle_paquete">Detalle Tours</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span class="text-danger" aria-hidden="true">&times;</span>
                    </button>
                  </div>

                  <div class="modal-body">
                    
                    <ul class="nav nav-tabs" id="custom-content-detalle-tab" role="tablist">
                      <!-- DATOS TUORS -->
                      <li class="nav-item">
                        <a class="nav-link active" id="custom-content-detalle-home_html-tab" data-toggle="pill" href="#custom-content-detalle-home_html" role="tab" aria-controls="custom-content-detalle-home_html" aria-selected="true">DATOS PRINCIPALES</a>
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
                    
                    <!-- ======================================== -->
                    
                    <div class="tab-content" id="custom-content-detalle-tabContent">
                      <div class="tab-pane fade show active home_html" id="custom-content-detalle-home_html" role="tabpanel" aria-labelledby="custom-content-detalle-home_html-tab">
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
                  <div class="modal-footer justify-content-between btn_footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- MODAL AGREGAR IMAGEN charge-3 -->
            <div class="modal fade" id="modal-agregar-galeria">
              <div class="modal-dialog modal-dialog-scrollable modal-md">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Agregar - Imagen</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span class="text-danger" aria-hidden="true">&times;</span>
                    </button>
                  </div>

                  <div class="modal-body">
                    <!-- form start -->
                    <form id="form-galeria" name="form-galeria" method="POST">
                      <div class="card-body">

                        <div class="row" id="cargando-3-fomulario">
                          <!-- id paquete -->
                          <input type="hidden" name="idpaqueteg" id="idpaqueteg" />
                          <!-- id galeria paquete  -->
                          <input type="hidden" name="idgaleria_paquete" id="idgaleria_paquete" />

                          <!-- Descripción -->
                          <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                              <label for="direccion">Descripción</label>
                              <textarea name="descripcion_g" class="form-control" id="descripcion_g" placeholder="Descripción" cols="30" rows="2"></textarea>
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
                                <input style="display: none;" id="doc2" type="file" name="doc2" accept="image/*" class="docpdf" />
                              </div>
                              <div class="col-6 col-md-6 text-center">
                                <button type="button" class="btn btn-info btn-block btn-xs" onclick="re_visualizacion(1, 'admin/dist/docs/paquete/galeria/', '100%'); reload_zoom();"><i class="fas fa-redo"></i> Recargar.</button>
                              </div>
                            </div>
                            <div id="doc2_ver" class="text-center mt-4">
                              <img src="../dist/img/default/img_defecto.png" alt="" width="50%" />
                            </div>
                            <div class="text-center" id="doc2_nombre"><!-- aqui va el nombre del pdf --></div>
                          </div>

                          <!-- Progress -->
                          <div class="col-md-12">
                            <div class="form-group">
                              <div class="progress" id="barra_progress_galeria_div" style="display: none !important;">
                                <div id="barra_progress_galeria" class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row" id="cargando-4-fomulario" style="display: none;" >
                          <div class="col-lg-12 text-center">
                            <i class="fas fa-spinner fa-pulse fa-6x"></i><br><br>
                            <h4>Cargando...</h4>
                          </div>
                        </div>
                              
                      </div>
                      <!-- /.card-body -->
                      <button type="submit" style="display: none;" id="submit-form-galeria">Submit</button>
                    </form>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" onclick="limpiar_galeria();" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" id="guardar_registro_galeria">Guardar Cambios</button>
                  </div>

                </div>
              </div>
            </div>            

          </section>
          <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

      <?php
      } else {
        require 'noacceso.php';
      }
      require 'footer.php';
      ?>
    </div>
    <!-- /.content-wrapper -->

    <?php require 'script.php'; ?>
    <!-- Ekko Lightbox -->
    <script src="../plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
    <!-- Plugion summernote -->
    <script src="../plugins/summernote/summernote-bs4.min.js"></script>
    <!-- Filterizr-->
    <script src="../plugins/filterizr/jquery.filterizr.min.js"></script>
    <!-- Funciones del modulo -->
    <script type="text/javascript" src="scripts/paquete.js"></script>

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