<?php
require('fpdf/fpdf.php');
include 'admin/config/dbcon.php';

$selectedSchoolId2 = $_GET['school_id'];

// Create a new PDF instance
$pdf = new FPDF();
$pdf->AddPage();

// Set font and size for the report
$pdf->SetFont('Arial', 'B', 14);

// Add a title to the report
$pdf->Cell(0, 10, 'Physical Facilities Report', 0, 1, 'C');

// Add custom headers at the top
$pdf->Image('assets/logo/divisionlogo.png', 10, 10, 20);  // Replace with the path to your left logo
$pdf->Image('assets/logo/depedseal.png', 180, 10, 20);  // Replace with the path to your right logo

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Republic of the Philippines', 0, 1, 'C');
$pdf->Cell(0, 10, 'Region XI', 0, 1, 'C');
$pdf->Cell(0, 10, 'Schools Division of Davao del Sur', 0, 1, 'C');

// Execute your database query and fetch data
$sql = "SELECT academic_classroom, non_academic_classroom, needing_repair, tls, makeshift, arms_and_chairs, tables_and_chairs, functional_clinic
        FROM school_profile AS sp
        WHERE sp.school_id = ?";

if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $selectedSchoolId2);
    $stmt->execute();
    $stmt->bind_result($academic_classroom, $non_academic_classroom, $needing_repair, $tls, $makeshift, $arms_and_chairs, $tables_and_chairs, $functional_clinic);

    if ($stmt->fetch()) {
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
