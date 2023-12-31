<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["ap"])) {
  header("Location: login.html");
} else {
  require 'header.php';
  if ($_SESSION['recibos'] == 1) {
?>

  <div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

      <!-- <div class="d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row py-3 mb-4">
        <h4 class="mb-sm-0 me-2">Retirar efectivo</h4>
        <div class="action-btns">
            <button class="create-new btn btn-primary waves-effect waves-light" tabindex="0" type="button"><span><i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Buscar codigo</span></span></button>
          </div>
      </div> -->

      <div class="offcanvas offcanvas-end" id="add-new-record">
        <div class="offcanvas-header border-bottom">
          <!-- <h5 class="offcanvas-title" id="exampleModalLabel">New Record</h5> -->
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
          <form class="add-new-record pt-0 row g-2" name="formulario form-add-new-record" id="formulario" method="POST">
            <div class="row g-3">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label>Nombre Receptor:</label>
                <input type="hidden" name="idtransaccion" id="idtransaccion">
                <input type="hidden" name="idreceptor" id="idreceptor">
                <input type="hidden" name="idbkhis" id="idbkhis">
                <input type="text" readonly="" class="form-control rounded-pill" name="nombrereceptor" id="nombrereceptor" maxlength="100" placeholder="Nombre del receptor" required>
              </div>
              <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <label>Codigo de envio:</label>
                <input type="text" class="form-control rounded-pill" name="codigo" id="codigo" maxlength="10" placeholder="Buscar codigo" required>
              </div>

              <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <label>Buscar</label>
                <button class="btn rounded-pill btn-info form-control" type="button" onclick="buscarEnvioClas()" id="btnBuscar"><i class="fa fa-search"></i> </button>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <label>Nombre Remitente:</label>
                <input type="text" readonly="" class="form-control rounded-pill" name="nombreremitente" id="nombreremitente" maxlength="100" placeholder="Nombre del remitente" required>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <label>Telefono receptor:</label>
                <input type="text" readonly="" class="form-control rounded-pill" name="telefonorec" id="telefonorec" maxlength="22" placeholder="Telefono del receptor" required>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <label>Telefono remitente:</label>
                <input type="text" readonly="" class="form-control rounded-pill" name="telefonorem" id="telefonorem" maxlength="22" placeholder="Telefono del remitente" required>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label>Dirección receptor:</label>
                <input type="text" readonly="" class="form-control rounded-pill" name="dirreceptor" id="dirreceptor" maxlength="45" placeholder="Direccion del receptor" required>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label>Agencia Emisora:</label>
                <select class="select2 form-select"  name="agenciaA" id="agenciaA" required>
                  <option value="">Select</option>
                </select>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <label>Dirección remitente:</label>
                <input type="text" readonly="" class="form-control rounded-pill" name="dirremitente" id="dirremitente" maxlength="45" placeholder="Direccion del remitente" required>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label>DIP Receptor:</label>
                <input type="text" class="form-control rounded-pill" name="DNIreceptor" id="DNIreceptor" maxlength="10" minlength="6" placeholder="DIP del receptor" required>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label>CODIGO SECRETO:</label>
                <input type="number" onmouseout="verificarCodigoSECRETO()" class="form-control rounded-pill" name="secreto" id="secreto" maxlength="10" placeholder="CODIGO SECRETO" required>
                <input type="hidden" class="form-control rounded-pill" name="DNIremitente" id="DNIremitente">
                <input type="hidden" class="form-control rounded-pill" name="secretoOK" id="secretoOK">
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label>Tipo transaccion:</label>
                <select readonly="" class="select2 form-select rounded-pill" name="tipo" id="tipo" required>
                  <option value="1">Divisas</option>
                  <option value="2">Paquete</option>
                </select>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label>Monto:</label>
                <input type="number" readonly="" class="form-control rounded-pill" name="monto" id="monto" maxlength="20" required>
                <input type="hidden" class="form-control rounded-pill" name="comision" id="comision">
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label>COBRAR:</label>
                <input type="number" onmouseout="verificarMontoCOBRAR()" class="form-control rounded-pill" name="cobrar" id="cobrar" maxlength="20" required>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label>Comisión caja:</label>
                <input type="number" readonly="" class="form-control rounded-pill" name="comi_benef" id="comi_benef" maxlength="20" required>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label>Descripción:</label>
                <input type="text" readonly="" class="form-control rounded-pill" name="descripcion" id="descripcion" maxlength="45" placeholder="Descripción del paquete">
              </div>
            </div>

            <div class="col-sm-12">
              <button class="btn rounded-pill  btn-success me-sm-3 me-1 waves-effect waves-light" onmouseenter="verificarMontoCOBRAR()" type="submit" id="btnGuardar"><i class="fa fa-envelope"></i> Retirar ahora</button>
              <button class="btn rounded-pill  btn-danger btn-outline-secondary waves-effect" onclick="cancelarform()" type="reset" data-bs-dismiss="offcanvas"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
            </div>
          </form>

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
                    <th>Receptor</th>
                    <th>Telefono</th>
                    <th>Monto</th>
                    <th>Cobrar</th>
                    <th>Codigo</th>
                    <th>Agencia Receptora</th>
                    <th>Remitente</th>
                    <th>Agencia Emisora</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                    <th></th>
                    <th>Receptor</th>
                    <th>Telefono</th>
                    <th id="recibos-monto">Monto</th>
                    <th id="recibos-cobrar">Cobrar</th>
                    <th>Codigo</th>
                    <th>Agencia Receptora</th>
                    <th>Remitente</th>
                    <th>Agencia Emisora</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Opciones</th>
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
  <script type="text/javascript" src="scripts/recibos.js"></script>
<?php
}
ob_end_flush();
?>