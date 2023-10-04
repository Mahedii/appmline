<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["ap"])) {
  header("Location: login.html");
} else {
  require 'header.php';
  if ($_SESSION['paises'] == 1) {
?>
    <!-- Content wrapper -->
    <div class="content-wrapper">
      <div class="container-xxl flex-grow-1 container-p-y">

        <div class="d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row py-3 mb-4">
          <h4 class="mb-sm-0 me-2">Registro de paises</h4>
          <div class="action-btns">
            <small>
              <button class="create-new btn btn-primary waves-effect waves-light" tabindex="0" type="button"><span><i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Agregar</span></span></button>
              <button class="btn rounded-pill  btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button>
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
                      <th>Nombre </th>
                      <th>Descripcion</th>
                      <th>Limit envio LOCAL</th>
                      <th>Limit envio INT</th>
                      <th>Moneda</th>
                      <th>IVA</th>
                      <th>% Envio</th>
                      <th>% Recibir</th>
                      <th>% Envio PAQ.</th>
                      <th>% Recibir PAQ.</th>
                      <th>Partner API</th>
                      <th>Creado por</th>
                      <th>Fecha creacion</th>
                      <th>Prefijo tel.</th>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                      <th>Opciones</th>
                      <th>Nombre </th>
                      <th>Descripcion</th>
                      <th>Limit envio LOCAL</th>
                      <th>Limit envio INT</th>
                      <th>Moneda</th>
                      <th>IVA</th>
                      <th>% Envio</th>
                      <th>% Recibir</th>
                      <th>% Envio PAQ.</th>
                      <th>% Recibir PAQ.</th>
                      <th>Partner API</th>
                      <th>Creado por</th>
                      <th>Fecha creacion</th>
                      <th>Prefijo tel.</th>
                    </tfoot>
                  </table>
                </div>

                <div id="formularioregistros">
                  <form name="formulario" id="formulario" method="POST">
                    <div class="row g-3">
                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Nombre pais (*):</label>
                        <input type="hidden" name="idpais" id="idpais">
                        <input type="text" class="form-control rounded-pill" name="nompais" id="nompais" maxlength="45" placeholder="Nombre del pais" required>
                      </div>
                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Descripcion:</label>
                        <input type="text" class="form-control rounded-pill" name="descripcion" id="descripcion" maxlength="50" placeholder="Descripcion del pais" required>
                      </div>
                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Limite envio LOCAL:</label>
                        <input type="text" class="form-control rounded-pill" name="limienviolocal" id="limitenviolocal" maxlength="20" placeholder="Limite envio LOCAL" required>
                      </div>
                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Limite envio INT.:</label>
                        <input type="text" class="form-control rounded-pill" name="limienvioint" id="limitenvioint" maxlength="20" placeholder="Limite envio INTERNACIONAL" required>
                      </div>
                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Moneda (*):</label>
                        <input type="text" class="form-control rounded-pill" name="moneda" id="moneda" maxlength="20" placeholder="Moneda ej: XAF" required>
                      </div>
                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>IVA (*):</label>
                        <input type="text" class="form-control rounded-pill" name="iva" id="iva" maxlength="20" placeholder="IVA" required>
                      </div>
                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>% de Envio (*):</label>
                        <input type="text" class="form-control rounded-pill" name="porcenenvio" id="porcenenvio" maxlength="20" placeholder="Porcentaje de envio" required>
                      </div>
                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>% de recibir (*):</label>
                        <input type="text" class="form-control rounded-pill" name="porcenrecibir" id="porcenrecibir" maxlength="20" placeholder="Porcentqje de recibir" required>
                      </div>
                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>% envio PAQ (*):</label>
                        <input type="text" class="form-control rounded-pill" name="porcenenviopaq" id="porcenenviopaq" maxlength="20" placeholder="Porcentaje de envio de PAQUETE" required>
                      </div>
                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>% recibir PAQ (*):</label>
                        <input type="text" class="form-control rounded-pill" name="porcenrecibirpaq" id="porcenrecibirpaq" maxlength="20" placeholder="Porcentaje de recibir un PAQUETE" required>
                      </div>
                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>Partner API:</label>
                        <input type="text" class="form-control rounded-pill" name="partnerapi" id="partnerapi" maxlength="20" placeholder="Partner API">
                      </div>
                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>Prefijo telefonico(*):</label>
                        <input type="text" class="form-control rounded-pill" name="prefijoTel" id="prefijoTel" maxlength="20" placeholder="Prefijo tel +240" required>
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

        <div class="offcanvas offcanvas-end" id="add-new-record">
          <div class="offcanvas-header border-bottom">
            <!-- <h5 class="offcanvas-title" id="exampleModalLabel">New Record</h5> -->
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body flex-grow-1">
            <form class="add-new-record pt-0 row g-2" name="formulario form-add-new-record" id="formulario" method="POST">
              <div class="row g-3">


                <div class="col-sm-12">
                  <button class="btn rounded-pill  btn-success me-sm-3 me-1 waves-effect waves-light" onmouseenter="verificarMontoCOBRAR()" type="submit" id="btnGuardar"><i class="fa fa-envelope"></i> Retirar ahora</button>
                  <button class="btn rounded-pill  btn-danger btn-outline-secondary waves-effect" onclick="cancelarform()" type="reset" data-bs-dismiss="offcanvas"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
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
    <script type="text/javascript" src="scripts/paises.js"></script>
  <?php
}
ob_end_flush();
  ?>