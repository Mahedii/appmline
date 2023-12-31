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
    <!--INICIO  CONTENIDO -->
    <div class="container-xxl flex-grow-1 container-p-y">


        <!-- <h4 class="py-3 mb-4">
          <span>Perfil usuario: <small id="nombre" class="text-muted fw-light"></small></span>
        </h4> -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div id="listadoregistros">
                            <table id="tbllistado"
                                class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                style="width:100%">
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
                    </div>
                </div>
            </div>
        </div>

        <div class="offcanvas offcanvas-end" id="add-new-record">
            <div class="offcanvas-header border-bottom">
                <!-- <h5 class="offcanvas-title" id="exampleModalLabel">New Record</h5> -->
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body flex-grow-1">
                <form class="add-new-record pt-0 row g-2" name="formulario form-add-new-record" id="formulario"
                    method="POST">
                    <div class="row g-3">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <input type="hidden" name="ap" id="ap">
                            <input type="hidden" name="idempleado" id="idempleado">
                            <label>Nueva contraseña *:</label>
                            <input type="password" class="form-control" name="nuevaPass" id="nuevaPass" maxlength="20"
                                placeholder="Contraseña nueva" required>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label>Confirmar contraseña *:</label>
                            <input type="password" class="form-control" name="nuevaPassConfirma" id="nuevaPassConfirma"
                                maxlength="20" placeholder="Confirmar contraseña" required>
                        </div>

                        <div class="col-sm-12">
                            <button class="btn rounded-pill  btn-success me-sm-3 me-1 waves-effect waves-light"
                                onmouseover="" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Cambiar</button>
                            <button
                                class="btn rounded-pill  btn-danger btn-outline-secondary me-sm-3 me-1 waves-effect waves-light"
                                onclick="cancelarform()" type="reset" data-bs-dismiss="offcanvas"><i
                                    class="fa fa-arrow-circle-left"></i> Cancelar</button>
                        </div>
                </form>

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