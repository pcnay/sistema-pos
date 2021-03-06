<?php
	// Solo puede accesar "Administrador", "Ventas" 
	if ($_SESSION["perfil"] == "Especial")
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
        Crear Ventas        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Crear Ventas</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
			<div class="row">

				<!-- Se devide en dos partes la pantalla, para regitrar los productos, y la otra para seleccionar los productos. -->
				
				<!-- Es la sección del Formulario, es para responsive, varias pantallas  -->
				<div class = "col-lg-5 col-xs-12">
					
					<!-- Muestra una línea hasta la mitad de la pantalla -->
					<div class="box box-success">
						<!-- Dibuja una franja blanca en la parte de arriba. -->
						<div class="box-header with-border "></div>
						<form role="form" method="post" class="formularioVenta">

							<div class="box-body">

										<div class="box">
											<!-- Es la captura del vendedor -->
											<div class="form-group">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-user"></i></span>
													<input type="text" class="form-control" id="nuevoVendedor" name ="nuevoVendedor" value = "<?php echo $_SESSION["nombre"]; ?>" readonly >						
													<input type="hidden" name="idVendedor" value = "<?php echo $_SESSION["id"]; ?>" >						
												</div>

											</div> <!-- <div class="form-group">-->	

											<!-- Muestra el número de Venta -->
											<div class="form-group">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-key"></i></span>
													<?php 
														$item = null;
														$valor = null;
														$ventas = ControladorVentas::ctrMostrarVentas($item,$valor);
														//var_dump($ventas);
														
														// Para obtener el número de factura y agregar 1 
														if (!$ventas)
														{
															echo '<input type="text" class="form-control" id="nuevaVenta" name ="nuevaVenta" value = "10000" readonly>';
														}
														else
														{
															foreach ($ventas as $key => $value)
															{
																//var_dump($value["codigo"]);
																// Se deja en blanco para recorrerlo 
															}

															$codigo = $value["codigo"]+1;
															//print_r($codigo);
															echo '<input type="text" class="form-control" id="nuevaVenta" name ="nuevaVenta" value = "'.$codigo.'" readonly>';	
														}
													?>
													
												</div>

											</div> <!-- <div class="form-group">-->	

											<!-- Agregar Cliente -->
											<div class="form-group">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-users"></i></span>

													<!-- Se obtendra el clientes desde la base de datos y es asignado a una etiqueta Select. -->
													<select class="form-control" id="seleccionarCliente" name ="seleccionarCliente" required>
														<option value="">Seleccionar Cliente</option>
														<?php
															// Obtener los clientes desde la base de datos utilizando 
															$item = null;
															$valor = null;
															$cliente = ControladorClientes::ctrMostrarClientes($item,$valor);
															
															// Pasando los clientes a la etiqueta "Select".
															foreach ($cliente as $key => $value)
															{
																echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';

															}
														?>

													</select>

													<span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar Cliente</button></span>
												</div>								

											</div> <!-- <div class="form-group"> -->


											<!-- Agregar Productos en la captura de la Factura 
												Para esta pantalla se utilizara Javascript 
											-->										
											<div class= "form-group row nuevoProducto">

											</div> <!-- <div class= "form-group row nuevoProducto"> -->

											<!-- Para llenar los datos para los productos a guardar en la base de datos. -->
											<input type="hidden" id="listaProductos" name="listaProductos">
											
											<!-- Boton para Agregar Producto, solo se habilitara cuando sean pantallas pequeñas, cuando son grandes desaparece, ya que se agregan de la pantalla Derecha.
											Esta clase "btnAgregarProducto" se utiliza para dispositivos mobiles.
											-->
											
											<button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar Producto</button>

											<hr>
											<div class= "row" >
												<!-- Para pantallas de 8 columnas-->
												<div class="col-xs-8 pull-right">
													<table class="table">
														<thead>
															<tr>
																<th>Impuestos</th>
																<th>Total</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td style="width: 50%">
																	<div class="input-group">																	
																		<input type="number" class="form-control input-lg" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" placeholder="0" required>			

																		<!-- Se utiliza para poder guardarlo en la base de datos.-->
																		<input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" required>
																		<input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" required>

																		<span class="input-group-addon"><i class="fa fa-percent"></i></span>
																	</div>																
																</td>

																<td style="width: 50%">
																	<div class="input-group">
																		<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
																		<input type="text" class="form-control input-lg" min="0" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" placeholder="000000" readonly required>	
																		<!-- -Se agrega este campo oculto para poder grabarlo en la tablas -->
																		<input type="hidden" name="totalVenta" id="totalVenta">															
																	</div>
																</td>
															</tr>
															
														</tbody>

													</table>

												</div> <!-- <div class="col-xs-8 pull-right"> -->

											</div> <!-- <div class="row" -->

											<hr>

											<!-- Captura la forma de Pago.-->
											<div class="form-group row">
												<div class="col-xs-4" style="padding-right:0px">
													<div class="input-group">
														<select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
															<option value="">Seleccione el método de pago</option>
															<option value="Efectivo">Efectivo</option>
															<option value="TC">Tarjeta Crédito</option>
															<option value="TD">Tarjeta Débito</option>
														</select>

													</div> <!-- <div class="input-group"> -->											
												
												</div> <!-- <div class="col-xs-4"> -->

												<!-- Para desplegar las opciones de pagos.
													Esta clase se agregan etiquetas desde JavaScript
												-->
												<div class="cajasMetodoPago"></div>
 												
												<!-- Este valor se manda atraves del "form" para poder usarlo desde JavaScript y poder asignar valores. -->
												<input type="hidden" name="listaMetodoPago" id="listaMetodoPago">
												
												<br>

											</div> <!-- <div class="form-group row"> -->

										</div> <!-- <div class="box"> -->
	

								</div> <!-- <div class="box-body"> -->
							</div> <!-- <div class="box box-success"> -->
							
							<div class="box-footer">						
								<button type="submit" class="btn btn-primary pull-right">Guardar Venta</button>
							</div> <!-- <div class="box-footer"> -->

						</form>

						<!-- Se utiliza para guardar la venta en la tabla de Ventas  -->
						<?php 
							$guardarVenta = new ControladorVentas();
							$guardarVenta->ctrCrearVenta();
							
						?>


				</div> <!-- <div class = "col-lg-5 col-xs-12"> -->


					<!-- Tablas de Productos 
						Para pantalla grandes se mostraran dos pantallas, para poder seleccionar.
						Para tablets en forma horizontal, esta tabla se ocultara.
					-->
					<!-- Para solo se muestra para pantalla grande, los demas tamaños : medianas, pequeñas, y telefonos, se ocultaran.-->
					<div class="col-lg-7 hidden-md hidden-sm bidden-xs">
						<!-- Muestra una línea hasta la mitad de la pantalla -->
						<div class="box box-warning">
							<div class="box-header with-border">
								<div class="box-body">
								<!-- "tablaVentas" = Es la que se utiliza para DataTable, se utiliza en el archivo "ventas.js" -->
									<table class="table table-bordered table-striped dt-responsive tablaVentas">
										<thead>
											<tr>
												<th style="width:10px">#</th>
												<th>Imagen</th>
												<th>Código</th>
												<th>Descripcion</th>
												<th>Stock</th>
												<th>Acciones</th>												
											</tr>
										</thead>

										<!-- Se trabaja con tablas dinamicas con DataTable - Como se utilizo en "Mostrar Productos", se elimina el Tbody  se crea en el archivo de "ventas.js" -->

									</table>
								</div>
							
							</div>

						</div>

					</div>



			</div> <!-- <div class="row"> -->

    </section>

  </div> <!-- <div class="content-wrapper"> -->



<!--Este código se tomo desde el bootstrap - > Table 
Cuando el cliente el boton de "Agregar Cliente" se activa esta ventana.
-->

<!-- Modal -->
<div id="modalAgregarCliente" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <!-- enctype= "multipart/form-data = Para subir archivos., se suprime -->
      <form role="form" method="post" class="formularioVenta">
    
        <!-- La franja azul de la ventana modal -->
        <div class="modal-header" style= "background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Cliente</h4>
        </div>


        <div class="modal-body">
          <div class="box-body">
            <!-- Clases de BootStrap para las formularios-->
						<!-- Capturando el Nombre -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder = "Ingresar Nombre" required>
              </div> <!-- <div class = "input-group"> -->           

            </div> <!-- <div class="form-group"> -->

						<!-- Capturando el Documento ID -->
						<!-- "min=0" es para que no se introduzcan cantidades Negativas.-->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="number" min="0" class="form-control input-lg" name="nuevoDocumentoId" placeholder = "Ingresar Documento ID " required>
              </div> <!-- <div class = "input-group"> -->           

            </div> <!-- <div class="form-group"> -->

						<!-- Capturando el Email -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder = "Ingresar Email" required>
              </div> <!-- <div class = "input-group"> -->           

            </div> <!-- <div class="form-group"> -->

						<!-- Capturando el Teléfono -->
						<!-- data-inputmask="'mask':'... = Es un plugin de AdminLT para revisar que se requiere.-->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder = "Ingresar Telefono" data-inputmask="'mask':'(999) 999-99-99)'" data-mask required>
              </div> <!-- <div class = "input-group"> -->           

            </div> <!-- <div class="form-group"> -->

						<!-- Capturando la dirección -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder = "Ingresar Direccion" required>
              </div> <!-- <div class = "input-group"> -->           

            </div> <!-- <div class="form-group"> -->

						<!-- Capturando la fecha de Cumpleanos -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" class="form-control input-lg" name="nuevaFechaNacimiento" placeholder = "Ingresar Fecha Nacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>
              </div> <!-- <div class = "input-group"> -->           

            </div> <!-- <div class="form-group"> -->

          </div> <!-- <div class="box-body"> -->

        </div> <!-- <div class="modal-body"> -->


					<!-- Pie Del Modal-->
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Guardar Cliente</button>
          </div>

      </form>
			<!-- Crear un cliente -->
			<?php
				$crearCliente = new ControladorClientes();
				$crearCliente->ctrCrearCliente();

			?>

    </div> <!-- <div class="modal-content"> -->

  </div> <!-- <div class="modal-dialog"> -->

</div> <!-- <div id="modalAgregarUsuario" class="modal fade" role="dialog"> --> 
