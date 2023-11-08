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
                                    <label for="spedyes">Yes</label>
                                    <input type="radio" id="spedyes" name="spedOption" value="1">
                                </div>
                                <div class="col">
                                    <label for="spedno">No</label>
                                    <input type="radio" id="spedno" name="spedOption" value="2">
                                </div>
                            </div>
                        </div>

                        <div class="form-group" id="spedInput" style="display: none;">
                            <label for="spedText">Number of Enrolled Learners:</label>
                            <input type="text" id="spedText" name="spedText">
                        </div>
                        <div class="form-group">
                            <label>Do you offer ALIVE Program?</label>
                            <div class="row">
                                <div class="col">
                                    <label for="aliveyes">Yes</label>
                                    <input type="radio" id="aliveyes" name="aliveOption" value="1">
                                </div>
                                <div class="col">
                                    <label for="aliveno">No</label>
                                    <input type="radio" id="aliveno" name="aliveOption" value="2">
                                </div>
                            </div>
                        </div>

                        <div class="form-group" id="aliveInput" style="display: none;">
                            <label for="spedText">Number of Enrolled Learners:</label>
                            <input type="text" id="aliveText" name="aliveText">
                        </div>
                        <div class="form-group">
                            <label>Do you offer IPED Program?</label>
                            <div class="row">
                                <div class="col">
                                    <label for="ipedeyes">Yes</label>
                                    <input type="radio" id="ipedyes" name="ipedOption" value="1">
                                </div>
                                <div class="col">
                                    <label for="ipedno">No</label>
                                    <input type="radio" id="ipedno" name="ipedOption" value="2">
                                </div>
                            </div>
                        </div>

                        <div class="form-group" id="ipedInput" style="display: none;">
                            <label for="ipedText">Number of Enrolled Learners:</label>
                            <input type="text" id="ipedText" name="ipedText">
                        </div>
                        <div class="form-group">
                            <label>Do you offer ALS Program?</label>
                            <div class="row">
                                <div class="col">
                                    <label for="alsyes">Yes</label>
                                    <input type="radio" id="alsyes" name="alsOption" value="1">
                                </div>
                                <div class="col">
                                    <label for="alsno">No</label>
                                    <input type="radio" id="alsno" name="alsOption" value="2">
                                </div>
                            </div>
                        </div>

                        <div class="form-group" id="alsInput" style="display: none;">
                            <label for="alsText">Number of Enrolled Learners:</label>
                            <input type="text" id="alsText" name="alsText">
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
    const aliveyes = document.getElementById("aliveyes");
    const aliveno = document.getElementById("aliveno");
    const aliveInput = document.getElementById("aliveInput");
    const ipedyes = document.getElementById("ipedyes");
    const ipedno = document.getElementById("ipedno");
    const ipedInput = document.getElementById("ipedInput");
    const alsyes = document.getElementById("alsyes");
    const alsno = document.getElementById("alsno");
    const alsInput = document.getElementById("alsInput");

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
    aliveyes.addEventListener("change", function () {
        if (aliveyes.checked) {
            aliveInput.style.display = "block";
        }
    });

    aliveno.addEventListener("change", function () {
        if (aliveno.checked) {
            aliveInput.style.display = "none";
        }
    });
    ipedyes.addEventListener("change", function () {
        if (ipedyes.checked) {
            ipedInput.style.display = "block";
        }
    });

    ipedno.addEventListener("change", function () {
        if (ipedno.checked) {
            ipedInput.style.display = "none";
        }
    });
    alsyes.addEventListener("change", function () {
        if (alsyes.checked) {
            alsInput.style.display = "block";
        }
    });

    alsno.addEventListener("change", function () {
        if (alsno.checked) {
            alsInput.style.display = "none";
        }
    });
</script>