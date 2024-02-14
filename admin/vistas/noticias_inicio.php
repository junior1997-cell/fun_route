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
		<title>Noticias | Admin Fun Route</title>

		
    <?php $title = "Noticias"; require 'head.php'; ?>
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
        if ($_SESSION['acceso'] == 1) {
            //require 'enmantenimiento.php';
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1>Noticias <b id="h1-nombre-noticias"></b></h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="escritorio.php">Home</a></li>
                    <li class="breadcrumb-item active">Noticias</li>
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
                          <button type="button" class="btn bg-gradient-success" data-toggle="modal" data-target="#modal-agregar-noticia"><i class="fas fa-plus-circle"></i> Agregar</button>
                      </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                      <div id="div-galeria-noticia">
                        <div class="col-12 g_imagenes">
                          <div class="card card-primary">
                            <div class="card-header">
                              <h4 class="card-title nombre_galeria"></h4>
                            </div>
                            <div class="card-body">
                              <div class="row imagenes_galeria text-center"> 
                                <div class="col-lg-12 text-center">
                                  <i class="fas fa-spinner fa-pulse fa-6x"></i><br /> <br />  <h4>Cargando...</h4>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-12 sin_imagenes" style="display: none;">
                          <div class="card col-12 px-3 py-3" style="box-shadow: 0 0 1px rgb(0 0 0), 0 1px 3px rgb(0 0 0 / 60%);" >
                            <!-- agregando -->
                            <div class="alert alert-warning alert-dismissible alerta">
                              <h5><i class="icon fas fa-exclamation-triangle"></i> Alerta!</h5> NO TIENES NINGUNA NOTICIA ASIGNADA
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
          </section>
          <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->            


        <!-- MODAL AGREGAR IMAGEN charge-3 -->
        <div class="modal fade" id="modal-agregar-noticia">
          <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Agregar - Noticia</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span class="text-danger" aria-hidden="true">&times;</span>
                </button>
              </div>

              <div class="modal-body">
                <!-- form start -->
                <form id="form-noticia" name="form-noticia" method="POST">
                  <div class="card-body">
                    <div class="row" id="cargando-3-fomulario">
                      <input type="hidden" name="idnoticias_inicio" id="idnoticias_inicio" />

                      <!-- Descripción -->
                      <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                          <div class="form-group">
                            <label for="direccion">Título</label>
                            <input name="titulo" class="form-control" id="titulo" placeholder="Título" cols="30" rows="2"></input>
                          </div>
                        </div>
                      <!-- Descripción -->
                      <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                          <label for="direccion">Descripción</label>
                          <textarea name="descripcion" class="form-control" id="descripcion" placeholder="Descripción" cols="30" rows="2"></textarea>
                        </div>
                      </div>
                      <!-- imagen perfil -->
                      <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
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
                            <button type="button" class="btn btn-info btn-block btn-xs" onclick="re_visualizacion(1, 'admin/dist/docs/noticia_inicio/', '100%'); reload_zoom();"><i class="fas fa-redo"></i> Recargar.</button>
                          </div>
                        </div>
                        <div id="doc2_ver" class="text-center mt-4">
                          <img src="../dist/img/default/img_defecto.png" alt="" width="50%" />
                        </div>
                        <div class="text-center" id="doc2_nombre"><!-- aqui va el nombre del pdf --></div>
                      </div>
                      <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                        <div class="borde-arriba-naranja mt-4"></div>

                        <div class="col-md-12" style="padding-top: 15px; padding-bottom: 5px;">
                          <label for="cip" class="control-label" style="color: white;"> . </label>                                  
                        </div>

                        <div class="alert alert-info alert-dismissible">
                          <h6><i class="icon fas fa-info"></i> Para la imagen de Galería!</h6>
                          <ul>
                            <li>Dimenciones:1000 x 600</li>
                            <li>Peso:2 mb max</li>
                            <li>Formato: Recomendado JPG</li>
                            <li>Orientación: Horizontal</li>
                          </ul>
                        </div>
                      </div>

                      <!-- Progress -->
                      <div class="col-md-12">
                        <div class="form-group">
                          <div class="progress" id="barra_progress_noticia_div" style="display: none !important;">
                            <div id="barra_progress_noticia" class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
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
                  <button type="submit" style="display: none;" id="submit-form-noticia">Submit</button>
                </form>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" onclick="limpiar();" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" id="guardar_registro_noticia">Guardar Cambios</button>
              </div>

            </div>
          </div>
        </div> 

        <!-- MODAL - VER IMAGEN-->
        <div class="modal fade bg-color-02020280" id="modal-ver-imagen">
          <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content bg-color-0202022e shadow-none border-0">
              <div class="modal-header">
                <h4 class="modal-title text-white nombre-noticia"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span class="text-white cursor-pointer" aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div id="imagen-not" class="text-center">
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

      <!-- Plugion summernote -->
      <script src="../plugins/summernote/summernote-bs4.min.js"></script>
      <!-- Ekko Lightbox -->
      <script src="../plugins/ekko-lightbox/ekko-lightbox.min.js"></script>

			<!-- Filterizr-->
      <script src="../plugins/filterizr/jquery.filterizr.min.js"></script>
      <!-- Funciones del modulo -->
			<script type="text/javascript" src="scripts/noticias_inicio.js"></script>

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