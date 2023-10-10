<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["ap"])) {
  header("Location: login.html");
} else {
  require 'header.php';
  if ($_SESSION['envios'] == 1) {
?>
    <!-- Content wrapper -->
    <div class="content-wrapper">
      <div class="container-xxl flex-grow-1 container-p-y">

        <!-- <div class="d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row py-3 mb-4">
          <h4 class="mb-sm-0 me-2">Enviar efectivo</h4>
          <div class="action-btns">
            <button class="create-new btn btn-primary waves-effect waves-light" tabindex="0" type="button"><span><i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Agregar</span></span></button>
          </div>
        </div> -->

        <!-- <div class="card pb-5">
          <div class="card-datatable table-responsive pt-0">
            <table class="datatables-basic table">
              <thead>
                <tr>
                  <th></th>
                  <th></th>
                  <th>id</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Date</th>
                  <th>Salary</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div> -->

        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body" style="color:black">
                <div id="listadoregistros">
                  <table id="tbllistado" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Remitente</th>
                        <th>Telefono</th>
                        <th>Monto</th>
                        <th>Cobrar</th>
                        <th>Comision</th>
                        <th>Codigo</th>
                        <th>Agencia Emisora</th>
                        <th>Para</th>
                        <th>Agencia Receptora</th>
                        <th>Agente</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                      <th></th>
                      <th>Remitente</th>
                      <th>Telefono</th>
                      <th>Monto</th>
                      <th>Cobrar</th>
                      <th>Comision</th>
                      <th>Codigo</th>
                      <th>Agencia Emisora</th>
                      <th>Para</th>
                      <th>Agencia Receptora</th>
                      <th>Agente</th>
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
      <!-- FIN CONTENIDO -->
      <!-- Modal
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Enviar y validar solicitud</h4>
            </div>
            <div class="modal-body">
              <form name="formulariosms" id="formulariosms" method="POST">
                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <label>Mensaje :</label>
                  <input type="hidden" name="idtransaccionsms" id="idtransaccionsms">
                  <input type="hidden" name="monantes" id="monantes">
                  <input type="hidden" name="idsolicitud" id="idsolicitud">
                  <textarea name="mensaje" id="mensaje" class="form-control rounded-pill" placeholder="Mensaje para el administrador" rows="3" maxlength="60" ></textarea>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Descripción:</label>
                    <textarea class="form-control rounded-pill" name="descripcionsms" id="descripcionsms" maxlength="45" rows="3" placeholder="Descripción del problema"></textarea>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button class="btn rounded-pill  btn-primary" type="submit" onclick="smsSolicitudValidacion()" id="btnGuardarsms"><i class="fa fa-envelope"></i> Solicitar</button>
              <button type="button" class="btn rounded-pill  btn-default" data-dismiss="modal">Cerrar</button>
            </div>        
          </div>
        </div>
      </div>  
      Fin modal -->

      <div class="offcanvas offcanvas-end" id="add-new-record">
        <div class="offcanvas-header border-bottom">
          <!-- <h5 class="offcanvas-title" id="exampleModalLabel">New Record</h5> -->
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
          <form class="add-new-record pt-0 row g-2" name="formulario form-add-new-record" id="formulario" method="POST">
            <div class="col-sm-12">
              <label class="form-label">Pais de destino:</label>
              <select class="form-control" name="pais_destino" id="pais_destino" required>
              </select>
            </div>
            <div class="col-sm-12">
              <label class="form-label">Numero DIP Remitente:</label>
              <input type="text" class="form-control rounded-pill" onmouseout="buscarRemitenteRellenarNuevo(this.value)" name="DNIremitente" id="DNIremitente" maxlength="10" minlength="6" placeholder="DNI del remitente" required>
            </div>
            <div class="col-sm-12">
              <label class="form-label">Telefono receptor:</label>
              <input type="text" class="form-control rounded-pill" onmouseout="buscarReceptorRellenarNuevo(this.value)" name="telefonorec" id="telefonorec" minlength="9" maxlength="10" placeholder="Telefono del receptor" required>
            </div>
            <div class="col-sm-12">
              <label class="form-label">Nombre Remitente:<span class="badge bg-success" id="nombreSINO"></span> </label>
              <input type="hidden" name="idtransaccion" id="idtransaccion">
              <input type="hidden" name="idreceptor" id="idreceptor">
              <input type="hidden" name="existeR" id="existeR">
              <input type="hidden" name="existeC" id="existeC">
              <input type="hidden" name="referenciaAc" id="referenciaAc">
              <input type="hidden" name="codigoAc" id="codigoAc">
              <input type="hidden" name="saldo" id="saldo">
              <input type="text" class="form-control rounded-pill" name="nombreremitente" id="nombreremitente" maxlength="100" placeholder="Nombre del remitente" required>
            </div>
            <div class="col-sm-12">
              <label class="form-label" for="basicSalary">Nombre Receptor:<span class="badge bg-success" id="nombreRSINO"></span> </label>
              <input type="text" class="form-control rounded-pill" name="nombrereceptor" id="nombrereceptor" maxlength="100" placeholder="Nombre del receptor" required>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <label>Telefono remitente:</label>
              <input type="text" class="form-control rounded-pill" name="telefonorem" id="telefonorem" maxlength="10" minlength="9" placeholder="Telefono del remitente" required>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <label>Dirección receptor:</label>
              <input type="text" class="form-control rounded-pill" name="dirreceptor" id="dirreceptor" maxlength="45" placeholder="Direccion del receptor" required>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <label>Codigo secreto:</label>
              <input type="number" class="form-control rounded-pill" name="secreto" id="secreto" maxlength="45" placeholder="Codigo secreto" required>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <label>Dirección remitente:</label>
              <input type="text" class="form-control rounded-pill" name="dirremitente" id="dirremitente" maxlength="45" placeholder="Direccion del remitente" required>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <label>Tipo transaccion:</label>
              <select class="form-control rounded-pill" name="pais_destino" id="pais_destino" required>
                <option value="1">Divisas</option>
                <option value="2">Paquete</option>
              </select>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <label>Monto:</label>
              <input onmouseout="comisiones(), traerSaldoActual(), verficarSaldo(this.value)" type="number" class="form-control rounded-pill" name="monto" id="monto" min="2000" max="1000000" maxlength="9" placeholder="Monto de envio">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <label>Comisión envio:</label>
              <input type="text" readonly="" class="form-control rounded-pill" name="comision" id="comision" maxlength="20" placeholder="Comisión de envio">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <label>Comisión caja:</label>
              <input type="text" readonly="" class="form-control rounded-pill" name="comi_remi" id="comi_remi" maxlength="20" placeholder="Comisión de caja" readonly>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <label>IVA:</label>
              <input type="text" readonly="" class="form-control rounded-pill" name="IVA" id="IVA" maxlength="20" placeholder="IVA" readonly>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <label>A COBRAR:</label>
              <input type="text" readonly="" class="form-control rounded-pill" name="aCobrar" id="aCobrar" maxlength="20" placeholder="Cobrar" readonly>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <label>Descripción:</label>
              <input type="text" class="form-control rounded-pill" name="descripcion" id="descripcion" maxlength="45" placeholder="Descripción si es un paquete">
            </div>

            <div class="col-sm-12">
              <button class="btn rounded-pill  btn-success me-sm-3 me-1 waves-effect waves-light" onmouseover="" type="submit" id="btnGuardar"><i class="fa fa-envelope"></i> Enviar</button>
              <button class="btn rounded-pill  btn-danger btn-outline-secondary waves-effect" onclick="cancelarform()" type="reset" data-bs-dismiss="offcanvas"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
            </div>
          </form>

        </div>
      </div>

    <?php
  } else {
    require 'noacceso.php';
  }
  require 'footer.php';
    ?>
    <script type="text/javascript" src="scripts/envios.js"></script>
  <?php
}
ob_end_flush();
  ?>