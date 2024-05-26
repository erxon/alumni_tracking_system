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
        case "/thesis/users/server?" . $parse_url["query"]:
            require __DIR__ . "/views/users/server.php";
            break;
        case "/thesis/alumni?" . $parse_url["query"]:
            require __DIR__ . "/views/alumni/alumni.php";
            break;
        case "/thesis/alumni/edit?" . $parse_url["query"]:
            require __DIR__ . "/views/alumni/alumni_edit.php";
            break;
        case "/thesis/alumni/edit/presentstatus?" . $parse_url["query"]:
            require __DIR__ . "/views/alumni/alumni_edit/present_status/index.php";
            break;
        case "/thesis/alumni/edit/curriculumexit?" . $parse_url["query"]:
            require __DIR__ . "/views/alumni/alumni_edit/curriculum_exit/index.php";
            break;
        case "/thesis/photo?" . $parse_url["query"]:
            require __DIR__ . "/views/photo/photo.php";
            break;
        case "/thesis/contents/events?" . $parse_url["query"]:
            require __DIR__ . "/views/contents/events/view.php";
            break;
        case "/thesis/contents/news?" . $parse_url["query"]:
            require __DIR__ . "/views/contents/news/view.php";
            break;
        case "/thesis/contents/events/edit?" . $parse_url["query"]:
            require __DIR__ . "/views/contents/events/edit.php";
            break;
        case "/thesis/contents/news/edit?" . $parse_url["query"]:
            require __DIR__ . "/views/contents/news/edit.php";
            break;
        case "/thesis/contents/surveys?" . $parse_url["query"]:
            require __DIR__ . "/views/contents/surveys/view/view.php";
            break;
        case "/thesis/contents/surveys/edit?" . $parse_url["query"]:
            require __DIR__ . "/views/contents/surveys/edit.php";
            break;
        case "/thesis/contents/gallery/edit?" . $parse_url["query"]:
            require __DIR__ . "/views/contents/gallery/edit/edit.php";
            break;
        case "/thesis/contents/home/edit/survey?" . $parse_url["query"]:
            require __DIR__ . "/views/home/contents_edit_survey.php";
            break;
        case "/thesis/contents/gallery?" . $parse_url["query"]:
            require __DIR__ . "/views/contents/gallery/view/view.php";
            break;
        case "/thesis/contents/gallery/imageupload?" . $parse_url["query"]:
            require __DIR__ . "/views/contents/gallery/image/upload.php";
            break;
        case "/thesis/surveys/answers?" . $parse_url["query"]:
            require __DIR__ . "/views/contents/surveys/surveys_answers/survey_answers.php";
            break;
        case "/thesis/admin/alumni?" . $parse_url["query"]:
            require __DIR__ . "/views/admin/alumni.php";
            break;
        case "/thesis/admin/alumni/userid?" . $parse_url["query"]:
            require __DIR__ . "/views/alumni/alumni_by_userid.php";
            break;
        case "/thesis/alumni/index?" . $parse_url["query"]:
            require __DIR__ . "/views/alumni/index.php";
            break;
        case "/thesis/contents/server/survey?" . $parse_url["query"]:
            require __DIR__ . "/views/contents/surveys/server.php";
            break;
        case "/thesis/admin/survey?" . $parse_url["query"]:
            require __DIR__ . "/views/admin/reports/survey/data.php";
            break;
        case "/thesis/admin/survey/print?" . $parse_url["query"]:
            require __DIR__ . "/views/admin/reports/survey/print.php";
            break;
        case "/thesis/admin/home/layout/server?" . $parse_url["query"]:
            require __DIR__ . "/views/admin/home_layout/server.php";
            break;
        case "/thesis/users/index?" . $parse_url["query"]:
            require __DIR__ . "/views/users/index.php";
            break;
        case "/thesis/contents/events/all?" . $parse_url["query"]:
            require __DIR__ . "/views/contents/events/events.php";
            break;
        case "/thesis/contents/news/all?" . $parse_url["query"]:
            require __DIR__ . "/views/contents/news/news.php";
            break;
        case "/thesis/contents/surveys/all?" . $parse_url["query"]:
            require __DIR__ . "/views/contents/surveys/surveys.php";
            break;
        case "/thesis/contents/gallery/all?" . $parse_url["query"]:
            require __DIR__ . "/views/contents/gallery/galleries.php";
            break;
        case "/thesis/google_login_callback?" . $parse_url["query"]:
            require __DIR__ . "/views/google_login_callback.php";
            break;
        case "/thesis/admin/alumni/regform/server?" . $parse_url["query"]:
            require __DIR__ . "/views/admin/alumni_regform/server.php";
            break;
        case "/thesis/alumni/profile?" . $parse_url["query"]:
            require __DIR__ . "/views/alumni/alumni_profile.php";
            break;
        case "/thesis/admin/alumni/print?" . $parse_url["query"]:
            require __DIR__ . "/views/alumni/alumni_profile_print.php";
            break;
        case "/thesis/home?" . $parse_url["query"]:
            require __DIR__ . "/views/home/home.php";
            break;
        case "/thesis/admin/alumnitrends?" . $parse_url["query"]:
            require __DIR__ . "/views/home/dashboard/alumni_trends.php";
            break;
        case "/thesis/email?" . $parse_url["query"]:
            require __DIR__ . "/views/alumni/send_email.php";
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
    case '/thesis/users/server':
        require __DIR__ . "/views/users/server.php";
        break;
    case "/thesis/alumni":
        require __DIR__ . "/views/alumni/registration/index.php";
        break;
    case "/thesis/admin/email":
        require __DIR__ . "/views/admin/send_email/form.php";
        break;
    case "/thesis/alumni/profile":
        require __DIR__ . "/views/alumni/alumni_profile.php";
        break;
    case "/thesis/alumni/index":
        require __DIR__ . "/views/alumni/index.php";
        break;
    case "/thesis/alumni/create":
        require __DIR__ . "/views/alumni/registration/server.php";
        break;
    case "/thesis/alumni/server":
        require __DIR__ . "/views/alumni/server.php";
        break;
    case "/thesis/alumni/pending":
        require __DIR__ . "/views/home/pending_alumni.php";
        break;
    case "/thesis/search/alumni":
        require __DIR__ . "/views/alumni/search/index.php";
        break;
    case "/thesis/alumni/edit/server":
        require __DIR__ . "/views/alumni/alumni_edit/server.php";
        break;
    case "/thesis/search/server/alumni":
        require __DIR__ . "/views/alumni/search/server.php";
        break;
    case "/thesis/contents/index":
        require __DIR__ . "/views/contents/index/index.php";
        break;
    case "/thesis/contents/events/all":
        require __DIR__ . "/views/contents/events/events.php";
        break;
    case "/thesis/contents/news/all":
        require __DIR__ . "/views/contents/news/news.php";
        break;
    case "/thesis/contents/news":
        require __DIR__ . "/views/contents/news/create.php";
        break;
    case "/thesis/contents/news/server":
        require __DIR__ . "/views/contents/news/server.php";
        break;
    case "/thesis/contents/events":
        require __DIR__ . "/views/contents/events/create.php";
        break;
    case "/thesis/contents/events/server":
        require __DIR__ . "/views/contents/events/server.php";
        break;
    case "/thesis/contents/surveys":
        require __DIR__ . "/views/contents/surveys/create.php";
        break;
    case "/thesis/contents/survey/server":
        require __DIR__ . "/views/contents/surveys/server.php";
        break;
    case "/thesis/contents/surveys/submit":
        require __DIR__ . "/views/contents/surveys/surveys_form_submit.php";
        break;
    case "/thesis/contents/surveys/edit/submit":
        require __DIR__ . "/views/contents/surveys/surveys_edit_submit.php";
        break;
    case "/thesis/contents/surveys/all":
        require __DIR__ . "/views/contents/surveys/surveys.php";
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
        require __DIR__ . "/views/contents/gallery/create/create.php";
        break;
    case "/thesis/contents/server/gallery":
        require __DIR__ . "/views/contents/gallery/server.php";
        break;
    case "/thesis/contents/gallery/all":
        require __DIR__ . "/views/contents/gallery/galleries.php";
        break;
    case "/thesis/contents/gallery/imageupload":
        require __DIR__ . "/views/contents/gallery/gallery_image_upload.php";
        break;
    case "/thesis/email":
        require __DIR__ . "/views/alumni/send_email.php";
        break;
    case "/thesis/content/update":
        require __DIR__ . "/views/contents/send_email/send_email_server.php";
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
        require __DIR__ . "/views/admin/reports/tracer/tracer.php";
        break;
    case "/thesis/admin/reports/print":
        require __DIR__ . "/views/admin/reports/reports_print.php";
        break;
    case "/thesis/admin/reports/tracer":
        require __DIR__ . "/views/admin/reports/tracer/tracer.php";
        break;
    case "/thesis/admin/reports/filter":
        require __DIR__ . "/views/admin/reports/reports_filter.php";
        break;
    case "/thesis/admin/reports/survey":
        require __DIR__ . "/views/admin/reports/survey/survey.php";
        break;
    case "/thesis/admin/reports/summary":
        require __DIR__ . "/views/admin/reports/alumni_summary_report.php";
        break;
    case "/thesis/admin/user/search":
        require __DIR__ . "/views/users/search_user.php";
        break;
    case "/thesis/admin/home/layout":
        require __DIR__ . "/views/admin/home_layout/index.php";
        break;
    case "/thesis/admin/alumni/regform":
        require __DIR__ . "/views/admin/alumni_regform/index.php";
        break;
    case "/thesis/admin/alumni/regform/server":
        require __DIR__ . "/views/admin/alumni_regform/server.php";
        break;
    case "/thesis/records/print":
        require __DIR__ . "/views/admin/reports/reports_alumni_print.php";
        break;
    case "/thesis/registration/success":
        require __DIR__ . "/views/alumni/success.php";
        break;
    case "/thesis/google_login":
        require __DIR__ . "/views/google_login.php";
        break;
    case "/thesis/google_login_callback";
        require __DIR__ . "/views/google_login_callback.php";
        break;
    case "/thesis/google_logout":
        require __DIR__ . "/views/google_logout.php";
        break;
    case "/thesis/error":
        require __DIR__ . "/views/error.php";
        break;
    case "/thesis/loginerror":
        require __DIR__ . "/views/loginerror.php";
        break;
    case "/thesis/admin/alumnitrends":
        require __DIR__ . "/views/home/dashboard/alumni_trends.php";
        break;
    case "/thesis/admin/home/layout/server":
        require __DIR__ . "/views/admin/home_layout/server.php";
        break;
}
