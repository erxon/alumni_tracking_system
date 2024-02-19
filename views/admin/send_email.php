<?php session_start(); ?>
<?php include("/xampp/htdocs/thesis/views/template/header.php"); ?>

<div>
    <?php include("/xampp/htdocs/thesis/views/template/admin.php"); ?>
    <div class="main-body-padding admin-views">
        <form id="send-email-form">
            <div>
                <div>
                    <div>
                        <h5 class="modal-title">Send Email</h5>
                    </div>
                    <div class="modal-body">
                        <input name="subject" class="form-control mb-1" placeholder="Subject" />
                        <input name="title" class="form-control mb-1" placeholder="Title" />
                        <p>Type your message here</p>
                        <textarea id="content" name="alumni_email_content" class="form-control mb-3"></textarea>
                        <div hidden id="loading" class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div hidden id="alert" class="alert" role="alert"></div>
                    </div>
                    <div>
                        <button disabled id="send-email-button" type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Send</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php include("/xampp/htdocs/thesis/views/template/footer.php") ?>