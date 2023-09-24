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
    <div class="container-xxl flex-grow-1 container-p-y">

      <div class="sticky-element d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row py-3 mb-4">
        <h4 class="mb-sm-0 me-2">egistro de la contabilidad</h4>
        <div class="action-btns">
          <small><button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></small>
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

              <div id="formularioregistros">
                <form name="formulario" id="formulario" method="POST">
                  <div class="row g-3">
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label>Concepto u observacion:</label>
                      <input type="hidden" name="iding_gas" id="iding_gas">
                      <input type="text" class="form-control" name="concepto" id="concepto" maxlength="45" placeholder="Concepto contable" required>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Monto:</label>
                      <input type="number" class="form-control" name="monto" id="monto" maxlength="10" required>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Movimiento:</label>
                      <select class="js-example-basic-single" name="sentido" id="sentido" required>
                        <option value="C">Ingreso</option>
                        <option value="D">Gasto</option>
                      </select>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Fecha:</label>
                      <input type="date" class="form-control" name="fecrea" id="fecrea" required>
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <label>Observación:</label>
                      <input type="text" class="form-control" name="observacion" id="observacion" maxlength="45" placeholder="Observación contable" required>
                    </div>
                  </div>

                  <div class="pt-4 mb-3">
                    <button class="btn btn-success" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                    <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                  </div>
                </form>
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
  <script type="text/javascript" src="scripts/contabilidad.js"></script>
<?php
}
ob_end_flush();
?>