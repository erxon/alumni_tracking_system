<?php session_start(); 

if($_SESSION["type"] != "admin"){
    header("Location: /thesis/error");
}

?>

<?php

include("/xampp/htdocs/thesis/models/Alumni.php");

$alumni = new Alumni();
$result = $alumni->unregisteredAlumni();

?>


<?php include("/xampp/htdocs/thesis/views/template/header.php"); ?>
<?php
if ($result->num_rows > 0) {
    $unregisteredAlumni = $result->fetch_all();
?>
    <div class="d-flex">
        <div><?php include("/xampp/htdocs/thesis/views/template/admin.php"); ?></div>
        <div class="admin-views">
            <div class="p-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Year graduated</th>
                            <th scope="col">Track</th>
                            <th scope="col">Strand</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $increment = 1;
                        foreach ($unregisteredAlumni as $row) {

                        ?>
                            <tr>
                                <td><?php echo $increment; ?></td>
                                <td><?php echo $row[1] . " " . $row[2] . " " . $row[3]; ?></td>
                                <td><?php echo $row[4]; ?></td>
                                <td><?php echo $row[5]; ?></td>
                                <td><?php echo $row[6]; ?></td>
                                <td>
                                    <div class="d-flex">
                                        <a role="button" class="btn btn-primary btn-sm me-1" href="/thesis/alumni/profile?id=<?php echo $row[0]; ?>">Details</a>
                                        <button onclick="approve(<?php echo $row[0]; ?>)" class="btn btn-sm btn-success decision-btn me-1"><i class="fas fa-check"></i> Approve</button>
                                        <button onclick="decline(<?php echo $row[0]; ?>)" class="btn btn-sm btn-danger decision-btn me-1"><i class="fas fa-times"></i> Decline</button>
                                        <div style="display: none;" id="loading">
                                            <div class="spinner-border spinner-border-sm text-primary" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php
                            $increment = $increment + 1;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="d-flex">
        <div><?php include("/xampp/htdocs/thesis/views/template/admin.php"); ?></div>
        <div class="admin-views">
            <div class="mb-2 pt-5 pb-3 px-5">
                <h1>Registration</h1>
            </div>
            <div class="px-5">
                <div class="rounded shadow bg-white p-3">
                    <p>No alumni records found</p>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php include("/xampp/htdocs/thesis/views/template/footer.php"); ?>