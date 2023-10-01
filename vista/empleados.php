<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["ap"])) {
  header("Location: login.html");
} else {
  require 'header.php';
  if ($_SESSION['empleados'] == 1) {
?>
    <div class="container-xxl flex-grow-1 container-p-y">

      <div class="sticky-element d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row py-3 mb-4">
        <h4 class="mb-sm-0 me-2">Registro empleados</h4>
        <div class="action-btns">
          <button class="btn rounded-pill  btn-success me-3" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body" style="color:black">
              <div id="listadoregistros">
                <table id="tbllistado" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                  <thead>
                    <th>Ops</th>
                    <th>Nombre</th>
                    <th>DNI</th>
                    <th>Tel</th>
                    <th>Cargo</th>
                    <th>Rol acceso</th>
                    <th>Salario</th>
                    <th>Login</th>
                    <th>Pais de trabajo</th>
                    <th>Ciudad</th>
                    <th>Dirección</th>
                    <th>Interno?</th>
                    <th>Agencia</th>
                    <th>Creado</th>
                    <th>Fecha</th>
                    <th>Fecha reclutado</th>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                    <th>Ops</th>
                    <th>Nombre</th>
                    <th>DNI</th>
                    <th>Tel</th>
                    <th>Cargo</th>
                    <th>Rol acceso</th>
                    <th>Salario</th>
                    <th>Login</th>
                    <th>Pais de trabajo</th>
                    <th>Ciudad</th>
                    <th>Dirección</th>
                    <th>Interno?</th>
                    <th>Agencia</th>
                    <th>Creado</th>
                    <th>Fecha</th>
                    <th>Fecha reclutado</th>
                  </tfoot>
                </table>
              </div>

              <div id="formularioregistros">
                <form name="formulario" id="formulario" method="POST">
                  <div class="row g-3">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <label>Nombre completo (*)</label>
                      <input type="hidden" name="idempleado" id="idempleado">
                      <input type="text" class="form-control rounded-pill" name="nomcompleto" id="nomcompleto" maxlength="55" placeholder="Nombre del empleado" required>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <label>DNI (*):</label>
                      <input onmouseout="validarDIP()" type="number" class="form-control rounded-pill" name="DNIremitente" id="DNIremitente" maxlength="10" placeholder="DNI del empleado" required>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <label>Telefono:</label>
                      <input type="text" class="form-control rounded-pill" name="tel" id="tel" maxlength="22" placeholder="Telefono del empleado">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <label>Funciones:</label>
                      <input type="text" class="form-control rounded-pill" name="cargo" id="cargo" maxlength="22" placeholder="Cargo del empleado">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <label>Salario:</label>
                      <input type="text" class="form-control rounded-pill" name="salario" id="salario" maxlength="12" placeholder="Salario" required>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <label>Rol (Tipo usuario):</label>
                      <select class="select2 form-select rounded-pill" name="rol" id="rol">
                        <option value="Supervisor">Supervisor</option>
                        <option value="Administrador">Administrador</option>
                        <option value="CajeroUV">Cajero UV</option>
                        <option value="Agencia">Agencia M</option>
                        <option value="AgenciaS">Agencia S</option>
                        <option value="Cajero">Cajero</option>
                      </select>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <label>Login acceso:</label>
                      <input onmouseout="validarAP()" type="text" class="form-control rounded-pill" name="ap" id="ap" maxlength="8" placeholder="Login usuario, Ej. ap001531" required>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <label>Pais de trabajo:</label>
                      <select class="select2 form-select rounded-pill" name="pais" id="pais" required>
                      </select>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <label>Ciudad:</label>
                      <input type="text" class="form-control rounded-pill" name="ciudad" id="ciudad" maxlength="45" placeholder="Ciudad que vive">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <label>Dirección:</label>
                      <input type="text" class="form-control rounded-pill" name="direccion" id="direccion" maxlength="45" placeholder="Descripción" required>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <label>Trabaja Interno?:</label>
                      <select class="select2 form-select rounded-pill" name="interno" id="interno">
                        <option value="SI">Interno</option>
                        <option value="NO">Externo</option>
                      </select>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <label>Fecha reclutado:</label>
                      <input type="date" class="form-control rounded-pill" name="feinicioempleo" id="feinicioempleo">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <label>Agencia de trabajo:</label>
                      <select class="select2 form-select rounded-pill" name="agenciaA" id="agenciaA" required>
                      </select>
                    </div>
                  </div>

                  <div class="pt-4">
                    <button class="btn rounded-pill  btn-success me-sm-3 me-1" onmouseenter="validarAP()" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                    <button class="btn rounded-pill  btn-danger btn-label-secondary" onclick="cancelarform()" type="reset"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
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
  <script type="text/javascript" src="scripts/empleados.js"></script>
<?php
}
ob_end_flush();
?>