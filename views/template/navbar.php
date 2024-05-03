<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: /thesis/login");
    }
}

$url = $_SERVER['REQUEST_URI'];
?>
<nav style="background-color: #000;" class="navbar navbar-expand-lg fixed-top navbar-dark shadow">
    <div class="container-fluid">
        <a class="navbar-brand text-light" href="/thesis">LYFJSHS - Alumni Tracking System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav align-items-center ms-auto mb-2 mb-lg-0">
                <?php if (!isset($_SESSION["email"])) { ?>
                    <li class="nav-item"><a id="home-nav" class="nav-link home-nav-link <?php if ($url == "/thesis/home") {
                        echo "text-white";
                    } ?>" href="/thesis/home">Home</a></li>
                    <li class="nav-item"><a <?php if ($url == "/thesis/login") {
                        echo "hidden";
                    } ?> id="about-nav" class="nav-link home-nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a <?php if ($url == "/thesis/login") {
                        echo "hidden";
                    } ?> id="contact-nav" class="nav-link home-nav-link" href="#contact">Contact</a></li>
                    <li class="nav-item"><a role="button" class="btn btn-outline-light" href="/thesis/login">
                            <i class="fas fa-sign-in-alt me-1"></i> Login</a>
                    </li>
                <?php } else { ?>
                    <?php if ($_SESSION["type"] == "admin" || $_SESSION["type"] == "teacher" || $_SESSION["type"] == "principal") { ?>
                        <li class="nav-item text-light">
                            <p class="me-3 mb-0">Hello,
                                <?php echo $_SESSION["first_name"] . " " . $_SESSION["last_name"]; ?>
                            </p>
                        </li>
                        <li class="nav-item">
                            <form method="post">
                                <button name="logout" value="." class="btn btn-light"><i
                                        class="fas fa-sign-out-alt"></i></button>
                            </form>
                        </li>
                    <?php } else if ($_SESSION["type"] == "alumni" && $_SESSION["status"] == "active") { ?>
                            <li class="nav-item"><a style="<?php
                            if (str_contains($url, "/thesis/home")) {
                                echo "color: #028fed";
                            }
                            ?>" class="nav-link" href="/thesis/home">Home</a></li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" style="<?php
                                if (
                                    str_contains($url, "/thesis/contents") ||
                                    str_contains($url, "/thesis/surveys")
                                ) {
                                    echo "color: #028fed";
                                }
                                ?>" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Contents
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a style="<?php
                                    if (str_contains($url, "/thesis/contents/gallery")) {
                                        echo "background-color: #028fed; border: 0px; color: #fff";
                                    }
                                    ?>" class="dropdown-item"
                                            href="/thesis/contents/gallery/all">Gallery</a></li>
                                    <li><a style="<?php
                                    if (str_contains($url, "/thesis/surveys")) {
                                        echo "background-color: #028fed; border: 0px; color: #fff";
                                    }
                                    ?>" class="dropdown-item" href="/thesis/surveys/answers">Survey</a>
                                    </li>
                                    <li><a style="<?php
                                    if (str_contains($url, "/thesis/contents/news/all")) {
                                        echo "background-color: #028fed; border: 0px; color: #fff";
                                    }
                                    ?>" class="dropdown-item" href="/thesis/contents/news/all">News</a>
                                    </li>
                                    <li><a style="<?php
                                    if (str_contains($url, "/thesis/contents/events/all")) {
                                        echo "background-color: #028fed; border: 0px; color: #fff";
                                    }
                                    ?>" class="dropdown-item" href="/thesis/contents/events/all">Events</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item"><a role="button" class="btn btn-sm btn-light" style="<?php
                            if (str_contains($url, "/thesis/search/alumni") || str_contains($url, "/thesis/search/alumni")) {
                                echo "background-color: #028fed; border: 0px; color: #fff";
                            }
                            ?>"
                                    class="nav-link" href="/thesis/search/alumni"><i class="fas fa-search"></i> Search Alumni</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a style="<?php
                                if (str_contains($url, "/thesis/user") || str_contains($url, "/thesis/users")) {
                                    echo "color: #028fed";
                                }
                                ?>" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Profile
                                </a>
                                <ul style="font-size: 14px;" class="dropdown-menu">
                                    <li><a class="dropdown-item" href="/thesis/alumni/profile"><i class="fas fa-user-alt"></i>
                                            Profile</a></li>
                                    <li><a class="dropdown-item" href="/thesis/users/edit?id=<?php echo $_SESSION["user_id"]; ?>"><i
                                                class="fas fa-cog"></i> Account Setting</a></li>
                                    <li>
                                        <form method="post">
                                            <button role="button" name="logout" value="." type="submit" class="dropdown-item">
                                                <i class="fas fa-sign-out-alt"></i> Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                    <?php } else if ($_SESSION["type"] == "alumni" && isset($_SESSION["status"]) && $_SESSION["status"] == "pending") { ?>
                        <form method="post">
                            <button role="button" name="logout" value="." type="submit" class="btn btn-dark">
                                Logout
                            </button>
                        </form></li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>