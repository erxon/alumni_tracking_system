<?php
session_start();
include("/xampp/htdocs/thesis/views/template/header.php")
?>

<div class="main-body-padding content-form">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/thesis/contents">Contents</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Event</li>
        </ol>
    </nav>
    <h3>Add Event</h3>

    <form id="events-form" class="mt-3" novalidate>
        <div class="d-flex mb-3">
            <!----------------Start Time------------------>
            <div class="flex-fill content-form-divider me-2 p-3">
                <p class="mb-3">Start Time</p>
                <div class="d-flex">
                    <div class="flex-fill me-2">
                        <input id="start-date" class="form-control" type="date" required />
                        <label class="label" for="start-date">Date</label>
                    </div>
                    <div class="flex-fill">
                        <input id="start-time" class="form-control" type="time" required />
                        <label class="label" for="start-time">Time</label>
                    </div>
                </div>
            </div>
            <!----------------End Time-------------------->
            <div class="flex-fill content-form-divider me-2 p-3">
                <p class="mb-3">End Time</p>
                <div class="d-flex">
                    <div class="flex-fill me-2">
                        <input id="end-date" class="form-control me-2" type="date" />
                        <label class="label" for="end-date">Date</label>
                    </div>
                    <div class="flex-fill">
                        <input id="end-time" class="form-control" type="time" />
                        <label class="label" for="end-time">Time</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <!----------------Image Upload-------------------->
            <input type="file" class="form-control" />
        </div>
        <div class="mb-5">
            <!--Title & Body-->
            <input class="form-control mb-2" placeholder="Title" required/>
            <textarea class="form-control content-body" placeholder="Content" required></textarea>
        </div>
        <button type="submit" class="btn btn-dark">Save</button>
        <button class="btn btn-outline-secondary">Discard</button>
    </form>
</div>

<?php
include("/xampp/htdocs/thesis/views/template/footer.php")
?>