<?php
	$item = null;
	$valor = null;
	$ventas = ControladorVentas::ctrMostrarVentas($item,$valor);
	$usuarios = ControladorUsuarios::ctrMostrarUsuarios($item,$valor);
	$arrayVendedores = array();
	$arraylistaVendedores = array();

	foreach ($ventas as $key => $valueVentas)
	{
		// Se realiza recorrido con los usuarios
		foreach ($usuarios as $key => $valueUsuarios)
		{
			if ($valueUsuarios["id"] == $valueVentas["id_vendedor"])
			{
				// Se capturan los vendedores.
				array_push($arrayVendedores,$valueUsuarios["nombre"]);

				// Capturar los nombres y los valores netos en un mismo array
				// "Indice" es el nombre del vendedor y el "Valor" es el importe de la compra. 
				// Ejemplo : "Juan" => 100, "pedro" => 300, "ana" => 400, "juan" => 150, etc...
				$arraylistaVendedores = array($valueUsuarios["nombre"] => $valueVentas["neto"]);				 
			}
			// Sumar los importes netos de cada vendedor.
			foreach ($arraylistaVendedores as $key =>$value)
			{
				// Cuando se repita el vendedor le esta sumando el acumulado
				// cuando se repita el vendedor se esta sumando.
				$sumaTotalVendedores[$key] += $value;

			}
		
		} // foreach ($usuarios as $key => $valueUsuarios)

	} // foreach ($ventas as $key => $valueVentas)

	//var_dump($sumaTotalVendedores);
	// Que no se repita nombre dentro del Array
	$noRepetirNombres = array_unique($arrayVendedores);

	//var_dump($noRepetirNombres);

?>

<!-- ================================================
			Obtiene el que mas vende.
		 =================================================
	
	-->
<!-- Este <div class = "box box-success" > -->
<div class = "box box-success">
	<div class="box-header with-border">
		<h3 class="box-title">Vendedores</h3>
	</div>
	
	<div class="box-body">
		<div class="chart-responsive">
			<div class = "chart" id="bar-chart1" style="height: 300px;">

			</div>

		</div> <!-- <div class="chart-responsive"> -->
	 
	</div> <!-- <div class="box-body"> -->

</div> <!-- <div class = "box box-success"> -->

<script>
	
	//BAR CHART
	var bar = new Morris.Bar({
		element: 'bar-chart1',
		resize: true,
		data: [
			<?php
			
				foreach($noRepetirNombres as $value)
				{
					echo "{y: '".$value."', a: '".$sumaTotalVendedores[$value]."'},";
				}
			
			?>

		],
		barColors: ['#0af'],
		xkey: 'y',
		ykeys: ['a'],
		labels: ['VENTAS'],
		preUnits: '$',
		hideHover: 'auto'
	});
	
</script>
