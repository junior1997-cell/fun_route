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
    <title>Reseña historica | Seven's Ingenieros</title>

    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <?php $title = "Datos generales"; require 'head.php'; ?>
  </head>

  <body>

    <!-- ========== MAIN ========== -->
    <main id="content" role="main" class="bg-light">
      <?php if ($_SESSION['ceo_resenia']==1){ ?>

      <!-- header -->
      <?php require 'header.php'; ?>
      <!-- fin  header -->

      <!-- Content Section -->
      <div class="container container_mod space-1 space-top-lg-0 space-bottom-lg-2 mt-lg-n10">
        <div class="row">
          <div class="col-lg-3">
            <!-- Navbar -->
              <?php require 'aside.php'; ?>
            <!-- End Navbar -->
          </div>

          <div class="col-lg-9">
            <!-- Card -->
            <div class="card mb-3 mb-lg-5">
              <div class="card-header">
                <h5 class="card-title">Basic info</h5>
              </div>

              <!-- Body -->
              <div class="card-body">
                <form id="form-palabrasceo-resenia" name="form-palabrasceo-resenia" method="POST">
                  <div class="row" id="cargando-1-fomulario">

                    <!-- id -->
                    <input type="hidden" name="id" id="id" />

                    <!-- Form Group Palabras ceo -->
                    <div class="col-lg-12 col-sm-12">
                      <label class="col-sm-3 col-form-label input-label">Palabras CEO</label>
                      <div class="form-group">
                        <!-- Quill -->
                        <div class="quill-custom">
                          <div
                            class="js-quill"
                            style="min-height: 15rem;"
                            data-hs-quill-options='{
                              "placeholder": "Type your message...",
                                "modules": {
                                  "toolbar": [
                                    ["bold", "italic", "underline", "strike", "link", "image", "blockquote", "code", {"list": "bullet"}]
                                  ]
                                }
                              }'
                          >
                          <i class="fas fa-spinner fa-pulse fa-1x"></i>
                          </div>
                        </div>
                        <!-- End Quill -->
                        <textarea class="d-none" name="palabras_ceo" id="palabras_ceo" cols="30" rows="10"></textarea>
                      </div>
                    </div>

                    <!-- Form Group reseña historica -->
                    <div class="col-lg-12 col-sm-12">
                      <label class="col-sm-3 col-form-label input-label">Reseña Historica</label>
                      <div class="form-group">
                        <!-- Quill -->
                        <div class="quill-custom">
                          <div
                            class="js-quill-2"
                            style="min-height: 15rem;"
                            data-hs-quill-options='{
                              "placeholder": "Type your message...",
                                "modules": {
                                  "toolbar": [
                                    ["bold", "italic", "underline", "strike", "link", "image", "blockquote", "code", {"list": "bullet"}]
                                  ]
                                }
                              }'
                          >
                          <i class="fas fa-spinner fa-pulse fa-1x"></i>
                          </div>
                        </div>
                        <!-- End Quill -->
                        <textarea class="d-none" name="resenia_h" id="resenia_h" cols="30" rows="10"></textarea>
                      </div>
                      
                    </div>

                    <button type="submit" style="display: none;" id="submit-form-actualizar-registro">Submit</button>

                    <!-- barprogress -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
                      <div class="progress" id="dbarra_progress_div">
                        <div id="barra_progress" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: 0%;">
                          0%
                        </div>
                      </div>
                    </div>

                  </div>

                  <!--Cargando-->
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
                <button type="submit" class="btn btn-success btn-xs actualizar" id="actualizar_registro">Actualizar</button>
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
        var quill_2;
       // $(".js-quill .ql-editor").addClass('p_ceo');
        $(quill).ready(function() {

          $(".js-quill .ql-editor").addClass('p_ceo');

          quill_2 = $.HSCore.components.HSQuill.init(".js-quill-2");

        });
        
        //$(".js-quill-2 .ql-editor").addClass('r_hist');
        $(quill_2).ready(function() { 
          $(".js-quill-2 .ql-editor").addClass('r_hist'); 
          mostrar(); 
        });

        // INITIALIZATION OF GO TO
        // =======================================================
        $(".js-go-to").each(function () {
          var goTo = new HSGoTo($(this)).init();
        });
      });
    </script>
    <script src="scripts/ceo_resenia.js"></script>
    <!-- IE Support -->
    <script>
      if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) document.write('<script src="assets/vendor/babel-polyfill/dist/polyfill.js"><\/script>');
    </script>
    <!-- JS script -->


  </body>

  <!-- Mirrored from htmlstream.com/front/account-overview.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 19 May 2021 14:19:48 GMT -->
</html>
<?php    
  }
  ob_end_flush();
?>
