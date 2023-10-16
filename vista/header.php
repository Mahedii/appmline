<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact " dir="ltr" data-theme="theme-default" data-assets-path="../public/dist/assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>appmlinemoney.com</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;ampdisplay=swap" rel="stylesheet">

    
    <!-- <link rel="stylesheet" href="../public/dist/css/bootstrap.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="../public/dist/css/bootstrap-select.min.css"> -->
    <!-- <link rel="stylesheet" href="../public/dist/assets/vendor/libs/select2/select2.css" /> -->

    <!-- Icons -->
    <link rel="stylesheet" href="../public/dist/assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="../public/dist/assets/vendor/fonts/tabler-icons.css"/>
    <link rel="stylesheet" href="../public/dist/assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../public/dist/assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../public/dist/assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../public/dist/assets/css/demo.css" />
    
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../public/dist/assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="../public/dist/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../public/dist/assets/vendor/libs/typeahead-js/typeahead.css" /> 
    <link rel="stylesheet" href="../public/dist/assets/vendor/libs/flatpickr/flatpickr.css" />
    <link rel="stylesheet" href="../public/dist/assets/vendor/libs/apex-charts/apex-charts.css" />
    <link rel="stylesheet" href="../public/dist/assets/vendor/libs/swiper/swiper.css" />

    <link rel="stylesheet" href="../public/dist/assets/vendor/libs/select2/select2.css" />
    <!-- <link rel="stylesheet" href="../public/dist/assets/vendor/libs/bootstrap-select/bootstrap-select.css"> -->

    <link rel="stylesheet" href="../public/dist/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css">
    <link rel="stylesheet" href="../public/dist/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css">
    <link rel="stylesheet" href="../public/dist/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css">
    <link rel="stylesheet" href="../public/dist/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css">
    <link rel="stylesheet" href="../public/dist/assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css">

    <!--datatable css-->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css"> -->

    <!-- Page CSS -->
    <link rel="stylesheet" href="../public/dist/assets/vendor/css/pages/cards-advance.css" />

    <style>
      /* .select2-container {
          display: block;
      } */
      .select2-container--default .select2-selection--single .select2-selection__arrow b {
          border-style: none;
      }
      .offcanvas,.offcanvas-xxl,.offcanvas-xl,.offcanvas-lg,.offcanvas-md,.offcanvas-sm {
          --bs-offcanvas-width: 500px;
      }
    </style>
    

    <!-- Helpers -->
    <script src="../public/dist/assets/vendor/js/helpers.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../public/dist/assets/js/config.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
</head>

<body>

  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar  ">
    <div class="layout-container">
      <!-- Menu -->
      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

        <div class="app-brand demo ">
          <a href="escritorio.php" class="app-brand-link">
            <img src="../public/dist/img/logo1.png" class="" width="50px" alt="Imagen Usuario">
            
            <span class="app-brand-text demo menu-text fw-bold">M_Line</span>
          </a>

          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
          </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <?php $activePage = basename($_SERVER['PHP_SELF'], ".php"); ?>
        
        <ul class="menu-inner py-1">
          <li class="menu-header small text-uppercase">
            <span class="menu-header-text">ROLE</span>
          </li>
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link bg-label-success waves-light">
              <i class="menu-icon ti ti-user-code"></i>
              <div data-i18n="<?php echo $_SESSION['rol']; ?>"><?php echo $_SESSION['rol']; ?></div>
            </a>
          </li>

          <li class="menu-header small text-uppercase">
            <span class="menu-header-text">MENU</span>
          </li>
          <li class="menu-item  <?php echo ($activePage === 'escritorio') ? 'active' : ''; ?>">
            <a href="escritorio.php" class="menu-link">
              <i class="menu-icon tf-icons ti ti-device-laptop"></i>
              <div data-i18n="Escritorio">Escritorio</div>
            </a>
          </li>
          <li class="menu-item  <?php echo ($activePage === 'envios') ? 'active' : ''; ?>">
            <a href="envios.php" class="menu-link">
              <i class="menu-icon tf-icons ti ti-send"></i>
              <div data-i18n="Envios">Envios</div>
            </a>
          </li>
          <li class="menu-item  <?php echo ($activePage === 'recibos') ? 'active' : ''; ?>">
            <a href="recibos.php" class="menu-link">
              <i class="menu-icon tf-icons ti ti-arrow-big-down-filled"></i>
              <div data-i18n="Retiros">Retiros</div>
            </a>
          </li>
          <!-- <li class="menu-item  <?php echo ($activePage === 'billetes') ? 'active' : ''; ?>"><a href="billetes.php" class="menu-link"><i class="menu-icon fa fa-plane"></i> <span>Billetes</span></a></li> -->
          <li class="menu-item  <?php echo ($activePage === 'empleados') ? 'active' : ''; ?>"><a href="empleados.php" class="menu-link"><i class="menu-icon fa fa-users"></i><div data-i18n="Empleados">Empleados</div></a></li>
          <li class="menu-item  <?php echo ($activePage === '#') ? 'active' : ''; ?>"><a href="#" class="menu-link"><i class="menu-icon fa fa-plane"></i><div data-i18n="Transacciones UV">Transacciones UV</div></a></li>
          <li class="menu-item <?php echo ($activePage === 'bancos' || $activePage === 'banco_comercial' || $activePage === 'clientes' || $activePage === 'agencias' || $activePage === 'cuentas' || $activePage === 'cajas' || $activePage === 'tasas' || $activePage === 'contabilidad' || $activePage === 'solicitudes' || $activePage === 'paises' || $activePage === 'usuarios' || $activePage === 'permiso') ? 'active open' : ''; ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon fa fa-cubes"></i>
              <div data-i18n="Administracion">Administracion</div>
            </a>

            <ul class="menu-sub">
              <li class="menu-item  <?php echo ($activePage === 'bancos') ? 'active' : ''; ?>"><a href="bancos.php" class="menu-link"><i class="menu-icon fa fa-bank"></i>Banco</a></li>
              <li class="menu-item  <?php echo ($activePage === 'banco_comercial') ? 'active' : ''; ?>"><a href="banco_comercial.php" class="menu-link"><i class="menu-icon fa fa-cc-mastercard"></i> Comercial</a></li>
              <li class="menu-item  <?php echo ($activePage === 'clientes') ? 'active' : ''; ?>"><a href="clientes.php" class="menu-link"><i class="menu-icon fa fa-group "></i>Clientes</a></li>
              <li class="menu-item  <?php echo ($activePage === 'agencias') ? 'active' : ''; ?>"><a href="agencias.php" class="menu-link"><i class="menu-icon fa fa-home"></i>Agencias</a></li>
              <li class="menu-item  <?php echo ($activePage === 'cuentas') ? 'active' : ''; ?>"><a href="cuentas.php" class="menu-link"><i class="menu-icon fa fa-bank"></i>Cuentas</a></li>
              <li class="menu-item  <?php echo ($activePage === 'cajas') ? 'active' : ''; ?>"><a href="cajas.php" class="menu-link"><i class="menu-icon fa fa-briefcase"></i>Cajas</a></li>
              <li class="menu-item  <?php echo ($activePage === 'tasas') ? 'active' : ''; ?>"><a href="tasas.php" class="menu-link"><i class="menu-icon fa fa-circle-o"></i>Tarifario envios</a></li>
              <li class="menu-item  <?php echo ($activePage === 'contabilidad') ? 'active' : ''; ?>"><a href="contabilidad.php" class="menu-link"><i class="menu-icon fa fa-file-excel-o"></i>Contabilidad</a></li>
              <!-- <li class="menu-item  <?php echo ($activePage === 'rutas') ? 'active' : ''; ?>"><a href="rutas.php" class="menu-link"><i class="menu-icon fa fa-circle-o"></i>Rutas de vuelos</a></li> -->
              <li class="menu-item  <?php echo ($activePage === 'solicitudes') ? 'active' : ''; ?>"><a href="solicitudes.php" class="menu-link"><i class="menu-icon fa fa-envelope-o"></i>Solicitudes</a></li>
              <li class="menu-item  <?php echo ($activePage === 'paises') ? 'active' : ''; ?>"><a href="paises.php" class="menu-link"><i class="menu-icon fa fa-map-signs"></i>Paises</a></li>
              <li class="menu-item  <?php echo ($activePage === 'usuarios') ? 'active' : ''; ?>"><a href="usuarios.php" class="menu-link"><i class="menu-icon fa fa-user"></i>Usuarios</a></li>
              <li class="menu-item  <?php echo ($activePage === 'permiso') ? 'active' : ''; ?>"><a href="permiso.php" class="menu-link"><i class="menu-icon fa fa-lock"></i>Permisos</a></li>
            </ul>
          </li>
          <li class="menu-item  <?php echo ($activePage === 'consultas_envios' || $activePage === 'consultas_recibos' || $activePage === 'consultas_operaciones') ? 'active open' : ''; ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon fa fa-bar-chart"></i>
              <div data-i18n="Consultas">Consultas</div>
            </a>

            <ul class="menu-sub">
              <li class="menu-item  <?php echo ($activePage === 'consultas_envios') ? 'active' : ''; ?>"><a href="consultas_envios.php" class="menu-link"><i class="menu-icon fa fa-send"></i>Envios</a></li>
              <li class="menu-item  <?php echo ($activePage === 'consultas_recibos') ? 'active' : ''; ?>"><a href="consultas_recibos.php" class="menu-link"><i class="menu-icon fa fa-arrow-circle-o-down"></i>Retiros</a></li>
              <li class="menu-item  <?php echo ($activePage === 'consultas_operaciones') ? 'active' : ''; ?>"><a href="consultas_operaciones.php" class="menu-link"><i class="menu-icon fa fa-book"></i>Operaciones</a></li>
            </ul>
          </li>
          <li class="menu-item  <?php echo ($activePage === '#') ? 'active' : ''; ?>">
            <a href="javascript:alert('Contacte con el Soporte tecnico desarrolladores de la aplicación')" class="menu-link">
              <i class="menu-icon fa fa-plus-square"></i>
              <div data-i18n="Ayuda">Ayuda</div>
              <div class="badge bg-danger rounded-pill ms-auto">PDF</div>
            </a>
          </li>
          <li class="menu-item  <?php echo ($activePage === '#') ? 'active' : ''; ?>">
            <a href="#" class="menu-link">
              <i class="menu-icon fa fa-info-circle"></i>
              <div data-i18n="Acerca De...">Acerca De...</div>
              <div class="badge bg-warning rounded-pill ms-auto">M_LINE</div>
            </a>
          </li>
        </ul>

      </aside>
      <!-- / Menu -->

      <!-- Layout container -->
      <div class="layout-page">

        <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">

              <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0   d-xl-none ">
                <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                  <i class="ti ti-menu-2 ti-sm"></i>
                </a>
              </div>
              

              <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

                
                <!-- Search -->
                <!-- <div class="navbar-nav align-items-center">
                  <div class="nav-item navbar-search-wrapper mb-0">
                    <a class="nav-item nav-link search-toggler d-flex align-items-center px-0" href="javascript:void(0);">
                      <i class="ti ti-search ti-md me-2"></i>
                      <span class="d-none d-md-inline-block text-muted">Search (Ctrl+/)</span>
                    </a>
                  </div>
                </div> -->
                <!-- /Search -->


                <ul class="navbar-nav flex-row align-items-center ms-auto">

                  
                  <!-- Language -->
                  <li class="nav-item dropdown-language dropdown me-2 me-xl-0">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                      <i class='ti ti-language rounded-circle ti-md'></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                      <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-language="en">
                          <span class="align-middle">English</span>
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-language="fr">
                          <span class="align-middle">French</span>
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-language="de">
                          <span class="align-middle">German</span>
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-language="pt">
                          <span class="align-middle">Portuguese</span>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <!--/ Language -->
                  
                  <!-- Money -->
                  <li class="nav-item dropdown me-2 me-xl-0">
                    
                    <script type="text/javascript">
                        $(document).ready(function() {
                            const pNode = document.getElementById("saldoCaja");
                            function ponerNCPySaldo() {
                                $.post("../ajax/ajax_cajas.php?op=ponerNCPySaldo", { }, function(data, status) {
                                    data = JSON.parse(data);
                                    $("#ncpUsuario").val(data.numerocuenta);
                                    $("#saldoReal").val(data.saldo);
                                    pNode.innerText = data.saldo;

                                });
                            }
                            setInterval(ponerNCPySaldo, 100);
                        });
                    </script>
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                      <i class='ti ti-moneybag rounded-circle ti-md'></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                      <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-language="en">
                          <form name="formularioSaldo" id="formularioSaldo" method="post">
                            <input type="hidden" name="saldoReal" id="saldoReal" >
                            <input type="hidden" name="ncpUsuario" id="ncpUsuario">
                          </form>
                          <i class='ti ti-cash-banknote rounded-circle ti-md'></i>
                          <i id="saldoCaja" >   </i> 
                          <span class="badge bg-success rounded-pill badge-notifications">XAF</span>
                          <!-- <span class="align-middle">English</span> -->
                        </a>
                      </li>
                    </ul>
                  </li>
                  <!--/ Language -->

                  <!-- Style Switcher -->
                  <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                      <i class='ti ti-md ti-sun'></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                      <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                          <span class="align-middle"><i class='ti ti-sun me-2'></i>Light</span>
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                          <span class="align-middle"><i class="ti ti-moon me-2"></i>Dark</span>
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                          <span class="align-middle"><i class="ti ti-device-desktop me-2"></i>System</span>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <!-- / Style Switcher-->
                  
                  <!-- Notification -->
                  <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                      <i class="ti ti-bell ti-md"></i>
                      <span class="badge bg-danger rounded-pill badge-notifications">5</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end py-0">
                      <li class="dropdown-menu-header border-bottom">
                        <div class="dropdown-header d-flex align-items-center py-3">
                          <h5 class="text-body mb-0 me-auto">Notification</h5>
                          <a href="javascript:void(0)" class="dropdown-notifications-all text-body" data-bs-toggle="tooltip" data-bs-placement="top" title="Mark all as read"><i class="ti ti-mail-opened fs-4"></i></a>
                        </div>
                      </li>
                      <li class="dropdown-notifications-list scrollable-container">
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item list-group-item-action dropdown-notifications-item">
                            <div class="d-flex">
                              <div class="flex-shrink-0 me-3">
                                <div class="avatar">
                                  <img src="../public/dist/img/logo1.png" alt class="h-auto rounded-circle">
                                </div>
                              </div>
                              <div class="flex-grow-1">
                                <h6 class="mb-1">Congratulation Lettie 🎉</h6>
                                <p class="mb-0">Won the monthly best seller gold badge</p>
                                <small class="text-muted">1h ago</small>
                              </div>
                              <div class="flex-shrink-0 dropdown-notifications-actions">
                                <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                                <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ti ti-x"></span></a>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item list-group-item-action dropdown-notifications-item">
                            <div class="d-flex">
                              <div class="flex-shrink-0 me-3">
                                <div class="avatar">
                                  <span class="avatar-initial rounded-circle bg-label-danger">CF</span>
                                </div>
                              </div>
                              <div class="flex-grow-1">
                                <h6 class="mb-1">Charles Franklin</h6>
                                <p class="mb-0">Accepted your connection</p>
                                <small class="text-muted">12hr ago</small>
                              </div>
                              <div class="flex-shrink-0 dropdown-notifications-actions">
                                <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                                <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ti ti-x"></span></a>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                            <div class="d-flex">
                              <div class="flex-shrink-0 me-3">
                                <div class="avatar">
                                  <img src="../public/dist/assets/img/avatars/2.png" alt class="h-auto rounded-circle">
                                </div>
                              </div>
                              <div class="flex-grow-1">
                                <h6 class="mb-1">New Message ✉️</h6>
                                <p class="mb-0">You have new message from Natalie</p>
                                <small class="text-muted">1h ago</small>
                              </div>
                              <div class="flex-shrink-0 dropdown-notifications-actions">
                                <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                                <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ti ti-x"></span></a>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item list-group-item-action dropdown-notifications-item">
                            <div class="d-flex">
                              <div class="flex-shrink-0 me-3">
                                <div class="avatar">
                                  <span class="avatar-initial rounded-circle bg-label-success"><i class="ti ti-shopping-cart"></i></span>
                                </div>
                              </div>
                              <div class="flex-grow-1">
                                <h6 class="mb-1">Whoo! You have new order 🛒 </h6>
                                <p class="mb-0">ACME Inc. made new order $1,154</p>
                                <small class="text-muted">1 day ago</small>
                              </div>
                              <div class="flex-shrink-0 dropdown-notifications-actions">
                                <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                                <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ti ti-x"></span></a>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                            <div class="d-flex">
                              <div class="flex-shrink-0 me-3">
                                <div class="avatar">
                                  <img src="../public/dist/assets/img/avatars/9.png" alt class="h-auto rounded-circle">
                                </div>
                              </div>
                              <div class="flex-grow-1">
                                <h6 class="mb-1">Application has been approved 🚀 </h6>
                                <p class="mb-0">Your ABC project application has been approved.</p>
                                <small class="text-muted">2 days ago</small>
                              </div>
                              <div class="flex-shrink-0 dropdown-notifications-actions">
                                <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                                <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ti ti-x"></span></a>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                            <div class="d-flex">
                              <div class="flex-shrink-0 me-3">
                                <div class="avatar">
                                  <span class="avatar-initial rounded-circle bg-label-success"><i class="ti ti-chart-pie"></i></span>
                                </div>
                              </div>
                              <div class="flex-grow-1">
                                <h6 class="mb-1">Monthly report is generated</h6>
                                <p class="mb-0">July monthly financial report is generated </p>
                                <small class="text-muted">3 days ago</small>
                              </div>
                              <div class="flex-shrink-0 dropdown-notifications-actions">
                                <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                                <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ti ti-x"></span></a>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                            <div class="d-flex">
                              <div class="flex-shrink-0 me-3">
                                <div class="avatar">
                                  <img src="../public/dist/assets/img/avatars/5.png" alt class="h-auto rounded-circle">
                                </div>
                              </div>
                              <div class="flex-grow-1">
                                <h6 class="mb-1">Send connection request</h6>
                                <p class="mb-0">Peter sent you connection request</p>
                                <small class="text-muted">4 days ago</small>
                              </div>
                              <div class="flex-shrink-0 dropdown-notifications-actions">
                                <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                                <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ti ti-x"></span></a>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item list-group-item-action dropdown-notifications-item">
                            <div class="d-flex">
                              <div class="flex-shrink-0 me-3">
                                <div class="avatar">
                                  <img src="../public/dist/assets/img/avatars/6.png" alt class="h-auto rounded-circle">
                                </div>
                              </div>
                              <div class="flex-grow-1">
                                <h6 class="mb-1">New message from Jane</h6>
                                <p class="mb-0">Your have new message from Jane</p>
                                <small class="text-muted">5 days ago</small>
                              </div>
                              <div class="flex-shrink-0 dropdown-notifications-actions">
                                <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                                <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ti ti-x"></span></a>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                            <div class="d-flex">
                              <div class="flex-shrink-0 me-3">
                                <div class="avatar">
                                  <span class="avatar-initial rounded-circle bg-label-warning"><i class="ti ti-alert-triangle"></i></span>
                                </div>
                              </div>
                              <div class="flex-grow-1">
                                <h6 class="mb-1">CPU is running high</h6>
                                <p class="mb-0">CPU Utilization Percent is currently at 88.63%,</p>
                                <small class="text-muted">5 days ago</small>
                              </div>
                              <div class="flex-shrink-0 dropdown-notifications-actions">
                                <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                                <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ti ti-x"></span></a>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </li>
                      <li class="dropdown-menu-footer border-top">
                        <a href="javascript:void(0);" class="dropdown-item d-flex justify-content-center text-primary p-2 h-px-40 mb-1 align-items-center">
                          View all notifications
                        </a>
                      </li>
                    </ul>
                  </li>
                  <!--/ Notification -->

                  <!-- User -->
                  <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                      <div class="avatar avatar-online">
                        <img src="../public/dist/img/logo1.png" alt class="h-auto rounded-circle">
                      </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                      <li>
                        <a class="dropdown-item" href="pages-account-settings-account.html">
                          <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                              <div class="avatar avatar-online">
                                <img src="../public/dist/img/logo1.png" alt class="h-auto rounded-circle">
                              </div>
                            </div>
                            <div class="flex-grow-1">
                              <span class="fw-medium d-block"><?php echo $_SESSION['nomcompleto']; ?></span>
                              <p style="margin-bottom: 0"><small class="text-muted"><?php echo $_SESSION['direccion']. ' . ' .date("M").'. '.date("Y"); ?></small></p>
                              <small class="text-muted"><?php echo $_SESSION['rol']; ?></small>
                            </div>
                          </div>
                        </a>
                      </li>
                      <li>
                        <div class="dropdown-divider"></div>
                      </li>
                      <li>
                        <a class="dropdown-item" href="perfil.php">
                          <i class="ti ti-user-check me-2 ti-sm"></i>
                          <span class="align-middle">My Profile</span>
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="javascript:void(0)">
                          <i class="ti ti-settings me-2 ti-sm"></i>
                          <span class="align-middle">Settings</span>
                        </a>
                      </li>
                      <li>
                        <div class="dropdown-divider"></div>
                      </li>
                      <li>
                        <a class="dropdown-item" href="javascript:void(0)">
                          <i class="ti ti-help me-2 ti-sm"></i>
                          <span class="align-middle">Wallet</span>
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="javascript:void(0)">
                          <i class="ti ti-currency-dollar me-2 ti-sm"></i>
                          <span class="align-middle">Envios</span>
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="javascript:void(0)">
                          <i class="ti ti-arrow-big-down-filled me-2 fa-sm"></i>
                          <span class="align-middle">Retiros</span>
                        </a>
                      </li>
                      <li>
                        <div class="dropdown-divider"></div>
                      </li>
                      <li>
                        <a class="dropdown-item" href="../ajax/ajax_usuarios.php?op=salir">
                          <i class="ti ti-logout me-2 ti-sm"></i>
                          <span class="align-middle">Log Out</span>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <!--/ User -->
                  
                </ul>
              </div>

              
              <!-- Search Small Screens -->
              <div class="navbar-search-wrapper search-input-wrapper  d-none">
                <input type="text" class="form-control search-input container-xxl border-0" placeholder="Search..." aria-label="Search...">
                <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
              </div>

        </nav>

