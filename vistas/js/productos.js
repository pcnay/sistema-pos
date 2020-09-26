/* Cargar los datos - Productos de forma dinamica */

// Para hacer que las variables de sesion se puedan usar en Datatable.
var perfilOculto = $("#perfilOculto").val();
//console.log ("perfilOculto",perfilOculto);



// Verificar que los datos Json estan correctos.
// En esta parte se agrega la tabla a la plugin "DataTable" y no quema en el HTML el contenido de los campos.
// Se agregan tres propiedades últimas para mejorar el desempeño en la carga de la páginas.
// defenderRender, retrieve, proccesing
// ?perfilOculto="+perfilOculto = Se manda como variable GET a "datatable-productos.ajax.php"
$('.tablaProductos').DataTable({
	"ajax":"ajax/datatable-productos.ajax.php?perfilOculto="+perfilOculto,
	"defenderRender":true,
	"retrieve":true,
	"processing":true,
  "language":{ 
    "sProcessing": "Procesando ...",
    "sLengthMenu": "Mostrar _MENU_ registros",
    "sZeroRecords": "No se encontraron resultados",
    "sEmptyTable": "Ningún dato disponible en esta tabla",
    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
    "sInfoFiltered": "(filtrado de un total de _MAX_ registros",
    "sInfoPostFix": "",
    "sSearch": "Buscar",
    "sUrl": "",
    "sInfoThousands": ",",
    "sLoadingRecords": "Cargando ...",
    "oPaginate":{
      "sFirst": "Primero",
      "sLast": "Ultimo",
      "sNext": "Siguiente",
      "sPrevious": "Anterior",
		},
		"oAria": {
      "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		},
	}

});

/*
$.ajax({		
	url:"ajax/datatable-productos.ajax.php",
	success:function(respuesta){
	console.log("respuesta",respuesta);
		}
})
*/

/*
$('.tabla').DataTable({
	"ajax":"ajax/datatable-productos.ajax.php"
});
*/ 

// Se agrega el código para obtener el último número del codigo a utilizar
$("#nuevaCategoria").change(function(){
	
	// Obtener el último de "codigo" desde la tabla "productos"
	var idCategoria = $(this).val();
	var datos = new FormData();
	datos.append("idCategoria",idCategoria);
	$.ajax({
		url:"ajax/productos.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,
		processData:false,
		dataType:"json",
		success:function(respuesta)
		{
			//console.log("respuesta",respuesta);
			// Para el caso de que no exista una categoria en la tabla de "t_Productos".
			if (!respuesta)
			{
				// No Categoria mas 01 para completar el numero, ejemplo 9 + 01 = 901
				var nuevoCodigo = idCategoria+"01";
				$("#nuevoCodigo").val(nuevoCodigo);
			}
			else
			{
				// Se obtiene el código de la tabla de "t_Productos"
				var nuevoCodigo = Number(respuesta["codigo"])+1;
				//console.log("respuesta",nuevoCodigo);
				// Se asigna a la etiqueta "codigo" de la vista Captura de Productos.
				$("#nuevoCodigo").val(nuevoCodigo);
			}
			

		}
	})
})

// Agregando Precio de Venta.
// Se esta agregando otra clase, para cuando se edite un producto.
$("#nuevoPrecioCompra, #editarPrecioCompra").change(function(){
	
	if ($(".porcentaje").prop("checked"))
	{			
		// Viene de la la etiqueta : <!-- Entrada para el porcentaje(producto.php) -->
		var valorPorcentaje = $(".nuevoPorcentaje").val();
		//console.log ("valorPorcentaje",valorPorcentaje);
		var precioVentaConIva = Number(($("#nuevoPrecioCompra").val()*valorPorcentaje)/100)+Number($("#nuevoPrecioCompra").val());

		var precioVentaConIvaEditado = Number(($("#editarPrecioCompra").val()*valorPorcentaje)/100)+Number($("#editarPrecioCompra").val());

		//console.log ("valorPorcentaje",precioVentaConIva);
		$("#nuevoPrecioVenta").val(precioVentaConIva);
		$("#nuevoPrecioVenta").prop("readonly",true); 
		// Para que no se pueda modificar.
		$("#editarPrecioVenta").val(precioVentaConIvaEditado);
		$("#editarPrecioVenta").prop("readonly",true); 


	}
})

// Cuando se cambia el valor del porcentaje.
$(".nuevoPorcentaje").change(function(){

	if ($(".porcentaje").prop("checked"))
	{			
		// Viene de la la etiqueta : <!-- Entrada para el porcentaje(producto.php) -->
		//var valorPorcentaje = $(".nuevoPorcentaje").val();
		// Se modifica para utilizarlo en la captura y edicion del producto
		var valorPorcentaje = $(this).val();

		//console.log ("valorPorcentaje",valorPorcentaje);
		var precioVentaConIva = Number(($("#nuevoPrecioCompra").val()*valorPorcentaje)/100)+Number($("#nuevoPrecioCompra").val());

		var precioVentaConIvaEditado = Number(($("#editarPrecioCompra").val()*valorPorcentaje)/100)+Number($("#editarPrecioCompra").val());

		//console.log ("valorPorcentaje",precioVentaConIva);
		$("#nuevoPrecioVenta").val(precioVentaConIva);
		$("#nuevoPrecioVenta").prop("readonly",true); 
		// Para que no se pueda modificar.

		$("#editarPrecioVenta").val(precioVentaConIvaEditado);
		$("#editarPrecioVenta").prop("readonly",true); 

	}

})

// Se utiliza este comando ya que la etiqueta check se esta utilizando con un componente "ickecked"
$(".porcentaje").on("ifUnchecked",function(){
	// Para activarlo nuevamente el "checkbox"
	$("#nuevoPrecioVenta").prop("readonly",false); 
	// Se modifica para cuando se esta editando y se activa el CheckBox
	$("#editarPrecioVenta").prop("readonly",false); 
})
$(".porcentaje").on("ifChecked",function(){
	// Para Desactivarlo nuevamente el "checkbox"
	$("#nuevoPrecioVenta").prop("readonly",true); 
	// Se modifica para cuando se esta editando y se desactiva el CheckBox
	$("#editarPrecioVenta").prop("readonly",true); 
})

// Se agrega la foto del articulo, viene desde el formulario de captura (vistas/modulos/productos.php)
$(".nuevaImagen").change(function(){

	// propiedad de la etiqueta "File" de JavaScript, obtiene la imagen en el indice 0
	var imagen = this.files[0]; 
  //console.log("imagen",imagen);

  // Validando que el formato de la imagen sea JPE o PNG
  if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png")
  {
    $(".nuevaImagen").val("");
      Swal.fire ({
        title: "Error al subir la imagen",
        text: "La imagen debe estar en formato JPG o PNG",
        icon: "error",
        confirmButtonText: "Cerrar"
      });
  }
  
  else if (imagen["size"] > 2000000) // 2 Mb
  {
    $(".nuevaImagen").val("");
      Swal.fire ({
        title: "Error al subir la imagen",
        text: "La imagen no debe pesar mas de 2 MB.",
        icon: "error",
        confirmButtonText: "Cerrar"
      });
  }
  else
  {
    var datosImagen = new FileReader;
    datosImagen.readAsDataURL(imagen);
    
    $(datosImagen).on("load",function(event){
      var rutaImagen = event.target.result;
      // Se muestra la imagen en la pantalla, cuando se sube.
      $(".previsualizar").attr("src",rutaImagen);
    })
  }


})

// Editar Producto
// Se va a realizar un cambio, ya que se debe ejecutar el código cuando se termina de cargar el cuerpo de la tabla. Se realiza un click en el Boton Editar
$(".tablaProductos tbody").on("click","button.btnEditarProducto",function(){
	var idProducto = $(this).attr("idProducto");
	// console.log("idProducto",idProducto);
	// Se esta agregando un dato al Ajax.
	var datos = new FormData();
	datos.append("idProducto",idProducto);
	$.ajax({
		url:"ajax/productos.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,
		processData:false,
		dataType:"json",
		success:function(respuesta)
		{
			// console.log("respuesta",respuesta);
			// Obtener la categoria.
			var datosCategoria = new FormData();
			datosCategoria.append("idCategoria",respuesta["id_categoria"]);
			$.ajax({
				url:"ajax/categoria.ajax.php",
				method:"POST",
				data:datosCategoria,
				cache:false,
				contentType:false,
				processData:false,
				dataType:"json",
				success:function(respuesta)
				{
					console.log("respuesta",respuesta);					
					$("#editarCategoria").val(respuesta["id"]);
					$("#editarCategoria").html(respuesta["nombre"]);
		
				}
		
			})		

			// SE van asignar los valores a las editas del producto a Editar.
			$("#editarCodigo").val(respuesta["codigo"]);
			$("#editarDescripcion").val(respuesta["descripcion"]);
			$("#editarStock").val(respuesta["stock"]);
			$("#editarPrecioCompra").val(respuesta["precio_compra"]);
			$("#editarPrecioVenta").val(respuesta["precio_venta"]);
			if (respuesta["imagen"] != "")
			{
				$("#imagenActual").val(respuesta["imagen"]);
				//console.log("imagen",respuesta["imagen"]);
				
				$(".previsualizar").attr("src",respuesta["imagen"]);
			}

			
		}

	})	

})


// Borrar Producto
// Se va a realizar un cambio, ya que se debe ejecutar el código cuando se termina de cargar el cuerpo de la tabla. Se realiza un click en el Boton Editar
$(".tablaProductos tbody").on("click","button.btnEliminarProducto",function(){
	var idProducto = $(this).attr("idProducto");
	// console.log("idProducto",idProducto);
	// Obtener el codigo del producto y la ruta de la imagen que esta grabada en la Tabla.
	var codigo = $(this).attr("codigo");
	var imagen = $(this).attr("imagen");

	
	Swal.fire ({
		type: "success",
		title: "La categoria ha sido borrada correctamente ",
		text : "De lo contrario puede cancelar la Acción ",
		type:'warning',
		showCancelButton:true,		
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText:'Si Para Borrar',
		closeOnConfirm: false
		}).then(function(result){
			if (result.value)
			{
				window.location="index.php?ruta=productos&idProducto="+idProducto+"&imagen="+imagen+"&codigo="+codigo;
			}

			});	

})
