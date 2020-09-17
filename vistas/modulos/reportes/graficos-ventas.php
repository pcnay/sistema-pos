<?php
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

	// Mostrando los datos en pantalla, se esta quemando enel HTML, no se utiliza DataTable.

	foreach ($respuesta as $key => $value)
	{
		//var_dump($value);
	}

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
			{ y: '2011 Q1', item1:2666},
			{ y: '2011 Q2', item2:2778},
			{ y: '2011 Q3', item1:4912},
			{ y: '2011 Q4', item1:3767},
			{ y: '2012 Q1', item1:6810},
			{ y: '2012 Q2', item1:5670},
			{ y: '2012 Q3', item1:4820},
			{ y: '2012 Q4', item1:5073},
			{ y: '2013 Q1', item1:10587},
			{ y: '2013 Q2', item1:3432},
		],
		xkey									: 'y',
		ykeys									: ['item1'],
		labels								: ['Item 1'],
		lineColors						: ['#efefef'],
		lineWidth							: 2,
		hideHover							: 'auto',
		gridTextColor					: '#fff',
		gridStrokeWidth				: 0.4,
		pointSize							: 4,
		pointStrokeColors			: ['#efefef'],
		gridLineColor					: '#efefef',
		gridTextFamily				: 'Open Sans',
		gridTextSize					: 10
	});
	
</script>