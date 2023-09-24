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


    <div class="container-xxl flex-grow-1 container-p-y">

      <div class="sticky-element d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row py-3 mb-4">
        <h4 class="mb-sm-0 me-2"><i class="fa fa-bank"> </i> Banco</h4>
        <div class="action-btns">
          <?php if ($_SESSION['rol'] != 'Agencia' || $_SESSION['rol'] != 'CajeroUV' || $_SESSION['rol'] != 'Administrador') { ?>
            <small><button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></small>
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

              <div id="formularioregistros">
                <form name="formulario" id="formulario" method="POST">
                  <div class="pt-4 mb-3">
                    <?php if ($_SESSION['rol'] != 'Administrador' || $_SESSION['rol'] != 'Agencia' || $_SESSION['rol'] != 'Cajero') { // VALIDACION DE ROLES 
                    ?>
                      <button class="btn btn-success me-sm-3 me-1" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                      <button class="btn btn-dark" type="button" id="btnDebitar" onclick="MODALOperarBanco(), traerSaldoActual()"> <i class="fa fa-minus-square"></i> </i> Crear UV o Capital <i class="fa fa-plus-square"> </i></button>
                    <?php  } ?>
                    <button class="btn btn-danger btn-label-secondary" onclick="cancelarform()" type="reset"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                  </div>
                  <div class="row g-3">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label>Nombre (*):</label>
                      <input type="hidden" name="idbanco" id="idbanco">
                      <input type="text" class="form-control" name="nombre" id="nombre" maxlength="55" placeholder="Nombre agencia" required>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label>Descripción:</label>
                      <input type="text" class="form-control" name="descripcion" id="descripcion" maxlength="45" placeholder="Descripción agencia" required>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label>Pais (*):</label>
                      <select class="js-example-basic-single" name="pais" id="pais" required>
                      </select>
                    </div>
                    <div class="col-lg-6 col-6 md-6 col-sm-6 col-xs-12">
                      <label>Maximo de agencias:</label>
                      <input type="text" class="form-control" name="max_agencias" id="max_agencias" maxlength="45" placeholder="Maximo de agencias" required>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <label>Responsable (*):</label>
                      <select class="js-example-basic-single" name="responsable" id="responsable" onchange="generarNCPCreaBanco(value)" required>
                      </select>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <label>Numero de cuenta CAPITAL:</label>
                      <input type="text" class="form-control" name="ncp" id="ncp" maxlength="45" placeholder="Numero de cuenta capital" required readonly>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <label>Numero de cuenta COMISIONES:</label>
                      <input type="text" class="form-control" name="ncpComisiones" id="ncpComisiones" maxlength="45" placeholder="Numero de cuenta comisiones" required readonly>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <label>Numero de cuenta IVA:</label>
                      <input type="text" class="form-control" name="ncpIVA" id="ncpIVA" maxlength="45" placeholder="Numero de cuenta iva" required readonly>
                    </div>
                  </div>

                </form>
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
                          <input readonly="" type="text" class="form-control" name="ncpCREDITAR" id="ncpCREDITAR" maxlength="45" placeholder="Cuenta del capital">
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                          <label>Nombre Banco :</label>
                          <input readonly="" type="text" class="form-control" name="banco" id="banco" maxlength="45" placeholder="Banco">

                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                          <label>Monto (*):</label>
                          <input type="number" class="form-control" name="monto" id="monto" maxlength="10" placeholder="Monto añadir">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                          <label>Tipo de operacion (*):</label>
                          <select class="js-example-basic-single selectpicker" data-live-search="true" name="tipo" id="tipo">
                            <option value="000">Crear UV o Saldo CAPITAL</option>
                          </select>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                          <label>Descripción:</label>
                          <textarea class="form-control" name="descripcion" id="descripcion" maxlength="45" rows="2" placeholder="Descripción de la operacion"></textarea>
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button class="btn btn-success" type="submit" onclick="CrearSaldoUV(event)" id="btnGuardarOpeBanco"><i class="fa fa-save"></i> Validar</button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                  </div>
                </div>
              </div>
              <!--Modal centro -->

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
  <script type="text/javascript" src="scripts/banco.js"></script>
<?php
}
ob_end_flush();
?>