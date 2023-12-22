<?php
  //Activamos el almacenamiento en el buffer
  ob_start();
  session_start();

  if (!isset($_SESSION["nombre"])){
    header("Location: index.php?file=".basename($_SERVER['PHP_SELF']));
  }else{ ?>
    <!DOCTYPE html>
    <html lang="es">
      <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Papelera | Admin Fun Route</title>

        <?php $title = "Papelera"; require 'head.php'; ?>
        
      </head>
      <body class="hold-transition sidebar-mini sidebar-collapse layout-fixed layout-navbar-fixed ">
        
        <div class="wrapper">
          <!-- Preloader -->
          <!-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="../dist/svg/logo-principal.svg" alt="AdminLTELogo" width="360" />
          </div> -->
        
          <?php
          require 'nav.php';
          require 'aside.php';
          if ($_SESSION['pago_trabajador']==1){
            // require 'enmantenimiento.php';
            ?>  
            <!--Contenido-->
            <div class="content-wrapper">
              <!-- Content Header (Page header) -->
              

              <div class="content-header">
                <div class="container-fluid">
                  <div class="row mb-2">
                    <div class="col-sm-6">
                      <h1 class="m-0 nombre-trabajador"><i class="nav-icon fas fa-trash-alt"></i> Papelera</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="papelera.php">Home</a></li>
                        <li class="breadcrumb-item active">Papelera</li>
                      </ol>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
              </div>
              <!-- /.content-header -->
              
              <!-- Main content -->
              <section class="content">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-12">
                      <div class="card card-primary card-outline">
                        <div class="card-header"> 

                          <!-- agregar pago  -->
                          <h3 class="card-title " id="btn-agregar" >
                            <a href="" data-toggle="modal" data-target="#modal-modulos-incluidos" > <i class="fas fa-eye"></i> Aqui</a> podra ver todos los datos enviados a papelera 
                                            
                          </h3> 

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                          <!-- tabla principal -->
                          <div class=" pb-3">
                            <table id="tabla-principal" class="table table-bordered  table-striped display" style="width: 100% !important;">
                              <thead>
                                <tr> 
                                  <th>#</th> 
                                  <th>Acciones</th>
                                  <th>Módulo</th>
                                  <th>Archivo</th>
                                  <th>Descripcion</th>
                                  <th>Creado el</th>
                                  <th>Reciclado el</th>            
                                </tr>
                              </thead>
                              <tbody>                         
                                
                              </tbody>
                              <tfoot>
                                <tr> 
                                  <th>#</th> 
                                  <th>Acciones</th>
                                  <th>Módulo</th>
                                  <th>Archivo</th>
                                  <th>Descripcion</th>
                                  <th>Creado el</th>
                                  <th>Reciclado el</th>                            
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
                
                <!-- MODAL - MODULOS INCLUIDOS  -->
                <div class="modal fade" id="modal-modulos-incluidos">
                  <div class="modal-dialog modal-dialog-scrollable modal-md">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Módulos Incluidos</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span class="text-danger" aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body"> 

                          <!-- CARD - Acceso --------------------------------------------- -->
                          <div class="card card-outline collapsed-card cursor-pointer" style="box-shadow:none; margin-bottom:0%" data-card-widget="collapse">
                            <div class="card-header border-t-1px"><h3 class="card-title">1. <i class="nav-icon fas fa-shield-alt"></i> Acceso</h3></div>
                            <!-- /.card-header -->
                            <div class="card-body"><p class="ml-4">1.1. <i class="nav-icon fas fa-users-cog"></i> Usuario</p></div>
                            <!-- /.card-body -->
                          </div>

                          <!-- CARD - Acceso --------------------------------------------- -->
                          <div class="card card-outline collapsed-card cursor-pointer" style="box-shadow:none; margin-bottom:0%" data-card-widget="collapse">
                            <div class="card-header border-t-1px">
                              <h3 class="card-title">2. <i class="nav-icon fas fa-project-diagram"></i> Recursos</h3>
                              <!-- <div class="card-tools">
                                <button type="button" class="btn btn-default float-right btn-xs">
                                  <i class="fas fa-angle-left"></i>
                                </button>
                              </div> -->
                          </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                              <p class="ml-4">2.1. <i class="nav-icon fas fa-users-cog"></i> Trabajador (All_trabajador)</p>
                              <p class="ml-4">2.2. <i class="nav-icon fas fa-truck"></i> Provedeor (All_proveedores)</p>
                              <p class="ml-4">2.3. <i class="nav-icon fas fa-tractor"></i> Maquinaria (Máquinas-equipos)</p>
                              <p class="ml-4">2.4. <img src="../dist/svg/negro-palana-ico.svg" class="nav-icon" alt="" style="width: 21px !important;"> Producto (Insumos)</p>
                              <p class="ml-4">2.5. <i class="nav-icon fas fa-truck-pickup"></i> Producto(Activos fijjos)</p>
                              <p class="ml-4">2.6. <i class="nav-icon far fa-calendar-alt"></i> calendario_por_proyecto (All_calendario)</p>
                              <p class="ml-4">2.7. <i class="nav-icon fas fa-coins"></i> Otros</p>

                            </div>
                            <!-- /.card-body -->
                          </div>

                          <div class="card-header border-b-1px"><h3 class="card-title">3. <i class="nav-icon fas fa-hand-holding-usd"></i> Compra_af_general( Compra activos fijos )</h3></div>
                          
                          <div class="card-header border-b-1px"><h3 class="card-title">4. <i class="nav-icon fas fa-receipt"></i> Otra_factura ( Otras faturas )</h3></div>

                          <!-- CARD - Técnico --------------------------------------------- -->
                          <div class="card card-outline collapsed-card cursor-pointer" style="box-shadow:none; margin-bottom:0%" data-card-widget="collapse">
                            <div class="card-header border-t-1px">
                              <h3 class="card-title">5. <i class="nav-icon far fa-circle"></i> Técnico</h3>
                          </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                              <p class="ml-4">5.1. <i class="nav-icon fas fa-users-cog"></i> Carpeta_plano_otro (Planos y otros)</p>
                              <p class="ml-5">5.1.1 <i class="nav-icon fas fa-truck"></i> Plano_otro (Planos y otros)</p>

                            </div>
                            <!-- /.card-body -->
                          </div>

                          <!-- CARD - Logística y Adquisiciones --------------------------------------------- -->
                          <div class="card card-outline collapsed-card cursor-pointer" style="box-shadow:none; margin-bottom:0%" data-card-widget="collapse">
                            <div class="card-header border-t-1px">
                                <h3 class="card-title">6. <i class="nav-icon far fa-circle"></i> Logística y Adquisiciones</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                              <p class="ml-4">6.1. <img src="../dist/svg/negro-constructor-ico.svg" class="nav-icon" alt="" style="width: 21px !important;"> trabajador_por_proyecto (Trabajador)</p>
                              
                              <p class="ml-4">6.2. <i class="fas fa-shopping-cart nav-icon"></i> Compras</p>
                              <p class="ml-5">6.2.1 <i class="fas fa-shopping-cart nav-icon"></i> Compra_por_proyecto (Compra de Insumos)</p>
                              <p class="ml-5">6.2.2 <i class="fas fa-shopping-cart nav-icon"></i> Factura_compra_insumos (pago compras)</p>

                              <p class="ml-4">6.3 <img src="../dist/svg/negro-excabadora-ico.svg" class="nav-icon" alt="" style="width: 21px !important;"> Servicios - Maquinarias</p>
                              <p class="ml-5">6.3.1 <img src="../dist/svg/negro-excabadora-ico.svg" class="nav-icon" alt="" style="width: 21px !important;"> servicio (Detelle)</p>
                              <p class="ml-5">6.3.2 <img src="../dist/svg/negro-excabadora-ico.svg" class="nav-icon" alt="" style="width: 21px !important;"> pago_servicio (Pagos) </p>
                              <p class="ml-5">6.3.3 <img src="../dist/svg/negro-excabadora-ico.svg" class="nav-icon" alt="" style="width: 21px !important;"> factura (Facturas) </p>

                              <p class="ml-4">6.4 <img src="../dist/svg/negro-estacion-total-ico.svg" class="nav-icon" alt="" style="width: 21px !important;"> Servicios - Equipos</p>
                              <p class="ml-5">6.4.1 <img src="../dist/svg/negro-estacion-total-ico.svg" class="nav-icon" alt="" style="width: 21px !important;"> servicio (Detelle)</p>
                              <p class="ml-5">6.4.2 <img src="../dist/svg/negro-estacion-total-ico.svg" class="nav-icon" alt="" style="width: 21px !important;"> pago_servicio (Pagos) </p>
                              <p class="ml-5">6.4.3 <img src="../dist/svg/negro-estacion-total-ico.svg" class="nav-icon" alt="" style="width: 21px !important;"> factura (Facturas) </p>
                              
                              <p class="ml-4">6.5 <i class="nav-icon fas fa-hands-helping"></i> Sub contrato</p>
                              <p class="ml-5">6.5.1 <i class="nav-icon fas fa-hands-helping"></i> subcontrato (Principal)</p>
                              <p class="ml-5">6.5.2 <i class="nav-icon fas fa-hands-helping"></i> pago_subcontrato (Pagos) </p>

                              <p class="ml-4">6.6. <img src="../dist/svg/negro-planilla-seguro-ico.svg" class="nav-icon" alt="" style="width: 21px !important;"> planilla_seguro (Planillas y seguros)</p>
                              <p class="ml-4">6.7. <i class="nav-icon fas fa-network-wired"></i> otro_gasto (Otros Gastos)</p>
                              
                              <p class="ml-4">6.8 <i class="nav-icon fas fa-plane"></i> Víaticos</p>
                              <p class="ml-5">6.8.1 <i class="fas fa-shuttle-van nav-icon"></i> transporte (Transporte)</p>
                              <p class="ml-5">6.8.2 <i class="fas fa-hotel nav-icon"></i> hospedaje (Hospedajes) </p>

                              <p class="ml-5">6.8.3 <i class="fas fa-fish nav-icon"></i> Comida </p>
                              <p class="ml-6">6.8.3.1 <i class="fas fa-utensils nav-icon"></i> detalle_pension ( Pensión - Detalle) </p>
                              <p class="ml-6">6.8.3.2 <i class="fas fa-hamburger nav-icon"></i> factura_break (Comprobantes Break) </p>
                              <p class="ml-6">6.8.3.3 <i class="fas fa-drumstick-bite nav-icon"></i> detalle_pension (Comidas Extras) </p>
                              
                            </div>
                            <!-- /.card-body -->
                          </div>

                          <!-- CARD - Técnico --------------------------------------------- -->
                          <div class="card card-outline collapsed-card cursor-pointer" style="box-shadow:none; margin-bottom:0%" data-card-widget="collapse">
                            <div class="card-header border-t-1px">
                                <h3 class="card-title">7. <i class="nav-icon far fa-circle"></i> Contable y financiero</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                              <p class="ml-4">7.1 <i class="fas fa-users"></i> Pagos Trabajadores </p>
                              <p class="ml-5">7.1.1 <i class="fas fa-users"></i> pagos_q_s_obrero (Pagos de Obreros)</p>
                              <p class="ml-5">7.1.2. <i class="fas fa-briefcase"></i> pagos_x_mes_administrador (Pago administrador)</p>
                              <!-- <p class="ml-4">7.1 <i class="fas fa-users"></i> Pagos Trabajadores </p> -->


                            </div>
                            <!-- /.card-body -->
                          </div>

                      </div>
                    </div>
                  </div>
                </div>             

              </section>
              <!-- /.content -->
            </div>
            <!--Fin-Contenido-->

            

            <?php
          }else{
            require 'noacceso.php';
          }
          require 'footer.php';
          ?>

        </div>

        <?php require 'script.php'; ?>         

        <script type="text/javascript" src="scripts/papelera.js"></script>
         
        <script> $(function () { $('[data-toggle="tooltip"]').tooltip();  }) </script>
        
      </body>
    </html>
    <?php    
  }
  ob_end_flush();
?>
