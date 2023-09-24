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
    <div class="container-xxl flex-grow-1 container-p-y">

      <div class="sticky-element d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row py-3 mb-4">
        <h4 class="mb-sm-0 me-2">Clientes</h4>
        <div class="action-btns">
          <button class="btn btn-success me-3" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button>
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
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                    <th>#</th>
                    <th>Opciones</th>
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
                  </tfoot>
                </table>
              </div>

              <div id="formularioregistros">
                <form name="formulario" id="formulario" method="POST">
                  <div class="row g-3">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <label>Nombre completo(*):</label>
                      <input type="hidden" name="modif" id="modif">
                      <input type="text" class="form-control" name="nomcompleto" id="nomcompleto" maxlength="50" placeholder="Nombre completpo" required>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <label>DNI (*):</label>
                      <input type="text" class="form-control" onmousemove="generarCuentaCliente(value)" onkeypress="generarCuentaCliente(value)" onmouseleave="generarCuentaCliente(value)" name="DNIremitente" id="DNIremitente" maxlength="10" placeholder="DNI del cliente" required>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <label>Telefono (*):</label>
                      <input type="text" class="form-control" name="tel" id="tel" maxlength="22" placeholder="Telefono del cliente">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <label>Pais (*):</label>
                      <select class="js-example-basic-single" name="pais" id="pais" required>
                      </select>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <label>Direccion:</label>
                      <input type="text" class="form-control" name="direccion" id="direccion" maxlength="80" placeholder="Direccion del cliente">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <label>Agencia :</label>
                      <select class="js-example-basic-single" name="agencia_cli" id="agencia_cli" required>
                      </select>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <label>Numero cuenta CORRIENTE:</label>
                      <input type="text" class="form-control" name="ncp" id="ncp" maxlength="40" placeholder="Numero de cuenta">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <label>Estado:</label>
                      <select class="js-example-basic-single" name="estado" id="estado">
                        <option value="1">Activo</option>
                        <option value="2">Suspendido</option>
                      </select>
                    </div>

                  </div>
                  <div class="pt-4 mb-3">
                    <button class="btn btn-success" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                    <button class="btn btn-danger btn-label-secondary" onclick="cancelarform()" type="reset"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
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
  <script type="text/javascript" src="scripts/clientes.js"></script>
<?php
}
ob_end_flush();
?>