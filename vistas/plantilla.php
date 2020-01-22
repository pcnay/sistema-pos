<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Inventory System | Blank Page</title>

  <!-- Plugins de JavaScript -->
  
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="vistas/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="vistas/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- Plugins de JavaScript -->
    <!-- jQuery 3 -->
  <script src="vistas/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="vistas/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="vistas/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="vistas/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="vistas/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <!-- <script src="vistas/dist/js/demo.js"></script> -->
  
</head>

<!-- Cuerpo de Documento -->
<!-- Se agrega "sidebar-collapse" para ocultar  el submenu  del lado izq. donde viene la fato. -->
<body class="hold-transition skin-blue sidebar-collapse sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <?php
    include "modulos/cabezote.php";
    include "modulos/menu.php";
    // Agregando un Contenido temporal para utilizar la pantalla principal.
    // Generando las URL Amigables., cuando se teclea en la barra de direcciones o cuando se seleccione el icono "inicio" o tras rutas.
    if (isset($_GET["ruta"]))
    {
      if ($_GET["ruta"]=="inicio" || $_GET["ruta"]=="usuarios" || $_GET["ruta"]=="categorias" || $_GET["ruta"]=="productos" || $_GET["ruta"]=="clientes"|| $_GET["ruta"]=="ventas" || $_GET["ruta"]=="crear-venta"|| $_GET["ruta"]=="reportes")
      {
        include "modulos/".$_GET["ruta"].".php";
      }



    }

    //include "modulos/contenido.php";
    
    include "modulos/footer.php";
  ?>
</div>  
<!-- ./wrapper -->
<!-- Los archivos de "JavaScript" incian las busquedas desde el directorio raíz.  -->
<script src="vistas/js/plantilla.js"></script>

</body>
</html>
