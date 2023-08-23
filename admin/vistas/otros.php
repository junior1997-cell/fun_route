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
    <link rel="stylesheet" href="../dist/css/switch.css">
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="../plugins/ekko-lightbox/ekko-lightbox.css">

    <style>
      table {
        border-collapse: collapse;
        /* Combina los bordes adyacentes */
      }

      th,
      td {
        border: 1px solid black;
        /* Establece un borde sólido de 1px de grosor en cada celda */
        padding: 8px;
        /* Agrega un relleno interno para mayor espacio entre el contenido y el borde */
      }

      /* .dataTables_length {
          display: none;
        } */
    </style>

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


          <!-- Main content -->
          <section class="content">
            <div class="container-fluid">
              <div class="row">

                <div class="col-12 col-sm-12 mt-4">
                  <div class="card card-primary card-outline card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">
                      <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="custom-tabs-three-producto-tab mostrarLengthMenu" data-toggle="pill" href="#custom-tabs-three-producto" role="tab" aria-controls="custom-tabs-three-producto" aria-selected="true"><i class="fas fa-building"></i> Bancos</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="custom-tabs-three-persona-tab mostrarLengthMenu" data-toggle="pill" href="#custom-tabs-three-persona" role="tab" aria-controls="custom-tabs-three-persona" aria-selected="false"><i class="fas fa-shopping-cart"></i> TIPOS </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="custom-tabs-three-compra-tab" data-toggle="pill" href="#custom-tabs-three-compra" role="tab" aria-controls="custom-tabs-three-compra" aria-selected="false"><i class="fas fa-hotel"></i> HOTELES</a>
                        </li>
                      </ul>
                    </div>

                    <!-- /.card -->
                  </div>
                </div>

                <div class="col-12">
                  <div class="tab-content" id="custom-tabs-three-tabContent">

                    <div class="tab-pane fade show active" id="custom-tabs-three-producto" role="tabpanel" aria-labelledby="custom-tabs-three-producto-tab">
                      <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                          <!-- TBLA - BANCOS-->
                          <div class="row">
                            <div class="col-sm-6">
                              <h2>BANCOS</h2>
                            </div>
                            <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">BANCOS</li>
                              </ol>
                            </div>
                            <div class="col-12">
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
                          </div>
                        </div>
                      </div>
                      <!-- /.row -->
                    </div>
                    <!-- /.tab-1 -->

                    <div class="tab-pane fade" id="custom-tabs-three-persona" role="tabpanel" aria-labelledby="custom-tabs-three-persona-tab">

                      <div class="row">

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
                    <!-- /.tab-2 -->

                    <div class="tab-pane fade" id="custom-tabs-three-compra" role="tabpanel" aria-labelledby="custom-tabs-three-compra-tab">

                      <div class="row">

                        <div class="col-4">
                          <div class="container-fluid">
                            <div class="card card-primary card-outline">
                              <div class="card-header">
                                <h3 class="card-title">
                                  <button type="button" class="btn bg-gradient-primary" data-toggle="modal" data-target="#modal-agregar-hotel" onclick="limpiar_hotel();"><i class="fas fa-plus-circle"></i> Agregar</button>
                                  HOTELES
                                </h3>
                              </div>
                              <div class="card-body">
                                <table id="tabla-hotel" class="table table-bordered table-striped display" style="width: 100% !important;">
                                  <thead>
                                    <tr>
                                      <th class="text-center">#</th>
                                      <th class=""><i class="fas fa-gears"></i></th>
                                      <th>Nombre</th>
                                      <!-- <th><i class="fas fa-arrow-right"></i></th> -->

                                    </tr>
                                  </thead>
                                  <tbody></tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-4">
                          <div class="container-fluid">
                            <div class="card card-primary card-outline">
                              <div class="card-header">
                                <h3 class="card-title">

                                  <button type="button" class="btn bg-gradient-primary" data-toggle="modal" data-target="#modal-agregar-habitacion" onclick="limpiar_habitacion();"><i class="fas fa-plus-circle"></i> Agregar</button>
                                  HABITACIÓN
                                </h3>
                              </div>
                              <div class="card-body">
                                <div class="vacio alert alert-warning" role="alert"> Elegir un Hotel! </div>
                                <div class="text-center" style="background-color: #b9deff; margin-bottom: 4px;"> <strong class="name_hotel"></strong> </div>
                                <div class="mTable" style="display: none;">
                                  <table id="tabla-habitacion" class="table table-bordered table-striped display" style="width: 100% !important;">
                                    <thead>
                                      <tr>
                                        <th class="text-center">#</th>
                                        <th class=""><i class="fas fa-gears"></i></th>
                                        <th>Nombre</th>
                                      </tr>
                                    </thead>
                                    <tbody></tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-4">
                          <div class="container-fluid">
                            <div class="card card-primary card-outline">
                              <div class="card-header">
                                <h3 class="card-title">
                                  <button type="button" class="btn bg-gradient-primary" data-toggle="modal" data-target="#modal-agregar-caracteristicas_h" onclick="limpiar_caracteristicas_h();"><i class="fas fa-plus-circle"></i> Agregar</button>
                                  CARACTERÍSTICAS DE HABITACIÓN
                                </h3>
                              </div>
                              <div class="card-body">
                                <div class="vacio_h alert alert-warning" role="alert"> Elegir una Habitación! </div>
                                <div class="text-center" style="background-color: #b9deff; margin-bottom: 4px;"> <strong class="name_habitacion"></strong> </div>
                                <div class="mTable" style="display: none;">
                                  <table id="tabla-caracteristicas_h" class="table table-bordered table-striped display" style="width: 100% !important;">
                                    <thead>
                                      <tr>
                                        <th class="text-center">#</th>
                                        <th class=""><i class="fas fa-gears"></i></th>
                                        <th>Nombre</th>
                                        <th>Estado</th>
                                      </tr>
                                    </thead>
                                    <tbody></tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>

                        </div>

                        <!-- CARACTERÍSTICAS DEL HOTEL -->
                        <div class="col-4">
                          <div class="container-fluid">
                            <div class="card card-primary card-outline">
                              <div class="card-header">
                                <h3 class="card-title">
                                  <button type="button" class="btn bg-gradient-primary" data-toggle="modal" data-target="#modal-agregar-caract-hotel" onclick="limpiar_caract_hotel();"><i class="fas fa-plus-circle"></i> Agregar</button>
                                  INSTALACIONES DE HOTEL
                                </h3>
                              </div>
                              <div class="card-body">
                                <div class="vacio alert alert-warning" role="alert"> Elegir un Hotel! </div>
                                <div class="text-center" style="background-color: #b9deff; margin-bottom: 4px;"> <strong class="name_hoteles"></strong> </div>
                                <div class="mTable" style="display: none;">
                                  <table id="tabla-caract-hotel" class="table table-bordered table-striped display" style="width: 100% !important;">
                                    <thead>
                                      <tr>
                                        <th class="text-center">#</th>
                                        <th class=""><i class="fas fa-gears"></i></th>
                                        <th>Nombre</th>
                                        <th>Estado</th>

                                      </tr>
                                    </thead>
                                    <tbody></tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>

                        </div>

                        <!-- GALERÍA DEL HOTEL -->
                        <div class="col-8">
                          <div class="container-fluid">
                            <div class="card card-primary card-outline">
                              <div class="card-header">
                                <h3 class="card-title">
                                  <button type="button" class="btn bg-gradient-primary" data-toggle="modal" data-target="#modal-agregar-imagen-hotel" onclick="limpiar_galeria_hotel();"><i class="fas fa-plus-circle"></i> Agregar</button>
                                  GALERÍA DE HOTEL
                                </h3>
                              </div>
                              <div class="card-body">
                                <div class="vacio alert alert-warning" role="alert"> Elegir un Hotel! </div>
                                <div class="text-center" style="background-color: #b9deff; margin-bottom: 4px;"> <strong class="name_hoteles"></strong> </div>
                                <div class="mGaleria" style="display: none;">
                                  
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
                                    <div class="card col-12 px-3 py-3" style="box-shadow: 0 0 1px rgb(0 0 0), 0 1px 3px rgb(0 0 0 / 60%);" >
                                        <!-- agregando -->
                                        <div class="alert alert-warning alert-dismissible alerta">
                                          <h5><i class="icon fas fa-exclamation-triangle"></i> Alerta!</h5>
                                          NO TIENES NUNGINA IMAGEN ASIGNADA A TU PAQUETE
                                        </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                        </div>

                      </div>
                        
                    </div>

                        
                    <!-- /.tab-3 -->
                  </div>
                </div>
              </div>
            </div>
            <!-- /.container-fluid -->
          </section>
          <!-- /.content -->


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

          <!-- MODAL - HOTELES -->
          <div class="modal fade" id="modal-agregar-hotel">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">HOTELES</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-danger" aria-hidden="true">&times;</span>
                  </button>
                </div>

                <div class="modal-body">
                  <!-- form start -->
                  <form id="form-hotel" name="form-hotel" method="POST" autocomplete="off">
                    <div class="card-body">
                      <div class="row" id="cargando-9-fomulario">
                        <!-- id idunidad_medida -->
                        <input type="hidden" name="idhoteles" id="idhoteles" />

                        <!-- nombre_hotel -->
                        <div class="col-lg-8">
                          <div class="form-group">
                            <label for="nombre_hotel">Nombre</label>
                            <input type="text" name="nombre_hotel" id="nombre_hotel" class="form-control" placeholder="Nombre Hotel" />
                          </div>
                        </div>
                        <!-- idhoteles,nro_estrellas, nombre_hotel -->
                        <!-- Nro Estrellas -->
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label for="nro_estrellas">Nro Estrellas</label>
                            <input type="text" name="nro_estrellas" id="nro_estrellas" class="form-control" placeholder="★★★★★" />
                          </div>
                        </div>

                        <!-- Imagen pérfil -->
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                          <label for="foto1">Imagen</label>
                          <div style="text-align: center;">
                            <img onerror="this.src='../dist/img/default/img_defecto_producto.jpg';" src="../dist/img/default/img_defecto_producto.jpg"
                              class="img-thumbnail" id="foto1_i" style="cursor: pointer !important; height: 100% !important;" width="auto" />
                            <input style="display: none;" type="file" name="foto1" id="foto1" accept="image/*" />
                            <input type="hidden" name="foto1_actual" id="foto1_actual" />
                            <div class="text-center" id="foto1_nombre"><!-- aqui va el nombre de la FOTO --></div>
                          </div>
                        </div>

                        <!-- barprogress -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
                          <div class="progress" id="barra_progress_hotel_div">
                            <div id="barra_progress_hotel" class="progress-bar" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: 0%;">
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
                    <button type="submit" style="display: none;" id="submit-form-hotel">Submit</button>
                  </form>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="limpiar_hotel();">Close</button>
                  <button type="submit" class="btn btn-success" id="guardar_registro_hotel">Guardar Cambios</button>
                </div>
              </div>
            </div>
          </div>

          <!-- MODAL - HABITACIONES -->
          <div class="modal fade" id="modal-agregar-habitacion">
            <div class="modal-dialog modal-dialog-scrollable modal-md">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">HABITACIÓN</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-danger" aria-hidden="true">&times;</span>
                  </button>
                </div>

                <div class="modal-body">
                  <!-- form start -->
                  <form id="form-habitacion" name="form-habitacion" method="POST" autocomplete="off">
                    <div class="card-body">
                      <div class="row" id="cargando-11-fomulario">
                        <!-- id idunidad_medida -->
                        <input type="hidden" name="idhoteles_G" id="idhoteles_G" />
                        <input type="hidden" name="idhabitacion" id="idhabitacion" />

                        <!-- nombre_habitacion -->
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label for="nombre_habitacion">Nombre</label>
                            <input type="text" name="nombre_habitacion" id="nombre_habitacion" class="form-control" placeholder="Nombre Habitación" />
                          </div>
                        </div>
                        <!-- idhoteles_G,idhabitacion, nombre_habitacion -->

                        <!-- barprogress -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
                          <div class="progress" id="barra_progress_habitacion_div">
                            <div id="barra_progress_habitacion" class="progress-bar" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: 0%;">
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
                    <button type="submit" style="display: none;" id="submit-form-habitacion">Submit</button>
                  </form>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="limpiar_habitacion();">Close</button>
                  <button type="submit" class="btn btn-success" id="guardar_registro_habitacion">Guardar Cambios</button>
                </div>
              </div>
            </div>
          </div>
          <!-- MODAL -CARACTERISTICAS HABITACIONES -->
          <div class="modal fade" id="modal-agregar-caracteristicas_h">
            <div class="modal-dialog modal-dialog-scrollable modal-md">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">CARACTERÍSTICA</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-danger" aria-hidden="true">&times;</span>
                  </button>
                </div>

                <div class="modal-body">
                  <!-- form start -->
                  <form id="form-caracteristicas_h" name="form-caracteristicas_h" method="POST" autocomplete="off">
                    <div class="card-body">
                      <div class="row" id="cargando-13-fomulario">
                        <!-- id idunidad_medida -->
                        <input type="hidden" name="iddetalle_habitacion" id="iddetalle_habitacion" />
                        <input type="hidden" name="idhabitacion_G" id="idhabitacion_G" />

                        <!-- nombre_caracteristica_h -->
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label for="nombre_caracteristica_h">Nombre</label>
                            <input type="text" name="nombre_caracteristica_h" id="nombre_caracteristica_h" class="form-control" placeholder="Nombre Habitación" />
                          </div>
                          <div class="form-group">
                            <label for="estado_si_no">Disponible</label> <br>
                            <div class="switch-toggle">
                              <input type="checkbox" id="estado_switch" onchange="switchFunction();">
                              <label for="estado_switch"></label>
                              <input type="hidden" id="estado_si_no" name="estado_si_no" value="0">
                            </div>
                          </div>
                        </div>
                        <!-- idhabitacion_G, iddetalle_habitacion, nombre_caracteristica_h -->

                        <!-- barprogress -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
                          <div class="progress" id="barra_progress_caracteristicas_h_div">
                            <div id="barra_progress_caracteristicas_h" class="progress-bar" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: 0%;">
                              0%
                            </div>
                          </div>
                        </div>

                      </div>

                      <div class="row" id="cargando-14-fomulario" style="display: none;">
                        <div class="col-lg-12 text-center">
                          <i class="fas fa-spinner fa-pulse fa-6x"></i><br />
                          <br />
                          <h4>Cargando...</h4>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <button type="submit" style="display: none;" id="submit-form-caracteristicas_h">Submit</button>
                  </form>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="limpiar_caracteristicas_h();">Close</button>
                  <button type="submit" class="btn btn-success" id="guardar_registro_caracteristicas_h">Guardar Cambios</button>
                </div>
              </div>
            </div>
          </div>

          <!-- MODAL - INSTALACIONES HOTELES -->
          <div class="modal fade" id="modal-agregar-caract-hotel">
            <div class="modal-dialog modal-dialog-scrollable modal-md">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">INSTALACIONES DE HOTEL</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-danger" aria-hidden="true">&times;</span>
                  </button>
                </div>

                <div class="modal-body">
                  <!-- form start -->
                  <form id="form-caract-hotel" name="form-caract-hotel" method="POST" autocomplete="off">
                    <div class="card-body">
                      <div class="row" id="cargando-15-fomulario">
                        <!-- id hotel e instalaciones -->
                        <input type="hidden" name="idhoteles_GN" id="idhoteles_GN" />
                        <input type="hidden" name="idinstalaciones_hotel" id="idinstalaciones_hotel" />

                        <!-- nombre_habitacion -->
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label for="nombre_c_hotel">Nombre</label>
                            <input type="text" name="nombre_c_hotel" id="nombre_c_hotel" class="form-control" placeholder="" />
                          </div>
                          <div class="form-group">
                            <label for="estatus">Disponible</label> <br>
                            <div class="switch-toggle">
                              <input type="checkbox" id="estado_switch2" onchange="switchFunction2();">
                              <label for="estado_switch2"></label>
                              <input type="hidden" id="estado_si_no2" name="estado_si_no2" value="0">
                            </div>
                          </div>
                        </div>
                        <!-- idhoteles_G,idhabitacion, nombre_habitacion -->

                        <!-- barprogress -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
                          <div class="progress" id="barra_progress_caract_hotel_div">
                            <div id="barra_progress_caract_hotel" class="progress-bar" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: 0%;">
                              0%
                            </div>
                          </div>
                        </div>

                      </div>

                      <div class="row" id="cargando-16-fomulario" style="display: none;">
                        <div class="col-lg-12 text-center">
                          <i class="fas fa-spinner fa-pulse fa-6x"></i><br />
                          <br />
                          <h4>Cargando...</h4>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <button type="submit" style="display: none;" id="submit-form-caract-hotel">Submit</button>
                  </form>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="limpiar_caract_hotel();">Close</button>
                  <button type="submit" class="btn btn-success" id="guardar_registro_caract_hotel">Guardar Cambios</button>
                </div>
              </div>
            </div>
          </div>

          
          <!-- MODAL AGREGAR IMAGEN -->
          <div class="modal fade" id="modal-agregar-imagen-hotel">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Agregar - Imagen</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-danger" aria-hidden="true">&times;</span>
                  </button>
                </div>

                <div class="modal-body">
                  <!-- form start -->
                  <form id="form-galeria-hotel" name="form-galeria-hotel" method="POST">
                    <div class="card-body">

                      <div class="row" id="cargando-17-fomulario">
                        <!-- id hotel -->
                        <input type="hidden" name="idhotelesG" id="idhotelesG" />
                        <!-- id galeria paquete  -->
                        <input type="hidden" name="idgaleria_hotel " id="idgaleria_hotel " />

                        <!-- Descripción -->
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                          <div class="form-group">
                            <label for="direccion_G">Descripción</label>
                            <input type="text" name="descripcion_G" class="form-control" id="descripcion_G" placeholder="Descripción" />
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
                              <button type="button" class="btn btn-success btn-block btn-xs" id="imagen_H_i"><i class="fas fa-upload"></i> Subir.</button>
                              <input type="hidden" id="doc_old" name="doc_old" />
                              <input style="display: none;" id="imagen_H" type="file" name="imagen_H" accept="application/pdf, image/*" class="docpdf" />
                            </div>
                            <div class="col-6 col-md-6 text-center">
                              <button type="button" class="btn btn-info btn-block btn-xs" onclick="re_visualizacion(1, 'hotel', 'galeria');"><i class="fas fa-redo"></i> Recargar.</button>
                            </div>
                          </div>
                          <div id="imagen_H_ver" class="text-center mt-4">
                            <img src="../dist/svg/doc_uploads.svg" alt="" width="50%" />
                          </div>
                          <div class="text-center" id="imagen_H_nombre"><!-- aqui va el nombre del pdf --></div>
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

                      <div class="row" id="cargando-18-fomulario" style="display: none;" >
                        <div class="col-lg-12 text-center">
                          <i class="fas fa-spinner fa-pulse fa-6x"></i><br><br>
                          <h4>Cargando...</h4>
                        </div>
                      </div>
                            
                    </div>
                    <!-- /.card-body -->
                    <button type="submit" style="display: none;" id="submit-form-galeria-hotel">Submit</button>
                  </form>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-danger" onclick="limpiar_galeria_hotel();" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-success" id="guardar_registro_galeria_hotel">Guardar Cambios</button>
                </div>

              </div>
            </div>
          </div>
            

          <!-- MODAL - VER IMAGEN HOTEL -->
          <div class="modal fade bg-color-02020280" id="modal-ver-imagen-hotel">
              <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content bg-color-0202022e shadow-none border-0">
                  <div class="modal-header">
                    <h4 class="modal-title text-white nombre-hotel"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span class="text-white cursor-pointer" aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div id="imagen-hotel" class="text-center">
                    </div>
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
    <script type="text/javascript" src="scripts/hotel.js"></script>
    <script type="text/javascript" src="scripts/otros.js"></script>
    <script type="text/javascript" src="scripts/bancos.js"></script>
    <script type="text/javascript" src="scripts/tipo.js"></script>
    <script type="text/javascript" src="scripts/tipo_tours.js"></script>
    <!-- Ekko Lightbox -->
    <script src="../plugins/ekko-lightbox/ekko-lightbox.min.js"></script>

    <!-- script para cambiar el valor del estado_Si_no -->
    <script>
      function switchFunction() {
        var switchCheckbox = document.getElementById("estado_switch");
        var hiddenInput = document.getElementById("estado_si_no");

        if (switchCheckbox.checked) {
          hiddenInput.value = "1";
        } else {
          hiddenInput.value = "0";
        }
      }
    </script>
    <script>
      function switchFunction2() {
        var switchCheckbox = document.getElementById("estado_switch2");
        var hiddenInput = document.getElementById("estado_si_no2");

        if (switchCheckbox.checked) {
          hiddenInput.value = "1";
        } else {
          hiddenInput.value = "0";
        }
      }
    </script>



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