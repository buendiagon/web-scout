
		<?php 
		// parte para tomar la informacion del formulario y agregarlo a la base datos verificar posible error
			include 'conectarBD_usuarios.php';
			$nombre = $_POST['nombres'];
			$apellido = $_POST['apellidos'];
			$fecha = $_POST['fecha'];
			$correo = $_POST['correo'];
			$documento= $_POST['documento'];
			$documento_padre = $_POST['documento_padre'];
			$celular = $_POST['celular'];
			$direccion = $_POST['direccion'];
			$ocupacion = $_POST['ocupacion'];
			$eps = $_POST['eps'];
			$rh = $_POST['rh'];
			$discapacidad = $_POST['discapacidad'];
			$estado_civil = $_POST['estado_civil'];
			$religion = $_POST['religion'];
			$estudios = $_POST['estudios'];
			$tropas = $_POST['tropas'];


			// mysql_select_db('bd_scout', $conexion);
			$insertar= "INSERT INTO usuarios_scout (nombres,apellidos,fecha,correo,documento,documento_padre,celular,direccion,ocupacion,eps,rh,discapacidad,estado_civil,religion,estudios,tropas) VALUES ('$nombre','$apellido','$fecha','$corre','$documento','$documento_padre','$celular','$direccion','$ocupacion','$eps','$rh','$discapacidad','$estado_civil','$religion','$estudios','$tropas')";
			 $resultado= mysqli_query($conexion, $insertar);
			 if (!$resultado) {
			 	echo 'error al registrar';
			 }
			 else{
			 	echo 'Usuario registrado';
			 }
			 mysql_close($conexion);

		 ?>



