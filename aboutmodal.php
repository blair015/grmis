<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<!-- The Modal -->
<div class="modal" id="aboutModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit History of the School</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <textarea id="schoolHistory" rows="5" class="form-control" placeholder="Enter the updated history of the school"></textarea>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="updateHistory()">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    function updateHistory() {
        var newHistory = document.getElementById("schoolHistory").value;
        // Update the content on the page with the new history
        document.querySelector(".active#About p").textContent = "History of the school: " + newHistory;
    }
</script>
</html>