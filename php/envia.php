<?php 
	$destino="eklixoz55@gmail.com";
	$nombre= $_POST["nombre"];
	$correo= $_POST["email"];
	$telefono= $_POST["telefono"];
	$asunto= $_POST["asunto"];
	$mensaje= $_POST["mensaje"];
	$contenido= "Nombre: ". $nombre . "\nCorreo:" . $correo . "\nTelefono:" . $telefono . "\nAsunto" . $asunto . "\nMensaje:" . $mensaje;
	mail($destino, "Contacto", $contenido);
	header("Location:../index.html");


 ?>