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
			{y: 'Roberto', a: 5000},
			{y: 'Bertha', a: 17500},
			{y: 'Eliot', a: 25000},
			{y: 'Alfonzo', a: 35000}
		],
		barColors: ['#f6a'],
		xkey: 'y',
		ykeys: ['a'],
		labels: ['VENTAS'],
		preUnits: '$',
		hideHover: 'auto'
	});
</script>
