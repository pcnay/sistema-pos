<?php
	// Para que no muestre error de acceso ya que se esta accesando a un indece de tipo "2019-02", que debe ser 0,1,2,3,...
	error_reporting(0);

	// Se van a capturar las variables $_GET que viene desde "reportes.js"
	if (isset($_GET["fechaInicial"]))
	{
		
		$fechaInicial = $_GET["fechaInicial"];
		$fechaFinal = $_GET["fechaFinal"];
	}
	else
	{
		$fechaInicial = null;
		$fechaFinal = null;
	}


	// Se obtendran las ventas desde la tabla "t_Ventas"
	$item = null;
	$valor = null;
	//$respuesta = ControladorVentas::ctrMostrarVentas($item, $valor);
	$respuesta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);
	//var_dump($respuesta);
	//exit;

	$arrayFechas = array();
	$arrayVentas = array(); 
	$sumaPagosMes = array();

	foreach ($respuesta as $key => $value)
	{
		// var_dump($value['fecha']);
		// Solo se captura el Año y Mes de la venta.
		// Se elimina la hora y el dia de la fecha que esta guardada en la base de datos.
		//$fecha = substr($value["fecha"],0,10);
		//var_dump($fecha);
		// Para mostrar solo el Año y Mes.
		$fecha = substr($value["fecha"],0,7);
		//var_dump($fecha);
		array_push ($arrayFechas,$fecha);
		// Capturar las ventas., en formato objeto : [{2019-20, 3445},....]
		$arrayVentas = array($fecha => $value["total"]);		
		//var_dump ($arrayVentas);
		# Se suman los pagos que ocurreron en el mes.
		foreach ($arrayVentas as $key => $value)
		{
			$sumaPagosMes[$key] += $value;
		}
	}
	// Se van a igualar las ventas , con la suma de las ventas 

	// var_dump($sumaPagosMes);

	//Para que no se repitan las fechas. Es decir que solo obtenga los meses, ya que se repite, son varias compras.
	$noRepetirFechas = array_unique($arrayFechas);
	//var_dump($noRepetirFechas);


?>

<!-- 
===================================================================
GRAFICO DE VENTAS
================================================================
-->

<!-- Para mostrar la barra de color Azul con el titulo. -->
<div class= "box box-solid bg-teal-gradient">
	<div class="box-header">
		<i class="fa fa-th"></i>
		<h3 class="box-title">Gráficos De Ventas</h3>
	</div>
	<div class="box-body border-radius-none nuevoGraficoVenas">
		<div class="chart" id="line-chart-ventas" style="height:250px;"></div>

	</div>

</div> <!-- class= "box box-solid bg-teal-gradient"> -->

<script>
	var line = new Morris.Line({
		element								: 'line-chart-ventas',
		resize 								: true,
		data 									: [
			<?php
				if ($noRepetirFechas != null)
				{
						foreach($noRepetirFechas as $key)
						{
							echo "{ y: '".$key."', ventas:".$sumaPagosMes[$key]."},";
						}

						echo "{y: '".$key."', ventas: ".$sumaPagosMes[$key]."}";
				}
				else
				{
					echo "{ y: '0', ventas: '0' } ";
				}
					?>

					],
					xkey									: 'y',
					ykeys									: ['ventas'],
					labels								: ['ventas'],
					lineColors						: ['#efefef'],
					lineWidth							: 2,
					hideHover							: 'auto',
					gridTextColor					: '#fff',
					gridStrokeWidth				: 0.4,
					pointSize							: 4,
					pointStrokeColors			: ['#efefef'],
					gridLineColor					: '#efefef',
					gridTextFamily				: 'Open Sans',
					preUnits							:	'$',
					gridTextSize					: 10					
					
	});

</script>