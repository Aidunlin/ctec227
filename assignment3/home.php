<?php
session_start();
require_once "inc/app.inc.php";
require_once "inc/header.inc.php";

if (isset($_SESSION["user_id"])) {
    $result = get_user($_SESSION["user_id"]);
    $user = $result["data"];
    $errors = $result["errors"];

    if (count($errors) == 0) {
        display_logged_in_message($user);
        display_user_details($user);

        $confirm_logout = "onclick='return confirm(\"Are you sure you want to logout?\")'";
        echo "<a href='logout.php' class='btn btn-outline-secondary' $confirm_logout>Logout</a></div>";
    } else {
        // Could not find the user, so send them to the logout page to destroy the active session.
        header("Location: logout.php");
        exit;
    }
} else {
    display_logged_out_message();
}

require_once "inc/footer.inc.php";
