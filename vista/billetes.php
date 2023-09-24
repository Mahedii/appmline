<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["ap"])) {
  header("Location: login.html");
} else {
  require 'header.php';
  if ($_SESSION['billetes'] == 1) {
?>
    <div class="container-xxl flex-grow-1 container-p-y">

      <div class="sticky-element d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row py-3 mb-4">
        <h4 class="mb-sm-0 me-2">Registro billetes</h4>
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
                    <th>Nombre pasajero</th>
                    <th>Compañía</th>
                    <th>Ruta</th>
                    <th>Nº vuelo</th>
                    <th>Fecha salida</th>
                    <th>Fecha vuelta</th>
                    <th>Localizador</th>
                    <th>Precio</th>
                    <th>Descripción</th>
                    <th>Agencia</th>
                    <th>Creado por</th>
                    <th>Fecha emisión</th>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                    <th>Opciones</th>
                    <th>Nombre pasajero</th>
                    <th>Compañía</th>
                    <th>Ruta</th>
                    <th>Nº vuelo</th>
                    <th>Fecha salida</th>
                    <th>Fecha vuelta</th>
                    <th>Localizador</th>
                    <th>Precio</th>
                    <th>Descripción</th>
                    <th>Agencia</th>
                    <th>Creado por</th>
                    <th>Fecha emisión</th>
                  </tfoot>
                </table>
              </div>

              <div id="formularioregistros">
                <form name="formulario" id="formulario" method="POST">
                  <div class="row g-3">
                    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <label>Nombre pasajero:</label>
                      <input type="hidden" name="idbillete" id="idbillete">
                      <input type="text" class="form-control" name="nompasa" id="nompasa" maxlength="45" placeholder="Nombre del pasajero" required>
                    </div>
                    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <label>DOC. Pasajero:</label>
                      <input type="text" class="form-control" name="DNIremitente" id="DNIremitente" maxlength="10" placeholder="Documento del pasajero" required>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Compañía:</label>
                      <input type="text" class="form-control" name="company" id="company" maxlength="20" placeholder="Nombre compañia" required>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Ruta:</label>
                      <select class="js-example-basic-single" name="ruta" id="ruta" required>
                      </select>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Nº Vuelo:</label>
                      <input type="text" class="form-control" name="numvuel" id="numvuel" maxlength="10" placeholder="Numero del vuelo" required>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Fecha emision:</label>
                      <input type="date" class="form-control" name="fechaemision" id="fechaemision" placeholder="Fecha de emisión" required>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Fecha salida:</label>
                      <input type="date" class="form-control" name="fesali" id="fesali" placeholder="Fecha de salida" required>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Fecha vuelta:</label>
                      <input type="date" class="form-control" name="fevuel" id="fevuel" placeholder="Fecha vuelta" required>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Localizador:</label>
                      <input type="text" class="form-control" name="localiz" id="localiz" maxlength="22" placeholder="Localizador" required>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Precio:</label>
                      <input type="text" class="form-control" name="precio" id="precio" maxlength="10" placeholder="Precio del billete" required>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Agencia:</label>
                      <select class="js-example-basic-single" name="agencia" id="agencia" required>
                      </select>
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <label>Descripción:</label>
                      <input type="text" class="form-control" name="descripcion" id="descripcion" maxlength="45" placeholder="Descripción" required>
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
  <script type="text/javascript" src="scripts/billetes.js"></script>
<?php
}
ob_end_flush();
?>