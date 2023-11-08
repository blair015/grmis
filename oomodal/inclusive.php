<!-- Modal for "Inclusive Education" -->
<div class="modal fade" id="inclusiveEducationModal" tabindex="-1" role="dialog" aria-labelledby="inclusiveEducationModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inclusiveEducationModal">Outcome Indicators Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="ratioForm" method="post" action="oomodal/save_ratio_outcome.php">
                    <?php
                    if (isset($_GET['school_id'])) {
                        $_SESSION['school_id'] = $_GET['school_id'];
                    } else {
                        echo "School identifier is missing.";
                        exit;
                    }
                    include ('admin/config/dbcon.php');
                    $school_id = $_SESSION['school_id'];
                    echo $school_id;
                    ?>
                    <input type="hidden" id="schoolId" name="schoolId" value="<?php echo $school_id; ?>">
                    <div class="form-group">
                            <label>Do you offer SPED Program?</label>
                            <div class="row">
                                <div class="col">
                                    <label for="quarter1">Yes</label>
                                    <input type="radio" id="spedyes" name="spedOption" value="1">
                                </div>
                                <div class="col">
                                    <label for="quarter2">No</label>
                                    <input type="radio" id="spedno" name="spedOption" value="2">
                                </div>
                            </div>
                        </div>

                        <div class="form-group" id="spedInput" style="display: none;">
                            <label for="spedText">Please provide more details:</label>
                            <input type="text" id="spedText" name="spedText">
                        </div>
                    <div class="form-group">
                        <label for="researchCompleted">Enter the number of enrolled learners in SPED</label>
                        <input type="text" id="sped" name="standardRatio" class="form-control" placeholder="Enter the standard ratio for teachers">
                    </div>
                    <div class="form-group">
                        <label for="researchCompleted">Ratio for Classrooms</label>
                        <input type="text" id="classroomRatio" name="classroomRatio" class="form-control" placeholder="Enter the ratio for classrooms">
                    </div>
                    <div class="form-group">
                        <label for="researchCompleted">ICT Packages Received</label>
                        <input type="text" id="receivedPackages" name="receivedPackages" class="form-control" placeholder="Enter the ICT Packages received">
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
                            <button type="button" id="saveRatio" class="btn btn-primary">Save</button>
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
    $("#ratioForm").on("submit", function (event) {
        event.preventDefault(); // Prevent the default form submission
        $("#outcomeIndicatorsModal").modal("show"); // Corrected modal ID
    });

    // When the "Save" button in the modal is clicked, submit the form
    $("#saveRatio").on("click", function() {
        $("#ratioForm").off("submit"); // Remove the previous event handler
        $("#ratioForm").submit(); // Submit the form
    });

    $("#confirm_overwrite").on("click", function() {
        // Submit the form when "Yes" is clicked
        $("#ratioForm").submit();
    });
});
</script>


<script>
    // Add an event listener to the radio buttons
    const spedyes = document.getElementById("spedyes");
    const spedno = document.getElementById("spedno");
    const spedInput = document.getElementById("spedInput");

    spedyes.addEventListener("change", function () {
        if (spedyes.checked) {
            spedInput.style.display = "block";
        }
    });

    spedno.addEventListener("change", function () {
        if (spedno.checked) {
            spedInput.style.display = "none";
        }
    });
</script>