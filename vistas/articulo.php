<?php
// Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"])) {
  header("Location: login.html");
} else {
  
require 'header.php';

if ($_SESSION['almacen']==1) {
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
                          <h1 class="box-title">Artículo <button class="btn btn-success" id="btnagregar" onclick="mostrarForm(true)"><i class="fa fa-plus-circle"></i> Agregar </button></h1>
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
                          <th>Categoría</th>
                          <th>Código</th>
                          <th>Stock</th>
                          <th>Imagen</th>
                          <th>Estado</th>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                        <th>Opciones</th>
                          <th>Nombre</th>
                          <th>Categoría</th>
                          <th>Código</th>
                          <th>Stock</th>
                          <th>Imagen</th>
                          <th>Estado</th>
                        </tfoot>
                      </table>
                    </div> 
                    <!--Fin centro -->
                    <div id="formularioregistros" class="panel-body">
                        
                        <form name="formulario" id="formulario" method="POST">
                        
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Nombre(*):</label>
                        <input type="hidden" name="idarticulo" id="idarticulo">
                        <input class="form-control" type="text" name="nombre" id="nombre" maxLength="100" placeholder="Nombre" required>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Categoría(*):</label>
                        <select id="idcategoria" name="idcategoria" class="form-control selectpicker" data-live-search="true" required></select>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Stock(*):</label>
                        <input class="form-control" type="number" name="stock" id="stock" required>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Descripción:</label>
                        <input class="form-control" type="text" name="descripcion" id="descripcion" maxLength="256" placeholder="Descripción">
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Imagen:</label>
                        <input class="form-control" type="file" name="imagen" id="imagen">
                        <input type="hidden" name="imagenactual" id="imagenactual">
                        <img src="" width="150px" height="150px" id="imagenmuestra">
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Código:</label>
                        <input class="form-control" type="text" name="codigo" id="codigo" placeholder="Código de Barras">
                        <button class="btn btn-success" type="button" onclick="generarbarcode()">Generar</button>
                        
                        <button class="btn btn-info" type="button" onclick="imprimir()">Imprimir</button>
                        <div id="print">
                          <svg id="barcode"></svg>
                        </div>
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
<script src="../public/js/JsBarcode.all.min.js"></script>
<script src="../public/js/jquery.PrintArea.js"></script>
<script src="scripts/articulo.js"></script>

<?php
}
ob_end_flush();
?>