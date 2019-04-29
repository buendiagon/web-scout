<?php
class baseDeDatos {
    //constructor de la baseDeDatos que ya contienen unos valores por default que se pueden modificar
    public $nombreBD, $user, $password, $host;
    public function __construct($nombreBD = "bd_prueba", $user = "root", $password = "", $host = "localhost") {
        $this->host = $host;
        $this->nombreBD = $nombreBD;
        $this->user = $user;
        $this->password = $password;
    }
    //la funcion debug permite mostrar datos en la consola
    function debug($data) {
        $output = $data;
        if (is_array($output)) $output = implode(',', $output);
        echo "<script>console.log(' Debug Objects: $data');</script>\n";
    }
    //sqlConnection crea una conexion a la base de datos y la retorna
    function sqlConnection() {
        $conec = new mysqli($this->host, $this->user, $this->password);
        if (!$conec) {
            die('No pudo conectarse: ' . mysql_error());
        }
        return $conec;
    }
    //la funcion sentece recibe un parametro obligatorio y uno opcional; el obligatorio contiene la sentencia sql a ejecutar, y el opcional un array que se llena con los datos devueltos por la sentencia sql
    function sentence($sql, &$arr = null) {
        $conectar = $this->sqlConnection();
        $conectar->select_db($this->nombreBD);
        $conexion = $conectar->query($sql);
        if ($conexion) {
            if (func_num_args() == 2) {
                $rows = array();
                $array = array();
                $i = 0;
                if ($conexion->num_rows > 0) {
                    $rows[0][0] = "";
                    while ($array = mysqli_fetch_array($conexion)) {
                        for ($j = 0;$j < $conexion->field_count;$j++) {
                            $rows[$i][$j] = $array[$j];
                        }
                        $i++;
                    }
                }
                if (func_num_args() == 2) {
                    $arr = $rows;
                }
            }
            return true;
        } else {
            $error = $conectar->error;
            $error = str_replace("'", "´", $error);
            $this->debug('Error al realizar la operacion : ' . $error . "");
            $this->debug($sql);
            return false;
        }
    }
    //crea una base de datos
    function createDB() {
        $sql = 'CREATE DATABASE ' . $this->nombreBD;
        $err = $this->sentence($sql);
        if ($err === false) {
            $this->debug("Error al realizar la operacion, por favor revise que los campos son correctos");
        }
        return $err;
    }
    //elimina la base de datos
    function deleteDB() {
        $sql = 'DROP DATABASE ' . $this->nombreBD;
        $err = $this->sentence($sql);
        if ($err === false) {
            $this->debug("Error al realizar la operacion, por favor revise que los campos son correctos");
        }
        return $err;
    }
    //llena el array con los nombres de las tablas de una base de datos
    function showTables($nombreBD, &$array) {
        if ($nombreBD == "") {
            echo "Error al realizar la operacion : nombre de la base de datos vacio";
            return false;
        }
        $sql = 'SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = "' . $nombreBD . '";';
        $err = $this->sentence($sql, $array);
        if ($err === false) {
            $this->debug("Error al realizar la operacion, por favor revise que los campos son correctos");
        }
        return $err;
    }
    //llena el array con todos los datos de una tabla
    function showContent($nombreTable, &$array) {
        if ($nombreTable == "") {
            echo "Error al realizar la operacion : nombre de la base de datos vacio";
            return false;
        }
        $sql = 'SELECT * FROM ' . $nombreTable . ';';
        $err = $this->sentence($sql, $array);
        if ($err === false) {
            $this->debug("Error al realizar la operacion, por favor revise que los campos son correctos");
        }
        return $err;
    }
    //crea una tabla con sus llaves primarias, y foraneas si tiene
    function createTable($tableName, $tableContent, $primaria, $foranea = null) {
        $primarias = "";
        for ($i = 0;$i < count($primaria);$i++) {
            if ($i == count($primaria) - 1) {
                $primarias.= $primaria[$i];
            } else {
                $primarias.= $primaria[$i] . ",";
            }
        }
        $sql = 'CREATE TABLE ' . $tableName . '(' . $tableContent;
        if (count($primaria) > 0) {
            $sql.= ",PRIMARY KEY(" . $primarias . "));";
        } else {
            $sql.= ");";
        }
        $err = $this->sentence($sql);
        for ($i = 0;$i < count($foranea);$i++) {
            $reference=explode(",",$foranea[$i]);
            $this->addReference($tableName,$reference[0],$reference[1]);
        }
        if (!$err) {
            $this->debug("Error al realizar la operacion, por favor revise que los campos son correctos");
            return false;
        } else {
            return true;
        }
    }
    //elimina una tabla de la base de datos
    function deleteTable($tableName) {
        $sql = "DROP TABLE $tableName";
        $err = $this->sentence($sql);
        if (!$err) {
            $this->debug("Error al realizar la operacion, por favor revise que los campos son correctos");
        }
        return $err;
    }
    //agrega la referencia de la columna de una tabla a otra
    function addReference($tableName, $name, $reference) {
        $sql = "alter table " . $tableName . " add CONSTRAINT fk_" . $tableName . "_" . $name . " FOREIGN KEY (" . $name . ") REFERENCES " . $reference . "(" . $name . ") on delete CASCADE on UPDATE CASCADE;";
        $err = $this->sentence($sql);
        if (!$err) {
            $this->debug("Error al realizar la operacion, por favor revise que los campos son correctos");
        }
    }
    //agrega un registro a una tabla
    function fillTable($tableName, $datos) {
        $bandera = false;
        $array = "";
        $sql = 'show COLUMNS from ' . $tableName;
        $this->sentence($sql, $array);
        $data = "";
        for ($i = 0;$i < count($array);$i++) {
            if ($i == count($array) - 1) {
                $data.= $array[$i][0];
            } else {
                $data.= $array[$i][0] . ",";
            }
        }
        $primaryKey = preg_split('~,~', $datos);
        $sqlKey = 'SELECT COLUMN_NAME from information_schema.key_column_usage where TABLE_SCHEMA="' . $this->nombreBD . '" AND TABLE_NAME="' . $tableName . '" AND CONSTRAINT_NAME="PRIMARY"';
        $array1 = "";
        $err = $this->sentence($sqlKey, $array1);
        for ($i = 0;$i < count($array1);$i++) {
            $sql = 'SELECT COUNT(*) FROM ' . $tableName . ' WHERE ' . $array1[$i][0] . '=' . $primaryKey[$i] . ';';
            $this->sentence($sql, $array);
            if ($array[0][0] == 0) {
                $bandera = true;
            }
        }
        if ($err != false) {
            if ($bandera) {
                $sql = 'INSERT INTO ' . $tableName . '(' . $data . ') VALUES (' . $datos . ');';
                $err = $this->sentence($sql);
                if ($err) {
                    return $err;
                } else {
                    $this->debug("Error al realizar la operacion, por favor revise que los campos son correctos1");
                    $this->debug($sql);
                }
            } else {
                $err = $this->updateTuple($tableName, $datos);
            }
            return $err;
        } else {
            $this->debug("Error al realizar la operacion, por favor revise que los campos son correctos");
            return false;
        }
    }
    //actualiza los valores de una tupla
    function updateTuple($tableName, $datos) {
        $where = "";
        $array = "";
        $sql = 'show COLUMNS from ' . $tableName;
        $err = $this->sentence($sql, $array);
        $datos = preg_split('~,~', $datos);
        $data = "";
        for ($i = 0;$i < count($array);$i++) {
            if ($i == count($array) - 1) {
                $data.= $array[$i][0] . "=" . $datos[$i];
            } else {
                $data.= $array[$i][0] . "=" . $datos[$i] . ",";
            }
        }
        $sqlKey = 'SELECT COLUMN_NAME from information_schema.key_column_usage where TABLE_SCHEMA="' . $this->nombreBD . '" AND TABLE_NAME="' . $tableName . '" AND CONSTRAINT_NAME="PRIMARY"';
        $array1 = "";
        $this->sentence($sqlKey, $array1);
        for ($i = 0;$i < count($array1);$i++) {
            if ($i == 0) {
                $where.= $array1[$i][0] . "=" . $datos[$i];
            } else {
                $where.= " AND " . $array1[$i][0] . "=" . $datos[$i];
            }
        }
        $sql = 'UPDATE ' . $tableName . ' SET ' . $data . ' WHERE ' . $where . ';';
        $err = $this->sentence($sql);
        if (!$err) {
            $this->debug("Error al realizar la operacion, por favor revise que los campos son correctos");
        }else{
            $this->debug("nice");
        }
        return $err;
    }
    //retorna un array con los datos de una fila que contiene las llaves primarias enviadas($ids)
    function editTable($tableName, $ids) {
        $where = "";
        $sqlKey = 'SELECT COLUMN_NAME from information_schema.key_column_usage where TABLE_SCHEMA="' . $this->nombreBD . '" AND TABLE_NAME="' . $tableName . '" AND CONSTRAINT_NAME="PRIMARY"';
        $array1 = "";
        $this->sentence($sqlKey, $array1);
        for ($i = 0;$i < count($array1);$i++) {
            if ($i == 0) {
                $where.= $array1[$i][0] . "=" . $ids[$i];
            } else {
                $where.= " AND " . $array1[$i][0] . "=" . $ids[$i];
            }
        }
        $sql = 'SELECT * FROM ' . $tableName . ' WHERE ' . $where . ';';
        $err = $this->sentence($sql, $array1);
        if (!$err) {
            $this->debug("Error al realizar la operacion, por favor revise que los campos son correctos");
        }
        return $array1;
    }
    //borra un registro de la tabla cuando las llaves primarias son iguales($ids)
    function deleteTuple($tableName, $ids) {
        $where = "";
        $sqlKey = 'SELECT COLUMN_NAME from information_schema.key_column_usage where TABLE_SCHEMA="' . $this->nombreBD . '" AND TABLE_NAME="' . $tableName . '" AND CONSTRAINT_NAME="PRIMARY"';
        $array1 = "";
        $this->sentence($sqlKey, $array1);
        for ($i = 0;$i < count($array1);$i++) {
            if ($i == 0) {
                $where.= $array1[$i][0] . "=" . $ids[$i];
            } else {
                $where.= " AND " . $array1[$i][0] . "=" . $ids[$i];
            }
        }
        $sql = 'DELETE FROM ' . $tableName . ' WHERE ' . $where . ';';
        $err = $this->sentence($sql);
        if (!$err) {
            $this->debug("Error al realizar la operacion, por favor revise que los campos son correctos");
        }
        return $err;
    }
}
?>