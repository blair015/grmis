<!-- Modal structure -->
<div class="modal" id="retentionEducationModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Retention Rate Modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="retentionForm" method="post" action="oomodal/save_retention.php">
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
                            <label>Are You offering?</label>
                            <div class="row">
                                <div class="col">
                                    <label for="elementary">Elementary</label>
                                    <input type="radio" id="elementary" name="elementaryOption" value="Elementary">
                                </div>
                                <div class="col">
                                    <label for="secondary">Secondary</label>
                                    <input type="radio" id="secondary" name="secondaryOption" value="Secondary">
                                </div>
                                <div class="col">
                                    <label for="secondaryandshs">Secondary & SHS</label>
                                    <input type="radio" id="secondaryandshs" name="secondarandshsyOption" value="SecondaryandSHS">
                                </div>
                                <div class="col">
                                    <label for="shs">SHS Only</label>
                                    <input type="radio" id="shs" name="shsOption" value="SHS">
                                </div>
                            </div>
                        </div>

                        <div class="form-group" id="grade1Input" style="display: none;">
                            <label for="grade1Text">Grade 1:</label>
                            <input type="text" id="grade1Text" name="grade1Text">
                        </div>
                        <div class="form-group" id="grade2Input" style="display: none;">
                            <label for="grade2Text">Grade 2:</label>
                            <input type="text" id="grade2Text" name="grade2Text">
                        </div>
                        <div class="form-group" id="grade3Input" style="display: none;">
                            <label for="grade3Text">Grade 3:</label>
                            <input type="text" id="grade3Text" name="grade3Text">
                        </div>
                        <div class="form-group" id="grade4Input" style="display: none;">
                            <label for="grade4Text">Grade 1:</label>
                            <input type="text" id="grade4Text" name="grade4Text">
                        </div>
                        <div class="form-group" id="grade5Input" style="display: none;">
                            <label for="grade5Text">Grade 5:</label>
                            <input type="text" id="grade5Text" name="grade5Text">
                        </div>
                        <div class="form-group" id="grade6Input" style="display: none;">
                            <label for="grade6Text">Grade 1:</label>
                            <input type="text" id="grade6Text" name="grade6Text">
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
                            <button type="button" id="saveInclusive" class="btn btn-primary">Save</button>
                        </div>

                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // jQuery script to show/hide input fields based on radio button selection
    $(document).ready(function () {
        // Function to show/hide input fields based on radio button selection
        function showHideFields() {
            var selectedOption = $('input[name="elementaryOption"]:checked').val();

            // Hide all grade input fields initially
            $('[id^="gradeInput"]').hide();

            // Show grade input fields based on the selected radio button
            if (selectedOption === 'Elementary') {
                $('#grade1Input, #grade2Input, #grade3Input, #grade4Input, #grade5Input, #grade6Input').show();
            } else {
                // Add logic for other options if needed
            }
        }

        // Trigger the function on page load
        showHideFields();

        // Bind the function to the change event of radio buttons
        $('input[name="elementaryOption"]').on('change', showHideFields);
    });
</script>



<!-- Include jQuery and Bootstrap scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
$(document).ready(function () {
    // When the form is submitted, show the confirmation modal
    $("#inclusiveForm").on("submit", function (event) {
        event.preventDefault(); // Prevent the default form submission
        $("#inclusiveEducationModal").modal("show"); // Corrected modal ID
    });

    // When the "Save" button in the modal is clicked, submit the form
    $("#saveInclusive").on("click", function() {
        $("#inclusiveForm").off("submit"); // Remove the previous event handler
        $("#inclusiveForm").submit(); // Submit the form
    });

    $("#confirm_overwrite").on("click", function() {
        // Submit the form when "Yes" is clicked
        $("#inclusiveForm").submit();
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