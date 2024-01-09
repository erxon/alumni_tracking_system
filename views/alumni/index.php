<?php session_start(); ?>
<?php
if ($_SESSION["type"] != "admin") {
    header("Location: /thesis/home");
    die();
}
?>
<?php

require("/xampp/htdocs/thesis/models/Alumni.php");

$alumni = new Alumni();

$alumniAccounts = $alumni->getAllAlumni();

?>
<?php include("/xampp/htdocs/thesis/views/template/header.php"); ?>
<div class="main-body-padding">
    <h3>Alumni</h3>
    <form id="search">
        <div class="input-group flex-nowrap my-3 w-50">
            <input id="search-field" type="text" class="form-control" placeholder="Search" />
            <button class="btn"><i class="fas fa-search"></i></button>
        </div>
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

<?php include("/xampp/htdocs/thesis/views/template/footer.php") ?>