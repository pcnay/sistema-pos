<?php
	// Solo el administrador puede entrar a Reportes
	// Se realiza para que no entren desde la URL de la barra de direcciones
	if ($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor" )
	{
		echo '
			<script>
				window.location = "inicio";
			</script>';
			return;			
	}
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Reportes
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="Inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Reportes</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
					<div class="input-group">
						<!-- Agregando el boton para la captura de rangos de ventas realizadas.-->
						<button type="button" class="btn btn-default" id="daterange-btn2">
							<span>
								<i class="fa fa-calendar"></i>  Rango De Fecha   
							</span>
							<i class="fa fa-caret-down"></i>
						</button>
					</div>

					<!-- El boton para exportar a Excel -->
          <div class="box-tools pull-right">
						<?php
							if (isset($_GET["fechaInicial"]))
							{
								echo '<a href="vistas/modulos/descargar-reporte.php?reporte=reporte&fechaInicial='.$_GET["fechaInicial"].'&fechaFinal='.$_GET["fechaFinal"].'">';
							}
							else
							{
								echo '<a href="vistas/modulos/descargar-reporte.php?reporte=reporte">';
							}							
						?>
						
							<button class="btn btn-success" style="margin-top:5px">Descargar Reporte En Excel</button>
						</a>
					</div>

        </div>
        <div class="box-body">
					<!-- Se inicia el codigo para los gráficos que se utilizan en los reportes. -->
					<div class="row">
						<!-- Se utiliza para dispositivos grandes -->
						<div class="col-xs-12">
							<?php
								include "reportes/graficos-ventas.php";
							?>
						</div>

						<!-- Se utiliza para el gráfico de pastel. 
							Pantalla para dispositivo mobiles y tablet vertical 
						-->
						<div class="col-md-6 col-xs-12">
							<?php
								include "reportes/productos-mas-vendidos.php";
							?>							
						</div>

						<!-- Se utiliza para el gráfico de Barras, el que mas vende. (quien vende mas)
							Pantalla para dispositivo mobiles y tablet vertical 
						-->
						<div class="col-md-6 col-xs-12">
							<?php
								include "reportes/vendedores.php";
							?>							
						</div>

						<!-- Se utiliza para el gráfico de Barras, para los compradores (quien compra mas).
							Pantalla para dispositivo mobiles y tablet vertical 
						-->
						<div class="col-md-6 col-xs-12">
							<?php
								include "reportes/compradores.php";
							?>							
						</div>

					</div>
        </div>
        <!-- /.box-body -->

      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
