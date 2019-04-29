<?php
//genera todas las tablas de una base de datos
function acceso() {
    //la variable myClass es la que contiene la integridad de la base de datos durante todo el proceso, y la variable acceso controla la cantidad de veces que se llama a esta vista para no duplicarla
    global $myClass, $accesos;
    if ($accesos == 1) {
        $accesos = 0;
        return;
    }
    $accesos++;
    $myClass->sentence('SET NAMES "utf8"');
    //estos array se declaran vacios para enviarlos a un metodo que los llena automaticamente
    $array = "";
    $array2 = "";
    $array3 = "";
    //el return de este metodo es false cuando la operacion solicitada no se cumple satisfactoriamente, el segundo parametro lo llena con los nombres de las tablas de la base de datos
    $err3 = $myClass->showTables($myClass->nombreBD, $array3);
    if ($err3 != false) {
        //se crea un for que recorra todas las tablas en la bd
        for ($z = 0;$z < count($array3);$z++) {
            $sql = 'show COLUMNS from ' . $myClass->nombreBD . '.' . $array3[$z][0];
            //llena el segundo parametro con el contenido de una tabla
            $err = $myClass->showContent($array3[$z][0], $array);
            //llena el segundo parametro con el nombre de las columnas de una tabla
            $err2 = $myClass->sentence($sql, $array2);
            //verifica si ambas consultas salieron bien
            if ($err !== false && $err2 !== false) {
                //muestra el nombre de cada tabla con array3, ademas de agregar una opcion para editar y eliminar la tabla
                echo '<h3 style="display: inline-block" id="' . $array3[$z][0] . '">' . $array3[$z][0] . '</h3>';
                echo '<a style="display: inline-block;margin-left: 10px" href="?tables=editar&nombreBD=' . $myClass->nombreBD . '&tableName=' . $array3[$z][0] . '">Editar</a>';
                echo '<a style="display: inline-block;margin-left: 10px" href="?tables=eliminar&nombreBD=' . $myClass->nombreBD . '&tableName=' . $array3[$z][0] . '">Eliminar</a>';
                echo '<table id="'.$array3[$z][0].'Data" style="width:500px;border-style: none;">
            <thead>
                <tr>';
                //se hace un recorrido por array2 que contiene los nombres de las columnas de la tabla y las muestra en una etiqueta th
                for ($i = 0;$i < count($array2);$i++) {
                    echo '<th style="text-align:left;">' . $array2[$i][0] . '</th>';
                }
                echo '</tr>
            </thead>';
                //este form sirve para enviar los datos que contienen una tupla que se vaya a añadir, y la action permite que el scroll no vuelva a subir despues de enviar el form
                echo '<form name="form" id="forma" action="#' . $array3[$z][0] . '" method="POST" enctype="multipart/form-data">';
                echo '<tbody>';
                //se hace un recorrido por todos los elementos contenidos en la tabla y se muentran en una etuiqueta td
                for ($i = 0;$i < count($array);$i++) {
                    echo '<tr>';
                    for ($j = 0;$j < (count($array, 1) / count($array)) - 1;$j++) {
                        echo '<td style="text-align:left;">';
                        echo $array[$i][$j];
                        echo '</td>';
                    }
                    //al lado de cada tupla aparecen las acciones para editar y eliminar la tupla
                    //al momento de editar se envian datos al controlador que llena una variable global ($edicion) y vuelve a llamar a la vista
                    echo '<td style="border-style: none"><a href="?actionTuple=editar&nombreBD=' . $myClass->nombreBD . '&ids=' . urlencode((serialize($array[$i]))) . '&tableName=' . $array3[$z][0] . '#scroll' . $array3[$z][0] . '">Editar</a><br/></td>
                            <td style="border-style: none"><a href="?actionTuple=eliminar&nombreBD=' . $myClass->nombreBD . '&nombreTable=' . $array3[$z][0] . '&ids=' . urlencode((serialize($array[$i]))) . '#scroll' . $array3[$z][0] . '">eliminar</a><br/></td>
                        </tr>';
                }
                //se envian el nombre de la tabla y el nombre de la base de datos para mantener la integridad durante todas las operaciones
                echo '<tr id="scroll'.$array3[$z][0].'">
                    <input type="hidden" name="tableName" value="' . $array3[$z][0] . '">
                    <input type="hidden" name="nombreBD" value="' . $myClass->nombreBD . '">';
                //se genera un nuevo recorrido por las columnas para dar espacio a añadir nuevas tuplas
                for ($j = 0;$j < (count($array2));$j++) {
                    if($array2[$j][0]=="imagen"){
                        echo '<td><input type="file" name="' . $array2[$j][0] . '" accept=image/* value="';
                    }else{
                        echo '<td><input type="text" name="' . $array2[$j][0] . '" value="';

                    }
                    global $edicion, $tableName;
                    //comprueba se la variable global $edicion contiene algo de ser asi llena automaticamente los campos de la tupla para que se puedan editar de forma mas comoda; en caso contrario deja los campos vacios para crear una nueva tupla
                    if (count($edicion) == 0 || $array3[$z][0] != $tableName) {
                        echo "";
                    } else {
                        echo $edicion[$j];
                    }
                    echo '" style="wigth: 100%;border-style: none;"/></td>';
                }
                echo '<td style="border-style: none"><input type="submit" id="agregar" name="actionTuple" value="agregar"/><br/></td>';
                echo '</tr>
                    <tr>
                    <td><button id="excel" onclick="fnExcelReport('."'".$array3[$z][0]."Data'".')">Descargar tabla</button></td>
                    </tr>
                    </tbody>
                    </form>
                </table>';
            }
        }
    }
    //este form envia los datos para crear una nueva tabla
    echo '<form name="form" id="forma1" action="#table1" method="POST">
    <h3 id="table1" style="wigth: 100%;display: inline-block;">Nombre nueva tabla:  </h3>
    <input type="text" name="tableName" value="" style="wigth: 100%;display: inline-block;" />
    <input type="hidden" name="nombreBD" value="' . $myClass->nombreBD . '">
    <input type="number" name="numColumns" style="display: inline-block;"/>
    <input type="submit" name="crearTables" value="agregar"/>
    </form>';
}
//genera una tabla con el contenido de una consuta sql
function consulta($sql, &$arr = null) {
    //se sigue manteniendo el objeto myClass de forma global
    global $myClass;
    //se crea la conexion a la base de datos y se ejecuta la sentencia sql
    $array = "";
    $conectar = $myClass->sqlConnection();
    $conectar->select_db($myClass->nombreBD);
    $conexion = $conectar->query($sql);
    if ($conexion) {
        //info pasa a contener el nombre de todas las columnas de la consulta
        $info = $conexion->fetch_fields();
        //este metodo nos devuelve el segundo parametro lleno con los datos de la consulta
        $err = $myClass->sentence($sql, $array);
        if ($err !== false) {
            //el nombre dado a la tabla es el de la sentencia sql
            echo '<h3>' . $sql . '</h3>';
            echo '<table style="width:500px;border-style: none;">
            <thead>
            <tr>';
            //se recorren todos los nombres de las columnas de la consulta
            for ($i = 0;$i < count($info);$i++) {
                echo '<th style="text-align:left;">' . $info[$i]->name . '</th>';
            }
            echo '</tr>
            </thead>';
            echo '<tbody>';
            //se recorren los datos de la consulta que estan contenidos en un array bidimensional
            for ($i = 0;$i < count($array);$i++) {
                echo '<tr>';
                for ($j = 0;$j < (count($array, 1) / count($array)) - 1;$j++) {
                    echo '<td style="text-align:left;">';
                    echo $array[$i][$j];
                    echo '<br/></td>';
                }
                echo '</tr>';
            }
            echo '</tbody>
                </table>';
        }
        //en caso de querer conservar en un arreglo los datos de la consulta se puede enviar un segundo parametro como opcional, el cual se llenara con los datos de la consulta en un array bidimencional
        if (func_num_args() == 2) {
            $arr = $array;
        }
        return $err;
    } else {
        $error = $conectar->error;
        $error = str_replace("'", "´", $error);
        echo 'Error al realizar la operacion : ' . $error;
        return false;
    }
}
//genera una tabla html en la cual se pueden crear tablas de la base de datos
function addTable($tableName, $num) {
    global $myClass;
    //crea las columnas para la vista
    echo '<form name="form" id="form" action="" method="POST">
        <h3 style="wigth: 100%;display: inline-block;">' . $tableName . '</h3>
        <table style="width:500px;border-style: none;display: block;">
        <thead>
            <tr>
                <th style="text-align:left;">Nombre</th>
                <th style="text-align:left;">Tipo</th>
                <th style="text-align:left;">Nulo</th>
                <th style="text-align:left;">Llave</th>
                <th style="text-align:left;">Tabla de referencia</th>
            </tr>
        </thead>';
    //crea la cantidad de filas que el usuario eligio
    for ($i = 0;$i < $num;$i++) {
        //envia los datos de la nueva base de datos que se va a crear en arrays
        echo '<tbody>
                <tr>
                    <input type="hidden" name="nombreBD" value="' . $myClass->nombreBD . '">
                    <input type="hidden" name="tableName" value="' . $tableName . '">
                    <td>
                        <input type="text" name="Nombre[]" value="" style="wigth: 100%;border-style: none;" />
                    </td>
                    <td>
                        <input type="text" name="Tipo[]" value="" style="wigth: 100%;border-style: none;" />
                    </td>
                    <td>
                        <select name="Nulo[]" style="width:100px;">
                            <option value="null">Nulo</option>
                            <option value="not null">No nulo</option>
                        </select>
                    </td>
                    <td>
                        <select name="Llave[]" onchange="foranea(this,' . $i . ');" style="width:100px;">
                            <option value="">No aplica</option>
                            <option value="primary">Primaria</option>
                            <option value="foreign">Foranea</option>
                        </select>
                    </td>
                    <td><input type="text" name="Input[]" value="" style="wigth: 100%;border-style: none;" disabled/></td>';
        echo '</tr>
            </tbody>';
    }
    echo '</table>
        <input type="submit" id="crear" name="crearTables" value="crear"/>
        </form>';
}
//genera una tabla html en la que se puede elegir la llave foranea de las columnas de la tabla seleccionada
function editTable($tableName) {
    //llamamos al objeto global $myClass
    global $myClass;
    $sql = "select * from " . $tableName;
    $tables = "";
    //llenamos tables con los nombres de las tablas que hay en la base de datos
    $myClass->showTables($myClass->nombreBD, $tables);
    $array = "";
    //creamos la conexion con la base de datos, realizamos la consulta $sql, para poder obtener el nombre de las columnas de la tabla
    $conectar = $myClass->sqlConnection();
    $conectar->select_db($myClass->nombreBD);
    $conexion = $conectar->query($sql);
    if ($conexion) {
        $info = $conexion->fetch_fields();
        //se crea la tabla con dos columnas: columna(contiene las columnas de la tabla que estoy editando), referencia(contiene un select con todas las tablas de la base de datos donde se puede hacer referencia)
        echo '<form name="form" id="form" action="" method="POST">
        <input type="hidden" name="tableName" value="' . $tableName . '"/>';
        echo '<table style="width:500px;border-style: none;">
        <thead>
            <tr>
                <th style="text-align:left;">columna</th>
                <th style="text-align:left;">referencia</th>
            </tr>
        </thead>
        <tbody>';
        //se hace un recorrido por todas las columnas de la tabla y se coloca el nombre de la columna en un td
        for ($i = 0;$i < count($info);$i++) {
            echo '<tr>';
            echo '<td style="text-align:left;">' . $info[$i]->name . '</td>';
            echo '<td>';
            $arrayKey = array();
            //se crea una consulta que devuelve el nombre de cada columna de la tabla que ya estan referenciadas a otra tabla
            $sqlKey = 'SELECT REFERENCED_TABLE_NAME from information_schema.key_column_usage where TABLE_SCHEMA="' . $myClass->nombreBD . '" AND COLUMN_NAME="' . $info[$i]->name . '"AND TABLE_NAME="'.$tableName.'" AND NOT CONSTRAINT_NAME="PRIMARY"';
            $myClass->sentence($sqlKey, $arrayKey);
            //arrayKey contiene los resultados de la consulta de arriba
            //si el contenido de arrayKey es mayor de 0 quiere decir que la columna ya tenia referencia con otra tabla, asi que la columna de referencia se llena con el nombre de esa tabla
            if (count($arrayKey) > 0) {
                echo '<option value="">' . $arrayKey[0][0] . '</option>';
            }
            //en caso contrario se da la opcion de elegir a que tabla hacer referencia
            else {
                echo '<input type="hidden" name="tableNames[]" value="' . $info[$i]->name . '"/>
                        <input type="hidden" name="nombreBD" value="' . $myClass->nombreBD . '">';
                echo '<select name="tablas[]" style="width:100px;">';
                echo '<option value="">no aplica</option>';
                //se recorren las tablas de la bd para colocarlas como opciones de referencia de la columna
                for ($j = 0;$j < count($tables);$j++) {
                    echo '<option value="' . $tables[$j][0] . '">' . $tables[$j][0] . '</option>';
                }
            }
            echo '</select>
                </td>';
            echo '</tr>';
        }
        echo '</tbody>
            </table>
            <input type="submit" id="cambios" name="tables" value="guardar cambios"/>
            </form>';
    }
}
?>