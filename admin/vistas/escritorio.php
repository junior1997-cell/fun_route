<?php
  //Activamos el almacenamiento en el buffer
  ob_start();
  session_start();

  if (!isset($_SESSION["nombre"])){
    header("Location: index.php");
  }else{ ?>

    <!DOCTYPE html>
    <html lang="es">
      <head>
        <!-- Title -->
        <title>Amazone | Lab</title>

        <!-- Required Meta Tags Always Come First -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <?php $title = "Escritorio"; require 'head.php'; ?>
      </head>

      <body>
        <!-- ========== MAIN ========== -->
        <main id="content" role="main" class="bg-light">
          <?php
          if ($_SESSION['escritorio'] == 1){
            //require 'enmantenimiento.php';
            ?>
              <!-- header -->
            <?php require 'header.php'; ?>
            <!-- fin  header -->
            <!-- Content Section -->
            <div class="container container_mod space-1 space-top-lg-0 space-bottom-lg-2 mt-lg-n10">
              <div class="row">
              
                <div class="col-lg-3"> <?php require 'aside.php'; ?> </div>

                <div class="col-lg-9">
                  <!-- Card -->
                  <div class="card mb-3 mb-lg-5">
                    <div class="card-header">
                      <h5 class="card-title">Escritorio</h5>
                    </div>

                    <!-- Body -->
                    <div class="card-body">
                      <?php //require 'endesarrollo.php'; ?>

                      <div class="row">
                        <div class="col-lg-8">

                        <div class="align-content-between row">
                          <!-- Año -->
                           <div class="col-6 col-lg-6">
                             <div class="form-group">
                              <label for="">Fecha inicio</label>

                              <input type="date" class="form-control form-control-sm" name="filtro_fecha_inicio" id="filtro_fecha_inicio" onchange="cargando_search(); delay(function(){filtros()}, 50 );"  placeholder="Fecha" />

                              </div>
                            </div>

                            <!-- Mes -->
                            <div class="col-6 col-lg-6">
                              <div class="form-group">
                              <label for="">Fecha fin</label>
                              <input type="date" class="form-control form-control-sm" name="filtro_fecha_fin" id="filtro_fecha_fin" onchange="cargando_search(); delay(function(){filtros()}, 50 );" placeholder="Fecha" />
                              </div>
                            </div>
                          </div>

                          <div class="cargando text-center bg-danger color-white"><i class="fas fa-spinner fa-pulse fa-sm"></i> Buscando... </div>
                          <canvas id="myChart" width="400" height="250"></canvas> <br>
                          <div class="cargando text-center bg-danger color-white"><i class="fas fa-spinner fa-pulse fa-sm"></i> Buscando... </div>
                          <canvas id="chart_radar" width="250" height="250"></canvas>                  

                        </div>
                        <div class="col-lg-4">
                          <strong>Visitas a nuesta pagina web</strong> <br>

                          <table id="tabla-valores" class="table table-bordered table-striped display" style="width: 100% !important;">
                            <thead>
                              <tr>
                                <th class="">Acc.</th>
                                <th data-toggle="tooltip" data-original-title="Nombres">Nombre</th>
                                <th data-toggle="tooltip" data-original-title="Descripción">Descrip</th>
                              </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                              <tr>
                                <th class="">Acc.</th>
                                <th data-toggle="tooltip" data-original-title="Nombres">Nombre</th>
                                <th data-toggle="tooltip" data-original-title="Descripción">Descrip</th>
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

        <!-- JS consultas -->
        <!-- <script src="../plugins/Chart.js"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script src="scripts/escritorio.js"></script>

      </body>

      <!-- Mirrored from htmlstream.com/front/account-overview.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 19 May 2021 14:19:48 GMT -->
    </html>
  <?php    
  }
  ob_end_flush();
?>
