<?php session_start(); ?>
<?php
include "/xampp/htdocs/thesis/models/Alumni.php";
include "/xampp/htdocs/thesis/models/Email.php";
include "/xampp/htdocs/thesis/models/SchoolInformation.php";
include "/xampp/htdocs/thesis/views/alumni/registration/data.php";

$alumni = new Alumni();
$schoolInformation = new SchoolInformation();

$id = $_GET["id"];

$alumniDetails = $alumni->getAlumniById($id);
$userProfile = $alumni->getAlumniUserProfile($alumniDetails["userAccountID"]);
$schoolHistory = $alumni->getAlumniSchoolHistory($alumniDetails["id"]);
$presentStatus = $alumni->getPresentStatus($alumniDetails["id"]);
$curriculumExit = $alumni->getCurriculumExit($alumniDetails["id"]);
$additionalFields = $alumni->getAdditionalFieldAnswers($id);

//School Information
$tracks = $schoolInformation->getTracks();
$strands = $schoolInformation->getStrands();
$specializations = $schoolInformation->getSpecializations();

function getTrackCode($tracks, $currentTrack)
{
    foreach ($tracks as $track) {
        if ($currentTrack === $track[2]) {
            return $track[1];
        }
    }
}

function getStrandCode($strands, $currentStrand)
{
    foreach ($strands as $strand) {
        if ($strand[1] === $currentStrand) {
            return $strand[4];
        }
    }
}

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $action = $_POST["action"];
//     // if ($action == "edit") {
//     //     if ($additionalFields->num_rows > 0) {
//     //         $_POST["additional-field"] = true;
//     //     }

//     //     $result = $alumni->editAlumni();

//     //     if ($result) {
//     //         header("Location: /thesis/alumni/profile");
//     //     } else {
//     //         echo "something went wrong updating alumni";
//     //     }
//     // }
//     if ($action == "delete") {
//         $email = new Email();
//         $emailAddress = $alumniDetails["email"];
//         $name = $alumniDetails["firstName"];

//         $emailContent = $_POST["delete_reason"];

//         $email->sendEmail($emailAddress, $name, $emailContent);

//         $result = $alumni->deleteAlumni($id, $alumniDetails["userAccountID"]);

//         if ($result) {
//             header("Location: /thesis/alumni/index");
//         }
//     }
//     if ($action == "image_upload") {
//         if ($_FILES["profilePhoto"]["name"]) {
//             $alumni->changeProfilePhoto($alumniDetails["id"], $alumniDetails["photo"]);
//             header("Location: /thesis/alumni?id=$id");
//         } else {
//             header("Location: /thesis/alumni?id=$id");
//         }
//     }
// }
?>
<?php include("/xampp/htdocs/thesis/views/template/header.php"); ?>

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
        <div class="alumni-information p-2">
            <form id="personal-information-edit">
                <p class="fw-bold m-0">Personal information</p>
                <!--Name-->
                <div class="flex-fill me-1 mb-2">
                    <label class="label" for="first_name">First Name</label>
                    <input name="first_name" id="first_name" class="form-control mb-2" type="text" value="<?php echo $alumniDetails["firstName"] ?>" />
                </div>
                <?php if (isset($alumniDetails["middleName"])) { ?>
                    <div class="flex-fill me-1 mb-2">
                        <label class="label" for="middle_name">Middle Name</label>
                        <input name="middle_name" id="middle_name" class="form-control mb-2" type="text" value="<?php echo $alumniDetails["middleName"] ?>" />
                    </div>
                <?php } ?>
                <div class="flex-fill me-1 mb-2">
                    <label class="label" for="last_name">Last Name</label>
                    <input name="last_name" id="last_name" class="form-control mb-2" type="text" value="<?php echo $alumniDetails["lastName"] ?>" />
                </div>
                <!--Contact number-->
                <div class="flex-fill me-1 mb-2">
                    <label class="label" for="contact_number">Contact Number</label>
                    <input name="contact_number" id="contact_number" class="form-control" type="text" value="<?php echo $alumniDetails["contactNumber"]; ?>" />
                </div>
                <!--Email-->
                <div class="flex-fill me-1">
                    <label class="label" for="email">Email</label>
                    <input name="email" id="email" class="form-control" type="text" value="<?php echo $alumniDetails["email"]; ?>" readonly />
                </div>
                <button class="btn btn-sm btn-dark mt-2">Save</button>
            </form>
        </div>
    </div>
    <div class="col-8">
        <!-- Gender, Age, Birthday -->
        <form id="personal-information-2" class="mb-3">
            <div class="alumni-information p-2">
                <div class="d-flex">
                    <div class="p-2 flex-fill me-1">
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
                    <div class="p-2 flex-fill me-1">
                        <label class="label" for="age">Age</label>
                        <input name="age" id="age" type="number" class="form-control" value="<?php echo $alumniDetails["age"]; ?>" readonly />
                    </div>
                    <div class="p-2 flex-fill me-1">
                        <label class="label" for="birthday">Birthday</label>
                        <input name="birthday" id="birthday" class="form-control" value="<?php echo $alumniDetails["birthday"]; ?>" />
                    </div>
                </div>
                <!-- Address -->
                <div class="p-2 my-3">
                    <label class="label" for="address">Address</label>
                    <input name="address" type="text" id="address" class="form-control" value="<?php echo $alumniDetails["address"]; ?>" />
                </div>

                <button class="btn btn-sm btn-dark">Save</button>
            </div>
        </form>
        <!-- School History (Track finished, Strand finished, Year Graduated) -->
        <div class="d-flex align-items-center">
            <h5 class="m-0 me-1 w-100">History</h5>
            <button class="btn btn-outline-dark btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#history">View</button>
        </div>
        <hr />
        <div class="collapse" id="history">
            <div class="alumni-information p-2">
                <form id="alumni-school-history">
                    <div class="d-flex">
                        <div class="p-2 me-1 mt-2 flex-fill">
                            <label class="label" for="track_finished">Track Finished</label>
                            <select id="track" name="track" class="me-2 form-select form-select-sm" aria-label="Small select example" required>
                                <?php foreach ($tracks as $track) { ?>
                                    <option <?php if ($track[2] === $schoolHistory["track"]) {
                                                echo "selected";
                                            } ?> value="<?php echo $track[2] ?>"><?php echo $track[2] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="p-2 me-1 mt-2 flex-fill">
                            <label class="label" for="strand_finished">Strand Finished</label>
                            <select id="strand" name="strand" class="me-2 form-select form-select-sm" aria-label="Small select example" required>

                                <?php foreach ($strands as $strand) { ?>
                                    <option hidden class="strand-option <?php echo $strand[3]; ?>" <?php if ($schoolHistory["strand"] === $strand[1]) {
                                                                                                        echo "selected";
                                                                                                    } ?> value="<?php echo $strand[1] ?>">
                                        <?php echo $strand[1]; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <?php $strandCode = getStrandCode($strands, $schoolHistory["strand"]); ?>
                        <div class="p-2 me-1 mt-2 flex-fill">
                            <label class="label" for="strand_finished">Specialization</label>
                            <select <?php if (!isset($schoolHistory["specialization"])) {
                                        echo "disabled";
                                    } ?> id="specialization" name="specialization" class="me-2 form-select form-select-sm" aria-label="Small select example" required>
                                <?php foreach ($specializations as $specialization) { ?>
                                    <option hidden class="specialization-option <?php echo $specialization[4]; ?>" <?php
                                                                                                                    if ($schoolHistory["specialization"] === $specialization[3]) {
                                                                                                                        echo "selected";
                                                                                                                    } ?> value="<?php echo $specialization[3] ?>">
                                        <?php echo $specialization[3]; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="p-2 mt-2 flex-fill">
                        <label class="label" for="date_graduated">Year Graduated</label>
                        <input name="date_graduated" id="date_graduated" class="form-control" value="<?php echo $schoolHistory["yearGraduated"]; ?>" />
                    </div>
                    <button class="btn btn-sm btn-dark mt-2">Save</button>
                </form>
            </div>
            <!-- Present Status -->
        </div>
        <div class="p-2 alumni-information me-1 mt-2">
            <label class="label" for="present_status">Present Status</label>
            <p class="m-0 mb-2"><?php echo $presentStatus["presentStatus"] ?></p>
            <?php if ($presentStatus["presentStatus"] === "University Student" || $presentStatus["presentStatus"] === "Employed") { ?>
                <a role="button" href="/thesis/alumni/edit/presentstatus?id=<?php echo $id ?>" class="btn btn-sm btn-outline-dark">
                    Edit details
                </a>
            <?php } ?>
        </div>
        <div class="p-2 alumni-information me-1 my-2">
            <label class="label" for="curriculum_exit">Curriculum Exit</label>
            <p class="m-0 mb-2"><?php echo $curriculumExit["pursuedCurriculumExit"] ?></p>
            <a href="/thesis/alumni/edit/curriculumexit?id=<?php echo $id ?>" class="btn btn-sm btn-outline-dark">Edit details</a>
        </div>
        <?php if ($additionalFields->num_rows > 0) { ?>
            <div class="d-flex align-items-center my-3">
                <h5 class="m-0 me-1">Additional fields</h5>
                <button class="btn btn-sm btn-outline-dark" type="button" data-bs-toggle="collapse" data-bs-target="#additional-fields">View</button>
            </div>
            <div class="collapse" id="additional-fields">
                <?php
                $fields = $additionalFields->fetch_all();
                foreach ($fields as $field) {
                ?>
                    <?php if ($field[4] == "user_defined") { ?>
                        <div class="p-2 alumni-information me-1 my-2">
                            <label class="label" for="<?php echo $field[0] ?>"><?php echo $field[2] ?></label>
                            <input id="<?php echo $field[0] ?>" class="form-control mb-2" type="<?php echo $field[3]; ?>" name="field-<?php echo $field[5] ?>" value="<?php echo $field[1]; ?>" />
                        </div>
                    <?php } else if ($field[4] == "multiple_choice") { ?>
                        <div class="p-2 alumni-information me-1 my-2">
                            <label class="label" for="<?php echo $field[0] ?>"><?php echo $field[2] ?></label>
                            <select name="field-<?php echo $field[5] ?>" id="<?php echo $field[0] ?>" class="form-control mb-1">
                                <?php
                                //getchoices 
                                $choices = $alumni->getAdditionalFieldChoices($field[5]);
                                ?>
                                <?php if ($choices->num_rows > 0) { ?>
                                    <?php foreach ($choices->fetch_all() as $choice) { ?>
                                        <option <?php if ($choice[0] == $field[1]) {
                                                    echo "selected";
                                                } ?> value="<?php echo $choice[0]; ?>">
                                            <?php echo $choice[2] ?>
                                        </option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
            </div>
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
    $("#personal-information-edit").on("submit", (event) => {
        event.preventDefault();

        const formData = new FormData(event.target);

        formData.append("alumniID", <?php echo $id ?>);
        formData.append("toEdit", "personal-information");

        $.ajax({
            type: "POST",
            url: "/thesis/alumni/edit/server",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                const parsedResponse = JSON.parse(response);

                const successToast = new bootstrap.Toast("#response");
                const errorToast = new bootstrap.Toast("#error-response");

                if (parsedResponse.response) {
                    $("#toast-body").append("Sucessfully saved");
                    $("#response").addClass("text-bg-success");
                    successToast.show();
                } else {
                    $("#error-response #toast-body").append("Something went wrong");

                    errorToast.show();
                }
            }
        });
    });

    $("#personal-information-2").on("submit", (event) => {
        event.preventDefault();
        const formData = new FormData(event.target);

        formData.append("alumniID", <?php echo $id ?>);
        formData.append("toEdit", "personal-information-2");

        $.ajax({
            type: "POST",
            url: "/thesis/alumni/edit/server",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                const parsedResponse = JSON.parse(response);

                const successToast = new bootstrap.Toast("#response");
                const errorToast = new bootstrap.Toast("#error-response");

                if (parsedResponse.response) {
                    $("#toast-body").empty();
                    $("#toast-body").append("Sucessfully saved");
                    $("#response").addClass("text-bg-success");
                    successToast.show();
                } else {
                    $("#error-response #toast-body").empty();
                    $("#error-response #toast-body").append("Something went wrong");

                    errorToast.show();
                }
            }
        });
    });

    $("#alumni-school-history").on("submit", (event) => {
        event.preventDefault();
        const formData = new FormData(event.target);

        formData.append("alumniID", <?php echo $id ?>);
        formData.append("toEdit", "alumni-school-history");

        $.ajax({
            type: "POST",
            url: "/thesis/alumni/edit/server",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                const parsedResponse = JSON.parse(response);

                const successToast = new bootstrap.Toast("#response");
                const errorToast = new bootstrap.Toast("#error-response");

                if (parsedResponse.response) {
                    $("#toast-body").empty();
                    $("#toast-body").append("Sucessfully saved");
                    $("#response").addClass("text-bg-success");
                    successToast.show();
                } else {
                    $("#error-response #toast-body").empty();
                    $("#error-response #toast-body").append("Something went wrong");

                    errorToast.show();
                }
            }
        });
    });
    window.onload = () => {
        if ($("#present_status").val() === "University Student") {
            $("#undergraduate-form").show();
        }

        const trackCode = "<?php echo getTrackCode($tracks, $schoolHistory["track"]); ?>";
        const strandCode = "<?php echo getStrandCode($strands, $schoolHistory["strand"]); ?>";
        $(`.${trackCode}`).prop("hidden", false);
        $(`.${strandCode}`).prop("hidden", false);

    }

    const currentDate = new Date();
    const endDate = currentDate.getFullYear() - 18;


    $("#birthday").datepicker({
        endDate: `01/01/${endDate}`
    });

    $("#date_graduated").datepicker({
        format: "yyyy",
        startView: 2,
        maxViewMode: 2,
        minViewMode: 2
    });

    $("#birthday").on("change", (event) => {
        const birthday = new Date(event.target.value);
        const age = ageComputer(birthday);

        $("#age").val(age);
    })

    $("#present_status").on("change", (event) => {
        console.log(event.target.value)
        if (event.target.value === "University Student") {
            $("#undergraduate-form").show();
        } else {
            $("#undergraduate-form").hide();
        }
    });

    $("#track").on("change", (event) => {
        $(".strand-option").prop("hidden", true);
        $("#strand").val("");

        if (event.target.value === "Academic") {
            $("#specialization").prop("disabled", true);
        } else {
            $("#specialization").prop("disabled", false);
        }

        const strands = <?php echo json_encode($strands); ?>;

        let found = strands.find((strand) => {
            return strand[0] === event.target.value;
        });

        if (found[3]) {
            $(`.${found[3]}`).prop("hidden", false);
        }
    });

    $("#strand").on("change", (event) => {
        const specializations = <?php echo json_encode($specializations); ?>;
        $(".specialization-option").prop("hidden", true);
        $("#specialization").val("");

        let found = specializations.find((specialization) => {
            return specialization[2] === event.target.value;
        })

        $(`.${found[4]}`).prop("hidden", false);
    });

    const caviteInstitutions = new bootstrap.Collapse(document.getElementById("cavite"), {
        toggle: false
    });
    const outsideCaviteInstitutions = new bootstrap.Collapse(document.getElementById("outside-cavite"), {
        toggle: false
    });

    $("#school-location").on("change", (event) => {
        console.log(event.target.value);

        caviteInstitutions.hide();
        outsideCaviteInstitutions.hide();

        if (event.target.value === "Cavite") {
            caviteInstitutions.show();
        }
        if (event.target.value === "Outside Cavite") {
            outsideCaviteInstitutions.show();
        }
    });

    const undergraduateProgramForm = new bootstrap.Collapse(document.getElementById("undergraduate-selection"), {
        toggle: false
    })

    const graduateProgramForm = new bootstrap.Collapse(document.getElementById("graduate-selection"), {
        toggle: false
    })

    $("#program").on("change", (event) => {
        console.log(event.target.value);

        undergraduateProgramForm.hide();
        graduateProgramForm.hide();

        if (event.target.value === "Undergraduate") {
            undergraduateProgramForm.show();
        }
        if (event.target.value === "Graduate") {
            graduateProgramForm.show();
        }
    });
</script>
<?php include("/xampp/htdocs/thesis/views/template/footer.php"); ?>