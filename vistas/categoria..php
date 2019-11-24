<?php
require 'header.php';
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
                          <h1 class="box-title">Categoria <button class="btn btn-success" id="btnagregar" onclick="mostrarForm(true)"><i class="fa fa-plus-circle"></i> Agregar </button></h1>
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
                          <th>Descripcion</th>
                          <th>Estado</th>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                          <th>Opciones</th>
                          <th>Nombre</th>
                          <th>Descripcion</th>
                          <th>Estado</th>
                        </tfoot>
                      </table>
                    </div> 
                    <!--Fin centro -->
                    <div id="formularioregistros" class="panel-body" style="height: 400px;">
                        
                        <form name="formulario" id="formulario" method="POST">
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        
                        <label>Nombre:</label>
                        <input type="hidden" name="idcategoria" id="idcategoria">
                        <input class="form-control" type="text" name="nombre" id="nombre" maxLength="50" placeholder="nombre" required>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Descripción:</label>
                        <input class="form-control" type="text" name="descripcion" id="descripcion" maxLength="256" placeholder="Descripción">
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
require 'footer.php'
?>
<script src="scripts/categoria.js"></script>