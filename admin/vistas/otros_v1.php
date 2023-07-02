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
    <title>Otros | Admin Fun Route</title>

    <?php $title = "Otros";
    require 'head.php'; ?>

    <!--CSS  switch_MATERIALES-->
    <link rel="stylesheet" href="../dist/css/switch_materiales.css" />
  </head>

  <body class="hold-transition sidebar-collapse sidebar-mini layout-fixed layout-navbar-fixed">
    <!-- Content Wrapper. Contains page content -->
    <div class="wrapper">
      <?php
      require 'nav.php';
      require 'aside.php';
      if ($_SESSION['recurso'] == 1) {
        //require 'enmantenimiento.php';
      ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <br>
          <div class="card-body">
            <div class="card card-primary card-outline">
              <div class="card-header">

                <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                  <!-- DATOS TUORS -->
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">BANCOS</a>
                  </li>
                  <!-- OTROS -->
                  <li class="nav-item">
                    <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">TIPOS</a>
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
                    <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-settings" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">Mapa</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">

              <div class="tab-content" id="custom-content-below-tabContent">

                <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                  <!-- Datos tours -->
                  <div class="card-body">

                    <div class="card card-primary card-outline">
                      <div class="card-header">
                        <h3 class="card-title">
                          <button type="button" class="btn bg-gradient-success" data-toggle="modal" data-target="#modal-agregar-bancos" onclick="limpiar_banco();"><i class="fas fa-plus-circle"></i> Agregar</button>
                          Administrar Bancos.
                        </h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                        <table id="tabla-bancos" class="table table-bordered table-striped display" style="width: 100% !important;">
                          <thead>
                            <tr>
                              <th class="text-center">#</th>
                              <th class="">Acciones</th>
                              <th>Nombre</th>
                              <th>Formato Cta/CCI</th>
                              <th>Estado</th>
                              <th>Nombre</th>
                              <th>Alias</th>
                              <th>Formato Cta</th>
                              <th>Formato CCI</th>
                              <th>Formato Cta. Dtrac.</th>
                            </tr>
                          </thead>
                          <tbody></tbody>
                          <tfoot>
                            <tr>
                              <th class="text-center">#</th>
                              <th class="">Acciones</th>
                              <th>Nombre</th>
                              <th>Formato</th>
                              <th>Estado</th>
                              <th>Nombre</th>
                              <th>Alias</th>
                              <th>Formato Cta</th>
                              <th>Formato CCI</th>
                              <th>Formato Cta. Dtrac.</th>
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                  </div>
                  <!-- /.card-body -->

                </div>
                <!-- /.tab-panel -->

                <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                  <!-- OTROS -->
                  <div class="card-body row otros">

                    <!-- TBLA - TIPO TRABAJADOR-->
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                      <!-- Content Header (Page header) -->
                      <section class="content-header">
                        <div class="container-fluid">
                          <div class="row mb-2">
                            <div class="col-sm-6">
                              <h1>Tipo Persona</h1>
                            </div>
                          </div>
                        </div>
                        <!-- /.container-fluid -->
                      </section>

                      <!-- Main content -->

                      <!-- Main content -->
                      <section class="content">
                        <div class="container-fluid">
                          <div class="card card-primary card-outline">
                            <div class="card-header">
                              <h3 class="card-title">
                                <button type="button" class="btn bg-gradient-success" data-toggle="modal" data-target="#modal-agregar-tipo" onclick="limpiar_tipo();"><i class="fas fa-plus-circle"></i> Agregar</button>
                                Admnistrar Tipo* .
                              </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                              <table id="tabla-tipo" class="table table-bordered table-striped display" style="width: 100% !important;">
                                <thead>
                                  <tr>
                                    <th class="text-center">#</th>
                                    <th class="">Acciones</th>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <th>Estado</th>
                                  </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                  <tr>
                                    <th class="text-center">#</th>
                                    <th class="">Acciones</th>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <th>Estado</th>
                                  </tr>
                                </tfoot>
                              </table>
                            </div>
                            <!-- /.card-body -->
                          </div>
                          <!-- /.card -->
                        </div>
                        <!-- /.container-fluid -->
                      </section>
                      <!-- /.content -->
                    </div>

                    <!-- TBLA - TIPO tours-->
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                      <!-- Content Header (Page header) -->
                      <section class="content-header">
                        <div class="container-fluid">
                          <div class="row mb-2">
                            <div class="col-sm-6">
                              <h1>Tipo tours</h1>
                            </div>
                          </div>
                        </div>
                        <!-- /.container-fluid -->
                      </section>

                      <!-- Main content -->

                      <!-- Main content -->
                      <section class="content">
                        <div class="container-fluid">
                          <div class="card card-primary card-outline">
                            <div class="card-header">
                              <h3 class="card-title">
                                <button type="button" class="btn bg-gradient-success" data-toggle="modal" data-target="#modal-agregar-tipo-tours" onclick="limpiar_tipo_tours();"><i class="fas fa-plus-circle"></i> Agregar</button>
                                Admnistrar Tipo Tours* .
                              </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                              <table id="tabla-tipo-tours" class="table table-bordered table-striped display" style="width: 100% !important;">
                                <thead>
                                  <tr>
                                    <th class="text-center">#</th>
                                    <th class="">Acciones</th>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <th>Estado</th>
                                  </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                  <tr>
                                    <th class="text-center">#</th>
                                    <th class="">Acciones</th>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <th>Estado</th>
                                  </tr>
                                </tfoot>
                              </table>
                            </div>
                            <!-- /.card-body -->
                          </div>
                          <!-- /.card -->
                        </div>
                        <!-- /.container-fluid -->
                      </section>
                      <!-- /.content -->
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
                <!-- /.tab-panel -->
              </div>
            </div>

          </div>

          <!-- MODAL - BANCOS -->
          <div class="modal fade" id="modal-agregar-bancos">
            <div class="modal-dialog modal-dialog-scrollable modal-md">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Agregar Banco</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-danger" aria-hidden="true">&times;</span>
                  </button>
                </div>

                <div class="modal-body">
                  <!-- form start -->
                  <form id="form-bancos" name="form-bancos" method="POST" autocomplete="off">
                    <div class="card-body">
                      <div class="row" id="cargando-a-fomulario">
                        <!-- id banco -->
                        <input type="hidden" name="idbancos" id="idbancos" />

                        <!-- Nombre -->
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                          <div class="form-group">
                            <label for="nombre_b">Nombre</label>
                            <input type="text" name="nombre_b" id="nombre_b" class="form-control" placeholder="Nombre del banco." />
                          </div>
                        </div>

                        <!-- alias -->
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                          <div class="form-group">
                            <label for="alias">Alias</label>
                            <input type="text" name="alias" id="alias" class="form-control" placeholder="Alias del banco." />
                          </div>
                        </div>

                        <!-- Formato cuenta bancaria -->
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                          <div class="form-group">
                            <label for="formato_cta">Formato Cuenta Bancaria</label>
                            <input type="text" name="formato_cta" id="formato_cta" class="form-control" placeholder="Formato." value="00000000" data-inputmask="'mask': ['99-99-99-99', '99 99 99 99']" data-mask />
                          </div>
                        </div>

                        <!-- Formato CCI -->
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                          <div class="form-group">
                            <label for="formato_cci">Formato CCI</label>
                            <input type="text" name="formato_cci" id="formato_cci" class="form-control" placeholder="Formato." value="00000000" data-inputmask="'mask': ['99-99-99-99', '99 99 99 99']" data-mask />
                          </div>
                        </div>

                        <!-- Formato CCI -->
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                          <div class="form-group">
                            <label for="formato_detracciones">Formato Detracción</label>
                            <input type="text" name="formato_detracciones" id="formato_detracciones" class="form-control" placeholder="Formato." value="00000000" data-inputmask="'mask': ['99-99-99-99', '99 99 99 99']" data-mask />
                          </div>
                        </div>

                        <!--img-material-->
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                          <label for="imagen1">Imagen</label>
                          <div style="text-align: center;">
                            <img onerror="this.src='../dist/img/default/img_defecto_banco.png';" src="../dist/img/default/img_defecto_banco.png" class="img-thumbnail" id="imagen1_i" style="cursor: pointer !important; height: 100% !important;" width="auto" />
                            <input style="display: none;" type="file" name="imagen1" id="imagen1" accept="image/*" />
                            <input type="hidden" name="imagen1_actual" id="imagen1_actual" />
                            <div class="text-center" id="imagen1_nombre"><!-- aqui va el nombre de la FOTO --></div>
                          </div>
                        </div>

                        <!-- barprogress -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
                          <div class="progress" id="div_barra_progress_banco">
                            <div id="barra_progress_banco" class="progress-bar" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: 0%;">
                              0%
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row" id="cargando-b-fomulario" style="display: none;">
                        <div class="col-lg-12 text-center">
                          <i class="fas fa-spinner fa-pulse fa-6x"></i><br />
                          <br />
                          <h4>Cargando...</h4>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <button type="submit" style="display: none;" id="submit-form-bancos">Submit</button>
                  </form>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="limpiar_banco();">Close</button>
                  <button type="submit" class="btn btn-success" id="guardar_registro">Guardar Cambios</button>
                </div>
              </div>
            </div>
          </div>

          <!-- MODAL - COLOR -->


          <!-- MODAL - OCUPACION-->
          <div class="modal fade" id="modal-agregar-ocupacion">
            <div class="modal-dialog modal-dialog-scrollable modal-md">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Agregar Ocupación</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-danger" aria-hidden="true">&times;</span>
                  </button>
                </div>

                <div class="modal-body">
                  <!-- form start -->
                  <form id="form-ocupacion" name="form-ocupacion" method="POST" autocomplete="off">
                    <div class="card-body">
                      <div class="row" id="cargando-5-fomulario">
                        <!-- id idunidad_medida -->
                        <input type="hidden" name="idocupacion" id="idocupacion" />
                        <!-- nombre_medida -->
                        <div class="col-lg-12 class_pading">
                          <div class="form-group">
                            <label for="nombre">Nombre Ocupación</label>
                            <input type="text" name="nombre_ocupacion" id="nombre_ocupacion" class="form-control" placeholder="Nombre de la Ocupación" />
                          </div>
                        </div>

                        <!-- barprogress -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
                          <div class="progress" id="div_barra_progress_ocupacion">
                            <div id="barra_progress_ocupacion" class="progress-bar" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: 0%;">
                              0%
                            </div>
                          </div>
                        </div>

                      </div>

                      <div class="row" id="cargando-6-fomulario" style="display: none;">
                        <div class="col-lg-12 text-center">
                          <i class="fas fa-spinner fa-pulse fa-6x"></i><br />
                          <br />
                          <h4>Cargando...</h4>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <button type="submit" style="display: none;" id="submit-form-ocupacion">Submit</button>
                  </form>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="limpiar_ocupacion();">Close</button>
                  <button type="submit" class="btn btn-success" id="guardar_registro_ocupacion">Guardar Cambios</button>
                </div>
              </div>
            </div>
          </div>

          <!-- MODAL - TIPO DE TRABAJDOR -->
          <div class="modal fade" id="modal-agregar-tipo">
            <div class="modal-dialog modal-dialog-scrollable modal-md">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Tipo Persona</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-danger" aria-hidden="true">&times;</span>
                  </button>
                </div>

                <div class="modal-body">
                  <!-- form start -->
                  <form id="form-tipo" name="form-tipo" method="POST" autocomplete="off">
                    <div class="card-body">
                      <div class="row" id="cargando-7-fomulario">
                        <!-- id idunidad_medida -->
                        <input type="hidden" name="idtipo_persona" id="idtipo_persona" />

                        <!-- nombre_medida -->
                        <div class="col-lg-12 class_pading">
                          <div class="form-group">
                            <label for="nombre_tipo">Nombre Tipo Persona</label>
                            <input type="text" name="nombre_tipo" id="nombre_tipo" class="form-control" placeholder="Nombre tipo Persona" />
                          </div>
                        </div>

                        <!-- Descripciòn -->
                        <div class="col-lg-12 class_pading">
                          <div class="form-group">
                            <label for="descripcion_t">Descripciòn</label>
                            <textarea name="descripcion_t" id="descripcion_t" class="form-control" rows="2"></textarea>
                          </div>
                        </div>

                        <!-- barprogress -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
                          <div class="progress" id="div_barra_progress_tipo">
                            <div id="barra_progress_tipo" class="progress-bar" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: 0%;">
                              0%
                            </div>
                          </div>
                        </div>

                      </div>

                      <div class="row" id="cargando-8-fomulario" style="display: none;">
                        <div class="col-lg-12 text-center">
                          <i class="fas fa-spinner fa-pulse fa-6x"></i><br />
                          <br />
                          <h4>Cargando...</h4>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <button type="submit" style="display: none;" id="submit-form-tipo">Submit</button>
                  </form>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="limpiar_tipo();">Close</button>
                  <button type="submit" class="btn btn-success" id="guardar_registro_tipo">Guardar Cambios</button>
                </div>
              </div>
            </div>
          </div>

          <!-- MODAL - VER PERFIL INSUMO-->
          <div class="modal fade" id="modal-ver-perfil-banco">
            <div class="modal-dialog modal-dialog-centered modal-md">
              <div class="modal-content bg-color-0202022e shadow-none border-0">
                <div class="modal-header">
                  <h4 class="modal-title text-white foto-banco">Foto Insumo</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-white cursor-pointer" aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div id="perfil-banco" class="class-style">
                    <!-- vemos iconos de insumo -->
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- MODAL - TIPO Tours -->
          <div class="modal fade" id="modal-agregar-tipo-tours">
            <div class="modal-dialog modal-dialog-scrollable modal-md">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Tipo Tours</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-danger" aria-hidden="true">&times;</span>
                  </button>
                </div>

                <div class="modal-body">
                  <!-- form start -->
                  <form id="form-tipo-tours" name="form-tipo-tours" method="POST" autocomplete="off">
                    <div class="card-body">
                      <div class="row" id="cargando-7-fomulario">
                        <!-- id idunidad_medida -->
                        <input type="hidden" name="idtipo_tours" id="idtipo_tours" />

                        <!-- nombre_medida -->
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label for="nombre_tt">Nombre</label>
                            <input type="text" name="nombre_tt" id="nombre_tt" class="form-control" placeholder="Nombre tipo Tours" />
                          </div>
                        </div>

                        <!-- Descripciòn -->
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label for="descripcion_tt">Descripciòn Tipo Tours</label>
                            <textarea name="descripcion_tt" id="descripcion_tt" class="form-control" rows="2"></textarea>
                          </div>
                        </div>

                        <!-- barprogress -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
                          <div class="progress" id="barra_progress_tipo_tours_div">
                            <div id="barra_progress_tipo_tours" class="progress-bar" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: 0%;">
                              0%
                            </div>
                          </div>
                        </div>

                      </div>

                      <div class="row" id="cargando-8-fomulario" style="display: none;">
                        <div class="col-lg-12 text-center">
                          <i class="fas fa-spinner fa-pulse fa-6x"></i><br />
                          <br />
                          <h4>Cargando...</h4>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <button type="submit" style="display: none;" id="submit-form-tipo-tours">Submit</button>
                  </form>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="limpiar_tipo_tours();">Close</button>
                  <button type="submit" class="btn btn-success" id="guardar_registro_tipo_tours">Guardar Cambios</button>
                </div>
              </div>
            </div>
          </div>

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

    <script type="text/javascript" src="scripts/otros.js"></script>
    <script type="text/javascript" src="scripts/bancos.js"></script>
    <script type="text/javascript" src="scripts/tipo.js"></script>
    <script type="text/javascript" src="scripts/tipo_tours.js"></script>

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