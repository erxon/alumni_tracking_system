<?php

$url = $_SERVER["REQUEST_URI"];

function addActiveClass($url, $href, $class)
{
    if (str_contains($url, $href)) {
        if ($class == "nav-item") {
            echo "contents-side-nav-active";
        } else if ($class == "nav-link") {
            echo "text-white";
        }
    }
}

?>
<div>
    <ul class="nav flex-column contents-side-nav">
        <li class="nav-item <?php addActiveClass($url, "/thesis/contents/index", "nav-item") ?>">
            <a class="nav-link <?php addActiveClass($url, "/thesis/contents/index", "nav-link"); ?>" href="/thesis/contents/index">
                <i class="far fa-calendar me-2"></i>All
            </a>
        </li>
        <li class="nav-item <?php addActiveClass($url, "/thesis/contents/events/all?page", "nav-item") ?>">
            <a class="nav-link <?php addActiveClass($url, "/thesis/contents/events/all?page", "nav-link") ?>" href="/thesis/contents/events/all?page=1">
                <i class="far fa-calendar me-2"></i>Event
            </a>
        </li>
        <li class="nav-item <?php addActiveClass($url, "/thesis/contents/news/all", "nav-item") ?>">
            <a class="nav-link <?php addActiveClass($url, "/thesis/contents/news/all", "nav-link") ?>" href="/thesis/contents/news/all?page=1">
                <i class="far fa-newspaper me-2"></i>News
            </a>
        </li>
        <li class="nav-item <?php addActiveClass($url, "/thesis/contents/surveys/all", "nav-item") ?>">
            <a class="nav-link <?php addActiveClass($url, "/thesis/contents/surveys/all", "nav-link") ?>" href="/thesis/contents/surveys/all?page=1">
                <i class="fas fa-question me-2"></i>Survey
            </a>
        </li>
        <li class="nav-item <?php addActiveClass($url, "/thesis/contents/gallery/all", "nav-item") ?>">
            <a class="nav-link <?php addActiveClass($url, "/thesis/contents/gallery/all", "nav-link") ?>" href="/thesis/contents/gallery/all?page=1">
                <i class="far fa-images me-2"></i>Gallery
            </a>
        </li>
    </ul>
</div>