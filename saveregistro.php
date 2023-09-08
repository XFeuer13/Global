<?php
require("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["idReporte"])) {
    $idReporte = $_GET["idReporte"];

    // Actualizar el campo statusV a 1 para el registro con el idReporte proporcionado
    $query = "UPDATE reporte SET statusV = 1 WHERE idReporte = $idReporte";

    if ($conexion->query($query) === TRUE) {
        // Redireccionar a index.php después de actualizar
        header("Location: index.php");
        exit();
    } else {
        echo "Error al actualizar el registro: " . $conexion->error;
    }
} else {
    echo "Parámetros incorrectos.";
}
?>