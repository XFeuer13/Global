<?php
require("conexion.php");

if (isset($_GET["idProducto"])) {
    $idProducto = $_GET["idProducto"];

    // Consultar el producto específico para la edición
    $query = "SELECT * FROM producto WHERE idProducto = $idProducto";
    $result = $conexion->query($query);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $idProducto = $row["idProducto"];
        $nombre = $row["nombre"];
        $numeroSerie = $row["numeroSerie"];
        $statusV = $row["statusV"];

        echo "<h1>Editar Producto</h1>";
        echo "<form action='guardarP.php' method='post'>";
        echo "ID del Producto: <input type='text' name='idProducto' value='$idProducto' readonly><br>";
        echo "Nombre del Producto: <input type='text' name='nombre' value='$nombre'><br>";
        echo "Número de Serie: <input type='text' name='numeroSerie' value='$numeroSerie'><br>";
        echo "<input type='hidden' name='statusV' value='1'><br>";
        echo "<input type='submit' value='Guardar'>";
        echo "</form>";
    } else {
        echo "No se encontró el producto especificado.";
    }
} else {
    echo "No se proporcionó un ID de producto válido.";
}

$conexion->close();
?>