<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["ap"])) {
  header("Location: login.html");
} else {
  require 'header.php';
  if ($_SESSION['clientes'] == 1) {
?>
    <!-- Content wrapper -->
    <div class="content-wrapper">
      <div class="container-xxl flex-grow-1 container-p-y">

        <!-- <div class="d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row py-3 mb-4">
          <h4 class="mb-sm-0 me-2">Clientes</h4>
          <div class="action-btns">
            <button class="create-new btn btn-primary waves-effect waves-light" tabindex="0" type="button"><span><i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Agregar</span></span></button>
          </div>
        </div> -->

        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body" style="color:black">
                <div id="listadoregistros">
                  <table id="tbllistado" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                      <th></th>
                      <th>#</th>
                      <th>Nombre completo</th>
                      <th>DNI</th>
                      <th>CUENTA CORRIENTE</th>
                      <th>SALDO</th>
                      <th>Telefono</th>
                      <th>Pais</th>
                      <th>Agencia</th>
                      <th>Direccion</th>
                      <th>Estado</th>
                      <th>Creado por</th>
                      <th>Fecha creación</th>
                      <th>Opciones</th>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                      <th></th>
                      <th>#</th>
                      <th>Nombre completo</th>
                      <th>DNI</th>
                      <th>CUENTA CORRIENTE</th>
                      <th id="clientes-salado">SALDO</th>
                      <th>Telefono</th>
                      <th>Pais</th>
                      <th>Agencia</th>
                      <th>Direccion</th>
                      <th>Estado</th>
                      <th>Creado por</th>
                      <th>Fecha creación</th>
                      <th>Opciones</th>
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
                  <label>Nombre completo(*):</label>
                  <input type="hidden" name="modif" id="modif">
                  <input type="text" class="form-control rounded-pill" name="nomcompleto" id="nomcompleto" maxlength="50" placeholder="Nombre completpo" required>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>DNI (*):</label>
                  <input type="text" class="form-control rounded-pill" onmousemove="generarCuentaCliente(value)" onkeypress="generarCuentaCliente(value)" onmouseleave="generarCuentaCliente(value)" name="DNIremitente" id="DNIremitente" maxlength="10" placeholder="DNI del cliente" required>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Telefono (*):</label>
                  <input type="text" class="form-control rounded-pill" name="tel" id="tel" maxlength="22" placeholder="Telefono del cliente">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Pais (*):</label>
                  <select class="select2 form-select rounded-pill" name="pais" id="pais" required>
                  </select>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Direccion:</label>
                  <input type="text" class="form-control rounded-pill" name="direccion" id="direccion" maxlength="80" placeholder="Direccion del cliente">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Agencia :</label>
                  <select class="select2 form-select rounded-pill" name="agencia_cli" id="agencia_cli" required>
                  </select>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Numero cuenta CORRIENTE:</label>
                  <input type="text" class="form-control rounded-pill" name="ncp" id="ncp" maxlength="40" placeholder="Numero de cuenta">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Estado:</label>
                  <select class="select2 form-select rounded-pill" name="estado" id="estado">
                    <option value="1">Activo</option>
                    <option value="2">Suspendido</option>
                  </select>
                </div>

                <div class="col-sm-12">
                  <button class="btn rounded-pill  btn-success me-sm-3 me-1 waves-effect waves-light" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                  <button class="btn rounded-pill  btn-danger btn-outline-secondary me-sm-3 me-1 waves-effect waves-light" onclick="cancelarform()" type="reset" data-bs-dismiss="offcanvas"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
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
    <script type="text/javascript" src="scripts/clientes.js"></script>
  <?php
}
ob_end_flush();
  ?>