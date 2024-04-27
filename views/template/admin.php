<?php
$url = $_SERVER['REQUEST_URI'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_FILES["profile-photo"]["name"] != "") {
        if (isset($_SESSION["photo"])) {
            $photo = $_SESSION["photo"];
            unlink("/xampp/htdocs/thesis/public/images/profile/$photo");
        }

        $str = rand();
        $uniqueFilename = md5($str);

        $tempname = $_FILES["profile-photo"]["tmp_name"];
        $target_file = "./public/images/profile/" . basename($_FILES["profile-photo"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $profilePhoto = $uniqueFilename . '.' . $imageFileType;
        $folder = "./public/images/profile/" . $profilePhoto;

        move_uploaded_file($tempname, $folder);

        $db = new Database();
        $currentUser = $_SESSION['user_id'];
        $query = "UPDATE user SET photo='$profilePhoto' WHERE id='$currentUser'";
        $update = $db->query($query);
        $db->close();

        $_SESSION["photo"] = $profilePhoto;
        header("Location: /thesis/home");
    }
}

?>
<div class="side-nav-container bg-secondary text-white">
    <div class="container m-auto side-nav-user d-flex flex-column align-items-center mb-3">
        <div style="background-color: #028fed; width: 175px; height: 200px" class="mt-3 p-3 rounded shadow mb-3">
            <div class="admin-picture-container mt-3 d-flex align-items-center">
                <?php if ($_SESSION["photo"]) { ?>
                    <img style="object-fit: cover;" src="<?php echo $_SESSION["photo"] ?>" class="admin-picture" />
                <?php } else { ?>
                    <img src="/thesis/public/assets/user.png" class="admin-picture bg-secondary p-2" />
                <?php } ?>
            </div>
            <p class="text-center m-0"><?php echo $_SESSION["first_name"] . " " . $_SESSION["last_name"]; ?></p>
            <p class="m-0 text-center fw-light" style="font-size: 14px"><?php echo $_SESSION["type"]; ?></p>
        </div>

    </div>
    <!--Navlinks-->
    <div>
        <?php if ($_SESSION["type"] == "admin") { ?>
            <nav class="nav flex-column side-nav">
                <a class="nav-link side-nav-link text-white <?php
                                                            if ($url == "/thesis/home" ||  $url == "/thesis") {
                                                                echo "active";
                                                            } ?>" aria-current="page" href="/thesis/home">
                    <i class="fas fa-home me-2"></i> Dashboard
                </a>
                <a class="nav-link side-nav-link text-white <?php
                                                            if (str_contains($url, "/thesis/admin/registration")) {
                                                                echo "active";
                                                            }
                                                            ?>" href="/thesis/admin/registration">
                    <i class="fas fa-user-check me-2"></i> Registration Status
                </a>
                <a class="nav-link side-nav-link text-white <?php
                                                            if (str_contains($url, "/thesis/contents")) {
                                                                echo "active";
                                                            } ?>" href="/thesis/contents/index">
                    <i class="fas fa-newspaper me-2"></i>Contents
                </a>
                <a class="nav-link side-nav-link text-white <?php
                                                            if (str_contains($url, "/thesis/alumni/index")) {
                                                                echo "active";
                                                            }
                                                            ?>" href="/thesis/alumni/index?page=1">
                    <i class="fas fa-folder-open me-2"></i> Records
                </a>
                <a class="nav-link side-nav-link text-white <?php
                                                            if (str_contains($url, "/thesis/admin/reports")) {
                                                                echo "active";
                                                            }
                                                            ?>" href="/thesis/admin/reports">
                    <i class="fas fa-chart-bar me-2"></i>Reports
                </a>
                <a class="nav-link side-nav-link text-white <?php
                                                            if (str_contains($url, "/thesis/admin/email")) {
                                                                echo "active";
                                                            }
                                                            ?>" href="/thesis/admin/email">
                    <i class="fas fa-envelope me-2"></i> Send email
                </a>
                <a class="nav-link side-nav-link text-white <?php
                                                            if (str_contains($url, "/thesis/users")) {
                                                                echo "active";
                                                            }
                                                            ?>" href="/thesis/users/index?page=1">
                    <i class="fas fa-users me-2"></i>Users
                </a>
                <a class="nav-link side-nav-link text-white <?php
                                                            if (str_contains($url, "/thesis/user/index")) {
                                                                echo "active";
                                                            }
                                                            ?>" href="/thesis/user/index">
                    <i class="fas fa-cogs me-2"></i>Account settings
                </a>
                <a class="nav-link side-nav-link text-white <?php
                                                            if (str_contains($url, "/thesis/admin/home/layout")) {
                                                                echo "active";
                                                            }
                                                            ?>" href="/thesis/admin/home/layout">
                    <i class="fas fa-home me-2"></i> Home Page Layout
                </a>
            </nav>
        <?php } ?>
        <?php if ($_SESSION["type"] == "teacher" || $_SESSION["type"] == "principal") { ?>
            <nav class="nav flex-column side-nav">
                <a class="nav-link side-nav-link text-white <?php
                                                            if ($url == "/thesis/home" ||  $url == "/thesis") {
                                                                echo "active";
                                                            } ?>" aria-current="page" href="/thesis/home">
                    <i class="fas fa-home me-2"></i> Dashboard
                </a>
                <a class="nav-link side-nav-link text-white <?php
                                                            if (str_contains($url, "/thesis/alumni/index")) {
                                                                echo "active";
                                                            }
                                                            ?>" href="/thesis/alumni/index?page=1">
                    <i class="fas fa-folder-open me-2"></i> Records
                </a>
                <a class="nav-link side-nav-link text-white <?php
                                                            if (str_contains($url, "/thesis/admin/reports")) {
                                                                echo "active";
                                                            }
                                                            ?>" href="/thesis/admin/reports">
                    <i class="fas fa-chart-bar me-2"></i>Reports
                </a>
                <a class="nav-link side-nav-link text-white <?php
                                                            if (str_contains($url, "/thesis/user/index")) {
                                                                echo "active";
                                                            }
                                                            ?>" href="/thesis/user/index">
                    <i class="fas fa-cogs me-2"></i>Account settings
                </a>
            </nav>
        <?php } ?>

    </div>
</div>

<form method="post" enctype="multipart/form-data">
    <div class="modal fade" id="upload-profile-picture" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Profile photo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input name="profile-photo" type="file" accept="image/jpeg, image/png" class="form-control" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>