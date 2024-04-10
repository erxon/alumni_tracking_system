<?php

include("/xampp/htdocs/thesis/models/Dashboard.php");

$dashboard = new Dashboard();

$alumni = $dashboard->registeredAlumni();
$tracks = $dashboard->tracks();

?>
<!--Dashboard-->
<div class="d-flex">
    <div>
        <?php include("/xampp/htdocs/thesis/views/template/admin.php"); ?>
    </div>
    <div class="admin-views">
        <div>
            <div class="mb-2 pt-5 pb-3 px-5">
                <h1>Dashboard</h1>
            </div>
            <div class="py-3 px-5">
                <a role="button" class="btn btn-sm btn-dark mb-4" href="/thesis/admin/reports">View data</a>
                <div class="row g-2 me-0">

                    <div class="col shadow bg-white rounded p-3 me-2">
                        <h3>Total Registered Alumni</h3>
                        <p class="fs-5 text-primary"><i class="fas fa-user-graduate me-2"></i> <?php echo $alumni . " " . "alumni"; ?></p>

                    </div>
                    <div class="col shadow bg-white rounded p-3 me-2">
                        <h3>Academic track</h3>
                        <p class="fs-5 text-primary"><i class="fas fa-book"></i> <?php echo $tracks["Academic"] ?> alumni</p>
                    </div>
                    <div class="col shadow bg-white rounded p-3 me-2">
                        <h3>TVL track</h3>
                        <p class="fs-5 text-primary"></i><i class="fas fa-tools"></i> <?php echo $tracks["TVL"] ?> alumni</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>