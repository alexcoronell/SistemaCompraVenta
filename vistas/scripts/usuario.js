var tabla;

//Funcion que se ejecuta al inicio
function init() {
    mostrarForm(false);
	listar();
	
	$("#formulario").on("submit", function(e) {
		guardaryeditar(e);
	})
    $('#imagenmuestra').hide();
    
    // Mostramos los permisos
    $.post("../ajax/usuario.php?op=permisos&id=", function(r) {
        $("#permisos").html(r);
    });
}

// Funcion limpiar
function limpiar() {
    $("#nombre").val("");
    $("#num_documento").val("");
    $("#direccion").val("");
    $("#telefono").val("");
    $("#email").val("");
    $("#cargo").val("");
    $("#login").val("");
    $("#clave").val("");
	$("#imagenmuestra").attr("src","");
	$("imagenactual").val("");
	$("#idusuario").val("");
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
					url: '../ajax/usuario.php?op=listar',
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
		url: "../ajax/usuario.php?op=guardaryeditar",
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
function mostrar(idusuario) {
	$.post("../ajax/usuario.php?op=mostrar", {idusuario : idusuario}, function(data, status) {
		data = JSON.parse(data);
		mostrarForm(true);
        
        $("#nombre").val(data.nombre);
        $("#tipo_documento").val(data.tipo_documento);
		$("#tipo_documento").selectpicker('refresh');
        $("#num_documento").val(data.num_documento);
        $("#direccion").val(data.direccion);
        $("#telefono").val(data.telefono);
        $("#email").val(data.email);
        $("#cargo").val(data.cargo);
        $("#login").val(data.login);
        $("#clave").val(data.clave);
		$('#imagenmuestra').show();
		$('#imagenmuestra').attr("src","../files/usuarios/"+data.imagen);
		$("#imagenactual").val(data.imagen);
		$("#idusuario").val(data.idusuario);
    })
    $.post("../ajax/usuario.php?op=permisos&id="+idusuario, function(r) {
        $("#permisos").html(r);
    })
}

// Función para descactivar registros
function desactivar(idusuario) {
	bootbox.confirm("¿Está seguro de desactivar el Usuario", function(result){
		if(result) {
			$.post("../ajax/usuario.php?op=desactivar", {idusuario : idusuario}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

// Función para activar registros
function activar(idusuario) {
	bootbox.confirm("¿Está seguro de activar el Usuario", function(result){
		if(result) {
			$.post("../ajax/usuario.php?op=activar", {idusuario : idusuario}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

init();