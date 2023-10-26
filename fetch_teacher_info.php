<?php
include 'admin/config/dbcon2.php';

$teacherId = $_GET['emp_no'];

// Create and execute a query to fetch the teacher's information
$sql = "SELECT e.yrs_in_serv, e.position_type, e.item_no, pi.emp_no, pi.lastname, pi.firstname, pi.middlename, e.position_rank, pi.dob, pi.pob, pi.sex, pi.civilstatus, pi.mobile, pi.email
FROM employment_record AS e
INNER JOIN personal_info AS pi ON e.emp_no = pi.emp_no
WHERE e.emp_no = ?";

if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $teacherId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Format the teacher's information for display
        $html = "<h5>Teacher Profile</h5>";
        $html .= "<p>Name: " . $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname'] . "</p>";
        // Add more information here...

        echo $html;
    } else {
        echo "Teacher not found.";
    }

    $stmt->close();
} else {
    echo "Error in preparing the SQL statement.";
}
?>
