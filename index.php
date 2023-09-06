<?php
        require("conexion.php");
        echo "Este es mi proyecto global <br>";
        echo "Estaria mejor en Derecho <br>";
        echo " Yo soy la Documentacion <br>";
        echo "No me pagan por subir links <br>";
        echo "Esta bien no me paguen <br> <br>";

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

        echo $idReporte . " " . $nombreProducto . " " . $cantidad . " " . $fecha . " " . $nombreTecnico . "<br>";
    }

            /*freeresultset*/
	$result->free();
        }

?>