<?php
require("conexion.php");

// Obtener el próximo valor autoincremental para idProducto
$query = "SELECT MAX(idProducto) AS max_id FROM producto";
$result = $conexion->query($query);
$row = $result->fetch_assoc();
$next_id = $row['max_id'] + 1;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST["nombre"];
    $numeroSerie = $_POST["numeroSerie"];
    
    // El campo statusV se establece automáticamente en 1
    $statusV = 1;

    // Realizar la inserción en la base de datos con el próximo idProducto
    $query = "INSERT INTO producto (idProducto, nombre, numeroSerie, statusV) VALUES ('$next_id', '$nombre', '$numeroSerie', '$statusV')";

    if ($conexion->query($query) === TRUE) {
        // Redireccionar automáticamente a producto.php después de la inserción exitosa
        header("Location: producto.php");
        exit();
    } else {
        echo "Error al insertar el producto: " . $conexion->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insertar Nuevo Producto</title>
</head>
<body>
    <h1>Insertar Nuevo Producto</h1>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="idProducto">ID del Producto:</label>
        <input type="text" id="idProducto" name="idProducto" value="<?php echo $next_id; ?>" readonly><br>

        <label for="nombre">Nombre del Producto:</label>
        <input type="text" id="nombre" name="nombre" required><br>

        <label for="numeroSerie">Número de Serie:</label>
        <input type="text" id="numeroSerie" name="numeroSerie" required><br>

        <!-- El campo statusV se establece automáticamente en 1 y se oculta -->
        <input type="hidden" id="statusV" name="statusV" value="1">

        <input type="submit" value="Insertar">
    </form>
</body>
</html>