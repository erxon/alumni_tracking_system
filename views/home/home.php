<?php session_start(); ?>
<?php
require("/xampp/htdocs/thesis/models/Authentication.php");
require("/xampp/htdocs/thesis/models/utilities/StringUtilities.php");

$auth = new Authentication();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['logout'])) {
        $auth->logout();
    } 
}

include("/xampp/htdocs/thesis/models/Home.php");

$surveyQuestion;
$surveyAnswers;
$home = new Home();
$survey = $home->getSurvey();
$stringUtil = new StringUltilities();

if(isset($_POST["delete-action"])) {
    $result = $home->removeSurvey($survey["id"]);

    if ($result) {
        header("Location: /thesis");
    }
}

if (isset($survey)) {
    $surveyQuestion = $home->getSurveyQuestion($survey["survey"]);
    $surveyAnswers = $home->getSurveyAnswers($surveyQuestion["id"]);
}

?>

<?php
include("/xampp/htdocs/thesis/views/template/header.php");
?>
<?php
if (empty($_SESSION["username"])) { ?>

    <div class="reg-container">
        <div class="reg-start">
            <h1 style="font-weight: bold">Welcome to Luis Y. Ferrer Jr. Senior High School <span class="system-name">Alumni Tracking System</span></h1>
            <p>Remember your SHS journey by accessing alumni contents and connecting with the school and your fellow alumni.</p>
            <a href="/thesis/alumni" role="button" data-modal-target="#modal" class="register-now btn btn-light">Register Now</a>
        </div>
    </div>
    <div class="introduction">
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="public/assets/carousel/alumni1.jpg" class="d-block w-100" alt="image 1">
                </div>
                <div class="carousel-item">
                    <img src="public/assets/carousel/alumni2.jpg" class="d-block w-100" alt="image 2">
                </div>
                <div class="carousel-item">
                    <img src="public/assets/carousel/alumni6.jpg" class="d-block w-100" alt="image 3">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
<?php } else { ?>
    <div class="dashboard">
        <div class="welcome mb-3">
            <p class="mb-0">Welcome <?php echo $_SESSION["first_name"] . " " . $_SESSION["last_name"]; ?>!</p>
            <p class="type">Administrator</p>
            <form class="logout" method="post">
                <input class="btn btn-link" type="submit" name="logout" value="Logout">
            </form>
        </div>
        <?php include("/xampp/htdocs/thesis/views/home/contents.php"); ?>
    </div>
<?php } ?>

<div class="about"></div>
<div class="contact"></div>

<!-- Logout User -->

<?php include("/xampp/htdocs/thesis/views/template/footer.php"); ?>