<?php
include "/xampp/htdocs/thesis/models/SchoolInformation.php";

$schoolInformation = new SchoolInformation();
$tracks = $schoolInformation->getTracks();
$batches = $schoolInformation->getBatches();
?>
<div class="modal fade" id="send-email" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="send-email-form" novalidate>
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 me-2" id="exampleModalLabel">Event</h1>
                    <div id="loading" style="display: none" class="spinner-border spinner-border-sm" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <select id="target" class="form-select">
                        <option value="All">All Alumni</option>
                        <option value="per-track">Per track</option>
                        <option value="per-batch">Per batch</option>
                    </select>
                    <select id="per-track" class="collapse form-select mt-2" required>
                        <option value="" selected>Select a track</option>
                        <?php foreach ($tracks as $track) { ?>
                            <option value="<?php echo $track[2]; ?>"><?php echo $track[2]; ?></option>
                        <?php } ?>
                    </select>
                    <select id="per-batch" class="collapse form-select mt-2" required>
                        <option value="" selected>Select a batch</option>
                        <?php foreach ($batches as $batch) { ?>
                            <option value="<?php echo $batch[0]; ?>"><?php echo $batch[0]; ?></option>
                        <?php } ?>
                    </select>
                    <div id="content-title" class="mt-2"></div>
                    <textarea id="additional-note" placeholder="Note" value="" type="text" class="form-control mt-2"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="send-email-button" type="button" class="btn btn-primary">Send </button>
                </div>
            </div>
        </form>
    </div>
</div>