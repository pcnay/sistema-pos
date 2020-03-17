/* Cargar los datos - Productos de forma dinamica */

// Verificar que los datos Json estan correctos.

// En esta parte se agrega la tabla a la plugin "DataTable" y no quema en el HTML el contenido de los campos.
// Se agregan tres propiedades últimas para mejorar el desempeño en la carga de la páginas.
$('.tablaProductos').DataTable({
	"ajax":"ajax/datatable-productos.ajax.php",
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