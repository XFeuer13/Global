<?php
require("conexion.php");

$idReporte = $_POST['idReporte'];
$cantidad = $_POST['nuevaCantidad'];
$fecha = $_POST['nuevaFecha'];
$idProducto = $_POST['nuevoProducto'];
$idTecnico = $_POST['nuevoTecnico'];

// Debes separar los campos con comas en la sentencia SQL
$query = "UPDATE reporte SET 
    idProducto = '$idProducto',
    cantidad = '$cantidad',
    fecha = '$fecha',
    idTecnico = '$idTecnico'
    WHERE idReporte = $idReporte";

// Ejecuta la consulta
$ejecucion = mysqli_query($conexion, $query);

if ($ejecucion) {
    // La consulta se realizó con éxito
    echo "Datos actualizados correctamente.";
} else {
    // Error en la consulta
    echo "Error al actualizar los datos: " . mysqli_error($conexion);
}

// Cierra la conexión
mysqli_close($conexion);

// Redirige a la página de reporte o donde lo necesites
echo "<script>location.href='../Global/index.php'; </script>";
?>