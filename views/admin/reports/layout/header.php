<?php
$url = $_SERVER["REQUEST_URI"];
?>
<?php include("/xampp/htdocs/thesis/views/template/header.php"); ?>
<div class="d-flex">
    <div><?php include("/xampp/htdocs/thesis/views/template/admin.php"); ?></div>
    <div class="admin-views">
        <div class="mb-2 pt-5 pb-3 px-5">
            <h1>Reports</h1>
        </div>
        <div class="px-5">
            <ul class="nav nav-tabs mb-3">
                <li class="nav-item ">
                    <a class="nav-link <?php if ($url == "/thesis/admin/reports") {
                                            echo "active";
                                        } ?>" href="/thesis/admin/reports">Tracer study</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if (
                                            str_contains($url, "/thesis/admin/reports/survey") ||
                                            str_contains($url, "/thesis/admin/survey")
                                        ) {
                                            echo "active";
                                        } ?>" href="/thesis/admin/reports/survey">Survey</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if (
                                            str_contains($url, "/thesis/admin/reports/summary")
                                        ) {
                                            echo "active";
                                        } ?>" href="/thesis/admin/reports/summary">Summary Report</a>
                </li>
            </ul>