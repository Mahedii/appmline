<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["ap"])) {
  header("Location: login.html");
} else {
  require 'header.php';
  if ($_SESSION['usuarios'] == 1) {
?>
    <div class="container-xxl flex-grow-1 container-p-y">

      <div class="sticky-element d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row py-3 mb-4">
        <h4 class="mb-sm-0 me-2">Crear usuarios y dar permisos</h4>
        <div class="action-btns">
          <small><button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></small>
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
                    <th>Login</th>
                    <th>Rol</th>
                    <th>Permisos</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Creado por</th>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                    <th>Opciones</th>
                    <th>Nombre</th>
                    <th>Login</th>
                    <th>Rol</th>
                    <th>Permisos</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Creado por</th>
                  </tfoot>
                </table>
              </div>

              <div id="formularioregistros">
                <form name="formulario" id="formulario" method="POST">
                  <div class="row g-3">
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <input type="hidden" name="idempleado" id="idempleado">
                      <label>Empleado:</label>
                      <select class="js-example-basic-single" name="ap" id="ap" required>
                      </select>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>AP o Login *:</label>
                      <input type="text" readonly="" class="form-control" name="apU" id="apU" maxlength="20" placeholder="Logion o AP" required>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Clave temporal *:</label>
                      <input type="password" class="form-control" name="password" id="password" maxlength="20" placeholder="Contraseña" required>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Estado:</label>
                      <select class="form control js-example-basic-single" name="condicion" id="condicion" required>
                        <option value="1">Activado</option>
                        <option value="2">Desactivado</option>
                      </select>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label>Permisos:</label>
                      <ul style="list-style: none;" id="permisos">

                      </ul>
                    </div>
                  </div>

                  <div class="pt-4 mb-3">
                    <button class="btn btn-success" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                    <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
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
  <script type="text/javascript" src="scripts/usuarios.js"></script>
<?php
}
ob_end_flush();
?>