
		<?php 
			// conectar la base de datos para el formulario de usuarios
			$conexion= msql_connect("localhost","root","","bd_scout");
			if (!$conexion) {
				echo 'error al conectar';
			}
			else{
				echo 'conectado';
			}
		 ?>



