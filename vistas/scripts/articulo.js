var tabla;

//Funcion que se ejecuta al inicio
function init() {
    mostrarForm(false);
	listar();
	
	$("#formulario").on("submit", function(e) {
		guardaryeditar(e);
	})

	// Cargamos los items al select categoría
	$.post("../ajax/articulo.php?op=selectCategoria", function(r) {
		$("#idcategoria").html(r);
		$('#idcategoria').selectpicker('refresh');
	});
	$('#imagenmuestra').hide();
}

// Funcion limpiar
function limpiar() {
    $("#codigo").val("");
    $("#nombre").val("");
    $("#descripcion").val("");
	$("#stock").val("");
	$("#imagenmuestra").attr("src","");
	$("imagenactual").val("");
	$("#print").hide();
	$("#idarticulo").val("");
}

//Funcion mostrar formulario
function mostrarForm(flag) {
    limpiar();
    if (flag==true) {
		$("#formularioregistros").show();
        $("#listadoregistros").hide();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
    } else  {
        $("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
    }
}

// Función cancelarForm
function cancelarForm() {
    limpiar();
    mostrarForm(false);
}

//Funcion Listar
function listar()
{
	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/articulo.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

// Función para Guardar y Editar
function guardaryeditar(e) {
	e.preventDefault(); // No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled", true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/articulo.php?op=guardaryeditar",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,

		success: function(datos) {
			bootbox.alert(datos);
			mostrarForm(false);
			tabla.ajax.reload();
		}
	});
	limpiar();
}
// Función para editar
function mostrar(idarticulo) {
	$.post("../ajax/articulo.php?op=mostrar", {idarticulo : idarticulo}, function(data, status) {
		data = JSON.parse(data);
		mostrarForm(true);
        
		$("#idcategoria").val(data.idcategoria);
		$("#idcategoria").selectpicker('refresh');
        $("#codigo").val(data.codigo);
        $("#nombre").val(data.nombre);
        $("#stock").val(data.stock);
		$("#descripcion").val(data.descripcion);
		$('#imagenmuestra').show();
		$('#imagenmuestra').attr("src","../files/articulos/"+data.imagen);
		$("#imagenactual").val(data.imagen);
		$("#idarticulo").val(data.idarticulo);
		generarbarcode();
	
	})
}

// Función para descactivar registros
function desactivar(idarticulo) {
	bootbox.confirm("¿Está seguro de desactivar el artículo", function(result){
		if(result) {
			$.post("../ajax/articulo.php?op=desactivar", {idarticulo : idarticulo}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

// Función para activar registros
function activar(idarticulo) {
	bootbox.confirm("¿Está seguro de activar el artículo", function(result){
		if(result) {
			$.post("../ajax/articulo.php?op=activar", {idarticulo : idarticulo}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

// Función para generar Código de barras
function generarbarcode() {
	codigo=$("#codigo").val();
	JsBarcode("#barcode", codigo);
	$("#print").show();
}

// Función para imprimir el código de barras
function imprimir() {
	$("#print").printArea();
}

init();