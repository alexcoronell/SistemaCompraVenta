var tabla;

// Funcion limpiar
function limpiar() {
    $("#idcategoria").val("");
    $("#nombre").val("");
    $("#descripcion").val("");
}

//Funcion mostrar formulario
function mostrarForm(flag) {
    limpiar();
    if (flag==true) {
		$("#formularioregistros").show();
        $("#listadoregistros").hide();
        $("#btnGuardar").prop("disabled",false);
    } else  {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
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
					url: '../ajax/categoria.php?op=listar',
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
		url: "../ajax/categoria.php?op=guardaryeditar",
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
function mostrar(idcategoria) {
	$.post("../ajax/categoria.php?op=mostrar", {idcategoria : idcategoria}, function(data, status) {
		data = JSON.parse(data);
		mostrarForm(true);

		$("#nombre").val(data.nombre);
		$("#descripcion").val(data.descripcion);
		$("#idcategoria").val(data.idcategoria);
	
	})
}

// Función para descactivar registros
function desactivar(idcategoria) {
	bootbox.confirm("¿Está seguro de desactivar la categoría", function(result){
		if(result) {
			$.post("../ajax/categoria.php?op=desactivar", {idcategoria : idcategoria}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

// Función para activar registros
function activar(idcategoria) {
	bootbox.confirm("¿Está seguro de activar la categoría", function(result){
		if(result) {
			$.post("../ajax/categoria.php?op=activar", {idcategoria : idcategoria}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

//Funcion que se ejecuta al inicio
function init() {
    mostrarForm(false);
	listar();
	
	$("#formulario").on("submit", function(e) {
		guardaryeditar(e);
	})
}

init();