<?php session_start(); ?>
<?php

require("/xampp/htdocs/thesis/models/Alumni.php");

$alumni = new Alumni();

$alumniAccounts = $alumni->getAllAlumni();

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $name = filter_input(INPUT_POST,"name", FILTER_SANITIZE_SPECIAL_CHARS);
    $track = filter_input(INPUT_POST,"track", FILTER_SANITIZE_SPECIAL_CHARS);
    $strand = filter_input(INPUT_POST,"strand", FILTER_SANITIZE_SPECIAL_CHARS);
    $batch = filter_input(INPUT_POST,"batch", FILTER_SANITIZE_SPECIAL_CHARS);
}

?>
<?php include("/xampp/htdocs/thesis/views/template/header.php"); ?>
<div class="main-body-padding">
    <h3>Alumni</h3>
    <!--Move to admin dashboard-->
    <!-- <button data-bs-toggle="modal" data-bs-target="#sendEmail" class="btn btn-outline-dark btn-sm"><i class="fas fa-at"></i> Send email</button> -->
    <form id="search" method="post" class="mb-3">
        <div class="d-flex">
            <input hidden id="name-search-firstName" value="" />
            <input hidden id="name-search-middleName" value="" />
            <input hidden id="name-search-lastName" value="" />
            <input id="alumni-name-search" name="name" class="form-control me-2" placeholder="Name" />
            <select class="form-select me-2">
                <option selected>Track</option>
                <option value="1">Academic</option>
                <option value="2">Technical Vocational</option>
                <option value="3">Sports and Recreation</option>
            </select>
            <select class="form-select me-2">
                <option selected>Strand</option>
                <option value="1">Academic</option>
                <option value="2">Technical Vocational</option>
                <option value="3">Sports and Recreation</option>
            </select>
            <select class="form-select me-3">
                <option selected>Batch</option>
                <option value="1"><?php echo date("Y"); ?></option>
                <option value="2"><?php echo date("Y") - 1; ?></option>
                <option value="3"><?php echo date("Y") - 2; ?></option>
            </select>
            <button type="submit" class="flex-fill btn btn-sm btn-dark"><i class="fas fa-search"></i> Search</button>
        </div>
        <div id="search-result-container"></div>
    </form>
    <table class="table table-responsive-lg table-hover align-middle">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Photo</th>
                <th scope="col">First Name</th>
                <th scope="col">Middle Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Contact Number</th>
                <th scope="col">Email</th>
                <th scope="col">Status</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($alumniAccounts as $account) { ?>
                <tr class="row-hover">
                    <?php for ($i = 0; $i < count($account); $i++) { ?>
                        <?php if ($i == 1) { ?>
                            <?php if (isset($account[$i])) {
                                $file = $account[$i];
                                echo "<td><img class='avatar' src='/thesis/public/images/profile/$file' /></td>";
                            } else { ?>
                                <td>No photo</td>
                            <?php } ?>
                        <?php } else { ?>
                            <td><?php echo $account[$i]; ?></td>
                        <?php } ?>
                    <?php } ?>
                    <td class="actions">
                        <a role="button" class="btn btn-link" href=<?php echo "/thesis/alumni?id=" . $account[0] ?>>View</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<form id="send-email-form">
    <div class="modal fade" id="sendEmail" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Send Email</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button disabled id="send-email-button" type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Send</button>
                </div>
            </div>
        </div>
    </div>
</form>

<?php include("/xampp/htdocs/thesis/views/template/footer.php") ?>