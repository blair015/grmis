<style>
    .teacher-profile {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .teacher-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .teacher-labels {
        display: flex;
        flex-direction: column;
        align-items: flex-start; /* Align labels to the left */
    }

    .teacher-labels label {
        margin: 5px;
        font-weight: bold;
    }

    .teacher-details {
        text-align: left;
        margin: 10px;
    }

    .teacher-details input {
        width: 100%;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
</style>

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
                <h3>' . $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname'] . '</h3>
            </div>
            <div class="teacher-labels">
            <div class="info-group">
            <i class="fas fa-id-card" style="color: gray;"></i>
            <label for="emp_no" style="color: gray;">Employee Number:</label>
            <input type="text" id="emp_no" value="' . $row['emp_no'] . '" readonly>
        </div>
        <div class="info-group">
            <i class="fas fa-briefcase" style="color: gray;"></i>
            <label for="item_no" style="color: gray;">Item Number:</label>
            <input type="text" id="item_no" value="' . $row['item_no'] . '" readonly>
        </div>
        <div class="info-group">
            <i class="fas fa-user-tie" style="color: gray;"></i>
            <label for="position_type" style="color: gray;">Designation:</label>
            <input type="text" id="position_type" value="' . $row['position_type'] . '" readonly>
        </div>
        <div class="info-group">
            <i class="fas fa-chalkboard-teacher" style="color: gray;"></i>
            <label for="position_rank" style="color: gray;">Position:</label>
            <input type="text" id="position_rank" value="' . $row['position_rank'] . '" readonly>
        </div>
        <div class="info-group">
            <i class="fas fa-clock" style="color: gray;"></i>
            <label for="yrs_in_serv" style="color: gray;">Years in Service:</label>
            <input type="text" id="yrs_in_serv" value="' . $row['yrs_in_serv'] . '" readonly>
        </div>
        <div class="info-group">
            <i class="fas fa-birthday-cake" style="color: gray;"></i>
            <label for="age" style="color: gray;">Age:</label>
            <input type="text" id="age" value="' . $age . ' years old" readonly>
        </div>
        <div class="info-group">
            <i class="fas fa-calendar-alt" style="color: gray;"></i>
            <label for="dob" style="color: gray;">Birthday:</label>
            <input type="text" id="dob" value="' . $row['dob'] . '" readonly>
        </div>
        <div class="info-group">
            <i class="fas fa-venus-mars" style="color: gray;"></i>
            <label for="sex" style="color: gray;">Sex:</label>
            <input type="text" id="sex" value="' . $row['sex'] . '" readonly>
        </div>
        <div class="info-group">
            <i class="fas fa-ring" style="color: gray;"></i>
            <label for "civilstatus" style="color: gray;">Civil Status:</label>
            <input type="text" id="civilstatus" value="' . $row['civilstatus'] . '" readonly>
        </div>
        <div class="info-group">
            <i class="fas fa-mobile-alt" style="color: gray;"></i>
            <label for="mobile" style="color: gray;">Mobile Number:</label>
            <input type="text" id="mobile" value="' . $row['mobile'] . '" readonly>
        </div>
        <div class="info-group">
            <i class="fas fa-envelope" style="color: gray;"></i>
            <label for="email" style="color: gray;">Email Address:</label>
            <input type="text" id="email" value="' . $row['email'] . '" readonly>
        </div>
        
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
