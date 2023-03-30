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
    <title>Datos generales | Seven's Ingenieros</title>

    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <?php $title = "Datos generales"; require 'head.php'; ?>
  </head>

  <body>
    <!-- ========== MAIN ========== -->
    <main id="content" role="main" class="bg-light">

      <?php if ($_SESSION['datos_generales']==1){ ?>

        <!-- header -->
        <?php require 'header.php'; ?>
        <!-- fin  header -->

        <!-- Content Section -->
        <div class="container container_mod space-1 space-top-lg-0 space-bottom-lg-2 mt-lg-n10">
          <div class="row">

            <div class="col-lg-3">
              <!-- Navbar -->
              <?php require 'aside.php'; ?>
              <!--END Navbar -->
            </div>

            <div class="col-lg-9">
              <!-- Card -->
              <div class="card mb-3 mb-lg-5 card-primary card-outline">
                <div class="card-header">
                  <h5 class="card-title"><b>Datos generales de la empresa</b></h5>
                </div>

                <!-- Body -->
                <div class="card-body">
                  <!-- form start -->
                  <form id="form-datos-generales" name="form-datos-generales" method="POST">
                    <div class="row" id="cargando-1-fomulario">
                      <!-- id -->
                      <input type="hidden" name="id" id="id" />

                      <!-- Direccción -->
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label for="direcccion">Direccción</label>
                          <textarea type="text" class="form-control text-justify" name="direcccion" id="direcccion" rows="1" readonly></textarea>
                        </div>
                      </div>
                      <!-- Celular -->
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="celular">Celular</label>
                          <input type="text" name="celular" id="celular" class="form-control" placeholder="Celular" readonly />
                        </div>
                      </div>
                      <!-- telefono -->
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="telefono">Teléfono</label>
                          <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Teléfono" readonly />
                        </div>
                      </div>
                      <!-- Latitud -->
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="latitud">Latitud</label>
                          <input type="text" name="latitud" id="latitud" class="form-control" placeholder="Latitud" readonly />
                        </div>
                      </div>
                      <!-- Longuitud -->
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="Longuitud">Longuitud</label>
                          <input type="text" name="longuitud" id="longuitud" class="form-control" placeholder="Longuitud" readonly />
                        </div>
                      </div>

                      <!-- Correo -->
                      <div class="col-lg-5">
                        <div class="form-group">
                          <label for="correo">Correo</label>
                          <input type="text" name="correo" id="correo" class="form-control" placeholder="Correo" readonly />
                        </div>
                      </div>
                      <!-- Horario -->
                      <div class="col-lg-7">
                        <div class="form-group">
                          <label for="horario">Horario</label>
                          <textarea class="form-control text-justify" name="horario" id="horario" rows="2" readonly></textarea>
                        </div>
                      </div>

                      <button type="submit" style="display: none;" id="submit-form-actualizar-registro">Submit</button>
                      <!-- barprogress -->
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
                        <div class="progress" id="barra_progress_div">
                          <div id="barra_progress" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: 0%;">
                            0%
                          </div>
                        </div>
                      </div>

                    </div>

                    <div class="row" id="cargando-2-fomulario" style="display: none;">
                      <div class="col-lg-12 text-center">
                        <i class="fas fa-spinner fa-pulse fa-3x"></i><br />
                        <br />
                        <h4>Cargando...</h4>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- End Body -->
                <div class="modal-footer justify-content-end">
                  <button class="btn btn-warning btn-xs btn_editar" onclick="activar_editar(1);">Editar</button>
                  <button type="submit" class="btn btn-success btn-xs btn_actualizar" style="display: none;" id="actualizar_registro">Actualizar</button>
                  <!-- -->
                </div>
              </div>
              <!-- End Card -->
            </div>
          </div>
          <!-- End Row -->
        </div>
        <!-- End Content Section -->

      <?php
        }else{
          require 'noacceso.php';
        }
        require 'footer.php';
      ?>
    </main>
    <!-- ========== END MAIN ========== -->
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
    <!-- JS script -->
    <script src="scripts/datos_generales.js"></script>
  </body>
</html>
<?php    
  }
  ob_end_flush();
?>
