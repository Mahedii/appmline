<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["ap"])) {
  header("Location: login.html");
} else {
  require 'header.php';
  if ($_SESSION['operaciones'] == 1) {
?>
<!-- Content wrapper -->
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

      <div class="d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row py-3 mb-4">
        <h4 class="mb-sm-0 me-2">Consultas de operaciones generales</h4>
      </div>

      <div class="row">

        <div class="col-lg-12">
          <div class="card">
            <div class="card-body" style="color:black">
              <div id="listadoregistros" style="padding:0px ">

                <div class="row g-3 py-3 mb-2">
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <label>Fecha de inicio</label>
                    <input type="date" class="form-control rounded-pill" name="fecha_inicio" id="fecha_inicio" value="<?php echo date("Y-m-d"); ?>">
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <label>Fecha de fin</label>
                    <input type="date" class="form-control rounded-pill" name="fecha_final" id="fecha_final" value="<?php echo date("Y-m-d"); ?>">
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <label>Tipo de operacion (*):</label>
                    <select class="select2 form-select rounded-pill" name="codigo_ope" id="codigo_ope">
                      <option value="">TODOS</option>
                      <option value="002">RECARGA UV AGENCIA</option>
                      <option value="003">RESTITUIR UV AGENCIA</option>
                      <option value="007">RETIRO COMISIONES AGENCIA</option>
                      <option value="006">PAGAR COMISIONES AGENCIA</option>
                      <option value="004">RECARGA UV CAJA</option>
                      <option value="005">RESTITUIR UV CAJA</option>
                    </select>
                  </div>

                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <label>Agencia</label>
                    <select class="select2 form-select rounded-pill" name="agencia" id="agencia" required>
                    </select>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <label>Empleado</label>
                    <select class="select2 form-select rounded-pill" name="ap" id="ap" required>
                    </select>
                  </div>

                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <label style="display:block; visibility:hidden">Mostrar</label>
                    <button onclick="listar()" class="btn rounded-pill  btn-success" type="button"><i class="fa fa-search"></i> Mostrar</button>
                  </div>
                </div>

                <table id="tbllistado" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                  <thead>
                    <th>Remitente</th>
                    <th>Cuenta remite</th>
                    <th>Monto</th>
                    <th>Codigo</th>
                    <th>Codigo OPE</th>
                    <th>Fraseo OPE</th>
                    <th>Sentido</th>
                    <th>Descripcion</th>
                    <th>Agencia Emisora</th>
                    <th>Agencia Receptora</th>
                    <th>Beneficia</th>
                    <th>Cuenta beneficia</th>
                    <th>Agente</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                    <th>Remitente</th>
                    <th>Cuenta remite</th>
                    <th>Monto</th>
                    <th>Codigo</th>
                    <th>Codigo OPE</th>
                    <th>Fraseo OPE</th>
                    <th>Sentido</th>
                    <th>Descripcion</th>
                    <th>Agencia Emisora</th>
                    <th>Agencia Receptora</th>
                    <th>Beneficia</th>
                    <th>Cuenta beneficia</th>
                    <th>Agente</th>
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
  <script type="text/javascript" src="scripts/consultas_operaciones.js"></script>
<?php
}
ob_end_flush();
?>