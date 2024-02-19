<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: /thesis/login");
    }
}

?>
<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand text-light" href="/thesis">LYFJSHS - Alumni Tracking System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav align-items-center ms-auto mb-2 mb-lg-0">
                <?php if (empty($_SESSION["username"])) { ?>

                    <li class="nav-item"><a class="nav-link" href="/thesis/home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    <li class="nav-item"><a role="button" class="btn btn-outline-light" href="login">
                            <i class="fas fa-sign-in-alt me-1"></i> Login</a>
                    </li>
                <?php } else { ?>
                    <?php if ($_SESSION["type"] == "admin") { ?>
                        <li class="nav-item text-light">
                            <p class="me-3 mb-0">Hello, <?php echo $_SESSION["first_name"] . " " . $_SESSION["last_name"]; ?></p>
                        </li>
                        <li class="nav-item">
                            <form method="post">
                                <button name="logout" value="." class="btn btn-light"><i class="fas fa-sign-out-alt"></i></button>
                            </form>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item"><a class="nav-link" href="/thesis/home">News / Announcements / Events</a></li>
                        <li class="nav-item"><a class="nav-link" href="/thesis/contents/gallery/all">Gallery</a></li>
                        <li class="nav-item"><a class="nav-link" href="/thesis/surveys/answers">Survey</a></li>
                        <li class="nav-item"><a class="nav-link" href="/thesis/alumni/index">Search Alumni</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Profile
                            </a>
                            <ul style="font-size: 14px;" class="dropdown-menu">
                                <li><a class="dropdown-item" href="/thesis/user/index"><i class="fas fa-user-alt"></i> Profile</a></li>
                                <li><a class="dropdown-item" href="/thesis/users/edit?id=<?php echo $_SESSION["user_id"]; ?>"><i class="fas fa-cog"></i> Account Setting</a></li>
                                <li>
                                    <form method="post">
                                        <button role="button" name="logout" value="." type="submit" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>