var tabla;

//Funcion mostrar formulario
function mostrarForm(flag) {
    if (flag==true) {
		$("#formularioregistros").show();
        $("#listadoregistros").hide();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
    } else  {
        $("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").hide();
    }
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
					url: '../ajax/permiso.php?op=listar',
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

//Funcion que se ejecuta al inicio
function init() {
    mostrarForm(false);
	listar();
}

init();