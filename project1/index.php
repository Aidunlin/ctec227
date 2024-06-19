<?php
session_start();
require_once "inc/app.inc.php";
require_once "inc/functions.inc.php";

if (isset($_SESSION["user_name"])) {
    $user_result = get_user($_SESSION["user_name"]);

    if (count($user_result["errors"]) > 0) {
        // Could not find the user, so send them to the logout page to destroy the active session.
        header("Location: logout.php");
        exit;
    }
}

if (isset($_GET["photo"])) {
    // Display the photo with some details.

    $photo_result = get_photo_record($_GET["photo"]);

    if (count($photo_result["errors"]) > 0) {
        header("Location: .?error=Failed to find photo to view!");
        exit;
    }

    $photo = $photo_result["data"];

    $page_title = $photo["name"];
    $active_link = ".?photo={$_GET["photo"]}";
    require_once "inc/header.inc.php";

    display_photo_with_info($photo);
    require_once "inc/footer.inc.php";

    exit;
}

// If a specific photo is not chosen, then display multiple photos.

if (isset($_GET["user"])) {
    // Display all the photos for this user.

    $user_result = get_user($_GET["user"]);

    if (count($user_result["errors"]) > 0) {
        header("Location: .?error=Failed to find user '{$_GET["user"]}'!");
        exit;
    }

    $user = $user_result["data"];

    if (isset($_SESSION["user_name"]) && $_SESSION["user_name"] == $user["user_name"]) {
        $page_title = "Your photos";
    } else {
        $page_title = "{$user["user_name"]}'s photos";
    }

    $active_link = ".?user={$user["user_name"]}";

    $photos_result = get_photos_from_user($user["user_name"]);
} else {
    // Just display all the photos.

    $photos_result = get_photos();
}

require_once "inc/header.inc.php";

$success_message = $_GET["success"] ?? "";
if (strlen($success_message)) {
    echo "<div class='alert alert-success'>$success_message</div>";
}

$error_message = $_GET["error"] ?? "";
if (strlen($error_message)) {
    echo "<div class='alert alert-danger'>$error_message</div>";
}

if (count($photos_result["errors"]) == 0) {
    display_photos($photos_result["data"], "lazy");
}

require_once "inc/footer.inc.php";
