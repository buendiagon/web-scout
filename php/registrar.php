
		<?php 
		// parte para tomar la informacion del formulario y agregarlo a la base datos verificar posible error
			// include 'cn.php';
		require_once('base.php');
			$conexion= mysqli_connect("localhost","root","","bd_scout");
			if($conexion===false){
				die("ERROR: No pudo conectarse con la DB. " . mysqli_connect_error());
			}
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
			$poblacion=$_POST['poblacion'];
			$estudios = $_POST['estudios'];
			$tropas = $_POST['rama'];



			// mysql_select_db('bd_scout', $conexion);
			$actualizar= "UPDATE usuarios SET nombres='".$nombre."',apellidos='".$apellido."', fecha_nacimiento='".$fecha."', email='".$correo."',documento_padre='".$documento_padre."',celular='".$celular."',direccion='".$direccion."',ocupacion='".$ocupacion."',EPS='".$eps."',RH='".$rh."', discapacidad='".$discapacidad."',estado_civil='".$estado_civil."',religion='".$religion."', poblacion='".$poblacion."',estudios='".$estudios."',nivel='".$tropas."' WHERE documento='".$documento."'";
			 $resultado= mysqli_query($conexion, $actualizar);
			 if (!$resultado) {
			 	echo 'error al registrar';
			 }
			 else{
			 	updateSession($documento);

			 }
			 header("Location:../form_usuario.html");
			 mysqli_close($conexion);

		 ?>



 