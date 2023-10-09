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
    <!-- Content wrapper -->
    <div class="content-wrapper">
      <div class="container-xxl flex-grow-1 container-p-y">

        <div class="d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row py-3 mb-4">
          <h4 class="mb-sm-0 me-2">Crear usuarios y dar permisos</h4>
          <div class="action-btns">
            <small>
              <button class="create-new btn btn-primary waves-effect waves-light" tabindex="0" type="button"><span><i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Agregar</span></span></button>
            </small>
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
                  <input type="hidden" name="idempleado" id="idempleado">
                  <label>Empleado:</label>
                  <select class="select2 form-select rounded-pill" name="ap" id="ap" required>
                  </select>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>AP o Login *:</label>
                  <input type="text" readonly="" class="form-control rounded-pill" name="apU" id="apU" maxlength="20" placeholder="Logion o AP" required>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Clave temporal *:</label>
                  <input type="password" class="form-control rounded-pill" name="password" id="password" maxlength="20" placeholder="Contraseña" required>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Estado:</label>
                  <select class="selectpicker w-100 rounded-pill" data-style="btn-default" name="condicion" id="condicion" required>
                    <option value="1">Activado</option>
                    <option value="2">Desactivado</option>
                  </select>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Permisos:</label>
                  <ul style="list-style: none;" id="permisos">

                  </ul>
                </div>

                <div class="col-sm-12">
                  <button class="btn rounded-pill  btn-success me-sm-3 me-1 waves-effect waves-light" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                  <button class="btn rounded-pill  btn-danger btn-outline-secondary me-sm-3 me-1 waves-effect waves-light" onclick="cancelarform()" type="reset" data-bs-dismiss="offcanvas"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
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
    <script type="text/javascript" src="scripts/usuarios.js"></script>
  <?php
}
ob_end_flush();
  ?>