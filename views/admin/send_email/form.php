<?php session_start(); ?>


<?php include("/xampp/htdocs/thesis/models/Database.php"); ?>
<?php include("/xampp/htdocs/thesis/views/template/header.php"); ?>

<div class="d-flex">
    <div>
        <?php include("/xampp/htdocs/thesis/views/template/admin.php"); ?>
    </div>
    <div>
        <div class="admin-views">
            <div class="mb-2 pt-5 pb-3 px-5">
                <h1 class="modal-title">Updates</h1>
            </div>
            <div class="px-5">
                <form id="send-email-form" class="needs-validation" novalidate>
                    <div>
                        <div>
                            <div class="modal-body">
                                <select name="recipient" id="email-recipient" class="form-select mb-1" aria-label="Default select example" required>
                                    <option value="" selected>Recipient</option>
                                    <option value="all">All</option>
                                    <option value="individual">Individual</option>
                                    <option value="track">Per track</option>
                                    <option value="batch">Per batch</option>
                                </select>
                                <select hidden id="per-track-recipient" name="per-track-recipient" class="form-select mb-1" aria-label="Default select example" required>
                                    <option value="" selected>Per track</option>
                                    <option value="Academic">Academic</option>
                                    <option value="Technical-Vocational and Livelihood">TVL</option>
                                </select>
                                <div hidden id="individual-recipient-container">
                                    <input id="individual-recipient" name="alumni_email" class="form-control mb-1" placeholder="Type alumni email" />
                                    <div style="display: none" id="search-result" class="p-3 bg-white"></div>
                                </div>
                                <input hidden id="per-batch-recipient" name="per-batch-recipient" placeholder="Batch" type="Number" class="form-control mb-1" value="" required />
                                <div class="text-danger" style="display: none; font-size: 14px;" id="feedback-error">Invalid year</div>
                                <input id="email-subject" name="subject" class="form-control mb-1" placeholder="Subject" required />
                                <textarea id="content" name="alumni_email_content" placeholder="Type your message here" class="form-control mb-3" required></textarea>
                                <div hidden id="loading" class="spinner-border" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <div hidden id="alert" class="alert" role="alert"></div>
                            </div>
                            <button id="send-email-button" type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Send</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include "script.php";
include "/xampp/htdocs/thesis/views/template/footer.php";
?>