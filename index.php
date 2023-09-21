<?php
require("conexion.php");
echo "Este es mi proyecto global <br>";
echo "Estaria mejor en Derecho <br>";
echo " Yo soy la Documentacion <br>";
echo "No me pagan por subir links <br>";
echo "Esta bien no me paguen <br> <br>";

// Agrega un botón "Insert" en la esquina superior derecha
echo "<div style='text-align: center; padding: 40px;'>";

echo "<a href='reporte.php' style='text-decoration: none;'>";
echo "<button type='button' style='background-color: green; color: white; padding: 10px; font-size: 16px; font-weight: bold; margin-right: 200px;'>Reporte</button>";
echo "</a>";

echo "<a href='insertar.php' style='text-decoration: none;'>";
echo "<button type='button' style='background-color: blue; color: white; padding: 10px; font-size: 16px; font-weight: bold; margin-right: 200px;'>+</button>";
echo "</a>";

echo "<a href='producto.php' style='text-decoration: none;'>";
echo "<button type='button' style='background-color: yellow; color: blue; padding: 10px; font-size: 16px; font-weight: bold; margin-right: 200px;'>Producto</button>";
echo "</a>";

echo "<a href='respaldoGeneral.php' style='text-decoration: none;'>";
echo "<button type='button' style='background-color: black; color: red; padding: 10px; font-size: 16px; font-weight: bold;'>BackUp</button>";
echo "</a>";

echo "</div>";


$query = "SELECT r.idReporte, r.cantidad, r.fecha, p.nombre AS nombrepro, t.nombre AS nombretec
    FROM reporte AS r
    JOIN producto AS p ON r.idProducto = p.idProducto
    JOIN tecnico AS t ON r.idTecnico = t.idTecnico
    WHERE r.statusV=1
    ORDER BY r.idReporte";

if ($result = $conexion->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $idReporte = $row["idReporte"];
        $cantidad = $row["cantidad"];
        $fecha = $row["fecha"];
        $nombreProducto = $row["nombrepro"];
        $nombreTecnico = $row["nombretec"];

        echo $idReporte . " " . $nombreProducto . " " . $cantidad . " " . $fecha . " " . $nombreTecnico . " ";
        echo "<a href='editar.php?idReporte=$idReporte'>";
        echo "<button type='button'>Update</button>";
        echo "</a>";

        // Agrega un botón de "Eliminar" con un enlace a la página de eliminación y una confirmación JavaScript
        echo "<a href='eliminar.php?idReporte=$idReporte' onclick=\"return confirm('¿Estás seguro que deseas eliminar este Registro Cabeza de Percebe?');\">";
        echo "<button type='button' style='background-color: red;'>Delete</button>";
        echo "</a>";

        echo "<br>----------------------------------------------------------------------------------<br>";
    }

    /*freeresultset*/
    $result->free();
}
?>