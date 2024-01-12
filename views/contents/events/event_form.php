<?php
session_start();

if (!isset($_SESSION["type"]) || $_SESSION["type"] != "admin") {
    header("Location: /thesis/");
    return;
}

include("/xampp/htdocs/thesis/views/template/header.php");
?>

<div style class="main-body-padding content-form">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/thesis/contents">Contents</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Event</li>
        </ol>
    </nav>
    <h3>Add Event</h3>

    <form style="border-radius: 10px;" id="events-form" class="mt-3 bg-white p-3" novalidate enctype="multipart/form-data">
        <div class="d-flex mb-3">
            <!----------------Start Time------------------>
            <div class="flex-fill content-form-divider me-2 p-3">
                <p class="mb-3">Start Time</p>
                <div class="d-flex">
                    <div class="flex-fill me-2">
                        <input name="startDate" id="start-date" class="form-control" type="date" required />
                        <label class="label" for="start-date">Date</label>
                    </div>
                    <div class="flex-fill">
                        <div style="position: relative">
                            <input name="startTime" id="start-time" class="form-control" type="time" required />
                        </div>
                        <label class="label" for="start-time">Time</label>
                    </div>
                </div>
            </div>
            <!----------------End Time-------------------->
            <div class="flex-fill content-form-divider me-2 p-3">
                <p class="mb-3">End Time</p>
                <div class="d-flex">
                    <div class="flex-fill me-2">
                        <input name="endDate" id="end-date" class="form-control me-2" type="date" />
                        <label class="label" for="end-date">Date</label>
                    </div>
                    <div class="flex-fill">
                        <input name="endTime" id="end-time" class="form-control" type="time" />
                        <label class="label" for="end-time">Time</label>
                    </div>
                </div>
            </div>
        </div>
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