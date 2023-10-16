<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["ap"])) {
  header("Location: login.html");
} else {
  require 'header.php';
  if ($_SESSION['acceso'] == 1) {
?>
    <!-- Content wrapper -->
    <div class="content-wrapper">
      <div class="container-xxl flex-grow-1 container-p-y">

        <!-- <div class="d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row py-3 mb-4">
          <h4 class="mb-sm-0 me-2">Permiso</h4>
        </div> -->

        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body" style="color:black">
                <div id="listadoregistros">
                  <table id="tbllistado" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                      <th>Nombre</th>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                      <th>Nombre</th>
                    </tfoot>
                  </table>
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
    <script type="text/javascript" src="scripts/permiso.js"></script>
  <?php
}
ob_end_flush();
  ?>