<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["ap"])) {
  header("Location: login.html");
} else {
  require 'header.php';
  if ($_SESSION['solicitudes'] == 1) {
?>
    <div class="container-xxl flex-grow-1 container-p-y">

      <div class="sticky-element d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row py-3 mb-4">
        <h4 class="mb-sm-0 me-2">Validar o cancelar solicitudes</h4>

      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body" style="color:black">

              <div id="listadoregistros">
                <table id="tbllistado" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                  <thead>
                    <th>Op.</th>
                    <th>Cod.</th>
                    <th>Remitente</th>
                    <th>Receptor</th>
                    <th>Monto</th>
                    <th>Descripcion</th>
                    <th>Operacion</th>
                    <th>Creado por</th>
                    <th>Fecha solicitud</th>
                    <th>Fecha validación</th>
                    <th>Estado</th>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                    <th>Op.</th>
                    <th>Cod.</th>
                    <th>Remitente</th>
                    <th>Receptor</th>
                    <th>Monto</th>
                    <th>Descripcion</th>
                    <th>Operacion</th>
                    <th>Creado por</th>
                    <th>Fecha solicitud</th>
                    <th>Fecha validación</th>
                    <th>Estado</th>
                  </tfoot>
                </table>
              </div>

              <div id="formularioregistros">

                <?php

                //Incluímos la clase Venta
                //require_once "../modelos/class_Solicitud.php";
                //Instanaciamos a la clase con el objeto venta
                //$verOr = new Solicitud();
                //En el objeto $rspta Obtenemos los valores devueltos del método mostrar del modelo

                // $rspta=$consulta->mostrar($idtransaccion);
                //Codificar el resultado utilizando json
                //echo json_encode($rspta);

                ?>
                <form name="formulario" id="formulario" method="POST">
                  <table class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                      <th>Original</th>
                      <th>Campos</th>
                      <th>Cambios</th>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <div class="btn-group-vertical">
                            <button class="btn rounded-pill  btn-danger" type="button" id="DNIremitente"></button>
                            <button class="btn rounded-pill  btn-danger" type="button" id="nomcompletoc"></button>
                            <button class="btn rounded-pill  btn-danger" type="button" id="telc"></button>
                            <button class="btn rounded-pill  btn-danger" type="button" id="direccionc"></button>
                            <button class="btn rounded-pill  btn-danger" type="button" id="DNIreceptor"></button>
                            <button class="btn rounded-pill  btn-danger" type="button" id="nomcompler"></button>
                            <button class="btn rounded-pill  btn-danger" type="button" id="telr"></button>
                            <button class="btn rounded-pill  btn-danger" type="button" id="direccionr"></button>
                            <button class="btn rounded-pill  btn-danger" type="button" id="ageenvia"></button>
                            <input type="hidden" name="ageenviaR" id="ageenviaR">
                            <input type="hidden" name="idreceptorh" id="idreceptorh">
                            <button class="btn rounded-pill  btn-danger" type="button" id="agerecibe"></button>
                            <input type="hidden" name="agerecibeR" id="agerecibeR">
                            <button class="btn rounded-pill  btn-danger" type="button" id="tipo"></button>
                            <input type="hidden" name="tipoR" id="tipoR">
                            <button class="btn rounded-pill  btn-danger" type="button" id="monto"></button>
                            <button class="btn rounded-pill  btn-danger" type="button" id="comision"></button>
                            <button class="btn rounded-pill  btn-danger" type="button" id="codigo"></button>
                            <button class="btn rounded-pill  btn-danger" type="button" id="estadot"></button>
                            <button class="btn rounded-pill  btn-danger" type="button" id="descripcion"></button>
                            <button class="btn rounded-pill  btn-danger" type="button" id="agentcre"></button>
                            <button class="btn rounded-pill  btn-danger" type="button" id="fecrea"></button>
                            <button class="btn rounded-pill  btn-danger" type="button" id="fechavalidacion"></button>
                            <input type="hidden" name="idtransac" id="idtransac">
                          </div>
                        </td>
                        <td>
                          <div class="btn-group-vertical">
                            <button class="btn rounded-pill  btn-default" type="button">DNI</button>
                            <button class="btn rounded-pill  btn-default" type="button">Remitente</button>
                            <button class="btn rounded-pill  btn-default" type="button">Telefono</button>
                            <button class="btn rounded-pill  btn-default" type="button">Dirección</button>
                            <button class="btn rounded-pill  btn-default" type="button">DNI Receptor</button>
                            <button class="btn rounded-pill  btn-default" type="button">Receptor</button>
                            <button class="btn rounded-pill  btn-default" type="button">Telefono</button>
                            <button class="btn rounded-pill  btn-default" type="button">Direccion</button>
                            <button class="btn rounded-pill  btn-default" type="button">Agencia Emisora</button>
                            <button class="btn rounded-pill  btn-default" type="button">Agencia Receptora</button>
                            <button class="btn rounded-pill  btn-default" type="button">Tipo</button>
                            <button class="btn rounded-pill  btn-default" type="button">Monto</button>
                            <button class="btn rounded-pill  btn-default" type="button">Comision</button>
                            <button class="btn rounded-pill  btn-default" type="button">Codigo</button>
                            <button class="btn rounded-pill  btn-default" type="button">Estado</button>
                            <button class="btn rounded-pill  btn-default" type="button">Descripcion</button>
                            <button class="btn rounded-pill  btn-default" type="button">Hecho por</button>
                            <button class="btn rounded-pill  btn-default" type="button">Fecha</button>
                            <button class="btn rounded-pill  btn-default" type="button">F. validación</button>
                          </div>
                        </td>
                        <td>
                          <div class="btn-group-vertical">
                            <button class="btn rounded-pill  btn-success" type="button" id="DNIremitenteh"></button>
                            <button class="btn rounded-pill  btn-success" type="button" id="nomcompletoch"></button>
                            <button class="btn rounded-pill  btn-success" type="button" id="telch"></button>
                            <button class="btn rounded-pill  btn-success" type="button" id="direccionch"></button>
                            <button class="btn rounded-pill  btn-success" type="button" id="DNIreceptorh"></button>
                            <button class="btn rounded-pill  btn-success" type="button" id="nomcomplerh"></button>
                            <button class="btn rounded-pill  btn-success" type="button" id="telrh"></button>
                            <button class="btn rounded-pill  btn-success" type="button" id="direccionrh"></button>
                            <button class="btn rounded-pill  btn-success" type="button" id="ageenviah"></button>
                            <button class="btn rounded-pill  btn-success" type="button" id="agerecibeh"></button>
                            <button class="btn rounded-pill  btn-success" type="button" id="tipoh"></button>
                            <button class="btn rounded-pill  btn-success" type="button" id="montoh"></button>
                            <button class="btn rounded-pill  btn-success" type="button" id="comisionh"></button>
                            <button class="btn rounded-pill  btn-success" type="button" id="codigoh"></button>
                            <button class="btn rounded-pill  btn-success" type="button" id="estadoth"></button>
                            <button class="btn rounded-pill  btn-success" type="button" id="descripcionh"></button>
                            <button class="btn rounded-pill  btn-success" type="button" id="agentcreh"></button>
                            <button class="btn rounded-pill  btn-success" type="button" id="fecreah"></button>
                            <button class="btn rounded-pill  btn-success" type="button" id="fechavalidacionh"></button>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>

                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <input type="hidden" name="idtransaccionh" id="idtransaccionh">
                    <input type="hidden" name="idbkhiss" id="idbkhiss">
                    <input type="hidden" name="idbkhish" id="idbkhish">
                    <button class="btn rounded-pill  btn-success" type="submit" id="btnGuardar"><i class="fa fa-check-square-o"></i> Validar</button>
                    <button class="btn rounded-pill  btn-warning" type="button" id="btnRechazar" onclick="cancelar();restaurar()"><i class="fa fa-close"></i> Rechazar</button>
                    <button class="btn rounded-pill  btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Volver</button>
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
  <script type="text/javascript" src="scripts/solicitudes.js"></script>
<?php
}
ob_end_flush();
?>