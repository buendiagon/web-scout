<?php
// inclucion de los documentos php de la vista y el modelo
require_once ('modelo.php');
require_once ('vista.php');
//variable que permite el control de la funcion acceso (en vista.php)
$accesos = 0;
//variable que controla los campos de edicion en un registro
$edicion = array();
//verificaion del llamado a request['action'] que trata sobre las acciones sobre la base de datos como tal
//en todos los request recibimos como parte del form el nombre de la base de datos para que nos permita mantener la integridad de nuestro objeto "baseDeDatos"
if (isset($_REQUEST['action'])) {
    $myClass = new baseDeDatos($_REQUEST['nombreBD']);
    try {
        switch ($_REQUEST['action']) {
            case 'crear':
                //en caso de que el request reciba la accion "crear" se llama a la funcion "createDB" de nuestro objeto y se espera un retorno para comprobar si la acción se realizo sin ningun problema
            if ($myClass->createDB()) {
                echo "la accion se realizo de manera exitosa";
                header('Location: index.php?nombreBD=' . $_REQUEST["nombreBD"] . '&action=acceder');
            } else {
                echo "Error al realizar la operaci&oacute;n";
            }
            break;
            case 'eliminar':
                //en caso de que el request sea eliminar, se llama a la funcion deleteDB y transcurre igual que en el request de crear
            if ($myClass->deleteDB()) {
                echo "la accion se realizo de manera exitosa";
            } else {
                echo "Error al realizar la operaci&oacute;n";
            }
            break;
            case 'acceder':
                //en el caso de acceder primero se comprueba de que la base de datos exista previamente antes de mostrar la vista "acceso"
            $array = "";
            $sql = 'SELECT COUNT(*) FROM information_schema.schemata where SCHEMA_NAME="' . $_REQUEST["nombreBD"] . '"';
            $myClass->sentence($sql, $array);
            if ($array[0][0] == 1) {
                acceso();
            } else {
                $accesos=1;
                echo "La base de datos no existe</br>";
            }
            break;
            default:
            $myClass->debug("nothing");
            break;
        }
    }
    catch(Exception $e) {
        die($e->getMessage());
    }
}
//verificacion de la accion "actionTuple" que se usa para todas las acciones que tienen que ver con los registros de una tabla (crear,editar,eliminar)
if (isset($_REQUEST['actionTuple'])) {
    $myClass = new baseDeDatos($_REQUEST['nombreBD']);
    try {
        switch ($_REQUEST['actionTuple']) {
            case 'eliminar':
                //en el caso de eliminar se obtiene un arreglo del form llamado ids que contiene todas las llaves primarias que contenga la tabla en donde se encuentra el registro a eliminar
            $id = unserialize(urldecode(stripslashes($_GET['ids'])));
            if ($myClass->deleteTuple($_REQUEST['nombreTable'], $id)) {
                echo "la accion se realizo de manera exitosa";
            } else {
                echo "Error al realizar la operaci&oacute;n";
            }
                //al finalizar la accion se redirige automaticamente al inicio para notar los cambios
            header('Location: index.php?nombreBD=' . $_REQUEST["nombreBD"] . '&action=acceder');
            break;
            case 'editar':
                //en el caso de editar cambiamos la variable global edicion para que se llene con los datos del campo que se va a editar, lo hacemos llamando a la funcion editTable que devuelve un array con los datos de el registro
            $id = unserialize(urldecode(stripslashes($_GET['ids'])));
            $array = $myClass->editTable($_REQUEST['tableName'], $id);
            for ($i = 0;$i < (count($array, 1) - count($array)) / count($array);$i++) {
                $edicion[$i] = $array[0][$i];
            }
            $tableName = $_REQUEST['tableName'];
            acceso();
            break;
            case 'agregar':


            $target_dir = "../../imagenes/contenido/";
            $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            if(isset($_FILES["imagen"]["tmp_name"])){
                $check = getimagesize($_FILES["imagen"]["tmp_name"]);
                if($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    echo'<script type="text/javascript">
                    alert("Error el archivo no se puede subir al servidor");
                    window.location.href="index.php";
                    </script>';
                    $uploadOk = 0;
                }

            // Check if file already exists
                if (file_exists($target_file)) {
                    echo "Sorry, file already exists.";
                    $myClass->debug($target_file);
                    echo'<script type="text/javascript">
                    alert("Error el archivo ya existe");
                    window.location.href="index.php";
                    </script>';
                    $uploadOk = 0;
                }
            // Check file size
                if ($_FILES["imagen"]["size"] > 500000) {
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
                    window.location.href="index.php";
                    </script>';
                $uploadOk = 0;
                }
            // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                    $myClass->debug("no upload");
            // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
                        echo "The file ". basename( $_FILES["imagen"]["name"]). " has been uploaded.";
                        $myClass->debug("nice");
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                        $myClass->debug("error uploading");
                        $upload = 0;
                    }
                }
            }

                // agregar recibe los datos de la vista y los organiza para enviarlos a la funcion fillTable
            $array = "";
            $sql = 'show COLUMNS from ' . $_REQUEST['tableName'];
            $err = $myClass->sentence($sql, $array);
            if ($err != false && $uploadOk==1) {
                $data = "";
                for ($i = 0;$i < count($array);$i++) {
                    $datos=$_REQUEST[$array[$i][0]];
                    if($array[$i][0]=="imagen"){
                        $datos="imagenes/contenido/".$_FILES['imagen']['name'];
                    }
                    if ($i == count($array) - 1) {
                        if(strpos($_REQUEST[$array[$i][0]],"MD5")!==false){
                            $data1 = $$datos;
                        }else{
                            $data1 = "'" . $datos . "'";
                        }
                        $data.= $data1;
                    } else {
                        if(strpos($_REQUEST[$array[$i][0]],"MD5")!==false){
                            $data1 = $datos;
                        }else{
                            $data1 = "'" . $datos . "'";
                        }
                        $data.= $data1 . ",";
                    }
                    $myClass->debug($datos);
                }
                $err = $myClass->fillTable($_REQUEST['tableName'], $data);
                if ($err) {
                        // se reenvia a el index para abservar los cambios en la tabla
                    echo '<meta http-equiv="Refresh" content=0;url="index.php?nombreBD=' . $_REQUEST["nombreBD"] . '&action=acceder">';
                }
            } else {
                echo "Error al realizar la operaci&oacute;n";
                echo'<script type="text/javascript">
                    alert("Error al realizar la operación");
                    window.location.href="index.php";
                    </script>';
            }
            break;
            default:
            $myClass->debug("nothing");
            break;
        }
    }
    catch(Exception $e) {
        die($e->getMessage());
    }
}
//verificacion de la accion "crearTables" que se encarga de las acciones referentes a la creacion de las tablas
if (isset($_REQUEST['crearTables'])) {
    $myClass = new baseDeDatos($_REQUEST['nombreBD']);
    try {
        switch ($_REQUEST['crearTables']) {
            case 'agregar':
                // se crea una tabla para llenar con la cantidad de columnas que definio el usuario con la vista addTable
            $tableName = $_REQUEST["tableName"];
            $numColumns = $_REQUEST["numColumns"];
            addTable($tableName, $numColumns);
            break;
            case 'crear':
                //organiza los datos recibidos en array para enviarlos a la funcion create table
            $datos = "";
            $foraneas = array();
            $primarias = array();
            $nombre = $_REQUEST["Nombre"];
            $tipo = $_REQUEST["Tipo"];
            $nulo = $_REQUEST["Nulo"];
            $key = $_REQUEST["Llave"];
            $reference=$_REQUEST["Input"];
            $count = 0;
            $count1 = 0;
            for ($i = 0;$i < count($nombre);$i++) {
                if ($key[$i] == "foreign") {
                    $foraneas[$count] = $nombre[$i].",".$reference[$count];
                    $count++;
                } elseif ($key[$i] == "primary") {
                    $primarias[$count1] = $nombre[$i];
                    $count1++;
                }
                if ($i == count($nombre) - 1) {
                    $datos.= $nombre[$i] . " " . $tipo[$i] . " " . $nulo[$i];
                } else {
                    $datos.= $nombre[$i] . " " . $tipo[$i] . " " . $nulo[$i] . ",";
                }
            }
            $err=$myClass->createTable($_REQUEST['tableName'], $datos, $primarias, $foraneas);
            if($err){
                echo '<meta http-equiv="Refresh" content=0;url="index.php?nombreBD=' . $_REQUEST["nombreBD"] . '&action=acceder">';
            }else{
                echo "error!!!";
            }

            break;
            default:
            $myClass->debug("nothing");
            break;
        }
    }
    catch(Exception $e) {
        die($e->getMessage());
    }
}
//recibe los request para lo referente a las tablas (sin contar la creacion)
if (isset($_REQUEST['tables'])) {
    $myClass = new baseDeDatos($_REQUEST['nombreBD']);
    try {
        switch ($_REQUEST['tables']) {
            case 'editar':
                //llama a la vista editTable y luego a la vista acceso para ver la edicion de la tabla y las tablas de la bd al mismo tiempo
            editTable($_REQUEST["tableName"]);
            acceso();
            break;
            case 'eliminar':
                //llama a la funcion delete table
            $myClass->deleteTable($_REQUEST["tableName"]);
            header('Location: index.php?nombreBD=' . $_REQUEST["nombreBD"] . '&action=acceder');
            break;
            case 'guardar cambios':
                //agrega las llaves foraneas a partir de la funcion addReference
            $nombre = $_REQUEST["tableNames"];
            $reference = $_REQUEST["tablas"];
            for ($i = 0;$i < count($reference);$i++) {
                if ($reference[$i] !== "") {
                    $myClass->addReference($_REQUEST['tableName'], $nombre[$i], $reference[$i]);
                }
            }
            header('Location: index.php?nombreBD=' . $_REQUEST["nombreBD"] . '&action=acceder');
            break;
            default:
            $myClass->debug("nothing");
            break;
        }
    }
    catch(Exception $e) {
        die($e->getMessage());
    }
}
?>