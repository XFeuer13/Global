<?php
        require("conexion.php");
        echo "Este es mi proyecto global <br>";
        echo "Estaria mejor en Derecho <br>";
        echo " Yo soy la Documentacion <br>";
        echo "No me pagan por subir links <br>";
        echo "Esta bien no me paguen <br> <br>";

        $query ="SELECT * FROM reporte";


    if ($result = $conexion->query($query)) {

		while ($row = $result->fetch_assoc()) {
			$idRep = $row["idReporte"];
               $idPro =$row["idProducto"];
               $cantidad =$row["cantidad"];
               $fecha =$row["fecha"];
               $idTec =$row["idTecnico"];


			echo $idRep ." " .  $idPro ." " .  $cantidad ." " .  $fecha . " " .  $idTec ."<br>";
        }

            /*freeresultset*/
	$result->free();
        }

?>