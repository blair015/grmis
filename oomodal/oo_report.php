<?php
require('../fpdf/fpdf.php');
include '../admin/config/dbcon.php';

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 12);
        // Merge cells from the first column to the last column in the first row
        $this->Cell(0, 10, 'Table with 5 columns and 10 rows', 0, 1, 'C');
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();

// Column widths
$columnWidths = array(40, 40, 40, 40, 40);

// Header
$pdf->SetFont('Arial', 'B', 10);
// Skip individual cells for the first row
$pdf->Cell($columnWidths[0] + $columnWidths[1] + $columnWidths[2] + $columnWidths[3] + $columnWidths[4], 10, '', 0, 1);
$pdf->Ln();

// Data
$pdf->SetFont('Arial', '', 10);
for ($i = 1; $i <= 10; $i++) {
    $pdf->Cell($columnWidths[0], 10, 'Row ' . $i . ', Col 1', 1);
    $pdf->Cell($columnWidths[1], 10, 'Row ' . $i . ', Col 2', 1);
    $pdf->Cell($columnWidths[2], 10, 'Row ' . $i . ', Col 3', 1);
    $pdf->Cell($columnWidths[3], 10, 'Row ' . $i . ', Col 4', 1);
    $pdf->Cell($columnWidths[4], 10, 'Row ' . $i . ', Col 5', 1);
    $pdf->Ln();
}

$pdf->Output();
?>
