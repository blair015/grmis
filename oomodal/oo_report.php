<?php
require('../fpdf/fpdf.php');
include '../admin/config/dbcon.php';

class PDF extends FPDF
{
    public $columnWidths = array(); // Initialize the property with an empty array

    function Header()
    {
        $this->SetFont('Arial', 'B', 12);

        // Check if columnWidths is set and not empty before using it
        if (!empty($this->columnWidths)) {
            // Add a row at the top with "PAPS" centered across all columns
            $this->Cell(array_sum($this->columnWidths), 10, 'PAPS', 1, 1, 'C'); // Use 1 for the border
        }

        foreach ($this->columnWidths as $width) {
            $this->Cell($width, 10, '', 1);
        }
        $this->Ln();
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
$pdf->columnWidths = $columnWidths; // Assign column widths to the class property

// Data
$pdf->SetFont('Arial', '', 10);
for ($i = 1; $i <= 10; $i++) {
    foreach ($columnWidths as $width) {
        $pdf->Cell($width, 10, 'Row ' . $i . ', Col', 1);
    }
    $pdf->Ln();
}

$pdf->Output();
?>
