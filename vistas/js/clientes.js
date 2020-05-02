/* Editar Cliente */
$(".btnEditarCliente").click(function(){
	// Se obtiene el "ID" del cliente.
	var idCliente = $(this).attr("idCliente");

	var datos = new FormData();
	// Se crea una variable Global tipo "_GET"
	datos.append("idCliente",idCliente);

	$.ajax({
		url: "ajax/sdd.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success:function(respuesta)
		{
			console.log("respuesta",respuesta);
		}
		 
	})

})