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
    <div class="container-xxl flex-grow-1 container-p-y">

      <div class="sticky-element d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row py-3 mb-4">
        <h4 class="mb-sm-0 me-2">Cuentas</h4>
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
                    <th>#</th>
                    <th>Opciones</th>
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
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                    <th>#</th>
                    <th>Opciones</th>
                    <th>Nombre cliente</th>
                    <th>Nº DE CUENTA</th>
                    <th>Tipo</th>
                    <th>SALDO</th>
                    <th>AGENCIA MASTER</th>
                    <th>Gestor</th>
                    <th>Pais</th>
                    <th>Telefono</th>
                    <th>Estado</th>
                    <th>Fecha movi.</th>
                    <th>Creado por</th>
                    <th>Fecha creación</th>
                  </tfoot>
                </table>
              </div>

              <div id="formularioregistros">
                <form name="formulario" id="formulario" method="POST">
                  <div class="pt-4 mb-3">
                    <?php if ($_SESSION['rol'] != 'Agencia') { // VALIDACION DE ROLES 
                    ?>
                      <button class="btn btn-success" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                    <?php  } ?>
                    <button class="btn btn-danger btn-label-secondary" onclick="cancelarform()" type="reset"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                  </div>

                  <div class="row g-3">

                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <label>Nombre cliente o Gerente (*) :</label>
                      <select class="js-example-basic-single" name="cliente" id="cliente" required>
                      </select>
                      <input type="hidden" name="modif" id="modif">
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <label>Tipo de cuenta (*):</label>
                      <select onchange="generarCuentaClienteNCP(value)" class="js-example-basic-single" name="tipo_cuenta" id="tipo_cuenta">
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
                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <label>Numero de CUENTA :</label>
                      <input type="text" class="form-control" name="numerocuenta" id="numerocuenta" maxlength="40" placeholder="Numero de cuenta" readonly required>
                    </div>
                    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <label>SALDO:</label>
                      <input type="text" class="form-control" name="saldo" id="saldo" maxlength="40" placeholder="Saldo de la cuenta" readonly>
                    </div>
                    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <label>Agencia Master Ligada :</label>
                      <select class="js-example-basic-single" name="agencialigada" id="agencialigada">
                      </select>
                    </div>
                    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <label>Gestor :</label>
                      <select class="js-example-basic-single" name="gestor" id="gestor">
                      </select>
                    </div>
                    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <label>Cuenta cerrada :</label>
                      <select class="js-example-basic-single" name="cuenta_cerrada" id="cuenta_cerrada">
                        <option value="NO">NO</option>
                        <option value="SI">SI</option>
                      </select>
                    </div>
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
  <script type="text/javascript" src="scripts/cuentas.js"></script>
<?php
}
ob_end_flush();
?>