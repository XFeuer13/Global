<?php
require("conexion.php");

$idProducto = $_POST['idProducto'];
$nombre = $_POST['nombre'];
$numeroSerie = $_POST['numeroSerie'];
$statusV = $_POST['statusV'];

$query = "UPDATE producto SET 
    nombre = '$nombre',
    numeroSerie = '$numeroSerie',
    statusV = '$statusV'
    WHERE idProducto = $idProducto";

$ejecucion = mysqli_query($conexion, $query);

if ($ejecucion) {
    // La consulta se realizó con éxito
    echo "Datos actualizados correctamente.";
} else {
    // Error en la consulta
    echo "Error al actualizar los datos: " . mysqli_error($conexion);
}

mysqli_close($conexion);

// Redirige a la página de productos o donde lo necesites
echo "<script>location.href='producto.php'; </script>";
?>