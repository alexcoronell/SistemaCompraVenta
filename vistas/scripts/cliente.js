var tabla;

// Funcion limpiar
function limpiar() {
    $("#idpersona").val("");
    $("#nombre").val("");
    $("#num_documento").val("");
    $("#direccion").val("");
    $("#telefono").val("");
    $("#email").val("");
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
					url: '../ajax/persona.php?op=listarc',
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
		url: "../ajax/persona.php?op=guardaryeditar",
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
function mostrar(idpersona) {
	$.post("../ajax/persona.php?op=mostrar", {idpersona : idpersona}, function(data, status) {
		data = JSON.parse(data);
		mostrarForm(true);

		$("#nombre").val(data.nombre);
        $("#tipo_documento").val(data.tipo_documento);
        $("#tipo_documento").selectpicker('refresh');
        $("#num_documento").val(data.num_documento);
        $("#direccion").val(data.direccion);
        $("#telefono").val(data.telefono);
        $("#email").val(data.email);
        $("#idpersona").val(data.idpersona);
	})
}

// Función para eliminar registros
function eliminar(idpersona) {
	bootbox.confirm("¿Está seguro de eliminar el cliente", function(result){
		if(result) {
			$.post("../ajax/persona.php?op=eliminar", {idpersona : idpersona}, function(e){
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