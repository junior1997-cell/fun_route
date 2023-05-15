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
    <title>GaleriaPaquete | Admin Fun Route</title>

    <?php $title = "Galeria_paquete";
    require 'head.php'; ?>

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
                  <h1>Pedido</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="otro_ingreso.php">Home</a></li>
                    <li class="breadcrumb-item active">Pedido</li>
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
                    <!--<div class="card-header">
                          <h3 class="card-title btn-regresar" style="display: none;">
                            <button type="button" class="btn bg-gradient-warning" onclick="limpiar_pedido(); show_hide_form(1);"><i class="fas fa-arrow-left"></i> Regresar</button>                            
                          </h3>
                          <h3 class="card-title btn-agregar">
                            <button type="button" class="btn bg-gradient-success" data-toggle="modal" data-target="#modal-agregar-pedido" onclick="limpiar_pedido(); show_hide_form(1);"><i class="fas fa-plus-circle"></i> Agregar</button>
                            Administra de manera eficiente tu pedido.
                          </h3>
                        </div>
                        <!-- /.card-header -->
                    <div class="card-body">

                      <div id="mostrar-tabla">
                        <table id="tabla-pedido" class="table table-bordered table-striped display" style="width: 100% !important;">
                          <thead>
                            <tr>
                              <th class="text-center">#</th>
                              <th class="">Acciones</th>
                              <th class="">Nombre Paquete </th>
                              <th class="">Nombre Pedido </th>
                              <th class="">Correo </th>
                              <th class="">Telefono </th>
                              <th data-toggle="tooltip" data-original-title="Descripcion">Descripción</th>
                              <th class="">Estado </th>

                            </tr>
                          </thead>
                          <tbody></tbody>
                          <tfoot>
                            <tr>
                              <th class="text-center">#</th>
                              <th class="">Acciones</th>
                              <th class="">Nombre Paquete </th>
                              <th class="">Nombre Pedido </th>
                              <th class="">Correo </th>
                              <th class="">Telefono </th>
                              <th data-toggle="tooltip" data-original-title="Descripcion">Descripción</th>
                              <th class="">Estado </th>

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

            <!-- Modal pedido-paquete -->
            <div class="modal fade" id="modal-agregar-pedido">
              <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">pedido</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span class="text-danger" aria-hidden="true">&times;</span>
                    </button>
                  </div>

                  <div class="modal-body">
                    <!-- form start -->
                    <form id="form-galeria-pedido" name="form-galeria-pedido" method="POST">
                      <div class="card-body row">

                        <!-- id pedido -->
                        <input type="hidden" name="idpedido" id="idpedido" />

                        <!-- Id paquete -->
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                          <div class="form-group">
                            <label for="idpaquete">Paquete <sup class="text-danger">(unico*)</sup></label>
                            <select name="idpaquete" id="idpaquete" class="form-control select2" style="width: 100%;">
                            </select>
                          </div>
                        </div>
                        <!--nombre-->
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                          <div class="form-group ">
                            <label for="nombre">Nombre</label> <br />
                            <textarea name="nombre" id="nombre" class="form-control" rows="2"></textarea>
                          </div>
                        </div>
                        <!--correo-->
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                          <div class="form-group ">
                            <label for="correo">Correo</label> <br />
                            <textarea name="correo" id="correo" class="form-control" rows="2"></textarea>
                          </div>
                        </div>
                        <!--telefono-->
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                          <div class="form-group ">
                            <label for="telefono">Telefono</label> <br />
                            <textarea name="telefono" id="telefono" class="form-control" rows="2"></textarea>
                          </div>
                        </div>
                        <!--Descripcion-->
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                          <div class="form-group ">
                            <label for="telefono">Descripción</label> <br />
                            <textarea name="descripcion" id="descripcion" class="form-control" rows="2"></textarea>
                          </div>
                        </div>
                      </div>
                      <!-- linea divisoria -->
                      <div class="borde-arriba-naranja mt-4"> </div>
                      <div class="row text-center">
                        <div class="col-md-12" style="padding-top: 15px; padding-bottom: 5px;">
                          <label for="cip" class="control-label"> Imagen </label>
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
                      <!-- /.card-body -->
                      <button type="submit" style="display: none;" id="submit-form-pedido">Submit</button>
                    </form>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" id="guardar_registro-pedido">Guardar Cambios</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- modal igen perfil-paquete-->
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
            <!-- ver detalles pedido-->
            <div class="modal fade" id="modal-ver-pedido">
              <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Detalle Pedido: <span class="ver_paquete text-bold"></span> </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span class="text-danger" aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <!-- Mostrar en html detalles pedido-->
                  <div class="modal-body">
                    <div class="tab-content" id="custom-tabs-two-tabContent">
                      <div class="row">
                        <div class="col-12 col-sm-12">
                          <div class="card card-primary card-tabs">
                            <div class="card-header p-0 pt-0">
                              <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                <li class="nav-item">
                                  <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Paquete</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Itinerario</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="custom-tabs-two-messages-tab" data-toggle="pill" href="#custom-tabs-two-messages" role="tab" aria-controls="custom-tabs-two-messages" aria-selected="false">Galeria</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="custom-tabs-two-settings-tab" data-toggle="pill" href="#custom-tabs-two-settings" role="tab" aria-controls="custom-tabs-two-settings" aria-selected="false">Mapa</a>
                                </li>
                              </ul>
                            </div>
                            <div class="card-body">
                              <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                                <!--cuadro de recepcion paquete-->
                                <div id="paquete">

                                </div>

                              </div>
                              <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                                <!-- Para mostrar itinerario-->  
                                <div id="itinerario">
                              
                                </div>
                              </div>
                              <div class="tab-pane fade" id="custom-tabs-two-messages" role="tabpanel" aria-labelledby="custom-tabs-two-messages-tab">
                              <!-- Para mostrar galeria del paquete-->
                              <div id="galeria" >

                              </div>
                                
                              </div>
                              <div class="tab-pane fade" id="custom-tabs-two-settings" role="tabpanel" aria-labelledby="custom-tabs-two-settings-tab">
                                mapa
                              </div>
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

    <!-- Funciones del modulo -->
    <script type="text/javascript" src="scripts/pedido.js"></script>

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