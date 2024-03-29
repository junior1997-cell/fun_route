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
                      <ul class="nav nav-tabs" id="custom-tabs-otro-tab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="custom-tabs-persona-tab mostrarLengthMenu" data-toggle="pill" href="#custom-tabs-persona" role="tab" aria-controls="custom-tabs-persona" aria-selected="true"><i class="fa-solid fa-user-tie"></i> PERSONA</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="custom-tabs-tours-tab" data-toggle="pill" href="#custom-tabs-tours" role="tab" aria-controls="custom-tabs-tours" aria-selected="false"><i class="fa-solid fa-sun"></i> TOURS</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="custom-tabs-paquete-tab" data-toggle="pill" href="#custom-tabs-paquete" role="tab" aria-controls="custom-tabs-paquete" aria-selected="false"><i class="fas fa-shopping-cart"></i> PAQUETE</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="custom-tabs-hoteles-tab" data-toggle="pill" href="#custom-tabs-hoteles" role="tab" aria-controls="custom-tabs-hoteles" aria-selected="false"><i class="fas fa-hotel"></i> HOTELES</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="custom-tabs-empresa-tab" data-toggle="pill" href="#custom-tabs-empresa" role="tab" aria-controls="custom-tabs-empresa" aria-selected="false"><i class="fa-solid fa-briefcase"></i> EMPRESA</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="custom-tabs-sunat-tab" data-toggle="pill" href="#custom-tabs-sunat" role="tab" aria-controls="custom-tabs-sunat" aria-selected="false"><i class="fas fa-hotel"></i> SUNAT</a>
                        </li>
                      </ul>
                    </div>

                    <!-- /.card -->
                  </div>
                </div>

                <div class="col-12">
                  <div class="tab-content" id="custom-tabs-otro-tabContent">
                    <!-- ::::::::::::::::::: P E R S O N  A ::::::::::::::::::: -->
                    <div class="tab-pane fade show active" id="custom-tabs-persona" role="tabpanel" aria-labelledby="custom-tabs-persona-tab">
                      <div class="row">
                        <!-- TBLA - BANCOS-->
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">                          
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
                                    <!-- <button type="button" class="btn bg-gradient-success" data-toggle="modal" data-target="#modal-agregar-tipo" onclick="limpiar_tipo();"><i class="fas fa-plus-circle"></i> Agregar</button> -->
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
                      </div>
                      <!-- /.row -->
                    </div>
                    <!-- /.tab -->

                    <!-- ::::::::::::::::::: T O U R S ::::::::::::::::::: -->
                    <div class="tab-pane fade" id="custom-tabs-tours" role="tabpanel" aria-labelledby="custom-tabs-tours-tab">
                      <div class="row">
                        <!-- TBLA - TIPO TOURS-->
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

                    <!-- ::::::::::::::::::: P A Q U E T E ::::::::::::::::::: -->
                    <div class="tab-pane fade" id="custom-tabs-paquete" role="tabpanel" aria-labelledby="custom-tabs-paquete-tab">
                      <div class="row">                       
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                          -- vacio paquete --
                        </div>                        
                      </div>
                    </div>
                    <!-- /.tab -->
                    
                    <!-- ::::::::::::::::::: H O T E L E S ::::::::::::::::::: -->
                    <div class="tab-pane fade" id="custom-tabs-hoteles" role="tabpanel" aria-labelledby="custom-tabs-hoteles-tab">
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
                                        <th>Disponible</th>
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
                                        <th>Disponible</th>

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
                    <!-- /.tab -->

                    <!-- ::::::::::::::::::: E M P R E S A ::::::::::::::::::: -->
                    <div class="tab-pane fade" id="custom-tabs-empresa" role="tabpanel" aria-labelledby="custom-tabs-empresa-tab">
                      <div class="row">                       
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                          -- vacio empresa --
                        </div>                        
                      </div>
                    </div>
                    <!-- /.tab -->

                    <!-- ::::::::::::::::::: S U N A T ::::::::::::::::::: -->
                    <div class="tab-pane fade" id="custom-tabs-sunat" role="tabpanel" aria-labelledby="custom-tabs-sunat-tab">
                      <div class="row">                       
                        <!-- TBLA - TIPO TOURS-->
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                          <!-- Content Header (Page header) -->
                          <section class="content-header">
                            <div class="container-fluid">
                              <div class="row mb-2">
                                <div class="col-sm-6">
                                  <h1>Correlacion comprobantes</h1>
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
                                    <button type="button" class="btn bg-gradient-success" disabled  onclick="limpiar_correlacion();"><i class="fas fa-plus-circle"></i> Agregar</button>
                                    Admnistrar la correlacion .
                                  </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                  <table id="tabla-correlacion" class="table table-bordered table-striped display" style="width: 100% !important;">
                                    <thead>
                                      <tr>
                                        <th class="text-center">#</th>
                                        <th class="">Acciones</th>
                                        <th>Nombre</th>
                                        <th>Abrev.</th>
                                        <th>Serie</th>
                                        <th>Núm.</th>
                                        <th>Estado</th>
                                      </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                      <tr>
                                        <th class="text-center">#</th>
                                        <th class="">Acciones</th>
                                        <th>Nombre</th>
                                        <th>Abrev.</th>
                                        <th>Serie</th>
                                        <th>Núm.</th>
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
                    <!-- /.tab -->
                  </div>
                </div>
              </div>
            </div>
            <!-- /.container-fluid -->
          </section>
          <!-- /.content -->


          <!-- MODAL - BANCOS - charge 1,2 -->
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
                      <div class="row" id="cargando-1-fomulario">
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

                      <div class="row" id="cargando-2-fomulario" style="display: none;">
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

          <!-- MODAL - TIPO PERSONA - charge 3,4 -->
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
                      <div class="row" id="cargando-3-fomulario">
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

                      <div class="row" id="cargando-4-fomulario" style="display: none;">
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

          <!-- MODAL - TIPO TOURS - charge 5,6 -->
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
                      <div class="row" id="cargando-5-fomulario">
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

                      <div class="row" id="cargando-6-fomulario" style="display: none;">
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

          <!-- MODAL - HOTELES - charge 7,8 -->
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
                  <form id="form-hotel" name="form-hotel" method="POST" autocomplete="off" enctype="multipart/form-data">
                    <div class="card-body">
                      <div class="row" id="cargando-7-fomulario">
                        <!-- id idunidad_medida -->
                        <input type="hidden" name="idhoteles" id="idhoteles" />

                        <!-- nombre_hotel -->
                        <div class="col-lg-8">
                          <div class="form-group">
                            <label for="nombre_hotel">Nombre</label>
                            <input type="text" name="nombre_hotel" id="nombre_hotel" class="form-control" placeholder="Nombre Hotel" />
                          </div>
                        </div>
                        
                        <!-- Nro Estrellas -->
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label for="nro_estrellas">Nro Estrellas</label>
                            <input type="number" name="nro_estrellas" id="nro_estrellas" class="form-control" max="5" min="1" placeholder="★★★★★" />
                          </div>
                        </div>

                        <!-- Check in -->
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label for="check_in">Check in</label>
                            <div class="input-group date" id="d_check_in" data-target-input="nearest">
                              <input type="text" id="check_in" name="check_in" class="form-control datetimepicker-input" data-target="#d_check_in"/>
                              <div class="input-group-append" data-target="#d_check_in" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Check out -->
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label for="check_out">Check out</label>
                            <div class="input-group date" id="d_check_out" data-target-input="nearest">
                              <input type="text" id="check_out" name="check_out" class="form-control datetimepicker-input" data-target="#d_check_out"/>
                              <div class="input-group-append" data-target="#d_check_out" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Imagen pérfil -->
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                          <label for="foto1">Imagen</label>
                          <div style="text-align: center;">
                            <img onerror="this.src='../dist/img/default/img_defecto_hotel.jpg';" src="../dist/img/default/img_defecto_hotel.jpg"
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

                      <div class="row" id="cargando-8-fomulario" style="display: none;">
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

          <!-- MODAL - HABITACIONES charge 9,10 -->
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
                      <div class="row" id="cargando-9-fomulario">
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

                      <div class="row" id="cargando-10-fomulario" style="display: none;">
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

          <!-- MODAL -CARACTERISTICAS HABITACIONES - charge 11,12 -->
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
                      <div class="row" id="cargando-11-fomulario">
                        <!-- id idunidad_medida -->
                        <input type="hidden" name="iddetalle_habitacion" id="iddetalle_habitacion" />
                        <input type="hidden" name="idhabitacion_G" id="idhabitacion_G" />

                        <!-- nombre_caracteristica_h -->
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label for="nombre_caracteristica_h">Nombre</label>
                            <input type="text" name="nombre_caracteristica_h" id="nombre_caracteristica_h" class="form-control" placeholder="Nombre Habitación" />
                          </div>                          
                        </div>

                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                          <div class="form-group">
                            <label for="estado_switch">Disponible</label> <br>
                            <div class="switch-toggle">
                              <input type="checkbox" id="estado_switch" onchange="switchFunction();">
                              <label for="estado_switch"></label>
                              <input type="hidden" id="estado_si_no" name="estado_si_no" value="0">
                            </div>
                          </div>
                        </div>

                        <!-- Icono -->
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6" >
                          <div class="form-group">
                            <label for="icono_font_c">Icono </label>
                            <select name="icono_font_c" id="icono_font_c" class="form-control select2" style="width: 100%;" onchange="ver_incono_c();"> 
                              <option value="fas fa-chevron-right" title="fas fa-chevron-right">Otros 1</option>
                              <option value="fas fa-arrow-right" title="fas fa-arrow-right">Otros 2</option>
                              <option value="fas fa-wifi" title="fas fa-wifi">Wiffi </option>
                              <option value="fas fa-tint" title="fas fa-tint">Gota</option>
                              <option value="fas fa-shower" title="fas fa-shower">Ducha 1</option>
                              <option value="fas fa-bath" title="fas fa-bath">Ducha 2</option>                              
                              <option value="fas fa-toilet-paper" title="fas fa-toilet-paper">Baño</option>                              
                              <option value="fas fa-phone-alt" title="fas fa-phone-alt">Telefono 1</option>
                              <option value="fas fa-phone-volume" title="fas fa-phone-volume">Telefono 2</option>
                              <option value="fas fa-mobile-alt" title="fas fa-mobile-alt">Telefono 3</option>
                              <option value="fas fa-tv" title="fas fa-tv">Television (TV)</option>
                              <option value="fas fa-wind" title="fas fa-wind">Aire 1</option>
                              <option value="fas fa-fan" title="fas fa-fan">Aire 2</option>                               
                              <option value="fab fa-cc-visa" title="fab fa-cc-visa">Pago 1</option>                               
                              <option value="fab fa-cc-mastercard" title="fab fa-cc-mastercard">Pago 2</option>                               
                              <option value="fab fa-bitcoin" title="fab fa-bitcoin">pago 3</option>                               
                              <option value="fas fa-credit-card" title="fas fa-credit-card">pago 4</option>                               
                              <option value="fab fa-cc-paypal" title="fab fa-cc-paypal"> pago 5</option>                               
                              <option value="fa-solid fa-soap" title="fa-solid fa-soap">Refrigeradora 1 </option> 
                              <option value="far fa-snowflake" title="far fa-snowflake">Refrigeradora 1</option> 
                              <option value="fas fa-utensils" title="fas fa-utensils">Restaurante 1</option> 
                              <option value="fas fa-concierge-bell" title="fas fa-concierge-bell">Restaurante 2</option> 
                              <option value="fas fa-hamburger" title="fas fa-hamburger">Amburguesa</option> 
                              <option value="fas fa-pizza-slice" title="fas fa-pizza-slice">Pizza</option> 
                              <option value="fas fa-fish" title="fas fa-fish">Pescado</option> 
                              <option value="fas fa-drumstick-bite" title="fas fa-drumstick-bite">Pollo</option> 
                              <option value="fas fa-hotdog" title="fas fa-hotdog">Hotdog</option> 
                              <option value="fas fa-swimming-pool" title="fas fa-swimming-pool">Piscina 1</option> 
                              <option value="fas fa-swimmer" title="fas fa-swimmer">Piscina 2</option> 
                              <option value="fas fa-water" title="fas fa-water">Piscina 3</option> 
                              <option value="fas fa-luggage-cart" title="fas fa-luggage-cart">Asensor</option> 
                              <option value="fas fa-glass-martini-alt" title="fas fa-glass-martini-alt">Bar 1</option> 
                              <option value="fas fa-glass-cheers" title="fas fa-glass-cheers">Bar 2</option> 
                              <option value="fas fa-wine-bottle" title="fas fa-wine-bottle">Bar 3</option> 
                              <option value="fas fa-cocktail" title="fas fa-cocktail">Bar 4</option> 
                              <option value="fas fa-dumbbell" title="fas fa-dumbbell">Gimnasio</option> 
                              <option value="fas fa-biking" title="fas fa-biking">Bicicleta</option> 
                              <option value="fas fa-warehouse" title="fas fa-warehouse">Cochera</option> 
                              <option value="fas fa-building" title="fas fa-building">Hotel</option> 
                              <option value="fas fa-bed" title="fas fa-bed">Dormitorio</option> 
                              <option value="fas fa-couch" title="fas fa-couch">Mueble 1</option> 
                              <option value="fas fa-chair" title="fas fa-chair">Mueble 2</option> 
                              <option value="fas fa-shuttle-van" title="fas fa-shuttle-van">Movilidad 1</option> 
                              <option value="fas fa-car" title="fas fa-car">Movilidad 2</option> 
                            </select>
                          </div>
                        </div>
                        
                        <!-- barprogress -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
                          <div class="progress" id="barra_progress_caracteristicas_h_div">
                            <div id="barra_progress_caracteristicas_h" class="progress-bar" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: 0%;">
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

          <!-- MODAL - INSTALACIONES HOTELES - charge 13,14 -->
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
                      <div class="row" id="cargando-13-fomulario">
                        <!-- id hotel e instalaciones -->
                        <input type="hidden" name="idhoteles_GN" id="idhoteles_GN" />
                        <input type="hidden" name="idinstalaciones_hotel" id="idinstalaciones_hotel" />

                        <!-- nombre_habitacion -->
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label for="nombre_c_hotel">Nombre</label>
                            <input type="text" name="nombre_c_hotel" id="nombre_c_hotel" class="form-control" placeholder="" />
                          </div>                          
                        </div>

                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                          <div class="form-group">
                            <label for="estado_switch2">Disponible</label> <br>
                            <div class="switch-toggle">
                              <input type="checkbox" id="estado_switch2" onchange="switchFunction2();">
                              <label for="estado_switch2"></label>
                              <input type="hidden" id="estado_si_no2" name="estado_si_no2" value="0">
                            </div>
                          </div>
                        </div>
                        <!-- Icono -->
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6" >
                          <div class="form-group">
                            <label for="icono_font_i">Icono </label>
                            <select name="icono_font_i" id="icono_font_i" class="form-control select2" style="width: 100%;" onchange="ver_incono_i();"> 
                              <option value="fas fa-chevron-right" title="fas fa-chevron-right">Otros 1</option>
                              <option value="fas fa-arrow-right" title="fas fa-arrow-right">Otros 2</option>
                              <option value="fas fa-wifi" title="fas fa-wifi">Wiffi </option>
                              <option value="fas fa-tint" title="fas fa-tint">Gota</option>
                              <option value="fas fa-shower" title="fas fa-shower">Ducha 1</option>
                              <option value="fas fa-bath" title="fas fa-bath">Ducha 2</option>                              
                              <option value="fas fa-toilet-paper" title="fas fa-toilet-paper">Baño</option>                              
                              <option value="fas fa-phone-alt" title="fas fa-phone-alt">Telefono 1</option>
                              <option value="fas fa-phone-volume" title="fas fa-phone-volume">Telefono 2</option>
                              <option value="fas fa-mobile-alt" title="fas fa-mobile-alt">Telefono 3</option>
                              <option value="fas fa-tv" title="fas fa-tv">Television (TV)</option>
                              <option value="fas fa-wind" title="fas fa-wind">Aire 1</option>
                              <option value="fas fa-fan" title="fas fa-fan">Aire 2</option>                               
                              <option value="fab fa-cc-visa" title="fab fa-cc-visa">Pago 1</option>                               
                              <option value="fab fa-cc-mastercard" title="fab fa-cc-mastercard">Pago 2</option>                               
                              <option value="fab fa-bitcoin" title="fab fa-bitcoin">pago 3</option>                               
                              <option value="fas fa-credit-card" title="fas fa-credit-card">pago 4</option>                               
                              <option value="fab fa-cc-paypal" title="fab fa-cc-paypal"> pago 5</option>                               
                              <option value="fa-solid fa-soap" title="fa-solid fa-soap">Refrigeradora 1 </option> 
                              <option value="far fa-snowflake" title="far fa-snowflake">Refrigeradora 1</option> 
                              <option value="fas fa-utensils" title="fas fa-utensils">Restaurante 1</option> 
                              <option value="fas fa-concierge-bell" title="fas fa-concierge-bell">Restaurante 2</option> 
                              <option value="fas fa-hamburger" title="fas fa-hamburger">Amburguesa</option> 
                              <option value="fas fa-pizza-slice" title="fas fa-pizza-slice">Pizza</option> 
                              <option value="fas fa-fish" title="fas fa-fish">Pescado</option> 
                              <option value="fas fa-drumstick-bite" title="fas fa-drumstick-bite">Pollo</option> 
                              <option value="fas fa-hotdog" title="fas fa-hotdog">Hotdog</option> 
                              <option value="fas fa-swimming-pool" title="fas fa-swimming-pool">Piscina 1</option> 
                              <option value="fas fa-swimmer" title="fas fa-swimmer">Piscina 2</option> 
                              <option value="fas fa-water" title="fas fa-water">Piscina 3</option> 
                              <option value="fas fa-luggage-cart" title="fas fa-luggage-cart">Asensor</option> 
                              <option value="fas fa-glass-martini-alt" title="fas fa-glass-martini-alt">Bar 1</option> 
                              <option value="fas fa-glass-cheers" title="fas fa-glass-cheers">Bar 2</option> 
                              <option value="fas fa-wine-bottle" title="fas fa-wine-bottle">Bar 3</option> 
                              <option value="fas fa-cocktail" title="fas fa-cocktail">Bar 4</option> 
                              <option value="fas fa-dumbbell" title="fas fa-dumbbell">Gimnasio</option> 
                              <option value="fas fa-biking" title="fas fa-biking">Bicicleta</option> 
                              <option value="fas fa-warehouse" title="fas fa-warehouse">Cochera</option> 
                              <option value="fas fa-building" title="fas fa-building">Hotel</option> 
                              <option value="fas fa-bed" title="fas fa-bed">Dormitorio</option> 
                              <option value="fas fa-couch" title="fas fa-couch">Mueble 1</option> 
                              <option value="fas fa-chair" title="fas fa-chair">Mueble 2</option> 
                              <option value="fas fa-shuttle-van" title="fas fa-shuttle-van">Movilidad 1</option> 
                              <option value="fas fa-car" title="fas fa-car">Movilidad 2</option> 
                            </select>
                          </div>
                        </div>

                        <!-- barprogress -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
                          <div class="progress" id="barra_progress_caract_hotel_div">
                            <div id="barra_progress_caract_hotel" class="progress-bar" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: 0%;">
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
          
          <!-- MODAL AGREGAR IMAGEN charge 15,16 -->
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

                      <div class="row" id="cargando-15-fomulario">
                        <!-- id hotel -->
                        <input type="hidden" name="idhotelesG" id="idhotelesG" />
                        <!-- id galeria paquete  -->
                        <input type="hidden" name="idgaleria_hotel " id="idgaleria_hotel " />

                        <!-- Descripción -->
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                          <div class="form-group">
                            <label for="descripcion_G">Descripción</label>
                            <input type="text" name="descripcion_G" class="form-control" id="descripcion_G" placeholder="Descripción" />
                          </div>
                        </div>
                        <!-- imagen perfil -->
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                          <!-- linea divisoria -->
                          <div class="borde-arriba-naranja mt-4"></div>
                          <div class="row text-center">
                            <div class="col-md-12" style="padding-top: 15px; padding-bottom: 5px;">
                              <label class="control-label"> Imagen </label>
                            </div>
                            <div class="col-6 col-md-6 text-center">
                              <button type="button" class="btn btn-success btn-block btn-xs" id="imagen_H_i"><i class="fas fa-upload"></i> Subir.</button>
                              <input type="hidden" id="doc_old" name="doc_old" />
                              <input style="display: none;" id="imagen_H" type="file" name="imagen_H" accept="application/pdf, image/*" class="docpdf" />
                            </div>
                            <div class="col-6 col-md-6 text-center">
                              <button type="button" class="btn btn-info btn-block btn-xs" onclick="re_visualizacion(1, 'admin/dist/docs/hotel/galeria/', '100%'); reload_zoom();"><i class="fas fa-redo"></i> Recargar.</button>
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

                      <div class="row" id="cargando-16-fomulario" style="display: none;" >
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

          <!-- MODAL - CORRELACION COMPROBANTE - charge 17,18 -->
          <div class="modal fade" id="modal-agregar-correlacion">
            <div class="modal-dialog modal-dialog-scrollable modal-md">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Correlacion Comprobante</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-danger" aria-hidden="true">&times;</span>
                  </button>
                </div>

                <div class="modal-body">
                  <!-- form start -->
                  <form id="form-correlacion" name="form-correlacion" method="POST" autocomplete="off">
                    <div class="card-body">
                      <div class="row" id="cargando-17-fomulario">
                        <!-- id hotel e instalaciones -->
                        <input type="hidden" name="idcorrelacion" id="idcorrelacion" />

                        <!-- nombre_habitacion -->
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label for="nombre_co">Nombre</label>
                            <input type="text" name="nombre_co" id="nombre_co" class="form-control" placeholder="Nombre" readonly />
                          </div>                          
                        </div>

                        <!-- Abreviatura -->
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label for="abreviatura_co">Abreviatura</label>
                            <input type="text" name="abreviatura_co" id="abreviatura_co" class="form-control" placeholder="Abreviatura" readonly />
                          </div>                          
                        </div>

                        <!-- Serie -->
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="serie_co">Serie</label>
                            <input type="text" name="serie_co" id="serie_co" class="form-control" placeholder="Serie" />
                          </div>                          
                        </div>

                        <!-- Número -->
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="numero_co">Número</label>
                            <input type="text" name="numero_co" id="numero_co" class="form-control" placeholder="Número" />
                          </div>                          
                        </div>                                         

                        <!-- barprogress -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
                          <div class="progress" id="barra_progress_correlacion_div">
                            <div id="barra_progress_correlacion" class="progress-bar" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: 0%;">
                              0%
                            </div>
                          </div>
                        </div>

                      </div>

                      <div class="row" id="cargando-18-fomulario" style="display: none;">
                        <div class="col-lg-12 text-center">
                          <i class="fas fa-spinner fa-pulse fa-6x"></i><br />
                          <br />
                          <h4>Cargando...</h4>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <button type="submit" style="display: none;" id="submit-form-correlacion">Submit</button>
                  </form>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="limpiar_correlacion();">Close</button>
                  <button type="submit" class="btn btn-success" id="guardar_registro_correlacion">Guardar Cambios</button>
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
    <script type="text/javascript" src="scripts/hotel.js"></script>
    <script type="text/javascript" src="scripts/bancos.js"></script>
    <script type="text/javascript" src="scripts/tipo_persona.js"></script>
    <script type="text/javascript" src="scripts/tipo_tours.js"></script>
    <script type="text/javascript" src="scripts/correlacion_comprobante.js"></script>
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