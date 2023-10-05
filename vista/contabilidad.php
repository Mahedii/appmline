<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["ap"])) {
  header("Location: login.html");
} else {
  require 'header.php';
  if ($_SESSION['contabilidad'] == 1) {
?>
    <!-- Content wrapper -->
    <div class="content-wrapper">
      <div class="container-xxl flex-grow-1 container-p-y">

        <div class="d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row py-3 mb-4">
          <h4 class="mb-sm-0 me-2">egistro de la contabilidad</h4>
          <div class="action-btns">
            <small>
              <button class="create-new btn btn-primary waves-effect waves-light" tabindex="0" type="button"><span><i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Agregar</span></span></button>
            </small>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body" style="color:black">
                <div id="listadoregistros">
                  <table id="tbllistado" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                      <th>Concepto</th>
                      <th>Opciones</th>
                      <th>Ingresos</th>
                      <th>Gastos</th>
                      <th>Observación</th>
                      <th>Agencia</th>
                      <th>Creado por</th>
                      <th>Fecha creacion</th>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                      <th>Concepto</th>
                      <th>Opciones</th>
                      <th>Ingresos</th>
                      <th>Gastos</th>
                      <th>Observación</th>
                      <th>Agencia</th>
                      <th>Creado por</th>
                      <th>Fecha creacion</th>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="offcanvas offcanvas-end" id="add-new-record">
          <div class="offcanvas-header border-bottom">
            <!-- <h5 class="offcanvas-title" id="exampleModalLabel">New Record</h5> -->
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body flex-grow-1">
            <form class="add-new-record pt-0 row g-2" name="formulario form-add-new-record" id="formulario" method="POST">
              <div class="row g-3">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Concepto u observacion:</label>
                  <input type="hidden" name="iding_gas" id="iding_gas">
                  <input type="text" class="form-control rounded-pill" name="concepto" id="concepto" maxlength="45" placeholder="Concepto contable" required>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Monto:</label>
                  <input type="number" class="form-control rounded-pill" name="monto" id="monto" maxlength="10" required>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Movimiento:</label>
                  <select class="select2 form-select rounded-pill" name="sentido" id="sentido" required>
                    <option value="C">Ingreso</option>
                    <option value="D">Gasto</option>
                  </select>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Fecha:</label>
                  <input type="date" class="form-control rounded-pill" name="fecrea" id="fecrea" required>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Observación:</label>
                  <input type="text" class="form-control rounded-pill" name="observacion" id="observacion" maxlength="45" placeholder="Observación contable" required>
                </div>

                <div class="col-sm-12">
                  <button class="btn rounded-pill btn-success me-sm-3 me-1 waves-effect waves-light" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                  <button class="btn rounded-pill btn-danger btn-outline-secondary me-sm-3 me-1 waves-effect waves-light" onclick="cancelarform()" type="reset" data-bs-dismiss="offcanvas"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                </div>
            </form>

          </div>
        </div>

      </div>

    <?php
  } else {
    require 'noacceso.php';
  }
  require 'footer.php';
    ?>
    <script type="text/javascript" src="scripts/contabilidad.js"></script>
  <?php
}
ob_end_flush();
  ?>