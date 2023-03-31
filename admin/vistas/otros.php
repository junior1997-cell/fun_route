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
        <title>Otros | Admin Integra</title>

        <?php $title = "Otros"; require 'head.php'; ?>

        <!--CSS  switch_MATERIALES-->
        <link rel="stylesheet" href="../dist/css/switch_materiales.css" />
      </head>
      <body class="hold-transition sidebar-collapse sidebar-mini layout-fixed layout-navbar-fixed">
        <!-- Content Wrapper. Contains page content -->
        <div class="wrapper">
          <?php
          require 'nav.php';
          require 'aside.php';
          if ($_SESSION['recurso']==1){
            //require 'enmantenimiento.php';
            ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
              <div class="row">

                <!-- TBLA - BANCOS -->
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                  <!-- Content Header (Page header) -->
                  <section class="content-header">
                    <div class="container-fluid">
                      <div class="row mb-2">
                        <div class="col-sm-6">
                          <h1>Bancos</h1>
                        </div>
                        <div class="col-sm-6">
                          <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Bancos</li>
                          </ol>
                        </div>
                      </div>
                    </div>
                    <!-- /.container-fluid -->
                  </section>

                  <!-- Main content -->
                  <section class="content">
                    <div class="container-fluid">
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
                    <!-- /.container-fluid -->
                  </section>
                  <!-- /.content -->
                </div>

                <!-- TBLA - UNIDAD DE MEDIDA-->
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                  <!-- Content Header (Page header) -->
                  <section class="content-header">
                    <div class="container-fluid">
                      <div class="row mb-2">
                        <div class="col-sm-6">
                          <h1>Unidades de Medida</h1>
                        </div>
                        <div class="col-sm-6">
                          <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Unidad de Medida</li>
                          </ol>
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
                            <button type="button" class="btn bg-gradient-success" data-toggle="modal" data-target="#modal-agregar-unidad-m" onclick="limpiar_unidades_m();"><i class="fas fa-plus-circle"></i> Agregar</button>
                            Admnistrar Unidad de medidas.
                          </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="tabla-unidades-m" class="table table-bordered table-striped display" style="width: 100% !important;">
                            <thead>
                              <tr>
                                <th class="text-center">#</th>
                                <th class="">Acciones</th>
                                <th>Nombre</th>
                                <th>Abreviación</th>
                                <th>Descripciòn</th>
                                <th>Estado</th>
                                
                              </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                              <tr>
                                <th class="text-center">#</th>
                                <th class="">Acciones</th>
                                <th>Nombre</th>
                                <th>Abreviación</th>
                                <th>Descripciòn</th>
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

                <!-- TBLA - CARGO-->
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                  <!-- Content Header (Page header) -->
                  <section class="content-header">
                    <div class="container-fluid">
                      <div class="row mb-2">
                        <div class="col-sm-6">
                          <h1>Cargos</h1>
                        </div>
                        <div class="col-sm-6">
                          <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Cargos</li>
                          </ol>
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
                            <button type="button" class="btn bg-gradient-success" data-toggle="modal" data-target="#modal-agregar-cargo" onclick="limpiar_cargo();"><i class="fas fa-plus-circle"></i> Agregar</button>
                            Admnistrar Cargos.
                          </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="tabla-cargo" class="table table-bordered table-striped display" style="width: 100% !important;">
                            <thead>
                              <tr>
                                <th class="text-center">#</th>
                                <th class="">Acciones</th>                                
                                <th>Nombre</th>
                                <th>Estado</th>
                              </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                              <tr>
                                <th class="text-center">#</th>
                                <th class="">Acciones</th>                                
                                <th>Nombre</th>
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

                <!-- TBLA - CATEGORIAS - ACTIVOS FIJO -->
                <div class="col-sm-12 col-md-12 col-lg-6g col-xl-6">
                  <!-- Content Header (Page header) -->
                  <section class="content-header">
                    <div class="container-fluid">
                      <div class="row mb-2">
                        <div class="col-sm-6">
                          <h1>Categorias Producto</h1>
                        </div>
                        <div class="col-sm-6">
                          <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Producto</li>
                          </ol>
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
                            <button type="button" class="btn bg-gradient-success" data-toggle="modal" data-target="#modal-agregar-categorias-af" onclick="limpiar_c_af();"><i class="fas fa-plus-circle"></i> Agregar</button>
                            Categorías Producto.
                          </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="tabla-categorias-af" class="table table-bordered table-striped display" style="width: 100% !important;">
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
                                <img
                                  onerror="this.src='../dist/img/default/img_defecto_banco.png';"
                                  src="../dist/img/default/img_defecto_banco.png"
                                  class="img-thumbnail"
                                  id="imagen1_i"
                                  style="cursor: pointer !important; height: 100% !important;"
                                  width="auto"
                                />
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
              

              <!-- MODAL - UNIDAD DE MEDIDA-->
              <div class="modal fade" id="modal-agregar-unidad-m">
                <div class="modal-dialog modal-dialog-scrollable modal-md">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Agregar Unidad de Medida</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-danger" aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="modal-body">
                      <!-- form start -->
                      <form id="form-unidad-m" name="form-unidad-m" method="POST" autocomplete="off">
                        <div class="card-body">
                          <div class="row" id="cargando-3-fomulario">
                            <!-- id idunidad_medida -->
                            <input type="hidden" name="idunidad_medida" id="idunidad_medida" />

                            <!-- nombre_medida -->
                            <div class="col-lg-12 class_pading">
                              <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre_medida" class="form-control" id="nombre_medida" placeholder="Nombre de la medida" />
                              </div>
                            </div>

                            <!-- abreviacion -->
                            <div class="col-lg-12 class_pading">
                              <div class="form-group">
                                <label for="abreviatura">Abreviación</label>
                                <input type="text" name="abreviatura" class="form-control" id="abreviatura" placeholder="abreviatura." />
                              </div>
                            </div>

                            <!-- Descripciòn -->
                            <div class="col-lg-12 class_pading">
                              <div class="form-group">
                                <label for="descripcion_m">Descripciòn</label>
                                <textarea name="descripcion_m" id="descripcion_m" class="form-control" rows="2"></textarea>                              
                              </div>
                            </div>

                            <!-- barprogress -->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
                              <div class="progress" id="div_barra_progress_um">
                                <div id="barra_progress_um" class="progress-bar" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: 0%;">
                                  0%
                                </div>
                              </div>
                            </div>

                          </div>

                          <div class="row" id="cargando-4-fomulario" style="display: none;">
                            <div class="col-lg-12 text-center">
                              <i class="fas fa-spinner fa-pulse fa-6x"></i><br />
                              <br />
                              <h4>Cargando...</h4>
                            </div>
                          </div>
                        </div>
                        <!-- /.card-body -->
                        <button type="submit" style="display: none;" id="submit-form-unidad-m">Submit</button>
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="limpiar_unidades_m();">Close</button>
                      <button type="submit" class="btn btn-success" id="guardar_registro_unidad_m">Guardar Cambios</button>
                    </div>
                  </div>
                </div>
              </div>

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

              <!-- MODAL - CARGO TRABAJDOR-->
              <div class="modal fade" id="modal-agregar-cargo">
                <div class="modal-dialog modal-dialog-scrollable modal-md">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Cargo</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-danger" aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="modal-body">
                      <!-- form start -->
                      <form id="form-cargo" name="form-cargo" method="POST" autocomplete="off">
                        <div class="card-body">
                          <div class="row" id="cargando-9-fomulario">
                            <!-- id idunidad_medida -->
                            <input type="hidden" name="idcargo_trabajador" id="idcargo_trabajador" />


                            <!-- nombre_trabajador -->
                            <div class="col-lg-12 class_pading">
                              <div class="form-group">
                                <label for="nombre_cargo">Nombre Cargo</label>
                                <input type="text" name="nombre_cargo" id="nombre_cargo" class="form-control" placeholder="Nombre Cargo" />
                              </div>
                            </div>

                            <!-- barprogress -->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
                              <div class="progress" id="div_barra_progress_cargo">
                                <div id="barra_progress_cargo" class="progress-bar" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: 0%;">
                                  0%
                                </div>
                              </div>
                            </div>

                          </div>

                          <div class="row" id="cargando-10-fomulario" style="display: none;">
                            <div class="col-lg-12 text-center">
                              <i class="fas fa-spinner fa-pulse fa-6x"></i><br />
                              <br />
                              <h4>Cargando...</h4>
                            </div>
                          </div>
                        </div>
                        <!-- /.card-body -->
                        <button type="submit" style="display: none;" id="submit-form-cargo">Submit</button>
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="limpiar_cargo();">Close</button>
                      <button type="submit" class="btn btn-success" id="guardar_registro_cargo">Guardar Cambios</button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- MODAL - CATEGORIAS - ACTIVO FIJO-->
              <div class="modal fade" id="modal-agregar-categorias-af">
                <div class="modal-dialog modal-dialog-scrollable modal-md">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Agregar categoría Producto</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-danger" aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="modal-body">
                      <!-- form start -->
                      <form id="form-categoria-af" name="form-categoria-af" method="POST" autocomplete="off">
                        <div class="card-body">
                          <div class="row" id="cargando-11-fomulario">
                            <!-- id categoria_insumos_af -->
                            <input type="hidden" name="idcategoria_producto" id="idcategoria_producto" />

                            <!-- nombre categoria -->
                            <div class="col-lg-12 class_pading">
                              <div class="form-group">
                                <label for="nombre_categoria">Nombre categoría</label>
                                <input type="text" name="nombre_categoria" id="nombre_categoria" class="form-control" placeholder="Nombre categoría" />
                              </div>
                            </div>
                            <!-- descripcion_cat categoria -->
                            <div class="col-lg-12 class_pading">
                              <div class="form-group">
                                <label for="descripcion_cat">Descripcion Categoria</label>
                                <textarea name="descripcion_cat" id="descripcion_cat" class="form-control" rows="2"></textarea>                                
                              </div>
                            </div>

                            <!-- barprogress -->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
                              <div class="progress" id="div_barra_progress_categoria_af">
                                <div id="barra_progress_categoria_af" class="progress-bar" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: 0%;">
                                  0%
                                </div>
                              </div>
                            </div>

                          </div>

                          <div class="row" id="cargando-12-fomulario" style="display: none;">
                            <div class="col-lg-12 text-center">
                              <i class="fas fa-spinner fa-pulse fa-6x"></i><br />
                              <br />
                              <h4>Cargando...</h4>
                            </div>
                          </div>
                        </div>
                        <!-- /.card-body -->
                        <button type="submit" style="display: none;" id="submit-form-cateogrias-af">Submit</button>
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="limpiar_c_af();">Close</button>
                      <button type="submit" class="btn btn-success" id="guardar_registro_categoria_af">Guardar Cambios</button>
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
                        <!-- vemos los datos del trabajador -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>

            <?php
          }else{
            require 'noacceso.php';
          }
          require 'footer.php';
          ?>
        </div>
        <!-- /.content-wrapper -->

        <?php  require 'script.php'; ?>
        
        <script type="text/javascript" src="scripts/otros.js"></script>
        <script type="text/javascript" src="scripts/bancos.js"></script>
        <script type="text/javascript" src="scripts/unidades_m.js"></script>
        <script type="text/javascript" src="scripts/tipo.js"></script>
        <script type="text/javascript" src="scripts/cargo.js"></script>
        <script type="text/javascript" src="scripts/categoria_p.js"></script>

        <script> $(function () { $('[data-toggle="tooltip"]').tooltip(); }); </script>
        
      </body>
    </html>

    <?php  
  }
  ob_end_flush();

?>
