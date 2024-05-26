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
$skillsAcquired = $reports->getRelevantSkills();

?>
<?php include "/xampp/htdocs/thesis/views/admin/reports/layout/header.php" ?>
<div>
    <div class="p-4 bg-white shadow-sm rounded">

        <div id="tracer-study-reports">
            <!--Iterate this table -->
            <h3>Batch or year graduated</h3>
            <div class="d-flex mb-3 align-items-center">
                <form id="custom-filter" class="d-flex me-2 align-items-center">
                    <input style="display: block;" id="custom-filter-year-1" name="custom-filter-year-1" type="number" class="form-control me-2 controls" />
                    <p style="display: block;" class="m-0 me-2 controls">-</p>
                    <input style="display: block;" id="custom-filter-year-2" name="custom-filter-year-2" type="number" class="form-control me-3 controls" />
                    <button style="display: block;" disabled id="filter-graph" type="submit" class="btn btn-sm btn-dark me-2 controls">Filter</button>
                    <button style="display: block;" id="refresh-graph" type="button" class="btn btn-sm btn-outline-dark w-50 controls"><i class="fas fa-redo"></i> Clear</button>
                </form>
                <div class="flex-fill"></div>
                <div>
                    <button style="display: block;" id="print-tracer-report" class="btn btn-sm btn-dark controls">Print</button>
                </div>
            </div>
            <div class="border p-3 rounded" id="table-container-academic">
                <?php
                $curriculumExitsUnformatted = $reports->getCurriculumExitsUnformatted(0, 'Academic');
                ?>
                <div>
                    <h5 class="mb-4">Total Number of SHS Graduates <span class="batch-filter"></span> Academic Track</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Higher Education</th>
                                <th scope="col">Employment</th>
                                <th scope="col">Middle Level Skills Development</th>
                                <th scope="col">Entrepreneurship</th>
                                <th scope="col">None</th>
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
                                    <?php echo $curriculumExitsUnformatted["none"] ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="border p-3 rounded mt-3" id="table-container-tvl">
                <?php
                $curriculumExitsUnformatted = $reports->getCurriculumExitsUnformatted(0, 'Technical-Vocational and Livelihood');
                ?>
                <div>
                    <h5 class="mb-4">Total Number of SHS Graduates <span class="batch-filter"></span> TVL Track </h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Higher Education</th>
                                <th scope="col">Employment</th>
                                <th scope="col">Middle Level Skills Development</th>
                                <th scope="col">Entrepreneurship</th>
                                <th scope="col">None</th>
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
                                    <?php echo $curriculumExitsUnformatted["none"] ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-3 mb-3 p-3 bg-white shadow-sm rounded">
        <div id="skills">
            <div class="d-flex align-items-center mb-3">
                <h3 class="w-100">Relevant skills acquired</h3>
                <button style="display: block;" id="skills-print" class="btn btn-sm btn-dark">Print</button>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Information, media and technology skills</th>
                        <th scope="col">Learning and innovation skills</th>
                        <th scope="col">Effective communication skills</th>
                        <th scope="col">Life and career skills</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($skillsAcquired as $answer => $skill) { ?>
                        <tr>
                            <th><?php echo $answer; ?></th>
                            <td><?php echo $skill[0]["y"] ?></td>
                            <td><?php echo $skill[1]["y"] ?></td>
                            <td><?php echo $skill[2]["y"] ?></td>
                            <td><?php echo $skill[3]["y"] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
include "script.php";
include "/xampp/htdocs/thesis/views/admin/reports/layout/footer.php";
include "/xampp/htdocs/thesis/views/template/footer.php";
?>