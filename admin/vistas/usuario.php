<?php
  //Activamos el almacenamiento en el buffer
  ob_start();
  session_start();

  if (!isset($_SESSION["nombre"])){
    header("Location: index.php");
  }else{ ?>

    <!DOCTYPE html>
    <html lang="es">
      <!-- Mirrored from htmlstream.com/front/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 19 May 2021 14:15:43 GMT -->
      <head>
        <!-- Title -->
        <title>Usuarios | Seven's Ingenieros</title>

        <!-- Required Meta Tags Always Come First -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <?php $title = "Datos generales"; require 'head.php'; ?>
      </head>

      <body>
        <!-- ========== MAIN ========== -->
        <main id="content" role="main" class="bg-light">
          <?php
          if ($_SESSION['usuarios']==1){
            //require 'enmantenimiento.php';
            ?>
            <!-- header -->
            <?php require 'header.php'; ?>
            <!-- fin  header -->
            <!-- Content Section -->
            <div class="container container_mod space-1 space-top-lg-0 space-bottom-lg-2 mt-lg-n10">
              <div class="row">
                <div class="col-lg-3"><?php require 'aside.php'; ?></div>
                <div class="col-lg-9">
                  <!-- Card -->
                  <div class="card mb-3 mb-lg-5 card-primary card-outline">
                    <div class="card-header">
                      <h3 class="card-title">
                        <button type="button" class="btn btn-primary btn-xs btn-agregar" data-toggle="modal" data-target="#modal-agregar-servicios" onclick="permisos(); limpiar_form_usuario(); show_hide_form(2);"><i class="fas fa-plus-circle"></i> Agregar</button>                                               
                        <button type="button" class="btn bg-warning btn-regresar d-none" onclick="limpiar_form_usuario(); show_hide_form(1);"><i class="fas fa-arrow-left"></i> Regresar</button>                            
                        <b class="trabajador-name"></b>
                      </h3>
                    </div>

                    <!-- Body -->
                    <div class="card-body">
                      <div class="row">
                        
                        <div class="col-lg-12" id="mostrar-tabla" >
                          <!-- tabla -->
                          <table id="tabla-usuarios" class="table table-bordered table-striped display" style="width: 100% !important;">
                            <thead>
                              <tr>
                                <th data-toggle="tooltip" data-original-title="N°">N°</th>
                                <th data-toggle="tooltip" data-original-title="Acciones">Acciones</th>
                                <th data-toggle="tooltip" data-original-title="Nombres">Nombre</th>
                                <th data-toggle="tooltip" data-original-title="Descripción">Telef.</th>
                                <th data-toggle="tooltip" data-original-title="Descripción">Login</th>
                                <th data-toggle="tooltip" data-original-title="Descripción">Cargo</th>
                              </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                              <tr>
                              <th data-toggle="tooltip" data-original-title="N°">N°</th>
                                <th data-toggle="tooltip" data-original-title="Acciones">Acciones</th>
                                <th data-toggle="tooltip" data-original-title="Nombres">Nombre</th>
                                <th data-toggle="tooltip" data-original-title="Descripción">Telef.</th>
                                <th data-toggle="tooltip" data-original-title="Descripción">Login</th>
                                <th data-toggle="tooltip" data-original-title="Descripción">Cargo</th>
                              </tr>
                            </tfoot>
                          </table>
                        </div>

                        <div id="mostrar-form" style="display: none;"> 
                          <form id="form-usuario" name="form-usuario"  method="POST" >                      
                            <div class="card-body">
                              <div class="row" id="cargando-1-fomulario">
                                <!-- id usuario -->
                                <input type="hidden" name="idusuario" id="idusuario" />

                                <!-- Trabajador -->
                                <div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">

                                  <label for="trabajador" id="trabajador_c">Trabajador</label>                               
                                  
                                  <select class="js-custom-select custom-select" size="1" style="opacity: 0;"
                                    data-hs-select2-options='{
                                      "placeholder": "Seleccionar"
                                    }'
                                    name="trabajador" id="trabajador"
                                    onchange="cargo_persona(this);"
                                  >
                                  </select>
                                  <input type="hidden" name="trabajador_old" id="trabajador_old" /> 
                                </div>
                                <!-- cargo -->
                                <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                  <div class="form-group">
                                    <label for="cargo">Cargo</label> 
                                    <input type="text" class="form-control cargo_trabajador" placeholder="Cargo"  readonly>

                                  </div>  

                                </div>

                                <!-- Login -->
                                <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                  <div class="form-group">
                                    <label for="login">Login <small class="text-danger">(Dato para ingresar al sistema)</small></label>
                                    <input type="text" name="login" class="form-control" id="login" placeholder="Login" autocomplete="off" onkeyup="convert_minuscula(this);">
                                  </div>
                                </div>

                                <!-- Contraseña -->
                                <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                  <div class="form-group">
                                    <label for="password">Contraseña <small class="text-danger">(por defecto "123456")</small></label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Contraseña" autocomplete="off">
                                    <input type="hidden" name="password-old"   id="password-old"  >
                                  </div>
                                </div>     

                                <!-- permisos -->
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                  <div class="mb-0">
                                    <label class="ml-1" for="permisos">Permisos</label>                               
                                    <div id="permisos">
                                      <i class="fas fa-spinner fa-pulse fa-2x"></i>
                                    </div>
                                  </div>
                                </div>

                                <!-- Progress -->
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <div class="progress" id="div_barra_progress_usuario" style="display: none !important;">
                                      <div id="barra_progress_usuario" class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                  </div>
                                </div>
                                
                              </div>  

                              <div class="row" id="cargando-2-fomulario" style="display: none;" >
                                <div class="col-lg-12 text-center">
                                  <i class="fas fa-spinner fa-pulse fa-6x"></i><br><br>
                                  <h4>Cargando...</h4>
                                </div>
                              </div>
                              
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer justify-content-between">
                              <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="show_hide_form(1);"> <i class="fas fa-arrow-left"></i> Close</button>
                              <button type="submit" class="btn btn-success" id="guardar_registro">Guardar Cambios</button>
                            </div>                      
                          </form>
                        </div>

                      </div>
                    </div>
                    <!-- End Body -->
                  </div>
                  <!-- End Card -->
                </div>
              </div>
              <!-- End Row -->
            </div>
            <!-- End Content Section -->
            <!-- Modal ver imagen -->
            <div class="modal fade" id="modal-ver-imagen">
              <div class="modal-dialog modal-dialog-scrollable modal-md">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title"><b>Usuario:</b> <span class="text-warning" id="nombre_usuario"></span>  </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span class="text-danger" aria-hidden="true">&times;</span>
                    </button>
                  </div>

                  <div class="modal-body">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-lg-12 text-center" id="ver_imagen">

                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
        </main>
        <!-- ========== END MAIN ========== -->

        <!-- Go to Top -->
        <a
          class="js-go-to go-to position-fixed"
          href="javascript:;"
          style="visibility: hidden;"
          data-hs-go-to-options='{
          "offsetTop": 700,
          "position": {
            "init": {
              "right": 15
            },
            "show": {
              "bottom": 15
            },
            "hide": {
              "bottom": -15
            }
          }
        }'
        >
          <i class="fas fa-angle-up"></i>
        </a>
        <!-- End Go to Top -->

        <!-- ========== SCRIPT ========== -->
        <?php require 'script.php'; ?>

        <!-- JS Plugins Init. -->
        <script>
          $(document).on("ready", function () {
            // INITIALIZATION OF HEADER
            // =======================================================
            var header = new HSHeader($("#header")).init();

            // INITIALIZATION OF MEGA MENU
            // =======================================================
            var megaMenu = new HSMegaMenu($(".js-mega-menu"), {
              desktop: {
                position: "left",
              },
            }).init();

            // INITIALIZATION OF UNFOLD
            // =======================================================
            var unfold = new HSUnfold(".js-hs-unfold-invoker").init();

            // INITIALIZATION OF FORM VALIDATION
            // =======================================================
            $(".js-validate").each(function () {
              $.HSCore.components.HSValidation.init($(this), {
                rules: {
                  confirmPassword: {
                    equalTo: "#signupPassword",
                  },
                },
              });
            });

            // INITIALIZATION OF SHOW ANIMATIONS
            // =======================================================
            $(".js-animation-link").each(function () {
              var showAnimation = new HSShowAnimation($(this)).init();
            });

            // INITIALIZATION OF MASKED INPUT
            // =======================================================
            $(".js-masked-input").each(function () {
              var mask = $.HSCore.components.HSMask.init($(this));
            });

            // INITIALIZATION OF FILE ATTACH
            // =======================================================
            $(".js-file-attach").each(function () {
              var customFile = new HSFileAttach($(this)).init();
            });

            // INITIALIZATION OF ADD INPUT FILED
            // =======================================================
            $(".js-add-field").each(function () {
              new HSAddField($(this), {
                addedField: () => {
                  $(".js-add-field .js-custom-select-dynamic").each(function () {
                    var select2dynamic = $.HSCore.components.HSSelect2.init($(this));
                  });
                },
              }).init();
            });

            // INITIALIZATION OF SELECT2
            // =======================================================
            $(".js-custom-select").each(function () {
              var select2 = $.HSCore.components.HSSelect2.init($(this));
            });

            // INITIALIZATION OF QUILLJS EDITOR
            // =======================================================
            var quill = $.HSCore.components.HSQuill.init(".js-quill");

            // INITIALIZATION OF GO TO
            // =======================================================
            $(".js-go-to").each(function () {
              var goTo = new HSGoTo($(this)).init();
            });
          });
        </script>
        
        <!-- IE Support -->
        <script>
          if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) document.write('<script src="assets/vendor/babel-polyfill/dist/polyfill.js"><\/script>');
        </script>
        <!-- JS script -->
        <script src="scripts/usuario.js"></script>
      </body>

      <!-- Mirrored from htmlstream.com/front/account-overview.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 19 May 2021 14:19:48 GMT -->
    </html>
    <?php    
  }
  ob_end_flush();
?>
