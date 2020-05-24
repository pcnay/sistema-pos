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
			$(".nuevoProducto").append();

		}
	});

});
