<div class="user">
    <h2>Profile</h2>
    <?php
    if ($_SESSION["type"] == "alumni") {
        include("/xampp/htdocs/thesis/models/Alumni.php");
        $alumni = new Alumni();
        $alumniDetails = $alumni->getAlumniByUserId($_SESSION["user_id"]);
        if (isset($alumniDetails["photo"])) {
            $file = $alumniDetails["photo"];
            echo "<img class='profile-photo' src='/thesis/public/images/profile/$file' />";
        } else {
            echo "<div class='photo-container mb-3'></div>";
        }
    } else {
        include("/xampp/htdocs/thesis/models/Users.php");
        $user = new Users();
        $result = $user->getUser($_SESSION["user_id"]);
        $userDetails = $result->fetch_assoc();

        if (isset($userDetails["photo"])) {
            $file = $userDetails["photo"];
            echo "<img class='profile-photo' src='/thesis/public/images/profile/$file' />";
        } else {
            echo "<div class='photo-container mb-3'></div>";
        }
    }
    ?>
    <div class="information">
        <p class="m-0 label">Username</p>
        <p class="value"><?php echo $_SESSION["username"]; ?></p>
    </div>
    <div class="information">
        <p class="m-0 label">First Name</p>
        <p class="value"><?php echo $_SESSION["first_name"]; ?></p>
    </div>
    <div class="information">
        <p class="m-0 label">Last Name</p>
        <p class="value"><?php echo $_SESSION["last_name"]; ?></p>
    </div>
    <div class="information">
        <p class="m-0 label">Email</p>
        <p class="value"><?php echo $_SESSION["email"]; ?></p>
    </div>
    <div class="information">
        <p class="m-0 label">Type</p>
        <p class="value"><?php echo $_SESSION["type"]; ?></p>
    </div>
    <?php if ($_SESSION["type"] == "alumni") { ?>
        <a role="button" href="/thesis/alumni/profile" class="btn btn-sm btn-outline-dark">
            <i class="fas fa-graduation-cap"></i> Almuni profile
        </a>
    <?php } ?>
    <a role="button" href=<?php echo "/thesis/users/edit?id=" . $_SESSION["user_id"]; ?> class="btn btn-sm btn-outline-dark">
        <i class="fas fa-pen"></i> Edit
    </a>
</div>