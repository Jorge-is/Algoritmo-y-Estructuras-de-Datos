<?php 
include('libreria/fpdf.php');
if(isset($_GET['buscar']) && isset($_GET['lista']) && isset($_GET['indice'])){
    $lista = $_GET['lista'];
    $buscar = $_GET['buscar'];
    $indice = $_GET['indice'];
}else{
    $lista = "";
    $buscar ="";
    $indice ="";
}

$pdf = new FPDF();

$pdf->AddPage();

$pdf->Image('imagenes/logo.png',20,15,35);
$pdf->SetFont('Arial', 'B',18);
$pdf->Cell(20);
$pdf->Cell(0,35, utf8_decode('MÉTODO DE BÚSQUEDA BINARIA'),0,1,'C');

$pdf->Ln(10);

$pdf->SetFont('Arial', '', 15);
$pdf->SetFillColor(232, 232, 232);
$pdf->SetTextColor(6, 16, 146); // Azul oscuro
$pdf->SetX(40);
$pdf->Cell(50,10,'Lista o arreglo',0,0,'L');
$pdf->SetTextColor(0); // Negro
$pdf->Cell(70,10,$lista,1,1,'C',1);

$pdf->Ln(10);

$pdf->SetFont('Arial', '', 15);
$pdf->SetTextColor(6, 16, 146); // Azul oscuro
$pdf->SetX(40);
$pdf->Cell(50,10, utf8_decode('Número buscado'),0,0,'L');
$pdf->SetTextColor(0); // Negro
$pdf->Cell(70,10,$buscar,1,1,'C',1);

$pdf->Ln(10); //Salto de linea

$pdf->SetFont('Arial', '', 14);
$pdf->SetTextColor(255, 0, 0); //Rojo
$pdf->Cell(0,10,'Resultado',0,1,'C');

$texto1 = 'El número ';
$texto2 = ' se encuentra en el índice ';
$pdf->Ln(5);

$pdf->SetTextColor(0); // Negro

if (isset($indice)) {
    $pdf->Cell(0,15, utf8_decode($texto1).$buscar.utf8_decode($texto2).$indice,1,1,'C',1);
} else {
    $pdf->Cell(0,15, utf8_decode('No se encontró el número en el arreglo'),0,1,'C');
}

$pdf->Image('imagenes/qr.png',85,140,40); 

$pdf->SetFont('Arial', '', 12);
$pdf->SetXY(120,200);
$pdf->Cell(80,10,'JORGE ANTONIO FLORES ARANA',0,1,'C');

$pdf->Output();
?>