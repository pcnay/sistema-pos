  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Inicio
        <small>Panel De Control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Tablero</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

			<!-- Separa nuevo renglon para insertar los gráficos. -->
			<div class="row">
				<?php
					if ($_SESSION["perfil"] == "Administrador")
					{
						include "inicio/cajas-superiores.php";
					}
				?>
			</div>

			<div class="row">
				<div class="col-lg-12">
					<?php
						if ($_SESSION["perfil"] == "Administrador")
						{
							include "reportes/graficos-ventas.php";
						}
					?>
				</div>
				<div class="col-lg-6">
					<?php
						if ($_SESSION["perfil"] == "Administrador")
						{
							include "reportes/productos-mas-vendidos.php";
						}
					?>
				</div>
				<div class="col-lg-6">
					<?php
						if ($_SESSION["perfil"] == "Administrador")
						{
							include "inicio/productos-recientes.php";
						}
					?>
				</div>
				<div class="col-lg-12">
					<?php
						if ($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor")
						{
							echo '
								<div class="box box-success">
									<div class = "box-header">
										<h1>Bienvenid@ '.$_SESSION["nombre"].'</h1>
									</div>
								</div>';
						}
					?>
				 </div> <!-- <div class="col-lg-12"> -->		
			</div>


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
