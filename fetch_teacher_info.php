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

        // Display the teacher's information using input fields
        echo '
        <div class="teacher-profile">
            <div class="teacher-header">
                <img src="teacher-avatar.jpg" alt="Teacher Avatar" class="teacher-avatar">
                <h3>' . $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname'] . '</h3>
                <input type="text" value="' . $row['emp_no'] . '" readonly>
                <input type="text" value="' . $row['item_no'] . '" readonly>
            </div>
            <div class="teacher-details">
                <input type="text" value="' . $row['position_type'] . '" readonly>
                <input type="text" value="' . $row['position_rank'] . '" readonly>
                <input type="text" value="' . $row['yrs_in_serv'] . '" readonly>
                <input type="text" value="' . $age . ' years" readonly>
                <input type="text" value="' . $row['dob'] . '" readonly>
                <input type="text" value="' . $row['sex'] . '" readonly>
                <input type="text" value="' . $row['civilstatus'] . '" readonly>
                <input type="text" value="' . $row['mobile'] . '" readonly>
                <input type="text" value="' . $row['email'] . '" readonly>
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
