<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">LYFJSHS - Alumni Tracking System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav align-items-center ms-auto mb-2 mb-lg-0">
                <?php if (empty($_SESSION["username"])) { ?>

                    <li class="nav-item"><a class="nav-link" href="/thesis/home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    <li class="nav-item"><a role="button" class="btn btn-outline-dark" href="login">
                            <i class="fas fa-sign-in-alt me-1"></i> Login</a>
                    </li>
                <?php } else { ?>
                    <?php if ($_SESSION["type"] == "admin") { ?>
                        <li class="nav-item">
                            <p class="me-3 mb-0">Hello, <?php echo $_SESSION["first_name"] . " " . $_SESSION["last_name"]; ?></p>
                        </li>
                        <li class="nav-item">
                            <button class="btn btn-light"><i class="fas fa-sign-out-alt"></i></button>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item"><a class="nav-link" href="/thesis/home">News / Announcements / Events</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Gallery</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Survey</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Search Alumni</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Profile
                            </a>
                            <ul style="font-size: 14px;" class="dropdown-menu">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-user-alt"></i> Profile</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-cog"></i> Account Setting</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                            </ul>
                        </li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>