<?php
session_start();

$trackTrend = "";
$strandTrend = "";
$presentStatus = "";
$alumniTrendCurriculumExit = "";

if (isset($_GET["track"])) {
    $trackTrend = $_GET["track"];
}
if (isset($_GET["strand"])) {
    $strandTrend = $_GET["strand"];
}
if (isset($_GET["presentStatus"])) {
    $presentStatus = $_GET["presentStatus"];
}
if (isset($_GET["curriculumExit"])) {
    $alumniTrendCurriculumExit = $_GET["curriculumExit"];
}

include "/xampp/htdocs/thesis/views/template/header.php";
include "/xampp/htdocs/thesis/models/Database.php";
include "header.php";

?>
<ul class="nav nav-tabs p-3">
    <li class="nav-item">
        <a class="nav-link" href="/thesis/home">Charts</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="/thesis/admin/alumnitrends">Alumni trends</a>
    </li>
</ul>

<div class="p-3">
    <a role="button" class="btn btn-sm btn-dark my-3" href="/thesis/admin/alumnitrends">Reset</a>
    <div class="p-4 bg-white shadow rounded">
        <form class="d-flex">
            <select name="track" class="form-select me-1">
                <option value="" selected>Track</option>
                <?php foreach ($tracksOption as $track) { ?>
                    <option <?php if (isset($_GET["track"]) && $_GET["track"] == $track[2]){
                        echo "selected";
                    } ?> value="<?php echo $track[2] ?>"><?php echo $track[2] ?></option>
                <?php } ?>
            </select>
            <button class="btn btn-sm btn-dark">Filter</button>
        </form>
        <?php if (!isset($_GET["track"])) { ?>
            <div id="alumni-trends-batches" style="height: 300px"></div>
        <?php } else { ?>
            <div id="alumni-trends-batches-per-track" style="height: 300px"></div>
        <?php } ?>
    </div>

    <div class="p-4 bg-white shadow rounded mt-3">
        <form class="d-flex">
            <select name="presentStatus" class="form-select me-1">
                <option value="" selected>Present Status</option>
                <option <?php
                        if (isset($_GET["presentStatus"]) && $_GET["presentStatus"] == "Employed") {
                            echo "selected";
                        } ?> value="Employed">Employed</option>
                <option <?php
                        if (isset($_GET["presentStatus"]) && $_GET["presentStatus"] == "Unemployed") {
                            echo "selected";
                        } ?> value="Unemployed">Unemployed</option>
                <option <?php
                        if (isset($_GET["presentStatus"]) && $_GET["presentStatus"] == "University Student") {
                            echo "selected";
                        } ?> value="University Student">University Student</option>
            </select>
            <button class="btn btn-sm btn-dark">Filter</button>
        </form>
        <?php if (!isset($_GET["presentStatus"])) { ?>
            <div id="alumni-trends-present-status-all" style="height: 300px"></div>
        <?php } else { ?>
            <div id="alumni-trends-present-status" style="height: 300px"></div>
        <?php } ?>
    </div>

    <div class="p-4 bg-white shadow rounded mt-3">
        <form class="d-flex">
            <select name="curriculumExit" class="form-select me-1">
                <option value="" selected>Curriculum Exit</option>
                <option <?php
                        if (isset($_GET["curriculumExit"]) && $_GET["curriculumExit"] == "Employment") {
                            echo "selected";
                        } ?> value="Employment">Employment</option>
                <option <?php
                        if (isset($_GET["curriculumExit"]) && $_GET["curriculumExit"] == "Higher Education") {
                            echo "selected";
                        } ?> value="Higher Education">Higher Education</option>
                <option <?php
                        if (isset($_GET["curriculumExit"]) && $_GET["curriculumExit"] == "Entrepreneurship") {
                            echo "selected";
                        } ?> value="Entrepreneurship">Entrepreneurship</option>
                <option <?php
                        if (isset($_GET["curriculumExit"]) && $_GET["curriculumExit"] == "Middle-level skills development") {
                            echo "selected";
                        } ?> value="Middle-level skills development">Middle-level skills development</option>
                <option <?php
                        if (isset($_GET["curriculumExit"]) && $_GET["curriculumExit"] == "None") {
                            echo "selected";
                        } ?> value="None">None</option>
            </select>
            <button class="btn btn-sm btn-dark">Filter</button>
        </form>
        <?php if (!isset($_GET["curriculumExit"])) {
        ?>
            <div id="alumni-trends-curriculum-exit-all" style="height: 300px"></div>
        <?php } else { ?>
            <div id="alumni-trends-curriculum-exit" style="height: 300px"></div>
        <?php } ?>
    </div>
</div>

<?php
include "footer.php";
include "alumni_trends_script.php";
include "/xampp/htdocs/thesis/views/template/footer.php";
?>