  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Usuarios
        <small>Panel De Control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar Usuarios</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        
        <div class="box-header with-border">
          <!-- Abre una ventana Modal, se define en la parte última del documento.-->

          <button class="btn btn-primary"  data-toggle="modal" data-target="#modalAgregarUsuario">
            Agregar Usuario
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
                <th>Usuario</th>
                <th>Foto</th>
                <th>Perfil</th>
                <th>Estado</th>
                <th>Ultimo Login</th>
                <th>Acciones </th>
              </tr>
            </thead>

            <!-- Cuerpo de la Tabla, se desplegara desde la base de datos.  -->
            <tbody>
							<?php
								// Obtener los datos desde la base de datos.
								// Estos valores lo requiere el MdlMostrarUsarios(......)
								$item = null;
								$valor = null;

								$usuarios = ControladorUsuarios::ctrMostrarUsuarios($item,$valor);
								// var_dump($usuarios);
								// Como se utiliza "Bootstrap" con solo colocar las etiquetas de HTML5, automaticamente las centra en pantalla, utilizando las pantallas Responsive
								foreach ($usuarios as $key => $value)
								{
									// var_dump($value["nombre"]);
									echo '<tr>
											<td>'.$value["id"].'</td>
											<td>'.$value["nombre"].'</td>
											<td>'.$value["usuario"].'</td>
											<!-- Clase de BootStrap -->';
											
											if ($value["foto"] != "")
											{
												echo '<td><img src="'.$value["foto"].'" class="ing-thumbnail" width="40px"></td>
												';
											}
											else
											{
												echo '<td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>';
											}

											echo '<td>'.$value["perfil"].'</td>';
											
											//  != 0, El estado es activado.
											if ($value["estado"] != 0)
											{
												// Se va a definir una clase "btnActivar" para activar el usuario. El funcionamiento se define en "usuario.js", se agrega el "idUsuario"
												echo ' <td><button class="btn btn-success btn-xs btnActivar" idUsuario="'.$value["id"].'" estadoUsuario="0" >Activado</button></td>';
											}
											else
											{
												echo ' <td><button class="btn btn-danger btn-xs btnActivar" idUsuario="'.$value["id"].'" estadoUsuario= "1">Desactivado</button></td>';
											}											

											echo '<td>'.$value["ultimo_login"].'</td>
											<td>
												<div class="btn-group">
													<!-- Para utilizar una ventana de tipo modal, "data-toggle"= Para activar ventana Modal; "data-target=#modalEditarUsario" = Se indica en donde se activara la ventana esta
													 "#modalEditarUsuario" se define mas adelante en el archivo., btnEditarUsuario, idUsuario= ... Se utiliza Javascript para utilizar AJAX y conectarse a la base de datos, en el archivo "usuario.js", en este archivo se crea un evento $(".btnEditarUsuario").click... -->
													
													<button class="btn btn-warning btnEditarUsuario" idUsuario="'.$value["id"].'" data-toggle="modal" data-target= "#modalEditarUsuario" ><i class="fa fa-pencil"></i></button>
													<button class="btn btn-danger"><i class="fa fa-times"></i></button>
												</div>
											</td>
								</tr> ';

								} // foreach ($usuarios as $key => $value)


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
Cuando el usuario oprima el boton de "Agregar Usuario" se activa esta ventana.
-->

<!-- Modal -->
<div id="modalAgregarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <!-- enctype= "multipart/form-data = Para subir archivos. -->
      <form role="form" method="post" enctype= "multipart/form-data">
    
        <!-- La franja azul de la ventana modal -->
        <div class="modal-header" style= "background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Usuario</h4>
        </div>


        <div class="modal-body">
          <div class="box-body">
            <!-- Clases de BootStrap para las formularios-->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder = "Ingresar Nombre" required>
              </div> <!-- <div class = "input-group"> -->           
            </div> <!-- <div class="form-group"> -->

            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoUsuario" placeholder = "Ingresar Usuario" required>
              </div> <!-- <div class = "input-group"> -->           
            </div> <!-- <div class="form-group"> -->

            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control input-lg" name="nuevoPassword" placeholder = "Ingresar Contraseña" 
								required>
								
              </div> <!-- <div class = "input-group"> -->           
            </div> <!-- <div class="form-group"> -->

            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="nuevoPerfil">
                  <option value="">Seleccionar perfil</option>
                  <option value="Administrador">Administrador</option>
                  <option value="Especial">Especial</option>
                  <option value="Vendedor">Vendedor</option>
                </select>                
              </div> <!-- <div class = "input-group"> -->           
            </div> <!-- <div class="form-group"> -->

            <div class="form-group">
              <div class="panel text-up">SUBIR FOTO</div> 
							<!-- class = "nuevaFoto" : Es un codigo de JavaScript para subir las fotos al sistema.-->
              <input type="file" class="nuevaFoto" name="nuevaFoto">
              <p class="help-block">Peso Máximo de la foto 2 Mb</p>
              <!-- previsualizar = para reemplazar la foto que se va a subir-->
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width = "100px">

            </div> <!-- <div class="form-group"> -->

          </div> <!-- <div class="box-body"> -->

        </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Guardar Usuarios</button>
          </div>
						<!-- Cuando pasa el boton "Submit" ejecuta esta Objeto para Guardar la información del Usuario, pero antes se validan los campos.-->
            <?php 
              $crearUsuario = new ControladorUsuarios();
              $crearUsuario->ctrCrearUsuario();
            ?>
        </form>

    </div> <!-- <div class="modal-content"> -->

  </div> <!-- <div class="modal-dialog"> -->

</div> <!-- <div id="modalAgregarUsuario" class="modal fade" role="dialog"> -->


<!-- ============================================================================================= -->

<!--Este código se tomo desde el bootstrap - > Table 
Cuando el usuario oprima el boton de "Editar" (Lapiz)  se activa esta ventana.
-->

<!-- Modal -->
<div id="modalEditarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <!-- enctype= "multipart/form-data = Para subir archivos. -->
      <form role="form" method="post" enctype= "multipart/form-data">
    
        <!-- La franja azul de la ventana modal -->
        <div class="modal-header" style= "background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Usuario</h4>
        </div>

				<!-- Se deja vacio el atributo "value" este se llenara con JavaScript-->
        <div class="modal-body">
          <div class="box-body">
            <!-- Clases de BootStrap para las formularios-->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
								<!-- id="editarNombre : Para asignarle valor de la base de datos desde JavaScript.-->
                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value = " " required>
              </div> <!-- <div class = "input-group"> -->           
            </div> <!-- <div class="form-group"> -->

            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
								<!-- Se coloca "readonly" porque no se podrá modificar, solo es mostrado -->
                <input type="text" class="form-control input-lg" id = "editarUsuario" name ="editarUsuario" value = " " readonly>
              </div> <!-- <div class = "input-group"> -->           
            </div> <!-- <div class="form-group"> -->

            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control input-lg" name="editarPassword" placeholder = "Escriba una nueva contraseña" >
								<!-- Se coloca este tipo de "input", ya que para relizar la accion de UPDATE, se tiene que agregar todos los campos., por si la clave no se modifica se manda como tipo "hidden"-->
								<input type="hidden" id="passwordActual" name="passwordActual" >

              </div> <!-- <div class = "input-group"> -->           
            </div> <!-- <div class="form-group"> -->

            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="editarPerfil">
									<!-- id= "editarPerfil" para que desde JavaScript se modifique el que tiene el usuario .-->
                  <option value=""  id="editarPerfil"></option>
                  <option value="Administrador">Administrador</option>
                  <option value="Especial">Especial</option>
                  <option value="Vendedor">Vendedor</option>
                </select>                
              </div> <!-- <div class = "input-group"> -->           
            </div> <!-- <div class="form-group"> -->

            <div class="form-group">
              <div class="panel text-up">SUBIR FOTO</div> 
							<!-- class = "nuevaFoto" : Es un codigo de JavaScript para subir las fotos al sistema.-->
              <input type="file" class="nuevaFoto" name="editarFoto" id="editarFoto">
              <p class="help-block">Peso Máximo de la foto 2 Mb</p>
              <!-- previsualizar = para reemplazar la foto que se va a subir-->
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width = "100px">
							<!-- Se utiliza este tipo de "input" para dejar el valor si el usuario no modifica la foto -->
							<input type="hidden" name="fotoActual" id="fotoActual">

            </div> <!-- <div class="form-group"> -->

          </div> <!-- <div class="box-body"> -->

        </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Actualizar Usuarios</button>
          </div>
					
           <?php 
              $editarUsuario = new ControladorUsuarios();
              $editarUsuario->ctrEditarUsuario();
            ?> 

        </form>

    </div> <!-- <div class="modal-content"> -->

  </div> <!-- <div class="modal-dialog"> -->

</div> <!-- <div id="modalAgregarUsuario" class="modal fade" role="dialog"> -->