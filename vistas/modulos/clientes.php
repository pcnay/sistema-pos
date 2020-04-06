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
              <tr>
                <td>1</td>
                <td>Juan Perez</td>
                <td>92829832</td>
								<td>correo@correo.com</td>
								<td>555-555-55-55</td>
								<td>Direccion entre calles</td>
								<td>2000-10-10</td>
								<td>30</td>
								<td>2000-10-10 13:34:23</td>
								<td>2020-10-10 15:34:23</td>

								<td>
                  <div class="btn-group">
                    <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                  </div>
                </td>
              </tr>

              <tr>
                <td>2</td>
                <td>Juan Perez</td>
                <td>92829832</td>
								<td>correo@correo.com</td>
								<td>555-555-55-55</td>
								<td>Direccion entre calles</td>
								<td>2000-10-10</td>
								<td>30</td>
								<td>2000-10-10 13:34:23</td>
								<td>2020-10-10 15:34:23</td>

								<td>
                  <div class="btn-group">
                    <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                  </div>
                </td>
              </tr>

              <tr>
                <td>3</td>
                <td>Juan Perez</td>
                <td>92829832</td>
								<td>correo@correo.com</td>
								<td>555-555-55-55</td>
								<td>Direccion entre calles</td>
								<td>2000-10-10</td>
								<td>30</td>
								<td>2000-10-10 13:34:23</td>
								<td>2020-10-10 15:34:23</td>

								<td>
                  <div class="btn-group">
                    <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                  </div>
                </td>
              </tr>
              
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
Cuando el usuario oprima el boton de "Agregar Cliente" se activa esta ventana.
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

    </div> <!-- <div class="modal-content"> -->

  </div> <!-- <div class="modal-dialog"> -->

</div> <!-- <div id="modalAgregarUsuario" class="modal fade" role="dialog"> --> 