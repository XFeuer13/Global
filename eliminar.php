<?php
require("conexion.php");

if (isset($_GET["idReporte"])) {
    $idReporte = $_GET["idReporte"];

    // Consultar el reporte específico para la eliminación
    $query = "DELETE FROM reporte WHERE idReporte = $idReporte";

    // Ejecuta la consulta de eliminación
    $ejecucion = mysqli_query($conexion, $query);

    if ($ejecucion) {
        // La eliminación se realizó con éxito
        echo "Registro eliminado correctamente.";
    } else {
        // Error en la eliminación
        echo "Error al eliminar el registro: " . mysqli_error($conexion);
    }
} else {
    echo "No se proporcionó un ID de reporte válido.";
}

// Cierra la conexión
mysqli_close($conexion);

// Redirige a la página de reporte o donde lo necesites
echo "<script>location.href='../Global/index.php';</script>";
?>