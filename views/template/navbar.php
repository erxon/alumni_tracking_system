<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">LYFJSHS - Alumni Tracking System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="/thesis/home">Home</a></li>
                <?php if (empty($_SESSION["username"])) { ?>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="login">Login</a></li>
                <?php } else { ?>
                    <li class="nav-item"><a class="nav-link" href="/thesis/user/index">Profile</a></li>
                    <?php if ($_SESSION["type"] == "admin") { ?>
                        <li class="nav-item"><a class="nav-link" href="/thesis/users">Users</a></li>
                    <?php } ?>
                    <?php if ($_SESSION["type"] == "admin") { ?>
                        <li class="nav-item"><a class="nav-link" href="/thesis/alumni/index">Alumni</a></li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>