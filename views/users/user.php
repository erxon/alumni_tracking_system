<?php include("/xampp/htdocs/thesis/views/template/header.php") ?>

<?php
require("/xampp/htdocs/thesis/models/Users.php");

$users = new Users();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_URL);

    $result = $users->getUser($id);

    if (isset($result)) {
        $rows = $result->fetch_assoc(); ?>
        <div class="user">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/thesis/users">Users</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $rows["username"]; ?></li>
                </ol>
            </nav>

            <?php
            if (isset($rows["photo"])) {
                $file = $rows["photo"];
                echo "<img class='profile-photo' src='/thesis/public/images/profile/$file' />";
            } else {
                echo "<div class='photo-container mb-3'></div>";
            }
            ?>
            <div class="information">
                <p class="m-0 label">Username</p>
                <p class="value"><?php echo $rows["username"] ?></p>
            </div>
            <div class="information">
                <p class="m-0 label">First Name</p>
                <p class="value"><?php echo $rows["firstName"] ?></p>
            </div>
            <div class="information">
                <p class="m-0 label">Last Name</p>
                <p class="value"><?php echo $rows["lastName"] ?></p>
            </div>
            <div class="information">
                <p class="m-0 label">Email</p>
                <p class="value"><?php echo $rows["email"] ?></p>
            </div>
            <div class="information">
                <p class="m-0 label">Type</p>
                <p class="value"><?php echo $rows["type"] ?></p>
            </div>
            <a role="button" href=<?php echo "/thesis/users/edit?id=" . $id; ?> class="btn btn-sm btn-outline-dark">
                <i class="fas fa-pen"></i> Edit
            </a>
        </div>
    <?php } ?>
<?php } ?>


<?php include("/xampp/htdocs/thesis/views/template/footer.php"); ?>