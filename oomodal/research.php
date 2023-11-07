<!-- Modal for "Research Completed" -->
<div class="modal fade" id="researchCompletedModal" tabindex="-1" role="dialog" aria-labelledby="researchCompletedModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Modal content remains the same as in your original code -->

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="saveResearchBtn" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Include jQuery and Bootstrap scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
$(document).ready(function () {
    // When the "Save" button is clicked, trigger the modal form submission
    $("#saveResearchBtn").on("click", function() {
        $("#researchForm").submit();
    });

    // When the form is submitted, show the confirmation modal
    $("#researchForm").on("submit", function (event) {
        event.preventDefault();
        $("#researchCompletedModal").modal("show");
    });
});
</script>
