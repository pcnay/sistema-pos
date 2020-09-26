
<?php
	// El Usuario no puede entrar a Ventas
	if ($_SESSION["perfil"] == "Vendedor")
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
        Administrar Venta
        <small>Panel De Control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar Ventas</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        
        <div class="box-header with-border">
				<!-- Se coloca un enlace para abrir la ventana de "Crear Venta" -->
					<a href="crear-venta">
						<button class="btn btn-primary" >
							Agregar Venta
						</button>       
					</a>

					<!-- Agregando el boton para la captura de rangos de ventas realizadas.-->
					<button type="button" class="btn btn-default pull-right" id="daterange-btn">
						<span>
							<i class="fa fa-calendar"></i>  Rango De Fecha   
						</span>
						<i class="fa fa-caret-down"></i>

					</button>
        </div>
 
        <div class="box-body">				

					<!-- Es la tabla donde se mostrara los datos iniciales para la Venta. -->
          <table class="table table-bordered table-striped dt-responsive tablas">
            <thead>
              <tr>
                <th style="width:10px">#</th>
                <th>Codigo Factura</th>
								<th>Cliente</th>								
								<th>Vendedor</th>
								<th>Forma De Pago</th>
								<th>Neto</th>
								<th>Total</th>
								<th>Fecha</th>
                <th>Acciones</th>
								
              </tr>
            </thead>

            <!-- Cuerpo de la Tabla -->
            <tbody>
							<!-- Se va ha utilizar el quemado de datos en el HTML, dado el volumen de los datos, pero se puede arreglar para que se utilize el "TDataTable"-->

							<?php 
								// Se van a capturar las variables $_GET que viene desde "ventas.js"
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
									echo 
									'<tr>
											<td>'.($key+1).'</td>
											<td>'.$value["codigo"].'</td>';

											// Obteniendo el nombre del cliente, ya que en la tabla de "t_Productos" solo tiene el ID
											$itemCliente = "id";
											$valorCliente = $value["id_cliente"];
											$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente,$valorCliente);

										echo '<td>'.$respuestaCliente["nombre"].'</td>';
											
										// Obteniendo el nombre del vendedor ya que en la tabla de "t_Productos" solo tiene el "id_vendedor"

										$itemUsuario = "id";
										$valorUsuario = $value["id_vendedor"];
										$respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario,$valorUsuario);


										echo '<td>'.$respuestaUsuario["nombre"].'</td>';

										echo '<td>'.$value["metodo_pago"].'</td>
											<td>'.number_format($value["neto"],2).'</td>
											<td>'.number_format($value["total"],2).'</td>
											<td>'.$value["fecha"].'</td>
												<td>
													<div class="btn-group">
														<!-- Imprimir la transacción --> 
														<button class="btn btn-info btnImprimirFactura" codigoVenta="'.$value["codigo"].'"><i class="fa fa-print"></i></button>';
														if ($_SESSION["perfil"] == "Administrador")
														{	
															echo '<button class="btn btn-warning btnEditarVenta" idVenta="'.$value["id"].'"><i class="fa fa-pencil"></i></button>
															<button class="btn btn-danger btnEliminarVenta" idVenta="'.$value["id"].'"><i class="fa fa-times"></i></button>';
														}

													echo '</div>
												</td>
									</tr>';

								}

								//exit;
								//
							?>

            </tbody>

          </table> <!-- <table class="table table-bordered tabe-striped"> -->

					<?php
						// Se coloca aqui para realizar las pruebas.
						$eliminarVenta = new ControladorVentas();
						$eliminarVenta->ctrEliminarVenta();
					?>

        </div> <!-- <div class="box-body"> -->

        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
	//$eliminarVenta = new ControladorVentas();
	//$eliminarVenta->ctrEliminarVenta();
?>


