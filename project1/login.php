<?php
session_start();
require_once "inc/app.inc.php";
require_once "inc/functions.inc.php";

$form_data = [
    "user_name" => "",
    "password" => "",
];

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $form_data = get_form_data(array_keys($form_data));
    array_push($errors, ...validate_login_form($form_data));

    if (count($errors) == 0) {
        $result = login_user($form_data);
        $user = $result["data"];
        array_push($errors, ...$result["errors"]);

        if (count($errors) == 0) {
            $_SESSION["user_name"] = $user["user_name"];
            header("Location: .?success=Welcome {$user["user_name"]}!");
            exit;
        }
    }

    // Just in case.
    unset($form_data["password"]);
}

$page_title = "Login";
require_once "inc/header.inc.php";

// Handles the message from successfully registering.
$success_message = $_GET["success"] ?? "";
if (strlen($success_message)) {
    echo "<div class='alert alert-success'>$success_message</div>";
}

display_errors_if_any($errors);
?>

<form method="post" style="view-transition-name: form">
    <div class="mb-3">
        <label class="form-label" for="user_name">User name</label>
        <input class="form-control" type="user_name" name="user_name" id="user_name" value="<?= $form_data["user_name"] ?>">
    </div>

    <div class="mb-3">
        <label class="form-label" for="password">Password</label>
        <input class="form-control" type="password" name="password" id="password">
    </div>

    <input class="btn btn-primary" type="submit" value="<?= $page_title ?>">
</form>

<?php require_once "inc/footer.inc.php"; ?>