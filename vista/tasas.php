<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["ap"])) {
  header("Location: login.html");
} else {
  require 'header.php';
  if ($_SESSION['tasas'] == 1) {
?>
    <div class="container-xxl flex-grow-1 container-p-y">

      <div class="sticky-element d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row py-3 mb-4">
        <h4 class="mb-sm-0 me-2">Crear tasas</h4>
        <div class="action-btns">
          <small><button class="btn rounded-pill  btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></small>
        </div>
      </div>


      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body" style="color:black">
              <div id="listadoregistros">
                <table id="tbllistado" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                  <thead>
                    <th>Pais origen</th>
                    <th>Opciones</th>
                    <th>Pais destino</th>
                    <th>Descripción</th>
                    <th>[Monto inicial</th>
                    <th>Monto tope]</th>
                    <th>Monto KILO</th>
                    <th>Monto SOBRE</th>
                    <th>Comisión</th>
                    <th>Fecha</th>
                    <th>Creado por</th>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                    <th>Pais origen</th>
                    <th>Opciones</th>
                    <th>Pais destino</th>
                    <th>Descripción</th>
                    <th>[Monto inicial</th>
                    <th>Monto tope]</th>
                    <th>Monto KILO</th>
                    <th>Monto SOBRE</th>
                    <th>Comisión</th>
                    <th>Fecha</th>
                    <th>Creado por</th>
                  </tfoot>
                </table>
              </div>

              <div id="formularioregistros">
                <form name="formulario" id="formulario" method="POST">

                  <div class="row g-3">
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label>Descripción:</label>
                      <input type="hidden" name="idTasas" id="idTasas">
                      <input type="text" class="form-control rounded-pill" name="Descripcion" id="Descripcion" maxlength="20" placeholder="Descripción Ej. De 60,001 a 12000" required>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label>[Monto inicial*:</label>
                      <input type="text" class="form-control rounded-pill" name="Monto1" id="Monto1" maxlength="20" placeholder="Monto 1" required>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label>Monto tope]*:</label>
                      <input type="text" class="form-control rounded-pill" name="Monto2" id="Monto2" maxlength="20" placeholder="Monto 2" required>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label>Comisión *:</label>
                      <input type="text" class="form-control rounded-pill" name="comisiont" id="comisiont" maxlength="20" placeholder="Comisión por envio" required>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label>Monto por KILO :</label>
                      <input type="text" class="form-control rounded-pill" name="MontoKILO" id="MontoKILO" maxlength="20" placeholder="Monto fijo por KILO" required>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label>Monto por SOBRE :</label>
                      <input type="text" class="form-control rounded-pill" name="MontoSOBRE" id="MontoSOBRE" maxlength="20" placeholder="Monto fijo por SOBRE" required>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label>Pais origen(*):</label>
                      <select class="select2 form-select rounded-pill" name="pais_origen" id="pais_origen" required>
                      </select>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label>Pais destino(*):</label>
                      <select class="select2 form-select rounded-pill" name="pais_destino" id="pais_destino" required>
                      </select>
                    </div>
                  </div>
                  <div class="pt-4 mb-3">
                    <button class="btn rounded-pill  btn-success" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                    <button class="btn rounded-pill  btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
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
  <script type="text/javascript" src="scripts/tasas.js"></script>
<?php
}
ob_end_flush();
?>