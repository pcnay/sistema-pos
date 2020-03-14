/* Cargar los datos - Productos de forma dinamica */

// Verificar que los datos Json estan correctos.

$.ajax({		
	url:"ajax/datatable-productos.ajax.php",
	success:function(respuesta){
	console.log("respuesta",respuesta);
		}
})

// En esta parte se agrega la tabla a la plugin "DataTable" y no quema en el HTML el contenido de los campos.
$('.tablaProductos').DataTable({
	"ajax":"ajax/datatable-productos.ajax.php"
})


/*
$('.tabla').DataTable({
	"ajax":"ajax/datatable-productos.ajax.php"
});
*/ 

/*
$(document).ready(function(){
	('#tablas').DataTable({
		ajax:"data/ajax.txt"});
});
*/
