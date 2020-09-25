  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Clientes
        <small>Panel De Control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar Clientes</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        
        <div class="box-header with-border">
          <!-- Abre una ventana Modal, se define en la parte última del documento.-->

          <button class="btn btn-primary"  data-toggle="modal" data-target="#modalAgregarCliente">
            Agregar Cliente 
          </button>       
        </div>
 
        <div class="box-body">
          <!-- Cuerpo de la ventana, donde se encuentran los datos, tablas, se utilizara tDAtaTable de Bootstrap esta completa, contiene buscar, paginador, ordenar las columnas  -->
          <!-- Esta clases de "table" son del plugin "bootstrap"-->
          <!-- "tabla" = Es para enlazarlo con DataTable, se utiliza el archivo  /frontend/vistas/js/plantilla.js-->
          <table class="table table-bordered table-striped dt-responsive tablas">
            <thead>
              <tr>
                <th style="width:10px">#</th>
                <th>Nombre</th>
								<th>Documento ID</th>								
								<th>Email</th>
								<th>Telefonos</th>
								<th>Direccion</th>
								<th>Fecha Nacimiento</th>
								<th>Total Compras</th>
								<th>Ultima Compras</th>
								<th>Ultimo Ingreso</th>
                <th>Acciones </th>
								
              </tr>
            </thead>
            <!-- Cuerpo de la Tabla -->
            <tbody>
							<!-- Se va ha utilizar el quemado de datos en el HTML, dado el volumen de los datos, pero se puede arreglar para que se utilize el "TDataTable"-->
							<?php 
								// Para mostrar los datos en pantalla.
								$item = null;
								$valor = null;
								$clientes = ControladorClientes::ctrMostrarClientes($item,$valor);
								// var_dump ($clientes);
								foreach ($clientes as $key => $value)
								{
									echo ' 
										<tr>
											<td>'.($key+1).'</td>
											<td>'.$value["nombre"].'</td>
											<td>'.$value["documento"].'</td>
											<td>'.$value["email"].'</td>
											<td>'.$value["telefono"].'</td>
											<td>'.$value["direccion"].'</td>
											<td>'.$value["fecha_nacimiento"].'</td>
											<td>'.$value["compras"].'</td>
											<td>'.$value["ultima_compra"].'</td>
											<td>'.$value["fecha"].'</td>
			
											<td>
												<div class="btn-group">
													<button class="btn btn-warning btnEditarCliente" data-toggle="modal" data-target="#modalEditarCliente" idCliente="'.$value["id"].'"><i class="fa fa-pencil"></i></button>';
													if ($_SESSION["perfil"] == "Administrador")
													{
														echo ' <button class="btn btn-danger btnEliminarCliente" idCliente="'.$value["id"].'"><i class="fa fa-times"></i></button>';
													}
													echo '</div>
													
											</td>
										</tr>	';
								}

							?>
              
            </tbody>

          </table> <!-- <table class="table table-bordered tabe-striped"> -->

        </div> <!-- <div class="box-body"> -->

        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<!--Este código se tomo desde el bootstrap - > Table 
Cuando el cliente el boton de "Agregar Cliente" se activa esta ventana.
-->

<!-- Modal -->
<div id="modalAgregarCliente" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <!-- enctype= "multipart/form-data = Para subir archivos., se suprime -->
      <form role="form" method="post">
    
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


<!--Este código se tomo desde el bootstrap - > Table 
Cuando el cliente el boton de "Editar Cliente" se activa esta ventana.
-->

<!-- Modal -->
<div id="modalEditarCliente" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <!-- enctype= "multipart/form-data = Para subir archivos., se suprime -->
      <form role="form" method="post">
    
        <!-- La franja azul de la ventana modal -->
        <div class="modal-header" style= "background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Cliente</h4>
        </div>

        <div class="modal-body">
          <div class="box-body">
            <!-- Clases de BootStrap para las formularios-->
						<!-- Capturando el Nombre -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="editarCliente" id="editarCliente" required>
								<!-- Este campo se utiliza para obtener el "ID" del cliente que se enviara para obtener los datos en el Ajax. -->
								<input type="hidden" id="idCliente" name="idCliente" >

              </div> <!-- <div class = "input-group"> -->           

            </div> <!-- <div class="form-group"> -->

						<!-- Capturando el Documento ID -->
						<!-- "min=0" es para que no se introduzcan cantidades Negativas.-->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="number" min="0" class="form-control input-lg" name="editarDocumentoId" id="editarDocumentoId"  required>
              </div> <!-- <div class = "input-group"> -->           

            </div> <!-- <div class="form-group"> -->

						<!-- Capturando el Email -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="email" class="form-control input-lg" name="editarEmail" 	 	id="editarEmail"  required>
              </div> <!-- <div class = "input-group"> -->           

            </div> <!-- <div class="form-group"> -->

						<!-- Capturando el Teléfono -->
						<!-- data-inputmask="'mask':'... = Es un plugin de AdminLT para revisar que se requiere.-->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input type="text" class="form-control input-lg" name="editarTelefono" id="editarTelefono" data-inputmask="'mask':'(999) 999-99-99)'" data-mask required>
              </div> <!-- <div class = "input-group"> -->           

            </div> <!-- <div class="form-group"> -->

						<!-- Capturando la dirección -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                <input type="text" class="form-control input-lg" name="editarDireccion" id="editarDireccion" required>
              </div> <!-- <div class = "input-group"> -->           

            </div> <!-- <div class="form-group"> -->

						<!-- Capturando la fecha de Cumpleanos -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" class="form-control input-lg" name="editarFechaNacimiento" id="editarFechaNacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>
              </div> <!-- <div class = "input-group"> -->           

            </div> <!-- <div class="form-group"> -->

          </div> <!-- <div class="box-body"> -->

        </div> <!-- <div class="modal-body"> -->


					<!-- Pie Del Modal-->
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
          </div>

      </form>

			<!-- una vez que los campos son tecleados se encuentan estas funciones para Editar Cliente  -->
			<?php
				$crearCliente = new ControladorClientes();
				$crearCliente->ctrEditarCliente();
			?>

    </div> <!-- <div class="modal-content"> -->

  </div> <!-- <div class="modal-dialog"> -->

</div> <!-- <div id="modalAgregarUsuario" class="modal fade" role="dialog"> --> 
<?php
	// Para borrar un cliente.
	$eliminarCliente = new ControladorClientes();
	$eliminarCliente->ctrEliminarCliente();

?>