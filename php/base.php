<?php
// PHP para controlar las bases de datos del calendario de la página 
require_once('PHPhelp/php/modelo.php');
$myClass=new baseDeDatos('bd_fecha');
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
?>



<?php 
// PHP para controlar las bases de datos de los usuarios de la página 
require_once('PHPhelp/php/modelo.php');
$myClass=new baseDeDatos('bd_usuarios');
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
			session_destroy();
			echo json_encode("guest");
		}else{
			echo $_SESSION['nombre'];
		}
		if($_POST['userFlag']==2){
			session_destroy();
		}
	}
}
?>






<?php 
// PHP para controlar el contenido dinámico de la página
require_once('PHPhelp/php/modelo.php');
$myClass=new baseDeDatos('bd_contenido');
$array=0;
if(isset($_POST['id'])){
	$sql="select * from contenido where id='".$_POST['id']."'";
	$myClass->sentence($sql,$array);
	echo json_encode($array);
}

?>