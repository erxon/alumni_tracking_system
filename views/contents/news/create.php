<?php
session_start();

if (!isset($_SESSION["type"]) || $_SESSION["type"] != "admin") {
    header("Location: /thesis/");
    return;
}

include("/xampp/htdocs/thesis/views/template/header.php");
?>

<div style="margin-top: 5%" class="main-body-padding content-form">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/thesis/contents/news/all?page=1">News</a></li>
            <li class="breadcrumb-item" aria-current="page">Add News</li>
        </ol>
    </nav>
    <h3>Add News</h3>
    <form style="border-radius: 10px;" id="news-form" class="mt-3 bg-white p-3" novalidate enctype="multipart/form-data">
        <div class="mb-3">
            <!----------------Image Upload-------------------->
            <input id="cover-image" name="coverImage" type="file" accept="image/png, image/jpeg, image/jpg" class="form-control" required />
        </div>
        <div class="mb-5">
            <!--Title & Body-->
            <input name="title" class="form-control mb-2" placeholder="News title" required />
            <textarea name="description" placeholder="Description" class="form-control mb-2" required></textarea>
            <textarea id="content-body" name="body" placeholder="Content" required></textarea>
        </div>
        <button type="submit" class="btn btn-dark">Save</button>
        <button class="btn btn-outline-secondary">Discard</button>
    </form>
</div>
<?php
include "script.php";
include("/xampp/htdocs/thesis/views/template/footer.php")
?>