<?php
	class TablaProductos
	{
		// Mostrar la tabla de productos.
		public function mostrarTablaProductos()
		{
			 echo '{
				"data": 
				[
					[
						"1",
						"vistas/img/productos/101/105.png",
						"101",
						"Aspiradora Industrial",
						"Taladros", 
						"30",
						"$ 50",
						"$ 80",
						"2020-03-07 05:32:01",
						"botones"
					],
					[
						"2",
						"vistas/img/productos/101/105.png",
						"102",
						"Plato Flotante para Allanadora",
						"Taladros reforzados",
						"20",
						"$ 100",
						"$ 120", 
						"2020-03-07 05:32:01",
						"botones"
					]
				]
			}';
		} // public function mostrarTablaProductos()

	} // class TablaProductos

	// Activar la tabla de productos.
	$activarProductos = new TablaProductos();
	$activarProductos->mostrarTablaProductos();


?>