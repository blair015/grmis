<?php
require('fpdf/fpdf.php');
include 'admin/config/dbcon.php';

$selectedSchoolId2 = $_GET['school_id'];

$sql = "SELECT school_name, academic_classroom, non_academic_classroom, needing_repair, tls, makeshift, arms_and_chairs, tables_and_chairs, functional_clinic
        FROM school_profile AS sp
        WHERE sp.school_id = ?";

if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $selectedSchoolId2);
    $stmt->execute();
    $stmt->bind_result($school_name, $academic_classroom, $non_academic_classroom, $needing_repair, $tls, $makeshift, $arms_and_chairs, $tables_and_chairs, $functional_clinic);

    if ($stmt->fetch()) {
        // Create a new PDF instance
        $pdf = new FPDF();
        $pdf->AddPage();

        // Set font and size for the report
        $pdf->SetFont('Arial', 'B', 14);

        // Add custom headers at the top
        $pdf->Image('assets/logo/divisionlogo.png', 35, 10, 28, 28); // Left logo
        $pdf->Image('assets/logo/depedseal.png', 150, 10, 30, 30); // Right logo

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, 'Republic of the Philippines', 0, 1, 'C');
        $pdf->Cell(0, 10, 'Region XI', 0, 1, 'C');
        $pdf->Cell(0, 10, 'Schools Division of Davao del Sur', 0, 2, 'C');
        $pdf->Cell(0, 10, 'Physical Facilities Report', 0, 1, 'C');
        $pdf->Cell(0, 10, 'of ' . $school_name, 0, 1, 'C');

        // Add a section heading
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, 'Physical Facilities', 0, 1);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, 'Academic Classrooms: ' . $academic_classroom, 0, 1);
        $pdf->Cell(0, 10, 'Non-Academic Classrooms: ' . $non_academic_classroom, 0, 1);
        $pdf->Cell(0, 10, 'Needing Repair: ' . $needing_repair, 0, 1);
        $pdf->Cell(0, 10, 'TLS (Temporary Learning Shelter): ' . $tls, 0, 1);
        $pdf->Cell(0, 10, 'Makeshift: ' . $makeshift, 0, 1);
        $pdf->Cell(0, 10, 'Arms and Chairs: ' . $arms_and_chairs, 0, 1);
        $pdf->Cell(0, 10, 'Tables and Chairs: ' . $tables_and_chairs, 0, 1);
        $pdf->Cell(0, 10, 'Functional Clinic: ' . $functional_clinic, 0, 1);

       // Add a section for signatories in the footer
// Add space
$pdf->Cell(0, 10, '', 0, 1);

// Add a section for signatories in the footer

// Left side (Prepared by)
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(70, 10, 'Prepared by:', 0, 0, 'L');

// Name of the principal
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Blair Brian A. Torres', 0, 1, 'L');

// Right side (Checked by)
$pdf->SetX(100);  // Move to the right side
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(70, 10, 'Checked by:', 0, 0, 'L');

// Name of the checker
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Rannie Taborada', 0, 1, 'L');

// Output the PDF to the browser
$pdf->Output();
    } else {
        echo "No data found in the database.";
    }
} else {
    echo "Error in the database query.";
}
?>
