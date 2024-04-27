<div class="user bg-white p-3 shadow-sm rounded container-fluid w-50">
    <?php
    include ("/xampp/htdocs/thesis/models/Users.php");
    include "/xampp/htdocs/thesis/models/utilities/StringUtilities.php";

    $user = new Users();
    $stringUtil = new StringUltilities();

    $result = $user->getUser($_SESSION["email"]);
    $userDetails = $result->fetch_assoc();
    $alumniPhoto = "";

    if ($_SESSION["type"] == "alumni") {
        $alumniAccount = $user->getAlumniProfile($userDetails["id"]);
        if (isset($alumniAccount["photo"])) {
            $alumniPhoto = $alumniAccount["photo"];
            echo "<img class='profile-photo' src='/thesis/public/images/alumni/$alumniPhoto' />";
        } else {
            echo "<img src='/thesis/public/assets/user.png' class='profile-photo bg-secondary p-2' />";
        }
    } else {
        if ($_SESSION["photo"]) {
            $photo = $_SESSION["photo"];
            echo "<img class='profile-photo' src='$photo' style='border-radius: 100%;' />";
        } else {
            echo "<img src='/thesis/public/assets/user.png' class='profile-photo bg-secondary p-2' />";
        }
    }



    ?>
    <div class="text-center">
        <h2 class="mb-0"><?php echo $_SESSION["first_name"]; ?> <?php echo $_SESSION["last_name"]; ?></h2>

        <p class="text-primary m-0 mb-4 fs-4"><?php echo $_SESSION["type"]; ?></p>
        <?php if (isset($_SESSION["username"])) { ?>
            <p class="value m-0"><?php echo $_SESSION["username"]; ?></p>
        <?php } ?>
        <p class="value"><i class="fas fa-envelope"></i> <?php echo $_SESSION["email"]; ?></p>

        <p class="m-0 text-secondary">Added on <?php echo $stringUtil->dateAndTime($userDetails["dateCreated"]) ?></p>
        <?php if (isset($userDetails["dateModified"])) { ?>
            <p class="text-secondary">Last update <?php echo $stringUtil->dateAndTime($userDetails["dateModified"]) ?></p>
        <?php } ?>
        <?php if ($_SESSION["type"] == "admin" || $_SESSION["type"] == "teacher" || $_SESSION["type"] == "principal") { ?>
            <a role="button" href=<?php echo "/thesis/users/edit?id=" . $userDetails["id"]; ?>
                class="mt-3 btn btn-sm btn-outline-dark">
                <i class="fas fa-pen"></i> Edit
            </a>
        <?php } ?>
        <?php if ($userDetails["type"] == "alumni") { ?>
            <a role="button" h href="/thesis/alumni/profile" class="mt-3 btn btn-sm btn-outline-dark">
                <i class="fas fa-user-graduate"></i> Alumni profile
            </a>
        <?php } ?>
    </div>
</div>