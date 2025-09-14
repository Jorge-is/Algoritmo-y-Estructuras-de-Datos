<?php
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

include_once('clases/ArbolEmpleados.php');

session_start();
if (empty($_SESSION['arbol'])) {
    $_SESSION['arbol'] = new ArbolEmpleados();
}
$arbolEmpleados = $_SESSION['arbol'];
$empleados = $arbolEmpleados->obtenerTodosLosEmpleados();

$spreadsheet = new Spreadsheet();
$excel = $spreadsheet->getActiveSheet();

//Establecer el título de la hoja
$excel->setTitle('Empleados');

//Títulos de la tabla
$excel->setCellValue('A1', 'REGISTRO DE EMPLEADOS');
$excel->mergeCells('A1:F1'); //Unir celdas para el título
$excel->setCellValue('A2', 'Árbol Binario');
$excel->mergeCells('A2:F2'); //Unir celdas para el subtítulo

//Estilo de los títulos
$excel->getStyle('A1:F1')->applyFromArray([
    'font' => [
        'bold' => true,
        'color' => ['argb' => 'FFFFFFFF'],
        'size' => 16,
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['argb' => 'FF4F81BD'],
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER,
    ],
]);
$excel->getStyle('A2')->applyFromArray([
    'font' => [
        'italic' => true,
        'size' => 12,
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER,
    ],
]);

//Establecer los encabezados de la tabla
$encabezados = ['N°', 'Código', 'Nombre', 'Apellido', 'Tipo de Contrato', 'Sueldo'];
$columna = 'A';
foreach ($encabezados as $encabezado) {
    $excel->setCellValue($columna . '3', $encabezado);
    $columna++;
}

//Aplicar estilos a los encabezados
$excel->getStyle('A3:F3')->applyFromArray([
    'font' => [
        'bold' => true,
        'color' => ['argb' => 'FFFFFFFF'],
        'size' => 12,
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER,
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['argb' => 'FF4F81BD'],
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['argb' => 'FFFFFFFF'],
        ],
    ],
]);

//Ajustar el ancho de las columnas
foreach (range('A', 'F') as $columna) {
    $excel->getColumnDimension($columna)->setAutoSize(true);
}

//Agregar filtros a los encabezados
$excel->setAutoFilter('A3:F3');

//Agregar los datos de los empleados
$row = 4; //Los datos ahora empiezan en la fila 4
$numeroRegistro = 1;
foreach ($empleados as $empleado) {
    $excel->setCellValue('A' . $row, $numeroRegistro);
    $excel->setCellValue('B' . $row, $empleado->codigo);
    $excel->setCellValue('C' . $row, $empleado->nombre);
    $excel->setCellValue('D' . $row, $empleado->apellido);
    $excel->setCellValue('E' . $row, $empleado->tipoContrato);
    $excel->setCellValue('F' . $row, 'S/ ' . $empleado->sueldo . '.00');

    // Aplicar bordes y alineación a las celdas
    $excel->getStyle('A' . $row . ':F' . $row)->applyFromArray([
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['argb' => 'FF000000'],
            ],
        ],
        'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER,
        ],
    ]);

    // Aplicar un color de fondo alternante a las filas
    if ($row % 2 == 0) {
        $excel->getStyle('A' . $row . ':F' . $row)->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFF2F2F2'],
            ],
        ]);
    }

    $row++;
    $numeroRegistro++;
}

$writer = new Xlsx($spreadsheet);
$fileName = 'Empleados.xlsx';

// Enviar el archivo al navegador para descargar
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $fileName . '"');
header('Cache-Control: max-age=0');

$writer->save('php://output');
exit;
?>
