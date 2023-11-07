<?php
session_start();
include('../admin/config/dbcon.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $schoolId = $_POST['schoolId'] ?? null;
    $researchCompleted = $_POST['researchCompleted'] ?? null;
    $quarter = $_POST['quarter'] ?? null;
    $schoolYear = $_POST['schoolYear'] ?? null; // Retrieve the selected school year
    $user_school_id = isset($_SESSION['school_id']) ? $_SESSION['school_id'] : '';

    // You should perform some validation and sanitization of input data here to prevent SQL injection

    // Check if data already exists for the given school year and quarter
    $checkQuery = "SELECT * FROM oo_research WHERE school_id = ? AND quarter = ? AND school_year = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("iss", $schoolId, $quarter, $schoolYear);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        // Data already exists, prompt the user for confirmation using a Bootstrap modal dialog
        echo '<div class="modal fade" id="overwriteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="overwriteConfirmationModalLabel" aria-hidden="true">';
        echo '    <div class="modal-dialog" role="document">';
        echo '        <div class="modal-content">';
        echo '            <div class="modal-header">';
        echo '                <h5 class="modal-title" id="overwriteConfirmationModalLabel">Confirmation</h5>';
        echo '                <button type="button" class="close" data-dismiss="modal" aria-label="Close">';
        echo '                    <span aria-hidden="true">&times;</span>';
        echo '                </button>';
        echo '            </div>';
        echo '            <div class="modal-body">';
        echo '                Data for the selected school year and quarter already exists. Do you want to overwrite it?';
        echo '            </div>';
        echo '            <div class="modal-footer">';
        echo '                <form method="post" action="oomodal/save_research.php">';
        echo '                    <input type="hidden" name="schoolId" value="' . $schoolId . '">';
        echo '                    <input type="hidden" name="researchCompleted" value="' . $researchCompleted . '">';
        echo '                    <input type="hidden" name="quarter" value="' . $quarter . '">';
        echo '                    <input type="hidden" name="schoolYear" value="' . $schoolYear . '">';
        echo '                    <button type="submit" name="confirm_overwrite" class="btn btn-primary">Yes</button>';
        echo '                    <button type="submit" name="cancel_overwrite" class="btn btn-secondary" data-dismiss="modal">No</button>';
        echo '                </form>';
        echo '            </div>';
        echo '        </div>';
        echo '    </div>';
        echo '</div>';
        echo '<script>$("#overwriteConfirmationModal").modal("show");</script>';
    } else {
        // Data does not exist, proceed with redirection
        header("Location: insert_research.php?schoolId=$schoolId&researchCompleted=$researchCompleted&quarter=$quarter&schoolYear=$schoolYear&user_school_id=$user_school_id");
        exit;
    }

    $checkStmt->close();
    $conn->close();
} else {
    // If the request is not POST, you can handle it as needed.
    echo "Invalid request method.";
}
?>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

