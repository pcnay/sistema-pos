<?php
	// https://programacion.net/articulo/importar_un_archivo_csv_a_mysql_utilizando_php_1882
	require_once("db_connect.php")
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Inventory System | Blank Page</title>

			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
	<div class="panel panel-default">
	<div class="panel-body">
	<br>
	<div class="row">
	<form action="import.php" method="post" enctype="multipart/form-data" id="import_form">
	<div class="col-md-3">
	<input type="file" name="file" />
	</div>
	<div class="col-md-5">
	<input type="submit" class="btn btn-primary" name="import_data" value="IMPORT">
	</div>
	</form>
	</div>
	<br>
	<div class="row">
	<table class="table table-bordered">
	<thead>
	<tr>
	<th>Id</th>
	<th>Id_categoria</th>
	<th>codigo</th>
	<th>descripcion</th>
	<th>imagen</th>
	<th>stock</th>
	<th>precio_compra</th>
	<th>precio_venta</th>
	<th>venta</th>
	<th>fecha</th>
	</tr>
	</thead>
	<tbody>
	<?php
		$sql = "SELECT id, id_categoria, codigo, descripcion, imagen, stock, precio_compra,  precio_venta,ventas,fecha FROM t_Productos ORDER BY descripcion DESC";
		$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
		if(mysqli_num_rows($resultset)) {
		while( $rows = mysqli_fetch_assoc($resultset) )
		 {
			?>
				<tr>
				<td><?php echo $rows['id']; ?></td>
				<td><?php echo $rows['id_categoria']; ?></td>
				<td><?php echo $rows['codigo']; ?></td>
				<td><?php echo $rows['descripcion']; ?></td>
				<td><?php echo $rows['imagen']; ?></td>
				<td><?php echo $rows['stock']; ?></td>
				<td><?php echo $rows['precio_compra']; ?></td>
				<td><?php echo $rows['precio_venta']; ?></td>
				<td><?php echo $rows['ventas']; ?></td>
				<td><?php echo $rows['fecha']; ?></td>
				</tr>
			<?php } }
			 else { ?>
		<tr><td colspan="5">No records to display.....</td></tr>
		<?php } ?>
		</tbody>

	</table>

	</div>
	</div>
	</div>
	</div>
</body>
