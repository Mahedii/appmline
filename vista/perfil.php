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
    <!--INICIO  CONTENIDO -->
    <div class="container-xxl flex-grow-1 container-p-y">


      <h4 class="py-3 mb-4">
        <span>Perfil usuario: <small id="nombre" class="text-muted fw-light"></small></span>
      </h4>

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <div id="listadoregistros">
                <table id="tbllistado" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                  <thead>
                    <tr>
                      <th>Opciones</th>
                      <th>Nombre</th>
                      <th>Login</th>
                      <th>rol</th>
                      <th>Creado por</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    </tr>
                  </tbody>
                  <tfoot>
                    <th>Opciones</th>
                    <th>Nombre</th>
                    <th>Login</th>
                    <th>rol</th>
                    <th>Creado por</th>
                  </tfoot>
                </table>
              </div>
              <div id="formularioregistros">
                <form name="formulario" id="formulario" method="POST">
                  <input type="hidden" name="ap" id="ap">
                  <input type="hidden" name="idempleado" id="idempleado">
                  <div class="row g-3">
                    <div class="col-md-6">
                      <div class="form-password-toggle">
                        <label class="form-label" for="multicol-password">Nueva contraseña *:</label>
                        <div class="input-group input-group-merge">
                          <input type="password" class="form-control rounded-pill" name="nuevaPass" id="nuevaPass" maxlength="20" placeholder="Contraseña nueva" required>
                          <span class="input-group-text cursor-pointer" id="multicol-password2"><i class="ti ti-eye-off"></i></span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-password-toggle">
                        <label class="form-label" for="multicol-confirm-password">Confirmar contraseña *:</label>
                        <div class="input-group input-group-merge">
                          <input type="password" class="form-control rounded-pill" name="nuevaPassConfirma" id="nuevaPassConfirma" maxlength="20" placeholder="Confirmar contraseña" required>
                          <span class="input-group-text cursor-pointer" id="multicol-confirm-password2"><i class="ti ti-eye-off"></i></span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr class="my-4 mx-n4" />
                  <div class="pt-4">
                    <button class="btn btn-success me-sm-3 me-1" onmouseover="" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Cambiar</button>
                    <button class="btn btn-danger btn-label-secondary" onclick="cancelarform()" type="reset"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    <!-- FIN CONTENIDO -->

  <?php
  } else {
    require 'noacceso.php';
  }
  require 'footer.php';
  ?>
  <script type="text/javascript" src="scripts/perfil.js"></script>
<?php
}
ob_end_flush();
?>