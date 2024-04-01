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
            <button role="button" data-bs-toggle="modal" data-bs-target="#termsAndConditions" class="register-now btn btn-light">Register Now</button>
        </div>
    </div>
    <div class="introduction">
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="public/assets/carousel/alumni1.jpg" class="carousel-img d-block w-100" alt="image 1">
                </div>
                <div class="carousel-item">
                    <img src="public/assets/carousel/alumni2.jpg" class="carousel-img d-block w-100" alt="image 2">
                </div>
                <div class="carousel-item">
                    <img src="public/assets/carousel/alumni6.jpg" class="carousel-img d-block w-100" alt="image 3">
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
    <div id="about" class="container-fluid about main-body-padding">
        <h1 class="text-center mb-5">About</h1>
        <div>
            <div class="d-flex flex-column flex-lg-row bg-dark rounded mb-3">
                <div class="about-section-title border-4 text-white p-5 d-flex align-items-center">
                    <p>What is LYFJSHS Alumni Tracking System?</p>
                </div>
                <div class="p-5 bg-dark-subtle">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer at dapibus nibh. In felis nulla,
                        mattis vestibulum accumsan ac, dictum sed est. Duis scelerisque, libero eget porta viverra, nisi
                        elit venenatis nunc, vitae sodales enim sapien at nibh.
                    </p>
                </div>
            </div>
            <div class="d-flex flex-column flex-lg-row bg-dark border-white rounded mb-3">
                <div class="about-section-title border-4 border-white text-white p-5 d-flex align-items-center">
                    <p>Contents of LYFJSHS</p>
                </div>
                <div class="flex-fill p-5 bg-dark-subtle">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer at dapibus nibh. In felis nulla,
                        mattis vestibulum accumsan ac, dictum sed est. Duis scelerisque, libero eget porta viverra, nisi
                        elit venenatis nunc, vitae sodales enim sapien at nibh.
                    </p>
                </div>
            </div>
            <div class="d-flex flex-column flex-lg-row bg-dark border-white rounded">
                <div class="about-section-title border-4 border-white text-white p-5 d-flex align-items-center">
                    <p">Benefits</p>
                </div>
                <div class="flex-fill p-5 bg-dark-subtle">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer at dapibus nibh. In felis nulla,
                        mattis vestibulum accumsan ac, dictum sed est. Duis scelerisque, libero eget porta viverra, nisi
                        elit venenatis nunc, vitae sodales enim sapien at nibh.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div id="contact" class="container-fluid text-white contact bg-secondary main-body-padding">
        <h1 class="mb-5">Contact us</h1>
        <div style="font-size: 14px;" class="letter-spacing d-flex fw-normal">
            <div class="flex-fill border-end border-white pe-2 me-3">
                <div>
                    <p class="mb-1">
                        <i class="me-1 fas fa-phone"></i> Phone or Telephone numbers
                    </p>
                    <div style="font-size: 12px;">
                        <p style="margin-bottom: 0.5px;" class="letter-spacing fw-light">+639999999999</p>
                        <p class="fw-light">+639999999999</p>
                    </div>
                </div>
                <div>
                    <p class="mb-1 fw-normal"><i class="fas fa-envelope"></i> Email</p>
                    <p class="fw-light">info@lyfjshs.com</p>
                </div>
            </div>
            <div class="flex-fill fw-light">
                <a class="link mb-1" href="#"><i class="me-1 fab fa-facebook"></i> Deped Tayo Luis Y. Ferrer Jr SHS - General Trias City</a>
                <a class="link mb-1" href="#"><i class="me-1 fas fa-globe-asia"></i> LYFJSHS Official Website </a>
                <p><i class="fas fa-map-marker-alt me-1"></i> South Square Village, Pasong Kawayan 2, General Trias City 4107, Cavite</p>
            </div>
        </div>
    </div>
    <div class="bg-dark p-3">
        <p style="font-size: 12px;" class="mb-0 text-light fw-light text-center">&copy Copyright 2024</p>
    </div>
<?php
} else if ($_SESSION["type"] == "admin" || $_SESSION["type"] == "teacher" || $_SESSION["type"] == "principal") {
    include("/xampp/htdocs/thesis/views/home/admin.php");
} else { ?>
    <div class="dashboard">
        <?php include("/xampp/htdocs/thesis/views/home/contents.php"); ?>
    </div>
<?php } ?>



<!-- Modal -->
<?php include "alumni_registration_modal.php"; ?>

<!-- Logout User -->
<?php include("/xampp/htdocs/thesis/views/template/footer.php"); ?>