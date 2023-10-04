<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["ap"])) {
  header("Location: login.html");
} else {
  require 'header.php';
  if ($_SESSION['escritorio'] == 1) {
?>

      <?php
      require_once "../modelos/class_Consultas.php";
      $cons = new Consulta();

      // TODO PROCEDE DE LAS FUNCIONES CREADAS EN class_Consultas
      $rspta = $cons->totalenvios($_SESSION['pais'], $_SESSION['agencia_em'], $_SESSION['rol'], $_SESSION['ap']);
      $reg = $rspta->fetch_object();
      $tot_envios = $reg->monto;

      $rspta = $cons->totalenviosHOY($_SESSION['pais'], $_SESSION['agencia_em'], $_SESSION['rol'], $_SESSION['ap']);
      $reg = $rspta->fetch_object();
      $tot_enviosHOY = $reg->monto;

      $rspta = $cons->totalrecibos($_SESSION['pais'], $_SESSION['agencia_em'], $_SESSION['rol'], $_SESSION['ap']);
      $reg = $rspta->fetch_object();
      $tot_recibos = $reg->monto;

      $rspta = $cons->totalrecibosHOY($_SESSION['pais'], $_SESSION['agencia_em'], $_SESSION['rol'], $_SESSION['ap']);
      $reg = $rspta->fetch_object();
      $tot_recibosHOY = $reg->monto;

      $rspta = $cons->totalcomisionesMLINE($_SESSION['pais'], $_SESSION['agencia_em'], $_SESSION['rol'], $_SESSION['ap']);
      $reg = $rspta->fetch_object();
      $tot_comisionesMLINE = $reg->monto;

      $rspta = $cons->totalcomisionesEnvio($_SESSION['pais'], $_SESSION['agencia_em'], $_SESSION['rol'], $_SESSION['ap']);
      $reg = $rspta->fetch_object();
      $tot_comisionesEnvio = $reg->monto;

      $rspta = $cons->totalcomisionesRetitos($_SESSION['pais'], $_SESSION['agencia_em'], $_SESSION['rol'], $_SESSION['ap']);
      $reg = $rspta->fetch_object();
      $tot_comisionesRetiros = $reg->monto;

      $rspta = $cons->totalcomisionesHOYEnvios($_SESSION['pais'], $_SESSION['agencia_em'], $_SESSION['rol'], $_SESSION['ap']);
      $reg = $rspta->fetch_object();
      $tot_comisionesHOYEnvios = $reg->monto;

      $rspta = $cons->totalcomisionesHOYRetiros($_SESSION['pais'], $_SESSION['agencia_em'], $_SESSION['rol'], $_SESSION['ap']);
      $reg = $rspta->fetch_object();
      $tot_comisionesHOYRetiros = $reg->monto;


      $rspta = $cons->totalcomisionesGENERALES($_SESSION['pais'], $_SESSION['agencia_em'], $_SESSION['rol'], $_SESSION['ap']);
      $reg = $rspta->fetch_object();
      $tot_comisionesGENERALES = $reg->monto;

      $rspta = $cons->totalIVA();
      $reg = $rspta->fetch_object();
      $tot_IVA = $reg->monto;

      // CUENTA DE CAPITAL SALDO
      $rspta = $cons->totalSaldoCAPITAL();
      $reg = $rspta->fetch_object();
      $tot_saldo_CAPITAL = $reg->monto;


      // Datos para mostrar en el grafico de enviosUlt10dias || fecha,total
      $rspta = $cons->totalenviosUltimos_10dias($_SESSION['pais'], $_SESSION['agencia_em'], $_SESSION['rol'], $_SESSION['ap']);
      $fechaE = '';
      $totalE = '';
      while ($reg = $rspta->fetch_object()) {
        $fechaE = $fechaE . '"' . $reg->fecha . '",';
        $totalE = $totalE . '"' . $reg->total . '",';
      }
      // Quitamos la ultima oma
      $fechaE = substr($fechaE, 0, -1);
      $totalE = substr($totalE, 0, -1);


      // Datos para mostrar en el grafico de recibosUlt10dias || fecha,total
      $rspta = $cons->totalrecibosUltimos_10dias($_SESSION['pais'], $_SESSION['agencia_em'], $_SESSION['rol'], $_SESSION['ap']);
      $fechaR = '';
      $totalR = '';
      while ($reg = $rspta->fetch_object()) {
        $fechaR = $fechaR . '"' . $reg->fecha . '",';
        $totalR = $totalR . '"' . $reg->total . '",';
      }
      // Quitamos la ultima oma
      $fechaR = substr($fechaR, 0, -1);
      $totalR = substr($totalR, 0, -1);




      // Datos para mostrar en el grafico de enviosUlt10dias || nomcompleto,total
      /*    $rspta=$cons->ClientesMasEnvios();
     $nomcompleto='';
     $total='';
       while ($reg = $rspta->fetch_object())
        {
          $nomcompleto=$nomcompleto.'"'.$reg->nomcompleto.'",';
          $total=$total.'"'.$reg->total.'",';
        }
    // Quitamos la ultima oma
        $nomcompleto=substr($nomcompleto,0,-1);
        $total=substr($total,0,-1);

   // Datos para mostrar en el grafico de CompaniaMasBilletes || nomcompleto,total
    $rspta=$cons->CompaniaMasBilletes();
     $company='';
     $totalB='';
       while ($reg = $rspta->fetch_object())
        {
          $company=$company.'"'.$reg->company.'",';
          $totalB=$totalB.'"'.$reg->totalB.'",';
        }
    // Quitamos la ultima oma
        $company=substr($company,0,-1);
        $totalB=substr($totalB,0,-1);
*/


      ?>


      
<!-- Content wrapper -->
<div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="py-3 mb-4"><span>Escritorio <small class="text-muted fw-light">Estadisticas</small></h4>

          <div class="row">

            <div class="col-lg-3 col-sm-6 mb-4">
              <div class="card card-border-shadow-primary h-100">
                <div class="card-body">
                  <div class="d-flex align-items-center mb-2 pb-1">
                    <div class="avatar me-2">
                      <span class="avatar-initial rounded bg-label-primary"><i class='ti ti-moneybag rounded-circle ti-md'></i></span>
                    </div>
                    <h4 class="ms-1 mb-0"><?php echo number_format($tot_envios, 0, '', '.'); ?> FCFA</h4>
                  </div>
                  <p class="mb-1">Total envios</p>
                  <a href="consultas_envios.php" class="mb-0">
                    <span class="fw-medium me-1">Envios</span>
                    <small class="text-muted"><i class="fa fa-arrow-circle-right"></i></small>
                  </a>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-sm-6 mb-4">
              <div class="card card-border-shadow-primary h-100">
                <div class="card-body">
                  <div class="d-flex align-items-center mb-2 pb-1">
                    <div class="avatar me-2">
                      <span class="avatar-initial rounded bg-label-primary"><i class='ti ti-moneybag rounded-circle ti-md'></i></span>
                    </div>
                    <h4 class="ms-1 mb-0"><?php echo number_format($tot_enviosHOY, 0, '', '.'); ?> FCFA</h4>
                  </div>
                  <p class="mb-1">Total envios HOY</p>
                  <a href="consultas_envios.php" class="mb-0">
                    <span class="fw-medium me-1">Envios</span>
                    <small class="text-muted"><i class="fa fa-arrow-circle-right"></i></small>
                  </a>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-sm-6 mb-4">
              <div class="card card-border-shadow-primary h-100">
                <div class="card-body">
                  <div class="d-flex align-items-center mb-2 pb-1">
                    <div class="avatar me-2">
                      <span class="avatar-initial rounded bg-label-primary"><i class='ti ti-moneybag rounded-circle ti-md'></i></span>
                    </div>
                    <h4 class="ms-1 mb-0"><?php echo number_format($tot_recibos, 0, '', '.'); ?> FCFA</h4>
                  </div>
                  <p class="mb-1">Total retiros</p>
                  <a href="consultas_recibos.php" class="mb-0">
                    <span class="fw-medium me-1">Retiros</span>
                    <small class="text-muted"><i class="fa fa-arrow-circle-right"></i></small>
                  </a>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-sm-6 mb-4">
              <div class="card card-border-shadow-primary h-100">
                <div class="card-body">
                  <div class="d-flex align-items-center mb-2 pb-1">
                    <div class="avatar me-2">
                      <span class="avatar-initial rounded bg-label-primary"><i class='ti ti-moneybag rounded-circle ti-md'></i></span>
                    </div>
                    <h4 class="ms-1 mb-0"><?php echo number_format($tot_recibosHOY, 0, '', '.'); ?> FCFA</h4>
                  </div>
                  <p class="mb-1">Total retiros HOY</p>
                  <a href="consultas_recibos.php" class="mb-0">
                    <span class="fw-medium me-1">Recibos</span>
                    <small class="text-muted"><i class="fa fa-arrow-circle-right"></i></small>
                  </a>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-sm-6 mb-4">
              <div class="card card-border-shadow-primary h-100">
                <div class="card-body">
                  <div class="d-flex align-items-center mb-2 pb-1">
                    <div class="avatar me-2">
                      <span class="avatar-initial rounded bg-label-primary"><i class='ti ti-moneybag rounded-circle ti-md'></i></span>
                    </div>
                    <h4 class="ms-1 mb-0"><?php echo number_format($tot_comisionesMLINE, 0, '', '.'); ?> FCFA</h4>
                  </div>
                  <p class="mb-1">Total comisiones</p>
                  <a href="consultas_envios.php" class="mb-0">
                    <span class="fw-medium me-1">Comisiones</span>
                    <small class="text-muted"><i class="fa fa-arrow-circle-right"></i></small>
                  </a>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-sm-6 mb-4">
              <div class="card card-border-shadow-primary h-100">
                <div class="card-body">
                  <div class="d-flex align-items-center mb-2 pb-1">
                    <div class="avatar me-2">
                      <span class="avatar-initial rounded bg-label-primary"><i class='ti ti-moneybag rounded-circle ti-md'></i></span>
                    </div>
                    <h4 class="ms-1 mb-0"><?php echo number_format($tot_comisionesEnvio, 0, '', '.'); ?> FCFA</h4>
                  </div>
                  <p class="mb-1">Total comisiones Envios</p>
                  <a href="consultas_envios.php" class="mb-0">
                    <span class="fw-medium me-1">Comisiones</span>
                    <small class="text-muted"><i class="fa fa-arrow-circle-right"></i></small>
                  </a>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-sm-6 mb-4">
              <div class="card card-border-shadow-primary h-100">
                <div class="card-body">
                  <div class="d-flex align-items-center mb-2 pb-1">
                    <div class="avatar me-2">
                      <span class="avatar-initial rounded bg-label-primary"><i class='ti ti-moneybag rounded-circle ti-md'></i></span>
                    </div>
                    <h4 class="ms-1 mb-0"><?php echo number_format($tot_comisionesRetiros, 0, '', '.'); ?> FCFA</h4>
                  </div>
                  <p class="mb-1">Total comisiones Retiros</p>
                  <a href="consultas_envios.php" class="mb-0">
                    <span class="fw-medium me-1">Comisiones</span>
                    <small class="text-muted"><i class="fa fa-arrow-circle-right"></i></small>
                  </a>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-sm-6 mb-4">
              <div class="card card-border-shadow-primary h-100">
                <div class="card-body">
                  <div class="d-flex align-items-center mb-2 pb-1">
                    <div class="avatar me-2">
                      <span class="avatar-initial rounded bg-label-primary"><i class='ti ti-moneybag rounded-circle ti-md'></i></span>
                    </div>
                    <h4 class="ms-1 mb-0"><?php echo number_format($tot_comisionesHOYEnvios, 0, '', '.'); ?> FCFA</h4>
                  </div>
                  <p class="mb-1">Comisiones HOY Envios</p>
                  <a href="consultas_envios.php" class="mb-0">
                    <span class="fw-medium me-1">Comisiones</span>
                    <small class="text-muted"><i class="fa fa-arrow-circle-right"></i></small>
                  </a>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-sm-6 mb-4">
              <div class="card card-border-shadow-primary h-100">
                <div class="card-body">
                  <div class="d-flex align-items-center mb-2 pb-1">
                    <div class="avatar me-2">
                      <span class="avatar-initial rounded bg-label-primary"><i class='ti ti-moneybag rounded-circle ti-md'></i></span>
                    </div>
                    <h4 class="ms-1 mb-0"><?php echo number_format($tot_comisionesHOYRetiros, 0, '', '.'); ?> FCFA</h4>
                  </div>
                  <p class="mb-1">Comisiones HOY Retiros</p>
                  <a href="consultas_envios.php" class="mb-0">
                    <span class="fw-medium me-1">Comisiones</span>
                    <small class="text-muted"><i class="fa fa-arrow-circle-right"></i></small>
                  </a>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-sm-6 mb-4">
              <div class="card card-border-shadow-primary h-100">
                <div class="card-body">
                  <div class="d-flex align-items-center mb-2 pb-1">
                    <div class="avatar me-2">
                      <span class="avatar-initial rounded bg-label-primary"><i class='ti ti-moneybag rounded-circle ti-md'></i></span>
                    </div>
                    <h4 class="ms-1 mb-0"><?php echo number_format($tot_comisionesGENERALES, 0, '', '.'); ?> FCFA</h4>
                  </div>
                  <p class="mb-1">Comisiones GLOB</p>
                  <a href="consultas_envios.php" class="mb-0">
                    <span class="fw-medium me-1">Comisiones</span>
                    <small class="text-muted"><i class="fa fa-arrow-circle-right"></i></small>
                  </a>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-sm-6 mb-4">
              <div class="card card-border-shadow-primary h-100">
                <div class="card-body">
                  <div class="d-flex align-items-center mb-2 pb-1">
                    <div class="avatar me-2">
                      <span class="avatar-initial rounded bg-label-primary"><i class='ti ti-moneybag rounded-circle ti-md'></i></span>
                    </div>
                    <h4 class="ms-1 mb-0"><?php echo number_format($tot_IVA, 0, '', '.'); ?> FCFA</h4>
                  </div>
                  <p class="mb-1">IVA</p>
                  <a href="consultas_envios.php" class="mb-0">
                    <span class="fw-medium me-1">Comisiones</span>
                    <small class="text-muted"><i class="fa fa-arrow-circle-right"></i></small>
                  </a>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-sm-6 mb-4">
              <div class="card card-border-shadow-primary h-100">
                <div class="card-body">
                  <div class="d-flex align-items-center mb-2 pb-1">
                    <div class="avatar me-2">
                      <span class="avatar-initial rounded bg-label-primary"><i class='ti ti-moneybag rounded-circle ti-md'></i></span>
                    </div>
                    <h4 class="ms-1 mb-0"><?php echo number_format($tot_saldo_CAPITAL, 0, '', '.'); ?> FCFA</h4>
                  </div>
                  <p class="mb-1">CAPITAL</p>
                  <a href="consultas_envios.php" class="mb-0">
                    <span class="fw-medium me-1">Comisiones</span>
                    <small class="text-muted"><i class="fa fa-arrow-circle-right"></i></small>
                  </a>
                </div>
              </div>
            </div>

          </div>

          <!-- Cards Action -->
          <div class="row">
            <div class="col-lg-6 col-sm-12 mb-4">
              <div class="card card-action card-border-shadow-primary mb-5">
                <div class="card-alert"></div>
                <div class="card-header">
                  <div class="card-action-title">Recibos ultimos 10 días</div>
                  <div class="card-action-element">
                    <ul class="list-inline mb-0">
                      <li class="list-inline-item">
                        <a href="javascript:void(0);" class="card-collapsible"><i class="tf-icons ti ti-chevron-right scaleX-n1-rtl ti-sm"></i></a>
                      </li>
                      <li class="list-inline-item">
                        <a href="javascript:void(0);" class="card-close"><i class="tf-icons ti ti-x ti-sm"></i></a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="collapse show">
                  <div class="card-body">
                    <div class="chart">
                      <canvas id="recibosUlt10dias" style="height: 230px; width: 495px;" width="495" height="230"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-6 col-sm-12 mb-4">
              <div class="card card-action card-border-shadow-primary">
                <div class="card-header d-flex justify-content-between">
                  <div class="card-action-title">Envios ultimos 10 días</div>
                  <div class="card-action-element">
                    <ul class="list-inline mb-0">
                      <li class="list-inline-item">
                        <a href="javascript:void(0);" class="card-collapsible"><i class="tf-icons ti ti-chevron-right scaleX-n1-rtl ti-sm"></i></a>
                      </li>
                      <li class="list-inline-item">
                        <a href="javascript:void(0);" class="card-close"><i class="tf-icons ti ti-x ti-sm"></i></a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="collapse show">
                  <div class="card-body">
                    <div class="chart">
                      <canvas id="enviosUlt10dias" style="height: 230px; width: 495px;" width="495" height="230"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

        </div>

      </div>

    <?php
  } else {
    require 'noacceso.php';
  }
  require 'footer.php';
    ?>
    <script type="text/javascript" src="scripts/escritorio.js"></script>
    <script src="../public/dist/js/Chart.min.js"></script>
    <script src="../public/dist/js/Chart.bundle.min.js"></script>
    <script type="text/javascript">
      // Envios ultimos 10 dias
      var ctx = document.getElementById('enviosUlt10dias').getContext('2d');
      var enviosUlt10dias = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: [<?php echo $fechaE; ?>],
          datasets: [{
            label: '# Envios en FCFA de los ultimos 10 dias',
            data: [<?php echo $totalE; ?>],
            backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)'
            ],
            borderColor: [
              'rgba(255, 99, 132, 1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          }
        }
      });

      // Recibos ultimos 10 dias
      var ctx = document.getElementById('recibosUlt10dias').getContext('2d');
      var recibosUlt10dias = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: [<?php echo $fechaR; ?>],
          datasets: [{
            label: '# Recibos en FCFA de los ultimos 10 dias',
            data: [<?php echo $totalR; ?>],
            backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)'
            ],
            borderColor: [
              'rgba(255, 99, 132, 1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          }
        }
      });
    </script>
  <?php
}
ob_end_flush();
?>