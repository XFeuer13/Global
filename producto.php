<?php
require("conexion.php");

echo "BIEN VENIDO A LA TABLA REPORTE DE LA BASE DE DATOS INVENTARIO  <br> <br>";

// Botones
echo "<div style='text-align: center; padding: 40px;'>";

echo "<a href='reporteP.php' style='text-decoration: none;'>";
echo "<button type='button' style='background-color: green; color: white; padding: 10px; font-size: 16px; font-weight: bold; margin-right: 200px;'>Reporte</button>";
echo "</a>";

echo "<a href='insertarP.php' style='text-decoration: none;'>";
echo "<button type='button' style='background-color: blue; color: white; padding: 10px; font-size: 16px; font-weight: bold; margin-right: 200px;'>+</button>";
echo "</a>";

echo "<a href='index.php' style='text-decoration: none;'>";
echo "<button type='button' style='background-color: yellow; color: blue; padding: 10px; font-size: 16px; font-weight: bold; margin-right: 200px;'>Regresar</button>";
echo "</a>";

echo "<a href='respaldoGeneral.php' style='text-decoration: none;'>";
echo "<button type='button' style='background-color: black; color: red; padding: 10px; font-size: 16px; font-weight: bold;'>BackUp</button>";
echo "</a>";

echo "</div>";


$query = "SELECT p.idProducto, p.nombre, p.numeroSerie 
    FROM producto AS p
    WHERE p.statusV=1
    ORDER BY p.idProducto";

if ($result = $conexion->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $idProducto = $row["idProducto"];
        $nombre = $row["nombre"];
        $numeroSerie = $row["numeroSerie"];

        echo $idProducto . " " . $nombre . " " . $numeroSerie . " ";
        echo "<a href='editarP.php?idProducto=$idProducto'>";
        echo "<button type='button'>Update</button>";
        echo "</a>";

        // Agrega un botón de "Eliminar" con un enlace a la página de eliminación y una confirmación JavaScript
        echo "<a href='eliminarP.php?idProducto=$idProducto' onclick=\"return confirm('¿Estás seguro que deseas eliminar este Registro Cabeza de Percebe?');\">";
        echo "<button type='button' style='background-color: red;'>Delete</button>";
        echo "</a>";

        echo "<br>----------------------------------------------------------------------------------<br>";
    }

    /*freeresultset*/
    $result->free();
}
?>