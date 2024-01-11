<?php
session_start();
include("/xampp/htdocs/thesis/views/template/header.php");
?>

<div style class="main-body-padding content-form">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/thesis/contents">Contents</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add News</li>
        </ol>
    </nav>
    <h3>Add News</h3>
    <form style="border-radius: 10px;" id="news-form" class="mt-3 bg-white p-3" novalidate enctype="multipart/form-data">
        <div class="mb-3">
            <!----------------Image Upload-------------------->
            <input id="cover-image" name="coverImage" type="file" class="form-control" />
        </div>
        <div class="mb-5">
            <!--Title & Body-->
            <input name="title" class="form-control mb-2" placeholder="Event name" required />
            <textarea id="content-body" name="body" placeholder="Content" required></textarea>
        </div>
        <button type="submit" class="btn btn-dark">Save</button>
        <button class="btn btn-outline-secondary">Discard</button>
    </form>
</div>

<?php
include("/xampp/htdocs/thesis/views/template/footer.php")
?>