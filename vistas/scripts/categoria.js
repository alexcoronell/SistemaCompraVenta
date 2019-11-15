var tabla;

//Funcion que se ejecuta al inicio
function init() {
    mostrarForm(false);
    listar();
}

// Funcion limpiar
function limpiar() {
    $("idcategoria").val("");
    $("#nombre").val("");
    $("#descripcion").val("");
}

//Funcion mostrar formulario
function mostrarForm(flag) {
    limpiar();
    if (flag) {
        $("#listadoregistros").hide();
        $("formularioregistros").show();
        $("btnGuardar").prop("disabled",false);
    } else {
        $("#listadoregistros").show();
        $("formularioregistros").hide();
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

init();