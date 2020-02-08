// Se agrega la foto del usuario., viene desde el formulario de captura (vistas/modulos/usuarios.php)
$(".nuevaFoto").change(function(){
  var imagen = this.files[0]; // propiedad de la etiqueta "File" de JavaScript
  //console.log("imagen",imagen);

  // Validando que el formato de la imagen sea JPE o PNG
  if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png")
  {
    $(".nuevaFoto").val("");
      Swal.fire ({
        title: "Error al subir la imagen",
        text: "La imagen debe estar en formato JPG o PNG",
        icon: "error",
        confirmButtonText: "Cerrar"
      });
  }
  
  else if (imagen["size"] > 2000000) // 2 Mb
  {
    $(".nuevaFoto").val("");
      Swal.fire ({
        title: "Error al subir la imagen",
        text: "La imagen no debe pesar mas de 2 MB.",
        icon: "error",
        confirmButtonText: "Cerrar"
      });
  }
  else
  {
    var datosImagen = new FileReader;
    datosImagen.readAsDataURL(imagen);
    
    $(datosImagen).on("load",function(event){
      var rutaImagen = event.target.result;
      // Se muestra la imagen en la pantalla, cuando se sube.
      $(".previsualizar").attr("src",rutaImagen);
    })
  }


})

/* Editar Usuario*/

$(".btnEditarUsuario").click(function (){
	/* <button class="btn btn-warning btnEditarUsuario" idUsuario="'.$value["id "] .'" data-toggle="modal"  */
	var identifUsuario=$(this).attr("idUsuario");
	// console.log(idUsuario);
	// Obtener los datos desde la base de datos.
	var datos = new FormData();
	// idUsuario = Variable POST
	datos.append("idUsuario",identifUsuario);

	$.ajax({
		url:"ajax/usuarios.ajax.php",
		method:"POST",
		data: datos,
		cache:false,
		contentType:false,
		processData:false,
		dataType:"json",
		success:function(respuesta)
		{
			//console.log("respuesta",respuesta);
			$("#editarNombre").val(respuesta["nombre"]);
			$("#editarUsuario").val(respuesta["usuario"]);
			$("#editarPerfil").html(respuesta["perfil"]); // Es un etiqueta <option>
			$("#editarPerfil").val(respuesta["perfil"]); // Para mantener el valor del perfil, cuando no se cambie.			
			$("#passwordActual").val(respuesta["clave"]);
			$("#fotoActual").val(respuesta["foto"]); // Para mantener el valor del perfil, cuando no se cambie.

			if (respuesta["foto"] != "")
			{
				//<img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width = "100px">
				 $(".previsualizar").attr("src",respuesta["foto"]);
			}			 

		}

	}); 

})

/* 	ACTIVAR EL USUARIO, 
echo ' <td><button class="btn btn-success btn-xs btnActivar" idUsuario="'.$value["id"].'" estadoUsuario="0" >Activado</button></td>';
*/

$(".btnActivar").click(function(){
	var idUsuario = $(this).attr("idUsuario");
	var estadoUsuario = $(this).attr("estadoUsuario");

	// Usando Ajax Hara la actualizacion para la base de datos.
	var datos = new FormData();

	// Estos valores se pasan como parametros POST["activarId"], POST["activarUsuario"]  para "usuarios.ajax.php"
	datos.append("activarId",idUsuario);
	datos.append("activarUsuario",estadoUsuario);

	$.ajax({
		url:"ajax/usuarios.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,
		processData:false,
		success:function(respuesta){
			 
		}
	})

	// Cambiando el color del boton, una vez que se haya actualizado en la base de datos.
	if(estadoUsuario == 0)
	{
		$(this).removeClass('btn-success');
		$(this).addClass('btn-danger');
		$(this).html('Desactivado');
		$(this).attr('estadoUsuario',1);
	}
	else
	{
		$(this).addClass('btn-success');
		$(this).removeClass('btn-danger');
		$(this).html('Activado');
		$(this).attr('estadoUsuario',0);
	}
})
