<!-- Es el menu general, se encuentra en la parte Izquierda. Las opciones del menu. -->
<aside class="main-sidebar">
  <section class="sidebar">
    <!-- Despliega los iconos del menu laterial -->
    <ul class="sidebar-menu">
			<?php
				if ($_SESSION["perfil"] == "Administrador")
				{
						echo '
							<li class="active">
								<a href="inicio">
									<i class="fa fa-home"></i>
									<span>Inicio</span>           
								</a>
							</li>

							<!-- Manejando los roles de los usuarios. -->

							<li class="">
								<a href="usuarios">
									<i class="fa fa-user"></i>
									<span>Usuarios</span>           
								</a>
							</li>';
				}

				if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Especial")
				{
					echo ' <!-- Manejando las categorias -->
							<li class="categorias">
								<a href="categorias">
									<i class="fa fa-th"></i>
									<span>Categorias </span>           
								</a>
							</li>

							<!-- Manejando los Productos -->
							<li class="">
								<a href="productos">
									<i class="fa fa-product-hunt"></i>
									<span>Productos</span>           
								</a>
							</li> ';
				} 
				
				if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor")
				{
					echo '<!-- Manejando los Clientes  -->
						<li class="">
							<a href="clientes">
								<i class="fa fa-users"></i>
								<span>Clientes</span>           
							</a>
						</li>';
				}

				if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor")
				{			 
       		echo ' <!-- Permite realizar una botonera en Arbol, para que tenga un menú desplegable 
        -->
						<li class="treeview">
								<a href="#">
									<i class="fa fa-list-ul"></i>
									<span>Ventas</span>
									<span class="pull-right-container">
										<i class="fa fa-angle-left pull-right"></i>
									</span>           
								</a>
				

								<ul class="treeview-menu">
									<li>
										<a href="ventas">
											<i class="fa fa-circle-o"></i>
											<span>Administrar Venta</span>
										</a>
									</li>

									<li>
										<a href="crear-venta">
											<i class="fa fa-circle-o"></i>
											<span>Crear Venta</span>
										</a>
									</li> ';
				}

				if ($_SESSION["perfil"] == "Administrador")
				{
					echo '
						<li>
              <a href="reportes">
                <i class="fa fa-circle-o"></i>
                <span>Reporte De Venta</span>
              </a>
						</li>';
				}


			echo '</ul> <!-- <ul class="treeview-menu"> --> 

				</li> <!-- <li class="treeview"> -->  '
			
			?>

    </ul> <!-- <ul class="sidebar-menu"> -->

  </section>

</aside>