<?php
// Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"])) {
  header("Location: login.html");
} else {
  
require 'header.php';

if ($_SESSION['acceso']==1) {
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
                          <h1 class="box-title">Usuario <button class="btn btn-success" id="btnagregar" onclick="mostrarForm(true)"><i class="fa fa-plus-circle"></i> Agregar </button></h1>
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
                          <th>Tipo Documento</th>
                          <th>Número Documento</th>
                          <th>Teléfono</th>
                          <th>Email</th>
                          <th>Login</th>
                          <th>Foto</th>
                          <th>Estado</th>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                          <th>Opciones</th>
                          <th>Nombre</th>
                          <th>Tipo Documento</th>
                          <th>Número Documento</th>
                          <th>Teléfono</th>
                          <th>Email</th>
                          <th>Login</th>
                          <th>Foto</th>
                          <th>Estado</th>
                        </tfoot>
                      </table>
                    </div> 
                    <!--Fin centro -->
                    <div id="formularioregistros" class="panel-body">
                        
                        <form name="formulario" id="formulario" method="POST">
                        
                        <!-- Nombre -->
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>Nombre(*):</label>
                        <input type="hidden" name="idusuario" id="idusuario">
                        <input class="form-control" type="text" name="nombre" id="nombre" maxLength="100" placeholder="Nombre" required>
                        </div>

                        <!-- Tipo de documento -->
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Tipo de Documento(*):</label>
                        <select id="tipo_documento" name="tipo_documento" class="form-control selectpicker" data-live-search="true" required>
                            <option value="Cédula de Identidad">Cédula de Identidad</option>
                            <option value="Cédula de Extranjería">Cédula de Extranjería</option>
                            <option value="Pasaporte">Pasaporte</option>
                            <option value="NIT">NIT</option>
                        </select>
                        </div>

                        <!-- Número de documento -->
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Número de Documento:</label>
                        <input class="form-control" type="text" name="num_documento" id="num_documento" maxLength="20" placeholder="Número de Documento">
                        </div>
                        
                        <!-- Dirección -->
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Dirección:</label>
                        <input class="form-control" type="text" name="direccion" id="direccion" maxLength="70" placeholder="Dirección">
                        </div>

                        <!-- Teléfono -->
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Teléfono:</label>
                        <input class="form-control" type="text" name="telefono" id="telefono" maxLength="20" placeholder="Teléfono">
                        </div>

                        <!-- Email -->
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Correo Electrónico:</label>
                        <input class="form-control" type="email" name="email" id="email" maxLength="50" placeholder="usuario@email.com">
                        </div>

                        <!-- Cargo -->
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Cargo:</label>
                        <input class="form-control" type="text" name="cargo" id="cargo" maxLength="20" placeholder="Cargo">
                        </div>

                         <!-- Login -->
                         <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Login (*):</label>
                        <input class="form-control" type="text" name="login" id="login" maxLength="20" placeholder="Login" required>
                        </div>

                        <!-- Clave -->
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Clave (*):</label>
                        <input class="form-control" type="password" name="clave" id="clave" maxLength="64" placeholder="Contraseña" required>
                        </div>

                        <!-- Listado de permisos -->
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Permisos:</label>
                            <ul id="permisos" style="list-style: none;"></ul>
                        </div>

                        <!-- imagen -->
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Imagen:</label>
                        <input class="form-control" type="file" name="imagen" id="imagen">
                        <input type="hidden" name="imagenactual" id="imagenactual">
                        <img src="" width="150px" height="120px" id="imagenmuestra">
                        </div>

                        <!-- Guardar -->
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

<script src="scripts/usuario.js"></script>
<?php
}
ob_end_flush();
?>