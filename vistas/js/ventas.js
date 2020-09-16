// Variables Local Storage, para el boton que se encuentra en "Administrar Ventas" permanezca la fecha.
if (localStorage.getItem("capturarRango") != null)
{
	// Se va asignar en boton donde despliega el rango seleccionado.
	$("#daterange-btn span").html(localStorage.getItem("capturarRango"));	
}
else
{
	$("#daterange-btn span").html('<i class="fa fa-calendar"></i>Rango De Fecha');
}


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
	//console.log("idProducto",idProducto);
	// Cuando se oprime el boton de "Agregar" lado derecho, se desactiva.
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
			// Se agrega la clase : "nuevaDescripcionProducto", para cuando se guarda en "Json"

			$(".nuevoProducto").append('<div class="row" style="padding:5px 15px">'+			
				'<div class="col-xs-6" style="padding-right:0px">'+
				'<div class="input-group">'+
					'<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto = "'+idProducto+'"><i class="fa fa-times"></i></button></span>'+

				'<input type="text" class="form-control nuevaDescripcionProducto" idProducto="'+idProducto+'" name="agregarProducto" value="'+descripcion+'"  readonly required>'+

				'</div> <!-- <div class="input-group"> -->'+

				'</div> <!-- <div class="col-xs-6" style="padding-right:0px"> -->'+

				'<!-- Se desplaza a 3 columnas-->'+
				'<!-- Cantidad Del Producto-->'+
				'<div class ="col-xs-3">'+
				'<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value = "1" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" required>'+

				'</div> <!-- <div class ="col-xs-3"> -->'+

				'<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+
					'<div class="input-group">'+
					'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
					
					'<input type="text" class="form-control nuevoPrecioProducto" name="nuevoPrecioProducto" precioReal="'+precio+'" value="'+precio+'" readonly required>'+	

				'</div> <!-- <div class="input-group"> -->'+

			'</div> <!-- <div class="col-xs-3" style="padding-left:0px"> -->'+ 
			
			'</div>')

			// Para que sume el importe y lo despliegue en Total Venta.
			// Esta función se define en la parte última.
			sumarTotalPrecios();
			agregarImpuesto();

			// Se agrupan las ventas en formato JSon
			listarProductos();

			// Poner formato al precio de los productos.
			$(".nuevoPrecioProducto").number(true,2);

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

	// Para el caso de que se elimine todos los renglones de la venta y no muestre error al refrescar el total
	// NO se tienen hijos de la etiqueta donde se estan agregando los productos.
	if ($(".nuevoProducto").children().length == 0)
	{
		$("#nuevoImpuestoVenta").val(0);
		$("#nuevoTotalVenta").val(0);
		$("#totalVenta").val(0);
		$("#nuevoTotalVenta").attr("total",0);
	}
	else
	{
		sumarTotalPrecios(); // para actualizar el saldo, ya que se quita renglones de la venta.
		agregarImpuesto();
		// Se agrupan las ventas en formato JSon
		listarProductos();

	}
})


// Agregando el boton "Agregar Productos" para dispositivos mobiles.
// Se va hacer un ajuste ya que se selecciona un elemento de la etiqueta "select" se duplica.
var numProducto = 0;

$(".btnAgregarProducto").click(function(){
	numProducto ++;

	// Se van a traer todos los productos.
	var datos = new FormData();
	datos.append("traerProductos","ok");
	$.ajax
	({
		url:"ajax/productos.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,
		processData:false,
		dataType:"json",
		success:function(respuesta){
			//console.log ("respuesta",respuesta);
			$(".nuevoProducto").append('<div class="row" style="padding:5px 15px">'+			
				'<div class="col-xs-6" style="padding-right:0px">'+
				'<div class="input-group">'+
					'<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto ><i class="fa fa-times"></i></button></span>'+

				'<select class="form-control nuevaDescripcionProducto" idProducto name="nuevaDescripcionProducto" required>'+
				'<option>Seleccionar el producto</option>'+
				'</select>'+ 

				'</div> <!-- <div class="input-group"> -->'+

				'</div> <!-- <div class="col-xs-6" style="padding-right:0px"> -->'+

				'<!-- Se desplaza a 3 columnas-->'+
				'<div class ="col-xs-3 ingresoCantidad">'+
				'<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value = "1" stock nuevoStock="" required>'+

				'</div> <!-- <div class ="col-xs-3"> -->'+

				'<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+
					'<div class="input-group">'+
					'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
					
					'<input type="text" class="form-control nuevoPrecioProducto" precioReal="" name="nuevoPrecioProducto" readonly required>'+	

				'</div> <!-- <div class="input-group"> -->'+

			'</div> <!-- <div class="col-xs-3" style="padding-left:0px"> -->'+ 
			
			'</div>');
			
			// Agregar los productos al SELECT.
			respuesta.forEach(funcionForEach);
			function funcionForEach(item,index)
			{
				// Para determinar el "stock".
				if(item.stock != 0)
				{
					//$(".nuevaDescripcionProducto").append(
						// Es modificacion se realiza para evitar que se dupliquen los elementos del "select"
						$("#producto"+numProducto).append(
						'<option idProducto="'+items.id+'" value="'+item.descripcion+'">'+item.descripcion+'</option>'
						)
				}
				
			}
			// Para actualizar la suma del Total.
			sumarTotalPrecios();
			agregarImpuesto();

			// Poner formato al precio de los productos.
			$(".nuevoPrecioProducto").number(true,2);


		}
		

	})

})

// Seleccionar un producto, para obtener el precio.
// Cuando cambie de valor un elemento del "select".
$(".formularioVenta").on("change","select.nuevaDescripcionProducto",function(){

	// $(this) = Indica en cual "item" se encuentra en ese momento
	var nombreProducto = $(this).val(); // Obtener el idProducto desde la etiqueta "select"

	// Se sale 3 niveles, etiquetas para poder accesar a la etiqueta que esta anidada "nuevoPrecioProducto", se suben los niveles de las etiquetas para poder llegar.
	var nuevoPrecioProducto = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
	var nuevaCantidadProducto = $(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");
 
	// console.log ("nuevoPrecioProducto",nuevoPrecioProducto);
	
	// Se va agregar el valor del "idProducto"
	var datos = new FormData();
	datos.append("nombreProducto",nombreProducto);
	//console.log("nombreProducto",nombreProducto);

	// Se va utilizar el Ajax para obtener el precio del producto.
	
	$.ajax
	({
		url:"ajax/productos.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,
		processData:false,
		dataType:"json",
		success:function(respuesta){
			//console.log("respuesta",respuesta);
			// Se asignara a las etiquetas de "Existencia" y "Precio el valor obtenido de la sección del Ajax."
			$(nuevaCantidadProducto).attr("stock",respuesta["stock"]); // Asignando valor
			$(nuevaCantidadProducto).attr("nuevoStock",Number(respuesta["stock"])-1); // Asignando valor
			$(nuevoPrecioProducto).val(respuesta["precio_venta"]); // Asignando valor sin repetir a la etiqueta de la pantalla de ventas.
			$(nuevoPrecioProducto).attr("precioReal",respuesta["precio_venta"]); // Se asigna el precio Real, que no se modifique.

			// Agrupar productos en Json.
			listarProductos();

			
		}
	})


})

// Modificar la Cantidad
// El nombre de la clase se aplica es tanto para "Pantalla" y "Tablet"
$(".formularioVenta").on("change", "input.nuevaCantidadProducto",function(){
	// Se sube de nivel, para poder llegar a la etiqueta de Precio.
	var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
	//console.log("precio",precio.val());

	var precioFinal = $(this).val()*precio.attr("precioReal");
	//console.log("$(this).val()",$(this).val());

	precio.val(precioFinal);
	var nuevoStock = Number($(this).attr("stock")) - $(this).val();

	// Se asigna el nuevo stock en la clase : "nuevoStock"
	$(this).attr("nuevoStock",nuevoStock);

	// Para actualizar el "Stock".
	// $(this).val() = Es el valor que se tiene en la venta, cambia en la etiqueta.
	// $(this).attr("stock") = Es lo que se tiene en la base de datos.


	if (Number($(this).val()) > Number($(this).attr("stock")))
	{
		$(this).val(1);

		// Para asignar el valor original cuando no se tenga existencia del producto.
		var precioFinal = $(this).val()*precio.attr("precioReal");
		precio.val(precioFinal);
		sumarTotalPrecios();
		agregarImpuesto();
		// Se agrupan las ventas en formato JSon
		listarProductos();


		Swal.fire ({
			title: "La cantidad supera el Stock",
			text: "Solo hay "+$(this).attr("stock")+"unidades !",				
			icon: "error",
			confirmButtonText: "Cerrar"
		});

	}
	// Sumar total precio
	sumarTotalPrecios();
	agregarImpuesto();
	// Se agrupan las ventas en formato JSon
	listarProductos();
	
})


// Sumar el total de las productos que se van agregando.
function sumarTotalPrecios()
{
	// Proviene de este seccion : $(".formularioVenta").on("change","select.nuevaDescripcionProducto",function(){.........

	var precioItem = $(".nuevoPrecioProducto"); // Almacena todas las clases, es decir son todos los renglones de la venta que se esta realizando.
	var arraySumaPrecio = [];
	 
	for (var i=0;i<precioItem.length; i++)
	{
		arraySumaPrecio.push(Number($(precioItem[i]).val()));

	}
	//console.log("arraySumaPrecio",arraySumaPrecio);
	function sumaArrayPrecios(total,numero)
	{
		return total+numero;
	}

	// Para obtener el precio total de la venta de productos.
	var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);
	//console.log("sumaTotalPrecio",sumaTotalPrecio);
	$("#nuevoTotalVenta").val(sumaTotalPrecio);
	$("#totalVenta").val(sumaTotalPrecio);
	$("#nuevoTotalVenta").attr("total",sumaTotalPrecio);

}

// Agregar Impuesto.
function agregarImpuesto()
{
	// Esta etiqueta se encuentra en la pantalla de captura de ventas.
	// 	<input type="number" class="form-control input-lg" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" placeholder="0" required>																	
	//<span class="input-group-addon"><i class="fa fa-percent"></i></span>
	var impuesto = $("#nuevoImpuestoVenta").val();
	// Obtener el precio total venta.
	var precioTotal = $("#nuevoTotalVenta").attr("total");

	var precioImpuesto = Number(precioTotal*impuesto/100);
	var totalConImpuesto = Number(precioImpuesto)+Number(precioTotal);
	$("#nuevoTotalVenta").val(totalConImpuesto);
	$("#totalVenta").val(totalConImpuesto);

	// se asignan valores a las etiquetas "input" ocultas
	$("#nuevoPrecioImpuesto").val(precioImpuesto);
	$("#nuevoPrecioNeto").val(precioTotal);

}

// Cuando cambia el Impuesto.
// Esta etiqueta se encuentra en la pantalla de captura de ventas.
// 	<input type="number" class="form-control input-lg" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" placeholder="0" required>																	

$("#nuevoImpuestoVenta").change(function(){
	agregarImpuesto();
})

// Poner formato al precio total de la venta.
$("#nuevoTotalVenta").number(true,2);

/*  ========================== */
/*  SELECCIONAR METODO DE PAGO */
/*  ========================== */
$("#nuevoMetodoPago").change(function(){
	var metodo = $(this).val(); // obtiene el "id" del Select.
	if (metodo == "Efectivo")
	{
		// <div class="col-xs-4" style="padding-right:0px">
		$(this).parent().parent().removeClass("col-xs-6");

		//
		$(this).parent().parent().addClass("col-xs-4");
		// 	Para llegar a la etiqueta : <div class="cajasMetodoPago"></div>
		// <div class="input-group"></div>, <div class="col-xs-4" style="padding-right:0px">,<div class="form-group row">.
		$(this).parent().parent().parent().children(".cajasMetodoPago").html(
			'<div class="col-xs-4">'+
				'<div class="input-group">'+
					'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
					'<input type="text" class="form-control" id="nuevoValorEfectivo" placeholder="000000" required>'+
				'</div>'+
			'</div>'+
			'<div class="col-xs-4 capturarCambioEfectivo" style="padding-left:0px">'+
				'<div class="input-group">'+
					'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
					'<input type="text" class="form-control nuevoCambioEfectivo"  name="nuevoCambioEfectivo" placeholder="000000" readonly required>'+
				'</div>'+
			'</div>'
			);

			// Agregar formato al número a la etiqueta de Efectivo.
			$('#nuevoValorEfectivo').number(true,2);
			$('#nuevoCambioEfectivo').number(true,2);
			
			// Para obtener el método de pago, efectivo.
			listarMetodos();
	}
	else  // if (metodo == "Efectivo")
	{
		// Cuando es con pago de Tarjeta Credito ó Débito.
		// <div class="col-xs-4" style="padding-right:0px">
		$(this).parent().parent().removeClass('col-xs-4');
		$(this).parent().parent().addClass("col-xs-6");
		$(this).parent().parent().parent().children('.cajasMetodoPago').html(
			'<div class="col-xs-6" style="padding-left:0px">'+
				'<div class="input-group">'+
					'<input type="text" class="form-control" min="0" id="nuevoCodigoTransaccion" name="nuevoCodigoTransaccion" placeholder="Codigo Transaccion" required>'+
					'<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
				'</div> '+		
			'</div>');

	} // if (metodo == "Efectivo")


})

// Cambio cuando se paga en efectivo.
// Cuando cambio el contenido de la etiqueta "input", es decir cuando el usuario teclea lo que esta pagando el cliente.
$(".formularioVenta").on("change","input#nuevoValorEfectivo",function(){
	//console.log("Cambio de valor ");
	var efectivo = $(this).val();
	var cambio = Number(efectivo)-Number($('#nuevoTotalVenta').val());

	//console.log(cambio);
	// Se sale a dos niveles.
	/*
	'<div class="col-xs-4">'+
	'<div class="input-group">'+
		'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
		'<input type="text" class="form-control nuevoValorEfectivo" placeholder="000000" 		
	*/
	// Se parte de la etiqueta "nuevoValorEfectivo"
	var nuevoCambioEfectivo = $(this).parent().parent().parent().children('.capturarCambioEfectivo').children().children('.nuevoCambioEfectivo');

	nuevoCambioEfectivo.val(cambio);
	console.log(nuevoCambioEfectivo.val());
	//console.log("arraySumaPrecio",arraySumaPrecio);
	
})


// Cambio Transacción , cuando en la etiqueta de "nuevoCodigoTransaccion" sufre un cambio
$(".formularioVenta").on("change","input#nuevoCodigoTransaccion",function(){
	// Listar método en la entrada.
	listarMetodos();
	
})

//=================================================================================
// Agrupar todos los productos de la venta , en un objeto Json.
// ================================================================================
function listarProductos()
{
	var listaProductos = [];
	//var id = 
	// Contiene todas los input que se generan cuando se realiza la venta.
	var descripcion = $(".nuevaDescripcionProducto"); 
	var cantidad = $(".nuevaCantidadProducto");
	var precio = $(".nuevoPrecioProducto");
	//var total  =  
	for (var i=0;i<descripcion.length;i++)
	{
		listaProductos.push({"id":$(descripcion[i]).attr("idProducto"),
													"descripcion":$(descripcion[i]).val(),
													"cantidad":$(cantidad[i]).val(),
													"stock":$(cantidad[i]).attr("nuevoStock"),
													"precio":$(precio[i]).attr("precioReal"),
													"total":$(precio[i]).val()
	});
	}
	// Mostrando el contenido del JSon.
	// Se convierte a formato JSon.
	//console.log("listarProductos",JSON.stringify(listarProductos));

	/* <!-- Para llenar los datos para los productos a guardar en la base de datos. -->
		<input type="hidden" id="listaProductos" name="listaProductos">
	*/
	// Se llena la etiqueta desde JavaScript.
	$("#listaProductos").val(JSON.stringify(listaProductos));

}

// Listar Métodos de Pago
function listarMetodos()
{
	var listaMetodos = "";
	if ($("#nuevoMetodoPago").val() == "Efectivo")
	{
		$("#listaMetodoPago").val("Efectivo");
	}
	else
	{
		// Se graba la forma de pago con Tarjeta Crédito ó Débito mas el código de transacción.
		$("#listaMetodoPago").val($("#nuevoMetodoPago").val()+"-"+$("#nuevoCodigoTransaccion").val());
	}

}

// Se define el boton para editar Venta, se realiza un click izquierdo
// se quita el evento "click" ya que cuando se utiliza tablet o celular, este boton se pierde.
// Pero se agrea el evento desde la clase "tablas"
$(".tablas").on("click",".btnEditarVenta",function(){
	// Obtiene el valor de la variable que se paso por $_GET.
	var idVenta = $(this).attr("idVenta");
	window.location = "index.php?ruta=editar-venta&idVenta="+idVenta;
})

// Se define el boton para eliminar.
// se quita el evento "click" ya que cuando se utiliza tablet o celular, este boton se pierde.
// Pero se agrea el evento desde la clase "tablas"
$(".tablas").on("click",".btnEliminarVenta",function(){
	// Obtiene el valor de la variable que se paso por $_GET.
	var idVenta = $(this).attr("idVenta");

	Swal.fire ({
		title: 'Esta seguro(a) de borrar la venta ?',
		text: 'Si no lo esta puede cancelar la accion',
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar venta ! ',		
		}).then(function(result){
			if (result.value)
			{
				window.location="index.php?ruta=ventas&idVenta="+idVenta;
			}

			});
	
})

// ==================================================================
// IMPRIMIR FACTURA 
// ==================================================================

$(".tablas").on("click",".btnImprimirFactura",function(){
	// Esta variable viene desde el archivo "ventas.php" donde se agrega el atributo de 
	// <button class="btn btn-info btnImprimirFactura" codigoVenta="'.$value["codigo"].'"><i class="fa fa-print"></i></button>
	var codigoVenta = $(this).attr("codigoVenta");
	// Busca este archivos (pdf.php) y abre una página nueva.
	// Para pasarlo como variable "$_GET"
	window.open("extensiones/tcpdf/pdf/factura.php?codigo="+codigoVenta,"_blank");
	// Se tiene que renombrar el archivo que esta en la carpeta de /pdf/image_demo.jpg"
})


// Boton de Rango de Fecha.
$('#daterange-btn').daterangepicker(
	{
		ranges : {
			'Hoy'						: [moment(),moment()],
			'Ayer'				: [moment().subtract(1,'days'),moment().subtract(1,'days')],
			'Ultimos 7 Dias'			: [moment().subtract(6,'days'),moment()],
			'Ultimos 30 Dias'		: [moment().subtract(29,'days'),moment()],
			'Este Mes'			: [moment().startOf('month'),moment().endOf('month')],
			'Ultimo Mes'			: [moment().subtract(1,'month').startOf('month'),moment().subtract(1,'month').endOf('month')] 
		},
		startDate: moment(),
		endDate: moment()
	},
	function (start,end)
	{
		$('#daterange-btn span').html(start.format('MMMM D, YYYY')+' - '+end.format('MMMM D, YYYY'));

		// Obteniendo la fecha inicial
		var fechaInicial = start.format('YYYY-MM-DD');
		 //console.log("fechaInicial",fechaInicial);
		var fechaFinal = end.format('YYYY-MM-DD');
		 //console.log("fechaFinal",fechaFinal);

		var capturarRango = $("#daterange-btn span").html();
		// console.log("Rango Fecha ",capturarRango);
		// Se va enviar por $_GET esta variable, se utilizara "LocalStorage"
		localStorage.setItem("capturarRango",capturarRango);

		// Se va a pasar los datos por $_GET debido a que se maneja el Plugin DataTable, ya que si se utiliza Ajax afectaria.
		// En el archivo "ventas.php" se tiene que capturar estas variables globales.
		window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal


	}
)

// =======================================================================================
// Cancelar Rangos de Fecha
// =======================================================================================
// Es la ubicacion del boton.
// Despues de que haya cargado en el HTML.
$(".daterangepicker.opensleft .range_inputs .cancelBtn").on("click",function(){
	localStorage.removeItem("capturarRango");
	localStorage.clear();
	window.location = "ventas";
})

// ===================================================================
// Capturar la opción HOY desde el menu de "Rangos de Fecha"
// ===================================================================
// Se busca toda la ruta del Boton en el Rango de fecha para capturar el evento "click"
$(".daterangepicker .opensleft .ranges li").on("click",function(){	
	// Se los nombres de clases no se escriben correctamente no muestra nada en el console.log, y no muestra error.
	var textoHoy = $(this).attr("data-range-key");
	if (textoHoy == "Hoy")
	{
		var d = new Date(); // Se va obtener la fecha, desde JavaScript
		//console.log("d",d);

		var dia = d.getDate();
		var mes = d.getMonth()+1;
		var anno = d.getFullYear();

		// En la base de datos se registra la fecha : 2020-09-09, por esta razon se realizan las siguientes condicionales.
		if (mes < 10)
		{
			var fechaInicial = anno+"-0"+mes+"-"+dia;
			var fechaFinal = anno+"-0"+mes+"-"+dia;
		}
		if(dia < 10)
		{
			var fechaInicial = anno+"-"+mes+"-0"+dia;
			var fechaFinal = anno+"-"+mes+"-0"+dia;
		}
		if ((mes < 10) && (dia < 10))
		{
			var fechaInicial = anno+"-0"+mes+"-0"+dia;
			var fechaFinal = anno+"-0"+mes+"-0"+dia;
			var texto = "mes < 10, dia < 10";
		}
		if ((mes > 10) && (dia > 10))
		{
			var fechaInicial = anno+"-"+mes+"-"+dia;
			var fechaFinal = anno+"-"+mes+"-"+dia;	
		}

		localStorage.setItem("capturarRango","Hoy");
		//console.log ("fecha Inicial ",fechaInicial);
		//console.log ("fecha Final ",fechaFinal);
		//console.log("texto ",texto);

		// Se llama a la pantalla para la ventas, asignando los parámetros  de fechas.
		window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

	}
})