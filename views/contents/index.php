<?php
session_start();
include("/xampp/htdocs/thesis/views/template/header.php")
?>

<div class="main-body-padding">
    <h2 class="mb-3">Contents</h2>
    <div class="d-flex">
        <div class="me-3">
            <select class="form-select">
                <option selected>All</option>
                <option value="events">Events</option>
                <option value="news">News</option>
                <option value="surveys">Surveys</option>
            </select>
        </div>
        <div class="dropdown">
            <a class="btn btn-dark dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-plus"></i> Add Content
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item" href="/thesis/contents/events">
                        <i class="far fa-calendar me-2"></i>Event
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="/thesis/contents/news">
                        <i class="far fa-newspaper me-2"></i>News
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="/thesis/contents/survey">
                        <i class="fas fa-question me-2"></i>Survey
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<?php
include("/xampp/htdocs/thesis/views/template/footer.php")
?>