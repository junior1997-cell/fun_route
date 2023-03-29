  <?php 

    // $link_host = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].'/';
    $link_host="http://admin.sevensingenieros.com/dist/docs/all_trabajador/perfil/";

    // if ($_SERVER['HTTP_HOST']=="localhost") {
    //   $link_host="http://localhost/page_amazon_lab/dist/docs/all_trabajador/perfil/";
    // }else{
    //   $link_host="http://admin.sevensingenieros.com/dist/docs/all_trabajador/perfil/";
    // }
  
  ?> 
  <!-- Navbar -->
  <div class="navbar-expand-lg navbar-expand-lg-collapse-block navbar-light">
    <div id="sidebarNav" class="collapse navbar-collapse navbar-vertical">
      <!-- Card -->
      <div class="card mb-5">
        <div class="card-body">
          <!-- Avatar -->
          <div class="d-none d-lg-block text-center mb-5">
            <div class="avatar avatar-xxl avatar-circle mb-3">
              <img class="avatar-img" src=" <?php  echo $link_host.$_SESSION['imagen'];?>" onerror="this.src='../assets/svg/default/user_default.svg'" alt="Image Description" />
              <img class="avatar-status avatar-lg-status" src="../assets/svg/illustrations/top-vendor.svg" alt="Image Description" data-toggle="tooltip" data-placement="top" title="Verified user" />
            </div>

            <h4 class="card-title"><?php  echo $_SESSION['nombre'];?></h4>
            <p class="card-text font-size-1"><?php  echo $_SESSION['email'];?></p>
          </div>
          <!-- End Avatar -->
          <ul class="nav nav-sub nav-sm nav-tabs nav-list-y-2 mb-4">
            <?php if ($_SESSION['escritorio']==1) {  ?>
            <li class="nav-item">
              <a class="nav-link mescritorio btnSeeGlossary" href="escritorio.php"> <i class="fas fa-id-card nav-icon"></i> Escritorio </a>
            </li>
            <?php  }  ?>
          </ul>

          <!-- Nav -->
          <h6 class="text-cap small">Inmobiliaria</h6>
          
          <!-- List -->
          <ul class="nav nav-sub nav-sm nav-tabs nav-list-y-2 mb-4">
            <?php if ($_SESSION['datos_generales']==1) {  ?>
            <li class="nav-item">
              <a class="nav-link mdatos_generales1 btnSeeGlossary" href="datos_generales.php?id=1"> <i class="fas fa-id-card nav-icon"></i> Datos Generales </a>
            </li>
            <?php  }  ?>

            <?php if ($_SESSION['mision_vision']==1) {  ?>
            <li class="nav-item">
              <a class="nav-link mvision_vision1" href="mision_vision.php?id=1"> <i class="fa fa-bullseye nav-icon"></i> Misión y Visión </a>
            </li>
            <?php  }  ?>

            <?php if ($_SESSION['ceo_resenia']==1) {  ?>
            <li class="nav-item">
              <a class="nav-link mceo_resena1" href="ceo_resenia.php?id=1"> <i class="fas fa-shield-alt nav-icon"></i>CEO - Reseña </a>
            </li>
            <?php  }  ?>

            <?php if ($_SESSION['valores']==1) {  ?>
            <li class="nav-item">
              <a class="nav-link mvalores1" href="valores.php?id=1&carpeta=inmobiliaria"> <i class="fas fa-sliders-h nav-icon"></i> Valores </a>
            </li>
            <?php  }  ?>

            <?php if ($_SESSION['servicio']==1) {  ?>
            <li class="nav-item">
              <a class="nav-link mservicios1" href="servicio.php?id=1&carpeta=inmobiliaria"> <i class="fas fa-shopping-basket nav-icon"></i> Servicios </a>
            </li>
            <?php  }  ?>

          </ul>
          <!-- End List -->            

          <h6 class="text-cap small">Consultoría</h6>
          
          <!-- List -->
          <ul class="nav nav-sub nav-sm nav-tabs nav-list-y-2 mb-4">
            <?php if ($_SESSION['datos_generales']==1) {  ?>
            <li class="nav-item">
              <a class="nav-link mdatos_generales2" href="datos_generales.php?id=2"> <i class="fas fa-id-card nav-icon"></i> Datos Generales </a>
            </li>
            <?php  }  ?>

            <?php if ($_SESSION['mision_vision']==1) {  ?>
            <li class="nav-item">
              <a class="nav-link mvision_vision2" href="mision_vision.php?id=2"> <i class="fa fa-bullseye nav-icon"></i> Misión y Visión </a>
            </li>
            <?php  }  ?>

            <?php if ($_SESSION['ceo_resenia']==1) {  ?>
            <li class="nav-item">
              <a class="nav-link mceo_resena2" href="ceo_resenia.php?id=2"> <i class="fas fa-shield-alt nav-icon"></i>CEO - Reseña </a>
            </li>
            <?php  }  ?>

            <?php if ($_SESSION['valores']==1) {  ?>
            <li class="nav-item">
              <a class="nav-link mvalores2" href="valores.php?id=2&carpeta=consultoria"> <i class="fas fa-sliders-h nav-icon"></i> Valores </a>
            </li>
            <?php  }  ?>

            <?php if ($_SESSION['servicio']==1) {  ?>
            <li class="nav-item">
              <a class="nav-link mservicios2" href="servicio.php?id=2&carpeta=consultoria"> <i class="fas fa-shopping-basket nav-icon"></i> Servicios </a>
            </li>
            <?php  }  ?>
          </ul>
          <!-- End List -->   
          <h6 class="text-cap small">Estrategia Digital</h6>
          
          <!-- List -->
          <ul class="nav nav-sub nav-sm nav-tabs nav-list-y-2 mb-4">
            <?php if ($_SESSION['datos_generales']==1) {  ?>
            <li class="nav-item">
              <a class="nav-link mdatos_generales3" href="datos_generales.php?id=3"> <i class="fas fa-id-card nav-icon"></i> Datos Generales </a>
            </li>
            <?php  }  ?>

            <?php if ($_SESSION['mision_vision']==1) {  ?>
            <li class="nav-item">
              <a class="nav-link mvision_vision3" href="mision_vision.php?id=3"> <i class="fa fa-bullseye nav-icon"></i> Misión y Visión </a>
            </li>
            <?php  }  ?>

            <?php if ($_SESSION['ceo_resenia']==1) {  ?>
            <li class="nav-item">
              <a class="nav-link mceo_resena3" href="ceo_resenia.php?id=3"> <i class="fas fa-shield-alt nav-icon"></i>CEO - Reseña </a>
            </li>
            <?php  }  ?>

            <?php if ($_SESSION['valores']==1) {  ?>
            <li class="nav-item">
              <a class="nav-link mvalores3" href="valores.php?id=3&carpeta=estrategia_digital"> <i class="fas fa-sliders-h nav-icon"></i> Valores </a>
            </li>
            <?php  }  ?>

            <?php if ($_SESSION['servicio']==1) {  ?>
            <li class="nav-item">
              <a class="nav-link mservicios3" href="servicio.php?id=3&carpeta=estrategia_digital"> <i class="fas fa-shopping-basket nav-icon"></i> Servicios </a>
            </li>
            <?php  }  ?>
          </ul>
          <!-- End List -->         

          <h6 class="text-cap small">Usuarios</h6>
          
          <!-- List -->
          <ul class="nav nav-sub nav-sm nav-tabs nav-list-y-2 mb-4">
            <?php if ($_SESSION['cargo']==1) {  ?>
            <li class="nav-item">
              <a class="nav-link mcargo" href="cargo.php"> <i class="fas fa-users-cog nav-icon"></i> Cargo </a>
            </li>
            <?php  }  ?>
            <?php if ($_SESSION['trabajadores']==1) {  ?>
            <li class="nav-item">
              <a class="nav-link mpersona" href="persona.php"> <i class="fas fa-users-cog nav-icon"></i> Trabajadores </a>
            </li>
            <?php  }  ?>

            <?php if ($_SESSION['usuarios']==1) {  ?>
            <li class="nav-item">
              <a class="nav-link musuarios" href="usuario.php"> <i class="fas fa-users-cog nav-icon"></i> Usuarios </a>
            </li>
            <?php  }  ?>

          </ul>
          <!-- End List -->
          
          <!-- End Nav -->
        </div>
      </div>
      <!-- End Card -->
    </div>
  </div>
  <!-- End Navbar -->
