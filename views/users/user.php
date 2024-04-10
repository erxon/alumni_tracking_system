<?php session_start() ?>
<?php include("/xampp/htdocs/thesis/views/template/header.php") ?>

<?php
require "/xampp/htdocs/thesis/models/Users.php";
require "/xampp/htdocs/thesis/models/utilities/StringUtilities.php";

$users = new Users();
$stringUtil = new StringUltilities();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_URL);

    $result = $users->getUser($id);

    if (isset($result)) {
        $rows = $result->fetch_assoc(); ?>
        <div class="main-body-padding" style="margin-top: 5%">
            <div class="user bg-white p-3 shadow rounded container-fluid w-50">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/thesis/users/index?page=1">Users</a></li>
                        <li class="breadcrumb-item" aria-current="page"><?php echo $rows["username"]; ?></li>
                    </ol>
                </nav>

                <?php
                if ($rows["type"] == "alumni") {
                    $alumniProfile = $users->getAlumniProfile($rows["id"]);
                    $alumniPhoto = $alumniProfile["photo"];
                    echo "<img class='profile-photo' src='/thesis/public/images/alumni/$alumniPhoto' />";
                } else {
                    if (isset($rows["photo"])) {
                        $file = $rows["photo"];
                        echo "<img class='profile-photo' src='/thesis/public/images/profile/$file' />";
                    } else {
                        echo "<div class='photo-container mb-3'></div>";
                    }
                }

                ?>
                <div class="text-center">
                    <h2 class="mb-0"><?php echo $rows["firstName"] ?> <?php echo $rows["lastName"] ?></h2>

                    <p class="text-primary m-0 mb-4 fs-4"><?php echo $rows["type"] ?></p>
                    <p class="value m-0"><?php echo $rows["username"] ?></p>
                    <p class="value"><i class="fas fa-envelope"></i> <?php echo $rows["email"] ?></p>

                    <p class="m-0 text-secondary">Added on <?php echo $stringUtil->dateAndTime($rows["dateCreated"]) ?></p>
                    <?php if (isset($rows["dateModified"])) { ?>
                        <p class="text-secondary">Last update <?php echo $stringUtil->dateAndTime($rows["dateModified"]) ?></p>
                    <?php } ?>
                    <?php if ($_SESSION["user_id"] == $rows["id"]) { ?>
                        <a role="button" href=<?php echo "/thesis/users/edit?id=" . $id; ?> class="mt-3 btn btn-sm btn-outline-dark">
                            <i class="fas fa-pen"></i> Edit
                        </a>
                    <?php } ?>
                    <?php if ($_SESSION["type"] == "admin" && $_SESSION["user_id"] != $rows["id"]) { ?>
                        <button class="mt-3 btn btn-sm btn-outline-danger"><i class="fas fa-trash-alt"></i> Delete</button>
                    <?php } ?>
                    <?php if ($rows["type"] == "alumni") { ?>
                        <a role="button" href=<?php echo "/thesis/admin/alumni/userid?userId=" . $rows["id"]; ?> class="mt-3 btn btn-sm btn-outline-dark">
                            <i class="fas fa-user-graduate"></i> Alumni profile
                        </a>
                    <?php } ?>
                </div>


            </div>
        </div>
    <?php } ?>
<?php } ?>


<?php include("/xampp/htdocs/thesis/views/template/footer.php"); ?>