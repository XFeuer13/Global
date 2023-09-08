<?php
require("conexion.php");

// Obtener el próximo valor autoincremental para idReporte
$query = "SELECT MAX(idReporte) AS max_id FROM reporte";
$result = $conexion->query($query);
$row = $result->fetch_assoc();
$next_id = $row['max_id'] + 1;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombreProducto = $_POST["nombreProducto"];
    $cantidad = $_POST["cantidad"];
    $fecha = $_POST["fecha"];
    $nombreTecnico = $_POST["nombreTecnico"];

    // Realizar la inserción en la base de datos con el próximo idReporte
    $query = "INSERT INTO reporte (idReporte, idProducto, cantidad, fecha, idTecnico, statusV) VALUES ('$next_id', '$nombreProducto', '$cantidad', '$fecha', '$nombreTecnico', 1)";

    if ($conexion->query($query) === TRUE) {
        // Redireccionar a saveregistro.php con el nuevo idReporte
        header("Location: saveregistro.php?idReporte=$next_id");
        exit();
    } else {
        echo "Error al insertar el registro: " . $conexion->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insertar Nuevo Registro</title>
    <!-- Agregar referencia a jQuery y jQuery UI para el calendario -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        // Inicializar el selector de fecha con el formato deseado
        $(function() {
            $("#fecha").datepicker({
                dateFormat: "yy-mm-dd"
            });
        });
    </script>
</head>
<body>
    <h1>Insertar Nuevo Registro</h1>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="idReporte">ID del Reporte:</label>
        <input type="text" id="idReporte" name="idReporte" value="<?php echo $next_id; ?>" readonly><br>

        <!-- Etiqueta desplegable para seleccionar el producto -->
        <label for="nombreProducto">Nombre del Producto:</label>
        <select id="nombreProducto" name="nombreProducto" required>
            <?php
            $queryProductos = "SELECT idProducto, nombre FROM producto";
            $resultProductos = $conexion->query($queryProductos);

            while ($rowProducto = $resultProductos->fetch_assoc()) {
                echo "<option value='{$rowProducto['idProducto']}'>{$rowProducto['nombre']}</option>";
            }
            ?>
        </select><br>

        <label for="cantidad">Cantidad:</label>
        <input type="text" id="cantidad" name="cantidad" required><br>

        <!-- Campo de fecha con formato yyyy-mm-dd -->
        <label for="fecha">Fecha :</label>
        <input type="text" id="fecha" name="fecha" required placeholder="yyyy-mm-dd"><br>

        <!-- Etiqueta desplegable para seleccionar el técnico -->
        <label for="nombreTecnico">Nombre del Técnico:</label>
        <select id="nombreTecnico" name="nombreTecnico" required>
            <?php
            $queryTecnicos = "SELECT idTecnico, nombre FROM tecnico";
            $resultTecnicos = $conexion->query($queryTecnicos);

            while ($rowTecnico = $resultTecnicos->fetch_assoc()) {
                echo "<option value='{$rowTecnico['idTecnico']}'>{$rowTecnico['nombre']}</option>";
            }
            ?>
        </select><br>

        <input type="submit" value="Insertar">
    </form>
</body>
</html>