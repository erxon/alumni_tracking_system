<?php
session_start();

if (!isset($_SESSION["type"]) || $_SESSION["type"] != "admin") {
    header("Location: /thesis/");
    return;
}

include("/xampp/htdocs/thesis/views/template/header.php");
?>

<div class="main-body-padding mt-5">
    <div class="container w-50 m-auto bg-white p-3 rounded shadow">
        <div style="font-size: 14px;" class="mb-3 border-bottom">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/thesis/contents">Contents</a></li>
                <li class="breadcrumb-item"><a href="/thesis/contents/surveys/all">Surveys</a></li>
                <li class="breadcrumb-item" aria-current="page">Create</li>
            </ol>
        </div>
        <h3 class="mb-3">Create survey</h3>
        <form id="surveys-form" enctype="multipart/form-data" class="surveys-form">
            <div class="mb-3">
                <!-----Survey Body----->
                <input name="coverImage" type="file" class="form-control mb-2" />
                <input name="title" type="text" class="form-control mb-2" placeholder="Add title" />
                <p class="m-0 text-secondary mb-1 mt-3" style="font-size: 14px;">Add description here</p>
                <textarea name="description" id="content-body" class="content-body"></textarea>
            </div>
            <button class="btn btn-sm btn-dark" type="submit">Save</button>
            <a role="button" href="/thesis/contents/surveys/all" class="btn btn-sm btn-secondary">Discard</a>
        </form>
    </div>
</div>

<?php
include "script.php";
include "/xampp/htdocs/thesis/views/template/footer.php";
?>