/* Editar Cliente */
$(".btnEditarCliente").click(function(){
	// Se obtiene el "ID" del cliente.
	var idCliente = $(this).attr("idCliente");

	var datos = new FormData();
	// Se crea una variable Global tipo "_GET"
	datos.append("idCliente",idCliente);

	// clientes.ajax.php
	$.ajax({
		url: "ajax/clientes.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success:function(respuesta)
		{
			// Se inicia a llenar los campos de la pantalla donde se editarn los archivos.
			//console.log("respuesta",respuesta);
			$("#idCliente").val(respuesta["id"]);
			$("#editarCliente").val(respuesta["nombre"]);
			$("#editarDocumentoId").val(respuesta["documento"]);
			$("#editarEmail").val(respuesta["email"]);
			$("#editarTelefono").val(respuesta["telefono"]);
			$("#editarDireccion").val(respuesta["direccion"]);
			$("#editarFechaNacimiento").val(respuesta["fecha_nacimiento"]);
		}
		 
	})

})

 //================================
	/* Eliminar Cliente */
//================================
$(".btnEliminarCliente").click(function(){
	// Obtiene el valor del ID del cliente.
	var idCliente = $(this).attr("idCliente");
	
			
		Swal.fire ({
			type: "warning",
			title: "Está seguro de borrar el cliente ?",
			text: "Si no lo esta puede Cancelar la Acción ",
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: "Si, borrar cliente !"			
			}).then(function(result){
				if (result.value)
				{
					window.location="index.php?ruta=clientes&idCliente="+idCliente;
				}

			});

			

	//console.log("idCliente",idCliente);

	
})