<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["ap"])) {
  header("Location: login.html");
} else {
  require 'header.php';
  if ($_SESSION['cuentas'] == 1) {
?>
    <!-- Content wrapper -->
    <div class="content-wrapper">
      <div class="container-xxl flex-grow-1 container-p-y">

        <div class="d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row py-3 mb-4">
          <!-- <h4 class="mb-sm-0 me-2">Cuentas</h4> -->
          <div class="action-btns">
            <?php if ($_SESSION['rol'] != 'Agencia' || $_SESSION['rol'] != 'CajeroUV') { ?>
              <small>
                <button class="create-new btn btn-primary waves-effect waves-light" tabindex="0" type="button"><span><i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Agregar</span></span></button>
              </small>
            <?php } ?>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body" style="color:black">
                <div id="listadoregistros">
                  <table id="tbllistado" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                      <th></th>
                      <th>#</th>
                      <th>Nombre cliente</th>
                      <th>Nº DE CUENTA</th>
                      <th>Tipo</th>
                      <th>SALDO</th>
                      <th>AGENCIA MASTER</th>
                      <th>Gestor</th>
                      <th>Pais</th>
                      <th>Telefono</th>
                      <th>Cuenta cerrada</th>
                      <th>Fecha movi</th>
                      <th>Creado por</th>
                      <th>Fecha creación</th>
                      <th>Opciones</th>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                      <th></th>
                      <th>#</th>
                      <th>Nombre cliente</th>
                      <th>Nº DE CUENTA</th>
                      <th>Tipo</th>
                      <th id="saldo">SALDO</th>
                      <th>AGENCIA MASTER</th>
                      <th>Gestor</th>
                      <th>Pais</th>
                      <th>Telefono</th>
                      <th>Estado</th>
                      <th>Fecha movi.</th>
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
                  <label>Nombre cliente o Gerente (*) :</label>
                  <select class="select2 form-select rounded-pill" name="cliente" id="cliente" required>
                  </select>
                  <input type="hidden" name="modif" id="modif">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Tipo de cuenta (*):</label>
                  <select onchange="generarCuentaClienteNCP(value)" class="select2 form-select rounded-pill" name="tipo_cuenta" id="tipo_cuenta">
                    <option value="CUENTA_CORRIENTE">ELIJE TIPO DE CUENTA</option>
                    <option value="CUENTA_CORRIENTE">CUENTA CORRIENTE</option>
                    <option value="CUENTA_AHORRO">CUENTA DE AHORROS</option>
                    <option value="CUENTA_AGENCIA">CUENTA DE AGENCIA</option>
                    <option value="CUENTA_COMISIONES">CUENTA DE COMISIONES</option>
                    <option value="CUENTA_GASTOS">CUENTA DE GASTOS</option>
                    <option value="CUENTA_CAPITAL">CUENTA DE CAPITAL</option>
                    <option value="CUENTA_PERDIDAS">CUENTA DE PERDIDAS</option>
                    <option value="CUENTA_IVA">CUENTA DE IVA</option>
                  </select>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Numero de CUENTA :</label>
                  <input type="text" class="form-control rounded-pill" name="numerocuenta" id="numerocuenta" maxlength="40" placeholder="Numero de cuenta" readonly required>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>SALDO:</label>
                  <input type="text" class="form-control rounded-pill" name="saldo" id="saldo" maxlength="40" placeholder="Saldo de la cuenta" readonly>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Agencia Master Ligada :</label>
                  <select class="select2 form-select rounded-pill" name="agencialigada" id="agencialigada">
                  </select>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Gestor :</label>
                  <select class="select2 form-select rounded-pill" name="gestor" id="gestor">
                  </select>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Cuenta cerrada :</label>
                  <select class="select2 form-select rounded-pill" name="cuenta_cerrada" id="cuenta_cerrada">
                    <option value="NO">NO</option>
                    <option value="SI">SI</option>
                  </select>
                </div>

                <div class="col-sm-12">
                  <?php if ($_SESSION['rol'] != 'Agencia') { // VALIDACION DE ROLES 
                  ?>
                    <button class="btn rounded-pill btn-success me-sm-3 me-1 waves-effect waves-light" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                  <?php  } ?>
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
    <script type="text/javascript" src="scripts/cuentas.js"></script>
  <?php
}
ob_end_flush();
  ?>