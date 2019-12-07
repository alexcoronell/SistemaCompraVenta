<?php
// Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"])) {
  header("Location: login.html");
} else {
  
require 'header.php';

if ($_SESSION['ventas']==1) {
?>

<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Cliente <button class="btn btn-success" id="btnagregar" onclick="mostrarForm(true)"><i class="fa fa-plus-circle"></i> Agregar </button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body" style="height: 400px;" id="listadoregistros">
                      <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                          <th>Opciones</th>
                          <th>Nombre</th>
                          <th>Tipo de Documento</th>
                          <th>Número de Documento</th>
                          <th>Teléfono</th>
                          <th>Email</th>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                          <th>Opciones</th>
                          <th>Nombre</th>
                          <th>Tipo de Documento</th>
                          <th>Número de Documento</th>
                          <th>Teléfono</th>
                          <th>Email</th>
                        </tfoot>
                      </table>
                    </div> 
                    <!--Fin centro -->
                    <div id="formularioregistros" class="panel-body" style="height: 400px;">
                        
                        <form name="formulario" id="formulario" method="POST">
                        
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Nombre:</label>
                        <input type="hidden" name="idpersona" id="idpersona">
                        <input type="hidden" name="tipo_persona" id="tipo_persona" value="Cliente">
                        <input class="form-control" type="text" name="nombre" id="nombre" maxLength="100" placeholder="Nombre del Cliente" required>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Tipo de Documento:</label>
                        <select name="tipo_documento" class="form-control selectpicker" id="tipo_documento" required>
                            <option value="NIT">NIT</option>
                            <option value="RUT">RUT</option>
                            <option value="Cédula Ciudadanía">Cédula de Ciudadanía</option>
                            <option value="Cédula de Extranjería">Cédula de Extranjería</option>
                            <option value="Pasaporte">Pasaporte</option>
                        </select>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Número de Documento:</label>
                        <input class="form-control" type="text" name="num_documento" id="num_documento" maxLength="20" placeholder="Número de documento" required>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Dirección:</label>
                        <input class="form-control" type="text" name="direccion" id="direccion" maxLength="70" placeholder="Dirección" required>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Teléfono:</label>
                        <input class="form-control" type="text" name="telefono" id="telefono" maxLength="20" placeholder="Teléfono" required>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Correo Electrónico:</label>
                        <input class="form-control" type="email" name="email" id="email" maxLength="50" placeholder="Correo Electrónico" required>
                        </div>

                        <div class="form-group col-12">
                          <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                          <button class="btn btn-danger" onclick="cancelarForm()"><i class="fa fa-arrow-circle-left"> Cancelar</i></button>
                        </div>


                        </form>
                        

                        </div> <!-- fin div Formulario -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
<?php
} else {
  require 'noacceso.php';
}
require 'footer.php'
?>
<script src="scripts/cliente.js"></script>
<?php
}
ob_end_flush();
?>