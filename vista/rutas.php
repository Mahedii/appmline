<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["ap"])) {
  header("Location: login.html");
} else {
  require 'header.php';
  if ($_SESSION['rutas'] == 1) {
?>
    <div class="container-xxl flex-grow-1 container-p-y">

      <div class="sticky-element d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row py-3 mb-4">
        <h4 class="mb-sm-0 me-2">Crear rutas</h4>
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
                    <th>Descripción</th>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                    <th>Opciones</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                  </tfoot>
                </table>
              </div>

              <div id="formularioregistros">
                <form name="formulario" id="formulario" method="POST">
                  <div class="row g-3">
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label>Nombre:</label>
                      <input type="hidden" name="idruta" id="idruta">
                      <input type="text" class="form-control" name="nombreR" id="nombreR" maxlength="25" placeholder="Nombre ruta" required>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label>Descripción:</label>
                      <input type="text" class="form-control" name="descripcionr" id="descripcionr" maxlength="30" placeholder="Descripción ruta" required>
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
  <script type="text/javascript" src="scripts/rutas.js"></script>
<?php
}
ob_end_flush();
?>