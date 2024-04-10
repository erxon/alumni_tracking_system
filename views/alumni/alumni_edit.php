<?php session_start(); ?>
<?php
include("/xampp/htdocs/thesis/models/Alumni.php");
include("/xampp/htdocs/thesis/models/Email.php");

$alumni = new Alumni();

$id = $_GET["id"];
$alumniDetails = $alumni->getAlumniById($id);
$userProfile = $alumni->getAlumniUserProfile($alumniDetails["userAccountID"]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST["action"];
    if ($action == "edit") {
        $result = $alumni->editAlumni();

        if ($result) {
            header("Location: /thesis/alumni/profile");
        } else {
            echo "something went wrong updating alumni";
        }
    }
    if ($action == "delete") {
        $email = new Email();
        $emailAddress = $alumniDetails["email"];
        $name = $alumniDetails["firstName"];

        $emailContent = $_POST["delete_reason"];

        $email->sendEmail($emailAddress, $name, $emailContent);

        $result = $alumni->deleteAlumni($id, $alumniDetails["userAccountID"]);

        if ($result) {
            header("Location: /thesis/alumni/index");
        }
    }
    if ($action == "image_upload") {
        if ($_FILES["profilePhoto"]["name"]) {
            $alumni->changeProfilePhoto($alumniDetails["id"], $alumniDetails["photo"]);
            header("Location: /thesis/alumni?id=$id");
        } else {
            header("Location: /thesis/alumni?id=$id");
        }
    }
}
?>
<?php include("/xampp/htdocs/thesis/views/template/header.php"); ?>

<form id="alumni-edit-form" method="post" enctype="multipart/form-data">
    <div class="row main-body-padding w-75 mx-auto alumni-profile">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <?php if ($_SESSION["type"] == "admin") {
                    echo "<li class='breadcrumb-item'><a href='/thesis/alumni/index'>Index</a></li>";
                } ?>
                <li class="breadcrumb-item"><a href="/thesis/alumni/profile">Profile</a></li>
                <li class="breadcrumb-item" aria-current="page">Edit</li>
            </ol>
        </nav>
        <div class="col-4">
            <!--Photo-->
            <div class="mb-3 p-2 alumni-information text-center">
                <?php if ($alumniDetails["photo"]) { ?>
                    <img class="profile-photo" src="/thesis/public/images/alumni/<?php echo $alumniDetails["photo"] ?>" />
                <?php } else { ?>
                    <div class="photo-container mb-2 m-auto"></div>
                <?php } ?>
                <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#uploadPhotoModal">Add Photo</button>
            </div>
            <input hidden name="id" value="<?php echo $alumniDetails["id"]; ?>" />
            <!--Set status-->
            <div class="mb-3 badge text-bg-primary">
                <?php echo $alumniDetails["status"]; ?>
            </div>
            <!--Name-->
            <div class="p-2 alumni-information flex-fill me-1 mb-2">
                <label class="label" for="first_name">First Name</label>
                <input name="first_name" id="first_name" class="form-control mb-2" type="text" value="<?php echo $alumniDetails["firstName"] ?>" />
            </div>
            <?php if (isset($alumniDetails["middleName"])) { ?>
                <div class="p-2 alumni-information flex-fill me-1 mb-2">
                    <label class="label" for="middle_name">Middle Name</label>
                    <input name="middle_name" id="middle_name" class="form-control mb-2" type="text" value="<?php echo $alumniDetails["middleName"] ?>" />
                </div>
            <?php } ?>
            <div class="p-2 alumni-information flex-fill me-1 mb-2">
                <label class="label" for="last_name">Last Name</label>
                <input name="last_name" id="last_name" class="form-control mb-2" type="text" value="<?php echo $alumniDetails["lastName"] ?>" />
            </div>
            <!--Contact number-->
            <div class="p-2 alumni-information flex-fill me-1 mb-2">
                <label class="label" for="contact_number">Contact Number</label>
                <input name="contact_number" id="contact_number" class="form-control" type="text" value="<?php echo $alumniDetails["contactNumber"]; ?>" />
            </div>
            <!--Email-->
            <div class="p-2 alumni-information flex-fill me-1">
                <label class="label" for="email">Email</label>
                <input name="email" id="email" class="form-control" type="text" value="<?php echo $alumniDetails["email"]; ?>" />
            </div>
        </div>
        <div class="col-8">
            <!-- Gender, Age, Birthday -->
            <div class="d-flex">
                <div class="p-2 alumni-information flex-fill me-1">
                    <label class="label" for="gender">Gender</label>
                    <select class="form-select" name="gender" aria-label="Default select example">
                        <option <?php if ($alumniDetails["gender"] == "Male") {
                                    echo "selected";
                                } ?> value="Male">Male
                        </option>
                        <option <?php if ($alumniDetails["gender"] == "Female") {
                                    echo "selected";
                                } ?> value="Female">Female
                        </option>
                    </select>
                </div>
                <div class="p-2 alumni-information flex-fill me-1">
                    <label class="label" for="age">Age</label>
                    <input name="age" id="age" type="number" class="form-control" value="<?php echo $alumniDetails["age"]; ?>" />
                </div>
                <div class="p-2 alumni-information flex-fill me-1">
                    <label class="label" for="birthday">Birthday</label>
                    <input name="birthday" type="date" id="birthday" class="form-control" value="<?php echo $alumniDetails["birthday"]; ?>" />
                </div>
            </div>
            <!-- Address -->
            <div class="p-2 alumni-information my-3">
                <label class="label" for="address">Address</label>
                <input name="address" type="text" id="address" class="form-control" value="<?php echo $alumniDetails["address"]; ?>" />
            </div>
            <!-- School History (Track finished, Strand finished, Year Graduated) -->
            <p class="m-0 fw-semibold">History</p>
            <div class="d-flex">
                <div class="p-2 alumni-information me-1 mt-2 flex-fill">
                    <label class="label" for="track_finished">Track Finished</label>
                    <select id="track_finished" name="track_finished" class="me-2 form-select form-select-sm" aria-label="Small select example" required>
                        <option <?php if ($alumniDetails["trackFinished"] == "Academic") {
                                    echo "selected";
                                } ?> value="Academic">Academic</option>
                        <option <?php if ($alumniDetails["trackFinished"] == "TVL") {
                                    echo "selected";
                                } ?> value="TVL">Technical-Vocational-Livelihood</option>
                    </select>
                </div>
                <div class="p-2 alumni-information me-1 mt-2 flex-fill">
                    <label class="label" for="strand_finished">Strand Finished</label>
                    <select id="strand" name="strand_finished" class="me-2 form-select form-select-sm" aria-label="Small select example" required>
                        <option <?php if ($alumniDetails["strandFinished"] == "HUMSS") {
                                    echo "selected";
                                } ?> value="HUMSS">Humanities and Social Sciences</option>
                        <option <?php if ($alumniDetails["strandFinished"] == "STEM") {
                                    echo "selected";
                                } ?> value="STEM">Science, Technology, Engineering, and Mathematics</option>
                        <option <?php if ($alumniDetails["strandFinished"] == "ABM") {
                                    echo "selected";
                                } ?> value="ABM">Accountancy, Business and Management</option>
                        <option <?php if ($alumniDetails["strandFinished"] == "Home Economics") {
                                    echo "selected";
                                } ?> value="Home Economics">Home Economics</option>
                        <option <?php if ($alumniDetails["strandFinished"] == "Industrial Arts") {
                                    echo "selected";
                                } ?> value="Industrial Arts">Industrial Arts</option>
                        <option <?php if ($alumniDetails["strandFinished"] == "ICT") {
                                    echo "selected";
                                } ?> value="ICT">Information, Communication and Technology</option>
                    </select>
                </div>
                <div class="p-2 alumni-information mt-2 flex-fill">
                    <label class="label" for="date_graduated">Year Graduated</label>
                    <input name="date_graduated" id="date_graduated" type="number" class="form-control" value="<?php echo $alumniDetails["dateGraduated"]; ?>" />
                </div>
            </div>
            <!-- Present Status -->
            <div class="p-2 alumni-information me-1 mt-2">
                <label class="label" for="present_status">Present Status</label>
                <select id="present_status" name="present_status" class="me-2 form-select form-select-md mb-3" aria-label="Small select example" required>
                    <option <?php if ($alumniDetails["presentStatus"] == "University Student") {
                                echo "selected";
                            } ?> value="University Student">University Student</option>
                    <option <?php if ($alumniDetails["presentStatus"] == "Employed") {
                                echo "selected";
                            } ?> value="Employed">Employed</option>
                    <option <?php if ($alumniDetails["presentStatus"] == "Unemployed") {
                                echo "selected";
                            } ?> value="Unemployed">Unemployed</option>
                    <option <?php if ($alumniDetails["presentStatus"] == "Did not continue to college") {
                                echo "selected";
                            } ?> value="Did not continue to college">Did not continue to college</option>
                </select>
                <div style="display: none;" id="undergraduate-form">
                    <?php if (isset($alumniDetails["undergraduate"])) {
                        $undergradDetails = $alumni->undergraduate($alumniDetails["undergraduate"]); ?>
                        <input hidden name="undergraduateId" value="<?php echo $alumniDetails["undergraduate"]; ?>" />
                        <label class="label" for="inst-name">Institution name</label>
                        <input id="inst-name" class="form-control mb-1" name="instName" value="<?php echo $undergradDetails["instName"] ?>" />
                        <label class="label" for="inst-add">Institution address</label>
                        <input id="inst-add" class="form-control mb-1" name="instAddress" value="<?php echo $undergradDetails["instAddress"] ?>" />
                        <label class="label" for="specialization">Major</label>
                        <input id="specialization" class="form-control mb-1" name="specialization" value="<?php echo $undergradDetails["specialization"] ?>" />
                        <label class="label" for="program">Course</label>
                        <input id="program" class="form-control mb-1" name="program" value="<?php echo $undergradDetails["program"] ?>" />
                        <label class="label" for="exp-grad-date">Expected graduation date</label>
                        <input id="exp-grad-date" class="form-control mb-1" name="expGraduationDate" value="<?php echo $undergradDetails["expGraduationDate"] ?>" />
                    <?php } else {  ?>
                        <label class="label" for="inst-name">Institution name</label>
                        <input id="inst-name" class="form-control mb-1" name="instName" value="" />
                        <label class="label" for="inst-add">Institution address</label>
                        <input id="inst-add" class="form-control mb-1" name="instAddress" value="" />
                        <label class="label" for="specialization">Major</label>
                        <input id="specialization" class="form-control mb-1" name="specialization" value="" />
                        <label class="label" for="program">Course</label>
                        <input id="program" class="form-control mb-1" name="program" value="" />
                        <label class="label" for="exp-grad-date">Expected graduation date</label>
                        <input id="exp-grad-date" class="form-control mb-1" name="expGraduationDate" value="" />
                    <?php } ?>
                </div>
            </div>

            <div class="p-2 alumni-information me-1 my-2">
                <label class="label" for="curriculum_exit">Curriculum Exit</label>
                <p class="m-0">
                    <?php echo $alumniDetails["curriculumExit"]; ?>
                </p>
            </div>

            <button type="button" data-bs-toggle="modal" data-bs-target="#confirmationDialog" class="btn btn-outline-dark">Save</button>
            <?php if ($_SESSION["type"] == "admin") { ?>
                <button type="button" data-bs-toggle="modal" data-bs-target="#deleteConfirmationDialog" class="btn btn-outline-danger">Delete</button>
            <?php } ?>
            <div class="modal fade" id="confirmationDialog" tabindex="-1" aria-labelledby="confirmationDialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Update Alumni</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to save changes?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="action" value="edit" class="btn btn-primary">Save
                                changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="deleteConfirmationDialog" tabindex="-1" aria-labelledby="deleteConfirmationDialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Update Alumni</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this alumni record?</p>

                            <input id="delete-reason" name="delete_reason" class="form-control" placeholder="Please state your reason here" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button disabled id="confirm-alumni-delete-button" type="submit" name="action" value="delete" class="btn btn-primary">Confirm delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!--Add Photo Modal Form-->
<form method="post" enctype="multipart/form-data">
    <input hidden name="action" value="image_upload" />
    <div class="modal fade" id="uploadPhotoModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload photo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input name="profilePhoto" type="file" class="form-control" value="" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    window.onload = () => {
        if ($("#present_status").val() === "University Student") {
            $("#undergraduate-form").show();
        }
    }

    $("#present_status").on("change", (event) => {
        console.log(event.target.value)
        if (event.target.value === "University Student") {
            $("#undergraduate-form").show();
        } else {
            $("#undergraduate-form").hide();
        }
    })
</script>
<?php include("/xampp/htdocs/thesis/views/template/footer.php"); ?>