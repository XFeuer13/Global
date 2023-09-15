<?php
require('fpdf/fpdf.php');
require("conexion.php");

// Configura la zona horaria a México
date_default_timezone_set('America/Mexico_City');



class PDF extends FPDF
{

    private $elementosPorPagina = 12; // Cantidad de elementos por página
    private $elementosAgregados = 0;
    private $conexion;

    function __construct($conexion)
    {
        parent::__construct();
        $this->conexion = $conexion;
    }


    function Header()
    {
        // Rutas relativas a las imágenes
        $imagenIzquierda = 'C:\AppServ\www\Global\Imagen\imagen2.png';
        $imagenDerecha = 'C:\AppServ\www\Global\Imagen\imagen1.png';

        $this->Image($imagenIzquierda, 10, 10, 30);
        $this->Image($imagenDerecha, 250, 15, 30); // Ajusta la posición de la imagen derecha
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(280, 10, 'Reporte de Inventario', 0, 1, 'C'); // Ajusta el ancho de la celda
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 10, 'Generado por: Jose Manuel Rangel Cortes', 0, 1, 'C'); // Centra el texto
        $this->Cell(0, 10, 'Tabla de Registros Generados por los Tecnicos', 0, 1, 'C'); // Centra el texto

        // Agregar la fecha actual a la derecha
        $this->SetFont('Arial', '', 12);
        $this->SetX(-60); // Posiciona el cursor de escritura a la derecha
        $this->Cell(60, 10, 'Fecha: ' . date('d/m/Y'), 0, 1, 'C'); // Imprime la fecha actual
        $this-> cell(10,10,"No.",'LR',0);
        $this-> cell(40,10,"Fecha",'LR',0);
        $this-> cell(80,10,utf8_decode("Técnico"),'LR',0);
        $this-> cell(120,10,"Producto",'LR',0);
        $this-> cell(20,10,"Cantidad",'LR',1);

        $this->elementosAgregados = 0;

        $conexion = new mysqli("localhost", "root", "12345678", "inventario");


        $query = "SELECT r.idReporte, r.cantidad, r.fecha, p.nombre AS nombrepro, t.nombre AS nombretec
        FROM reporte AS r
        JOIN producto AS p ON r.idProducto = p.idProducto
        JOIN tecnico AS t ON r.idTecnico = t.idTecnico
        WHERE r.statusV=1
        ORDER BY r.idReporte";

        $result = $conexion -> query ($query);

        while ($row = $result->fetch_assoc())
        {
            $this->Cell(10,10,$row['idReporte'],'LRB',0);
            $this->Ln(); 
            

        }

        $this->Line(10, 40, 290, 40); // Ajusta la línea horizontal
        $this->SetFont('Arial', 'B', 12);
        $this->Ln();
    }



    function Footer()
    {
        // Ruta relativa al código QR
        $codigoQR = 'C:\AppServ\www\Global\Imagen\qr.png';

        // Ajusta la posición del código QR en la esquina inferior derecha
        $this->SetX(-50);
        $this->Image($codigoQR, 260, 175, 30);

        $this->SetFont('Arial', '', 10);
        $this->SetY(-20);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo(), 0, 0, 'L'); // Cambia 'R' a 'L'
    }
}

$pdf = new PDF('L', 'mm', 'A4'); // 'L' para orientación horizontal
$pdf->AddPage();

$pdf->Output();
?>