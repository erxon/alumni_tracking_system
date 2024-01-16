<?php

$url = $_SERVER['REQUEST_URI'];
$parse_url = parse_url($url);

if (isset($parse_url["query"])) {
    switch ($url) {
        case '/thesis/users?' . $parse_url["query"]:
            require __DIR__ . "/views/users/user.php";
            break;
        case '/thesis/users/edit?' . $parse_url["query"]:
            require __DIR__ . "/views/users/edit_user.php";
            break;
        case "/thesis/alumni?" . $parse_url["query"]:
            require __DIR__ . "/views/alumni/alumni.php";
            break;
        case "/thesis/alumni/edit?" . $parse_url["query"]:
            require __DIR__ . "/views/alumni/alumni_edit.php";
            break;
        case "/thesis/photo?" . $parse_url["query"]:
            require __DIR__ . "/views/photo/photo.php";
            break;
        case "/thesis/contents/events?" . $parse_url["query"]:
            require __DIR__ . "/views/contents/events/event_details.php";
            break;
        case "/thesis/contents/news?" . $parse_url["query"]:
            require __DIR__ . "/views/contents/news/news_details.php";
            break;
        case "/thesis/contents/events/edit?" . $parse_url["query"]:
            require __DIR__ . "/views/contents/events/event_edit.php";
            break;
        case "/thesis/contents/news/edit?" . $parse_url["query"]:
            require __DIR__ . "/views/contents/news/news_edit.php";
            break;
        case "/thesis/contents/surveys?" . $parse_url["query"]:
            require __DIR__ . "/views/contents/surveys/surveys_details.php";
            break;
        case "/thesis/contents/surveys/edit?" . $parse_url["query"]:
            require __DIR__ . "/views/contents/surveys/surveys_edit.php";
            break;
        case "/thesis/contents/home/edit/survey?" . $parse_url["query"]:
            require __DIR__ . "/views/home/contents_edit_survey.php";
            break;
    }
    die();
}

switch ($url) {
    case "/thesis/home":
    case "/thesis/":
        require __DIR__ . "/views/home/home.php";
        break;
    case "/thesis/login":
        require __DIR__ . "/views/login.php";
        break;
    case "/thesis/users":
        require __DIR__ . "/views/users/index.php";
        break;
    case '/thesis/user/index':
        require __DIR__ . "/views/user/index.php";
        break;
    case '/thesis/user/edit':
        require __DIR__ . "/views/user/edit.php";
        break;
    case '/thesis/user/edit/basic-information':
        require __DIR__ . "/views/users/edit_user/basic_information_edit.php";
        break;
    case '/thesis/user/edit/change-password':
        require __DIR__ . "/views/users/edit_user/change_password_server.php";
        break;
    case "/thesis/alumni":
        require __DIR__ . "/views/alumni/alumni_registration.php";
        break;
    case "/thesis/alumni/profile":
        require __DIR__ . "/views/alumni/alumni_profile.php";
        break;
    case "/thesis/alumni/index":
        require __DIR__ . "/views/alumni/index.php";
        break;
    case "/thesis/alumni/create":
        require __DIR__ . "/views/alumni/alumni_registration_server.php";
        break;
    case "/thesis/contents":
        require __DIR__ . "/views/contents/index.php";
        break;
    case "/thesis/contents/events/all":
        require __DIR__ . "/views/contents/events/event_list.php";
        break;
    case "/thesis/contents/news/all":
        require __DIR__ . "/views/contents/news/news_list.php";
        break;
    case "/thesis/contents/news":
        require __DIR__ . "/views/contents/news/news_form.php";
        break;
    case "/thesis/contents/news/submit":
        require __DIR__ . "/views/contents/news/news_form_submit.php";
        break;
    case "/thesis/contents/events":
        require __DIR__ . "/views/contents/events/event_form.php";
        break;
    case "/thesis/contents/events/submit":
        require __DIR__ . "/views/contents/events/event_form_submit.php";
        break;
    case "/thesis/contents/events/edit":
        require __DIR__ . "/views/contents/events/event_edit_submit.php";
        break;
    case "/thesis/contents/news/edit":
        require __DIR__ . "/views/contents/news/news_edit_submit.php";
        break;
    case "/thesis/contents/surveys":
        require __DIR__ . "/views/contents/surveys/surveys_form.php";
        break;
    case "/thesis/contents/surveys/submit":
        require __DIR__ . "/views/contents/surveys/surveys_form_submit.php";
        break;
    case "/thesis/contents/surveys/edit/submit":
        require __DIR__ . "/views/contents/surveys/surveys_edit_submit.php";
        break;
    case "/thesis/contents/surveys/all":
        require __DIR__ . "/views/contents/surveys/surveys_list.php";
        break;
    case "/thesis/contents/edit":
        require __DIR__ . "/views/home/contents_edit.php";
        break;
    case "/thesis/contents/survey/answer":
        require __DIR__ . "/views/home/survey_answer.php";
        break;
    default:
        require __DIR__ . "/views/error.php";
        break;
}
