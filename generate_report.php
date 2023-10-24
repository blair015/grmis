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

// Add a title to the report


// Add custom headers at the top
$pdf->Image('assets/logo/divisionlogo.png', 30, 10, 30, 30);  // Replace with the path to your left logo
$pdf->Image('assets/logo/depedseal.png', 140, 10, 30, 30);  // Replace with the path to your right logo

$pdf->SetFont('Arial', 'B', 12);
// Y-coordinate for the first line
$y = $pdf->GetY();

// Add each line with a specific Y-coordinate
$pdf->SetY($y);
$pdf->Cell(0, 10, 'Republic of the Philippines', 0, 1, 'C');

// Adjust the Y-coordinate for the next line
$y = $pdf->GetY();
$pdf->SetY($y - 5); // You can adjust the value (-5) to control line spacing
$pdf->Cell(0, 10, 'Region XI', 0, 1, 'C');

// Adjust the Y-coordinate for the next line
$y = $pdf->GetY();
$pdf->SetY($y - 5);
$pdf->Cell(0, 10, 'Schools Division of Davao del Sur', 0, 2, 'C');

$pdf->Cell(0, 10, 'Physical Facilities Report', 0, 1, 'C');
$y = $pdf->GetY();
$pdf->SetY($y - 5);
$pdf->Cell(0, 10, 'of '.$school_name, 0, 1, 'C');

// Execute your database query and fetch data

        // Add a section heading
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, 'Physical Facilities', 0, 1);

        $pdf->SetFont('Arial', '', 12);
        // Add the data from the database to the report
        $pdf->Cell(0, 10, 'Academic Classrooms: ' . $academic_classroom, 0, 1);
        $pdf->Cell(0, 10, 'Non-Academic Classrooms: ' . $non_academic_classroom, 0, 1);
        $pdf->Cell(0, 10, 'Needing Repair: ' . $needing_repair, 0, 1);
        $pdf->Cell(0, 10, 'TLS (Teacher Learning Materials): ' . $tls, 0, 1);
        $pdf->Cell(0, 10, 'Makeshift Facilities: ' . $makeshift, 0, 1);
        $pdf->Cell(0, 10, 'Arms and Chairs: ' . $arms_and_chairs, 0, 1);
        $pdf->Cell(0, 10, 'Tables and Chairs: ' . $tables_and_chairs, 0, 1);
        $pdf->Cell(0, 10, 'Functional Clinic: ' . $functional_clinic, 0, 1);

        // Add a section for signatories in the footer
$pdf->SetY(-30);  // Position at 30mm from the bottom of the page

// Left side (Prepared by)
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(70, 10, 'Prepared by:', 0, 0, 'L');

// Next 3 lines for the name of the principal
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Blair Brian A. Torres', 0, 1, 'L');

// Right side (Checked by)
$pdf->SetX(100);  // Move to the right side
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(70, 10, 'Checked by:', 0, 0, 'L');

// Next 3 lines for the name of the checker
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Rannie Taborada', 0, 1, 'L');

// Set headers to force download
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="report.pdf');

// Output the PDF to the browser
$pdf->Output();
    } else {
        echo "No data found in the database.";
    }
} else {
    echo "Error in the database query.";
}
?>
