/* Cargar los datos - Productos de forma dinamica */
// Verificar que los datos Json estan correctos.
// En esta parte se agrega la tabla a la plugin "DataTable" y no quema en el HTML el contenido de los campos.
// Se agregan tres propiedades últimas para mejorar el desempeño en la carga de la páginas.
// defenderRender, retrieve, proccesing

/*
$.ajax({		
	url:"ajax/datatable-ventas.ajax.php",
	success:function(respuesta){
	console.log("respuesta",respuesta);
		}
})
*/

/* Cargar los datos - Productos de forma dinamica */
// Verificar que los datos Json estan correctos.
// En esta parte se agrega la tabla a la plugin "DataTable" y no quema en el HTML el contenido de los campos.
// Se agregan tres propiedades últimas para mejorar el desempeño en la carga de la páginas.
// defenderRender, retrieve, proccesing
$('.tablaVentas').DataTable({
	"ajax":"ajax/datatable-ventas.ajax.php",
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


// Al cargar la tabla donde se captura Crear Ventas.
// Se encuentra en el archivo "crear-venta.php", <div class= "form-group row nuevoProducto">


$(".tablaVentas tbody").on("click","button.agregarProducto",function(){
	var idProducto = $(this).attr("idProducto");
	console.log("idProducto",idProducto);
	$(this).removeClass("btn-primary agregarProducto");
	$(this).addClass("btn-default");


	// Para obtener el producto que se mostrara en la pantalla de Captura Venta.
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
		success:function(respuesta){
			//console.log("respuesta",respuesta);
			var descripcion = respuesta["descripcion"];
			var stock = respuesta["stock"];
			var precio = respuesta["precio_venta"];

			// Cuando no tenga en existencia, mostrara una pantalla de advertencia y no permita agregar
			if (stock == 0)
			{

				Swal.fire ({
					title: "No hay stock disponible",				
					icon: "error",
					confirmButtonText: "Cerrar"
				});
	
					// Se asigna el color "Azul" y se habilita para agregar nuevamente los renglones a las ventas.
					$("button[idProducto='"+idProducto+"']").addClass("btn-primary agregarProducto");
					return;


			}
			// Se agrega el renglon de las ventas, 
			// Se agrega una clase "quitarProducto", se coloca un "idProducto" para utilizarlo al eliminar el registro de una venta.
			$(".nuevoProducto").append('<div class="row" style="padding:5px 15px">'+			
				'<div class="col-xs-6" style="padding-right:0px">'+
				'<div class="input-group">'+
					'<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto = "'+idProducto+'"><i class="fa fa-times"></i></button></span>'+

				'<input type="text" class="form-control" id="agregarProducto" name="agregarProducto" value="'+descripcion+'"  readonly required>'+

				'</div> <!-- <div class="input-group"> -->'+

				'</div> <!-- <div class="col-xs-6" style="padding-right:0px"> -->'+

				'<!-- Se desplaza a 3 columnas-->'+
				'<div class ="col-xs-3">'+
				'<input type="number" class="form-control" id="nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value = "1" stock="'+stock+'" required>'+

				'</div> <!-- <div class ="col-xs-3"> -->'+

				'<div class="col-xs-3" style="padding-left:0px">'+
					'<div class="input-group">'+
					'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
					
					'<input type="number" min="1" class="form-control" id="nuevoPrecioProducto" name="nuevoPrecioProducto" value="'+precio+'" readonly required>'+	

				'</div> <!-- <div class="input-group"> -->'+

			'</div> <!-- <div class="col-xs-3" style="padding-left:0px"> -->'+ 
			
			'</div>')
		}

	});

});


// Cuando cargue la tabla cada vez que navegue en ella (desplazarse entre los numeros de paginas que tenga )
$(".tablaVentas").on("draw.dt", function(){
	// console.log("Navegando entre tablas");
	if (localStorage.getItem("quitarProducto") != null)
	{
		var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"))
		for (var i = 0; i<listaIdProductos.length;i++)
		{
			// Se remueve la clase, en el lado donde se listan los productos.
			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").removeClass('btn-default');
			// Se agrega el boton de color Azul, en lado donde se listan los productos.
			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").addClass('btn-primary agregarProducto');
		}
	}


})



// Quitar productos de los renglones cuando se esta realizando la venta, y recuperar el boton.

// Ahora se ajustara para el caso en que se borre una venta, pero cuando es de otras páginas no se actualiza.

$(".formularioVenta").on("click","button.quitarProducto",function(){
	// Se eliminara los renglones de la venta.
	// console.log("boton");
	$(this).parent().parent().parent().parent().remove();
	
	var idProducto = $(this).attr("idProducto");
	var idQuitarProducto = [];		
	localStorage.removeItem("quitarProducto");

	// Almacenar en el "LocalStorage" el "ID" del producto a quitar.
	if (localStorage.getItem("quitarProducto") == null)
	{
		idQuitarProducto = [];		
	}
	else
	{
		idQuitarProducto.concat(localStorage.getItem("quitarProducto"));
	}
	idQuitarProducto.push({"idProducto":idProducto});
	localStorage.setItem("quitarProducto",JSON.stringify(idQuitarProducto));

	// Para habilitar el Boton de "Agregar" de la seccion Derecha .
	// Este viene desde el "datatable-ventas.ajax.php", $botones = "<div class='btn-group'><button class='btn btn-primary agregarProducto .....

	$("button.recuperarBoton[idProducto='"+idProducto+"']").removeClass('btn-default');
	$("button.recuperarBoton[idProducto='"+idProducto+"']").addClass('btn-primary agregarProducto');
})
