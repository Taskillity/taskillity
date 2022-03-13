<?php
require_once "conexionbd.php";

$titulo = $_POST['title'];
$description = $_POST['description'];
$usuario_id = $_POST['usuario_id'];

$sql = "INSERT INTO tarea (titulo, descripcion, usuario_id) VALUES ('$titulo','$description','$usuario_id')";

echo mysqli_query($conexion,$sql);

?>