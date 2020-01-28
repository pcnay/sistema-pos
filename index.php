<?php
/* 
PLANTILLA ADMINLTE:
https://www.adminlte.io/

Es una plantilla especializada en Dash Board, para mostrar contenidos para un sistema informatico, es gratuita.
Esta contruida con: 
+ HTML 5
+ CSS 3
+ BOOTSTRAP 3
+ JQUERY 3
+ JQUERY UI 1.11.4
+ MULTIPLES PLUGINS JAVASCRIPT Y CSS

CARACTERISTICAS:
	No se preocupa por la maquetación web y diseño responsivo
	Se puede trabajar por módulos
	Hay que identificar las clases que ayudan a interpretar la plantilla
	Hay que identificar los plugins (javascript ycss) para reutilizarlos
	Código abierto

	Plug a Utilizar:
	
	Bootstrap (CSS y JavaScript)
	Font Awesome (Iconos)
	Ionicos
	Theme Style AdminLTE
	Skins AdminLTE
	Morris Chart
	Jvectormap
	Data Ranger Picker
	iCheck (Check Box )
	JQuery Knob Chart (Graficos)
	DataTables
	Chart Set
	InputMask (Mascaras de Entradas)
	SweetAlert (Alertas suaves)
	JQuery Number (Formatos numeros, precios)
	AdminLTE App (JavaScript)
	TCPDF (Para imprimir facturas)

	MVC (Modelo - Vista - Controlador)
	Es un tipo de diseño que separa en capas bien definidas el desarrollo de una aplicación.
	Modelo = Encargado en la lógica de la aplicación.
	Controlador = Encargado de gestionar las peticiones del usuario, procesarlas invocando al 
	Modelo y mostrarlas al usuario a través de las Vistas.
	Vistas = Son las responsables de mostrar al usuario el resultado que obtiene del Modelo a travpes del Controlador.
	
	
	Vista (Usuario)
		Vista -> Controlador

	Controlador
		Controlador -> Modelo
			Controlador -> Vistas

	Modelo
		Modelo -> Controlador


		.htaccess = Permite proteger las carpetas y las URL amigables.
	En la carpeta de "Vistas" se copian algunas carpetas de AdminLTE para iniciar con el MVC
	Estas carpetas son:
	* bower-components
	* dist
	* plugins

	De la carpeta "pages/examples/blank.html" a "plantillas.php" que se encuentra en la carpeta de Vistas
	Cuando se agregan las carpetas, muestra "../../" que sube dos niveles
	Se tiene que reemplazar estos "../../" por el nombre de la carpeta "vistas" ya que se encuentran en la misma
	carpeta.

	Los tamaños para visualizarlo en las pantallas son:
	320X494 = Celular
	768X494 = Tablet - Vertical
	1024X494 = Tablet - Horizontal
	1366X494 = Pantalla Laptop en adelante

	Agregando Modulos a la plantilla AdminLTE. "Pantilla.php"
	<!-- Theme style -->
	<link rel="stylesheet" href="vistas/dist/css/AdminLTE.css">
	Se cambian el CSS 

	Se cambian la parte última Jquery3 ... a la parte de arriba.
	
	<!-- Se agrega "sidebar-collapse" para ocultar  el submenu  del lado izq. donde viene la fato. -->
		<body class="hold-transition skin-blue sidebar-collapse sidebar-mini">

	Todos los archivos de AdminLTE, contienen una clase llamada "wrapper" 
	En el archivo "plantilla.php" se hara la siguiente:
	Se iniciara por borrar el contenido del archivo de la etiqueta 
	"<header></header>", 
	"<aside></aside>= Donde se encuentra la columna de botones del lado izq. del menu principal"
	"content - wrapper" = Contiene el cuerpo de la pantalla principal, 


*/ 


<<<<<<< HEAD
=======

>>>>>>> 39ad9c9d6b3063776edd24354f00bfac7e26cd13
require_once "controladores/plantilla.controlador.php";
require_once "controladores/categorias.controlador.php";
require_once "controladores/clientes.controlador.php";
require_once "controladores/productos.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/ventas.controlador.php";

require_once "modelos/categorias.modelo.php";
require_once "modelos/clientes.modelo.php";
require_once "modelos/productos.modelo.php";
require_once "modelos/usuarios.modelo.php";
require_once "modelos/ventas.modelo.php";


$plantilla = new ControladorPlantilla();
$plantilla->ctrPlantilla();


 

