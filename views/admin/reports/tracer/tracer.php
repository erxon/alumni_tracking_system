<?php session_start(); ?>
<?php include("/xampp/htdocs/thesis/models/Database.php"); ?>
<?php

include("/xampp/htdocs/thesis/models/Reports.php");

$reports = new Reports();
$alumni = $reports->alumni();
$curriculumExits = $reports->getCurriculumExits(0);
$strandsInAcademicTrack = $reports->getAlumniByTrack(0, 'Academic');
$strandsInTvlTrack = $reports->getAlumniByTrack(0, 'TVL',);
$questions = $reports->getAlumniRatingsPerQuestion();
$currentYear = date("Y");

?>
<?php include "/xampp/htdocs/thesis/views/admin/reports/layout/header.php" ?>
<div>
    <div class="d-flex mb-2">
        <form id="custom-filter" class="d-flex me-2 align-items-center">
            <input id="custom-filter-year-1" name="custom-filter-year-1" type="number" class="form-control me-2" />
            <p class="m-0 me-2">-</p>
            <input id="custom-filter-year-2" name="custom-filter-year-2" type="number" class="form-control me-3" />
            <button disabled id="filter-graph" type="submit" class="btn btn-sm btn-dark me-2">Filter</button>
            <button id="refresh-graph" type="button" class="btn btn-sm btn-outline-dark w-50"><i class="fas fa-redo"></i> Clear</button>
        </form>
    </div>
    <div class="bar-graph-container p-3 rounded shadow bg-white mb-3">
        <div id="bar-graph" style="height: 300px; width: 100%;"></div>
        <!--Iterate this table -->
        <div id="table-container-academic">
            <?php
            $curriculumExitsUnformatted = $reports->getCurriculumExitsUnformatted(0, 'Academic');
            ?>
            <div class="mt-3">
                <p>Total Number of SHS Graduates <span class="batch-filter"></span> Academic Track</p>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Higher Education</th>
                            <th scope="col">Employment</th>
                            <th scope="col">Middle Level Skills Development</th>
                            <th scope="col">Entrepreneurship</th>
                            <th scope="col">Did not continue to college</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Number of graduates</th>
                            <td class="number-of-alumni" id="higher-education"><!--Higher Education-->
                                <?php echo $curriculumExitsUnformatted["higher_education"] ?>
                            </td>
                            <td class="number-of-alumni" id="employment"><!--Employment-->
                                <?php echo $curriculumExitsUnformatted["employment"] ?>
                            </td>
                            <td class="number-of-alumni" id="middle-level"><!--Middle Level Skills Development-->
                                <?php echo $curriculumExitsUnformatted["middle_level_skills_development"] ?>
                            </td>
                            <td class="number-of-alumni" id="entrepreneurship"><!--Entrepreneurship-->
                                <?php echo $curriculumExitsUnformatted["entrepreneurship"] ?>
                            </td>
                            <td class="number-of-alumni" id="entrepreneurship"><!--Entrepreneurship-->
                                <?php echo $curriculumExitsUnformatted["did_not_continue_to_college"] ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="table-container-tvl">
            <?php
            $curriculumExitsUnformatted = $reports->getCurriculumExitsUnformatted(0, 'TVL');
            ?>
            <div class="mt-3">
                <p>Total Number of SHS Graduates <span class="batch-filter"></span> TVL Track </p>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Higher Education</th>
                            <th scope="col">Employment</th>
                            <th scope="col">Middle Level Skills Development</th>
                            <th scope="col">Entrepreneurship</th>
                            <th scope="col">Did not continue to college</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Number of graduates</th>
                            <td class="number-of-alumni" id="higher-education"><!--Higher Education-->
                                <?php echo $curriculumExitsUnformatted["higher_education"] ?>
                            </td>
                            <td class="number-of-alumni" id="employment"><!--Employment-->
                                <?php echo $curriculumExitsUnformatted["employment"] ?>
                            </td>
                            <td class="number-of-alumni" id="middle-level"><!--Middle Level Skills Development-->
                                <?php echo $curriculumExitsUnformatted["middle_level_skills_development"] ?>
                            </td>
                            <td class="number-of-alumni" id="entrepreneurship"><!--Entrepreneurship-->
                                <?php echo $curriculumExitsUnformatted["entrepreneurship"] ?>
                            </td>
                            <td class="number-of-alumni" id="entrepreneurship"><!--Entrepreneurship-->
                                <?php echo $curriculumExitsUnformatted["did_not_continue_to_college"] ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div>
        <?php
        $answerCategories = array("Disagree", "Fairly Agree", "Agree", "Strongly Agree");
        $dataPoints = array();

        for ($i = 0; $i < 4; $i++) {
            $temporaryArray = array();
        ?>
            <?php foreach ($questions[$i] as $answers) {
                array_push($temporaryArray, array("label" => $answerCategories[$answers[0] - 1], "y" => ($answers[1] / $alumni) * 100));
            ?>
            <?php } ?>
        <?php
            array_push($dataPoints, $temporaryArray);
        } ?>
        <div class="row gap-0">
            <?php
            $titles = array(
                "Information, media and technology skills",
                "Learning and innovation skills",
                "Effective communication skills",
                "Life and career skills"
            );
            for ($i = 0; $i < 4; $i++) {
            ?>
                <div class="col-6 p-3 bg-white border">
                    <div id="chart-container-<?php echo $i; ?>" style="height: 275px; width: 100%;"></div>
                    <p class="text-center mt-3 fw-semibold">
                        <?php echo $titles[$i]; ?>
                    </p>
                    <div>
                        <table class="table">
                            <?php foreach ($questions[$i] as $answers) { ?>
                                <tr>
                                    <th><?php echo $answerCategories[$answers[0] - 1] ?></th>
                                    <td><?php echo $answers[1] ?></td>
                                </tr>

                            <?php } ?>
                        </table>

                    </div>
                </div>

            <?php } ?>
        </div>
    </div>
</div>
<?php
include "script.php";
include "/xampp/htdocs/thesis/views/admin/reports/layout/footer.php";
include "/xampp/htdocs/thesis/views/template/footer.php";
?>