<!-- 
  // Se manejara el menú general del sistema, con las opciones de menu desplegables.
  // Sin modificaciones utilizando los iconos.

-->

<header class= "main-header">
  <!-- Logotipo -->
  <!-- Usando la URL amigable, solo se coloca la palabra "inicio" -->
  <a href= "inicio" class="logo">
    <!-- Logo Mini -->
    <span class="logo-mini">
      <img src="vistas/img/plantilla/icono-blanco.png" class="img-responsive" style="padding:10px" >
    </span>

  <!-- Logo Normal, cuando se oprime el menu(rectangulos apilados) se despleiga la otra imagen -->
    <span class="logo-lg"> 
      <img src="vistas/img/plantilla/logo-blanco-lineal.png" class="img-responsive" style="padding:10px 0px" >
    </span>
  </a>

  <!-- Barra De Navegación Menu desplegable del lado Izq., parte superior Izq.  -->

  <!-- Es la franja Azul del menu general -->
  <nav class="navbar navbar-static-top" role="navigation">

    <!-- Boton de Navegación -->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle Navigation</span>
      </a>

      <!-- Perfil de Usuario,lado superior Derecho  -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

						<?php 
							// Para mostrar la foto del usuario 
							// Este variable global $_SESSION, se definio en "usuarios.controlador.php" cuando el usuario entra al sistema.
							if ($_SESSION["foto"] != "")
							{
								echo '<img src="'.$_SESSION["foto"].'" class="user-image">';
							}
							else
							{
								echo '<img src= "vistas/img/usuarios/default/anonymous.png" class="user-image">'; 	
							}
						?>
              
              <span class="hidden-xs"><?php echo $_SESSION["nombre"]; ?> </span>
            </a>

            <!-- Dropdown-toggle -->
            <ul class="dropdown-menu">
              <li class="user-body">
                <div class="pull-right">
                  <a href="salir"  class="btn btn-default btn-flat">Salir</a>
                </div>
              </li>
            </ul>

          </li>
        </ul>
      </div>
  
  </nav>

</header>
