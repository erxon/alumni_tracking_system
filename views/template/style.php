<style>
    body {
        font-family: Poppins, sans-serif;
        background-color: #f7f7f7;
    }

    .main-body-padding {
        padding: 2% 5%;
    }

    .navbar {
        padding: 2% 5%;
    }

    .nav-item {
        margin-right: 2rem;
    }

    .introduction {
        background-color: black;
    }

    .carousel {
        opacity: 25%;
    }

    .title {
        color: white;
        font-family: Poppins, sans-serif;
        font-size: 20px;
        font-weight: bold;
        padding-top: 15px;
        margin-left: 30px;
    }

    .intro {
        background-color: white;
    }

    .logo {
        color: white;
        font-family: Poppins, sans-serif;
        font-size: 20px;
        font-weight: bold;
        padding-top: 15px;
        margin-left: 50px;
    }

    .reg-container {
        position: absolute;
        z-index: 2;
        margin: 15% 5%;
    }

    .reg-start {
        width: 50%;
        border: none;
        border-radius: 10px;
        color: white;
    }

    .system-name {
        color: #F4CE14;
    }

    .reg-start p {
        letter-spacing: 1px;
        font-weight: 300;
        font-size: 18px;
        color: #EAEAEA;
    }

    .register-now {
        --bs-btn-bg: #F4CE14;
        --bs-btn-border-color: none;
        --bs-btn-hover-bg: #D6B511;
    }

    .alumni-registration-form {
        width: 50%;
    }

    @media (max-width: 768px) {
        .alumni-registration-form {
            width: 75%;
        }
    }

    @media (max-width: 425px) {
        .alumni-registration-form {
            width: 100%;
        }
    }

    <?php
    /**************Login**********************/
    ?>.login-form {
        max-width: 300px;
        margin: auto;
    }

    .username:focus {
        z-index: 1;
        position: relative;
    }

    .form-floating {
        position: relative;
    }

    .username {
        padding: 1rem 0.75rem;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
        margin-bottom: -1px;
    }

    .password {
        padding: 1rem 0.75rem;
        border-radius: 0 0 10px 10px;
    }

    <?php
    /**************Dashboard**********************/
    ?>.dashboard {
        padding: 2% 5%;
    }

    .type {
        font-weight: 600;
        font-size: 14px;
        display: inline;
    }

    .logout {

        display: inline;
    }

    .logout input {
        text-decoration: none;
        padding: 0;
        font-size: 14px;
    }

    <?php
    /**************Users**********************/
    ?>.users {
        padding: 2% 5%;
    }

    .users .fa-trash {
        color: #ADADAD;
    }

    .add-user-form .user-type {
        display: flex;
    }

    .radio {
        margin-right: 10px;
    }

    <?php
    /**************Users**********************/
    ?>.user {
        margin: 2% 5%;
        width: 25%;
        margin: auto;
    }

    .user .profile-photo {
        background-color: #999999;
        width: 120px;
        height: 120px;
        border-radius: 100%;
    }

    .user .information {
        margin-bottom: 1rem;
        border-bottom: 1px solid #999999;
    }

    .user .information .label {
        font-size: 14px;
        color: #999999;
    }

    .user .information .value {
        margin-bottom: 0.50rem;
    }

    .edit-user {
        margin: 1rem 0.75rem;
        max-width: 450px;
    }

    .delete-user {
        border-radius: 10px;
        padding: 20px;
        background-color: #D6D6D6;
    }

    .users-table {
        height: 450px;
        overflow-y: scroll;
    }

    <?php
    /**************Alumni Profile**********************/
    ?>.label {
        color: #737373;
        font-size: 14px;
    }

    .alumni-information {
        border: 0.5px solid #dedede;
        border-radius: 10px;
    }

    .alumni-profile {
        background-color: #FFF;
        border-radius: 10px;
    }

    .photo-container {
        background-color: #d6d6d6;
        width: 150px;
        height: 150px;
        border-radius: 100%;
        margin: auto;
    }

    .profile-photo {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 100%;
        display: block;
        margin: auto;
        margin-bottom: 10px;
    }

    .avatar {
        width: 56px;
        height: 56px;
        object-fit: cover;
        border-radius: 100%;
    }

    <?php //Contents 
    ?>.content-form {
        width: 70%;
        margin: auto;
    }

    .content-form-divider {
        border: 0.5px solid #dedede;
        border-radius: 10px;
    }

    .content-body {
        resize: none;
        height: 200px;
        overflow-y: scroll;
    }
</style>