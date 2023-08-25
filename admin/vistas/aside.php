<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="escritorio.php" class="brand-link">
    <img src="../dist/svg/ico_head.svg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8;" />
    <span class="brand-text font-weight-light">Admin Fun Route</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar"> 

    <!-- SidebarSearch Form -->
    <div class="form-inline mt-4">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search" />
        <div class="input-group-append"><button class="btn btn-sidebar"><i class="fas fa-search fa-fw"></i></button></div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column /*nav-flat*/" data-widget="treeview" role="menu" data-accordion="false">

        <?php if ($_SESSION['escritorio']==1) {  ?>
          <!-- ESCRITORIO -->
          <li class="nav-item">
            <a href="escritorio.php" class="nav-link pl-2" id="mEscritorio">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Escritorio
                <span class="right badge badge-danger">Home</span>
              </p>
            </a>
          </li>
        <?php  }  ?>
        <?php if ($_SESSION['empresa']==1) {  ?>
          <!-- ACCESOS -->

          <li class="nav-item " id="bloc_empresa">
            <a href="#" class="nav-link" id="mempresa" style="padding-left: 7px;">
              <i class="nav-icon fa-sharp fa-solid fa-city"></i>
              <p>
                Empresa
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">5</span>
              </p>
            </a>

            <ul class="nav nav-treeview ">
              <!--  Datos Generales  -->
              <li class="nav-item ">
                <a href="datos_generales.php" class="nav-link " id="ldatosgenerales">
                  <i class="nav-icon fa-solid fa-gears"></i>
                  <p> Datos Generales </p>
                </a>
              </li>
              <!--  Misión y Visión  -->
              <li class="nav-item ">
                <a href="mision_vision.php" class="nav-link" id="lmision_vision">
                  <i class="nav-icon fa-solid fa-record-vinyl"></i>
                  <p> Misión y Visión </p>
                </a>
              </li>    
              <!--  reseña  -->
              <li class="nav-item ">
                <a href="ceo_resenia.php" class="nav-link" id="lceo_resenia">
                  <i class="nav-icon fa-solid fa-globe"></i>
                  <p>CEO - Reseña</p>
                </a>
              </li>   

              <!-- valores -->

              <li class="nav-item hidden">
                <a href="valores.php" class="nav-link" id="lvalores">
                  <i class="nav-icon fa-solid fa-lightbulb"></i>
                  <p>Valores</p>
                </a>
              </li>
              
              <!--  Politicas Generales  -->
              <li class="nav-item" id="bloc_lPoliticas">
                <a href="#" class="nav-link pl-3" id="mlPoliticas">
                <i class="nav-icon fas fa-balance-scale"></i>
                  <p> Politicas Generales <i class="fas fa-angle-left right"></i> <span class="badge badge-info right">2</span></p>

                </a>
                <ul class="nav nav-treeview">
                  <!-- Paquetes -->
                  <li class="nav-item">
                    <a href="politica_paquete.php" class="nav-link pl-4" id="lPoliticasPaquete">
                      <i class="nav-icon fas fa-map"></i> <p>Paquetes</p>
                    </a>
                  </li>
                  <!-- Tours -->
                  <li class="nav-item">
                    <a href="politica_tours.php" class="nav-link pl-4" id="lPoliticasTours">
                      <i class="nav-icon fas fa-suitcase"></i> <p>Tours</p>
                    </a>
                  </li> 
                </ul>
              </li>
            </ul>
          </li>
        <?php  }  ?>

        <?php if ($_SESSION['acceso']==1) {  ?>
          <!-- ACCESOS -->
          <li class="nav-item  b-radio-3px" id="bloc_Accesos">
            <a href="#" class="nav-link pl-2" id="mAccesos">
              <i class="nav-icon fas fa-shield-alt"></i>
              <p>
                Accesos
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">2</span>
              </p>
            </a>
            <ul class="nav nav-treeview ">
              <!-- Usuarios del sistema -->
              <li class="nav-item ">
                <a href="usuario.php" class="nav-link " id="lUsuario">
                  <i class="nav-icon fas fa-users-cog"></i>
                  <p>Usuarios</p>
                </a>
              </li>
              <!-- Permisos de los usuarios del sistema -->
              <li class="nav-item ">
                <a href="permiso.php" class="nav-link" id="lPermiso">
                  <i class="nav-icon fas fa-lock"></i>
                  <p>Permisos</p>
                </a>
              </li>      
            </ul>
          </li>
        <?php  }  ?>


        <?php if ($_SESSION['recurso']==1) {  ?>
          <!-- Recursos -->
          <li class="nav-item  b-radio-3px" id="bloc_Recurso">
            <a href="#" class="nav-link pl-2" id="mRecurso">
              <i class="nav-icon fas fa-project-diagram"></i>
              <p>
                Recursos <i class="fas fa-angle-left right"></i> <span class="badge badge-info right">2</span>
              </p>
            </a>
            <ul class="nav nav-treeview ">

              <!-- Proveedores y clientes de la empresa -->
              <li class="nav-item ">
                <a href="persona.php" class="nav-link" id="lPersona">
                  <i class="nav-icon fas fa-users"></i>
                  <p>Personas </p>
                </a>
              </li>          
              
              <!-- Datos Generales Bancos y color -->
              <li class="nav-item ">
                <a href="otros.php" class="nav-link" id="lOtros">
                  <i class="nav-icon fas fa-coins"></i>
                  <p>Otros</p>
                </a>
              </li>
            </ul>
          </li>
        <?php  }  ?> 
        
        <?php if ($_SESSION['papelera']==1) {  ?>
          <li class="nav-item">
            <a href="papelera.php" class="nav-link pl-2" id="mPapelera">
              <i class="nav-icon fas fa-trash-alt"></i>
              <p>Papelera</p>
            </a>
          </li>
        <?php  }  ?>
        
        <li class="nav-header">MÓDULOS</li>
        
        <!-- PAQUETES DE VIEJE -->      
        <li class="nav-item " id="bloc_LogisticaPaquetes">
          <a href="#" class="nav-link bg-color-2c2c2c" id="mLogisticaPaquetes" style="padding-left: 7px;">
            <i class="nav-icon far fa-circle"></i>
            <p class="font-size-14px">PAQUETES & TUORS<i class="fas fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview">

            <?php if ($_SESSION['paquete_definido']==1) {  ?>   

              <!-- Paquetes -->
              <li class="nav-item ">
                <a href="paquete.php" class="nav-link pl-2" id="lPaquetes">
                  <i class="nav-icon fas fa-map"></i> <p>Paquetes</p>
                </a>
              </li>

            <?php  }  ?>  
            
            <?php if ($_SESSION['paquete_medida']==1) {  ?>   
              <!-- COMPRAS -->      
              <li class="nav-item  b-radio-3px" id="bloc_ComprasGrano">
                <a href="#" class="nav-link pl-2" id="mlPaquetesMedida">
                <i class="nav-icon fa-solid  fas fa-passport"></i>
                  <p>A Medida <i class="fas fa-angle-left right"></i> <span class="badge badge-info right">1</span></p>
                </a>
                <ul class="nav nav-treeview">
                  <!-- Compras del proyecto -->
                  <li class="nav-item ">
                    <a href="compra_cafe.php" class="nav-link" id="lComprasGrano">
                      <i class="nav-icon fas fa-cart-plus"></i> 
                      <p>Destinos</p>
                    </a>
                  </li>       

                </ul>
              </li>
            <?php  }  ?>
            
            <?php if ($_SESSION['tours']==1) {  ?>   

              <li class="nav-item ">
                <a href="tours.php" class="nav-link pl-2" id="lTours">
                  <i class="nav-icon fas fa-suitcase"></i> 
                  <p>Tours</p>
                </a>
              </li>

            <?php  }  ?>  

            <?php if ($_SESSION['pedido']==1) {  ?>
              <li class="nav-item ">
                <a href="pedido_paquete.php" class="nav-link pl-2" id="lPedido_paquete">
                <i class="nav-icon  fas fa-dollar-sign"></i>
                  <p>Pedido </p>
                </a>
              </li>
            <?php  }  ?>     
            <?php if ($_SESSION['pedido']==1) {  ?>
              <li class="nav-item ">
                <a href="#" class="nav-link pl-2" id="lExperiencias">
                <!-- <i class="nav-icon  fas fa-dollar-sign"></i> -->
                <i class=" nav-icon fa-brands fa-slack"></i>
                  <p>Experiencias </p>
                </a>
              </li>
            <?php  }  ?>         
            
          </ul>
        </li> 

        <!-- REPORTES -->   
        <li class="nav-item " id="bloc_ContableFinanciero">
          <a href="#" class="nav-link bg-color-2c2c2c" id="mContableFinanciero" style="padding-left: 7px;">
            <i class="nav-icon far fa-circle"></i>
            <p class="font-size-14px">REPORTES<i class="fas fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview">

            <?php if ($_SESSION['reporte']==1) {  ?>
              <!-- RESUMEN DE GASTOS -->
              <li class="nav-item ">
                <a href="pago_trabajador.php" class="nav-link pl-2" id="lPagoTrabajador">
                  <i class="fas fa-dollar-sign nav-icon"></i>
                  <p>Pago Trabajador</p>
                </a>
              </li>
            <?php  }  ?>

            <?php if ($_SESSION['reporte']==1) {  ?>
              <li class="nav-item ">
                <a href="otro_ingreso.php" class="nav-link pl-2" id="lOtroIngreso">             
                  <i class="nav-icon fas fa-hand-holding-usd"></i>
                  <p>Otro ingreso </p>
                </a>
              </li>
            <?php  }  ?>
            
          </ul>
        </li>

        <!-- CONTABLE Y FINANCIERO -->   
        <li class="nav-item " id="bloc_ContableFinanciero">
          <a href="#" class="nav-link bg-color-2c2c2c" id="mContableFinanciero" style="padding-left: 7px;">
            <i class="nav-icon far fa-circle"></i>
            <p class="font-size-14px">CONTABLE Y FINANCIERO<i class="fas fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview">

            <?php if ($_SESSION['contable_financiero']==1) {  ?>
              <!-- RESUMEN DE GASTOS -->
              <li class="nav-item ">
                <a href="pago_trabajador.php" class="nav-link pl-2" id="lPagoTrabajador">
                  <i class="fas fa-dollar-sign nav-icon"></i>
                  <p>Pago Trabajador</p>
                </a>
              </li>
            <?php  }  ?>

            <?php if ($_SESSION['contable_financiero']==1) {  ?>
              <li class="nav-item ">
                <a href="otro_ingreso.php" class="nav-link pl-2" id="lOtroIngreso">             
                  <i class="nav-icon fas fa-hand-holding-usd"></i>
                  <p>Otro ingreso </p>
                </a>
              </li>
            <?php  }  ?>
            
          </ul>
        </li>

      </ul>      
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
