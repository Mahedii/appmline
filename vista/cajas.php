<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["ap"])) {
  header("Location: login.html");
} else {
  require 'header.php';
  if ($_SESSION['cajas'] == 1) {
?>
    <!-- Content wrapper -->
    <div class="content-wrapper">
      <div class="container-xxl flex-grow-1 container-p-y">

        <div class="d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row py-3 mb-4">
          <h4 class="mb-sm-0 me-2">Cajas</h4>
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
                      <th>#</th>
                      <th>Opciones</th>
                      <th>Nombre</th>
                      <th>AGENCIA MASTER</th>
                      <th>Cliente</th>
                      <th>Cajero</th>
                      <th>SALDO CORRIENTE</th>
                      <th>SALDO COMISINES</th>
                      <th>CUENTA CORRIENTE</th>
                      <th>CUENTA COMISINES</th>
                      <th>Monto MAX Envio</th>
                      <th>Cerrada</th>
                      <th>Creado por</th>
                      <th>Fecha creación</th>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                      <th>#</th>
                      <th>Opciones</th>
                      <th>Nombre</th>
                      <th>AGENCIA MASTER</th>
                      <th>Cliente</th>
                      <th>Cajero</th>
                      <th>SALDO CORRIENTE</th>
                      <th>SALDO COMISINES</th>
                      <th>CUENTA CORRIENTE</th>
                      <th>CUENTA COMISINES</th>
                      <th>Monto MAX Envio</th>
                      <th>Cerrada</th>
                      <th>Creado por</th>
                      <th>Fecha creación</th>
                    </tfoot>
                  </table>
                </div>

                <!--Modal centro -->
                <div class="modal fade" id="MODALOperarCaja" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Operacion en la caja</h4>
                      </div>
                      <div class="modal-body">
                        <form name="formularioOperarCaja" id="formularioOperarCaja" method="POST">
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Nombre cliente remitente (*) :</label>
                            <select onchange="ponerNCPclienteRemitente()" class="select2 form-select rounded-pill" name="clienteremitente" id="clienteremitente" required>
                            </select>
                            <input type="hidden" name="idCajaOP" id="idCajaOP">
                            <input type="hidden" name="paisorigen" id="paisorigen">
                            <input type="hidden" name="saldoremitente" id="saldoremitente">
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Agencia Master remitente :</label>
                            <select class="select2 form-select rounded-pill" name="agenciaremitente" id="agenciaremitente">
                            </select>
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Cuenta CORRIENTE remitente (*):</label>
                            <input type="text" class="form-control rounded-pill" name="ncpremitente" id="ncpremitente" maxlength="45" placeholder="Numero de cuenta remitente" required>
                          </div>

                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Nombre cliente beneficiario (*) :</label>
                            <select onchange="ponerNCPclienteBeneficiario()" class="select2 form-select rounded-pill" name="clientebeneficiario" id="clientebeneficiario" required>
                            </select>
                            <input type="hidden" name="paisdestino" id="paisdestino">
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Agencia Master beneficiaria :</label>
                            <select class="select2 form-select rounded-pill" name="agenciabeneficiaria" id="agenciabeneficiaria" required>
                            </select>
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Cuenta CORRIENTE beneficiaria (*):</label>
                            <input type="text" class="form-control rounded-pill" name="ncpbeneficiaria" id="ncpbeneficiaria" maxlength="45" placeholder="Numero de cuenta remitente" required>
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Monto (*):</label>
                            <input type="number" class="form-control rounded-pill" name="monto" id="monto" maxlength="10" placeholder="Monto maximo envio">
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Tipo de operacion (*):</label>
                            <select onchange="" class="select2 form-select rounded-pill" name="tipo" id="tipo">
                              <option value="3">Recarga UV o Saldo</option>
                              <option value="4">Restituir UV o Saldo</option>
                              <option value="5">Retiro comisiones</option>
                              <option value="6">Pagar comisiones</option>
                            </select>
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Descripción:</label>
                            <textarea class="form-control rounded-pill" name="descripcion" id="descripcion" maxlength="45" rows="2" placeholder="Descripción de la operacion"></textarea>
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button class="btn rounded-pill  btn-success" type="submit" onmouseover="verificarNCP()" onclick="debitarCreditarCaja(event)" id="btnGuardarOpeCaja"><i class="fa fa-save"></i> Validar</button>
                        <button type="button" class="btn rounded-pill  btn-default" data-dismiss="modal">Cerrar</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!--Modal centro -->

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
                  <label>Nombre del GERENTE (*) :</label>
                  <select onchange="ponerAgenciaCliente()" class="select2 form-select rounded-pill" name="cliente" id="cliente" required>
                  </select>
                  <input type="hidden" name="idCaja" id="idCaja">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Agencia Master Ligada :</label>
                  <select class="select2 form-select rounded-pill" name="agencia" id="agencia">
                  </select>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Nombre caja (*):</label>
                  <input type="text" class="form-control rounded-pill" name="nombre" id="nombre" maxlength="30" placeholder="Nombre de la caja" required>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Cajero (*):</label>
                  <select onchange="ponerNCPCajero()" class="select2 form-select rounded-pill" name="cajero" id="cajero" required>
                  </select>
                </div>
                <div class="col-sm-12 col-xs-12">
                  <label>Numero cuenta CORRIENTE :</label>
                  <input type="number" class="form-control rounded-pill" name="ncpCorriente" id="ncpCorriente" maxlength="45" placeholder="Numero cuenta corriente">
                </div>
                <div class="col-sm-12 col-xs-12">
                  <label>Numero cuenta COMISIONES:</label>
                  <input type="number" class="form-control rounded-pill" name="ncpComisiones" id="ncpComisiones" maxlength="45" placeholder="Numero de cuenta de comisiones">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Monto maximo envio:</label>
                  <input type="text" class="form-control rounded-pill" name="montoMaxEnvio" id="montoMaxEnvio" maxlength="45" placeholder="Monto maximo envio">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Caja cerrada :</label>
                  <select class="select2 form-select rounded-pill" name="cajacerrada" id="cajacerrada">
                    <option value="NO">NO</option>
                    <option value="SI">SI</option>
                  </select>
                </div>

                <div class="col-sm-12">
                  <?php if ($_SESSION['rol'] != 'Agencia') { // VALIDACION DE ROLES 
                  ?>
                    <button class="btn rounded-pill btn-success me-sm-3 me-1 mt-2 waves-effect waves-light" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                    <button class="btn rounded-pill btn-dark me-sm-3 me-1 mt-2 waves-effect waves-light" type="button" id="btnDebitar" onclick="MODALOperarCaja()"> <i class="fa fa-minus-square"></i> <i class="fa fa-reply-all"> </i> C-D Comisiones Caja <i class="fa fa-plus-square"> </i></button>
                  <?php  } ?>
                  <button class="btn rounded-pill btn-danger btn-outline-secondary me-sm-3 me-1 mt-2 waves-effect waves-light" onclick="cancelarform()" type="reset" data-bs-dismiss="offcanvas"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
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
    <script type="text/javascript" src="scripts/cajas.js"></script>
  <?php
}
ob_end_flush();
  ?>