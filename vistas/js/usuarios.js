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
			console.log("respuesta",respuesta);
			$("#editarNombre").val(respuesta["nombre"]);
			$("#editarUsuario").val(respuesta["usuario"]);
			$("#editarPerfil").html(respuesta["perfil"]); // Es un etiqueta <option>
			$("#passwordActual").val(respuesta["clave"]);
			$("#editarPerfil").val(respuesta["perfil"]); // Para mantener el valor del perfil, cuando no se cambie.
			$("#fotoActual").val(respuesta["foto"]); // Para mantener el valor del perfil, cuando no se cambie.

			if (respuesta["foto"] != "")
			{
				//<img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width = "100px">
				 $(".previsualizar").attr("src",respuesta["foto"]);
			}			 

		}

	}); 

})


