<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["ap"])) {
  header("Location: login.html");
} else {
  require 'header.php';
  if ($_SESSION['consultas'] == 1) {
?>
<!-- Content wrapper -->
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

      <!-- <div class="d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row py-3 mb-4">
        <h4 class="mb-sm-0 me-2">Consultas envios de efectivo por fechas y cliente</h4>
      </div> -->

      <div class="row">

        <div class="col-lg-12">
          <div class="card">
            <div class="card-body" style="color:black">
              <div id="listadoregistros" style="padding:0px">
                <div class="row g-3 py-3 mb-2">

                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label>Fecha de inicio</label>
                    <input type="date" class="form-control rounded-pill" name="fecha_inicio" id="fecha_inicio" value="<?php echo date("Y-m-d"); ?>">
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label>Fecha de fin</label>
                    <input type="date" class="form-control rounded-pill" name="fecha_final" id="fecha_final" value="<?php echo date("Y-m-d"); ?>">
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Remitente</label>
                    <select class="select2 form-select rounded-pill" name="DNIremitente" id="DNIremitente" required>
                    </select>
                  </div>

                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <label style="display:block; visibility:hidden">Mostrar</label>
                    <button class="btn rounded-pill  btn-success" onclick="listar()">Mostrar</button>
                  </div>

                </div>

                <table id="tbllistado" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                  <thead>
                    <th></th>
                    <th>Remitente</th>
                    <th>Telefono</th>
                    <th>Monto</th>
                    <th>Comision</th> <!-- <th>Descripcion</th> si es un paquete -->
                    <th>Codigo</th>
                    <th>Agencia Emisora</th>
                    <th>Para</th>
                    <th>Agencia Receptora</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                    <th></th>
                    <th>Remitente</th>
                    <th id="consultas-envios-telefono">Telefono</th>
                    <th id="consultas-envios-monto">Monto</th>
                    <th id="consultas-envios-comision">Comision</th> <!-- <th>Descripcion</th> si es un paquete -->
                    <th>Codigo</th>
                    <th>Agencia Emisora</th>
                    <th>Para</th>
                    <th>Agencia Receptora</th>
                    <th>Fecha</th>
                    <th>Estado</th>
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
  <script type="text/javascript" src="scripts/consultas_envios.js"></script>
<?php
}
ob_end_flush();
?>