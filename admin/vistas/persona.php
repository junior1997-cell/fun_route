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
    <title>persona | Amazone Lab</title>

    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <?php $title = "persona"; require 'head.php'; ?>
  </head>

  <body>
    <!-- ========== MAIN ========== -->
    <main id="content" role="main" class="bg-light">
      <?php

    if ($_SESSION['trabajadores']==1){
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
                  <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-agregar-persona" onclick="limpiar_form_persona();"><i class="fas fa-plus-circle"></i> Agregar</button>
                  Admnistrar Trabajadores.
                </h3>
              </div>

              <!-- Body -->
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-12 text-center cargando">
                    <i class="fas fa-spinner fa-pulse fa-3x"></i><br />
                    <br />
                    <h4>Cargando...</h4>
                  </div>
                  <div class="col-lg-12 tabla" style="display: none;">
                    <!-- tabla -->
                    <table id="tabla-persona" class="table table-bordered table-striped display" style="width: 100% !important;">
                      <thead>
                        <tr>
                          <th class="text-center">#</th>
                          <th class="">Acciones</th>                                
                          <th>Nombre</th>
                          <th>Dirección</th>
                          <th>Nombres</th>
                          <th>Tipo Doc.</th>
                          <th>numero_documento</th>
                          <th>celular</th>
                          <th>correo</th>
                        </tr>
                      </thead>
                      <tbody></tbody>
                      <tfoot>
                        <tr>
                          <th class="text-center">#</th>
                          <th class="">Acciones</th>                                
                          <th>Nombre</th>
                          <th>Dirección</th>
                          <th>Nombres</th>
                          <th>Tipo Doc.</th>
                          <th>numero_documento</th>
                          <th>celular</th>
                          <th>correo</th>
                        </tr>
                      </tfoot>
                    </table>
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
      <!-- MODAL - persona TRABAJDOR-->
      <div class="modal fade" id="modal-agregar-persona">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Persona</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span class="text-danger" aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <!-- form start -->
              <form id="form-persona" name="form-persona" method="POST" autocomplete="off">
                <div class="card-body">

                  <div class="row" id="cargando-1-fomulario">
                    <!-- id persona -->
                    <input type="hidden" name="idpersona" id="idpersona" />
                    <!-- Tipo de documento -->
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                      <label for="tipo_documento">Tipo Doc.</label> <br>
                      <select class="js-custom-select custom-select" size="1" style="opacity: 0;"
                              data-hs-select2-options='{
                                "placeholder": "Select tipo doc."
                              }'
                              name="tipo_documento" 
                              id="tipo_documento" >
                        <option value="DNI" selected>DNI</option>
                        <option value="RUC">RUC</option>
                        <option value="CEDULA">CEDULA</option>
                        <option value="OTRO">OTRO</option>
                      </select>
                      <!-- End Select -->
                    </div>
                    
                    <!-- N° de documento -->
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                      <div class="form-group">
                        <label for="num_documento">N° de documento</label>
                        <div class="input-group">
                          <input type="number" name="num_documento" class="form-control" id="num_documento" placeholder="N° de documento" />
                          <div class="input-group-append" data-toggle="tooltip" data-original-title="Buscar Reniec/SUNAT" onclick="buscar_sunat_reniec('');">
                            <span class="input-group-text" style="cursor: pointer;">
                              <i class="fas fa-search text-primary" id="search"></i>
                              <i class="fa fa-spinner fa-pulse fa-fw fa-lg text-primary" id="charge" style="display: none;"></i>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Nombre -->
                    <div class="col-12 col-sm-12 col-md-12 col-lg-5">
                      <div class="form-group">
                        <label for="nombre">Nombres/Razon Social</label>
                        <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombres y apellidos" />
                      </div>
                    </div>

                    <!-- Correo electronico -->
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                      <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Correo electrónico" onkeyup="convert_minuscula(this);" />
                      </div>
                    </div>

                    <!-- Telefono -->
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                      <div class="form-group">
                        <label for="telefono">Teléfono</label><br>
                        <input type="text" class="js-masked-input form-control" placeholder="+51 xxx-xx-xx"
                          data-hs-mask-options='{
                            "template": "+51 999 999 999",
                            "clearIfNotMatch": true
                          }' name="telefono" id="telefono"
                        >
                      </div>
                    </div>

                    <!-- Tipo de documento -->
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                      <label for="cargo_persona">Cargo persona</label> <br>
                      <select class="js-custom-select custom-select" size="1" style="opacity: 0;"
                              data-hs-select2-options='{
                                "placeholder": "Cargo persona"
                              }'
                              name="cargo_persona" 
                              id="cargo_persona" >
                      </select>
                    </div>
                    <!-- Direccion -->
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                      <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text" name="direccion" class="form-control" id="direccion" placeholder="Dirección" />
                      </div>
                    </div>
                    <!-- imagen perfil -->
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                      <div class="col-lg-12 borde-arriba-naranja mt-2 mb-2"></div>
                      <label for="foto1">Foto de perfil</label> <br />
                      <img onerror="this.src='../dist/img/default/img_defecto.png';" src="../dist/img/default/img_defecto.png" class="img-thumbnail" id="foto1_i" style="cursor: pointer !important;" width="auto" />
                      <input style="display: none;" type="file" name="foto1" id="foto1" accept="image/*" />
                      <input type="hidden" name="foto1_actual" id="foto1_actual" />
                      <div class="text-center" id="foto1_nombre"><!-- aqui va el nombre de la FOTO --></div>
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

                  <div class="row" id="cargando-2-fomulario" style="display: none;" >
                    <div class="col-lg-12 text-center">
                      <i class="fas fa-spinner fa-pulse fa-6x"></i><br><br>
                      <h4>Cargando...</h4>
                    </div>
                  </div>
                        
                </div>
                <!-- /.card-body -->
                <button type="submit" style="display: none;" id="submit-form-persona">Submit</button>
              </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal" onclick="limpiar_form_persona();">Close</button>
              <button type="submit" class="btn btn-success btn-xs" id="guardar_registro_persona">Guardar Cambios</button>
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
<style>
  .textarea_datatable {
    width: 100%;
    background: rgb(215 224 225 / 22%);
    border-block-color: inherit;
    border-bottom: aliceblue;
    border-left: aliceblue;
    border-right: aliceblue;
    border-top: hidden;
  }
  .avatar-img-modif {
    max-width: 50%;
    height: 50%;
    object-fit: cover;
  }
</style>
    <!-- IE Support -->
    <script>
      if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) document.write('<script src="assets/vendor/babel-polyfill/dist/polyfill.js"><\/script>');
    </script>
    <script type="text/javascript" src="scripts/persona.js"></script>
  </body>

  <!-- Mirrored from htmlstream.com/front/account-overview.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 19 May 2021 14:19:48 GMT -->
</html>
<?php    
  }
  ob_end_flush();
?>
