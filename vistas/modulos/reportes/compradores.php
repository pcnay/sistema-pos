<?php
	$item = null;
	$valor = null;
	$ventas = ControladorVentas::ctrMostrarVentas($item,$valor);
	$clientes = ControladorClientes::ctrMostrarClientes($item,$valor);
	$arrayClientes = array();
	$arraylistaClientes = array();

	foreach ($ventas as $key => $valueVentas)
	{
		// Se realiza recorrido con los clientes
		foreach ($clientes as $key => $valueClientes)
		{
			if ($valueClientes["id"] == $valueVentas["id_cliente"])
			{
				// Se capturan los clientes.
				array_push($arrayClientes,$valueClientes["nombre"]);

				// Capturar los nombres y los valores netos en un mismo array
				// "Indice" es el nombre del vendedor y el "Valor" es el importe de la compra. 
				// Ejemplo : "Juan" => 100, "pedro" => 300, "ana" => 400, "juan" => 150, etc...
				$arraylistaClientes = array($valueClientes["nombre"] => $valueVentas["neto"]);				 
			}
			// Sumar los importes netos de cada cliente.
			foreach ($arraylistaClientes as $key =>$value)
			{
				// Cuando se repita el vendedor le esta sumando el acumulado
				// cuando se repita el vendedor se esta sumando.
				$sumaTotalClientes[$key] += $value;

			}
		
		} // foreach ($clientes as $key => $valueUsuarios)

	} // foreach ($ventas as $key => $valueVentas)

	//var_dump($sumaTotalVendedores);
	// Que no se repita nombre dentro del Array
	$noRepetirNombres = array_unique($arrayClientes);

	//var_dump($noRepetirNombres);

?>


<!-- ================================================
			Obtiene el que mas vende.
		 =================================================
	
	-->
<!-- Este <div class = "box box-success" > 
	"box box-primary" = Cambia el color de la linea superior.
-->
<div class = "box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">Compradores</h3>
	</div>
	
	<div class="box-body">
		<div class="chart-responsive">
			<div class = "chart" id="bar-chart2" style="height: 300px;">

			</div>

		</div> <!-- <div class="chart-responsive"> -->
	 
	</div> <!-- <div class="box-body"> -->

</div> <!-- <div class = "box box-success"> -->

<script>
	//BAR CHART
	var bar = new Morris.Bar({
		element: 'bar-chart2',
		resize: true,
		data: [
			<?php
			
				foreach($noRepetirNombres as $value)
				{
					echo "{y: '".$value."', a: '".$sumaTotalClientes[$value]."'},";
				}
		
			?>
		],
		barColors: ['#f6a'],
		xkey: 'y',
		ykeys: ['a'],
		labels: ['COMPRAS'],
		preUnits: '$',
		hideHover: 'auto'
	});
</script>
