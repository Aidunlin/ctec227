<?php
// The bigger view for an individual photo.

session_start();
require_once "inc/app.inc.php";
require_once "inc/functions.inc.php";

if (!isset($_GET["photo"])) {
    header("Location: .?error=No photo id was given to view!");
    exit;
}

$result = get_photo_record($_GET["photo"]);
$photo = $result["data"];
$errors = $result["errors"];

if (count($errors) > 0) {
    header("Location: .?error=Failed to find photo to view!");
    exit;
}

$page_title = $photo["name"];
require_once "inc/header.inc.php";

echo "<a class='d-block my-3' href='.?photo={$photo["photo_id"]}'>";
display_photo($photo);
echo "</a>";
echo "<p><a href='.?photo={$photo["photo_id"]}'>Back</a></p>";

require_once "inc/footer.inc.php";
