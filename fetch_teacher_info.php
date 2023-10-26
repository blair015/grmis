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

        // Calculate age from DOB and current date
        $dob = new DateTime($row['dob']);
        $currentDate = new DateTime();
        $age = $dob->diff($currentDate)->y;

        // Format the teacher's information for display
        echo '
        <div class="teacher-profile">
            <div class="teacher-header">
                <img src="teacher-avatar.jpg" alt="Teacher Avatar" class="teacher-avatar">
                <h3>' . $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname'] . '</h3>
                <p>Employee Number: ' . $row['emp_no'] . '</p>
                <p>Item Number: ' . $row['item_no'] . '</p>
            </div>
            <div class="teacher-details">
                <p>Designation: ' . $row['position_type'] . '</p>
                <p>Position: ' . $row['position_rank'] . '</p>
                <p>Years in Service: ' . $row['yrs_in_serv'] . '</p>
                <p>Age: ' . $age . ' years old</p>
                <p>Birthday: ' . $row['dob'] . '</p>
                <p>Sex: ' . $row['sex'] . '</p>
                <p>Civil Status: ' . $row['civilstatus'] . '</p>
                <p>Mobile Number: ' . $row['mobile'] . '</p>
                <p>Email Address: ' . $row['email'] . '</p>
            </div>
        </div>';
    } else {
        echo "Teacher not found.";
    }

    $stmt->close();
} else {
    echo "Error in preparing the SQL statement.";
}
?>
