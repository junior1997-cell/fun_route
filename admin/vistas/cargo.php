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
    <title>Cargo | Amazone Lab</title>

    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <?php $title = "Cargo"; require 'head.php'; ?>
  </head>

  <body>
    <!-- ========== MAIN ========== -->
    <main id="content" role="main" class="bg-light">
      <?php

    if ($_SESSION['cargo']==1){
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
                  <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-agregar-cargo" onclick="limpiar_cargo();"><i class="fas fa-plus-circle"></i> Agregar</button>
                  Admnistrar Cargos.
                </h3>
              </div>

              <!-- Body -->
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-12 text-center cargando">
                    <i class="fas fa-spinner fa-pulse fa-6x"></i><br />
                    <br />
                    <h4>Cargando...</h4>
                  </div>
                  <div class="col-lg-12 tabla" style="display: none;">
                    <!-- tabla -->
                    <table id="tabla-cargo" class="table table-bordered table-striped display" style="width: 100% !important;">
                      <thead>
                        <tr>
                          <th class="text-center">#</th>
                          <th class="">Acciones</th>                                
                          <th>Nombre</th>
                          <th>Descripción</th>
                        </tr>
                      </thead>
                      <tbody></tbody>
                      <tfoot>
                        <tr>
                          <th class="text-center">#</th>
                          <th class="">Acciones</th>                                
                          <th>Nombre</th>
                          <th>Descripción</th>
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
                    <input type="hidden" name="idcargo" id="idcargo" />

                    <!-- nombre -->
                    <div class="col-lg-12 class_pading">
                      <div class="form-group">
                        <label for="nombre_cargo">Nombre Cargo  <sup class="text-danger">*</sup></label>
                        <input type="text" name="nombre_cargo" id="nombre_cargo" class="form-control" placeholder="Nombre Cargo" />
                      </div>
                    </div>
                    <!--Descripcion-->
                    <div class="col-lg-12 class_pading">
                      <div class="form-group">
                        <label for="descripcion_pago">Descripción </label> <br />
                        <textarea name="descripcion" id="descripcion" class="form-control" rows="2"></textarea>
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
              <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal" onclick="limpiar_cargo();">Close</button>
              <button type="submit" class="btn btn-success btn-xs" id="guardar_registro_cargo">Guardar Cambios</button>
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
    <!-- JS script -->
    <script src="scripts/cargo.js"></script>
  </body>

  <!-- Mirrored from htmlstream.com/front/account-overview.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 19 May 2021 14:19:48 GMT -->
</html>
<?php    
  }
  ob_end_flush();
?>
