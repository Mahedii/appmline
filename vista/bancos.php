<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["ap"])) {
  header("Location: login.html");
} else {
  require 'header.php';
  if ($_SESSION['banco'] == 1) {
?>


    <!-- Content wrapper -->
    <div class="content-wrapper">
      <div class="container-xxl flex-grow-1 container-p-y">

        <div class="d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row py-3 mb-4">
          <h4 class="mb-sm-0 me-2"><i class="fa fa-bank"> </i> Banco</h4>
          <div class="action-btns">
            <?php if ($_SESSION['rol'] != 'Agencia' || $_SESSION['rol'] != 'CajeroUV' || $_SESSION['rol'] != 'Administrador') { ?>
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
                      <th>Opciones</th>
                      <th>Nombre</th>
                      <th>Descripción</th>
                      <th>Pais</th>
                      <th>Cuenta CAPITAL</th>
                      <th>saldo cuenta CAPITAL</th>
                      <th>Cuenta COMISIONES</th>
                      <th>Saldo cuenta COMISIONES</th>
                      <th>Cuenta IVA</th>
                      <th>Saldo cuenta IVA</th>
                      <th>Responsable</th>
                      <th>Creado por</th>
                      <th>Fecha creación</th>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                      <th>Opciones</th>
                      <th>Nombre</th>
                      <th>Descripción</th>
                      <th>Pais</th>
                      <th>Cuenta CAPITAL</th>
                      <th>saldo cuenta CAPITAL</th>
                      <th>Cuenta COMISIONES</th>
                      <th>Saldo cuenta COMISIONES</th>
                      <th>Cuenta IVA</th>
                      <th>Saldo cuenta IVA</th>
                      <th>Responsable</th>
                      <th>Creado por</th>
                      <th>Fecha creación</th>
                    </tfoot>
                  </table>
                </div>

                <!--Modal centro -->
                <div class="modal fade" id="MODALOperarBanco" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Operacion en el Banco CREACION UV</h4>
                      </div>
                      <div class="modal-body">
                        <form name="formularioOperarBanco" id="formularioOperarBanco" method="POST">
                          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Nombre cliente beneficiario (*) :</label>
                            <select readonly class="js-example-basic-single selectpicker" data-live-search="true" name="nombreBeneficiario" id="nombreBeneficiario" required>
                            </select>
                            <input type="hidden" name="idbancoOP" id="idbancoOP">
                            <input type="hidden" name="paisorigen" id="paisorigen">
                            <input type="hidden" name="saldoCapital" id="saldoCapital">
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Cuenta de CAPITAL A CREDITAR (*):</label>
                            <input readonly="" type="text" class="form-control rounded-pill" name="ncpCREDITAR" id="ncpCREDITAR" maxlength="45" placeholder="Cuenta del capital">
                          </div>

                          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Nombre Banco :</label>
                            <input readonly="" type="text" class="form-control rounded-pill" name="banco" id="banco" maxlength="45" placeholder="Banco">

                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Monto (*):</label>
                            <input type="number" class="form-control rounded-pill" name="monto" id="monto" maxlength="10" placeholder="Monto añadir">
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Tipo de operacion (*):</label>
                            <select class="js-example-basic-single selectpicker" data-live-search="true" name="tipo" id="tipo">
                              <option value="000">Crear UV o Saldo CAPITAL</option>
                            </select>
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Descripción:</label>
                            <textarea class="form-control rounded-pill" name="descripcion" id="descripcion" maxlength="45" rows="2" placeholder="Descripción de la operacion"></textarea>
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button class="btn rounded-pill  btn-success" type="submit" onclick="CrearSaldoUV(event)" id="btnGuardarOpeBanco"><i class="fa fa-save"></i> Validar</button>
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
                  <label>Nombre (*):</label>
                  <input type="hidden" name="idbanco" id="idbanco">
                  <input type="text" class="form-control rounded-pill" name="nombre" id="nombre" maxlength="55" placeholder="Nombre agencia" required>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Descripción:</label>
                  <input type="text" class="form-control rounded-pill" name="descripcion" id="descripcion" maxlength="45" placeholder="Descripción agencia" required>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Pais (*):</label>
                  <select class="select2 form-select rounded-pill" name="pais" id="pais" required>
                  </select>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Maximo de agencias:</label>
                  <input type="text" class="form-control rounded-pill" name="max_agencias" id="max_agencias" maxlength="45" placeholder="Maximo de agencias" required>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Responsable (*):</label>
                  <select class="select2 form-select rounded-pill" name="responsable" id="responsable" onchange="generarNCPCreaBanco(value)" required>
                  </select>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Numero de cuenta CAPITAL:</label>
                  <input type="text" class="form-control rounded-pill" name="ncp" id="ncp" maxlength="45" placeholder="Numero de cuenta capital" required readonly>
                </div>
                <div class="col-sm-12 col-xs-12">
                  <label>Numero de cuenta COMISIONES:</label>
                  <input type="text" class="form-control rounded-pill" name="ncpComisiones" id="ncpComisiones" maxlength="45" placeholder="Numero de cuenta comisiones" required readonly>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Numero de cuenta IVA:</label>
                  <input type="text" class="form-control rounded-pill" name="ncpIVA" id="ncpIVA" maxlength="45" placeholder="Numero de cuenta iva" required readonly>
                </div>

                <div class="col-sm-12">
                  <?php if ($_SESSION['rol'] != 'Administrador' || $_SESSION['rol'] != 'Agencia' || $_SESSION['rol'] != 'Cajero') { // VALIDACION DE ROLES 
                  ?>
                    <button class="btn rounded-pill btn-success me-sm-3 me-1 mt-2 waves-effect waves-light" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                    <button class="btn rounded-pill btn-dark me-sm-3 me-1 mt-2 waves-effect waves-light" type="button" id="btnDebitar" onclick="MODALOperarBanco(), traerSaldoActual()"> <i class="fa fa-minus-square"></i> </i> Crear UV o Capital <i class="fa fa-plus-square"> </i></button>
                  <?php  } ?>
                  <button class="btn rounded-pill btn-danger btn-outline-secondary me-sm-3 me-1 mt-2 waves-effect" onclick="cancelarform()" type="reset" data-bs-dismiss="offcanvas"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
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
    <script type="text/javascript" src="scripts/banco.js"></script>
  <?php
}
ob_end_flush();
  ?>