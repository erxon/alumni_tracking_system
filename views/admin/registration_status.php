<?php session_start(); ?>
<?php include("/xampp/htdocs/thesis/views/template/header.php"); ?>
<?php
include("/xampp/htdocs/thesis/views/template/admin.php");

include("/xampp/htdocs/thesis/models/Alumni.php");

$alumni = new Alumni();
$result = $alumni->unregisteredAlumni();

if ($result->num_rows > 0) {

    $unregisteredAlumni = $result->fetch_all();
?>

    <div class="main-body-padding admin-views">
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
                <?php foreach ($unregisteredAlumni as $row) { ?>
                    <tr>
                        <td><?php echo $row[0]; ?></td>
                        <td><?php echo $row[3] . " " . $row[4] . " " . $row[5]; ?></td>
                        <td><?php echo $row[12]; ?></td>
                        <td><?php echo $row[13]; ?></td>
                        <td><?php echo $row[14]; ?></td>
                        <td>
                            <button onclick="showPopup(<?php echo $row[0] ?>)" class="btn btn-sm btn-light">View</button>
                            <div id="<?php echo "unreg-alumni-details-" . $row[0]; ?>" class="p-3 bg-white rounded shadow unreg-alumni-details-popup"></div>
                        </td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div>

    </div>
    
<?php } else { ?>
    <div class="main-body-padding admin-views">
        <div class="rounded shadow bg-white p-3">
            <p>No alumni records found</p>
        </div>
    </div>
<?php } ?>

<?php include("/xampp/htdocs/thesis/views/template/footer.php"); ?>