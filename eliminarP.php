<?php
require("conexion.php");

if (isset($_GET["idProducto"])) {
    $idProducto = $_GET["idProducto"];

    // Consultar el producto específico para la eliminación
    $query = "DELETE FROM producto WHERE idProducto = $idProducto";

    // Ejecuta la consulta de eliminación
    $ejecucion = mysqli_query($conexion, $query);

    if ($ejecucion) {
        // La eliminación se realizó con éxito
        echo "Producto eliminado correctamente.";
    } else {
        // Error en la eliminación
        echo "Error al eliminar el producto: " . mysqli_error($conexion);
    }
} else {
    echo "No se proporcionó un ID de producto válido.";
}

// Cierra la conexión
mysqli_close($conexion);

// Redirige a la página de producto o donde lo necesites
echo "<script>location.href='producto.php';</script>";
?>