<?php
require('fpdf/fpdf.php');
require("conexion.php");

// Configura la zona horaria a México
date_default_timezone_set('America/Mexico_City');

class PDF extends FPDF
{
    private $elementosPorPagina = 11; // Cantidad de elementos por página
    private $elementosAgregados = 0;
    private $conexion;

    function __construct($conexion)
    {
        parent::__construct('L'); // Cambiar la orientación a horizontal ('L')
        $this->conexion = $conexion;
    }

    function Header()
    {
        // Rutas de las imágenes
        $imagenIzquierda = 'C:\AppServ\www\Global\Imagen\imagen2.png';
        $imagenDerecha = 'C:\AppServ\www\Global\Imagen\imagen1.png';

        $this->Image($imagenIzquierda, 10, 10, 30);
        $this->Image($imagenDerecha, 250, 15, 30); // Ajusta la posición de la imagen derecha
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(280, 10, 'Gia de Productos', 0, 1, 'C'); // Ajusta el ancho de la celda
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 10, 'Generado por: Jose Manuel Rangel Cortes', 0, 1, 'C'); 
        $this->Cell(0, 10, 'Tabla de Registros de Productos', 0, 1, 'C'); 

        // Agregar la fecha actual a la derecha
        $this->SetFont('Arial', '', 12);
        $this->SetX(-60); // Posiciona el cursor de escritura a la derecha
        $this->Cell(60, 10, 'Fecha: ' . date('d/m/Y'), 0, 1, 'C');
        $this->Ln(5);
        $this->Cell(10, 10, "ID", 'LR', 0, 'C');
        $this->Cell(80, 10, "Nombre del Producto", 'LR', 0, 'C');
        $this->Cell(60, 10, "Número de Serie", 'LR', 0, 'C');
        $this->Cell(40, 10, "Estado", 'LR', 1, 'C');

        $this->elementosAgregados = 0;
    }

    function Footer()
    {
        // Puedes personalizar el pie de página si lo deseas
        $this->SetFont('Arial', '', 10);
        $this->SetY(-20);
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'L');
    }

    function AgregarRegistros()
    {
        $query = "SELECT p.idProducto, p.nombre, p.numeroSerie, p.statusV
            FROM producto AS p
            WHERE p.statusV=1
            ORDER BY p.idProducto";

        $result = $this->conexion->query($query);

        while ($row = $result->fetch_assoc()) {
            if ($this->elementosAgregados >= $this->elementosPorPagina) {
                // Si se alcanza el límite de elementos por página, agrega una nueva página
                $this->AddPage();
                $this->Header(); // Restablece la cabecera de la tabla
            }

            $this->Cell(10, 10, $row['idProducto'], 'LRB', 0, 'C');
            $this->Cell(80, 10, utf8_decode($row['nombre']), 'LRB', 0, 'C');
            $this->Cell(60, 10, utf8_decode($row['numeroSerie']), 'LRB', 0, 'C');
            $estado = ($row['statusV'] == 1) ? 'Activo' : 'Inactivo';
            $this->Cell(40, 10, utf8_decode($estado), 'LRB', 1, 'C');
            $this->elementosAgregados++;
        }
    }
}

$conexion = new mysqli("localhost", "root", "12345678", "inventario");
$pdf = new PDF($conexion);
$pdf->AddPage();
$pdf->AgregarRegistros();

$pdf->Output();
?>