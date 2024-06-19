<?php
session_start();
if (!isset($_SESSION["user_name"])) {
    header("Location: login.php");
    exit;
}

require_once "inc/app.inc.php";
require_once "inc/functions.inc.php";

if (!isset($_GET["photo"])) {
    header("Location: .?error=No photo id was given to delete!");
    exit;
}

$result = get_photo_record($_GET["photo"]);
$photo = $result["data"];
$errors = $result["errors"];

if (count($errors) > 0) {
    header("Location: .?error=Failed to find photo to delete!");
    exit;
}

// delete_photo_record() checks the session user name against the photo record.

if (!delete_photo_record($photo["photo_id"])) {
    header("Location: .?error=Failed to delete {$photo["name"]}!");
    exit;
}

unlink($photo["path"]);
header("Location: .?success=Deleted {$photo["name"]}!");
exit;
