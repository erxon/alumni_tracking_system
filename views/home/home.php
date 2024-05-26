<?php session_start(); ?>
<?php
require("/xampp/htdocs/thesis/models/Authentication.php");
require("/xampp/htdocs/thesis/models/utilities/StringUtilities.php");
include("/xampp/htdocs/thesis/models/Home.php");


$auth = new Authentication();
$home = new Home();
$stringUtil = new StringUltilities();

$eventHighlight = $home->getEventHighlight();
$newsHighlight = $home->getNewsHighlight();
$newGallery = $home->getNewGallery();
$newSurvey = $home->getNewSurvey();
?>

<?php
if (isset($_SESSION["status"]) && $_SESSION["status"] == "pending") {
    header("Location: http://" . $_SERVER["HTTP_HOST"] . "/thesis/alumni/pending");
}
?>

<?php
include("/xampp/htdocs/thesis/views/template/header.php");
?>
<?php
if (empty($_SESSION["email"])) { ?>
    <div class="reg-container">
        <div class="reg-start">
            <h1 style="font-weight: bold; font-size: 55px;" class="mb-3">Welcome to Luis Y. Ferrer Jr. Senior High School<br />
                <span class="system-name">Alumni Tracking System</span>
            </h1>
            <p class="w-50 mx-auto">Remember your SHS journey by accessing alumni contents and connecting with the school and your fellow alumni.</p>
            <button role="button" data-bs-toggle="modal" data-bs-target="#termsAndConditions" class="register-now btn btn-dark">Register Now</button>
        </div>
    </div>
    <div class="introduction">
        <div id="carouselExampleAutoplaying" class="carousel carousel-home slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="public/assets/carousel/alumni-1.jpg" class="carousel-img d-block w-100" alt="image 1">
                </div>
                <div class="carousel-item">
                    <img src="public/assets/carousel/alumni-2.jpg" class="carousel-img d-block w-100" alt="image 2">
                </div>
                <div class="carousel-item">
                    <img src="public/assets/carousel/alumni-3.jpg" class="carousel-img d-block w-100" alt="image 3">
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
    <div id="about">
        <div style="background-color: #000;" class="row m-0 g-0 text-white">
            <img class="col-6" src="/thesis/public/assets/about/cover.jpg" />
            <div class="col-6 my-auto px-5">
                <img class="mb-3" style="height: 80px; width: 80px;" src="/thesis/public/assets/about/image-1.png" />
                <div style="height: 75px">
                    <h4>What is LYFJSHS Alumni Tracking System?</h4>
                </div>
                <div>
                    <p class="fw-light w-75">
                        The LYFJSHS Alumni Tracking System is developed to
                        foster engagement between Luis Y. Ferrer Jr. Senior
                        High School and all of its alumni by providing alumni
                        dedicated alumni contents.
                    </p>
                </div>
            </div>
        </div>
        <div style="height: 100%; width: 100%">
            <div class="row g-5 me-0 about">
                <div class="col-6 my-auto border-end">
                    <div>
                        <img class="mb-3" style="height: 80px; width: 80px;" src="/thesis/public/assets/about/image-2.png" />
                        <div class="about-section-title" style="height: 75px">
                            <h4>Contents of LYFJSHS</h4>
                        </div>
                        <div>
                            <ul class="fw-light w-75">

                                <li> Access dedicated alumni contents such as News,
                                    Announcements, and Events.</li>
                                <li>Browse for photos through the Alumni Gallery</li>
                                <li>Participate through surveys conducted by the school</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-6 m-auto">
                    <div>
                        <img class="mb-3" style="height: 80px; width: 80px;" src="/thesis/public/assets/about/image-3.png" />
                        <div class="about-section-title" style="height: 75px">
                            <h4>Benefits</h4>
                        </div>
                        <div>
                            <ul class="fw-light w-75">
                                <li>Accessible Anytime</li>
                                <li>Keeps alumni updated about the latest trends or
                                    happenings involving them</li>
                                <li>Serves as a medium of communication between
                                    LYFJSHS and their alumni</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="contact" style="background-color: #000;" class="container-fluid text-white contact main-body-padding">
        <h1 class="mb-5">Contact us</h1>
        <div style="font-size: 14px;" class="letter-spacing d-flex fw-normal">
            <div class="flex-fill border-end border-white pe-2 me-3">
                <div>
                    <p class="mb-1">
                        <i class="me-1 fas fa-phone"></i> Phone or Telephone numbers
                    </p>
                    <div style="font-size: 12px;">
                        <p style="margin-bottom: 0.5px;" class="letter-spacing fw-light">0930 318 7920 </p>
                        <p class="fw-light">0965 033 7899</p>
                    </div>
                </div>
                <div>
                    <p class="mb-1 fw-normal"><i class="fas fa-envelope"></i> Email</p>
                    <p class="fw-light">info@lyfjshs.com</p>
                </div>
            </div>
            <div class="flex-fill fw-light">
                <a class="link mb-1" href="https://web.facebook.com/DepedTayoLYFJSHS342285/"><i class="me-1 fab fa-facebook"></i> Deped Tayo Luis Y. Ferrer Jr SHS - General Trias City</a>
                <a class="link mb-1" href="http://lyfjshs.com/?fbclid=IwZXh0bgNhZW0CMTAAAR3zxMQON1WxGv4HvztgkTN8DoKFzvngrRFAw8id02yO5TY4Ebl5_h2-w60_aem_AYZ9wCBQBQER3enYH1SqIvZV2ocqwDPCsMJnutwPwHgdHTJQ7rhDdOcDlVLDshdxdjoakCj7ONB-oU5q_kjTRIUO"><i class="me-1 fas fa-globe-asia"></i> LYFJSHS Official Website </a>
                <a class="link mb-1" href="https://www.google.com/maps/place/Luis+Y.+Ferrer+Jr.+Senior+High+School/@14.3384707,120.8820266,17z/data=!3m1!4b1!4m6!3m5!1s0x33962b264537f51d:0x569558fa0bb77d!8m2!3d14.3384707!4d120.8820266!16s%2Fg%2F11cspbfhzb?entry=ttu"><i class="fas fa-map-marker-alt me-1"></i> South Square Village, Pasong Kawayan 2, General Trias City 4107, Cavite</a>
            </div>
        </div>
    </div>
    <div class="bg-dark p-3">
        <p style="font-size: 12px;" class="mb-0 text-light fw-light text-center">&copy Copyright 2024</p>
    </div>
<?php
} else if ($_SESSION["type"] == "admin" || $_SESSION["type"] == "teacher" || $_SESSION["type"] == "principal") {
    include("/xampp/htdocs/thesis/views/home/dashboard/dashboard.php");
} else { ?>
    <div>
        <?php include("/xampp/htdocs/thesis/views/home/contents/index.php"); ?>
    </div>
<?php } ?>



<!-- Modal -->
<?php include "alumni_registration_modal.php"; ?>

<?php include "script.php"; ?>
<!-- Logout User -->
<?php include("/xampp/htdocs/thesis/views/template/footer.php"); ?>