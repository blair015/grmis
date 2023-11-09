<!-- Modal for "Outcome Indicators" -->
<div class="modal fade" id="hrmModal" tabindex="-1" role="dialog" aria-labelledby="hrmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hrmModalLabel">Education Human Resource Development Program</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="hrmForm" method="post" action="oomodal/save_hrm.php">
                    <?php
                    if (isset($_GET['school_id'])) {
                        $_SESSION['school_id'] = $_GET['school_id'];
                    } else {
                        echo "School identifier is missing.";
                        exit;
                    }
                    include ('admin/config/dbcon.php');
                    $school_id = $_SESSION['school_id'];
                   // echo $school_id;
                    ?>
                    <input type="hidden" id="schoolId" name="schoolId" value="<?php echo $school_id; ?>">
                    <div class="form-group">
                        <label for="researchCompleted">LAC Session</label>
                        <input type="text" id="lacSession" name="lacSession" class="form-control" placeholder="Enter the Number of Lac Session">
                    </div>
                    <div class="form-group">
                        <label for="researchCompleted">Number of Teachers Trained</label>
                        <input type="text" id="teachersTrained" name="teachersTrained" class="form-control" placeholder="Enter the number of teachers trained">
                    </div>
                    <div class="form-group">
                        <label for="researchCompleted">Number of Teaching-related staff Trained</label>
                        <input type="text" id="relatedTrained" name="relatedTrained" class="form-control" placeholder="Enter the number of Teaching-related trained">
                    </div>
                    <div class="form-group">
                        <label>Quarters</label>
                        <div class="row">
                            <div class="col">
                                <label for="quarter1">Q1</label>
                                <input type="radio" id="quarter1" name="quarter" value="1">
                            </div>
                            <div class="col">
                                <label for="quarter2">Q2</label>
                                <input type="radio" id="quarter2" name="quarter" value="2">
                            </div>
                            <div class="col">
                                <label for ="quarter3">Q3</label>
                                <input type="radio" id="quarter3" name="quarter" value="3">
                            </div>
                            <div class="col">
                                <label for="quarter4">Q4</label>
                                <input type="radio" id="quarter4" name="quarter" value="4">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="schoolYear">School Year</label>
                        <select id="schoolYear" name="schoolYear" class="form-control">
                            <?php
                            // Generate options for school years from 2023-2024 to 2030
                            for ($year = 2023; $year <= 2050; $year++) {
                                $nextYear = $year + 1;
                                $schoolYear = $year . '-' . $nextYear;
                                echo '<option value="' . $schoolYear . '">' . $schoolYear . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" id="savehrm" class="btn btn-primary">Save</button>
                        </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- Include jQuery and Bootstrap scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
$(document).ready(function () {
    // When the form is submitted, show the confirmation modal
    $("#hrmForm").on("submit", function (event) {
        event.preventDefault(); // Prevent the default form submission
        $("#hrmModal").modal("show"); // Corrected modal ID
    });

    // When the "Save" button in the modal is clicked, submit the form
    $("#savehrm").on("click", function() {
        $("#hrmForm").off("submit"); // Remove the previous event handler
        $("#hrmForm").submit(); // Submit the form
    });

    $("#confirm_overwrite").on("click", function() {
        // Submit the form when "Yes" is clicked
        $("#hrmForm").submit();
    });
});
</script>
