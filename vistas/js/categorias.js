// Revisando que la "categoria" no este repetida.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevaCategoria" id="nuevaCategoria" placeholder = "Ingresar una Categoria" required>
$("#nuevaCategoria").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevaCategoria.
	var categoria = $(this).val();
	
	//console.log("Ubicacion",categoria);

	// Obtener datos de la base de datos
	var datos = new FormData();
	// Genera 
	datos.append("validarCategoria",categoria);
	$.ajax({
		url:"ajax/categoria.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,	
		processData:false,
		dataType:"json",
		success:function(respuesta){			
			// Si "respuesta = Valor, Verdadero "
			if (respuesta)
			{
				// Coloca una barra con mensaje de advertencia  en la etiqueta.
				$("#nuevaCategoria").parent().after('<div class="alert alert-warning" >Esta Categoria Ya Existe </div>');
				$("#nuevaCategoria").val("");
			}

		}
	})
 
})
