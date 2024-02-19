<?php

include("/xampp/htdocs/thesis/models/Dashboard.php");

$dashboard = new Dashboard();

$alumni = $dashboard->registeredAlumni();
$tracks = $dashboard->tracks();

?>
<!--Dashboard-->
<?php include("/xampp/htdocs/thesis/views/template/admin.php"); ?>
<div class="dashboard flex-fill admin-views">
    <div class="row">
        <div class="col border rounded p-3 me-2">
            <h3>Total Registered Alumni</h3>
            <p class="fs-5"><i class="fas fa-user-graduate me-2"></i> <?php echo $alumni . " " . "alumni"; ?></p>
        </div>
        <div class="col border rounded p-3 me-2">
            <h3>Academic track</h3>
            <p class="fs-5"><i class="fas fa-book"></i> <?php echo $tracks["Academic"] ?> alumni</p>
        </div>
        <div class="col border rounded p-3 me-2">
            <h3>TVL track</h3>
            <p class="fs-5"></i><i class="fas fa-tools"></i> <?php echo $tracks["TVL"] ?> alumni</p>
        </div>
    </div>

</div>