<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Inventory System | Blank Page</title>
	<link rel="stylesheet" href="vistas/plugins/sweetalert2/sweetalert2.css">

<!-- SweetAlert 2 -->
<!-- Revisando el funcionamiento .-->
<script src="vistas/plugins/sweetalert2/sweetalert2.js"></script>

</head>
<body>
	<?php 
		echo '<script>
				 Swal.fire({					 
					type: "error",
					title: "El usuario no puede ir vacio o llevar caracteres especiales",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
					}).then((result)=>{
						if (result.value)
						{
							window.location="usuarios";
						}

						});
				 </script>';
		
		?>
</body>

