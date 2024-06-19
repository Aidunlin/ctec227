<?php
require_once "inc/functions.inc.php";
$page_title ??= "Home";
$current_link = basename($_SERVER["PHP_SELF"]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?> - Assignment 3</title>
    <link href="bootstrap/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/bootstrap.bundle.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-body-secondary">
        <div class="container-xxl px-3 px-sm-5">
            <h1 class="d-none">Assignment 3</h1>
            <?php display_nav_link("home.php", "Assignment 3", $current_link, "navbar-brand"); ?>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 ms-auto mb-sm-0">
                    <?php
                    if (isset($_SESSION["user_id"])) {
                        display_nav_link_li("logout.php", "Logout", $current_link);
                    } else {
                        display_nav_link_li("register.php", "Register", $current_link);
                        display_nav_link_li("login.php", "Login", $current_link);
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-xxl p-3 p-sm-5">
        <h2><?= $page_title ?></h2>