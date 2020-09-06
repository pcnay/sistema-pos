  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Productos
        <small>Panel De Control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar Productos</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        
        <div class="box-header with-border">
          <!-- Abre una ventana Modal, se define en la parte última del documento.-->

          <button class="btn btn-primary"  data-toggle="modal" data-target="#modalAgregarProducto">
            Agregar Producto 
          </button>       
        </div>
 
        <div class="box-body">
          <!-- Cuerpo de la ventana, donde se encuentran los datos, tablas, se utilizara tDAtaTable de Bootstrap esta completa, contiene buscar, paginador, ordenar las columnas  -->
          <!-- Esta clases de "table" son del plugin "bootstrap"-->
          <!-- "tabla" = Es para enlazarlo con DataTable, se utiliza el archivo  /frontend/vistas/js/plantilla.js-->
          <table class="table table-bordered tabe-striped dt-responsive tablas">
            <thead>
              <tr>
                <th style="width:10px">#</th>
                <th>Imagen</th>
                <th>Codigo</th>
                <th>Descripcion</th>
                <th>Categoria</th>
                <th>Stock</th>
                <th>Precio Compra</th>
								<th>Precio Venta</th>
								<th>Agregado</th>
                <th>Acciones </th>
              </tr>
            </thead>
            <!-- Cuerpo de la Tabla -->
            <tbody>
              <tr>
                <td>1</td>
                <td><img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                <td>0001</td>
                <!-- Clase de BootStrap -->
                <td>Descripcion del Producto</td>
                <td>Descripcion Categoria</td>
                <td>20</td>
								<td>156.40</td>
								<td>250.40</td>
                <td>2020-01-11 12:05:32</td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                  </div>
                </td>
              </tr>

              <tr>
                <td>2</td>
                <td><img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                <td>0001</td>
                <!-- Clase de BootStrap -->
                <td>Descripcion del Producto</td>
                <td>Descripcion Categoria</td>
                <td>20</td>
								<td>156.40</td>
								<td>250.40</td>
                <td>2020-01-11 12:05:32</td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                  </div>
                </td>
              </tr>

              <tr>
                <td>3</td>
                <td><img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                <td>0001</td>
                <!-- Clase de BootStrap -->
                <td>Descripcion del Producto</td>
                <td>Descripcion Categoria</td>
                <td>20</td>
								<td>156.40</td>
								<td>250.40</td>
                <td>2020-01-11 12:05:32</td>
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
Cuando el usuario oprima el boton de "Agregar Usuario" se activa esta ventana.
-->

<!-- Modal -->
<div id="modalAgregarProducto" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <!-- enctype= "multipart/form-data = Para subir archivos. -->
      <form role="form" method="post" enctype= "multipart/form-data">
    
        <!-- La franja azul de la ventana modal -->
        <div class="modal-header" style= "background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Producto</h4>
        </div>

				<!-- CUERPO DE LA VENTANA MODAL -->
				<!-- Captura del codigo del producto -->
        <div class="modal-body">
          <div class="box-body">
            <!-- Clases de BootStrap para las formularios-->

						<!-- Capturar el Código -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-code"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoCodigo" placeholder = "Ingresar Codigo" required>
              </div> <!-- <div class = "input-group"> -->           
            </div> <!-- <div class="form-group"> -->

						<!-- Captura de la descripcion del producto -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder = "Ingresar Descripcion" required>
              </div> <!-- <div class = "input-group"> -->           
            </div> <!-- <div class="form-group"> -->

						<!-- Captura de la categoria del producto -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <select class="form-control input-lg" name="nuevaCategoria">
                  <option value="">Seleccionar categoria</option>
                  <option value="Taladros">Taladros</option>
                  <option value="Andamios">Andamios</option>
                  <option value="EquipoConstruccion">EquipoConstruccion</option>
                </select>                
              </div> <!-- <div class = "input-group"> -->           
            </div> <!-- <div class="form-group"> -->

						<!-- Captura del Stock del producto -->
						<!-- Clases de BootStrap para las formularios-->
						<div class="form-group">
							<div class = "input-group">
								<span class="input-group-addon"><i class="fa fa-check"></i></span>
								<!-- min="0" Para que solo permita números positivos. -->
								<input type="number" class="form-control input-lg" name="nuevoStock" min="0"  placeholder = "Ingresar Cantidad" required>
							</div> <!-- <div class = "input-group"> -->           
						</div> <!-- <div class="form-group"> -->



						<!-- Captura de Precio Compra -->
						<!-- Clases de BootStrap para las formularios-->
						<!-- Se realizara un cambio en estos dos campos, colocando uno a lado del otro, además cuando se teclee el precio compra, calcule de forma automática el precio de venta. -->
						<div class="form-group row">

							<div class="col-xs-6">							

								<div class = "input-group">
									<span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
									<!-- min="0" Para que solo permita números positivos. -->
									<input type="number" class="form-control input-lg" name="nuevoPrecioCompra" min="0"  placeholder = "Ingresar Precio Compra" required>
								</div> <!-- <div class = "input-group"> -->

							</div> <!-- 	<div class="col-xs-6">	-->

							<!-- Captura de Precio Venta -->
							<!-- Clases de BootStrap para las formularios-->
							<div class="col-xs-6">							

								<div class = "input-group">
									<span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
									<!-- min="0" Para que solo permita números positivos. -->
									<input type="number" class="form-control input-lg" name="nuevoPrecioVenta" min="0"  placeholder = "Ingresar Precio Venta" required>
								</div> <!-- <div class = "input-group"> -->   
								<br>

								<!-- Checkbox para porcentaje -->
								<div class="col-xs-6">
									<div class="form-group">
										<label>
											<!-- minimal, minimal-red, flat-red se debe activar en el "Plantilla.js"-->
											<input type="checkbox" class = "minimal" checked>
											Utilizar porcentaje
										</label>

									</div> <!-- <div class="form-group"> -->

								</div> <!-- <div class="col-xs-6"> -->

								<!-- Entrada para el porcentaje -->
								<div class= "col-xs-6" style="padding:0">
									<div class="input-group">
										<input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>
										<span class="input-group-addon"><i class="fa fa-percent"></i></span>
									</div> <!-- <div class="input-group"> -->

								</div> <!-- <div class= "col-xs-6"> -->

							</div> <!-- 	<div class="col-xs-6">	-->

						</div> <!-- <div class="form-group"> -->


						<!-- Subir Imagen del producto -->
            <div class="form-group">
              <div class="panel text-up">SUBIR IMAGEN DEL PRODUCTO</div> 
              <input type="file" id="nuevaImagen" name="nuevaImagen">
              <p class="help-block">Peso Máximo de la foto 2 Mb</p>
              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width = "100px">

            </div> <!-- <div class="form-group"> -->

          </div> <!-- <div class="box-body"> -->

        </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Guardar Producto</button>
          </div>

        </form>

    </div> <!-- <div class="modal-content"> -->

  </div> <!-- <div class="modal-dialog"> -->

</div> <!-- <div id="modalAgregarUsuario" class="modal fade" role="dialog"> -->