
// EDITAR CATEGORIA:
$(".btnEditarCategoria").click(function(){
	// Se obtiene el valor de "idCategoria"
	var idCategoria = $(this).attr("idCategoria");

	// Para agregar datos 
	var datos = new FormData();
	datos.append("idCategoria",idCategoria); // Se crea la variable "POST", "idCategoria"

	$.ajax({
		url:"ajax/categoria.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,	
		processData:false,
		dataType:"json",
		success:function(respuesta){
			// console.log("respuesta",respuesta);
			// Viene desde : <div id="modalEditarCategoria" class="modal fade" role="dialog">, "categorias.php", se le asigna el valor que se retorno el Ajax.
			$("#editarCategoria").val(respuesta["nombre"]);
			$("#idCategoria").val(respuesta["id"]); // viene desde el campo oculto de <input type="hidden"  name="idCategoria"  id="idCategoria" required>
		}

	}); // $.ajax({ ......


})  // $(":btnEditarCategoria")


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
 
}) // $("#nuevaCategoria").change(function(){

//=======================================================
// Eliminar categoria.
// $(".btnEliminarCategoria").click(function (){
	// Cuando el documento ya este cargado, busque en cualquier momento la clase ".btnEditarCategoria", por lo que no importa si al cargar la primera vez no se haya creado esta clase, pero al hacer click en la clase se ejecutara esta funcion.  
	$(document).on("click",".btnEliminarCategoria",function()
	{	

		// Obteniendo los valores de "idCategoria"
		var idCategoria = $(this).attr("idCategoria");

		Swal.fire ({
			title: "Esta Seguro De Borrar La Categoria",
			text: "Puedes Cancelar La Accion",
			type: 'warning',
			showCancelButton: true,
			confirmButtonText: "#3085d6",
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Si, Borrar Categoria'
		}).then(function(result){ 
			if (result.value)
			{
				//window.location = "index.php?ruta=usuarios&idUsuario="+idUsuario+"&usuario="+usuario+"&foto="+fotoUsuario;
				window.location = "index.php?ruta=categorias&idCategoria="+idCategoria;
			}
		})	

}) // $(".btnEliminarCategoria").click(function(){

