<?php session_start(); ?>
<?php include("/xampp/htdocs/thesis/models/Database.php"); ?>
<?php
include("/xampp/htdocs/thesis/models/Reports.php");

$reports = new Reports();

$batchTotalAlumni = $reports->getBatchTotalAlumni();


?>
<?php include "/xampp/htdocs/thesis/views/admin/reports/layout/header.php" ?>

<div>
    <button id="print-summary" class="btn btn-sm btn-dark my-3">Print</button>
    <div id="print-area">
        <h3 class="mb-3">Alumni Summary Report</h3>
        <table class="table table-bordered table-striped">
            <thead>
                <th rowspan="1">Batch/Year Graduated</th>
                <th rowspan="1">Total Number</th>
                <th class="text-center" colspan="2">Track Finished</th>
                <th class="text-center" colspan="2">Gender</th>
                <th class="text-center" colspan="3">Present Status</th>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <th class="text-center">Academic</th>
                    <th class="text-center">TVL</th>
                    <th class="text-center">Male</th>
                    <th class="text-center">Female</th>
                    <th class="text-center">University Student</th>
                    <th class="text-center">Employed</th>
                    <th class="text-center">Unemployed</th>
                </tr>

                <?php foreach ($batchTotalAlumni as $row) { ?>
                    <tr>
                        <td style="text-align: right;"><?php echo $row[0]; ?></td>
                        <td style="text-align: right;"><?php echo $row[1]; ?></td>
                        <?php
                        $acadAlumni = $reports->getAlumniPerTrackPerBatch($row[0], "Academic");
                        if (count($acadAlumni) == 0) {
                        ?>
                            <td class="text-secondary" style="text-align: right;">0</td>
                        <?php } ?>
                        <?php foreach ($acadAlumni as $academic) { ?>
                            <td style="text-align: right;"><?php echo $academic[0] ?></td>
                        <?php } ?>
                        <?php
                        $tvlAlumni = $reports->getAlumniPerTrackPerBatch($row[0], "Technical-Vocational and Livelihood");

                        if (count($tvlAlumni) === 0) { ?>
                            <td class="text-secondary" style="text-align: right;">0</td>
                        <?php } else { ?>
                            <?php foreach ($tvlAlumni as $tvl) { ?>
                                <td style="text-align: right;"><?php echo $tvl[0]; ?></td>
                            <?php } ?>
                        <?php } ?>
                        <?php
                        $genderMale = $reports->getAlumniPerGenderPerBatch($row[0], "Male");
                        if (count($genderMale) == 0) {
                        ?>
                            <td class="text-secondary" style="text-align: right;">0</td>
                        <?php } else { ?>
                            <?php foreach ($genderMale as $male) { ?>
                                <td style="text-align: right;"><?php echo $male[0]; ?></td>
                            <?php  } ?>
                        <?php } ?>
                        <?php
                        $genderFemale = $reports->getAlumniPerGenderPerBatch($row[0], "Female");
                        if (count($genderFemale) == 0) {
                        ?>
                            <td class="text-secondary" style="text-align: right;">0</td>
                        <?php } else { ?>
                            <?php foreach ($genderFemale as $female) { ?>
                                <td style="text-align: right;"><?php echo $female[0]; ?></td>
                            <?php  } ?>
                        <?php } ?>
                        <?php
                        $presentStatusUniversityStudent = $reports->getAlumniPerPresentStatusPerBatch($row[0], "University Student");
                        if (count($presentStatusUniversityStudent) == 0) {
                        ?>
                            <td class="text-secondary" style="text-align: right;">0</td>
                        <?php } else { ?>
                            <?php foreach ($presentStatusUniversityStudent as $universityStudent) { ?>
                                <td style="text-align: right;"><?php echo $universityStudent[0]; ?></td>
                            <?php  } ?>
                        <?php } ?>
                        <?php
                        $presentStatusEmployed = $reports->getAlumniPerPresentStatusPerBatch($row[0], "Employed");
                        if (count($presentStatusEmployed) == 0) {
                        ?>
                            <td class="text-secondary" style="text-align: right;">0</td>
                        <?php } else { ?>
                            <?php foreach ($presentStatusEmployed as $employed) { ?>
                                <td style="text-align: right;"><?php echo $employed[0]; ?></td>
                            <?php  } ?>
                        <?php } ?>
                        <?php
                        $presentStatusUnemployed = $reports->getAlumniPerPresentStatusPerBatch($row[0], "Unemployed");
                        if (count($presentStatusUnemployed) == 0) {
                        ?>
                            <td class="text-secondary" style="text-align: right;">0</td>
                        <?php } else { ?>
                            <?php foreach ($presentStatusUnemployed as $unemployed) { ?>
                                <td style="text-align: right;"><?php echo $unemployed[0]; ?></td>
                            <?php  } ?>
                        <?php } ?>
                    </tr>
                <?php } ?>


            </tbody>
        </table>
    </div>
</div>

<?php
include "summary_script.php";
include "/xampp/htdocs/thesis/views/admin/reports/layout/footer.php";
include "/xampp/htdocs/thesis/views/template/footer.php";
?>