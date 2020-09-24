<?php
	$ventas = ControladorVentas::ctrSumaTotalVentas();
	$item = null;
	$valor = null;
	$categorias = ControladorCategorias::ctrMostrarCategorias($item,$valor);
	// var_dump($categorias);
	$totalCategorias = count($categorias);

	$clientes = ControladorClientes::ctrMostrarClientes($item,$valor);
	$totalClientes = count($clientes);

	$orden = "id";
	$productos = ControladorProductos::ctrMostrarProductos($item,$valor,$orden);
	$totalProductos = count($productos);
	
?>

<div class="row">
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-aqua">
			<div class="inner">
				<h3>$<?php echo number_format($ventas["total"],2); ?></h3>

				<p>Ventas</p>
			</div>
			<div class="icon">
				<i class="ion ion-social-usd"></i>
			</div>
			<a href="ventas" class="small-box-footer">Mas Ventas<i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->

	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-green">
			<div class="inner">
				<h3><?php echo number_format($totalCategorias); ?></h3>

				<p>Categorias</p>
			</div>
			<div class="icon">
				<i class="ion ion-clipboard"></i>
			</div>
			<a href="categorias" class="small-box-footer">Mas info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->

	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-yellow">
			<div class="inner">
				<h3><?php echo number_format($totalClientes); ?></h3>
				<p>Clientes</p>
			</div>
			<div class="icon">
				<i class="ion ion-person-add"></i>
			</div>
			<a href="clientes" class="small-box-footer">Mas info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->

	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-red">
			<div class="inner">
				<h3><?php echo number_format($totalProductos); ?></h3>
				<p>Productos</p>
			</div>
			<div class="icon">
				<i class="ion ion-ios-cast"></i>
			</div>
			<a href="productos" class="small-box-footer">Mas info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->
</div>
<!-- /.row -->
