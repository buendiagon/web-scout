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
                // agregar recibe los datos de la vista y los organiza para enviarlos a la funcion fillTable
                $array = "";
                $sql = 'show COLUMNS from ' . $_REQUEST['tableName'];
                $err = $myClass->sentence($sql, $array);
                if ($err != false) {
                    $data = "";
                    for ($i = 0;$i < count($array);$i++) {
                        if ($i == count($array) - 1) {
                            if(strpos($_REQUEST[$array[$i][0]],"MD5")!==false){
                                $data1 = $_REQUEST[$array[$i][0]];
                            }else{
                                $data1 = "'" . $_REQUEST[$array[$i][0]] . "'";
                            }
                            $data.= $data1;
                        } else {
                            if(strpos($_REQUEST[$array[$i][0]],"MD5")!==false){
                                $data1 = $_REQUEST[$array[$i][0]];
                            }else{
                                $data1 = "'" . $_REQUEST[$array[$i][0]] . "'";
                            }
                            $data.= $data1 . ",";
                        }
                    }
                    $err = $myClass->fillTable($_REQUEST['tableName'], $data);
                    if ($err) {
                        // se reenvia a el index para abservar los cambios en la tabla
                        echo '<meta http-equiv="Refresh" content=0;url="index.php?nombreBD=' . $_REQUEST["nombreBD"] . '&action=acceder">';
                    }
                } else {
                    echo "Error al realizar la operaci&oacute;n";
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