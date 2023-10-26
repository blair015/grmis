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

        // Display the teacher's information using input fields with labels
        echo '
        <div class="teacher-profile">
            <div class="teacher-header">
                <img src="teacher-avatar.jpg" alt="Teacher Avatar" class="teacher-avatar">
                <h3>' . $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname'] . '</h3>
                <div class="teacher-labels">
                    <label for="emp_no">Employee Number</label>
                    <input type="text" id="emp_no" value="' . $row['emp_no'] . '" readonly>
                    <label for="item_no">Item Number</label>
                    <input type="text" id="item_no" value="' . $row['item_no'] . '" readonly>
                </div>
            </div>
            <div class="teacher-details">
                <label for="position_type">Designation</label>
                <input type="text" id="position_type" value="' . $row['position_type'] . '" readonly>
                <label for="position_rank">Position</label>
                <input type="text" id="position_rank" value="' . $row['position_rank'] . '" readonly>
                <label for="yrs_in_serv">Years in Service</label>
                <input type="text" id="yrs_in_serv" value="' . $row['yrs_in_serv'] . '" readonly>
                <label for="age">Age</label>
                <input type="text" id="age" value="' . $age . ' years" readonly>
                <label for="dob">Birthday</label>
                <input type="text" id="dob" value="' . $row['dob'] . '" readonly>
                <label for="sex">Sex</label>
                <input type="text" id="sex" value="' . $row['sex'] . '" readonly>
                <label for="civilstatus">Civil Status</label>
                <input type="text" id="civilstatus" value="' . $row['civilstatus'] . '" readonly>
                <label for="mobile">Mobile Number</label>
                <input type="text" id="mobile" value="' . $row['mobile'] . '" readonly>
                <label for="email">Email Address</label>
                <input type="text" id="email" value="' . $row['email'] . '" readonly>
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
