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
					include "inicio/cajas-superiores.php";
				?>
			</div>

			<div class="row">
				<div class="col-lg-12">
					<?php
						include "reportes/graficos-ventas.php";
					?>
				</div>
				<div class="col-lg-6">
					<?php
						include "reportes/productos-mas-vendidos.php";
					?>
				</div>
				<div class="col-lg-6">
					<?php
						include "inicio/productos-recientes.php";
					?>
				</div>



			</div>


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
