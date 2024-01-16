<?php
include("/xampp/htdocs/thesis/models/Contents.php");

$content = new Contents();
$surveys = $content->getSurveys();
$news = $content->getNews();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["survey"])) {
        $result = $content->homePage($_POST["survey"]);
        if ($result) {
            header("Location: /thesis");
        }
    }
}

include("/xampp/htdocs/thesis/views/template/header.php");
?>

<div class="main-body-padding">
    <div class="w-50 container">
        <form method="post">
            <div>

                <h3>Survey</h3>
                <select name="survey" id="survey-select" class="form-select mb-3">
                    <option selected value="">Please select a survey to show</option>
                    <?php foreach ($surveys as $survey) { ?>
                        <option value="<?php echo $survey[0]; ?>"><?php echo $survey[2]; ?></option>
                    <?php } ?>
                </select>

                <div id="survey-container"></div>
            </div>
            <button>Save</button>
        </form>
    </div>
</div>
<?php
include("/xampp/htdocs/thesis/views/template/footer.php");
?>