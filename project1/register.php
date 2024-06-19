<?php
session_start();
require_once "inc/app.inc.php";
require_once "inc/functions.inc.php";

$form_data = [
    "user_name" => "",
    "password" => "",
    "password_confirm" => "",
];

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $form_data = get_form_data(array_keys($form_data));
    array_push($errors, ...validate_register_form($form_data));

    // register_user() only accepts an array with user_name and password.
    unset($form_data["password_confirm"]);

    if (count($errors) == 0) {
        array_push($errors, ...register_user($form_data));

        if (count($errors) == 0) {
            header("Location: login.php?success=Successfully registered {$form_data["user_name"]}!");
            exit;
        }
    }

    // Just in case.
    unset($form_data["password"]);
}

$page_title = "Register";
require_once "inc/header.inc.php";

display_errors_if_any($errors);
?>

<form method="post" style="view-transition-name: form">
    <div class="mb-3">
        <label class="form-label" for="user_name">User name</label>
        <input class="form-control" type="user_name" name="user_name" id="user_name" maxlength="32" value="<?= $form_data["user_name"] ?>">
        <div class="form-text">Can only have letters, numbers, and underscores.</div>
    </div>

    <div class="mb-3">
        <label class="form-label" for="password">Password</label>
        <input class="form-control" type="password" name="password" id="password">
        <div class="form-text">Must be at least 8 characters in length.</div>
    </div>

    <div class="mb-3">
        <label class="form-label" for="password_confirm">Confirm password</label>
        <input class="form-control" type="password" name="password_confirm" id="password_confirm">
    </div>

    <input class="btn btn-primary" type="submit" value="<?= $page_title ?>">
</form>

<?php require_once "inc/footer.inc.php"; ?>