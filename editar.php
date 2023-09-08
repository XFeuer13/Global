<?php
require("conexion.php");

if (isset($_GET["idReporte"])) {
    $idReporte = $_GET["idReporte"];

    // Consultar el reporte específico para la edición
    $query = "SELECT * FROM reporte WHERE idReporte = $idReporte";
    $result = $conexion->query($query);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $idReporte = $row["idReporte"];
        $cantidad = $row["cantidad"];
        $fecha = $row["fecha"];
        $idProducto = $row["idProducto"];
        $idTecnico = $row["idTecnico"];

        // Obtener el nombre del producto y el nombre del técnico relacionados
        $queryProducto = "SELECT idProducto, nombre FROM producto";
        $resultProducto = $conexion->query($queryProducto);

        $queryTecnico = "SELECT idTecnico, nombre FROM tecnico";
        $resultTecnico = $conexion->query($queryTecnico);

        echo "<h1>Editar Reporte</h1>";
        echo "<form action='guardar.php' method='post'>";
        echo "ID del Reporte: <input type='text' name='idReporte' value='$idReporte' readonly><br>";

        // Etiqueta desplegable para seleccionar el producto
        echo "Producto: <select name='nuevoProducto'>";
        while ($rowProducto = $resultProducto->fetch_assoc()) {
            $selected = ($rowProducto['idProducto'] == $idProducto) ? 'selected' : '';
            echo "<option value='{$rowProducto['idProducto']}' $selected>{$rowProducto['nombre']}</option>";
        }
        echo "</select><br>";

        echo "Cantidad: <input type='text' name='nuevaCantidad' value='$cantidad'><br>";

        // Campo de fecha con un selector de fecha (puedes utilizar librerías JavaScript para implementar un calendario)
        echo "Fecha: <input type='date' name='nuevaFecha' value='$fecha'><br>";

        // Etiqueta desplegable para seleccionar el técnico
        echo "Técnico: <select name='nuevoTecnico'>";
        while ($rowTecnico = $resultTecnico->fetch_assoc()) {
            $selected = ($rowTecnico['idTecnico'] == $idTecnico) ? 'selected' : '';
            echo "<option value='{$rowTecnico['idTecnico']}' $selected>{$rowTecnico['nombre']}</option>";
        }
        echo "</select><br>";

        echo "<input type='submit' value='Guardar'>";
        echo "</form>";
    } else {
        echo "No se encontró el reporte especificado.";
    }
} else {
    echo "No se proporcionó un ID de reporte válido.";
}

$conexion->close();
?>