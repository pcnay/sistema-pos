  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Editar Ventas        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Editar Ventas</li>
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
								<?php
									$item = "id";
									$valor = $_GET["idVenta"];	// Esta variable viene por window.location = "index.php?ruta=editar-venta&idVenta="+idVenta; de "ventas.js"

									// Va extraer la venta que se va editar.							
									$venta = ControladorVentas::ctrMostrarVentas($item,$valor);
									//var_dump($venta["codigo"]);

									// Obteniendo los datos del vendedor.
									$itemUsuario = "id";
									$valorUsuario = $venta["id_vendedor"];
									$vendedor = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario,$valorUsuario);						

									// Obteniendo los datos del cliente
									$itemCliente = "id";
									$valorCliente = $venta["id_cliente"];
									$cliente = ControladorClientes::ctrMostrarClientes($itemCliente,$valorCliente);

									$porcentajeImpuesto = ($venta["impuesto"]*100)/$venta["neto"];

								?>

										<div class="box">
											<!-- Es la captura del vendedor -->
											<div class="form-group">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-user"></i></span>
													<input type="text" class="form-control" id="nuevoVendedor" name ="nuevoVendedor" value = "<?php echo $vendedor["nombre"]; ?>" readonly >						
													<input type="hidden" name="idVendedor" id = "idVendedor" value = "<?php echo $vendedor["id"]; ?>" >						
												</div>

											</div> <!-- <div class="form-group">-->	

											<!-- Muestra el número de Venta -->
											<div class="form-group">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-key"></i></span>
													<input type="text" class="form-control" id="editarVenta" name ="editarVenta" value = "<?php echo $venta["codigo"]; ?>" readonly>	
													
												</div>

											</div> <!-- <div class="form-group">-->	

											<!-- Agregar Cliente -->
											<div class="form-group">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-users"></i></span>

													<!-- Se obtendra el clientes desde la base de datos y es asignado a una etiqueta Select. -->
													<select class="form-control" id="seleccionarCliente" name ="seleccionarCliente" required>
														<option value="<?php echo $cliente["id"]; ?>"><?php echo $cliente["nombre"]; ?></option>
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
												<?php
													$listaProducto = json_decode($venta["productos"],true);
													//var_dump($listaProducto);
													
													// Mostrara el contenido de los productos que se le vendieron al cliente.

													foreach ($listaProducto as $key => $value)
													{
														// Obtener el stock de (los) articulo(s)
														$item = "id";
														$valor = $value["id"];
														$orden = "";
														$respuesta = ControladorProductos::ctrMostrarProductos($item,$valor,$orden);
														// $respuesta["stock"] = Stock Producto
														// $value["cantidad"] = Es un campo del jSon de Producto, es decir es la cantidad que se esta vendiendo al cliente.
														$stockAntiguo = $respuesta["stock"]+$value["cantidad"];

														// Despliega el contenido de la venta.
														echo 
															'<div class="row" style="padding:5px 15px">			
																<div class="col-xs-6" style="padding-right:0px">
																	<div class="input-group">
																		<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto = "'.$value["id"].'"><i class="fa fa-times"></i></button></span>
										
																		<input type="text" class="form-control nuevaDescripcionProducto" idProducto="'.$value["id"].'" name="agregarProducto" value="'.$value["descripcion"].'"  readonly required>
										
																	</div> <!-- <div class="input-group"> -->
										
																</div> <!-- <div class="col-xs-6" style="padding-right:0px"> -->
										
																<!-- Se desplaza a 3 columnas-->
																<!-- Cantidad Del Producto-->
																<div class ="col-xs-3">
																	<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value = "'.$value["cantidad"].'" stock="'.$stockAntiguo.'" nuevoStock="'.$value["stock"].'" required>
										
																</div> <!-- <div class ="col-xs-3"> -->
										
																<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">
																	<div class="input-group">
																		<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
															
																		<input type="text" class="form-control nuevoPrecioProducto" precioReal="'.$respuesta["precio_venta"].'" name="nuevoPrecioProducto"  value="'.$value["total"].'" readonly required>
										
																	</div> <!-- <div class="input-group"> -->
										
																</div> <!-- <div class="col-xs-3" style="padding-left:0px"> -->
													
															</div> <!-- <div class="row" style="padding:5px 15px"> -->' ;
													}																								

												?>
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
																		<input type="number" class="form-control input-lg" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" value ="<?php echo $porcentajeImpuesto; ?>" required>			

																		<!-- Se utiliza para poder guardarlo en la base de datos.-->
																		<input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" value = "<?php echo $venta["impuesto"]; ?>" required>
																		<input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" value = "<?php echo $venta["neto"]; ?> " required>

																		<span class="input-group-addon"><i class="fa fa-percent"></i></span>
																	</div>																
																</td>

																<td style="width: 50%">
																	<div class="input-group">
																		<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
																		<!-- Se agrega $venta["neto"] para el calculo correcto del importe con IVA modificado -->
																		<input type="text" class="form-control input-lg" min="0" id="nuevoTotalVenta" name="nuevoTotalVenta" total="<?php echo $venta["neto"]; ?>" value = "<?php echo $venta["total"]; ?>" readonly required>	
																		<!-- -Se agrega este campo oculto para poder grabarlo en la tablas -->
																		<input type="hidden" name="totalVenta" value = "<?php echo $venta["total"]; ?>" id="totalVenta">															
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
								<button type="submit" class="btn btn-primary pull-right">Guardar Cambios</button>
							</div> <!-- <div class="box-footer"> -->

						</form>

						<!-- Se utiliza para Editar la venta en la tabla de Ventas, como no se define accion en el "form" se ejecuta de forma secuencial por esta razon que se coloca la etiqueta de "php"						
						  -->
						<?php 
							 $editarVenta = new ControladorVentas();
							 $editarVenta->ctrEditarVenta();							
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



