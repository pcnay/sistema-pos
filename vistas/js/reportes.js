 
// Variables Local Storage, para el boton que se encuentra en "Administrar Ventas" permanezca la fecha.
if (localStorage.getItem("capturarRango2") != null)
{
	// Se va asignar en boton donde despliega el rango seleccionado.
	$("#daterange-btn2 span").html(localStorage.getItem("capturarRango2"));	
}
else
{
	$("#daterange-btn2 span").html('<i class="fa fa-calendar"></i>Rango De Fecha');
}

// =============================================================
// Boton de Rango de Fecha.
// =============================================================
// Por la razon de que se agrega al final el archivo "reportes.js"
//	<!-- se muestra los productos en el modulo Crear Venta  -->
//	<script src="vistas/js/ventas.js"></script>
//	<!-- Es para los reportes que se utilizaran en el sistema  -->
//	<script src="vistas/js/reportes.js"></script>
// El funcionamiento de las clases es afectado , este archivo "reportes.js" altera el funcionamiento


$('#daterange-btn2').daterangepicker(
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
		$('#daterange-btn2 span').html(start.format('MMMM D, YYYY')+' - '+end.format('MMMM D, YYYY'));

		// Obteniendo la fecha inicial
		var fechaInicial = start.format('YYYY-MM-DD');
		 //console.log("fechaInicial",fechaInicial);
		var fechaFinal = end.format('YYYY-MM-DD');
		 //console.log("fechaFinal",fechaFinal);

		var capturarRango = $("#daterange-btn2 span").html();
		// console.log("Rango Fecha ",capturarRango);
		// Se va enviar por $_GET esta variable, se utilizara "LocalStorage"
		localStorage.setItem("capturarRango2",capturarRango);

		// Se va a pasar los datos por $_GET debido a que se maneja el Plugin DataTable, ya que si se utiliza Ajax afectaria.
		// En el archivo "ventas.php" se tiene que capturar estas variables globales.
		window.location = "index.php?ruta=reportes&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal

	}
)


// =======================================================================================
// Cancelar Rangos de Fecha
// =======================================================================================
// Es la ubicacion del boton.
// Despues de que haya cargado en el HTML.
$(".daterangepicker.opensright .range_inputs .cancelBtn").on("click",function(){
	localStorage.removeItem("capturarRango2");
	localStorage.clear();
	window.location = "reportes";
})

// ===================================================================
// Capturar la opción HOY desde el menu de "Rangos de Fecha"
// ===================================================================
// Se busca toda la ruta del Boton en el Rango de fecha para capturar el evento "click"
$(".daterangepicker.opensright .ranges li").on("click",function(){	
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

		localStorage.setItem("capturarRango2","Hoy");
		//console.log ("fecha Inicial ",fechaInicial);
		//console.log ("fecha Final ",fechaFinal);
		//console.log("texto ",texto);

		// Se llama a la pantalla para la ventas, asignando los parámetros  de fechas.
		window.location = "index.php?ruta=reportes&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

	}
})



