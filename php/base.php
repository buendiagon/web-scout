<?php
// PHP para controlar las bases de datos del calendario de la página 
require_once('PHPhelp/php/modelo.php');
$myClass=new baseDeDatos('bd_scout');
$array=0;
// consulta para obtener los eventos que haya en un mes determinado
if(isset($_POST['mes'])){
	if($_POST['usuario']=="guest"){
		$sql="select * from eventos where month(fecha)=".$_POST['mes']." and year(fecha)=".$_POST['anno']." and rama='grupo'";
	}
	elseif ($_POST['usuario']=="administrador") {
		$sql="select * from eventos where month(fecha)=".$_POST['mes']." and year(fecha)=".$_POST['anno'];
	}
	else{
		$sql="select * from eventos where (month(fecha)=".$_POST['mes']." and year(fecha)=".$_POST['anno']." and rama='".$_POST['usuario']."') or (month(fecha)=".$_POST['mes']." and year(fecha)=".$_POST['anno']." and rama='grupo')";
	}
	$myClass->sentence($sql,$array);
	echo json_encode($array);
}
// inserta un evento nuevo en la base de datos
if(isset($_POST['event'])){
	if($_POST['event']!==''){
		$date = date( "Y-m-d", strtotime(str_replace("/","-",$_POST['date'])) );
		$sql="INSERT INTO `eventos`(`fecha`, `evento`, `rama`) VALUES ('".$date."','".$_POST['event']."','".$_POST['rama']."')";
		$myClass->sentence($sql);
	}
}
// Elimina un evento de la DB de una fecha determinada
if(isset($_POST['deleteEvent'])){
	$sql="DELETE FROM eventos WHERE fecha='".$_POST['deleteDate']."' AND evento='".$_POST['deleteEvent']."'";
	$myClass->sentence($sql);
}


// PHP para controlar las bases de datos de los usuarios de la página 
$myClass=new baseDeDatos('bd_scout');
$array=0;
session_start();
if(isset($_REQUEST['user'])){
	$sql="SELECT * FROM usuarios where usuario='".$_REQUEST['user']."' AND password=MD5('".$_REQUEST['password']."')";
	$myClass->sentence($sql,$array);
	if(count($array)==1){
		$_SESSION['nombre']=json_encode($array);
	}else{
		$_SESSION['nombre']=json_encode(false);
	}
	header('Location: ../index.html');
}
if(isset($_POST['userFlag'])){
	if(!isset($_SESSION['nombre'])){
		echo json_encode("guest");
	}else{
		if($_SESSION['nombre']==json_encode(false)){
			// session_destroy();
			$_SESSION['nombre']=json_encode("guest");
			if($_POST['userFlag']==1){
				echo json_encode(false);
			}else if($_POST['userFlag']==2){
				echo $_SESSION['nombre'];
			}
		}else{
			echo $_SESSION['nombre'];
		}
		if($_POST['userFlag']==3){
			session_destroy();
		}
	}
}


// PHP para controlar el contenido dinámico de la página
$myClass=new baseDeDatos('bd_scout');
$array=0;
if(isset($_POST['id'])){
	$sql="SELECT * FROM `contenido` WHERE tipo='".$_POST['id']."' ORDER by fecha DESC LIMIT 3";
	$myClass->sentence($sql,$array);
	echo json_encode($array);
}
if(isset($_POST['timeLine'])){
	$timeLine=$_POST['timeLine'];
	$sql="SELECT * FROM contenido WHERE tipo='$timeLine' ORDER BY fecha ASC";
	$myClass->sentence($sql,$array);
	// str_replace($array," ","");	
	echo json_encode($array);
	
	// $myClass->debug(json_encode($array[0]));
	// $myClass->debug(json_encode($json));

}
if(isset($_POST['btn_time'])){
    $uploadOk = 1;
    $path="null";
    $return="../time_line.html";
    echo $_FILES["imagenTime"]["name"];
	if(isset($_FILES["imagenTime"]["tmp_name"])){
		$target_dir = "../imagenes/contenido/";
	    $target_file = $target_dir . basename($_FILES["imagenTime"]["name"]);
	    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	    if(isset($_FILES["imagenTime"]["tmp_name"])){
	        $check = getimagesize($_FILES["imagenTime"]["tmp_name"]);
	        if($check !== false) {
	            echo "File is an image - " . $check["mime"] . ".";
	            $uploadOk = 1;
	        } else {
	            echo "File is not an image.";
	            echo'<script type="text/javascript">
	            alert("Error este archivo no se puede subir al servidor");
	            window.location.href="'.$return.'";
	            </script>';
	            $uploadOk = 0;
	        }

	    // Check if file already exists
	        if (file_exists($target_file)) {
	            echo "Sorry, file already exists.";
	            $myClass->debug($target_file);
	            echo'<script type="text/javascript">
	            alert("Error el archivo ya existe");
	            window.location.href="'.$return.'";
	            </script>';
	            $uploadOk = 0;
	        }
	    // Check file size
	        if ($_FILES["imagenTime"]["size"] > 500000) {
	            $maxDim = 800;
				$file_name = $_FILES['imagenTime']['tmp_name'];
				list($width, $height, $type, $attr) = getimagesize( $file_name );
				if ( $width > $maxDim || $height > $maxDim ) {
				    $target_filename = $file_name;
				    $ratio = $width/$height;
				    if( $ratio > 1) {
				        $new_width = $maxDim;
				        $new_height = $maxDim/$ratio;
				    } else {
				        $new_width = $maxDim*$ratio;
				        $new_height = $maxDim;
				    }
				    $src = imagecreatefromstring( file_get_contents( $file_name ) );
				    $dst = imagecreatetruecolor( $new_width, $new_height );
				    imagecopyresampled( $dst, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
				    imagedestroy( $src );
				    imagepng( $dst, $target_filename ); // adjust format as needed
				    imagedestroy( $dst );
				}
	        }
	    // Allow certain file formats
	        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	            && $imageFileType != "gif" ) {
	            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	        $myClass->debug("not allowed");
	        echo'<script type="text/javascript">
	            alert("Error tipo de archivo no permitido");
	            window.location.href="'.$return.'";
	            </script>';
	        $uploadOk = 0;
	        }
	    // Check if $uploadOk is set to 0 by an error
	        if ($uploadOk == 0) {
	            echo "Sorry, your file was not uploaded.";
	            $myClass->debug("no upload");
	    // if everything is ok, try to upload file
	        } else {
	            if (move_uploaded_file($_FILES["imagenTime"]["tmp_name"], $target_file)) {
	                echo "The file ". basename( $_FILES["imagenTime"]["name"]). " has been uploaded.";
	                $path="imagenes/contenido/".$_FILES["imagenTime"]["name"];
	                $myClass->debug("nice");
	            } else {
	                echo "Sorry, there was an error uploading your file.";
	                $myClass->debug("error uploading");
	                $upload = 0;
	            }
	        }
	    }
	}else{
		echo "bad doesn't exists";
	}
    if($uploadOk==1){
		$titulo=$_POST['tituloTime'];
		$texto=$_POST['texto'];
		$fecha=$_POST['fecha'];
		$sql="INSERT INTO contenido(titulo,texto,imagen,fecha,tipo) VALUES ('$titulo','$texto','$path','$fecha','TimeLine')";
		$myClass->sentence($sql);
		header('Location: '.$return);	   
    }
}
?>