<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["ap"])) {
  header("Location: login.html");
} else {
  require 'header.php';
  if ($_SESSION['banco_comercial'] == 1) {
?>
    <div class="container-xxl flex-grow-1 container-p-y">

      <div class="sticky-element d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row py-3 mb-4">
        <h4 class="mb-sm-0 me-2">Banco comercial</h4>
        <div class="action-btns">
          <?php if ($_SESSION['rol'] != 'Agencia' || $_SESSION['rol'] != 'CajeroUV') { ?>
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
                    <th>Nombre comercial</th>
                    <th>Pais</th>
                    <th>Ciudad</th>
                    <th>Cuenta CORRIENTE</th>
                    <th>saldo cuenta CORRIENTE</th>
                    <th>Responsable</th>
                    <th>Gerente</th>
                    <th>Creado por</th>
                    <th>Fecha creación</th>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                    <th>Opciones</th>
                    <th>Nombre comercial</th>
                    <th>Pais</th>
                    <th>Ciudad</th>
                    <th>Cuenta CORRIENTE</th>
                    <th>saldo cuenta CORRIENTE</th>
                    <th>Responsable</th>
                    <th>Gerente</th>
                    <th>Creado por</th>
                    <th>Fecha creación</th>
                  </tfoot>
                </table>
              </div>

              <div id="formularioregistros">
                <form name="formulario" id="formulario" method="POST">

                  <div class="pt-4 mb-3">
                    <?php if ($_SESSION['rol'] != 'Administrador') { // VALIDACION DE ROLES 
                    ?>
                      <button onmouseout="generarCuentaBancoComercial()" class="btn btn-success" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                      <button class="btn btn-dark" type="button" id="btnDebitar" onclick="MODALOperarBancoComercial()"> <i class="fa fa-minus-square"></i> <i class="fa fa-reply-all"> </i> C-D UV Comercial <i class="fa fa-plus-square"> </i></button>
                    <?php  } ?>
                    <button class="btn btn-danger btn-label-secondary" onclick="cancelarform()" type="reset"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                  </div>

                  <div class="row g-3">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label>Nombre (*):</label>
                      <input type="hidden" name="idbancoc" id="idbancoc">
                      <input type="text" class="form-control rounded-pill" name="nombre" id="nombre" maxlength="55" placeholder="Nombre banco comercial" required>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label>Pais (*):</label>
                      <select class="js-example-basic-single" name="pais" id="pais" required>
                      </select>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label>Ciudad:</label>
                      <input type="text" class="form-control rounded-pill" name="ciudad" id="ciudad" maxlength="45" placeholder="Ciudad de la agencia">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label>Responsable comercial (*):</label>
                      <select class="js-example-basic-single" name="responsable" id="responsable" onchange="generarCuentaBancoComercial()" required>
                      </select>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label>Gerente supervisor:</label>
                      <select class="js-example-basic-single" name="supervisor" id="supervisor">
                      </select>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <label>Numero de cuenta CORRIENTE(*):</label>
                      <input type="text" class="form-control rounded-pill" name="ncp" id="ncp" maxlength="45" placeholder="Numero de cuenta corriente" required readonly>
                    </div>
                  </div>
                </form>
              </div>
              <!--Fin centro -->

              <!--Modal centro -->
              <div class="modal fade" id="MODALOperarBancoComercial" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title">Operacion en el Banco Comercial</h4>
                    </div>
                    <div class="modal-body">
                      <form name="formularioOperarBancoComercial" id="formularioOperarBancoComercial" method="POST">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                          <label>Nombre SUPERVISOR remitente (*) :</label>
                          <select onchange="ponerNCPclienteRemitente()" class="js-example-basic-single"  name="clienteremitente" id="clienteremitente" required>
                          </select>
                          <input type="hidden" name="idBancoComercialOP" id="idBancoComercialOP">
                          <input type="hidden" name="paisorigen" id="paisorigen">
                          <input type="hidden" name="saldoremitente" id="saldoremitente">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                          <label>Agencia remitente :</label>
                          <select class="js-example-basic-single"  name="agenciaremitente" id="agenciaremitente">
                          </select>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                          <label>Cuenta A DEBITAR remitente(*):</label>
                          <select class="js-example-basic-single"  name="ncpremitente" id="ncpremitente" required>
                          </select>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                          <label>Nombre Comercial beneficiario(*):</label>
                          <select onchange="ponerNCPclienteBeneficiario()" class="js-example-basic-single"  name="clientebeneficiario" id="clientebeneficiario" required>
                          </select>
                          <input type="hidden" name="paisdestino" id="paisdestino">
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                          <label>Agencia Master beneficiaria :</label>
                          <select class="js-example-basic-single"  name="agenciabeneficiaria" id="agenciabeneficiaria" required>
                          </select>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                          <label>Cuenta A CREDITAR beneficiaria (*):</label>
                          <select onchange="traerSaldoActual(this.value)" class="js-example-basic-single"  name="ncpbeneficiaria" id="ncpbeneficiaria" required>
                          </select>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                          <label>Monto (*):</label>
                          <input type="number" class="form-control rounded-pill" name="monto" id="monto" maxlength="10" placeholder="Monto maximo envio">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                          <label>Tipo de operacion (*):</label>
                          <select onchange="" class="js-example-basic-single"  name="tipo" id="tipo">
                            <option value="008">Aprovisionar UV Comercial</option>
                            <option value="009">Restituir UV Comercial</option>
                          </select>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                          <label>Descripción:</label>
                          <textarea class="form-control rounded-pill" name="descripcion" id="descripcion" maxlength="45" rows="2" placeholder="Descripción de la operacion"></textarea>
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button class="btn btn-success" type="submit" onmouseover="verificarNCP()" onclick="debitarCreditarBancoComercial(event)" id="btnGuardarOpeBancoComercial"><i class="fa fa-save"></i> Validar</button>
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
  <script type="text/javascript" src="scripts/banco_comercial.js"></script>
<?php
}
ob_end_flush();
?>