<?php 
include('libreria/fpdf.php');
include_once('clases/ListaEmpleados.php');

session_start();
if (empty($_SESSION['lista'])) {
    $_SESSION['lista'] = new ListaEmpleados();
}
$listaEmpleados = $_SESSION['lista'];
$empleados = $listaEmpleados->obtenerTodosLosEmpleados();

$pdf = new FPDF();

$pdf->AddPage();

$pdf->Image('imagenes/logo.png',20,15,35);
$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(15);
$pdf->Cell(0,35,'REGISTROS DE EMPLEADOS',0,1,'C');

$pdf->SetFillColor(232, 232, 232);

$pdf->SetFont('Arial', '', 15);
$pdf->SetTextColor(6, 16, 146); // Azul oscuro
$pdf->Cell(10,10, utf8_decode('N°'),1,0,'C');
$pdf->Cell(20,10, utf8_decode('Código'),1,0,'C');
$pdf->Cell(35,10,'Nombres',1,0,'C');
$pdf->Cell(45,10,'Apellidos',1,0,'C');
$pdf->Cell(50,10,'Tipo de Contrato',1,0,'C');
$pdf->Cell(30,10,'Sueldo',1,1,'C');

$pdf->SetFont('Arial', '', 11);
$pdf->SetTextColor(0); // Negro

$num = 1;
foreach ($empleados as $empleado) {
    $pdf->Cell(10,10,$num,1,0,'C',1);
    $pdf->Cell(20,10,$empleado->codigo,1,0,'C',1);
    $pdf->Cell(35,10,utf8_decode($empleado->nombre),1,0,'C',1);
    $pdf->Cell(45,10,utf8_decode($empleado->apellido),1,0,'C',1);
    $pdf->Cell(50,10,$empleado->tipoContrato,1,0,'C',1);
    $pdf->Cell(30,10,'S/ '.$empleado->sueldo.'.00',1,1,'C',1);
    $num++;
}

$pdf->Output();

?>