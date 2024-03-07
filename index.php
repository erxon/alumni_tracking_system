<?php

$url = $_SERVER['REQUEST_URI'];
$parse_url = parse_url($url);

if (isset($parse_url["query"])) {
    switch ($url) {
        case "/thesis/searchname?" . $parse_url["query"];
            require __DIR__ . "/views/alumni/search_name.php";
            break;
        case '/thesis/users?' . $parse_url["query"]:
            require __DIR__ . "/views/users/user.php";
            break;
        case "/thesis/users/edit?" . $parse_url["query"]:
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
        case "/thesis/contents/gallery?" . $parse_url["query"]:
            require __DIR__ . "/views/contents/gallery/gallery_details.php";
            break;
        case "/thesis/contents/gallery/imageupload?" . $parse_url["query"]:
            require __DIR__ . "/views/contents/gallery/gallery_form.php";
            break;
        case "/thesis/surveys/answers?" . $parse_url["query"]:
            require __DIR__ . "/views/contents/surveys/surveys_answers/survey_answers.php";
            break;
        case "/thesis/admin/alumni?" . $parse_url["query"]:
            require __DIR__ . "/views/admin/alumni.php";
            break;
        case "/thesis/alumni/index?" . $parse_url["query"]:
            require __DIR__ . "/views/alumni/index.php";
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
    case '/thesis/user/edit/change-photo':
        require __DIR__ . "/views/users/edit_user/change_photo_server.php";
        break;
    case "/thesis/alumni":
        require __DIR__ . "/views/alumni/alumni_registration.php";
        break;
    case "/thesis/admin/email":
        require __DIR__ . "/views/admin/send_email.php";
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
    case "/thesis/surveys/answers":
        require __DIR__ . "/views/contents/surveys/surveys_answers/surveys.php";
        break;
    case "/thesis/contents/edit":
        require __DIR__ . "/views/home/contents_edit.php";
        break;
    case "/thesis/contents/survey/answer":
        require __DIR__ . "/views/home/survey_answer.php";
        break;
    case "/thesis/contents/gallery":
        require __DIR__ . "/views/contents/gallery/gallery_form.php";
        break;
    case "/thesis/contents/gallery/all":
        require __DIR__ . "/views/contents/gallery/gallery_list.php";
        break;
    case "/thesis/contents/gallery/imageupload":
        require __DIR__ . "/views/contents/gallery/gallery_image_upload.php";
        break;
    case "/thesis/email":
        require __DIR__ . "/views/alumni/send_email.php";
        break;
    case "/thesis/register":
        require __DIR__ . "/views/register.php";
        break;
    case "/thesis/alumni/search":
        require __DIR__ . "/views/alumni/alumni_search.php";
        break;
    case "/thesis/admin/registration":
        require __DIR__ . "/views/admin/registration_status.php";
        break;
    case "/thesis/admin/reports":
        require __DIR__ . "/views/admin/reports/reports_alumni.php";
        break;
    case "/thesis/admin/reports/print":
        require __DIR__ . "/views/admin/reports/reports_print.php";
        break;
    case "/thesis/admin/reports/tracer":
        require __DIR__ . "/views/admin/reports/reports_tracer.php";
        break;
    case "/thesis/admin/reports/filter":
        require __DIR__ . "/views/admin/reports/reports_filter.php";
        break;
    case "/thesis/admin/reports/survey":
        require __DIR__ . "/views/admin/reports/reports_survey.php";
        break;
    case "/thesis/admin/user/search":
        require __DIR__ . "/views/users/search_user.php";
        break;
    default:
        require __DIR__ . "/views/error.php";
        break;
}
