<?php
require_once "conexionbd.php";

$errorDbConexion = false;

function conusltaTareas($linkDB){
    $salida='';
    $consulta = $linkDB -> query("SELECT titulo,descripcion from tarea where usuario_id = ". $_GET['usuario_id']." ORDER BY titulo ASC");

    if($consulta -> num_rows != 0){
        while($listadoOK = $consulta -> fetch_assoc())
        {
            $salida .= '
            <tr>
            <td>'.$listadoOK['titulo'].'</td>
            <td>'.$listadoOK['descripcion'].'</td>
            </tr>
            ';
        }
    }else {
        $salida = '
        <tr id="sinDatos">
            <td coldspan="2">No tiene ninguna tarea creada</td>
        </tr>
        ';
    }
    return $salida;
}
?>